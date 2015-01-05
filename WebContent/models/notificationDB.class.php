<?php 
include_once(dirname(__FILE__)."/../models/notificationData.class.php");
class notificationDB{
	
	
	function addNotification($noteData){
		$query = "INSERT INTO notification(userId,ntype,nvalue,nmsg) VALUES(:userId,:ntype,:nvalue,:nmsg)";
		$ret = 1;
		try{
			$db = Database::getDB();
			$db->beginTransaction();
			
			$userId = $noteData->getUserId();
			$type = $noteData->getNType();
			$value = $noteData->getNValue();
			$msg = $noteData->getNMsg();
			
			$statement = $db->prepare($query);
			
			$statement->bindValue(":userId",$userId);
			$statement->bindValue(":ntype",$type);
			$statement->bindValue(":nvalue",$value);
			$statement->bindValue(":nmsg",$msg);
			
			$statement->execute();
			$db->commit();
			
		}catch(Excepion $e){
			if( $e instanceof PDOException OR $e instanceof Exception)
				echo " Error adding notification: ".$e->getMessage()." id =".$userId;
			$db->rollback();
			$ret = -1;
		}
		
		return $ret;
	}
	
	function removeNotification($noteData){
		$ret = 1;
		try{
			$db = Database::getDB();
			$db->beginTransaction();
			$userId = $noteData->getUserId();
			$ntype = $noteData->getNType();
			$query = "DELETE FROM notification WHERE userId = $userId AND ntype = $ntype";
			
			$statement = $db->prepare($query);
			$statement->execute();
			$db->commit();
			
		}catch(Exception $e){
			if( $e instanceof PDOException OR $e instanceof Exception)
				echo " Error adding notification: ".$e->getMessage()." id =".$userId;
			$db->rollback();
			$ret = -1;
		}
		return $ret;
	}
	
	function removeNotificationById($userId,$ntype){
		$ret = 1;
		try{
			$db = Database::getDB();
			$db->beginTransaction();
			$query = "DELETE FROM notification WHERE userId = $userId AND ntype = $ntype";
			$statement = $db->prepare($query);
			$statement->execute();
			$db->commit();
		}catch(Exception $e){
			if( $e instanceof PDOException OR $e instanceof Exception)
				echo " Error adding notification: ".$e->getMessage()." id =".$userId;
			$db->rollback();
			$ret = -1;
		}
		return $ret;
	}
	
	public static function getNotificationArray($rowSets){
		$notifications = array();
		foreach($rowSets as $arow) {
			$note = new notificationData($arow);
			array_push($notifications, $note);
		}
		return $notifications;
	}
	
	function getNotificationsByUserId($userId){
		$query = "SELECT * FROM notification
				WHERE userId = :userId";
		$result = null;
		try{
			$db = Database::getDB();
			$statement = $db->prepare($query);
			$statement->bindParam(":userId",$userId);
			$statement->execute();
			$notes = $statement->fetchAll(PDO::FETCH_ASSOC);
			if(!isset($notes))
				return null;
			$result = notificationDB::getNotificationArray($notes);
			$statement->closeCursor();
		}catch(Exception $e){
			if( $e instanceof PDOException OR $e instanceof Exception)
				echo " Error adding notification: ".$e->getMessage()." id =".$userId;
			$db->rollback();
		}
		return $result;
	}
	
	
}











?>