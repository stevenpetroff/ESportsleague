<?php
require_once ('c:/Programs/simpletest/autorun.php');
require_once (dirname ( __FILE__ ) . "/../../WebContent/models/gamesListDB.class.php");
require_once (dirname ( __FILE__ ) . "/../../WebContent/models/Database.class.php");
require_once (dirname ( __FILE__ ) . "/makeTestDB.php");
class gamesListDBTest extends UnitTestCase {
	// Tester class for models/CommentTagsDb
	function __construct() {
		parent::__construct ();
		makeTestDB ( 'temp1' );
	}
	
	function test_getArrayByName() {
		// Tests getArray with the commentTagName as the key
		$rowset = array (
				array (
						"gamesId" => 1,
						"gamesName" => "csgo" 
				),
				array (
						"gamesId" => 2,
						"gamesName" => "lol"
				),
				array (
						"gamesId" => 3,
						"gamesName" => "dota"
				)
		);
		$myArray = gamesListDB::getArray ( $rowset, "gamesName", "gamesId" );
		$this->assertEqual ( $myArray ['csgo'], 1, "Should return 1 for key of csgo but returned " . $myArray ['csgo'] );
		$this->assertEqual ( $myArray ['lol'], 2, "Should return 2 for key of lol but returned " . $myArray ['lol'] );
		$this->assertEqual ( $myArray ['dota'], 3, "Should return 3 for dota of lol but returned " . $myArray ['dota'] );
		
	}
	
	function test_getArrayById() {
		// Tests getArray with the commentTagId as the key
		$rowset = array (
				array (
						"gamesId" => 1,
						"gamesName" => "csgo"
				),
				array (
						"gamesId" => 2,
						"gamesName" => "lol"
				),
				array (
						"gamesId" => 3,
						"gamesName" => "dota"
				)
		);
		$myArray = gamesListDB::getArray ( $rowset, "gamesId", "gamesName" );
		$this->assertEqual ( $myArray ['1'], 'csgo', "Should return csgo for key of 1 but returned " . $myArray ['1'] );
		$this->assertEqual ( $myArray ['2'], 'lol', "Should return lol for key of 2 but returned " . $myArray ['2'] );
		$this->assertEqual ( $myArray ['3'], 'dota', "Should return dota for key of 3 but returned " . $myArray ['3'] );
	}
	
	function test_getMapById() {
		// Tests the getMap method for mapping commentTagId -> commentTagName
		$myArray = gamesListDB::getMap ( 'gamesId', 'gamesName' );
		$this->assertEqual ( $myArray ['1'], 'csgo', "Should return csgo for key of 1 but returned " . $myArray ['1'] );
		$this->assertEqual ( $myArray ['2'], 'lol', "Should return lol for key of 2 but returned " . $myArray ['2'] );
		$this->assertEqual ( $myArray ['3'], 'dota', "Should return dota for key of 3 but returned " . $myArray ['3'] );
	}
	
	function test_getNameById() {
		// Tests getNameById for a valid commentTagId
		$myName = gamesListDB::getNameById ( 1 );
		$this->assertEqual ( $myName, "csgo", "Should return csgo for key of 1 but returned " . $myName );
	}
	
	function test_getIdByName() {
		// Tests getIdByName for a valid commentTag
		$myName = "csgo";
		$myId = gamesListDB::getIdByName ( $myName );
		$this->assertEqual ( $myId, "1", "Should return 1 for name csgo but returned " . $myId );
	}
}
?>