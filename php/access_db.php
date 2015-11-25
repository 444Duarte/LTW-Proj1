<?php
	include_once('connect.php');
	
	class User {
		public $idUser = "";
		public $user = "";
		public $password = "";
	}

	class Event {
		public $idEvent = "";
		public $datadoEvento = "";
		public $descricao = "";
		public $imagem = "";
	}

	class EventType {
		public $idEventType = "";
		public $idEvent = "";
		public $type = "";
	}

	class AdminEvent {
		public $idUser = "";
		public $idEvent = "";
	}

	class GoToEvent {
		public $idUser = "";
		public $idEvent = "";
	}

	class Comment {
		public $idComment = "";
		public $idUser = "";
		public $idEvent = "";
		public $comment = "";
	}

	function startDB($sting) {
		$stmt = $db->prepare(sting);
		$result = $stmt->fetchAll();

		return $result;
	}

	function retrieveUser() {
		$result = startDB('SELECT * FROM User;');

		$users = array();
		foreach( $result as $row) {			
			$list = array();
			$list['idUser'] = .$row['idUser'];
			$list['user'] = .$row['user'];
			$list['password'] = .$row['password'];

			array_push($users, $list);
		}

		echo json_encode($users);
	}

	function retrieveEvent() {
		$result = startDB('SELECT * FROM Event;');

		$events = array();
		foreach( $result as $row) {			
			$list = array();
			$list['idEvent'] = .$row['idEvent'];
			$list['datadoEvento'] = .$row['datadoEvento'];
			$list['descricao'] = .$row['descricao'];
			$list['imagem'] = .$row['imagem'];

			array_push($events, $list);
		}

		echo json_encode($events);	
	}

	function retrieveEventType() {
		$result = startDB('SELECT * FROM EventType;');

		$eventsType = array();
		foreach( $result as $row) {			
			$list = array();
			$list['idEventType'] = .$row['idEventType'];
			$list['datadoEvento'] = .$row['datadoEvento'];
			$list['descricao'] = .$row['descricao'];
			$list['imagem'] = .$row['imagem'];

			array_push($eventsType, $list);
		}

		echo json_encode($eventsType);	
	}

	function retrieveAdminEvent() {
		$result = startDB('SELECT * FROM AdminEvent;');

		$adminEvents = array();
		foreach( $result as $row) {			
			$list = array();
			$list['idUser'] = .$row['idUser'];
			$list['idEvent'] = .$row['idEvent'];

			array_push($adminEvents, $list);
		}

		echo json_encode($adminEvents);	
	}

	function retrieveGoToEvent() {
		$result = startDB('SELECT * FROM GoToEvent;');

		$goToEvents = array();
		foreach( $result as $row) {			
			$list = array();
			$list['idUser'] = .$row['idUser'];
			$list['idEvent'] = .$row['idEvent'];

			array_push($goToEvents, $list);
		}

		echo json_encode($goToEvents);	
	}

	function retrieveComment() {
		$result = startDB('SELECT * FROM Comment;');

		$comments = array();
		foreach( $result as $row) {			
			$list = array();
			$list['idComment'] = .$row['idComment'];
			$list['idUser'] = .$row['idUser'];
			$list['idEvent'] = .$row['idEvent'];
			$list['comment'] = .$row['comment'];

			array_push($comments, $list);
		}

		echo json_encode($comments);		
	}

?>  