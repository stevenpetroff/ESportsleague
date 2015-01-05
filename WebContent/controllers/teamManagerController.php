<?php 

/**
 * 
 * Team Manager Use cases:
 * 
 * 		Not on a team
 * 				= Join a team
 * 				= Create a team
 * 				= View teams
 * 				= view team list
 * 
 * 		On a team
 * 			= View teams
 * 			= view team list
 * 			*Owner:
 * 				= Manage your team
 * 				= Invite players
 * 				= Edit team profile	
 * 				= Remove players
 * 				= delete teams
 * 				= invite team to play match
 * 			
 * 			*Player:
 * 				= View my team page
 * 				= View invites to play
 * 				= view schedule
 * 				
 * 
 */
include_once(dirname(__FILE__)."/../models/Database.class.php");
include_once(dirname(__FILE__)."/../models/teamDB.class.php");
include_once(dirname(__FILE__)."/../models/userProfileDB.class.php");
include_once(dirname(__FILE__)."/../models/rosterBuilder.class.php");
include_once (dirname(__FILE__)."/../views/teamManagerComponents.php");
include_once(dirname(__FILE__)."/../controllers/loginController.php");
include_once(dirname(__FILE__)."/../controllers/teamController.php");
include_once(dirname(__FILE__)."/../views/teamManager.php");
include_once(dirname(__FILE__)."/../views/login.php");

if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

if(!empty($_SESSION) && $_SESSION['userLoginStatus'] == 1){
	//getUserInformation
	$username = $_SESSION['userName'];
	$teamsList = teamDB::getAll();
	$userProfile = userProfileDB::getUserProfileByUserName($username);
	$captains = rosterBuilder::buildCaptainRosterFromIds($teamsList);
	//check if user is on team
	if(($teamstatus =$userProfile->getTeamId()) == 1){
		//user is not on a team
		//echo"user is not on a team";
		printTeamManager(null,$userProfile,$teamsList,$captains,null,0,null);
	} else {
		$team = teamDB::getTeamById($teamstatus);
		$myTeamRoster = getRosterByTeam($team);
		//check if user is captain
		if(($teamCapId =$team->getTeamCaptain()) == $userProfile->getUserProfileId()){
			//user is the captain
			printTeamManager($team,$userProfile,$teamsList,$captains,$myTeamRoster,11,$teamstatus);
				
		} else{
			//user is not the captain
			//echo"user is not the captain";
			//echo"<br> id =".$teamCapId;
			printTeamManager($team,$userProfile,$teamsList,$captains,$myTeamRoster,10,null);
		}
	}
} else{
	//echo"You must be logged in to view this profile";
	loginForm($user,"tmunauthenticated");
}

?>