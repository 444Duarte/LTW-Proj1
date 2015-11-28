<?php
	include_once('../database/connect.php');
	include_once('users.php');

	function printResponse($value) {
	    $data = ['login' => $value];
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
	if (!(compareLogin($params['username'], $params['password']))) {
		printResponse("wrong_login");
	}
	else printResponse("success");
?>