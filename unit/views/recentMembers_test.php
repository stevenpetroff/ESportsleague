<?php
require_once('c:/Programs/simpletest/autorun.php');
require_once(dirname(__FILE__)."/../../WebContent/models/Database.class.php");
require_once(dirname(__FILE__)."/../models/makeTestDB.php");
require_once(dirname(__FILE__)."/../../WebContent/models/userProfileDB.class.php");
include_once(dirname(__FILE__)."/../../WebContent/controllers/profileController.php");


class profileTest extends UnitTestCase {
	function __construct() {
		parent::__construct();
	}
	
	function setUp() {
		makeTestDB('temp1');
	}
	
	
	function test_myprofile() {
		$profiles =  userProfileDB::getAll();
		require_once(dirname(__FILE__)."/../../WebContent/views/recentMembers.php");
		$_SESSION['userLoginStatus'] = "1";
		$this->assertTrue(printRecentMembers($profiles), "It should print out a list of recent members");
	}
}