<?php
	session_start();

	include_once '../database/connect.php';
	include_once '../database/access_db.php';
	

	$idUser = $_SESSION['user'];
	$idEvent = $_POST['event'];

	$comment = htmlentities($_POST['comment']);

	makeCommentInEvent($idUser, $idEvent, $comment);

	$redirectPage = 'Location: ../mainpage.php?event=' . $idEvent;
	
	header($redirectPage); /* Redirect browser */
	exit();

	function makeCommentInEvent($idUser, $idEvent, $comment){
		$dateComment = time();

		$result = makeComment($idUser, $idEvent, $comment, $dateComment);

		if($result == false){
			var_dump($result);
		}
	}
?>