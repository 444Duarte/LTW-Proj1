<?php
	include_once('../database/connect.php');
	include_once('users.php');

	function printResponse($value) {
	    $data = ['register' => $value];
	    header('Content-Type: application/json');
	    echo json_encode($data);
	}

	$params = [ 'username', 'password' ];
	foreach ($params as $param) {
		if (isset($_POST[$param])) {
			$params[$param] = $_POST[$param];
			continue;
		}
	}
	if (!(register($params['username'], $params['password']))) {
		printResponse("user_exists");
	}
	else printResponse("success");
?>