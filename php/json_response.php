<?php
	function printResponse($value, $reg) {
		$param = ''.$reg;
	    $data = [ $param => $value];
	    header('Content-Type: application/json');
	    echo json_encode($data);
	}
?>