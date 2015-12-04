<!DOCTYPE html>
<html>
<head>
	<title>Event Manager</title>
	<meta charset='UTF-8'>
	<script src="dist/sweetalert.min.js"></script>
	<link rel="stylesheet" type="text/css" href="dist/sweetalert.css">
	<link rel="stylesheet" href="../css/mainpage.css">

<?php
	include_once 'database/connect.php';
	include_once 'database/access_db.php';

	$idUser = $_GET['user'];
	$idEvent = $_GET['event'];

?>

</head>
<body>	
	<?php 
	/*
		include 'templates/topbar.php';
		include 'templates/leftbar.php'; 
		include 'templates/event.php'; 
*/
		include 'templates/perfil.php'; 
	?>
</body>
</html>
