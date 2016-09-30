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
	enrol_date VARCHAR(25) NOT NULL,
	last_access VARCHAR(25) NOT NULL
);

INSERT INTO users VALUES('dagunanj', '6766f8aa6a09cc035037c21bf1bd7918', 'a', 'joseph.dagunan@dcmail.ca', '2016-09-08', 'Sep 30, 2016 3:22 am'); -- ayee123
INSERT INTO users VALUES('bondd', '56dcdecfee66d3e95077e0cefcf6958c', 'a', 'david.bond@dcmail.ca', '2016-01-01', 'Sep 30, 2016 3:22 am'); -- lmao123
INSERT INTO users VALUES('waddella', '09da1b58689e9328a3db8e34d2238fdb', 'a', 'alexander.waddell@dcmail.ca', '2016-01-01', 'Sep 30, 2016 3:22 am'); -- hey696
INSERT INTO users VALUES('dupreyb', 'b0408eac1f67df9e79c7595e3ecfd6c6', 'a', 'braydon.duprey@dcmail.ca', '2016-01-01', 'Sep 30, 2016 3:22 am'); -- qwerty55
INSERT INTO users VALUES('jcena', '032bdd342fd1c31b7f9c24159fc7705e', 'a', 'jcena@dmail.ca', '2016-01-01', 'Sep 30, 2016 3:22 am'); -- noway23