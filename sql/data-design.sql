-- CREATE SCHEMA data_design;
ALTER DATABASE jticer CHARACTER SET utf8 COLLATE utf8_unicode_ci;

-- drop the tables if they exist
DROP TABLE IF EXISTS article;
DROP TABLE IF EXISTS author;


-- create the new tables
CREATE TABLE author (
	authorId BINARY(16) NOT NULL,
	authorByline VARCHAR(256),
	authorEmail VARCHAR(256) NOT NULL,
	authorName VARCHAR(64) NOT NULL,
	authorTitle VARCHAR(256) NOT NULL,
	-- create unique index so that there is no duplicate data
	UNIQUE(authorEmail),
	-- set my primary key
	PRIMARY KEY(authorId)
);


CREATE TABLE article (
	articleId BINARY(16) NOT NULL,
	articleAuthorId BINARY(16) NOT NULL,
	articleContent VARCHAR(1024) NOT NULL,
	articleDateTime DATETIME(6) NOT NULL,
	articleTitle VARCHAR(256) NOT NULL,
	-- index my articleAuthorId before making a foreign key
	INDEX(articleAuthorId),
	-- create my foreign key
	FOREIGN KEY(articleAuthorId) REFERENCES author(authorId),
	-- create my primary key
	PRIMARY KEY(articleId)
);
