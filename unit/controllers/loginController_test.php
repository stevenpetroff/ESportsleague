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
		$_SERVER['PHP_SELF']= "loginController.php";
		$_POST = array("userName" => "Spetty",
		               "userPassword" => "abc123");
		$profile = 0;
		require(dirname(__FILE__)."/../../WebContent/controllers/loginController.php");
		$this->assertNotNull($profile,"[It should create a UserData object but does not]");
	}
}
?>