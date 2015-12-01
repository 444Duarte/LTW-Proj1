<head>
	<link rel="stylesheet" href="../css/topbar.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
</head>

<div class="top-bar">
		<button id="preferences_button" type="button"> <img src="../images/template/gear-16.png"></button>
		<div id="pref_menu">
			<a href="">Logout</a>
		</div>
		<button id="home_button" type="button"><img src="../images/template/logo-small.png"></button>
		<form id="searchForm" action="../search.php/?query=<?php echo urlencode($_GET['query']) ?>">
			<input id="search-bar" type="text" name="query" required="optional" placeholder="Search"/>
			<input id="searchButton" type="submit" value="Search"/>
		</form>

	<script src="./js/bridge.js">

	</script>

</div>	