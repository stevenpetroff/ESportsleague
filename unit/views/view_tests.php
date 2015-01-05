<?php
require_once('c:/Programs/simpletest/autorun.php');
class ViewTests extends TestSuite {
	function __construct() {
		parent::__construct();
   		$this->addFile ( __DIR__."/login_test.php" );
   		$this->addFile ( __DIR__."/memberlist_test.php" );
   		$this->addFile ( __DIR__."/menu_test.php" );
   		$this->addFile ( __DIR__."/myprofile_test.php" );
   		$this->addFile ( __DIR__."/profile_test.php" );
   		$this->addFile ( __DIR__."/recentMembers_test.php" );
   		$this->addFile ( __DIR__."/showProfiles_test.php" );
   		$this->addFile ( __DIR__."/showUsers_test.php" );
   		$this->addFile ( __DIR__."/userRegistrationForm_test.php" );
	}
}
?>