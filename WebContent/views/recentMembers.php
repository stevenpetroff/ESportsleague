<?php
include_once(dirname(__FILE__)."/../controllers/profileController.php");

// Displays a list of all profiles 
// Input: an array of profileData objects
//show last 3 members
function printRecentMembers($myProfiles){
	try{
		if(!empty($_SESSION) && $_SESSION['userLoginStatus'] == 1){
			$numProfiles = sizeof($myProfiles);
			for($i=$numProfiles-1;$i>=0 && $i >=($numProfiles-4);$i--){
				$avatar= $myProfiles[$i]->getAvatar();
		 		$username = $myProfiles[$i]->getUserName();
					echo"<div class=\"col-sm-3\">";
					echo "<img  src=\"src/img/avatar/$avatar\" width=\"100\" height=\"100\" alt=\"avatar\"> <br>";
					echo "<a href=\"views/profile.php?user=$username\"><h4>$username</h4></a> <br>";
					echo"</div>";
			}	
		}else{
			$numProfiles = sizeof($myProfiles);
			for($i=$numProfiles-1;$i>=0 && $i >=($numProfiles-4);$i--){
				$avatar= $myProfiles[$i]->getAvatar();
				$username = $myProfiles[$i]->getUserName();
				echo"<div class=\"col-sm-3\">";
				echo "<img  src=\"src/img/avatar/$avatar\" width=\"140\" height=\"140\" alt=\"avatar\"class=\"img-rounded\"> <br>";
				echo "<h4>$username</h4>";
				echo"</div>";
			}
		}	
	}catch (Exception $e){
		echo "Could not generate Recent Member list";
	}
	return true;
}
	

?>