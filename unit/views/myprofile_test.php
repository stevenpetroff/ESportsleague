<?php
require_once('c:/Programs/simpletest/autorun.php');
require_once(dirname(__FILE__)."/../../WebContent/models/Database.class.php");
require_once(dirname(__FILE__)."/../models/makeTestDB.php");
require_once(dirname(__FILE__)."/../../WebContent/models/userProfileDB.class.php");
include_once(dirname(__FILE__)."/../../WebContent/controllers/profileController.php");


class myProfileTest extends UnitTestCase {
	function __construct() {
		parent::__construct();
	}
	
	function setUp() {
		makeTestDB('temp1');
	}
	
	
	function test_myprofile() {
		$profile = getProfile("Spetty");
		require_once(dirname(__FILE__)."/../../WebContent/views/myprofile.php");
		$this->assert(showMyProfile($profile), "It should create a valid userData object but doesn't");
	}
}