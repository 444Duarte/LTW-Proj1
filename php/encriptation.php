<?php
	
	function encryptPassword($password, $cost) {

		if (defined("CRYPT_BLOWFISH") && CRYPT_BLOWFISH) {
	        $salt = '$2y$11$' . substr(md5(uniqid(rand(), true)), 0, 22);
	        return crypt($password, $salt);
    	}
	}

	function decryptPassword($password, $hashedPass) {
		return crypt($password, $hashedPass) == $hashedPass;
	}

?>