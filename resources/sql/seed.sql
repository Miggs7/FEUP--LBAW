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
    is_banned BOOLEAN DEFAULT FALSE,
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
    current_bid FLOAT,
    starting_bid FLOAT,
    ongoing BOOLEAN DEFAULT TRUE,
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

/*CREATE TABLE bidder(
    "id_bidder" INTEGER PRIMARY KEY REFERENCES _user(id) ON DELETE CASCADE,
    "transaction_id" INTEGER REFERENCES transaction(id) ON DELETE CASCADE
);

CREATE TABLE auctioneer(
    "id_auctioneer" INTEGER PRIMARY KEY REFERENCES _user(id) ON DELETE CASCADE,
    "transaction_id" INTEGER REFERENCES transaction(id) ON DELETE CASCADE
);*/

CREATE TABLE review(
    id SERIAL PRIMARY KEY,
	author TEXT NOT NULL,
    comment TEXT NOT NULL,
    "id_bidder" INTEGER NOT NULL REFERENCES _user(id) ON DELETE CASCADE,
    "id_auctioneer" INTEGER NOT NULL REFERENCES _user(id) ON DELETE CASCADE
);

CREATE TABLE auction_list(
    id SERIAL PRIMARY KEY,
    "id_auctioneer" INT NOT NULL REFERENCES _user(id) ON DELETE CASCADE,
    "id_auction" INT NOT NULL REFERENCES auction(id) ON DELETE CASCADE
);

CREATE TABLE watch_list(
    id SERIAL PRIMARY KEY,
    "id_bidder" INT NOT NULL REFERENCES _user(id) ON DELETE CASCADE,
    "id_auction" INT NOT NULL REFERENCES auction(id) ON DELETE CASCADE
);

CREATE TABLE manage(
    id SERIAL PRIMARY KEY,
    "id_manager" INT NOT NULL REFERENCES manager(id) ON DELETE CASCADE,
    "id_bidder" INT NOT NULL REFERENCES _user(id) ON DELETE CASCADE
);

CREATE TABLE moderate(
    id SERIAL PRIMARY KEY,
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
    id SERIAL PRIMARY KEY,
    "id_category" INT NOT NULL REFERENCES category(id) ON DELETE CASCADE,
    "id_auction" INT NOT NULL REFERENCES auction(id) ON DELETE CASCADE
);

CREATE TABLE auction_image(
    id SERIAL PRIMARY KEY UNIQUE,
    link TEXT NOT NULL UNIQUE,
    "id_auction" INT NOT NULL REFERENCES auction(id) ON DELETE CASCADE
);

CREATE TABLE bid(
    id SERIAL PRIMARY KEY,
    "id_bidder" INT NOT NULL REFERENCES _user(id) ON DELETE CASCADE,
    "id_auction" INT NOT NULL REFERENCES auction(id) ON DELETE CASCADE,
    bid_value FLOAT NOT NULL
);

-----------------------------------------
-- Populate
-----------------------------------------

