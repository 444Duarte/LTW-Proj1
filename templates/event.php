<header>
	<link rel="stylesheet" href="../css/event.css">
</header>

<?php
	include 'database/connect.php';
	include 'database/access_db.php';

	$event = retrieveEventByID($_GET['event']);
	
 ?>

<div class="display-event">
	<div id="header" style="background-image:<?php $image_url = "url('../" .$event['image']. "')" ; echo $image_url; ?>" >
		<div>
			<h1 id="name"><?php echo $event['title'];?></h1>
			<br>
			<h2 id="type"><?php echo $event['type'];?></h2>
		</div>
		<h3 id="date"><?php echo $event['eventDate']?></h3>
		<form id="option">
			<select name="Option">
				<option disabled selected> -- select an option -- </option>
				<option value="going">Going</option>
				<option value="not">Not Going</option>
				<option value="maybe">Maybe</option>
			</select>
		</form>
	</div>

	<div id="description">
		<h4>Description</h4>
		<br>
		<p> <?php echo $event['description']; ?> </p>
	</div>

	<div class="users">
		<div id="users-going">
			<h1>Going</h1>
			<a href="">User1</a>
			<br>
			<a href="">User2</a>
			<br>
			<a href="">User3</a>
			<br>
			<a href="">User4</a>
		</div>
		<div id="users-not-going">
			<h1>Not going</h1>
			<a href="">User1</a>
			<br>
			<a href="">User2</a>
			<br>
			<a href="">User3</a>
			<br>
			<a href="">User4</a>
		</div>
		<div id="users-invited">
			<h1>Invited</h1>
			<a href="">User1</a>
			<br>
			<a href="">User2</a>
			<br>
			<a href="">User3</a>
			<br>
			<a href="">User4</a>
		</div>
	</div>
</div>