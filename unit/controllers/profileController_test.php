<?php
require_once('c:/Programs/simpletest/autorun.php');
require_once(dirname(__FILE__)."/../../WebContent/models/userProfileDB.class.php");
require_once(dirname(__FILE__)."/../../WebContent/models/userProfileData.class.php");
require_once(dirname(__FILE__)."/../../WebContent/models/Database.class.php");
require_once(dirname(__FILE__)."/../models/makeTestDB.php");
class profileControllerTest extends UnitTestCase {
	function __construct() {
		parent::__construct();
	}
	
	function setUp() {
		makeTestDB('temp1');
	}
	
	function test_profileController_getAllProfilesTest() {
		require(dirname(__FILE__)."/../../WebContent/controllers/profileController.php");
		$this->assertTrue(getAllProfiles(),"[It should create a userProfileData but does not]");
	}
	function test_profileController_getProfileTest(){
		$user = "Spetty";
		$this->assertNotNull(getProfile($user),"[It should create a userProfileData but does not]");
	}
	
	function test_test_profileControllergetRecentMembersTest(){
		$this->assertTrue(getRecentMemberProfiles(),"[It should create a userProfileData but does not]");
	}
}
?>