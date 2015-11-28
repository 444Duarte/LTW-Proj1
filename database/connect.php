<?php
	
	$path = 'database/database.db';
	if(!file_exists($path))
		$path = 'database.db';

	try {
		$db = new PDO('sqlite:' . $path);
	}
	catch(PDOException $e) {
		echo $e;
		return -1;
	}
?>