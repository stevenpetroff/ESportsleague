<?php 
include_once(dirname(__FILE__)."/../models/teamData.class.php");
/*
 * 
INSERT INTO teamInfo(teamInfoId,teamGame,teamCaptain) VALUES
      (1,99,1);
INSERT INTO teamRoster(teamRosterId,m1) VALUES
      (1,1);
INSERT INTO team(teamId,teamName) VALUES
      (1,'Free Agent');      
 */

class teamDB{
	
	public static function addTeam($newTeam,$capId){

		$queryTeamInfo = "INSERT INTO teamInfo(teamGame,teamCaptain,teamWin,teamLoss,teamAvatar,teamColor)
						VALUES(:teamGame,:teamCaptain,:teamWin,:teamLoss,:teamAvatar,:teamColor)";
		$queryTeamRoster= "INSERT INTO teamRoster(teamRosterId,m1)
							 VALUES(:teamRosterId,:m1)";
		$queryTeam="INSERT INTO team(teamId,teamName,teamRosterId,teamInfoId)
						VALUES(:teamId,:teamName,:teamRosterId,:teamInfoId)";
		$teamId =-1;
		
		try{
			$db = Database::getDB();		
			//begin transaction
			$db->beginTransaction();
			
			//test if team name exists
			$teamName = $newTeam->getTeamName();
			//$existingTeam = teamDB::getTeamByName($teamName);
			
			/**
			if(!is_null($existingTeam)){
				$newTeam->setError('teamName',"That name already exists!");
				throw new Exception("That team name already exists!");		
			}
			/**/
			$teamName = $newTeam->getTeamName();
			$teamGame = $newTeam->getTeamGame();
			$teamCaptain =$capId;
			$teamWin = 0;
			$teamLoss = 0;
			$teamAvatar = $newTeam->getTeamAvatar();
			$teamColor = $newTeam->getTeamColor();
			
		    //prepare statements
		    $statementTeamInfo = $db->prepare($queryTeamInfo);
		    $statementTeamRoster = $db->prepare($queryTeamRoster);
		    $statementTeam = $db->prepare($queryTeam);
		   
			
		    //bind values
		    	//team info
		    //$statementTeamInfo->bindValue(":teamInfoId",$teamId);
		    $statementTeamInfo->bindValue(":teamGame",$teamGame);
		    $statementTeamInfo->bindValue(":teamCaptain",$teamCaptain);
		    $statementTeamInfo->bindValue(":teamWin",$teamWin);
		    $statementTeamInfo->bindValue(":teamLoss",$teamLoss);
		    $statementTeamInfo->bindValue(":teamAvatar",$teamAvatar);
		    $statementTeamInfo->bindValue(":teamColor",$teamColor);
			//exec
			$statementTeamInfo->execute();
			$teamId = $db->lastInsertId("teamInfoId");
			print_r($teamId);
			$queryCaptain = "UPDATE userProfiles SET teamId = \"$teamId\" WHERE userProfileId = \"$teamCaptain\"";
			$statementCaptain =$db->prepare($queryCaptain);
			//team roster
			$statementTeamRoster->bindValue(":teamRosterId",$teamId);
			$statementTeamRoster->bindValue(":m1",$teamCaptain);
			//team
			$statementTeam->bindValue(":teamId",$teamId);
			$statementTeam->bindValue(":teamName",$teamName);
			$statementTeam->bindValue(":teamRosterId",$teamId);
			$statementTeam->bindValue(":teamInfoId",$teamId);

			$statementTeamRoster->execute();
			$statementTeam->execute();
			$statementCaptain->execute();
			
			$db->commit();
			
			
		}catch(Exception $e){
			if( $e instanceof PDOException OR $e instanceof Exception)
				echo " Error adding team: ".$e->getMessage()." id =".$teamId;
			$db->rollback();
		}
		
		return $teamId;
	}
	
	public static function getTeamArray($rowSets){
		$teams = array();
		foreach($rowSets as $teamRow) {
			$team = teamDB::getTeam($teamRow);
			array_push($teams, $team);
		}
		return $teams;
	}

	public static function getTeam($teamRow){
		if(isset($teamRow)){
			for($i =1; $i<9;$i++){
				if(is_null($teamRow['m'.$i])){
					$val = 'Empty Slot';
				} else{
					$val = $teamRow['m'.$i];
				}
				$teamRow['m'.$i] =$val;
			}

		}
		return new teamData($teamRow);
	}
	
	function getAll(){
		$query = "SELECT teamId, teamName, teamInfo.teamGame, teamInfo.teamCaptain, teamInfo.teamWin, teamInfo.teamLoss,
						teamInfo.teamAvatar, teamInfo.teamColor, teamRoster.m1, teamRoster.m2, teamRoster.m3, teamRoster.m4,
						 teamRoster.m5, teamRoster.m6, teamRoster.m7, teamRoster.m8
						FROM team
							LEFT JOIN teamInfo
									ON teamInfo.teamInfoId = teamId
							LEFT JOIN teamRoster
									ON teamRoster.teamRosterId = teamId
						GROUP BY teamId";
		$myTeams = null;
		
		try{
			$db = Database::getDB();
			$statement = $db->prepare($query);
			$statement->execute();
			$result = teamDB::getTeamArray($statement->fetchAll(PDO::FETCH_ASSOC));
			$statement->closeCursor();
		}catch(PDOException $e){
			echo "Error retrieving teambyname from db: ".$e->getMessage();
		
		
		}
		return $result;
	}

