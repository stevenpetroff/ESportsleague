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
if (isset($request['userName']) && !empty($request['userName'])){
	$reply['userName'] = $request['userName'];
	if(!is_null(($user = userDB::getUserByName($reply['userName'])))){
		$userProfile = userProfileDB::getUserProfileByUserName($reply['userName']);
		if($userProfile->getTeamId() == 1){

			//create notification to the user
			$userId = $user->getUserId();
			$note['userId'] = $userId;
			$note['ntype'] = $request['ntype'];
			$note['nvalue'] = $request['nvalue'];
			$note['nmsg'] = $request['nmsg'];
			$noteData = new notificationData($note);
			notificationDB::addNotification($noteData);
			$reply['result'] = 'success';
		}
	}
}else if(isset($request['status']) && !empty($request['status'])){
	if($request['status'] == 1){
		//add user to team
		$userId = $request['userId'];
		$teamId = $request['val'];
		if(teamDB::addMemberToTeam($userId,$teamId)== -1){
			$reply['error']= 'there was an error1';
		}
		//delete notification
		notificationDB::removeNotificationById($userId,1);
	}else if($request['status'] == 0){
		//delete notification
		notificationDB::removeNotificationById($userId,1);
	}
	
}else{
	$reply['error']= 'there was an error';
}
echo json_encode($reply);
?>