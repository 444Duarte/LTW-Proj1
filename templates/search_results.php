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
		<div class = "result_event">
			<?php $event1 =  getEventByID(0);?>
			<img class="event_image" src="<?php echo  '../' . $event1['image'];?>">
			<a href="../mainpage.php/?event=<?php echo $event1['idEvent']; ?>  "><h1><?php echo $event1['title']; ?></h1></a>
			<h3><?php echo $event1['eventDate']; ?></h3>
		</div>
	</div>
</div>