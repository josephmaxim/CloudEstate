--  Group #     : 15
--  Members     : Joseph Dagunan, David Bond, Alex Waddell
--  File name   : users.sql

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

INSERT INTO users VALUES('dagunanj', '6766f8aa6a09cc035037c21bf1bd7918', 'S', 'joseph.dagunan@dcmail.ca', '2016-09-08', '2016-09-08'); -- ayee123
INSERT INTO users VALUES('bondd', '56dcdecfee66d3e95077e0cefcf6958c', 'A', 'david.bond@dcmail.ca', '2016-01-01', '2016-09-08'); -- lmao123
INSERT INTO users VALUES('waddella', '09da1b58689e9328a3db8e34d2238fdb', 'P', 'alexander.waddell@dcmail.ca', '2016-01-01', '2016-09-08'); -- hey696
INSERT INTO users VALUES('dupreyb', 'b0408eac1f67df9e79c7595e3ecfd6c6', 'C', 'braydon.duprey@dcmail.ca', '2016-01-01', '2016-09-08'); -- qwerty55
INSERT INTO users VALUES('jcena', '032bdd342fd1c31b7f9c24159fc7705e', 'X', 'jcena@dmail.ca', '2016-01-01', '2016-09-08'); -- noway23