INSERT INTO _user VALUES(DEFAULT,'Harry_Warren3153@nanoff.biz','gmcleoid0','Harry Warren','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W',40,DEFAULT);
INSERT INTO _user VALUES(DEFAULT,'Bree_Hepburn4560@bauros.biz','asmewin1','Bree Hepburn','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W',99,DEFAULT);
INSERT INTO _user VALUES(DEFAULT,'Tony_Wellington1196@naiker.biz','apoulden2','Tony Wellington','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W',90,DEFAULT);
INSERT INTO _user VALUES(DEFAULT,'Harvey_Briggs7652@corti.com','etraynor3','Harvey Briggs','	$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W',48,DEFAULT);
INSERT INTO _user VALUES(DEFAULT,'Allison_Appleton3129@twace.org','ghanvey4','Allison Appleton','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W',86,DEFAULT);
INSERT INTO _user VALUES(DEFAULT,'Benjamin_Vince3261@nickia.com','abickle5','Benjamin Vince','	$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W',92,DEFAULT);
INSERT INTO _user VALUES(DEFAULT,'Henry_Barrett1954@deons.tech','gmaisey6','Henry Barrett','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W',95,DEFAULT);
INSERT INTO _user VALUES(DEFAULT,'Rocco_Dunbar6506@bretoux.com','sgavahan7', 'Rocco Dunbar','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W',55,DEFAULT);
INSERT INTO _user VALUES(DEFAULT,'Cristal_Pearce6806@supunk.biz','sbolesma8','Cristal Pearce','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W',80,DEFAULT);
INSERT INTO _user VALUES(DEFAULT,'Chris_Johnson6157@guentu.biz','ggallelli9','Chris Johnson','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W',61,DEFAULT);
INSERT INTO _user VALUES(DEFAULT,'Daron_Baxter1161@ovock.tech','mwaytea','Daron Baxter','	$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W',36,DEFAULT);
INSERT INTO _user VALUES(DEFAULT,'William_Purvis4083@liret.org','mludyb','William Purvis','	$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W',72,DEFAULT);
INSERT INTO _user VALUES(DEFAULT,'Lucas_Newman8198@nimogy.biz','awardesworthc','Lucas Newman','	$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W',28,DEFAULT);
INSERT INTO _user VALUES(DEFAULT,'Hailey_Stanley2818@corti.com','mhuied','Hailey Stanley','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W',93,DEFAULT);
INSERT INTO _user VALUES(DEFAULT,'Doug_Bailey1953@famism.biz','lfowlse','Doug Bailey','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W',53,DEFAULT);
INSERT INTO _user VALUES(DEFAULT,'Allison_Buckley3465@bulaffy.com','cscannellf','Allison Buckley','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W',19,DEFAULT);
INSERT INTO _user VALUES(DEFAULT,'Ramon_Adams1655@kideod.biz','hkeithg','Ramon Adams','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W',80,DEFAULT);
INSERT INTO _user VALUES(DEFAULT,'Chris_Wise1974@naiker.biz','hmanuellih','Chris Wise','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W',70,DEFAULT);
INSERT INTO _user VALUES(DEFAULT,'Cherish_Waterhouse4762@qater.org','bbrainsbyi','Cherish Waterhouse','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W',30,DEFAULT);
INSERT INTO _user VALUES(DEFAULT,'Wendy_Jennson1741@yahoo.com','jmcgawj','Wendy Jennson','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W',27,DEFAULT);


-- create admins

INSERT INTO manager VALUES(DEFAULT,'example@admin.com','Admin','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W');
INSERT INTO manager VALUES(DEFAULT,'Marvin_Marshall2818@typill.biz','Marvin Marshall','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W');
INSERT INTO manager VALUES(DEFAULT,'Lauren_Reyes2900@irrepsy.com','Lauren Reyes','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W');
INSERT INTO manager VALUES(DEFAULT,'Mike_Lee7536@ubusive.com','Mike Lee','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W');


-- create items
INSERT INTO item VALUES(DEFAULT, 'Makena','This is a medicine', 8);
INSERT INTO item VALUES(DEFAULT,'Symbicort','This is a medicine', 10);
INSERT INTO item VALUES(DEFAULT,'Zoloft', 'This is a medicine', 7);

INSERT INTO item VALUES(DEFAULT, 'Orange Bird', 'This is a drink', 5);
INSERT INTO item VALUES(DEFAULT, 'Guaranito','This is a drink', 5);
INSERT INTO item VALUES(DEFAULT,'Malibu','This is a drink', 4);

INSERT INTO item VALUES(DEFAULT,'Forever 21', 'This is clothing', 8);
INSERT INTO item VALUES(DEFAULT,'Angels Jeanswear','This is clothing', 7);
INSERT INTO item VALUES(DEFAULT,'SABA','This is clothing', 1);

-- create auction


INSERT INTO auction VALUES(DEFAULT,'Orange Bird','This is an auction', 'Saturday, October 1, 2022 5:58 PM', 'Monday, December 3, 2022 5:58 PM',13333, 12136,DEFAULT, 7);
INSERT INTO auction VALUES(DEFAULT,'Malibu', 'This is an auction','Saturday, October 1, 2022 9:42 PM', 'Monday, December 17, 2022 8:42 PM', 42289, 42289,DEFAULT, 4);
INSERT INTO auction VALUES(DEFAULT,'Makena', 'This is an auction','Friday, October 7, 2022 5:01 PM', 'Monday, December 17, 2022 8:42 PM',53087, 51079,DEFAULT,1);

