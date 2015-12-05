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
	comment VARCHAR NOT NULL
);


INSERT INTO EventType VALUES (0, 'Festa de Aniversário');
INSERT INTO EventType VALUES (1, 'Corrida');
INSERT INTO EventType VALUES (2, 'Jantar');
INSERT INTO EventType VALUES (3, 'Copos');
INSERT INTO EventType VALUES (4, 'Encontro');

INSERT INTO User VALUES (0,'Utilizador1', '123456','Sou o Pedro','images/users/arcanjo.png');

INSERT INTO AdminEvent VALUES (0,0);
INSERT INTO GoToEvent VALUES (0,0);
INSERT INTO GoToEvent VALUES (1,0);
INSERT INTO InvitedTo VALUES (2,0);
INSERT INTO Event VALUES (0,'Evento Teste', '2015-12-03', 'Este evento é apenas para teste. Isto é a descrição do evento', 'images/events/1.jpg', 0, "FALSE");
