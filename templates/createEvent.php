<!DOCTYPE html>
<html>
	<head>
	    <meta charset='UTF-8'>
		<link rel="stylesheet" href="../css/createEvent.css">
	</head>

	<header id="header" class="info">
		<h1>Create Event</h2>
	</header>

	<body>	
		<div id="Title">
			<label for="title">Title:</label>
			<textarea rows="3" cols="30" id="title" name="title"></textarea>
		</div>
		<br>

		<div id="Date">
			<label for="date">Date:</label>
			<input type="date" id="date" name="date">
		</div>
		<br>

		<div id="Description">
			<label for="description">Description: </label>
			<textarea rows="3" cols="30" id="description" name="description"></textarea>
		</div>
		<br>

		<div id="Image">
			<label for="image">Image: </label>
			<input type="file" id="image" name="image">
		</div>
		<br>

		<div id="PrivateF">
			<label for="Privacy">Privacy: </label>
			<select id="Privacy" name="Privacy">
				<option value="Public" selected="Selected">Public</option>
				<option value="Private">Private</option>
			</select>
		</div>
		<br>

		<div id="TypeF">
			<label for="Type">Type: </label>
			<select id="Type" name="Type">
				<option value="Tipo1" selected="selected">Tipo1</option>
				<option value="Tipo2">Tipo2</option>
				<option value="Tipo3">Tipo3</option>
			</select>
		</div>

	</body>
</html>