<?php

	include_once('connect.php');
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
		/*
		if (!($pass_given === $result[0]['password'])) {
			return false;
		}

		return true;
		*/		
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

	function editPassword($user_given, $pass_given, $new_pass) {
		if ($pass_given === $new_pass) {
			echo 'The passwords are equal.\n';
			return false;
		}

		global $db;
		$stmt = $db->prepare('SELECT password FROM User WHERE user = :user_given');
		$stmt->bindParam(':user_given', $user_given, PDO::PARAM_STR);
		$stmt->execute();

		$result = $stmt->fetchAll();

		if (count($result) === 0) {
			return false;
		}

		if (!($pass_given === $result['password'])) {
			return false;
		}

		$stmt = $db->prepare('UPDATE User SET password = :new_pass WHERE user = :user_given');
		$stmt->bindParam(':user_given', $user_given, PDO::PARAM_STR);
		$stmt->bindParam(':new_pass', $new_pass, PDO::PARAM_STR);
		$stmt->execute();

		return true;
	}

	function createEvent($user_given, $titleEvent, $date, $description, $img, $type) {
		global $db;
		$stmt = $db->prepare('INSERT INTO Event(title, datadoEvento, descricao, image) VALUES(:titleEvent, :date, :description, :img)');
		$stmt->bindParam(':titleEvent', $titleEvent, PDO::PARAM_STR);
		$stmt->bindParam(':date', $date, PDO::PARAM_STR);
		$stmt->bindParam(':description', $description, PDO::PARAM_STR);
		$stmt->bindParam(':img', $img, PDO::PARAM_STR);
		$stmt->execute();

		$stmt = $db->prepare('SELECT idEvent FROM Event WHERE titleEvent = :titleEvent');
		$stmt->bindParam(':titleEvent', $titleEvent, PDO::PARAM_STR);
		$stmt->execute();

		$result = $stmt->fetchAll();

		if (count($result) === 0) {
			return false;
		}
		$idEvent = $result['idEvent'];

		$stmt = $db->prepare('SELECT idUser FROM User WHERE user_given = :user_given');
		$stmt->bindParam(':user_given', $user_given, PDO::PARAM_STR);
		$stmt->execute();

		$result = $stmt->fetchAll();

		if (count($result) === 0) {
			return false;
		}

		$idUser = $result['idUser'];

		$stmt = $db->prepare('INSERT INTO EventType(idEvent, type) VALUES(:idEvent, :type)');
		$stmt->bindParam(':type', $type, PDO::PARAM_STR);
		$stmt->bindParam(':idEvent', $idEvent, PDO::PARAM_INT);
		$stmt->execute();

		$stmt = $db->prepare('INSERT INTO AdminEvent(idUser, idEvent) VALUES(:idUser, :idEvent)');
		$stmt->bindParam(':idEvent', $idEvent, PDO::PARAM_INT);
		$stmt->bindParam(':idUser', $idUser, PDO::PARAM_INT);
		$stmt->execute();

		$stmt = $db->prepare('INSERT INTO GoToEvent(idUser, idEvent) VALUES(:idUser, :idEvent)');
		$stmt->bindParam(':idEvent', $idEvent, PDO::PARAM_INT);
		$stmt->bindParam(':idUser', $idUser, PDO::PARAM_INT);
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

		$idUser = $result['idUser'];

		$stmt = $db->prepare('SELECT idEvent FROM Event WHERE titleEvent = :titleEvent');
		$stmt->bindParam(':titleEvent', $titleEvent, PDO::PARAM_STR);
		$stmt->execute();

		$result = $stmt->fetchAll();

		if (count($result) === 0) {
			return false;
		}

		$idEvent = $stmt['idEvent'];

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

		$idEvent = $result['idEvent'];

		$stmt = $db->prepare('SELECT idUser FROM User WHERE user_given = :user_given');
		$stmt->bindParam(':user_given', $user_given, PDO::PARAM_STR);
		$stmt->execute();

		$result = $stmt->fetchAll();

		if (count($result) === 0) {
			return false;
		}

		$idUser = $result['idUser'];

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

		$idEvent = $result['idEvent'];

		$stmt = $db->prepare('SELECT idUser FROM User WHERE user_given = :user_given');
		$stmt->bindParam(':user_given', $user_given, PDO::PARAM_STR);
		$stmt->execute();

		$result = $stmt->fetchAll();

		if (count($result) === 0) {
			return false;
		}

		$idUser = $result['idUser'];

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

	function editEvent($titleEvent, $date, $description, $img, $type, $user_given) {

		if (!(deleteEvent($user_given, $titleEvent))) {
			echo 'Cannot edit event.';
			return false;
		}

		if (!(createEvent($user_given, $titleEvent, $date, $description, $img, $type))) {
			echo 'Cannot edit event.';
			return false;
		}

		return true;
	}
	
?>