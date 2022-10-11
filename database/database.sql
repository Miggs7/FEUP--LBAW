DROP TABLE IF EXISTS manager;
DROP TABLE IF EXISTS bidder;
DROP TABLE IF EXISTS review;
DROP TABLE IF EXISTS item;
DROP TABLE IF EXISTS auction;
DROP TABLE IF EXISTS auctioneer;

-----------------------------------------
-- Tables
-----------------------------------------

CREATE TABLE manager
{
    _id SERIAL PRIMARY KEY unique,
    email TEXT NOT NULL unique,
    _name TEXT NOT NULL,
    _password TEXT NOT NULL
}

CREATE TABLE user
{
    _id SERIAL PRIMARY KEY unique,
    email TEXT NOT NULL unique,
    _name TEXT NOT NULL,
    _password TEXT NOT NULL,
    age INT,
    CONSTRAINT age CHECK (age >= 17)
}

CREATE TABLE item
{
    _id SERIAL PRIMARY KEY unique,
    _description TEXT NOT NULL,
    _name TEXT NOT NULL
}

CREATE TABLE review
{
    _id SERIAL PRIMARY KEY unique,
    _comment TEXT NOT NULL
}

CREATE TABLE auction
{
    _id SERIAL PRIMARY KEY unique,
    _name TEXT NOT NULL,
    starting_date DATE,
    ending_date DATE,
    current_bid INT,
    starting_bid INT,
    current_winner bidder,
    CONSTRAINT current_bid check (current_bid>= starting_bid),
    CONSTRAINT starting_date check (starting_date < ending_date)
}