<?php
require_once('c:/Programs/simpletest/autorun.php');
require_once(dirname(__FILE__)."/../../WebContent/views/memberlist.php");
require_once(dirname(__FILE__)."/../../WebContent/models/userProfileData.class.php");
require_once(dirname(__FILE__)."/../../WebContent/models/userData.class.php");


class LoginFormTest extends UnitTestCase {
	function __construct() {
		parent::__construct();
	}

	function test_authenticatedMemberList() {
		$_SESSION('userLoginStatus') = 1;
		$_SESSION('userName') = "Spetty";
		require(diename(__FILE__)."/../../WebContent/controllers/profileController.php");
		$myProfiles = userProfileDB::getAll();
		$this->assert(printMemberProfileList($myProfiles), "It should create a valid userData object but doesn't");

	}
}