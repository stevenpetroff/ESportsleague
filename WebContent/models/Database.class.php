<?php 
//Responsibility: maintains open DB connection (singleton)
class Database {
	private static $db;
	private static $dsn = 'mysql:host=localhost;dbname=';
	private static $dbName = 'usrprofiledb';
	private static $options = array (
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
	);


	public static function getDB($dbName = 'usrprofiledb', $configPath ="/../../../myConfig.ini") {
		if (! isset ( self::$db )) {
			try {
				$passArray = parse_ini_file($configPath);
				$username = $passArray["username"];
				$password = $passArray["password"];
				self::$dbName = $dbName;
				$dbspec = self::$dsn.self::$dbName.";charset=utf8";
				self::$db = new PDO ( $dbspec, $username, $password, self::$options );
			} catch ( PDOException $e ) {
				echo $e->getMEssage ();
			}
		}
		return self::$db;
	}
}
?>

