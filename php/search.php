<?php
	include_once('connect.php');
	include_once('users.php');

	function printResponse($value) {
	    $data = ['search' => $value];
	    header('Content-Type: application/json');
	    echo json_encode($data);
	}

	$params = ['search'];
	foreach ($params as $param) {
		if (isset($_POST[$param])) {
			$params[$param] = $_POST[$param];
			continue;
		}
	}
	if (!(search($params['search']))) {
		printResponse("wrong_search");
	}
	else printResponse("success");
?>