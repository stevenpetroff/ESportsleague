<?php 
include_once(dirname(__FILE__)."/../models/Database.class.php");
include_once(dirname(__FILE__)."/../models/teamDB.class.php");
include_once(dirname(__FILE__)."/../models/userDB.class.php");
include_once(dirname(__FILE__)."/../views/team.php");

class rosterBuilder{
	
	function buildRosterFromIds($array){
		$roster = array();
		
		for($k = 1; $k < 9; $k++){
			$val = $array['m'.$k];
			if(strcmp($val,'Empty Slot')!= 0){
				$user = userDB::getUserById($val);
				$username = $user->getUserName();
				$roster['m'.$k] = $username;
			}else{
				$roster['m'.$k] = $val;
			}
		}
		return $roster;
	}
	function buildCaptainRosterFromIds($array){
		$captains = array();
		if(!is_null($array)){
			foreach($array as $team){
				$capId = $team->getTeamCaptain();
				$captain = userDB::getUserById($capId);
				$username = $captain->getUserName();
				array_push($captains,$username);
			}
		}
		return $captains;
	}
	
	function buildFreeAgentList(){
		
	}
}
?>