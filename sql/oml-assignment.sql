INSERT INTO author (authorId, authorByline, authorEmail, authorName, authorTitle) VALUES (UNHEX(REPLACE("5d958f62-6092-4049-85a8-e1593dee6e12", "-", "")),
'From there to here, and here to there, funny things are everywhere.', 'drseuss@gmail.com', 'Dr Seuss', 'Chief of Green Eggs and Ham' );

INSERT INTO author (authorId, authorByline, authorEmail, authorName, authorTitle) VALUES (UNHEX(REPLACE("952d9ecc-4491-47b2-b045-95f0f803aa96", "-", "")),
 'We need never be ashamed of our tears', 'cdickens@aol.com', 'Charles Dickens', 'We had great expectations');

UPDATE author set authorEmail = 'charlesdickens@gmail.com' WHERE authorEmail = 'cdickens@aol.com';
UPDATE author set authorByline = 'If you never did you should. These things are fun, and fun is good' WHERE authorByline = 'From there to here, and here to there, funny things are everywhere.';

SELECT authorName FROM author WHERE authorTitle = 'Chief of Green Eggs and Ham';
SELECT authorTitle FROM author WHERE authorName = 'Charles Dickens';

DELETE FROM author WHERE authorName = 'Charles Dickens';
DELETE FROM author WHERE authorEmail = 'drseuss@gmail.com';
