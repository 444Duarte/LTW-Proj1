<?php
	
	$path = '../database/data.db';
	
	if(!file_exists($path))
		$path = 'database/data.db';

	try {
		$db = new PDO('sqlite:' . $path);
	}
	catch(PDOException $e) {
		echo $e;
		return -1;
	}
?>