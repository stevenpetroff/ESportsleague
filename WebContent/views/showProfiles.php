<?php 

function showProfiles($profileList){
	
	foreach($profileList as $profile){
		print_r($profile);
		echo"<h1> ".$profile->getUserName()."'s Profile </h1>";
		echo"Name: ".$profile->getFirstName()." ".$profile->getLastName()." <br>";
		echo"Email: ".$profile->getEmail()."<br>";
		echo"Phone: ".$profile->getPhone()."<br>";
		echo"Avatar: ".$profile->getAvatar()."<br>";
		echo"Games Played:";
		$games = $profile->getGamesList();
		for($k = 0; $k < count($games);$k++)
			echo $games[$k]. " ";
		echo "<br>";
	}
}

?>