<?php
require_once('c:/Programs/simpletest/autorun.php');
require_once(dirname(__FILE__)."/../../WebContent/views/menu.php");

class MenuTest extends UnitTestCase {
	function __construct() {
		parent::__construct();
	}
	
	function test_menu() {
			//$_SESSION('userLoginStatus') = 0;
			$e=0;
			showMenu();
			$this->assertNotNull($e,"It should not throw an exception");
	}
}