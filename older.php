<!DOCTYPE html>
<html>
<head>
	<title>Older Events</title>
	<meta charset='UTF-8'>
	<script src="dist/sweetalert.min.js"></script>
	<link rel="stylesheet" type="text/css" href="dist/sweetalert.css">
	<link rel="stylesheet" href="../css/mainpage.css">

<?php
	session_start();
	include_once 'database/connect.php';
	include_once 'database/access_db.php';

	$idUser = 1;

	$olderEvents = olderEvents($idUser);
?>

</head>
<body>	
	<?php 
		include 'templates/topbar.php';
		include 'templates/leftbar.php'; 
	?>

		<head>
		<link rel="stylesheet" href="../css/older.css">
	</head>

	<div id="older_events">
		<h1 style="border-bottom: groove 1px #999999">Older Events</h1>

		<?php
			$events = $olderEvents;
		?>

		<?php if(count($events) == 0){ ?>
			<h5>No older events.</h5>
		<?php 
			}else{
				include '/templates/multiple_events.php'; 
			}
		?>
	</div>
</body>
</html>
