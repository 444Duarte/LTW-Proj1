<?php
	session_start();
	include_once '../database/connect.php';
	include_once '../database/access_db.php';
	include_once 'json_response.php';


	$idUser = $_SESSION['user'];
	$idEvent = $_POST['event'];

	$request = $_POST['request'];

	switch ($request) {
		case 'request':
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

			//TODO FAZER O UTILIZADOR IR PARA O EVENTO
		default:
			printResponse(false, 'event');
			break;
	}
?>