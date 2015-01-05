<?php
include_once(dirname(__FILE__)."/../models/userProfileData.class.php");
include_once(dirname(__FILE__)."/../models/userProfileDB.class.php");
include_once(dirname(__FILE__)."/../models/userData.class.php");
include_once(dirname(__FILE__)."/../models/userDB.class.php");
include_once(dirname(__FILE__)."/../models/Database.class.php");
include_once(dirname(__FILE__)."/../models/gamesListDB.class.php");
include_once(dirname(__FILE__)."/../views/userRegistrationForm.php");
include_once(dirname(__FILE__)."/../views/showProfiles.php");
include_once(dirname(__FILE__)."/../views/recentMembers.php");
include_once(dirname(__FILE__)."/../views/memberlist.php");


function getAllProfiles(){
	try{
		$myProfiles = userProfileDB::getAll();	
		printMemberProfileList($myProfiles);
	} catch (Exception $e){
		//echo "Could not retrieve all profiles from database";
	}
	return 1;
}
function getProfile($username){
	try{
		$myProfile = userProfileDB::getUserProfileByUserName($username);
	}catch(Exception $e){
		//echo"Could not load profile.";
		$myProfile = null;
	}
		return $myProfile;
}
function getRecentMemberProfiles(){
	try{
		$myProfiles = userProfileDB::getAll();
		printRecentMembers($myProfiles);
	} catch (Exception $e){
		//echo"Could not load recent member profiles";
	}
	return 1;
}

	
?>