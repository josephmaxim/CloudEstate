
DROP TABLE IF EXISTS reports;
DROP TABLE IF EXISTS favourites;
DROP TABLE IF EXISTS people;
DROP TABLE IF EXISTS listings;
DROP TABLE IF EXISTS status;
DROP TABLE IF EXISTS property_options;
DROP TABLE IF EXISTS bedrooms;
DROP TABLE IF EXISTS bathrooms;
DROP TABLE IF EXISTS listing_type;
DROP TABLE IF EXISTS storey;
DROP TABLE IF EXISTS building_type;
DROP TABLE IF EXISTS listing_stars;
DROP TABLE IF EXISTS users;

CREATE TABLE users
(
	user_id VARCHAR(20) PRIMARY KEY,
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

CREATE TABLE people
(
	user_id VARCHAR(20) NOT NULL REFERENCES users(user_id),
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

CREATE TABLE status ( property_id CHAR(1) PRIMARY KEY, property VARCHAR(15));
CREATE TABLE property_options ( property_id INTEGER PRIMARY KEY, property VARCHAR(20));
CREATE TABLE bedrooms ( property_id INTEGER PRIMARY KEY, property VARCHAR(15));
CREATE TABLE bathrooms ( property_id INTEGER PRIMARY KEY, property VARCHAR(15));
CREATE TABLE listing_type ( property_id INTEGER PRIMARY KEY, property VARCHAR(15));
CREATE TABLE storey ( property_id INTEGER PRIMARY KEY, property VARCHAR(15));
CREATE TABLE building_type ( property_id INTEGER PRIMARY KEY, property VARCHAR(15));
CREATE TABLE listing_stars ( property_id INTEGER PRIMARY KEY, property VARCHAR(15));

drop sequence if exists listing_id_seq;
create sequence listing_id_seq;
select setval('listing_id_seq', 10000);

CREATE TABLE listings
(
  listing_id NUMERIC PRIMARY KEY DEFAULT nextval('listing_id_seq'),
  user_id VARCHAR(20) REFERENCES users (user_id),
  status CHAR(1) NOT NULL,
  price NUMERIC NOT NULL,
  headline VARCHAR(100) NOT NULL,
  description VARCHAR(1000) NOT NULL,
  postal_code CHAR(6) NOT NULL,
  images SMALLINT DEFAULT 0,
  city VARCHAR(75) NOT NULL,

  property_options INTEGER NOT NULL,
  bedrooms INTEGER,
  bathrooms INTEGER,

  listed_date DATE,
  listing_type INTEGER DEFAULT 0 NOT NULL,
  storey INTEGER DEFAULT 0 NOT NULL,
  building_type INTEGER DEFAULT 0 NOT NULL,
  listing_views NUMERIC DEFAULT 0 NOT NULL,
  listing_stars INTEGER DEFAULT 0 NOT NULL
);

CREATE TABLE reports
(
	user_id VARCHAR(20) NOT NULL REFERENCES users (user_id),
	listing_id INTEGER NOT NULL REFERENCES listings (listing_id),
	reported_on DATE NOT NULL,
	status CHAR(1) NOT NULL
);


CREATE TABLE favourites
(
	user_id VARCHAR(20) NOT NULL REFERENCES users (user_id),
	listing_id INTEGER NOT NULL REFERENCES listings (listing_id)
);


-- INSERTING DATA
INSERT INTO listings VALUES( DEFAULT, 'dagunanj', 'o', 500000.00, '27 King Street For Sale!', 'House for sale! contact Joseph Dagunan!', 'U7F9B3', 0, 'ajax', 0, 3, 3, CURRENT_DATE, 0, 3, 0, 2000, 4);

-- Insert table listing_status properties
INSERT INTO status VALUES('o', 'Open');
INSERT INTO status VALUES('c', 'Close');
INSERT INTO status VALUES('h', 'Hidden');
INSERT INTO status VALUES('s', 'Sold');

-- Insert table property_options properties
INSERT INTO property_options VALUES(0, 'Stainless Appliances');
INSERT INTO property_options VALUES(1, 'Home Theatre');
INSERT INTO property_options VALUES(2, 'Detached garage');
INSERT INTO property_options VALUES(3, 'Outdoor Fireplace');

-- Insert table bedrooms properties
INSERT INTO bedrooms VALUES(0, '1 bedroom');
INSERT INTO bedrooms VALUES(1, '2 bedroom');
INSERT INTO bedrooms VALUES(2, '3 bedroom');
INSERT INTO bedrooms VALUES(3, '4 bedroom');
INSERT INTO bedrooms VALUES(4, '5 bedroom');

-- Insert table bathrooms properties
INSERT INTO bathrooms VALUES(0, '1 bathroom');
INSERT INTO bathrooms VALUES(1, '2 bathroom');
INSERT INTO bathrooms VALUES(2, '3 bathroom');
INSERT INTO bathrooms VALUES(3, '4 bathroom');
INSERT INTO bathrooms VALUES(4, '5 bathroom');

-- Insert table listing_type properties
INSERT INTO listing_type VALUES(0, 'Residential');
INSERT INTO listing_type VALUES(1, 'Commercial');

-- Insert table storey properties
INSERT INTO storey VALUES(0, '1 Storey');
INSERT INTO storey VALUES(1, '2 Storey');
INSERT INTO storey VALUES(2, '3 Storey');
INSERT INTO storey VALUES(3, '4 Storey');

-- Insert table building_type properties
INSERT INTO building_type VALUES(0, 'House');
INSERT INTO building_type VALUES(1, 'Townhouse');
INSERT INTO building_type VALUES(2, 'Apartment');
INSERT INTO building_type VALUES(3, 'Duplex');
INSERT INTO building_type VALUES(4, 'Triplex');
INSERT INTO building_type VALUES(5, 'Fourplex');

-- Insert table listing_stars properties
INSERT INTO listing_stars VALUES(0, '1 Star');
INSERT INTO listing_stars VALUES(1, '2 Stars');
INSERT INTO listing_stars VALUES(2, '3 Stars');
INSERT INTO listing_stars VALUES(3, '4 Stars');
INSERT INTO listing_stars VALUES(4, '5 Stars');