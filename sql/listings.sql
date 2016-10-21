--  Group #     : 15
--  Members     : Joseph Dagunan, David Bond, Alex Waddell, Braydon Duprey
--  File name   : listings.sql

DROP TABLE IF EXISTS listings, status, city, property_options, bedrooms, bathrooms, listing_type, storey, building_type, listing_stars;

CREATE TABLE listings
(
  listing_id SERIAL PRIMARY KEY,
  user_id VARCHAR(20) REFERENCES users (user_id) NOT NULL,
  status CHAR(1) NOT NULL,
  price NUMERIC NOT NULL,
  headline VARCHAR(100) NOT NULL,
  description VARCHAR(1000) NOT NULL,
  postal_code CHAR(6) NOT NULL,
  images SMALLINT DEFAULT 0,
  city INTEGER NOT NULL,
  property_options INTEGER NOT NULL,
  bedrooms INTEGER NOT NULL,
  bathrooms INTEGER NOT NULL,

  listed_date DATE,
  listing_type INTEGER NOT NULL DEFAULT 0,
  storey INTEGER NOT NULL DEFAULT 0,
  building_type INTEGER NOT NULL DEFAULT 0,
  listing_views NUMERIC NOT NULL DEFAULT 0,
  listing_stars INTEGER NOT NULL DEFAULT 0
);

CREATE TABLE status
(
 value INTEGER PRIMARY KEY,
 property VARCHAR(15)
);

INSERT INTO status VALUES(0, 'Sold');
INSERT INTO status VALUES(1, 'Available');

CREATE TABLE city
(
 value INTEGER PRIMARY KEY,
 property VARCHAR(15)
);

CREATE TABLE property_options
(
 value INTEGER PRIMARY KEY,
 property VARCHAR(15)
);

CREATE TABLE bedrooms
(
 value INTEGER PRIMARY KEY,
 property VARCHAR(15)
);

CREATE TABLE bathrooms
(
 value INTEGER PRIMARY KEY,
 property VARCHAR(15)
);

CREATE TABLE listing_type
(
 value INTEGER PRIMARY KEY,
 property VARCHAR(15)
);

CREATE TABLE storey
(
 value INTEGER PRIMARY KEY,
 property VARCHAR(15)
);

CREATE TABLE building_type
(
 value INTEGER PRIMARY KEY,
 property VARCHAR(15)
);

CREATE TABLE listing_stars
(
 value INTEGER PRIMARY KEY,
 property VARCHAR(15)
);
