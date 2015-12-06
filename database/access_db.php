<?php
	//include_once('connect.php');			Retirei porque segundo o que se fez na aula, isto não devia tar aqui.

	class User {
		public $idUser = "";
		public $user = "";
		public $password = "";
		public $description= "";
		public $imagem = "";
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

	function retrieveEventsOfAnUser($user_given) {
		global $db;

		$stmt = $db->prepare('SELECT idUser FROM User where username = :user_given');
		$stmt->bindParam(':user_given', $user_given, PDO::PARAM_STR);
		$stmt->execute();
		$result = $stmt->fetchAll();

		$idUser = $result[0]['idUser'];
		
		$stmt = $db->prepare('SELECT idEvent FROM AdminEvent WHERE idUser = :idUser');
		$stmt->bindParam(':idUser', $idUser, PDO::PARAM_INT);
		$stmt->execute();
		$result = $stmt->fetchAll();

		foreach($result as $row) {
			//dar retrieve dos eventos de AdminEvent
		}

		$stmt = $db->prepare('SELECT idEvent FROM GoToEvent WHERE idUser = :idUser');
		$stmt->bindParam(':idUser', $idUser, PDO::PARAM_INT);
		$stmt->execute();
		$result = $stmt->fetchAll();

		foreach($result as $row) {
			//dar retrieve dos eventos de GoToEvent
		}

		return true;
	}

	function getEventByID($idEvent) {
		global $db;
		$stmt = $db->prepare('SELECT * FROM Event WHERE idEvent = :idEvent');
		$stmt->bindParam(':idEvent', $idEvent, PDO::PARAM_INT);
		$stmt->execute();

		$result = $stmt->fetchAll();


		if(count($result)==0)
			return FALSE;

		$event = $result[0];


		$idEventType = $event['idEventType'];

		$stmt = $db->prepare('SELECT * FROM EventType WHERE idEventType = :idEventType');
		$stmt->bindParam(':idEventType', $idEventType, PDO::PARAM_INT);
		$stmt->execute();

		$result = $stmt->fetchAll();
		$event['type'] = $result[0]['type'];

		return $event;
	}

	function retrieveCommentsByEventID($idEvent) {
		global $db;

		$stmt = $db->prepare('SELECT * FROM Comment WHERE idEvent = :idEvent');
		$stmt->bindParam(':idEvent', $idEvent, PDO::PARAM_INT);
		$stmt->execute();

		$result = $stmt->fetchAll();

		return $result;
	}

	function getUsersGoingEventByID($idEvent){
		global $db;

		$stmt = $db->prepare('SELECT idUser FROM GoToEvent WHERE idEvent = :idEvent');
		$stmt->bindParam(':idEvent', $idEvent, PDO::PARAM_INT);
		$stmt->execute();

		$result = $stmt->fetchAll();

		return $result;
	}

	function getInvitedByIDEvent($idEvent){
		global $db;

		$stmt = $db->prepare('SELECT idUser FROM InvitedTo WHERE idEvent = :idEvent');
		$stmt->bindParam(':idEvent', $idEvent, PDO::PARAM_INT);
		$stmt->execute();

		$result = $stmt->fetchAll();

		return $result;
	}

	function getInvitedNotGoing($idEvent){
		global $db;

		$stmt = $db->prepare('	SELECT idUser
								FROM InvitedTo
								WHERE idEvent = :idEvent AND
									idUser NOT IN( 
										SELECT idUser 
										FROM GoToEvent
										WHERE idEvent = :idEvent)
									');
		$stmt->bindParam(':idEvent', $idEvent, PDO::PARAM_INT);
		$stmt->execute();

		$result = $stmt->fetchAll();

		return $result;
	}

	function getUserByID($idUser){
		global $db;
		$stmt = $db->prepare('SELECT * FROM User WHERE idUser = :idUser');
		$stmt->bindParam(':idUser', $idUser, PDO::PARAM_INT);
		$stmt->execute();
		
		$result = $stmt->fetchAll();

		if(count($result) == 0)
			return FALSE;
		return $result[0];
	}

	function getUserGoesToEvent($idUser, $idEvent){
		global $db;

		$stmt = $db->prepare('SELECT * FROM GoToEvent WHERE idEvent = :idEvent AND idUser = :idUser');
		$stmt->bindParam(':idEvent', $idEvent, PDO::PARAM_INT);
		$stmt->bindParam(':idUser', $idUser, PDO::PARAM_INT);
		$stmt->execute();

		$result = $stmt->fetchAll();

		return count($result)>0;
	}

	function createUserToEvent($idUser, $idEvent){
		global $db;
		$stmt = $db->prepare('INSERT INTO GoToEvent(idUser,idEvent) VALUES (:idUser, :idEvent)');
		$stmt->bindParam(':idEvent', $idEvent, PDO::PARAM_INT);
		$stmt->bindParam(':idUser', $idUser, PDO::PARAM_INT);
		$stmt->execute();
	};

	function deleteUserToEvent($idUser, $idEvent){
		global $db;
		$stmt = $db->prepare('	DELETE FROM GoToEvent
								WHERE  idUser = :idUser AND idEvent = :idEvent');
		$stmt->bindParam(':idEvent', $idEvent, PDO::PARAM_INT);
		$stmt->bindParam(':idUser', $idUser, PDO::PARAM_INT);
		$stmt->execute();
	};

	function inviteToEvent($idUser, $idEvent){
		global $db;
		$stmt = $db->prepare('INSERT INTO InvitedTo(idUser,idEvent) VALUES (:idUser, :idEvent)');
		$stmt->bindParam(':idEvent', $idEvent, PDO::PARAM_INT);
		$stmt->bindParam(':idUser', $idUser, PDO::PARAM_INT);
		$stmt->execute();
	}

	function setUserGoesToEvent($idUser, $idEvent, $state){
		global $db;
		if(getUserByID($idUser)==FALSE)
			return FALSE;
		if(getEventByID($idEvent) == FALSE)
			return FALSE;
		
		if($state){
			if(getUserGoesToEvent($idUser, $idEvent)){
				return FALSE;
			}
			if(!userIsInvited($idUser, $idEvent))
				inviteToEvent($idUser, $idEvent);

			createUserToEvent($idUser, $idEvent);
		}else{
			if(!getUserGoesToEvent($idUser, $idEvent) && userIsInvited($idUser, $idEvent))
				return FALSE;
			if(!userIsInvited($idUser, $idEvent))
				inviteToEvent($idUser, $idEvent);
			
			deleteUserToEvent($idUser, $idEvent);			
		}

		return TRUE;
	}

	function getUserAdminEvents($idUser){
		global $db;
		$currDate = date("Y-m-d", time());

		$stmt = $db->prepare('SELECT Event.idEvent
								FROM AdminEvent,Event
								WHERE idUser = :idUser AND
									AdminEvent.idEvent = Event.idEvent AND
									eventDate > :currDate ');
		$stmt->bindParam(':idUser', $idUser, PDO::PARAM_INT);
		$stmt->bindParam(':currDate', $currDate, PDO::PARAM_STR);
		$stmt->execute();

		$result = $stmt->fetchAll();
		return $result;
	}

	function getUserRelatedEvents($idUser){
		global $db;

		$currDate = date("Y-m-d", time());

		$stmt = $db->prepare('SELECT DISTINCT idEvent 
								FROM (SELECT idEvent as evento_relacionado 
										FROM GoToEvent
										WHERE idUser = :idUser
										UNION 
										SELECT idEvent
										FROM InvitedTo
										WHERE idUser = :idUser), Event
								WHERE evento_relacionado NOT IN (SELECT idEvent FROM AdminEvent WHERE idUser = :idUser) AND
										evento_relacionado = Event.idEvent AND
										eventDate > :currDate
										');

		$stmt->bindParam(':idUser', $idUser, PDO::PARAM_INT);
		$stmt->bindParam(':currDate', $currDate, PDO::PARAM_STR);
		$stmt->execute();
		
		$result = $stmt->fetchAll();
		return $result;
	}

	function searchEvent($query){
		global $db;

		$preparedQuery =  '%' . $query . '%';

		$stmt = $db->prepare('SELECT idEvent
								FROM Event
								WHERE title LIKE :query ');
		$stmt->bindParam(':query', $preparedQuery, PDO::PARAM_STR);
		$stmt->execute();

		$result = $stmt->fetchAll();
		return $result;
	}

	function getIdByUserPass($user, $pass) {
		global $db;
		$stmt = $db->prepare('SELECT * 
								FROM User WHERE user = :user');

		$stmt->bindParam(':user', $user, PDO::PARAM_STR);
		$stmt->execute();
		$result = $stmt->fetchAll();
		
		if (count($result) == 0)
			return false;

		if (decryptPassword($pass, $result[0]['password']))
			return $result[0]['idUser'];

		return false;
	}

	function userCanComment($idUser){
		global $db;

		$stmt = $db->prepare('	SELECT idUser
								FROM GoToEvent
								WHERE idUser=:idUser
								');
		$stmt->bindParam(':idUser', $idUser, PDO::PARAM_INT);
		$stmt->execute();

		$result = $stmt->fetchAll();
		return count($result)>0;
	}



	function makeComment($idUser, $idEvent, $comment, $date){
		global $db;

		$dateComment = date("Y-m-d H:i:s", $date);

		$stmt = $db->prepare('INSERT INTO Comment(idUser, idEvent, comment, dateComment) VALUES(:idUser, :idEvent, :comment, :dateComment)');
		$stmt->bindParam(':idUser', $idUser, PDO::PARAM_STR);
		$stmt->bindParam(':idEvent', $idEvent, PDO::PARAM_STR);
		$stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
		$stmt->bindParam(':dateComment', $dateComment, PDO::PARAM_STR);
		$stmt->execute();
		$result = $stmt->fetchAll();

		return $result;
	}


	function retrieveAdminEvent($idEvent) {
		global $db;

		$stmt = $db->prepare('SELECT idUser FROM AdminEvent WHERE idEvent = :idEvent');
		$stmt->bindParam(':idEvent', $idEvent, PDO::PARAM_INT);
		$stmt->execute();

		$result = $stmt->fetchAll();

		if (count($result) === 0)
			return false;

		return $result[0]['idUser'];
	}
	function userEventsOlderThanDate($idUser, $date){
		global $db;
		$stmt = $db->prepare('SELECT DISTINCT idEvent
								FROM (	SELECT * 
										FROM Event
										WHERE idEvent IN (	SELECT idEvent
															FROM InvitedTo
															WHERE idUser = :idUser
															UNION
															SELECT idEvent
															FROM GoToEvent
															WHERE idUser = :idUser
															UNION
															SELECT idEvent
															FROM AdminEvent
															WHERE idUser = :idUser
															)
										AND	eventDate < :givenDate
										ORDER BY eventDate DESC )
										');
		$stmt->bindParam(':idUser', $idUser, PDO::PARAM_INT);
		$stmt->bindParam(':givenDate', $date, PDO::PARAM_STR);
		$stmt->execute();
		
		$result = $stmt->fetchAll();
		return $result;
	}

	function olderEvents($idUser){
		global $db;

		$currDate = date("Y-m-d", time());
		return userEventsOlderThanDate($idUser, $currDate);		
	}
	
	function getUserProfileByID($idUser){
		global $db;

		$stmt = $db->prepare('SELECT *
								FROM Profile
								WHERE idUser = :idUser
								');
		$stmt->bindParam(':idUser', $idUser, PDO::PARAM_INT);
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result[0];
	}

	function retrieveAllEventTypes() {
		global $db;
		$stmt = $db->prepare('SELECT type FROM EventType');
		$stmt->execute();

		return $result;
	}

	function userIsInvited($idUser, $idEvent){
		global $db;

		$stmt = $db->prepare('SELECT *
								FROM InvitedTo
								WHERE idUser = :idUser AND
										idEvent = :idEvent
								');
		$stmt->bindParam(':idUser', $idUser, PDO::PARAM_INT);
		$stmt->bindParam(':idEvent', $idEvent, PDO::PARAM_INT);
		$stmt->execute();
		$result = $stmt->fetchAll();

		if(count($result) > 0)
			return true;

		return false;
	}


?>  