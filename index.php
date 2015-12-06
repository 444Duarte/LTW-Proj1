<?php
	session_start();

	$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

	if (count($_SESSION) === 0) {
		header('Location: ' . $url . 'login.html');
	}
	else {
		header('Location:' . $url . 'mainpage.php');
	}
?>