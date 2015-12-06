<head>
	<link rel="stylesheet" href="css/topbar.css">
</head>

<div class="top-bar">
		<button id="preferences_button" type="button"> <img src="images/template/gear-16.png"></button>
		<div id="pref_menu">
			<a href="php/logout.php">Logout</a>
			<a href="older.php">Older Events</a>
			<a href="#">About</a>
		</div>
		<button id="create_event_button" href="" type="button">
			<img src="images/template/plus_16.png">
			<p>Create Event</p>
		</button>
		<a id="home_button" href="profile.php"><img src="images/template/logo-small.png"></a>
		<form id="searchForm" action="search.php">
			<input id="search-bar" type="text" name="query" required="optional" placeholder="Search"/>
			<input id="searchButton" type="submit" value="Search"/>
		</form>
</div>	