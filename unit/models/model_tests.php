<?php
require_once('c:/Programs/simpletest/autorun.php');
class ModelTests extends TestSuite {
	function __construct() {
		parent::__construct();
		$this->addFile ( __DIR__."/Database_test.php" );
		$this->addFile ( __DIR__."/gameListDB_test.php" );
		$this->addFile ( __DIR__."/profileDB_test.php" );
		$this->addFile ( __DIR__."/userData_test.php" );
		$this->addFile ( __DIR__."/userDB_test.php" );
		$this->addFile ( __DIR__."/userProfileData_test.php" );
		$this->addFile ( __DIR__."/userProfileDB_test.php" );
	}
}
?>