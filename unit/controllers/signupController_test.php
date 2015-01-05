<?php 

//should add a member profile
require_once('c:/Programs/simpletest/autorun.php');
require_once(dirname(__FILE__)."/../../WebContent/models/Database.class.php");
require_once(dirname(__FILE__)."/../../WebContent/models/userProfileDB.class.php");
require_once(dirname(__FILE__)."/../../WebContent/models/userDB.class.php");
require_once(dirname(__FILE__)."/../models/makeTestDB.php");
class signupController extends UnitTestCase {
	function __construct() {
		parent::__construct();
	}

	function setUp() {
		makeTestDB('temp1');
	}

	function test_signupController() {
		// Tests that loginController code can be executed
		$_SERVER["REQUEST_METHOD"] = "POST";
		$_POST = array(
				"userName"=> "NewUser",
				"userPassword"=>"abc123",
				"userProfileFirstName" => "New",
				"userProfileLastName" => "Profile",
				"userProfileEmail" => "new@email.com",
				"userProfilePhone" => "44444444444",
				"userProfileDOB" => "June 1982",
				"userProfileAvatar" => "dota2avatar",
				"userPassword"=> "abc123",
				"userName"=> "NewProfile",
				"userProfileGameList"=> Array ("csgo"),
				"userProfileFavColor"=>	"#000000"	
		);
		$myUser = 0;
		require(dirname(__FILE__)."/../../WebContent/controllers/signupController.php");
		$this->assertTrue(is_a($myUser, 'UserData'),
				"[It should create a UserData object but does not]");

	}
}
?>