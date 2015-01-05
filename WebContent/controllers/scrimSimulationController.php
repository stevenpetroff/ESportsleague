<?php 
include_once(dirname(__FILE__)."/../models/notificationDB.class.php");
include_once(dirname(__FILE__)."/../models/notificationData.class.php");
include_once(dirname(__FILE__)."/../models/userProfileData.class.php");
include_once(dirname(__FILE__)."/../models/userProfileDB.class.php");
include_once(dirname(__FILE__)."/../models/userData.class.php");
include_once(dirname(__FILE__)."/../models/userDB.class.php");
include_once(dirname(__FILE__)."/../models/teamDB.class.php");
include_once(dirname(__FILE__)."/../models/Database.class.php");



$reply = array();
$request = json_decode($_POST['json'],true);
if (isset($request['myTeam']) && isset($request['theirTeam'])){
	$myTeam = $request['myTeam'];
	$theirTeam = $request['theirTeam'];
	$pick = mt_rand(0, 1); 
	if ($pick > 0.5){
		// my team wins
		teamDB::addWin($myTeam);
		teamDB::addLoss($theirTeam);
		$reply['result'] = "win";
	}else{
		// my team loses
		teamDB::addWin($theirTeam);
		teamDB::addLoss($myTeam);
		$reply['result'] = "loss";
	}
	
}else{
	$reply['error']= 'there was an error';
}
echo json_encode($reply);
?>