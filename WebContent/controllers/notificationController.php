<?php 
include_once(dirname(__FILE__)."/../views/notifications.php");
include_once(dirname(__FILE__)."/../models/notificationDB.class.php");
include_once(dirname(__FILE__)."/../models/notificationData.class.php");
include_once(dirname(__FILE__)."/../models/userDB.class.php");
include_once(dirname(__FILE__)."/../models/userData.class.php");

if (session_status() == PHP_SESSION_NONE) {
	session_start();
}
if(basename($_SERVER['PHP_SELF']) == "notificationController.php")
	getNotifications();

function getNotificationCount($userName){
	$user = userDB::getUserByName($userName);
	$id = $user->getUserId();
	$notifications = notificationDB::getNotificationsByUserId($id);
	$count = sizeof($notifications);
	return $count;
}

function getNotifications(){
	if(!empty($_SESSION) && $_SESSION['userLoginStatus'] == 1){
		try{
			$userName = $_SESSION['userName'];
			$user = userDB::getUserByName($userName);
			$id = $user->getUserId();
			$notifications = notificationDB::getNotificationsByUserId($id);
			printNotifications($notifications);
		}catch(Exception $e){
		}
	}
}

?>