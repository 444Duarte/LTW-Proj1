<?php
	include_once 'database/access_db.php';
	include_once 'database/connect.php';

	$types = retrieveAllEventTypes();
?>

<head>
	<link rel="stylesheet" href="css/createEvent.css">
</head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
<script src="js/createEvent.js"></script>
<script src="js/bridge.js"></script>

<div id="create_form">
	<button id="close_create_event" onClick="closeCreateEvent()" type="button">
			<img src="images/template/x_button.png">
	</button>

	<header id="create_header" class="info">
		<h1>Create Event</h1>
	</header>

	<form id="create" type="submit" method="post" action="php/uploadImage.php" enctype="multipart/form-data">	
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
			<?php
				foreach($types as $row) {
			?>
				<option value="<?php echo $row['idEventType'];?>" >
					<?php
						echo $row['type'];
					?>
				</option>
			<?php
				}
			?>
		</select>
		<br>

		<button id="criar" type="submit">Criar Evento</button>
	</form>
</div>
