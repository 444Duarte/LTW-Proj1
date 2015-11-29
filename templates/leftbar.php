<header>
	<link rel="stylesheet" href="../css/leftbar.css">
</header>

<?php
	include_once 'database/access_db.php';

	$myEvents = getUserAdminEvents($idUser);
	$myInvitedEvents = getUserRelatedEvents($idUser);
?>

<div class="left-bar">
	<div>
		<h5>My Events</h5>
		<br>
		<div class="link-events"> 
			<?php foreach($myEvents as $event){?>
			
			<a href="<?php echo $event['idEvent'];?>"><?php echo getEventByID($event['idEvent'])['title'];?></a>

			<?php } ?>
		</div>
	</div>
	<div>
		<h5>Other Events</h5>
		<br>
		<div class="link-events">
			<?php foreach($myInvitedEvents as $event){?>
			
			<a href="<?php echo $event['idEvent'];?>"><?php echo getEventByID($event['idEvent'])['title'];?></a>

			<?php } ?>
		</div>
	</div>
</div>
