<?php
	session_start();
	session_destroy();

	$redirectPage = 'Location: ../';
	header($redirectPage); /* Redirect browser */
	exit();
?>