<?php
	include_once '../database/connect.php';
	include_once '../database/access_db.php';
	
	var_dump($_POST);

	$idUser = $_POST['user'];
	$idEvent = $_POST['event'];

	$comment = htmlentities($_POST['comment']);

	makeCommentInEvent($idUser, $idEvent, $comment);

	$redirectPage = 'Location: ../mainpage.php/?event=' . $idEvent;
	
	header($redirectPage); /* Redirect browser */
	exit();

	function makeCommentInEvent($idUser, $idEvent, $comment){
		$dateComment = date('now');

		$result = makeComment($idUser, $idEvent, $comment, $dateComment);

		if($result == false){
			var_dump($result);
		}
	}
?>