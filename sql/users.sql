--  Group #     : 15
--  Members     : Joseph Dagunan, David Bond, Alex Waddell, Braydon Duprey
--  File name   : index.php

DROP TABLE IF EXISTS users;

CREATE TABLE users
(
	user_id VARCHAR(20) PRIMARY KEY NOT NULL,
	password VARCHAR(32) NOT NULL,
	user_type VARCHAR(1) NOT NULL,
	email_address VARCHAR(256) NOT NULL,
	enrol_date DATE NOT NULL,
	last_access DATE NOT NULL
);

INSERT INTO users VALUES('dagunanj', 'test123', 'a', 'joseph.dagunan@dcmail.ca', '2016-09-08', '2016-09-08');
INSERT INTO users VALUES('bondd', 'abc123', 'a', 'david.bond@dcmail.ca', '2016-01-01', '2016-2-1');
INSERT INTO users VALUES('waddella', '123abc', 'a', 'alexander.waddell@dcmail.ca', '2016-01-01', '2016-2-1');
INSERT INTO users VALUES('dupreyb', 'horsemeat', 'a', 'braydon.duprey@dcmail.ca', '2016-01-01', '2016-2-1');
INSERT INTO users VALUES('jcena', 'cowbell', 'a', 'jcena@dmail.ca', '2016-01-01', '2016-2-1');