<?php 
include_once(dirname(__FILE__)."/../models/Database.class.php");
include_once(dirname(__FILE__)."/../views/login.php");
include_once(dirname(__FILE__)."/../views/profile.php");
include_once(dirname(__FILE__)."/../models/userData.class.php");
include_once(dirname(__FILE__)."/../models/userDB.class.php");
include_once(dirname(__FILE__)."/../models/userProfileDB.class.php");

if(basename($_SERVER['PHP_SELF']) == "loginController.php")
	loginRequest($_GET);


function loginRequest($redirect){
	if(!empty($_SESSION) && $_SESSION['userLoginStatus'] == 1){
		header("Location: ../index.php");
	}else if($_SERVER["REQUEST_METHOD"] == "POST") {
		$user = new userData($_POST);  // What if already logged in?
		if ($user->getErrorCount() == 0) {
			$actualUser = userDB::getUserByName($user->getUserName());
			if (is_null($actualUser)) {
				$user->setError('userName', 'Invalid user name');
				loginForm($user,"invalidusername");
			} elseif (($authenticated = userDB::authenticateUser($user)) == false) {
				$user->setError('userPassword', 'Invalid password');
				loginForm($user,"invalidpassword");
			} elseif ($authenticated == true){// Add sessions here
				
				$_SESSION ['userName'] = $user->getUserName();
				$_SESSION ['userLoginStatus'] = 1;
				$profile = userProfileDB::getUserProfileByUserName($user->getUserName());
				header("Location: ../index.php");
			} else {
			loginForm($user);
			}
		}
		} else { // Initial link
		$user = new userData();
		loginForm($user,"0");
	}
}

?>