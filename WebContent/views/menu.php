<?php 
include_once(dirname(__FILE__)."/../controllers/notificationController.php");
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function showMenu($active){
try{
	if($active == 'registration'){
		$url = "../";
	} else if($active == 'index'){
		$url = "";
	} else if($active == 'memberlist'){
		$url = "../";
	} else if($active == 'login'){
		
	}

		if(!empty($_SESSION) && $_SESSION['userLoginStatus'] == 1){
			$user = $_SESSION['userName'];
			$count = getNotificationCount($user);
			echo"<ul class=\"nav navbar-nav\">";
			echo"<li id=\"menuIndex\" class=\"active\"><a href=\"".$url."index.php\">Home</a></li>";
			echo"<li><a href=\"".$url."views/memberlist.php\">Memberlist</a></li>";
			
			echo"<li class=\" dropdown\">";
			echo"<a href=\"#\" class=\"dropdown-toggle \" data-toggle=\"dropdown\"
					role=\"button\" aria-expanded=\"false\">Welcome back, ".$_SESSION['userName']. "<span class=\"caret\"></span></a>";
			echo"<ul class=\"dropdown-menu\" role=\"menu\">";
			echo"<li><a href=\"".$url."controllers/notificationController.php\"\">Notifications  <span class=\"badge\">".$count."</span></a></li>";
			echo"<li><a href=\"".$url."views/profile.php?user=$user\"\">Your Profile</a></li>";
			echo"<li><a href=\"".$url."controllers/myprofileController.php\"\">Edit your Profile</a></li>";
			echo"<li><a href=\"".$url."controllers/teamManagerController.php\">Team Manager</a></li>";
			echo"<li class=\"divider\"></li>";
			echo"<li class=\"dropdown-header\"></li>";
			echo"<li><a href=\"".$url."controllers/logoutController.php\"\">Log out</a></li>";
			echo"</ul>";
			echo"</li>";
			echo"</ul>";
			
			//echo"<li>";
// 			echo"<ul class=\"pull-right navbar-nav \">";
// 				echo"<li class=\" dropdown\">";
// 				echo"<a href=\"#\" class=\"dropdown-toggle \" data-toggle=\"dropdown\" 
// 					role=\"button\" aria-expanded=\"false\">Welcome back, ".$_SESSION['userName']. "<span class=\"caret\"></span></a>";
// 					echo"<ul class=\"dropdown-menu\" role=\"menu\">";
// 						echo"<li><a href=\"".$url."views/profile.php?user=$user\"\">Your Profile</a></li>";
// 						echo"<li><a href=\"".$url."controllers/myprofileController.php\"\">Edit your Profile</a></li>";
// 						echo"<li><a href=\"#\">Team Page</a></li>";
// 						echo"<li class=\"divider\"></li>";
// 						echo"<li class=\"dropdown-header\"></li>";
// 						echo"<li><a href=\"".$url."controllers/logoutController.php\"\">Log out</a></li>";
// 					echo"</ul>";
// 				echo"</li>";
// 			echo"</ul>";
			//echo"</li>";
			//echo"</ul>";

// 			echo"<ul class=\"nav navbar-nav navbar-profile\">";
// 			echo"<li><a href=\"../navbar/\">Default</a></li>";
// 			echo"<li><a href=\"../navbar-fixed-top/\">Fixed top</a></li>";
// 			echo"</ul>";
			

			
		}else{
			
			//echo"<a href=\"dirname(__FILE__)./../controllers/loginController.php?request=login\">Login</a> | "; // login
			//echo"<a href=\"dirname(__FILE__)./../controllers/signupController.php\">Sign Up</a> | "; //signup
			//echo"<a href=\"dirname(__FILE__)./../views/memberlist.php\">Memberlist</a>";		//member list
			
			echo"<ul class=\"nav navbar-nav\">";
			echo"<li class=\"active\"><a href=\"".$url."index.php\">Home</a></li>";
			echo"<li><a href=\"".$url."views/memberlist.php\">Memberlist</a></li>";
			echo"<li><a href=\"".$url."controllers/loginController.php?request=login\">Login</a></li>";
			echo"<li><a href=\"".$url."controllers/signupController.php\">Sign Up!</a></li>";
			echo"</ul>";

		}
	} catch (Exception $e){
	echo " Could not generate menu";
	}
}
?>