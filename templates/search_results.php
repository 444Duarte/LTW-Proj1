<head>
	<link rel="stylesheet" href="css/search_results.css">
</head>



<div class="display_search">
	<div class="header_search">
		<h1>Search</h1>
		<h5 id="search_text">Search results for: 
			<i><?php echo htmlentities(urldecode($searchQuery))?> </i>
		</h5>
	</div>

	<?php
		$events = $searchResults;
	?>

	<?php if(count($events) == 0){ ?>
		<h5>No search results.</h5>
	<?php 
		}else{
			include 'templates/multiple_events.php'; 
		}
	?>
</div>