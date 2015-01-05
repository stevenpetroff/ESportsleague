DROP DATABASE if EXISTS usrprofiledb3;
CREATE DATABASE usrprofiledb3;
USE usrprofiledb3;

DROP TABLE if EXISTS teamMembers;
CREATE TABLE teamMembers(
		teamId		int PRIMARY KEY,
		teamCaptain	int
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE if EXISTS teamInfo;
CREATE TABLE teamInfo (
		teamId				int PRIMARY KEY,
		teamName			varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE if EXISTS teams;
CREATE TABLE teams (
        teamId              int PRIMARY KEY,
		teamInfoId			int,
		teamMembersId		int,
		FOREIGN KEY (teamMembersId) REFERENCES teamMembers(teamId),
		FOREIGN KEY (teamInfoId) REFERENCES teamInfo(teamId)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE if EXISTS games;
CREATE TABLE games (
        gamesId             int PRIMARY KEY AUTO_INCREMENT,
        gamesName           varchar (255)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS users;
CREATE TABLE users (
        userId   			int NOT NULL AUTO_INCREMENT,
        userName 			varchar(64) COLLATE utf8_unicode_ci NOT NULL,
        userPasswordHash 	varchar(255) COLLATE utf8_unicode_ci NOT NULL,
        userDateCreated TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (userId),
        UNIQUE KEY (userName)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS userProfiles;
CREATE TABLE userProfiles (
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
        FOREIGN KEY (userId) REFERENCES users(userId),
        FOREIGN KEY (teamId) REFERENCES teams(teamId)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
DROP TABLE IF EXISTS gamesMap;
CREATE TABLE gamesMap (
        gamesId             		int,
        userProfileId		       int,
        FOREIGN KEY (userProfileId) REFERENCES userProfiles(userProfileId),
        FOREIGN KEY (gamesId) REFERENCES games(gamesId)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO games VALUES
      (1, 'csgo'), (2, 'lol'), (3, 'dota');


INSERT INTO users(userId, userName, userPasswordHash) VALUES
	(1,'SpettySpaghetti','$2y$10$TmIMGqe3o5JSQBw9v05qZ.qdNUBj0F7yWt1KpuS4rTNNFkYHWxiku');    

	
INSERT INTO teamMembers(teamId, teamCaptain) VALUES (1,1);
INSERT INTO teamInfo(teamId, teamName) VALUES (1,'Spettys Spaghetties')	;	
INSERT INTO teams(teamId, teamInfoId,teamMembersId) VALUES (1,1,1);

	
	
INSERT INTO userProfiles(userProfileId, userProfileFirstName,userProfileLastName,userProfileEmail
	,userProfilePhone,userProfileFavColor,userProfileDOB,userProfileAvatar,teamId,userId)
	VALUES (1,'Steven','Petroff', 'stevenpetroff@gmail.com','2542452243','green','09/17/1992','csgo',1,1);
	
INSERT INTO gamesMap (gamesId, userProfileId) VALUES
	(1,1),(2,1),(3,1);


