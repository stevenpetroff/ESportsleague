<?php
// Temporary code for trying out select
$dsn = 'mysql:host=localhost;dbname=usrprofiledb';
$username = 'root';
$password = '';
$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
$db = new PDO($dsn, $username, $password, $options);
echo "<h1>Testing PDO before putting into code</h1>";

echo "<h3>Executing select all query to see if a user is in the database</h3>";
$query = "SELECT * FROM profile WHERE username = :username";
$statement = $db->prepare($query);
$myParameters = array("username" => "Spaghetti", "firstname" => "potato",
		"lastname" => "johnson","dob" => "09/22/2222", "phonenumber" => "111-111-1111",
		"email"=> "potato@potato.us", "gamesplayed" => "CSGO,LOL" , "favcolor" => "green",
		"avatar" =>"/potatos.jpg");
$username = "Spaghetti";
$statement->bindParam(":username", $username); // Only binds at execute time
$statement->execute();

$profileRows = $statement->fetchAll();
foreach ( $profileRows as $profileRow ) {
	echo ("<p>");
	print_r ( $profileRow ); // Just temporary
	echo "</p>"; // Just temporary
}
echo "Number of rows: ". count($profileRows);
?> 