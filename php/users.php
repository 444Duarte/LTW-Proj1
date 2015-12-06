<?php

	include_once('../database/connect.php');
	include_once('../database/access_db.php');
	include_once('encriptation.php');

	function compareLogin($user_given, $pass_given) {
		global $db;
		$stmt = $db->prepare('SELECT password FROM User WHERE user = :user_given');
		$stmt->bindParam(':user_given', $user_given, PDO::PARAM_STR);
		$stmt->execute();

		$result = $stmt->fetchAll();

		if (count($result) === 0) {
			return false;
		}

		return decryptPassword($pass_given, $result[0]['password']);
	}

	function register($user_given, $pass_given) {
		global $db;
		$stmt = $db->prepare('SELECT * FROM User WHERE user = :user_given');
		$stmt->bindParam(':user_given', $user_given, PDO::PARAM_STR);

		$stmt->execute();

		$result = $stmt->fetchAll();

		if (count($result) > 0) {
			return false;
		}

		$passEnc = encryptPassword($pass_given, 20);

		$stmt = $db->prepare('INSERT INTO User(user, password) VALUES(:user_given, :pass_given)'); // o tradicional disse que nao precisava de mandar id, porque ele auto-incrementa :p
		$stmt->bindParam(':user_given', $user_given, PDO::PARAM_STR);
		$stmt->bindParam(':pass_given', $passEnc, PDO::PARAM_STR);
		$stmt->execute();

		return true;
	}

	function editPassword($idUser, $pass_given, $new_pass) {
		if ($pass_given === $new_pass) {
			return false;
		}

		global $db;
		$stmt = $db->prepare('SELECT password FROM User WHERE idUser = :idUser');
		$stmt->bindParam(':idUser', $idUser, PDO::PARAM_STR);
		$stmt->execute();

		$result = $stmt->fetchAll();

		if (count($result) === 0) {
			return false;
		}

		if (!(decryptPassword($pass_given, $result[0]['password']))) {
			return false;
		}

		$passEnc = encryptPassword($new_pass, 20);

		$stmt = $db->prepare('UPDATE User SET password = :new_pass WHERE idUser = :idUser');
		$stmt->bindParam(':idUser', $idUser, PDO::PARAM_STR);
		$stmt->bindParam(':new_pass', $passEnc, PDO::PARAM_STR);
		$stmt->execute();

		return true;
	}

	function createEvent($idUser, $titleEvent, $date, $description, $img, $type, $private) {

		$idEventType = getidEventType($type)[0]['idEventType'];

		insertIntoEvent($titleEvent, $date, $description, $img, $type, $private, $idEventType);

		$idEvent = getidEvent($titleEvent)[0]['idEvent'];

		insertIntoAdminEvent($idUser, $idEvent);

		return true;
	}

	function editEvent($idUser, $idEvent, $titleEvent, $date, $description, $img, $type, $private) {

		global $db;

		$idEventType = getidEventType($type)[0]['idEventType'];

		$stmt = $db->prepare('UPDATE Event SET title = :titleEvent, eventDate = :date, description = :description, image = :img, private = :private, idEventType = :idEventType  WHERE idEvent = :idEvent');
		$stmt->bindParam(':titleEvent', $titleEvent, PDO::PARAM_STR);
		$stmt->bindParam(':date', $date, PDO::PARAM_STR);
		$stmt->bindParam(':description', $description, PDO::PARAM_STR);
		$stmt->bindParam(':img', $img, PDO::PARAM_STR);
		$stmt->bindParam(':private', $private, PDO::PARAM_BOOL);
		$stmt->bindParam(':idEventType', $idEventType, PDO::PARAM_INT);
		$stmt->bindParam(':idEvent', $idEvent, PDO::PARAM_INT);
		$stmt->execute();				

		return true;
	}

	function getidEventType($type) {
		global $db;
		$stmt = $db->prepare('SELECT * FROM EventType WHERE type = :type');
		$stmt->bindParam(':type', $type, PDO::PARAM_STR);
		$stmt->execute();
		$result = $stmt->fetchAll();

		return $result;
	}

	function getidEvent($titleEvent) {
		global $db;
		if ($stmt = $db->prepare('SELECT idEvent FROM Event WHERE titleEvent = :titleEvent')) {
			$stmt->bindParam(':titleEvent', $titleEvent, PDO::PARAM_STR);
			$stmt->execute();

			$result = $stmt->fetchAll();

			if (count($result) === 0) {
				return false;
			}
			return $result;
		}
		return false;
	}

	function insertIntoAdminEvent($idUser, $idEvent) {
		global $db;
		$stmt = $db->prepare('INSERT INTO AdminEvent(idUser, idEvent) VALUES(:idUser, :idEvent)');
		$stmt->bindParam(':idEvent', $idEvent, PDO::PARAM_INT);
		$stmt->bindParam(':idUser', $idUser, PDO::PARAM_INT);
		$stmt->execute();
		return true;
	}

	function insertIntoEvent($titleEvent, $date, $description, $img, $type, $private, $idEventType) {
		global $db;
		$stmt = $db->prepare('INSERT INTO Event(title, eventDate, description, image, private, idEventType) VALUES(:titleEvent, :date, :description, :img, :private, :idEventType)');
		$stmt->bindParam(':titleEvent', $titleEvent, PDO::PARAM_STR);
		$stmt->bindParam(':date', $date, PDO::PARAM_STR);
		$stmt->bindParam(':description', $description, PDO::PARAM_STR);
		$stmt->bindParam(':img', $img, PDO::PARAM_STR);
		$stmt->bindParam(':private', $private, PDO::PARAM_BOOL);
		$stmt->bindParam(':idEventType', $idEventType, PDO::PARAM_INT);
		$stmt->execute();

		return true;
	}

	function commentEvent($user_given, $titleEvent, $comm) {
		global $db;
		$stmt = $db->prepare('SELECT idUser FROM User WHERE user = :user_given');
		$stmt->bindParam(':user_given', $user_given, PDO::PARAM_STR);
		$stmt->execute();

		$result = $stmt->fetchAll();

		if (count($result) === 0) {
			return false;
		}

		$idUser = $result[0]['idUser'];

		$stmt = $db->prepare('SELECT idEvent FROM Event WHERE titleEvent = :titleEvent');
		$stmt->bindParam(':titleEvent', $titleEvent, PDO::PARAM_STR);
		$stmt->execute();

		$result = $stmt->fetchAll();

		if (count($result) === 0) {
			return false;
		}

		$idEvent = $result[0]['idEvent'];

		$stmt = $db->prepare('SELECT idUser FROM GoToEvent WHERE idEvent = :idEvent');
		$stmt->bindParam(':idEvent', $idEvent, PDO::PARAM_INT);
		$stmt->execute();

		$GoEvent = false; //se vai

		if (count($result) === 0) {
			return false;
		}

		foreach($result as $row) {
			if ($row['idUser'] === $idUser) {
				$GoEvent = true;
			}
		}

		if ($GoEvent === false) {
			return false;
		}

		$stmt = $db->prepare('SELECT idUser FROM AdminEvent WHERE idEvent = :idEvent');
		$stmt->bindParam(':idEvent', $idEvent, PDO::PARAM_INT);
		$stmt->execute();

		$adEvent = false; //se e admin

		if (count($result) === 0) {
			return false;
		}

		foreach($result as $row) {
			if ($row['idUser'] === $idUser) {
				$adEvent = true;
			}
		}

		if ($adEvent === false) {
			return false;
		}

		$stmt = $db->prepare('INSERT INTO Comment(idUser, idEvent, comentario) VALUES(, :idUser, :idEvent, :comm)');
		$stmt->bindParam(':idUser', $idUser, PDO::PARAM_INT);
		$stmt->bindParam(':idEvent', $idEvent, PDO::PARAM_INT);
		$stmt->bindParam(':comm', $comm, PDO::PARAM_STR);
		$stmt->execute();

		return true;
	}

	function registerEvent($user_given, $titleEvent) {
		global $db;
		$stmt = $db->prepare('SELECT idEvent FROM Event WHERE titleEvent = :titleEvent');
		$stmt->bindParam(':titleEvent', $titleEvent, PDO::PARAM_INT);
		$stmt->execute();

		$result = $stmt->fetchAll();

		if (count($result) === 0) {
			return false;
		}

		$idEvent = $result[0]['idEvent'];

		$stmt = $db->prepare('SELECT idUser FROM User WHERE user_given = :user_given');
		$stmt->bindParam(':user_given', $user_given, PDO::PARAM_STR);
		$stmt->execute();

		$result = $stmt->fetchAll();

		if (count($result) === 0) {
			return false;
		}

		$idUser = $result[0]['idUser'];

		$stmt = $db->prepare('INSERT INTO GoToEvent(idUser, idEvent) VALUES(:idUser, :idEvent)');
		$stmt->bindParam(':idUser', $idUser, PDO::PARAM_INT);
		$stmt->bindParam(':idEvent', $idEvent, PDO::PARAM_INT);
		$stmt->execute();

		return true;
	}

	function deleteEvent($user_given, $titleEvent) {
		global $db;
		$stmt = $db->prepare('SELECT idEvent FROM Event WHERE titleEvent = :titleEvent');
		$stmt->bindParam(':titleEvent', $titleEvent, PDO::PARAM_INT);
		$stmt->execute();

		$result = $stmt->fetchAll();

		if (count($result) === 0) {
			return false;
		}

		$idEvent = $result[0]['idEvent'];

		$stmt = $db->prepare('SELECT idUser FROM User WHERE user_given = :user_given');
		$stmt->bindParam(':user_given', $user_given, PDO::PARAM_STR);
		$stmt->execute();

		$result = $stmt->fetchAll();

		if (count($result) === 0) {
			return false;
		}

		$idUser = $result[0]['idUser'];

		$stmt = $db->prepare('DELETE FROM Comment WHERE idEvent = :idEvent');
		$stmt->bindParam(':idEvent', $idEvent, PDO::PARAM_INT);
		$stmt->execute();

		$result = $stmt->fetchAll();


		$stmt = $db->prepare('DELETE FROM GoToEvent WHERE idUser = :idUser AND idEvent = :idEvent');
		$stmt->bindParam(':idUser', $idUser, PDO::PARAM_INT);
		$stmt->bindParam(':idEvent', $idEvent, PDO::PARAM_INT);
		$stmt->execute();

		$stmt = $db->prepare('DELETE FROM AdminEvent WHERE idUser = :idUser AND idEvent = :idEvent');
		$stmt->bindParam(':idUser', $idUser, PDO::PARAM_INT);
		$stmt->bindParam(':idEvent', $idEvent, PDO::PARAM_INT);
		$stmt->execute();

		$stmt = $db->prepare('DELETE FROM EventType WHERE idEvent = :idEvent');
		$stmt->bindParam(':idEvent', $idEvent, PDO::PARAM_INT);
		$stmt->execute();

		$stmt = $db->prepare('DELETE FROM Event WHERE idEvent = :idEvent');
		$stmt->bindParam(':idEvent', $idEvent, PDO::PARAM_INT);
		$stmt->execute();

		return true;
	}
	
	function search($titleEvent) {
		global $db;
		$stmt = $db->prepare('SELECT * FROM Event where title = :title');
		$stmt->bindParam(':title', $titleEvent, PDO::PARAM_STR);
		$stmt->execute();
		$result = $stmt->fetchAll();

		if (count($result) === 0 || count($result) > 1) {
			return false;
		}

		return true;
	}

	function returnEventOfUser($idUser, $idEvent) {
		global $db;
		$result = getEventById($idEvent);

		//e privado
		if ($result[0]['private']) {
			$stmt = $db->prepare('SELECT * FROM InvitedTo WHERE idEvent = :idEvent AND idUser = :idUser');
			$stmt->bindParam(':idUser', $idUser, PDO::PARAM_INT);
			$stmt->bindParam(':idEvent', $idEvent, PDO::PARAM_INT);
			$stmt->execute();
			$res = $stmt->fetchAll();

			if (count($res) > 0)
				return $result[0];

			return false;
		}
		else return $result[0];
	}

	function checkAdminByID($idUser) {
		global $db;

		$stmt = $db->prepare('SELECT * FROM AdminEvent WHERE idUser = :idUser');
		$stmt->bindParam(':idUser', $idUser, PDO::PARAM_INT);
		$stmt->execute();

		$result = $stmt->fetchAll();

		if (count($result) === 0) {
			return false;
		}
		return true;
	}
	
?>