INSERT INTO transaction VALUES(DEFAULT, 25500, 'Buy');

/*INSERT INTO bidder VALUES (1, 1);
INSERT INTO bidder VALUES (2);
INSERT INTO bidder VALUES (3);
INSERT INTO bidder VALUES (4);
INSERT INTO bidder VALUES (5);
INSERT INTO bidder VALUES (6);
INSERT INTO bidder VALUES (7);
INSERT INTO bidder VALUES (8);
INSERT INTO bidder VALUES (9, 1);
INSERT INTO bidder VALUES (10);
INSERT INTO bidder VALUES (12);
INSERT INTO bidder VALUES (13);
INSERT INTO bidder VALUES (14);
INSERT INTO bidder VALUES (15);
INSERT INTO bidder VALUES (16);
INSERT INTO bidder VALUES (17);
INSERT INTO bidder VALUES (18);
INSERT INTO bidder VALUES (19);
INSERT INTO bidder VALUES (20);

INSERT INTO auctioneer VALUES (1, 1);
INSERT INTO auctioneer VALUES (2);
INSERT INTO auctioneer VALUES (3);
INSERT INTO auctioneer VALUES (4);
INSERT INTO auctioneer VALUES (5);
INSERT INTO auctioneer VALUES (6);
INSERT INTO auctioneer VALUES (7);
INSERT INTO auctioneer VALUES (8);
INSERT INTO auctioneer VALUES (9);
INSERT INTO auctioneer VALUES (10);
INSERT INTO auctioneer VALUES (11);
INSERT INTO auctioneer VALUES (12);
INSERT INTO auctioneer VALUES (13);
INSERT INTO auctioneer VALUES (14);
INSERT INTO auctioneer VALUES (15);
INSERT INTO auctioneer VALUES (16);
INSERT INTO auctioneer VALUES (17);
INSERT INTO auctioneer VALUES (18);
INSERT INTO auctioneer VALUES (19);
INSERT INTO auctioneer VALUES (20);
*/

INSERT INTO review VALUES(DEFAULT, 'Annonymous clown', 'Product does not match the description! It is awful', 1, 6);
INSERT INTO review VALUES(DEFAULT, 'Grandma', 'Amazing, this car will make my friends jealous', 1, 6);

INSERT INTO notification VALUES(DEFAULT, 'Saturday, October 1, 2022 9:42 PM', 'You won the auction', 'Auction Status Notification',1, 1, 1);

INSERT INTO auction_image VALUES(DEFAULT, 'https://cdn.shopify.com/s/files/1/0017/2100/8243/products/QX-1_FRONT_BrightRed_400x.jpg?v=1610646148',1);
INSERT INTO auction_image VALUES(DEFAULT, 'https://france-export-fv-online.com/6484-large_default/absolut-vodka.jpg',2);
INSERT INTO auction_image VALUES(DEFAULT, 'https://s0.minipreco.pt/medias/h9b/hf3/9005083033630.jpg',3);


INSERT INTO category VALUES(DEFAULT, 'Clothing');
INSERT INTO category VALUES(DEFAULT, 'Other');
INSERT INTO category VALUES(DEFAULT, 'Cars');
INSERT INTO category VALUES(DEFAULT, 'Jewelry');
INSERT INTO category VALUES(DEFAULT, 'Furnitures');
INSERT INTO category VALUES(DEFAULT, 'Accessories');
INSERT INTO category VALUES(DEFAULT, 'Memorabilia');

INSERT INTO auction_category VALUES(DEFAULT,1, 1);
INSERT INTO auction_category VALUES(DEFAULT,2, 2);
INSERT INTO auction_category VALUES(DEFAULT,2, 3);

INSERT INTO manage VALUES(DEFAULT,1, 3);
INSERT INTO manage VALUES(DEFAULT,2, 1);

INSERT INTO moderate VALUES(DEFAULT,1, 2);
INSERT INTO moderate VALUES(DEFAULT,2, 1);

