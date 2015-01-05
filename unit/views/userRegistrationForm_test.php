<?php
require_once('c:/Programs/simpletest/autorun.php');
require_once(dirname(__FILE__)."/../../WebContent/models/Database.class.php");
require_once(dirname(__FILE__)."/../models/makeTestDB.php");
require_once(dirname(__FILE__)."/../../WebContent/models/userProfileDB.class.php");
include_once(dirname(__FILE__)."/../../WebContent/controllers/profileController.php");


class userRegistrationFormTest extends UnitTestCase {
	function __construct() {
		parent::__construct();
	}
	
	function setUp() {
		makeTestDB('temp1');
	}
	
	
	function test_myprofile() {
		$profile = getProfile("Spetty");
		require_once(dirname(__FILE__)."/../../WebContent/views/userRegistrationForm.php");
		$this->assertTrue(userRegistrationForm($profile), "It should create a valid userData object but doesn't");
	}
}