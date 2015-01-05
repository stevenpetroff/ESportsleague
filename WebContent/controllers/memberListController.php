<?php 
include_once(dirname(__FILE__)."/../views/memberlist.php");
include_once(dirname(__FILE__)."/../models/userProfileDB.class.php");
include_once(dirname(__FILE__)."/../models/userProfileData.class.php");
include_once(dirname(__FILE__)."/../models/Database.class.php");


function getMemberList(){
	$myProfiles = userProfileDB::getAll();
	foreach($myProfiles as $profile){
		$profile->printMemberlistInfo();
	}
}

?>