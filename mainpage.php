<!DOCTYPE html>
<html>
<head>
	<title>Event Manager</title>
	<meta charset='UTF-8'>
	<script src="dist/sweetalert.min.js"></script>
	<link rel="stylesheet" type="text/css" href="dist/sweetalert.css">
	<link rel="stylesheet" href="../css/mainpage.css">

<?php
	include 'database/connect.php';
	include 'database/access_db.php';

	$idEvent = $_GET['event'];
?>

</head>
<body>	
	<?php include 'templates/topbar.php'; ?>
	<?php include 'templates/leftbar.php'; ?>
	<?php include 'templates/event.php'; ?>
	
</body>
</html>
