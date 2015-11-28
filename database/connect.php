<?php
	
	$path = 'database/data.db';
	$path = 'database/test-table.db';
	if(!file_exists($path))
		$path = 'data.db';

	try {
		$db = new PDO('sqlite:' . $path);
	}
	catch(PDOException $e) {
		echo $e;
		return -1;
	}
?>