--  Group #     :
--  Members     : Joseph Dagunan, David Bond
--  File name   : index.php

DROP TABLE IF EXISTS users;

CREATE TABLE users
(
	user_id VARCHAR(20) PRIMARY KEY,
	password VARCHAR(32),
	user_type VARCHAR(1),
	email_address VARCHAR(256),
	enrol_date DATE,
	last_access DATE
);

INSERT INTO users VALUES('dagunanj', 'test123', 'a', 'joseph.dagunan@dmail.ca', '2016-09-08', '2016-09-08');
INSERT INTO users VALUES('bondd', 'abc123', 'a', 'david.bond@dmail.caa', '2016-01-01', '2016-2-1');
INSERT INTO users VALUES('waddella', '123abc', 'a', 'alexander.waddell@dmail.ca', '2016-01-01', '2016-2-1');
INSERT INTO users VALUES('dupreyb', 'horsemeat', 'a', 'braydon.duprey@dmail.ca', '2016-01-01', '2016-2-1');
INSERT INTO users VALUES('jcena', 'cowbell', 'a', 'jcena@dmail.ca', '2016-01-01', '2016-2-1');