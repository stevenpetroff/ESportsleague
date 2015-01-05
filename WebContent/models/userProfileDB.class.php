<?php 

class userProfileDB {
	
	public static function addUser($myUser,$myProfile) {
		$queryUserLogin = "INSERT INTO users (userName, userPasswordHash)
							VALUES(:userName, :userPasswordHash)";
		
		$queryUserProfile = "INSERT INTO userProfiles(userProfileFirstName,
					userProfileLastName,userProfileEmail,userProfilePhone,
					userProfileFavColor,userProfileDOB,userProfileAvatar,teamId,userId)
					VALUES(:userProfileFirstName,:userProfileLastName,:userProfileEmail,
							:userProfilePhone, :userProfileFavColor,:userProfileDOB,
							:userProfileAvatar,:teamId,:userId)";
		$returnId = 0;
		
		try{
			$db = Database::getDB();
			
			//begin transaction
			$db->beginTransaction();
			
			/*get login information*/
			$username = $myUser->getUserName();
			$passHash = password_hash($myUser->getUserPassword(),PASSWORD_DEFAULT);
			
			$existingUser = UserDB::getUserByName($username);
			if (!is_null($existingUser))  // user already exists
				throw new Exception("That userName already Exists!"); 
			/*get user profile data*/
			$email = $myProfile->getEmail();
			$firstName = $myProfile->getFirstName();
			$lastName = $myProfile->getLastName();
			$phone = $myProfile->getPhone();
			$color = $myProfile->getFavColor();
			$dob = $myProfile->getDOB();
			$avatar = $myProfile->getAvatar();
			$teamid = 1;
			//prepare statements
			$statementUserLogin = $db->prepare($queryUserLogin);
			$statementUserProfile = $db->prepare($queryUserProfile);
			
			$statementUserLogin->bindValue(":userName",$username);
			$statementUserLogin->bindValue(":userPasswordHash",$passHash);
			$statementUserProfile->bindValue(":userProfileFirstName",$firstName);
			$statementUserProfile->bindValue(":userProfileLastName",$lastName);
			$statementUserProfile->bindValue(":userProfilePhone",$phone);
			$statementUserProfile->bindValue(":userProfileEmail",$email);
			$statementUserProfile->bindValue(":userProfilePhone",$phone);
			$statementUserProfile->bindValue(":userProfileFavColor",$color);
			$statementUserProfile->bindValue(":userProfileDOB",$dob);
			$statementUserProfile->bindValue(":userProfileAvatar",$avatar);
			$statementUserProfile->bindValue(":teamId",$teamid);
			//execute statements
			//begin transaction
			$statementUserLogin->execute();
			$returnId = $db->lastInsertId("userProfileId");
			$statementUserProfile->bindValue(":userId",$returnId);
				
			$statementUserProfile->execute();
			
			$statementUserLogin->closeCursor();
			$statementUserProfile->closeCursor();
			//end/commit transaction
			$db->commit();
			
			$myGames = $myProfile->getGamesList();
			userProfileDB::writeGamesList($db,$returnId,$myGames);
		} catch (Exception $e){
			if( $e instanceof PDOException OR $e instanceof Exception)
				echo " Error adding user: ".$e->getMessage();
			$db->rollback();
		}
		return $returnId;
	}
	
	public static function editProfile($profile, $id){

		$firstName = $profile['userProfileFirstName'];
		$lastName = $profile['userProfileLastName'];
		$email = $profile['userProfileEmail'];
		$phone = $profile['userProfilePhone'];
		$avatar = $profile['userProfileAvatar'];
			
		
		$query = "UPDATE userProfiles SET userProfileFirstName = \"$firstName\", userProfileLastname = \"$lastName\",
						userProfileEmail = \"$email\", userProfilePhone = \"$phone\", userProfileAvatar = \"$avatar\"
					WHERE userProfileId = \"$id\"";
		
		try{
			$db = Database::getDB();
			$statement = $db->prepare($query);
			$statement->execute();
			$statement->closeCursor();
		}catch(PDOException $e){
			echo "Error editing profile ".$e->getmessage();
		}
	}
	
	public static function getAll(){
		
		$query = "SELECT userProfiles.userProfileId,users.userName,userProfileFirstName,
					userProfileLastName, userProfileEmail, userProfilePhone,
					userProfileDOB, userProfileFavColor, userProfileAvatar,teamId,
					GROUP_CONCAT(games.gamesName SEPARATOR ';') as gamesList
					FROM userProfiles
						LEFT JOIN gamesMap
							ON userProfiles.userProfileId = gamesMap.userProfileId
						LEFT JOIN games
							ON gamesMap.gamesId = games.gamesId
						LEFT JOIN users
							ON userProfiles.userProfileId = users.userId
					GROUP BY userProfiles.userProfileId";
		$profiles = array();
		try{
			$db= Database::getDB();
			$statement = $db->prepare($query);
			$statement->execute();
			$profiles = userProfileDB::getProfileArray($statement->fetchAll(PDO::FETCH_ASSOC));
			$statement->closeCursor();
		} catch (PDOException $e) {
			echo "Unable to retrive all profiles: " .$e->getMessage();
		}
		return $profiles;
	}
	
	public static function getProfileArray($rowSets){
		$profiles = array();
		foreach($rowSets as $profileRow) {
			$profile = userProfileDB::getProfile($profileRow);
			array_push($profiles, $profile);
		}
		return $profiles;
	}
	
	public static function getProfile($profileRow){
		
		if(isset($profileRow['gamesList'])){
			$games = $profileRow['gamesList'];
			$profileGames = explode(";", $games);
			$profileRow['userProfileGamesList'] = explode (";",$games);
		}
		return new userProfileData($profileRow);
	}
	
	public static function writeGamesList($db, $id, $games){
		if(empty($games))
			return;
		$query = "INSERT INTO gamesMap(gamesId, userProfileId)
						VALUES(:gamesId, :userProfileId)";
		$gamesMap = gamesListDB::getMap('gamesName','gamesId');
		try{
			$statement = $db->prepare($query);
			$statement->bindParam(":userProfileId",$id);
			for( $k = 0; $k < count($games); $k++){
				$statement->bindParam(":gamesId", $gamesMap[$games[$k]]);
				$statement->execute();
			}
			$statement->closeCursor();
		} catch (PDOException $e) {
			print_r ("unable to write gameslist for profile: ".$e->getMessage());
		}
	}
	
	public static function getUserProfileById($id){
		$query = "SELECT * FROM userProfiles WHERE (userProfileId = :userProfileId)";
		$user = NULL;
		
		try{
			$db = Database::getDB();
			$statement= $db->prepare($query);
			$statement->bindParam(":userProfileId",$id);
			$statement->execute();
			$userRows = $statement->fetch(PDO::FETCH_ASSOC);
			if(!empty($userRows))
				$user = new UserData($userRows);
			$statement->closeCursor();
		} catch (PDOException $e) {
			echo "Error getting user profile with id: " .$id;
		}
		return $user;
	}
	
	public static function getUserProfileDataById($id){
		$query = "SELECT * FROM userProfiles WHERE (userProfileId = :userProfileId)";
		$user = NULL;
	
		try{
			$db = Database::getDB();
			$statement= $db->prepare($query);
			$statement->bindParam(":userProfileId",$id);
			$statement->execute();
			$userRows = $statement->fetch(PDO::FETCH_ASSOC);
			if(!empty($userRows))
				$user = new userProfileData($userRows);
			$statement->closeCursor();
		} catch (PDOException $e) {
			echo "Error getting user profile with id: " .$id;
		}
		return $user;
	}
	public static function getUserProfileByEmail($email){
		$query = "SELECT userProfiles.userProfileId,users.userName,userProfileFirstName,
					userProfileLastName, userProfileEmail, userProfilePhone,
					userProfileDOB, userProfileFavColor, userProfileAvatar,teamId,
				GROUP_CONCAT(games.gamesName SEPARATOR ';') as gamesList
				FROM userProfiles
					LEFT JOIN gamesMap
							ON userProfiles.userProfileId = gamesMap.userProfileId
					LEFT JOIN games
							ON gamesMap.gamesId = games.gamesId
					LEFT JOIN users
						ON users.userId = userProfiles.userProfileId 
					WHERE userProfileEmail = :userProfileEmail
				GROUP BY userProfiles.userProfileId";
		
		$myProfile = null;
		try{
			$db = Database::getDB();
			$statement = $db->prepare($query);
			$statement->bindParam(":userProfileEmail", $email);
			$statement->execute();
			//$result = userProfileDB::getProfile($statement->fetchAll(PDO::FETCH_ASSOC));
			$result =$statement->fetch(PDO::FETCH_ASSOC);
			//$result = userProfileDB::getProfile($result);
			//print_r(userProfileDB::getProfile($result));
			if(isset($result['gamesList'])){
				$games = $result['gamesList'];
				$profileGames = explode(";", $games);
				$result['userProfileGamesList'] = explode (";",$games);
			}
			if (!empty($result))
				$myProfile = new userProfileData($result);
			$statement->closeCursor();
			}catch(PDOException $e){
				echo "Error retrieving userprofilebyusername from db: ".$e->getMessage();
		}
		return $myProfile;
	}
	
	public static function getUserProfileByUserName($username){
		$query = "SELECT userProfiles.userProfileId,users.userName,userProfileFirstName,
					userProfileLastName, userProfileEmail, userProfilePhone,
					userProfileDOB, userProfileFavColor, userProfileAvatar,teamId,
				GROUP_CONCAT(games.gamesName SEPARATOR ';') as gamesList
				FROM userProfiles
					LEFT JOIN gamesMap
							ON userProfiles.userProfileId = gamesMap.userProfileId
					LEFT JOIN games
							ON gamesMap.gamesId = games.gamesId
					LEFT JOIN users
						ON users.userId = userProfiles.userProfileId 
					WHERE users.userName = :userName
				GROUP BY userProfiles.userProfileId";
		
		$myProfile = null;
		try{
			$db = Database::getDB();
			$statement = $db->prepare($query);
			$statement->bindParam(":userName", $username);
			$statement->execute();
			//$result = userProfileDB::getProfile($statement->fetchAll(PDO::FETCH_ASSOC));
			$result =$statement->fetch(PDO::FETCH_ASSOC);
			//$result = userProfileDB::getProfile($result);
			//print_r(userProfileDB::getProfile($result));
			if(isset($result['gamesList'])){
				$games = $result['gamesList'];
				$profileGames = explode(";", $games);
				$result['userProfileGamesList'] = explode (";",$games);
			}
			if (!empty($result))
				$myProfile = new userProfileData($result);
			$statement->closeCursor();
			}catch(PDOException $e){
				echo "Error retrieving userprofilebyusername from db: ".$e->getMessage();
		}
		return $myProfile;
	}
	public static function getGamesById($id){
		$query = "SELECT games.gamesName 
					FROM gamesMap
						LEFT JOIN games
						ON gamesMap.gamesId = games.gamesId
					WHERE gamesMap.userProfileId = :userProfileId";
		$games = array();
		
		try{
			$db = Database::getDB();
			$statement = $db->prepare($query);
			$statement->bindParam(":userProfileId", $id);
			$statement->execute();
			$results = $statement->fetchAll(PDO::FETCH_ASSOC);
			$games = array();
			for($k =0; $k<count($results);$k++){
				array_push($games, $results[$k]['gamesName']);
			}
			$statement->closeCursor();
		} catch (PDOException $e) {
			echo "Error retrieving games list for profile .$id " .$e->getMessage();
		}
		return $games;
	}
	
	
	
}




?>