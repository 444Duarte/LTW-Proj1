<?php
	
	function encryptPassword($password, $cost) {

		$options = [ 'cost' => $cost ];

		$hash = password_hash($password, PASSWORD_BCRYPT);

		return $hash;
	}

	function decryptPassword($password, $hashedPass) {
		
		if (hash_equals($hashedPass, crypt($password, $hashedPass))) {
			return true;
		}
		else return false;
	}
?>