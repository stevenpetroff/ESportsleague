<?php
require_once('c:/Programs/simpletest/autorun.php');
require_once(dirname(__FILE__)."/../../WebContent/models/Database.class.php");
require_once(dirname(__FILE__)."/../../WebContent/models/userDB.class.php");
require_once(dirname(__FILE__)."/../../WebContent/models/userData.class.php");
require_once(dirname(__FILE__)."/makeTestDB.php");
class userDBTest extends UnitTestCase {
	// Tester class for models/UserDB
	private $existingUser;
	function __construct() {
		parent::__construct();
		$existingUser = array("userName" => "Spetty", 
				              "userPasswordHash" => '$2y$10$C/JVkqLkuuxFUztJM/a4q.afDhUpOxkpp170Gf5ycfVC9lIl4DNHe');
	}
	
	function setUp() {
		makeTestDB('temp1');
	}
	
	function test_getUserByName() {
		// Tests getUserByName which tests to see whether an item is already in the database
		$name = "Spetty";
		$user = UserDB::getUserByName($name);
		$this->assertIsA($user, 'UserData', 
		   "It should return a UserData object for a valid user name");
		$name = "NotSteven";
		$user = UserDB::getUserByName($name);
		$this->assertNull($user, "It should return a null for invalid user name");
	}
	
	function test_getUserById() {
		// Tests getUserByName which tests to see whether an item is already in the database
		$name = "Spetty";
		$user = userDB::getUserById('1');
		$this->assertIsA($user, 'UserData',
				"It should return a UserData object for a valid user name");
		$actualName = $user->getUserName();
		$this->assertEqual($actualName, $name, 
				"It should have name $name but has name $actualName");
	}
	
}
?>