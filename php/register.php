<?php
	include_once('../database/connect.php');
	include_once('users.php');
	include_once 'json_response.php';

	$params = [ 'username', 'password' ];
	foreach ($params as $param) {
		if (isset($_POST[$param])) {
			$params[$param] = $_POST[$param];
			continue;
		}
	}
	if (!(register(htmlentities($params['username']), $params['password']))) {
		printResponse("user_exists", "register");
	}
	else printResponse("success", "register");
?>