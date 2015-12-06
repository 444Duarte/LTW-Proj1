<!DOCTYPE html>
<html>

<?php
	include_once 'database/access_db.php';
	include_once 'database/connect.php';
	$types = retrieveAllEventTypes();

	$event = getEventByID($idEvent);
?>

<head>
<link rel="stylesheet" href="css/edit_event.css">
</head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
<script src="js/editEvent.js"></script>
<script src="js/bridge.js"></script>

<div id="edit_form">
	<button id="close_create_event" onClick="closeEditEvent()" type="button">
			<img src="images/template/x_button.png">
	</button>
	<header id="edit_header" class="info">
		<h1>Edit Event</h1>
	</header>

	<form id="edit" type="submit" method="post" action="php/editEvent.php" enctype="multipart/form-data">
		
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

		<input type="hidden" id="event" name="event" value="<?php echo $_GET['event']; ?>"></hidden>
		<button id="criar" type="submit">Editar Evento</button>

	</form>
</div>

