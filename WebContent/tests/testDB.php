<?php
$dsn = 'mysql:host=localhost;dbname=usrprofiledb';
$username = 'root';
$password = '';
$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
$db = new PDO($dsn, $username, $password, $options);

$query = "SELECT * FROM profile";
$statement = $db->prepare($query);
$statement -> execute();

$profileRows = $statement->fetchAll();
print_r($profileRows);

echo "Did it";
?>