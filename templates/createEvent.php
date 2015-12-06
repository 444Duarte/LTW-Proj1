<?php
	session_start();
	include_once 'database/connect.php';
	include_once 'database/access_db.php';

	$idUser = $_SESSION['user'];
	$idEvent = $_GET['event'];

?>

<!DOCTYPE html>
<html>
	<head>
	    <meta charset='UTF-8'>
		<link rel="stylesheet" href="../css/createEvent.css">
		<script src="../dist/sweetalert.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
	</head>

	<body>
		<div id="create_form">
			<header id="header" class="info">
				<h1>Create Event</h1>
			</header>

			<form id="create" type="submit" method="post" action="" enctype="multipart/form-data">	
				<label for="title">Title:</label>
				<input type="text" id="title" name="title">
				<br>

				<label for="date">Date:</label>
				<input type="date" id="date" name="date">
				<br>
				
				<label for="description">Description: </label>
				<br>
				<textarea rows="3" cols="30" id="description" name="description"></textarea>
				<br>

				<label for="image">Image: </label>
				<input type="file" id="image" name="image">
				<br>

				<label for="Privacy">Privacy: </label>
				<select id="Privacy" name="Privacy">
					<option value="Public" selected="Selected">Public</option>
					<option value="Private">Private</option>
				</select>
				<br>

				<label for="Type">Type: </label>
				<select id="Type" name="Type">
					<option value="Tipo1" selected="selected">Tipo1</option>
					<option value="Tipo2">Tipo2</option>
					<option value="Tipo3">Tipo3</option>
				</select>
				<br>

				<button id="criar" type="submit">Criar Evento</button>
			</form>
		</div>
	</body>

	<script src="./../js/bridge.js"></script>
</html>