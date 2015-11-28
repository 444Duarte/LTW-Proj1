<header>
	<link rel="stylesheet" href="../css/event.css">
</header>

<?php
	$event = retrieveEventByID($idEvent);
	$usersGoing = getUsersGoingEventByID($idEvent);
	$invitedUsers = getInvitedByIDEvent($idEvent);	
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
			<?php 
				foreach( $usersGoing as $idUser) 
				{
			?>
			<a href="<?php echo "?user=".$idUser['idUser'] ;?>">
				<?php 
					$username = getUserByID($idUser)['user'];
					echo $username; 
				?>
			</a>
			<br>
			<?php } ?>
		</div>
		<div id="users-invited">
			<h1>Invited</h1>
			<?php
				foreach($invitedUsers as $idUser){
			?>
			<a href="<?php echo "?user=".$idUser['idUser'] ; ?>">
				<?php 
					$username = getUserByID($idUser)['user'];
					echo $username; 
				?>
			</a>
			<br>
			<?php } ?>
		</div>
	</div>
</div>