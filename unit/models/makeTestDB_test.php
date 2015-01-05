<?php
require_once('c:/Programs/simpletest/autorun.php');
require_once(dirname(__FILE__)."/makeTestDB.php");

class MakeTestDBTest extends UnitTestCase {
	// Tester class for makeTestDB 
	function test_temporary() {
		
		// Tests making of a database called temp
		$db = makeTestDB("temporary");
		$this->assertNotNull($db, "Connection should not be null");
	}
}
?>
