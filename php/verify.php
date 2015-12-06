<?php
	function redirectErrorPage() {
		$url = "http://$_SERVER[SERVER_NAME]$_SERVER[REQUEST_URI]";

		$file = dirname($url) . '/errorpage.html';

		header('Location: ' . $file);
	}

	function redirectErrorPageBackwards() {
		$url = "http://$_SERVER[SERVER_NAME]$_SERVER[REQUEST_URI]";

		$file = dirname($url) . '/errorpage.html';

		if (count($_SESSION) === 0) {
			header('Location: ' . $file);
		}
	}

?>