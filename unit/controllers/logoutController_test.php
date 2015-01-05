<?php
require_once('c:/Programs/simpletest/autorun.php');
require_once(dirname(__FILE__)."/../../WebContent/models/Database.class.php");
require_once(dirname(__FILE__)."/../models/makeTestDB.php");
class LoginControllerTest extends UnitTestCase {
	function __construct() {
		parent::__construct();
	}
	
	function setUp() {
		makeTestDB('temp1');
	}
	
	function test_runLoginControllerTest() {
		// Tests that loginController code can be executed
		$_SERVER["REQUEST_METHOD"] = "POST";
		$_SESSION['userLoginStatus'] = 1;
		$_SERVER['PHP_SELF']= "logoutController.php";
		$session = 0;
		require(dirname(__FILE__)."/../../WebContent/controllers/logoutController.php");
		$this->assertEqual($session,$_SESSION['userLoginStatus'],"[It should destroy a user session]");
	}
}
?>