<?php
require_once('c:/Programs/simpletest/autorun.php');
require_once(dirname(__FILE__)."/../../WebContent/models/userData.class.php");
require_once(dirname(__FILE__)."/../../WebContent/models/Database.class.php");
require_once(dirname(__FILE__)."/makeTestDB.php");
class UserDataTest extends UnitTestCase {
	private $testData;
	
	function __construct() {
		parent::__construct();
		//makeTestDB('temp1');
	}
	
	function setUp() {
		$this->testData = array("userName" => "Spetty",
		                        "userPassword" => "potato");
	}
	
	function test_emptyUserData() {
		// Tests that an empty UserData object can be created
		$s1 = new UserData();
		$this->assertNotNull($s1, "UserData object $s1");
		$this->assertIsA($s1, 'UserData', "Should be a UserData object");
		$this->assertEqual($s1->getUserName(), "",
				"user name should be empty but is ".$s1->getUserName());
	}
	
	function test_validInput() {
        // Tests that a UserData object can be made when input is valid
		$s1 = new UserData($this->testData);
  		$this->assertNotNull($s1, "UserData object $s1");
  		$this->assertTrue(is_a($s1, 'UserData'), "Should be a UserData object");
		$this->assertEqual($s1->getUserName(), $this->testData['userName'],
		       "userName should be ".$this->testData['userName'].
				" but is ".$s1->getUserName());
	}
	
	function test_invalidPassword() {
		// Tests invalid passwords are detected
		$this->testData['userPasswordRetyped'] = 'ab';
		$s1 = new UserData($this->testData);
		$this->assertNotNull($s1, "UserData object $s1");
		$this->assertTrue(is_a($s1, 'UserData'), "Should be a UserData object");
		$errors = $s1->getErrorCount();
		$this->assertEqual($errors, 1, "It should have 1 error but has $errors");
	}
	
// 	function test_invalidUserName() {
// 		// Tests invalid user names are detected
// 		$this->testData['userName'] = '$ab';
// 		$s1 = new UserData($this->testData);
// 		$this->assertNotNull($s1, "UserData object $s1");
// 		$this->assertTrue(is_a($s1, 'UserData'), "Should be a UserData object");
// 		$errors = $s1->getErrorCount();
// 		$this->assertEqual($errors, 1, "It should have 1 error but has $errors");
// 	}
	
	function test_validUserNameDashes() {
		// Tests invalid user names are detected
		$this->testData['userName'] = '-a_b';
		$s1 = new UserData($this->testData);
		$this->assertNotNull($s1, "UserData object $s1");
		$this->assertTrue(is_a($s1, 'UserData'), "Should be a UserData object");
		$errors = $s1->getErrorCount();
		$this->assertEqual($errors, 0, "It should have no errors but has $errors");
	}
	
	function test_getParameters() {
		// Tests that UserData returns a valid array when no errors
		$s1 = new UserData($this->testData);
		$errorCount = $s1->getErrorCount();
		$this->assertEqual($errorCount, 0, 
				"It should have no errors for valid input, but has $errorCount errors");
		$params = $s1->getParameters();
		$this->assertEqual($params['userName'], $this->testData['userName'],
				"Returned userName should be ".$this->testData['userName']." but is ".
				$params['userName']);
	}
	
	function test_setError() {
		// Tests that an error message can be set appropriately
		$s1 = new UserData($this->testData);
		$errorCount = $s1->getErrorCount();
		$this->assertEqual($errorCount, 0,
				"It should have no errors for valid input, but has $errorCount errors");
		$thisError = 'User name is already in use';
		$s1->setError('userName', $thisError);
		$errorCount = $s1->getErrorCount();
		$this->assertEqual($errorCount, 1,
				"It should have 1 error, but has $errorCount errors");
		$setError = $s1->getError('userName');
		$this->assertEqual($setError, $thisError, 
		        "The error should have been $thisError but was $setError");
	}
	
}
?>