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
      	if(!is_null(userDB::getUserByName($reply['userName']))){
      	  	$reply['exists'] = true;
      	  	$userProfile = userProfileDB::getUserProfileByUserName($reply['userName']);
      		if($userProfile->getTeamId() == 1)
      			$reply['free'] = true;
      		else 
      			$reply['free'] = false;
      	}else 
      	   	$reply['exists'] = false;
    }else{
    	$reply['error']= 'invalid request';
    }

    echo json_encode($reply);

?>