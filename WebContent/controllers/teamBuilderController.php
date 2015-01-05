<?php 
include_once (dirname(__FILE__)."/../views/teamBuilder.php");
include_once (dirname(__FILE__)."/../views/error.php");
include_once(dirname(__FILE__)."/../controllers/loginController.php");
include_once (dirname(__FILE__)."/../models/teamDB.class.php");
include_once (dirname(__FILE__)."/../models/teamData.class.php");
include_once(dirname(__FILE__)."/../models/userProfileDB.class.php");
include_once(dirname(__FILE__)."/../models/userProfileData.class.php");
include_once (dirname(__FILE__)."/../models/userDB.class.php");
include_once(dirname(__FILE__)."/../models/Database.class.php");
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

if(!empty($_SESSION) && $_SESSION['userLoginStatus'] == 1){
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		try{
			$newTeam = new teamData($_POST);
			//if(!is_null(teamDB::getTeamByName($newTeam->getTeamName())))
			//	$newTeam->setError('teamName',"That team name already exists!");
			if($newTeam->getErrorCount() == 0){
				$userName = $_SESSION['userName'];
				$user = userDB::getUserByName($userName);
				$capId = $user->getUserId();
				$userProfile = userProfileDB::getUserProfileById($capId);
				$user = $userProfile;
				$teamId = teamDB::addTeam($newTeam,$capId);
				$teamName = $newTeam->getTeamName();
				header("Location: ../controllers/teamManagerController.php");
			} else{
				teamBuilder($newTeam);
			}
				
		} catch(Exception $e){
			echo "$e";
		}
	} else {
		$userName = $_SESSION['userName'];
		$user = userDB::getUserByName($userName);
		$capId = $user->getUserId();
		$userProfile = userProfileDB::getUserProfileDataById($capId);
		/**/
		if($userProfile->getTeamId() != 1){
			printError("onateam");
		}else{
			$newTeam = new teamData();
			teamBuilder($newTeam);
		}/**/
	}
} else {
	loginForm($user,"teambuilderunauthenticated");
}
	


?>