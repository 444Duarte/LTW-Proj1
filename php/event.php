<?php
	session_start();
	include_once '../database/connect.php';
	include_once '../database/access_db.php';
	include_once 'json_response.php';


	$idUser = $_SESSION['user'];
	$idEvent = $_POST['event'];

	$request = $_POST['request'];

	switch ($request) {
		case 'get':
			if(getUserGoesToEvent($idUser, $idEvent)){
				printResponse("going", 'event');
			}elseif (userIsInvited($idUser, $idEvent)) {
				printResponse("not going", 'event');
			}else{
				printResponse("not invited", 'event');
			}
			break;

		case 'attend':
			$state = $_POST['state'];
			switch($state){
				case 'true':
					$state = true;
					break;
				case 'false':
					$state = false;
					break;
				default:
					printResponse(false, 'event');
					break;
			}
			$result = setUserGoesToEvent($idUser, $idEvent, $state);
			printResponse($result, "attend");
			break;
		default:
			printResponse(false, 'event');
			break;
	}
?>