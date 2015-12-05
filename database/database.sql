DROP TABLE IF EXISTS User;
DROP TABLE IF EXISTS Event; 
DROP TABLE IF EXISTS EventType;
DROP TABLE IF EXISTS Comment;
DROP TABLE IF EXISTS AdminEvent;
DROP TABLE IF EXISTS GoToEvent;
DROP TABLE IF EXISTS InvitedTo;


CREATE TABLE User(
idUser INTEGER PRIMARY KEY,
user VARCHAR NOT NULL,
password VARCHAR NOT NULL,
description VARCHAR NOT NULL,
image VARCHAR NOT NULL
);

CREATE TABLE Event(
idEvent INTEGER PRIMARY KEY,
title VARCHAR NOT NULL,
eventDate DATE,
description VARCHAR NOT NULL,
image VARCHAR NOT NULL,
private BOOLEAN,
idEventType INTEGER REFERENCES EventType(idEventType)
);

CREATE TABLE InvitedTo(
idUser INTEGER REFERENCES User(idUser),
idEvent INTEGER REFERENCES Event(idEvent),
PRIMARY KEY (idEvent, idUser)
);

CREATE TABLE EventType(
idEventType INTEGER PRIMARY KEY,
type VARCHAR NOT NULL
);

CREATE TABLE AdminEvent(
 idUser INTEGER REFERENCES User(idUser),
 idEvent INTEGER REFERENCES Event(idEvent),
 PRIMARY KEY(idUser,idEvent)
);

CREATE TABLE GoToEvent(
 idUser INTEGER REFERENCES User(idUser),
 idEvent INTEGER REFERENCES Event(idEvent),
 PRIMARY KEY(idUser,idEvent)
);

CREATE TABLE Comment(
	idComment INTEGER PRIMARY KEY,
	idUser INTEGER REFERENCES User(idUser),
	idEvent INTEGER REFERENCES Event(idEvent),
	dateComment DATE NOT NULL,
	comment VARCHAR NOT NULL
);

/*Quando um AdminEvent é adicionado criar também um GoToEvent para esse utilizador*/
CREATE TRIGGER adminVaiAoEvento
AFTER INSERT ON AdminEvent
FOR EACH ROW
WHEN NEW.idUser NOT IN (SELECT idUser
						FROM GoToEvent
						WHERE idEvent = NEW.idEvent)
BEGIN
	INSERT INTO GoToEvent(idUser, idEvent) VALUES (NEW.idUser, NEW.idEvent);
END;


/*Quando um admin tenta não ir ao evento não deixa*/
CREATE TRIGGER adminTentaNaoIrAoEvento
BEFORE DELETE ON GoToEvent
FOR EACH ROW
WHEN OLD.idUser IN (SELECT idUser
					FROM AdminEvent
					WHERE idEvent = OLD.idEvent)
BEGIN
	SELECT RAISE(ABORT, "Os Admins dos eventos têm que ir ao evento");
END;

/*Quando alguém que não vai ao evento tenta fazer um comentário não deixa*/

CREATE TRIGGER comentarioNaoVaiAoEvento
BEFORE INSERT ON Comment
FOR EACH ROW
WHEN NEW.idUser NOT IN (SELECT idUser
						FROM GoToEvent
						WHERE idEvent = NEW.idEvent)
BEGIN
	SELECT RAISE(ABORT, "Um utilizador que não vai ao evento não pode fazer comentários");
END;


INSERT INTO EventType VALUES (0, 'Festa de Aniversário');
INSERT INTO EventType VALUES (1, 'Corrida');
INSERT INTO EventType VALUES (2, 'Jantar');
INSERT INTO EventType VALUES (3, 'Copos');
INSERT INTO EventType VALUES (4, 'Encontro');

INSERT INTO User VALUES (0,'Utilizador1', '123456','Sou o Pedro','images/users/arcanjo.png');
INSERT INTO User VALUES (1,'Utilizador2', '123456','Sou o Miguel','images/users/arcanjo.png');
INSERT INTO User VALUES (2,'Utilizador3', '123456','Sou o Duarte','images/users/arcanjo.png');

INSERT INTO AdminEvent VALUES (1,0);
INSERT INTO GoToEvent VALUES (2,0);
INSERT INTO InvitedTo VALUES (3,0);
INSERT INTO Event VALUES (0,'Evento Teste', '2015-12-03', 'Este evento é apenas para teste. Isto é a descrição do evento', 'images/events/1.jpg', 0, "FALSE");
