<?php 

// Temporary code for trying out insert
$dsn = 'mysql:host=localhost;dbname=usrprofiledb';
$username = 'root';
$password = '';
$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
$db = new PDO($dsn, $username, $password, $options);
echo "<h1>Testing PDO before putting into code</h1>";

echo "<h3>Executing select all query to see what is in Database</h3>";
$query = "SELECT * FROM profile";
$statement = $db->prepare($query);
$statement->execute();

$profileRows = $statement->fetchAll();
foreach ($profileRows as $profileRow){
	echo("<p>");
	print_r($profileRow);
	echo "</p>";
}

echo"<hr><h3>Executing insert query</h3>";
$myParameters = array("username" => "Spaghetti", "firstname" => "potato",
		"lastname" => "johnson","dob" => "09/22/2222", "phonenumber" => "111-111-1111",
		"email"=> "potato@potato.us", "gamesplayed" => "CSGO,LOL" , "favcolor" => "green",
		"avatar" =>"csgoavatar");

$query = "INSERT INTO profile (username,firstname,lastname,dob,phonenumber,
								email, gamesplayed, favcolor, avatar)
					VALUES(:username, :firstname, :lastname, :dob, :phonenumber,
							:email, :gamesplayed, :favcolor, :avatar)";
$statement = $db->prepare($query);
$statement->execute($myParameters);

?>