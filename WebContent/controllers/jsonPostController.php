<?php 
include_once(dirname(__FILE__)."/../models/userProfileData.class.php");
include_once(dirname(__FILE__)."/../models/userProfileDB.class.php");
include_once(dirname(__FILE__)."/../models/userData.class.php");
include_once(dirname(__FILE__)."/../models/userDB.class.php");
include_once(dirname(__FILE__)."/../models/teamDB.class.php");
include_once(dirname(__FILE__)."/../models/Database.class.php");


	$reply = array();
	
    if (isset($_POST['userName']) && !empty($_POST['userName'])){ 
      	$reply['userName'] = $_POST['userName'];
      	if(!is_null(userDB::getUserByName($reply['userName'])))
      	  	$reply['exists'] = true;
      	else 
      	   	$reply['exists'] = false;
    }else if(isset($_POST['teamName']) && !empty($_POST['teamName'])){
    	$reply['teamName'] = $_POST['teamName'];
    	if(!is_null(teamDB::getTeamByName($reply['teamName'])))
    		$reply['exists'] = true;
    	else
    		$reply['exists'] = false;
    }else{
    	$reply['error']= 'invalid request';
    }

    echo json_encode($reply);

?>