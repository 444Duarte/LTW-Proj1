.bail ON
.mode columns
.headers on
.nullvalue NULL
PRAGMA foreign_keys = ON;


SELECT idUser 
FROM GoToEvent
WHERE idEvent = 0;