<head>
	<link rel="stylesheet" href="css/leftbar.css">
</head>

<?php
	include_once 'database/access_db.php';

	$myEvents = getUserAdminEvents($idUser);
	$myInvitedEvents = getUserRelatedEvents($idUser);
?>

<div id="left-bar">
	<ul>
		<li class='has-sub'><a><span>My Events</span></a>
		<ul>
			<?php foreach($myEvents as $event){?>
			
			 <li><a href="mainpage.php/?event=<?php echo $event['idEvent'];?>"><?php echo getEventByID($event['idEvent'])['title'];?></a></li>
			<?php } ?>
			</ul>
       </li>
		 <li class='has-sub'><a><span>Other Events</span></a>
      <ul>
			<?php foreach($myInvitedEvents as $event){?>
			
			<li><a href="<?php echo $event['idEvent'];?>"><?php echo getEventByID($event['idEvent'])['title'];?></a></li>
	
			<?php } ?>
			</ul>
      </ul>
		</div>
