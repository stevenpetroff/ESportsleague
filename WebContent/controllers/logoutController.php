<?php 
session_start();
try{
	session_destroy();
	$_SESSION['userLoginStatus'] = 0;
	header("Location: ../index.php");
}catch(Exception $e){
	echo " Could not destroy session.";
}

?>