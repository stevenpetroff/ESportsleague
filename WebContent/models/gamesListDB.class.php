<?php 

class gamesListDB {
	
	
	public static function getMap($keyName, $valueName){
		$query = "SELECT * 
					FROM games";
	
		$games = array();
		try{
			$db = Database::getDB();
			$statement = $db->prepare($query);
			$statement->execute();
			$rowsets = $statement->fetchAll(PDO::FETCH_ASSOC);
			$games = gamesListDB::getArray($rowsets,$keyName,$valueName);
			$statement->closeCursor();
		} catch(PDOException $e){
			echo "<p>Error getting map of $keyName to $valueName ". $e->getMessage()."</p>";
		}
		return $games;
	}
	
	public static function getNameById ($Id) {
		// Returns the name given id or null if no item exists
		$Id = strval($Id);
		$query = "SELECT gamesName
				     FROM games
			         WHERE gamesId = :Id";
		$name = null;
		try {
			$db = Database::getDB ();
			$statement = $db->prepare($query);
			$statement->bindParam(":Id", $Id); // Only binds at execute time
			$statement->execute();
			$results = $statement->fetchAll(PDO::FETCH_ASSOC);
			$name = $results[0]['gamesName'];
			$statement->closeCursor();
	
		} catch ( PDOException $e ) { // Not permanent error handling
			echo "<p>Error getting name from $id ".$e->getMessage()."</p>";
		}
		return $name;
	}
	
	public static function getIdByName ($name) {
	// Returns the id given name or null if no item exists
		$query = "SELECT gamesId FROM games
				     WHERE gamesName = :name";
		$id = null;
		try {
		$db = Database::getDB ();
		$query = 'SELECT gamesId
					     FROM games
					     WHERE gamesName = :name';
			$statement = $db->prepare($query);
				$statement->bindParam(":name", $name); // Only binds at execute time
		$statement->execute();
		$results = $statement->fetchAll(PDO::FETCH_ASSOC);
		$id = $results[0]['gamesId'];
		$statement->closeCursor();
	
		} catch ( PDOException $e ) { // Not permanent error handling
			echo "<p>Error getting ID from $name ".$e->getMessage()."</p>";
		}
		return $id;
	}
	
	
	public static function getArray($rowset, $keyName, $valueName) {
		// Returns an associative array from $rowset based on item names
		$index = array();
		for ($k = 0; $k < count($rowset); $k++) {
			$item = $rowset[$k];
			$key = strval($item[$keyName]);
			$value = $item[$valueName];
			$index[$key] = strtolower($value);
		}
		return $index;
	}
}
?>