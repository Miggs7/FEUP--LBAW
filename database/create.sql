-----------------------------------------
-- Domain schema
-----------------------------------------

DROP DOMAIN IF EXISTS "Today";
CREATE DOMAIN "Today" AS date NOT NULL DEFAULT ('now'::text)::date;

-----------------------------------------
-- Drop old schema
-----------------------------------------

DROP TABLE IF EXISTS manager CASCADE;
DROP TABLE IF EXISTS _user CASCADE;
DROP TABLE IF EXISTS item CASCADE;
DROP TABLE IF EXISTS auction CASCADE;
DROP TABLE IF EXISTS transaction CASCADE;
DROP TABLE IF EXISTS bidder CASCADE;
DROP TABLE IF EXISTS auctioneer CASCADE;
DROP TABLE IF EXISTS review CASCADE;
DROP TABLE IF EXISTS auction_list CASCADE;
DROP TABLE IF EXISTS watch_list CASCADE;
DROP TABLE IF EXISTS manage CASCADE;
DROP TABLE IF EXISTS moderate CASCADE;
DROP TABLE IF EXISTS notification CASCADE;
DROP TABLE IF EXISTS category CASCADE;
DROP TABLE IF EXISTS auction_category CASCADE;
DROP TABLE IF EXISTS auction_image CASCADE;
DROP TABLE IF EXISTS bid CASCADE;

-----------------------------------------
-- Types
-----------------------------------------
DROP TYPE IF EXISTS notification_type;
DROP TYPE IF EXISTS transaction_type;
DROP TYPE IF EXISTS category_name;

CREATE TYPE notification_type AS ENUM  ('Auction Status Notification', 'Review Notification');
CREATE TYPE transaction_type AS ENUM ('Sell', 'Buy', 'Deposit', 'Cash Out');
CREATE TYPE category_name AS ENUM ('Jewelry', 'Cars', 'Clothing', 'Furnitures', 'Memorabilia', 'Accessories', 'Other');

-----------------------------------------
-- Tables
-----------------------------------------

CREATE TABLE manager(
    id SERIAL PRIMARY KEY,
    email TEXT NOT NULL unique,
    name TEXT NOT NULL,
    password TEXT NOT NULL
);

CREATE TABLE _user(
    id SERIAL PRIMARY KEY,
    email TEXT NOT NULL unique,
	username TEXT NOT NULL UNIQUE,
    name TEXT NOT NULL,
    password TEXT NOT NULL,
    age INT,
    CONSTRAINT age CHECK (age >= 17)
);

CREATE TABLE item(
    id SERIAL PRIMARY KEY ,
    name TEXT NOT NULL,
    description TEXT NOT NULL,
	"id_bidder" INTEGER REFERENCES _user(id) ON DELETE CASCADE
);

CREATE TABLE auction(
    id SERIAL PRIMARY KEY,
    name TEXT NOT NULL,
    description TEXT NOT NULL,
    "starting_date" TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
    "ending_date" TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
    current_bid INT,
    starting_bid INT,
    "id_item" INTEGER NOT NULL REFERENCES item(id),
    CONSTRAINT current_bid check (current_bid>= starting_bid AND current_bid >= 0),
    CONSTRAINT starting_bid check (starting_bid>= 0),
    CONSTRAINT starting_date check (starting_date < ending_date)
);

CREATE TABLE transaction(
    id SERIAL PRIMARY KEY,
    value INTEGER NOT NULL CHECK (value > 0),
    type transaction_type NOT NULL
);

CREATE TABLE bidder(
    "id_bidder" INTEGER PRIMARY KEY REFERENCES _user(id) ON DELETE CASCADE,
    "transaction_id" INTEGER REFERENCES transaction(id) ON DELETE CASCADE
);

CREATE TABLE auctioneer(
    "id_auctioneer" INTEGER PRIMARY KEY REFERENCES _user(id) ON DELETE CASCADE,
    "transaction_id" INTEGER REFERENCES transaction(id) ON DELETE CASCADE
);

CREATE TABLE review(
    id SERIAL PRIMARY KEY,
	author TEXT NOT NULL,
    comment TEXT NOT NULL,
    "id_bidder" INTEGER NOT NULL REFERENCES bidder("id_bidder") ON DELETE CASCADE,
    "id_auctioneer" INTEGER NOT NULL REFERENCES auctioneer("id_auctioneer") ON DELETE CASCADE
);

CREATE TABLE auction_list(
    "id_auctioneer" INT NOT NULL REFERENCES auctioneer("id_auctioneer") ON DELETE CASCADE,
	"id_auction" INT NOT NULL REFERENCES auction(id) ON DELETE CASCADE
);

CREATE TABLE watch_list(
    "id_bidder" INT NOT NULL REFERENCES bidder("id_bidder") ON DELETE CASCADE,
	"id_auction" INT NOT NULL REFERENCES auction(id) ON DELETE CASCADE
);

CREATE TABLE manage(
    "id_manager" INT NOT NULL REFERENCES manager(id) ON DELETE CASCADE,
    "id_bidder" INT NOT NULL REFERENCES bidder("id_bidder") ON DELETE CASCADE
);

CREATE TABLE moderate(
    "id_manager" INT NOT NULL REFERENCES manager(id) ON DELETE CASCADE,
    "id_auction" INT NOT NULL REFERENCES auction(id) ON DELETE CASCADE
);

CREATE TABLE notification(
    id SERIAL PRIMARY KEY,
    "date" TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
    text TEXT NOT NULL,
    type notification_type NOT NULL,
    "id_user" INT NOT NULL REFERENCES _user(id) ON DELETE CASCADE,
    "id_auction" INT REFERENCES auction(id) ON DELETE CASCADE,
    "id_review" INT REFERENCES review(id) ON DELETE CASCADE
);

CREATE TABLE category(
	id SERIAL PRIMARY KEY UNIQUE,
    type category_name NOT NULL
);

CREATE TABLE auction_category(
    "id_category" INT NOT NULL REFERENCES category(id) ON DELETE CASCADE,
    "id_auction" INT NOT NULL REFERENCES auction(id) ON DELETE CASCADE
);

CREATE TABLE auction_image(
	id SERIAL PRIMARY KEY UNIQUE,
    link TEXT NOT NULL UNIQUE,
    "id_auction" INT NOT NULL REFERENCES auction(id) ON DELETE CASCADE
);

CREATE TABLE bid(
    "id_bidder" INT PRIMARY KEY REFERENCES bidder("id_bidder") ON DELETE CASCADE,
    "id_auction" INT NOT NULL REFERENCES auction(id) ON DELETE CASCADE,
    bid_value FLOAT NOT NULL CHECK (bid_value >= 5.00)
);