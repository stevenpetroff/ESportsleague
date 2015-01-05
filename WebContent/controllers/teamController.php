<?php 
include_once(dirname(__FILE__)."/../models/Database.class.php");
include_once(dirname(__FILE__)."/../models/teamDB.class.php");
include_once(dirname(__FILE__)."/../models/rosterBuilder.class.php");
include_once(dirname(__FILE__)."/../views/team.php");
include_once(dirname(__FILE__)."/../views/teamList.php");
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

function getTeamList(){
	try{
		$teams = teamDB::getAll();
		$captains = rosterBuilder::buildCaptainRosterFromIds($teams);
		printTeamList($teams,$captains);
	}catch(Exception $e){
		echo"Exception:".$e->getMessage();
	}
}

function getTeamByName($name){
	$team = null;
	try{
		$team = teamDB::getTeamByName($name);
		//$roster = rosterBuilder::buildRosterFromIds($team->getTeamMembers());
		//printTeam($team,$roster);
	}catch(Exception $e){
		echo " could not get team ".$e->getMessage();
	}
	return $team;
}
function getRosterByTeam($team){
	$roster = null;
	try{
		$roster = rosterBuilder::buildRosterFromIds($team->getTeamMembers());
	}catch(Exception $e){
		echo " could not get team ".$e->getMessage();
	}
	return $roster;
}



?>