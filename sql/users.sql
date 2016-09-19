--  Group #     :
--  Members     : Joseph Dagunan, David Bond
--  File name   : index.php

DROP TABLE IF EXISTS users;

CREATE TABLE users
(
	user_id CHAR(20) PRIMARY KEY,
	password CHAR(32),
	user_type CHAR(1),
	email_address CHAR(256),
	enrol_date DATE,
	last_access DATE
);

INSERT INTO users VALUES('jdoe', 'testpass', 'a', 'jdoe@durhamcollege.ca', '2016-09-08', '2016-09-08');
INSERT INTO users VALUES('wsmith', 'abc123', 'a', 'wsmith@durhamcollege.ca', '2016-01-01', '2016-2-1');
INSERT INTO users VALUES('bkwan', '123abc', 'a', 'bkwan@durhamcollege.ca', '2016-01-01', '2016-2-1');
INSERT INTO users VALUES('tdelreal', 'horsemeat', 'a', 'tdelreal@durhamcollege.ca', '2016-01-01', '2016-2-1');
INSERT INTO users VALUES('jcena', 'cowbell', 'a', 'jcena@durhamcollege.ca', '2016-01-01', '2016-2-1');