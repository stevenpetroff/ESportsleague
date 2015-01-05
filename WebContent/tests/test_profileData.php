<?php
include_once("../models/profileData.class.php");
echo "<h1>Tests for CommentData class</h1>";

echo "<h2>It should create a valid object when all input is provided</h2>";


$validTest =  array(
		"username" => "SpaghettiTest", 
		"firstname" => "potatoTest",
		"lastname" => "johnsonTest",
		"dob" => "09/22/2222", 
		"phonenumber" => "111-111-1111",
		"email"=> "potato@potato.us", 
		"gamesplayed" => array("potato","yes","ss"), 
		"favcolor" => "green",
		"avatar" =>"/potatos.jpg");

$s1 = new profileData($validTest);
$s1->printProfile();

echo "<h2>It should extract the parameters that went in</h2>";
$props = $s1->getParameters();
print_r($props);
echo "<br>";
?>