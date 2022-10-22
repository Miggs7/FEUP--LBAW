

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
    "id_item" INTEGER REFERENCES item(id)
    CONSTRAINT current_bid check (current_bid>= starting_bid AND current_bid >= 0),
    CONSTRAINT starting_bid check (starting_bid>= 0),
    CONSTRAINT starting_date check (starting_date < ending_date)
);

CREATE TABLE transaction(
    id SERIAL PRIMARY KEY,
    value INTEGER NOT NULL CHECK (value > 0),
    transaction_type text NOT NULL,
    CONSTRAINT transaction_type CHECK ((transaction_type = ANY(ARRAY['Sell'::text, 'Buy'::text,'Deposit'::text,'Cash Out'::text])))
);

CREATE TABLE bidder(
    "id_bidder" INTEGER PRIMARY KEY REFERENCES _user(id) ON DELETE CASCADE,
    "auction_id" INTEGER REFERENCES auction(id) ON DELETE CASCADE,
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
    notification_type TEXT NOT NULL,
    CONSTRAINT notification_type CHECK (("notification_type" = ANY(ARRAY['Auction Status Notification'::text,'Review Notification'::text]))),
    "id_user" INT REFERENCES _user(id) ON DELETE CASCADE,
    "id_auction" INT NOT NULL REFERENCES auction(id) ON DELETE CASCADE,
    "id_review" INT REFERENCES review(id) ON DELETE CASCADE
);

CREATE TABLE category(
	id SERIAL PRIMARY KEY UNIQUE,
    "name" TEXT NOT NULL,
    CONSTRAINT "name" CHECK (("name" = ANY(ARRAY['Jewelry'::text, 'Cars'::text,'Clothing'::text,'Furnitures'::text,'Memorabilia'::text,'Accessories'::text,'Other'::text])))
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