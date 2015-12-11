<header>
	<link rel="stylesheet" href="css/event.css">
	<link rel="stylesheet" href="css/comments_section.css">
</header>

<?php
	include_once 'database/access_db.php';

	$event = getEventByID($idEvent);
	$usersGoing = getUsersGoingEventByID($idEvent);
	$invitedUsers = getInvitedNotGoing($idEvent);	
 ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
<script src="js/editEvent.js"></script>

<?php if(isAdminEvent($idUser, $idEvent)){
	include_once 'templates/admin_event.php';
}?>

<div class="display-event">
	<div id="header" style="background-image:<?php $image_url = "url('" .$event['image']. "')" ; echo $image_url; ?>" >
		
		<?php if(isAdminEvent($idUser, $idEvent)){?>
			<button id="edit_event_button" onClick="openEditEvent()" type="button">
				<img src="images/template/pencil_64.png">
			</button>
		<?php }?>
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
			</select>
		</form>
	</div>

	<div id="description">
		<h4>Description</h4>
		<br>
		<p> <?php echo $event['description']; ?> </p>
	</div>

	<div id='users_event'>
		<ul>
			<li class='active'>
				<a><span>Users</span></a>
			</li>
			<li class='has-sub'>
				<a><span>Going</span></a>
		  		<ul>
					<?php 
						foreach( $usersGoing as $user) 
						{
					?>
					<li>
						<a href="<?php echo "profile.php?id=".$user['idUser'] ;?>">
						<?php 
							$username = getUserByID($user['idUser'])['user'];
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
						foreach($invitedUsers as $user){
					?>
					<li>
						<a href="<?php echo "profile.php?id=".$user['idUser'] ; ?>">
							<?php 
								$username = getUserByID($user['idUser'])['user'];
								echo $username; 
							?>
						</a>
					</li>
					<?php } ?>
				</ul>
		    </li>
		</ul>
	</div>
	<?php include "comments_section.php"; ?>
	
</div>