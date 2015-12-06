<!DOCTYPE html>
<html>

<?php
	include_once '../database/access_db.php';
	include_once '../database/connect.php';
	$types = retrieveAllEventTypes();

	$event = getEventByID($_GET['event']);
?>

	<head>
	    <meta charset='UTF-8'>
		<link rel="stylesheet" href="../css/Admin-Page.css">
		<script src="../dist/sweetalert.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
	</head>

	<body>
		<div id="create_form">
			<header id="header" class="info">
				<h1>Edit Event</h1>
			</header>

			<form id="edit" type="submit" method="post" action="" enctype="multipart/form-data">	
				<label for="title">Title:</label>
				<input type="text" id="title" name="title" placeholder="<?php echo $event['title'];?>">
				<br>

				<label for="date">Date:</label>
				<input type="date" id="date" name="date" placeholder="<?php echo $event['eventDate'];?>">
				<br>
				
				<label for="description">Description: </label>
				<br>
				<textarea rows="3" cols="30" id="description" name="description" placeholder="<?php echo $event['description'];?>"></textarea>
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
					<?php
						foreach($types as $row) {
					?>
						<option value="<?php echo $row['type'];?>" >
							<?php
								echo $row['type'];
							?>
						</option>
					<?php
						}
					?>
				</select>
				<br>

				<button id="criar" type="submit">Editar Evento</button>
			</form>
		</div>
	</body>

	<script src="./../js/bridge.js"></script>
</html>