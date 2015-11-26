<?php
	
	try {
		$db = new PDO('sqlite:../EventsManagement.ldb');
	}
	catch(PDOException $e) {
		echo $e;
		return -1;
	}

	try {
		$db = new PDO('sqlite:EventsManagement.ldb');
	}
	catch(PDOException $e) {
		echo $e;
		return -1;
	}
?>