	function addWin($teamId){
		$query = "UPDATE teamInfo SET teamWin = teamWin + 1 WHERE teamInfoId = $teamId";
		
		try{
			$db = Database::getDB();
			$statement = $db->prepare($query);
			$statement->execute();
			$statement->closeCursor();
		}catch(PDOException $e){
			echo "Error adding win to team: ".$e->getMessage();
		}
	}
	function addLoss($teamId){
		$query = "UPDATE teamInfo SET teamLoss = teamLoss + 1 WHERE teamInfoId = $teamId";
		try{
			$db = Database::getDB();
			$statement = $db->prepare($query);
			$statement->execute();
			$statement->closeCursor();
		}catch(PDOException $e){
			echo "Error adding loss to team: ".$e->getMessage();
		}
	}
	
	function addMemberToTeam($userId,$teamId){
		$team = teamDB::getTeamById($teamId);
		$teamRoster = $team->getTeamMembers();
		$found = 0;
		for($k =1,$c=8;$k<=$c;$k++)
			if(strcmp($teamRoster['m'.$k],"Empty Slot")==0){
			   $found = 1;
			   break;
			}
		if( $found == 1){
			try{
				$db = Database::getDB();
				$db->beginTransaction();
				$query = " UPDATE teamroster SET m".$k." = $userId WHERE teamRosterId = $teamId";
				$query2 = " UPDATE userProfiles SET teamId = $teamId WHERE userProfileId = $userId";
				$statement = $db->prepare($query);
				$statement2 = $db->prepare($query2);
				$statement->execute();
				$statement2->execute();
				$db->commit();
			}catch(PDOException $e){
				echo "Error adding member to team: ".$e->getMessage();
				$db->rollback();
			}
		}else{
			return -1;
		}
	}
	
	
	function getTeamByName($name){
		$query = "SELECT teamId, teamName, teamInfo.teamGame, teamInfo.teamCaptain, teamInfo.teamWin, teamInfo.TeamLoss,
						teamInfo.teamAvatar, teamInfo.teamColor, teamRoster.m1, teamRoster.m2, teamRoster.m3, teamRoster.m4,
						 teamRoster.m5, teamRoster.m6, teamRoster.m7, teamRoster.m8
						FROM team
							LEFT JOIN teamInfo
									ON teamInfo.teamInfoId = teamId
							LEFT JOIN teamRoster
									ON teamRoster.teamRosterId = teamId
						WHERE teamName = :teamName
					GROUP BY teamId";
		$myTeam = null;

		try{
			$db = Database::getDB();
			$statement = $db->prepare($query);
			$statement->bindParam(":teamName",$name);
			$statement->execute();
			$result = $statement->fetch(PDO::FETCH_ASSOC);

				
			if(!empty($result)){
				$array = array();
				for($i =1; $i<9;$i++){
					if(is_null($result['m'.$i])){
						$val = 'Empty Slot';
					} else{
						$val = $result['m'.$i];
					}
					$array['m'.$i] =$val;
				}
				if(is_null($array))
					throw new Exception;
				$myTeam = new teamData($result,$array);
				$statement->closeCursor();
			}else{
				$statement->closeCursor();
				throw new Exception;
			}
		}catch(PDOException $e){
			echo "Error retrieving teambyname from db: ".$e->getMessage();
		}
		return $myTeam;
	}
	

	function getTeamById($id){
		$query = "SELECT teamId, teamName, teamInfo.teamGame, teamInfo.teamCaptain, teamInfo.teamWin, teamInfo.TeamLoss,
						teamInfo.teamAvatar, teamInfo.teamColor, teamRoster.m1, teamRoster.m2, teamRoster.m3, teamRoster.m4,
						 teamRoster.m5, teamRoster.m6, teamRoster.m7, teamRoster.m8
						FROM team
							LEFT JOIN teamInfo
									ON teamInfo.teamInfoId = teamId
							LEFT JOIN teamRoster
									ON teamRoster.teamRosterId = teamId
						WHERE teamId = :teamId";
		$myTeam = null;
	
		try{
			$db = Database::getDB();
			$statement = $db->prepare($query);
			$statement->bindParam(":teamId",$id);
			$statement->execute();
			$result = $statement->fetch(PDO::FETCH_ASSOC);
	
	
			if(!empty($result)){
				$array = array();
				for($i =1; $i<9;$i++){
					if(is_null($result['m'.$i])){
						$val = 'Empty Slot';
					} else{
						$val = $result['m'.$i];
					}
					$array['m'.$i] =$val;
				}
				if(is_null($array))
					throw new Exception;
				$myTeam = new teamData($result,$array);
				$statement->closeCursor();
			}else{
				$statement->closeCursor();
				throw new Exception;
			}
		}catch(PDOException $e){
			echo "Error retrieving teambyname from db: ".$e->getMessage();
			echo "$myTeam";
	
	
		}
		return $myTeam;
	}
}

?>