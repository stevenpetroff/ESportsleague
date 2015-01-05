DROP DATABASE if EXISTS usrprofiledb5;
CREATE DATABASE usrprofiledb5;
USE usrprofiledb5;

DROP TABLE if EXISTS teamRoster;
CREATE TABLE teamRoster(
		teamRosterId		int AUTO_INCREMENT,
		m1					int NOT NULL,
		m2					int,
		m3					int,
		m4					int,
		m5					int,
		m6					int,
		m7					int,
		m8					int,
		PRIMARY KEY(teamRosterId)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE if EXISTS teamInfo;
CREATE TABLE teamInfo(
		teamInfoId			int AUTO_INCREMENT,
		teamGame			int NOT NULL,
		teamCaptain			int NOT NULL,
		teamWin				int,
		teamLoss			int,
		teamAvatar			varchar(256),
		teamColor			varchar(16),
		PRIMARY KEY(teamInfoId)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE if EXISTS team;
CREATE TABLE team(
		teamId				int AUTO_INCREMENT,
		teamName			varchar(64),
		teamRosterId		int,
		teamInfoId			int,
		PRIMARY KEY(teamId),
		FOREIGN KEY(teamRosterId) REFERENCES teamRoster(teamRosterId),
		FOREIGN KEY(teamInfoId) REFERENCES teamInfo(teamInfoId)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
        FOREIGN KEY (teamId) REFERENCES team(teamId),
        FOREIGN KEY (userId) REFERENCES users(userId)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
DROP TABLE IF EXISTS gamesMap;
CREATE TABLE gamesMap (
        gamesId             	   int,
        userProfileId		       int,
        FOREIGN KEY (userProfileId) REFERENCES userProfiles(userProfileId),
        FOREIGN KEY (gamesId) REFERENCES games(gamesId)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO games VALUES
      (1, 'csgo'), (2, 'lol'), (3, 'dota');
      
INSERT INTO teamInfo(teamInfoId,teamGame,teamCaptain) VALUES
      (1,99,1);
INSERT INTO teamRoster(teamRosterId,m1) VALUES
      (1,1);
INSERT INTO team(teamId,teamName) VALUES
      (1,'Free Agent');      


INSERT INTO teamInfo(teamInfoId,teamGame,teamCaptain,teamWin,teamLoss,teamAvatar,teamColor)
						VALUES(2,2,1,0,0,'none.jpg','blue');
                        
INSERT INTO teamRoster(teamRosterId,m1)
			VALUES(2,1);
            
INSERT INTO team(teamId,teamName,teamRosterId,teamInfoId)
						VALUES(2,'New Team',2,2);

UPDATE userProfiles SET teamId = "2" WHERE userProfileId = "1"