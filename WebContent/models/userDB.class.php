<?php 
class userDB {

	public static function getUserById($id){
		$query = "SELECT * FROM users WHERE (userId = :userId)";
		$user = NULL;
		
		try{
			$db = Database::getDB();
			$statement= $db->prepare($query);
			$statement->bindParam(":userId",$id);
			$statement->execute();
			$userRows = $statement->fetch(PDO::FETCH_ASSOC);
			if(!empty($userRows))
				$user = new UserData($userRows);
			
			$statement->closeCursor();
		} catch (PDOException $e) {
			echo "Error getting user with id: " .$id;
		}
		return $user;
	}
	
	public static function getUserByName($name){
		$query = "SELECT * FROM users WHERE (userName = :userName)";
		$user = NULL;
	
		try{
			$db = Database::getDB();
			$statement = $db->prepare($query);
			$statement->bindParam(":userName",$name);
			$statement->execute();
			$userRows = $statement->fetch(PDO::FETCH_ASSOC);
			if(!empty($userRows))
				$user = new UserData($userRows);
			$statement->closeCursor();
		} catch (PDOException $e) {
			echo "Error getting user with name: " .$name;
		}
		return $user;
	}
	
	public static function authenticateUser($user) {
		if($user->getErrorCount() > 0)
			$user->setIsAuthenticated($false);
		else{
			$hash = userDB::getUserPasswordHash($user->getUserName());
			if(is_null($hash)){
				$user->setIsAuthenticated(false);
				$user->setError('userName', "User doesn't exist");
			} else {
				$verify = password_verify($user->getUserPassword(), $hash);
				if(!$verify)
					$user->setError('userPassword', "Invalid Password");
				$user->setIsAuthenticated($verify);
			}
		}
		return $verify;
	}
	
	public static function getUserPasswordHash($name){
		$query = "SELECT userPasswordHash FROM users WHERE (userName = :userName)";
		$hash = NULL;
		try{
			$db = Database::getDB();
			$statement = $db->prepare($query);
			$statement->bindParam(":userName", $name);
			$statement->execute();
			$userRows = $statement->fetch(PDO::FETCH_ASSOC);
			if(!empty($userRows))
				$hash = $userRows['userPasswordHash'];
			$statement->closeCursor();
		} catch ( PDOException $e){
			echo "<p>Error getting user password hash ".$e->getMessage()."</p>";
		}
		return $hash;
	}
}







?>