<?php
require_once('c:/Programs/simpletest/autorun.php');
class ControllerTests extends TestSuite {
	function __construct() {
		parent::__construct();
		$this->addFile ( __DIR__."/loginController_test.php" );
		$this->addFile ( __DIR__."/logoutController_test.php" );
		$this->addFile ( __DIR__."/memberListController_test.php" );
		$this->addFile ( __DIR__."/myprofileController_test.php" );
		$this->addFile ( __DIR__."/profileController_test.php" );
		$this->addFile ( __DIR__."/signupController_test.php" );
		
	}
}
?>