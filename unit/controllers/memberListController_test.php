<?php
require_once('c:/Programs/simpletest/autorun.php');
require_once(dirname(__FILE__)."/../../WebContent/models/userProfileDB.class.php");
require_once(dirname(__FILE__)."/../../WebContent/models/userProfileData.class.php");
require_once(dirname(__FILE__)."/../../WebContent/models/Database.class.php");
require_once(dirname(__FILE__)."/../../WebContent/views/memberlist.php");
require_once(dirname(__FILE__)."/../models/makeTestDB.php");
class MemberListControllerTest extends UnitTestCase {
	function __construct() {
		parent::__construct();
	}
	
	function setUp() {
		makeTestDB('temp1');
	}
	
	function test_runMemberListControllerTest() {
		$myProfiles = 0;
		require(dirname(__FILE__)."/../../WebContent/controllers/memberListController.php");
		$this->assertTrue(isset($myProfiles), 
				"[It should create an array of userProfileData but does not]");
	}
}
?>