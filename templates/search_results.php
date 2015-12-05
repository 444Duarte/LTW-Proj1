<head>
	<link rel="stylesheet" href="../css/search_results.css">
</head>



<div class="display_search">
	<div class="header_search">
		<h1>Search</h1>
		<h5 id="search_text">Search results for: 
			<i><?php echo htmlentities(urldecode($searchQuery))?> </i>
		</h5>
	</div>

	<div id="search_results">
		
		<?php if(count($searchResults) == 0){ ?>
			<h5>No search results.</h5>
		<?php } ?>

		<?php 

			foreach( $searchResults as $idEvent) 
			{
		?>
		<div class = "result_event">
			<?php $event =  getEventByID($idEvent['idEvent']);?>
			<img class="event_image" src="<?php echo  '../' . $event['image'];?>">
			<a class="event_name" href="../mainpage.php/?event=<?php echo $event['idEvent']; ?>  "><h1><?php echo $event['title']; ?></h1></a>
			<h3 class="event_date"><?php echo $event['eventDate']; ?></h3>	
		</div>
		<?php } ?>
	</div>
</div>