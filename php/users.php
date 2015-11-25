<?php

	include_once('connect.php');

	function compareLogin($user_given, $pass_given) {
		global $db;
		$stmt = $db->prepare('SELECT password FROM User WHERE user = :user_given;');
		$stmt->bindParam(:user, $user_given, PDO::PARAM_STR);
		$stmt->execute();

		$result = $stmt->fetch();

		if (count($result) === 0) {
			echo 'The username does not exist.\n';
			return false;
		}

		if ($pass_given !=== $result['password']) {
			echo 'The password does not match the username.\n';
			return false;
		}

		return true;
	}

	function register($user_given, $pass_given) {
		global $db;
		$stmt = $db->prepare('SELECT user FROM User WHERE user = :user_given;');
		$stmt->bindParam(:user, $user_given, PDO::PARAM_STR);

		$stmt->execute();

		$result = $stmt->fetch();

		if (count($result) === 0) {
			echo 'The username does not exit.\n';
			return false;
		}

		$stmt = $db->prepare('INSERT INTO User VALUES(:user_given, :pass_given);'); // o tradicional disse que nao precisava de mandar id, porque ele auto-incrementa :p
		$stmt->bindParam(:user, $user_given, PDO::PARAM_STR);
		$stmt->bindParam(:password, $pass_given, PDO::PARAM_STR);
		$stmt->execute();

		echo 'The user was created correctly.\n';
		return true;
	}

	function editPassword($user_given, $pass_given, $new_pass) {
		if ($pass_given === $new_pass) {
			echo 'The passwords are equal.\n';
			return false;
		}

		global $db;
		$stmt = $db->prepare('SELECT password FROM User WHERE user = :user_given');
		$stmt->bindParam(:user, $user_given, PDO::PARAM_STR);
		$stmt->execute();

		$result = $stmt->fetch();

		if (count($result) === 0) {
			echo 'The username does not exist.\n';
			return false;
		}

		if ($pass_given !=== $result['password']) {
			echo 'The password does not match the username.\n';
			return false;
		}

		$stmt = $db->prepare('UPDATE User SET password = :new_pass WHERE user = :user_given;');
		$stmt->bindParam(:user, $user_given, PDO::PARAM_STR);
		$stmt->execute();

		echo 'The password was updated.\n';
		return true;
		
	}
?>