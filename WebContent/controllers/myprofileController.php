<?php 
include_once(dirname(__FILE__)."/../models/userProfileData.class.php");
include_once(dirname(__FILE__)."/../models/userProfileDB.class.php");
include_once(dirname(__FILE__)."/../models/userData.class.php");
include_once(dirname(__FILE__)."/../models/userDB.class.php");
include_once(dirname(__FILE__)."/../models/Database.class.php");
include_once(dirname(__FILE__)."/../views/myprofile.php");
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(!empty($_SESSION) && $_SESSION['userLoginStatus'] == 1){
		if($_SERVER["REQUEST_METHOD"] == "POST"){
		try{
			$userName = $_SESSION['userName'];
			$user = userDB::getUserByName($userName);
			$id = $user->getUserId();
			$arr = $_POST;
			$id = userProfileDB::editProfile($arr,$id);
			header('Location: ../controllers/myprofileController.php');
		} catch (Exception $e){
			echo "Could not find user ".$userName."";
		}
	} else{
		$userName =$_SESSION['userName'];
		$profile = getProfile($userName);
		showMyProfile($profile);
	}

} else{
	echo"You must be logged in to view this page";
	$redirect = $_GET;
	loginRequest($redirect);
}
?>