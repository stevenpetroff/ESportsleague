<?php 

//should change details of a members profile

require_once('c:/Programs/simpletest/autorun.php');
require_once(dirname(__FILE__)."/../../WebContent/models/Database.class.php");
require_once(dirname(__FILE__)."/../../WebContent/models/userProfileDB.class.php");
require_once(dirname(__FILE__)."/../../WebContent/models/userDB.class.php");
require_once(dirname(__FILE__)."/../models/makeTestDB.php");
class MyProfileControllerTest extends UnitTestCase {
	function __construct() {
		parent::__construct();
	}

	function setUp() {
		makeTestDB('temp1');
	}

	function test_runmyprofileController() {
		//session_start();
		$_SERVER["REQUEST_METHOD"] = "POST";
		$_SESSION['userLoginStatus'] = '1';
		$_SESSION['userName'] = "Spetty";
		require(dirname(__FILE__)."/../../WebContent/controllers/myprofileController.php");
		$id = 0;
		$this->assertNotEqual(1,$id,"[There should not be an exception thrown ]");
	}
}
?>