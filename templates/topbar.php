<head>
	<link rel="stylesheet" href="../css/topbar.css">
</head>

<div class="top-bar">
		<button id="preferences_button" type="button"> <img src="../images/template/gear-16.png"></button>
		<div id="pref_menu">
			<a href="../php/logout.php">Logout</a>
		</div>
		<button id="home_button" type="button"><img src="../images/template/logo-small.png"></button>
		<form id="searchForm" action="../search.php/">
			<input id="search-bar" type="text" name="query" required="optional" placeholder="Search"/>
			<input id="searchButton" type="submit" value="Search"/>
		</form>
</div>	