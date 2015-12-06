<!DOCTYPE html>
<html>
<head>
	<title>Search</title>
	<meta charset='UTF-8'>
	<script src="dist/sweetalert.min.js"></script>
	<link rel="stylesheet" type="text/css" href="dist/sweetalert.css">
	<link rel="stylesheet" href="css/mainpage.css">
</head>

<?php
	session_start();

	include_once('php/verify.php');
	if (!(isset($_GET['query'])))
		redirectErrorPage();

	include_once 'database/connect.php';
	include_once 'database/access_db.php';


	$idUser = $_SESSION['user'];
	$searchQuery = urlencode($_GET['query']);

	$searchResults = searchEvent(urldecode($searchQuery));
?>

<body>	
	<?php
		include 'templates/topbar.php'; 
		include 'templates/leftbar.php';
		include 'templates/search_results.php'; 
	?>
</body>
</html>
