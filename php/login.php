<?php
	include_once('connect.php');
	include_once('users.php');

	$params;
	foreach ($params as $param) {
		if (isset($_POST[$param])) {
			$params[$param] = $_POST[$param];
			continue;
		}
	}
	compareLogin($params['username'], $params['password']);
?>