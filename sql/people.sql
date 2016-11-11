--  Group #     : 15
--  Members     : Joseph Dagunan, David Bond, Alex Waddell
--  File name   : people.sql

DROP TABLE IF EXISTS people;

CREATE TABLE people
(
	user_id VARCHAR(20) REFERENCES users (user_id) NOT NULL,
	salutation VARCHAR(10),
	first_name VARCHAR(25),
	last_name VARCHAR(50),
	street_address_1 VARCHAR(75),
	street_address_2 VARCHAR(75),
	city VARCHAR(75),
	province VARCHAR(2),
	postal_code VARCHAR(6),
	primary_phone_number VARCHAR(15),
	secondary_phone_number VARCHAR(10),
	fax_number VARCHAR(10),
	preferred_contact_method CHAR(1) NOT NULL
);

INSERT INTO people VALUES('dagunanj', 'Lord', 'Joseph', 'Dagunan', '69 Glorious St', '', 'Ajax', 'ON', 'L1T6H8', '2899984454', '', '', 'e');
INSERT INTO people VALUES('bondd', 'Mr.', 'David', 'Bond', '69 One St', '', 'Whitby', 'ON', 'L1T6H8', '7564738264', '', '', 'p');
INSERT INTO people VALUES('waddella', 'Mr.', 'Alex', 'Waddella', '69 Two St', '', 'Pickering', 'ON', 'L1T6H8', '9876584736', '', '', 'e');
INSERT INTO people VALUES('dupreyb', 'Mr.', 'Braydon', 'Duprey', '69 Nowhere St', '', 'Oshawa', 'ON', 'L1T6H8', '2839409863', '', '', 'l');
INSERT INTO people VALUES('jcena', 'Mr', 'John', 'Cena', '69 wwe St', '', 'Ajax', 'ON', 'L1T6H8', '2463752863', '', '', 'e');
