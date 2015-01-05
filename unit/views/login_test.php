<?php
require_once('c:/Programs/simpletest/autorun.php');
require_once(dirname(__FILE__)."/../../WebContent/views/login.php");
require_once(dirname(__FILE__)."/../../WebContent/models/userProfileData.class.php");
require_once(dirname(__FILE__)."/../../WebContent/models/userData.class.php");


class LoginFormTest extends UnitTestCase {
	function __construct() {
		parent::__construct();
	}

	function test_loginForm() {
		$validTest1 = array("userName" => "Spetty",
				"userPassword" => "potato");
		$s1 = new userData($validTest1);
		$this->assertIsA($s1, 'UserData', "It should create a valid userData object but doesn't");
		try {
			loginForm($s1);
		} catch (Exception $e) {
			$this->assertTrue(0, "It should not throw exception on a UserData object");
		}
	}
}