INSERT INTO auction_list VALUES(DEFAULT,6, 1);
INSERT INTO auction_list VALUES(DEFAULT,7, 2);
INSERT INTO auction_list VALUES(DEFAULT,1, 3);

INSERT INTO watch_list VALUES(DEFAULT,1, 1);

-----------------------------------------
-- INDEX
-----------------------------------------
DROP INDEX IF EXISTS bid_auction CASCADE;
DROP INDEX IF EXISTS bid_v CASCADE;
DROP INDEX IF EXISTS auction_item CASCADE;
DROP INDEX IF EXISTS search_item CASCADE;

CREATE INDEX bid_auction ON bid USING hash(id_auction);
CREATE INDEX bid_v ON bid USING hash(bid_value);
CREATE INDEX auction_item ON auction USING hash(id_item);
CREATE INDEX search_item ON item USING GIST (to_tsvector('english', name));

-----------------------------------------
-- Triggers
-----------------------------------------

-- TRIGGER 1 Edit review comment by owner
DROP FUNCTION IF EXISTS edit_review_comment CASCADE;
CREATE FUNCTION edit_review_comment() RETURNS trigger AS
$BODY$
BEGIN
    UPDATE review SET comment = NEW.comment WHERE id = OLD.id;
    RETURN NEW;
END;
$BODY$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS edit_review_comment on review CASCADE;
CREATE TRIGGER edit_review_comment
AFTER UPDATE ON review
FOR EACH ROW
EXECUTE PROCEDURE edit_review_comment();

-- TRIGGER 2 stop auction from being ongoing (BR04)
DROP FUNCTION IF EXISTS auction_time_expired CASCADE;
CREATE FUNCTION auction_time_expired () RETURNS trigger AS
$BODY$
BEGIN
    IF(OLD.ending_date >= now()) THEN
        NEW.ongoing = 0;
    END IF;
    RETURN NEW;
END;
$BODY$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS auction_time_expired on auction CASCADE;
CREATE TRIGGER auction_time_expired
BEFORE UPDATE ON auction
FOR EACH ROW
EXECUTE PROCEDURE auction_time_expired();


-- TRIGGER 3 Only let being bid values bigger than the current(BR06)

DROP FUNCTION IF EXISTS check_bid CASCADE;
CREATE FUNCTION check_bid () RETURNS trigger AS
$BODY$
BEGIN
    IF((NEW.current_bid >= OLD.current_bid) AND OLD.ongoing = TRUE) THEN
        --NEW.current_bid = NEW.current_bid;
        RETURN NEW;
    END IF;
    RETURN OLD;
END;
$BODY$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS check_bid on auction CASCADE;
CREATE TRIGGER check_bid
BEFORE UPDATE ON auction
FOR EACH ROW
EXECUTE PROCEDURE check_bid();

--TRIGGER 04 add auction to watch list after bidding

DROP FUNCTION IF EXISTS add_auction_to_watch_list CASCADE;
CREATE FUNCTION add_auction_to_watch_list() RETURNS trigger AS
$BODY$
BEGIN
    INSERT INTO watch_list VALUES (NEW.id_bidder, NEW.id_auction);
    RETURN NEW;
END;
$BODY$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS add_auction_to_watch_list on bid CASCADE;
CREATE TRIGGER add_auction_to_watch_list
AFTER INSERT ON bid
FOR EACH ROW
EXECUTE PROCEDURE add_auction_to_watch_list();

--TRIGGER 05 remove auction from watch_list after cancelling 

DROP FUNCTION IF EXISTS remove_auction_from_watch_list CASCADE;
CREATE FUNCTION remove_auction_from_watch_list() RETURNS trigger AS
$BODY$
BEGIN
    DELETE FROM watch_list WHERE id_auction = OLD.id_auction;
    RETURN OLD;
END;
$BODY$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS remove_auction_from_watch_list on bid CASCADE;
CREATE TRIGGER remove_auction_from_watch_list
AFTER DELETE ON bid
FOR EACH ROW
EXECUTE PROCEDURE remove_auction_from_watch_list();




