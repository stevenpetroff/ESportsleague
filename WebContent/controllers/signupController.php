<?php 
include_once(dirname(__FILE__)."/../models/userProfileData.class.php");
include_once(dirname(__FILE__)."/../models/userProfileDB.class.php");
include_once(dirname(__FILE__)."/../models/userData.class.php");
include_once(dirname(__FILE__)."/../models/userDB.class.php");
include_once(dirname(__FILE__)."/../models/notificationData.class.php");
include_once(dirname(__FILE__)."/../models/notificationDB.class.php");
include_once(dirname(__FILE__)."/../models/Database.class.php");
include_once(dirname(__FILE__)."/../models/gamesListDB.class.php");
include_once(dirname(__FILE__)."/../views/userRegistrationForm.php");

	if($_SERVER["REQUEST_METHOD"] == "POST"){
		try{
			
			$pictureForm = $_FILES['userProfileAvatarUpload'];
			$tmpName = $pictureForm['tmp_name'];
			if (!empty($tmpName)){
	   			move_uploaded_file($tmpName, "../src/img/avatar/".$pictureForm['name']);
			    $_POST['userProfileAvatar']	 = $pictureForm['name'];
			}
	
			$gamesMap = gamesListDB::getMap('gamesName','gamesId');
			$myProfile = new userProfileData($_POST,$gamesMap);
			$myUser = new userData($_POST);
			if(!is_null(userDB::getUserByName($myUser->getUserName())))
				$myUser->setError('userName','Username already exists');
			if($myProfile->getErrorCount() == 0 && $myUser->getErrorCount() == 0){
				$id = userProfileDB::addUser($myUser, $myProfile);
				$myProfile = userProfileDB::getUserProfileById($id);
				session_start();
				$_SESSION ['userName'] = $myUser->getUserName();
				$_SESSION ['userLoginStatus'] = 1;
				header("Location: ../index.php");
			} else {
				userRegistrationForm($myProfile);
				
			} 
		}catch (Exception $e){
				echo "Could not create new profile ".$e->getMessage();

		}
	} else {
	
		$myProfile = new userProfileData();
		userRegistrationForm($myProfile);
	}
?>


