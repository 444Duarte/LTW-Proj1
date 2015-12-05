<head>
	<link rel="stylesheet" href="css/multiple_events.css">
</head>

<div id="display_events">
	<?php 

		foreach( $events as $idEvent) 
		{
	?>
	<div class = "single_event">
		<?php $event =  getEventByID($idEvent['idEvent']);?>
		<img class="event_image" src="<?php echo $event['image'];?>">
		<a class="event_name" href="mainpage.php/?event=<?php echo $event['idEvent']; ?>  "><h1><?php echo $event['title']; ?></h1></a>
		<h3 class="event_date"><?php echo $event['eventDate']; ?></h3>	
	</div>
	<?php } ?>
</div>