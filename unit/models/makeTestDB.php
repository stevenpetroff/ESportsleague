<?php
require_once(dirname(__FILE__)."/../../WebContent/models/Database.class.php");
function makeTestDB($dbName = "temporary") {
	// Creates a database named $dbName for testing and returns connection
	$configPath = 'C:/xampp/myConfig.ini';
	$db = Database::getDB('', $configPath);
	try {
	   $db->query("DROP DATABASE if EXISTS $dbName;");
	   $db->query("CREATE DATABASE $dbName;");
	   $db->query("USE $dbName;");
	   
	    // Create the users table
	   $db->query("DROP TABLE IF EXISTS users");
	   $db->query("CREATE TABLE users (
	              userId   int(11) NOT NULL AUTO_INCREMENT,
	              userName varchar(64) COLLATE utf8_unicode_ci NOT NULL,
	   		      userPasswordHash varchar(255) COLLATE utf8_unicode_ci NOT NULL,
	              userDateCreated  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	   		      PRIMARY KEY (userId),
	              UNIQUE KEY (userName)
	              ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;");
	   
	    $db->query("DROP TABLE IF EXISTS userProfiles");
	    $db->query("CREATE TABLE userProfiles (
	                userProfileId       			int NOT NULL AUTO_INCREMENT,
			        userProfileFirstName        	varchar(42) NOT NULL,
			        userProfileLastName	     		varchar(42) NOT NULL,
			     	userProfileEmail	            varchar(60) NOT NULL,
			     	userProfilePhone	            varchar(24) NOT NULL,
					userProfileFavColor	        	varchar(24) NOT NULL,
			    	userProfileDOB	             	varchar(24) NOT NULL,
			    	userProfileAvatar	            varchar(128) NOT NULL,
			        teamId        		int ,
			        userId				int NOT NULL,
			        PRIMARY KEY(userProfileId),
			        UNIQUE KEY (userProfileEmail),
			        FOREIGN KEY (userId) REFERENCES users(userId)
	                ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;");
	    
	    // Create the games table
	    $db->query("DROP TABLE if EXISTS games;");
	    $db->query("CREATE TABLE games (
	    		     gamesId             int PRIMARY KEY AUTO_INCREMENT,
       				 gamesName           varchar (255)
                   )ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;");
	       
	   // Create the gamesMap table
	   $db->query("	DROP TABLE IF EXISTS gamesMap;"); 
	   $db->query("CREATE TABLE gamesMap (
	   		       	gamesId             		int,
			        userProfileId		       int,
			        FOREIGN KEY (userProfileId) REFERENCES userProfiles(userProfileId),
			        FOREIGN KEY (gamesId) REFERENCES games(gamesId)
                   )ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;");
	   
	   // Populate the user data in the database 
	   $userPasswordHash1 = password_hash("abc123", PASSWORD_DEFAULT);
	   $userPasswordHash2 = password_hash("abc456", PASSWORD_DEFAULT);
	   
	   // Populate the database
	   $db->query("	INSERT INTO users (userId, userName,  userPasswordHash) VALUES ".
	              "(1, 'Spetty', '".$userPasswordHash1. "');");   
	   $db->query("	INSERT INTO users (userId, userName,  userPasswordHash) VALUES ".
	              "(2, 'Spaghetti',  '".$userPasswordHash2."');");
	   $db->query("INSERT INTO userProfiles(userProfileFirstName,userProfileLastName,
	   		userProfileEmail,userProfilePhone,userProfileFavColor,userProfileDOB,
	   					userProfileAvatar,teamId, userId)
	   				VALUES (\"Steven\",
					\"Petroff\",\"stevenpetroff@gmail.com\",\"2222222222\",
					\"#000000\",\"September 1992\",\"csgoavatar\",\"0\",\"1\")");
	   $db->query("INSERT INTO userProfiles(userProfileFirstName,userProfileLastName,
	   					userProfileEmail,userProfilePhone,userProfileFavColor,userProfileDOB,
	   					userProfileAvatar,teamId, userId)
	   				VALUES(\"Steven\",
					\"Petroff\",\"stevenpetroff2@gmail.com\",\"2222222222\",
					\"#000000\",\"September 1992\",\"csgoavatar\",\"0\",\"2\")");
	   $db->query("	INSERT INTO games VALUES
      				(1, 'csgo'), (2, 'lol'), (3, 'dota');");
	   $db->query("INSERT INTO gamesMap (gamesId, userProfileId) VALUES
	              (1, 1), (2, 1), (1, 2), (2, 2),(3, 2);");
	   
	} catch ( PDOException $e ) {
	   	echo $e->getMessage ();  // not final error handling
	}
	  
	return $db;
}
?>