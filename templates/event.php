<header>
	<link rel="stylesheet" href="../css/event.css">
</header>

<?php
	include_once 'database/access_db.php';

	$event = getEventByID($idEvent);
	$usersGoing = getUsersGoingEventByID($idEvent);
	$invitedUsers = getInvitedNotGoing($idEvent);	
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

	<div id='cssmenu'>
		<ul>
			<li class='active'>
				<a><span>Users</span></a>
			</li>
			<li class='has-sub'>
				<a><span>Going</span></a>
		  		<ul>
					<?php 
						foreach( $usersGoing as $idUser) 
						{
					?>
					<li>
						<a href="<?php echo "?user=".$idUser['idUser'] ;?>">
						<?php 
							$username = getUserByID($idUser['idUser'])['user'];
							echo $username; 
						?>
						</a>
					</li>
					<?php } ?>
				</ul>	
			</li>
			<li class='has-sub'><a><span>Invited</span></a>
		  		<ul>
					<?php
						foreach($invitedUsers as $idUser){
					?>
					<li>
						<a href="<?php echo "?user=".$idUser['idUser'] ; ?>">
							<?php 
								$username = getUserByID($idUser['idUser'])['user'];
								echo $username; 
							?>
						</a>
					</li>
					<?php } ?>
				</ul>
		    </li>
		</ul>
	</div>
</div>