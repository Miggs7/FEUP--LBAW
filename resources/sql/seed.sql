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
DROP TABLE IF EXISTS payment CASCADE;
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
--DROP TYPE IF EXISTS transaction_type;
DROP TYPE IF EXISTS category_name;

CREATE TYPE notification_type AS ENUM  ('Auction Status Notification', 'Review Notification');
--CREATE TYPE transaction_type AS ENUM ('Sell', 'Buy', 'Deposit', 'Cash Out');
CREATE TYPE category_name AS ENUM ('Jewelry', 'Cars', 'Clothing', 'Furnitures', 'Memorabilia', 'Accessories', 'Games');

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
    profile_picture TEXT,
    is_banned BOOLEAN DEFAULT FALSE,
    CONSTRAINT age CHECK (age >= 17)
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
    CONSTRAINT current_bid check (current_bid>= starting_bid AND current_bid >= 0),
    CONSTRAINT starting_bid check (starting_bid>= 0),
    CONSTRAINT starting_date check (starting_date < ending_date)
);

CREATE TABLE payment(
    id SERIAL,
    value INTEGER NOT NULL,
    "id_bidder" INTEGER NOT NULL REFERENCES _user(id) ON DELETE CASCADE,
    "id_auctioneer" INTEGER NOT NULL REFERENCES _user(id) ON DELETE CASCADE,
    "id_auction" INT NOT NULL REFERENCES auction(id) ON DELETE CASCADE,
    CONSTRAINT pk_payment PRIMARY KEY (id,id_auction)
);

CREATE TABLE review(
    id SERIAL PRIMARY KEY,
	author INTEGER NOT NULL REFERENCES _user(id) ON DELETE CASCADE,
    comment TEXT NOT NULL,
    rating INTEGER NOT NULL,
    review_date TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
    "id_bidder" INTEGER NOT NULL REFERENCES _user(id) ON DELETE CASCADE,
    "id_auctioneer" INTEGER NOT NULL REFERENCES _user(id) ON DELETE CASCADE,
    CONSTRAINT author CHECK (author = "id_bidder" OR author = "id_auctioneer"),
    CONSTRAINT rating CHECK (rating >= 1 AND rating <= 5)
);

CREATE TABLE auction_list(
    id SERIAL PRIMARY KEY,
    "id_auctioneer" INT NOT NULL REFERENCES _user(id) ON DELETE CASCADE,
    "id_auction" INT NOT NULL REFERENCES auction(id) ON DELETE CASCADE
);

CREATE TABLE watch_list(
    id SERIAL PRIMARY KEY,
    "id_bidder" INT NOT NULL REFERENCES _user(id) ON DELETE CASCADE,
    "id_auction" INT NOT NULL REFERENCES auction(id) ON DELETE CASCADE,
    CONSTRAINT user_watch_list UNIQUE (id_bidder,id_auction)
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
INSERT INTO _user VALUES(DEFAULT,'Harvey_Briggs7652@corti.com','etraynor3','Harvey Briggs','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W',48,DEFAULT);
INSERT INTO _user VALUES(DEFAULT,'Allison_Appleton3129@twace.org','ghanvey4','Allison Appleton','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W',86,DEFAULT);
INSERT INTO _user VALUES(DEFAULT,'Benjamin_Vince3261@nickia.com','abickle5','Benjamin Vince','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W',92,DEFAULT);
INSERT INTO _user VALUES(DEFAULT,'Henry_Barrett1954@deons.tech','gmaisey6','Henry Barrett','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W',95,DEFAULT);
INSERT INTO _user VALUES(DEFAULT,'Rocco_Dunbar6506@bretoux.com','sgavahan7', 'Rocco Dunbar','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W',55,DEFAULT);
INSERT INTO _user VALUES(DEFAULT,'Cristal_Pearce6806@supunk.biz','sbolesma8','Cristal Pearce','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W',80,DEFAULT);
INSERT INTO _user VALUES(DEFAULT,'Chris_Johnson6157@guentu.biz','ggallelli9','Chris Johnson','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W',61,DEFAULT);
INSERT INTO _user VALUES(DEFAULT,'Daron_Baxter1161@ovock.tech','mwaytea','Daron Baxter','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W',36,DEFAULT);
INSERT INTO _user VALUES(DEFAULT,'William_Purvis4083@liret.org','mludyb','William Purvis','	$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W',72,DEFAULT);
INSERT INTO _user VALUES(DEFAULT,'Lucas_Newman8198@nimogy.biz','awardesworthc','Lucas Newman','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W',28,DEFAULT);
INSERT INTO _user VALUES(DEFAULT,'Hailey_Stanley2818@corti.com','mhuied','Hailey Stanley','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W',93,DEFAULT);
INSERT INTO _user VALUES(DEFAULT,'Doug_Bailey1953@famism.biz','lfowlse','Doug Bailey','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W',53,DEFAULT);
INSERT INTO _user VALUES(DEFAULT,'Allison_Buckley3465@bulaffy.com','cscannellf','Allison Buckley','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W',19,DEFAULT);
INSERT INTO _user VALUES(DEFAULT,'Ramon_Adams1655@kideod.biz','hkeithg','Ramon Adams','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W',80,DEFAULT);
INSERT INTO _user VALUES(DEFAULT,'Chris_Wise1974@naiker.biz','hmanuellih','Chris Wise','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W',70,DEFAULT);
INSERT INTO _user VALUES(DEFAULT,'Cherish_Waterhouse4762@qater.org','bbrainsbyi','Cherish Waterhouse','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W',30,DEFAULT);
INSERT INTO _user VALUES(DEFAULT,'Wendy_Jennson1741@yahoo.com','jmcgawj','Wendy Jennson','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W',27,DEFAULT);

INSERT INTO manager VALUES(DEFAULT,'example@admin.com','Admin','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W');
INSERT INTO manager VALUES(DEFAULT,'Marvin_Marshall2818@typill.biz','Marvin Marshall','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W');
INSERT INTO manager VALUES(DEFAULT,'Lauren_Reyes2900@irrepsy.com','Lauren Reyes','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W');
INSERT INTO manager VALUES(DEFAULT,'Mike_Lee7536@ubusive.com','Mike Lee','$2y$10$HfzIhGCCaxqyaIdGgjARSuOKAcm1Uy82YfLuNaajn6JrjLWy9Sj/W');

INSERT INTO category VALUES(DEFAULT, 'Clothing');
INSERT INTO category VALUES(DEFAULT, 'Games');
INSERT INTO category VALUES(DEFAULT, 'Cars');
INSERT INTO category VALUES(DEFAULT, 'Jewelry');
INSERT INTO category VALUES(DEFAULT, 'Furnitures');
INSERT INTO category VALUES(DEFAULT, 'Accessories');
INSERT INTO category VALUES(DEFAULT, 'Memorabilia');

INSERT INTO auction VALUES(DEFAULT,'Black T-shirt','Quality Shirt', DEFAULT, 'Monday, January 10, 2023 5:58 PM',10, 10,DEFAULT);
INSERT INTO auction_image VALUES(DEFAULT, '/images/auction/auction1.png',1);
INSERT INTO auction_category VALUES(DEFAULT,1, 1);

INSERT INTO auction VALUES(DEFAULT,'Jacket', 'Nice Jacket',DEFAULT, 'Monday, January 10, 2023 5:58 PM', 30, 30,DEFAULT);
INSERT INTO auction_image VALUES(DEFAULT, '/images/auction/auction2.png',2);
INSERT INTO auction_category VALUES(DEFAULT,1, 2);

INSERT INTO auction VALUES(DEFAULT,'Suit', 'Very Stylish',DEFAULT, 'Monday, January 10,, 2023 8:42 PM',100, 100,DEFAULT);
INSERT INTO auction_image VALUES(DEFAULT, '/images/auction/auction3.jpg',3);
INSERT INTO auction_category VALUES(DEFAULT,1, 3);

INSERT INTO auction VALUES(DEFAULT,'Super Mario 64','A very nice classic', DEFAULT, 'Monday, January 10, 2023 5:58 PM',30, 30,DEFAULT);
INSERT INTO auction_image VALUES(DEFAULT, '/images/auction/auction4.jpg',4);
INSERT INTO auction_category VALUES(DEFAULT,2, 4);

INSERT INTO auction VALUES(DEFAULT,'Yakuza 0','A modern classic', DEFAULT, 'Monday, January 10, 2023 5:58 PM',10, 10,DEFAULT);
INSERT INTO auction_image VALUES(DEFAULT, '/images/auction/auction5.png',5);
INSERT INTO auction_category VALUES(DEFAULT,2, 5);

INSERT INTO auction VALUES(DEFAULT,'Pokemon HeartGold','Rare game', DEFAULT, 'Monday, January 10, 2023 5:58 PM',100, 100,DEFAULT);
INSERT INTO auction_image VALUES(DEFAULT, '/images/auction/auction6.jpg',6);
INSERT INTO auction_category VALUES(DEFAULT,2, 6);

INSERT INTO auction VALUES(DEFAULT,'Toyota AE86','Initial D', DEFAULT, 'Monday, January 10, 2023 5:58 PM',9876, 9876,DEFAULT);
INSERT INTO auction_image VALUES(DEFAULT, '/images/auction/auction7.jpg',7);
INSERT INTO auction_category VALUES(DEFAULT,3, 7);

INSERT INTO auction VALUES(DEFAULT,'Tesla','Electric Car', DEFAULT, 'Monday, January 10, 2023 5:58 PM',50000, 50000,DEFAULT);
INSERT INTO auction_image VALUES(DEFAULT, '/images/auction/auction8.png',8);
INSERT INTO auction_category VALUES(DEFAULT,3, 8);

INSERT INTO auction VALUES(DEFAULT,'Ferrari','Luxury Car', DEFAULT, 'Monday, January 10, 2023 5:58 PM',400000, 400000,DEFAULT);
INSERT INTO auction_image VALUES(DEFAULT, '/images/auction/auction9.png',9);
INSERT INTO auction_category VALUES(DEFAULT,3, 9);

INSERT INTO auction VALUES(DEFAULT,'Ring','Made of Iron', DEFAULT, 'Monday, January 10, 2023 5:58 PM',25, 25,DEFAULT);
INSERT INTO auction_image VALUES(DEFAULT, '/images/auction/auction10.jpg',10);
INSERT INTO auction_category VALUES(DEFAULT,4,10);

INSERT INTO auction VALUES(DEFAULT,'Bracelet','Made of Pearls', DEFAULT, 'Monday, January 10, 2023 5:58 PM',10, 10,DEFAULT);
INSERT INTO auction_image VALUES(DEFAULT, '/images/auction/auction11.jpg',11);
INSERT INTO auction_category VALUES(DEFAULT,4, 11);
INSERT INTO auction_category VALUES(DEFAULT,6, 11);

INSERT INTO auction VALUES(DEFAULT,'Couch','Very Comfortable', DEFAULT, 'Monday, January 10, 2023 5:58 PM',200, 200,DEFAULT);
INSERT INTO auction_image VALUES(DEFAULT, '/images/auction/auction12.png',12);
INSERT INTO auction_category VALUES(DEFAULT,5, 12);

INSERT INTO auction VALUES(DEFAULT,'Office Chair','For long work', DEFAULT, 'Monday, January 10, 2023 5:58 PM',100, 100,DEFAULT);
INSERT INTO auction_image VALUES(DEFAULT, '/images/auction/auction13.png',13);
INSERT INTO auction_category VALUES(DEFAULT,5, 13);

INSERT INTO auction VALUES(DEFAULT,'Closet','Very Spaceful', DEFAULT, 'Monday, January 10, 2023 5:58 PM',150, 150,DEFAULT);
INSERT INTO auction_image VALUES(DEFAULT, '/images/auction/auction14.png',14);
INSERT INTO auction_category VALUES(DEFAULT,5, 14);

INSERT INTO auction VALUES(DEFAULT,'Charizard Card','Rare Card', DEFAULT, 'Monday, January 10, 2023 5:58 PM',500, 500,DEFAULT);
INSERT INTO auction_image VALUES(DEFAULT, '/images/auction/auction15.jpg',15);
INSERT INTO auction_category VALUES(DEFAULT,7, 15);

INSERT INTO auction VALUES(DEFAULT,'Pikachu Card','Common Card', DEFAULT, 'Monday, January 10, 2023 5:58 PM',10, 10,DEFAULT);
INSERT INTO auction_image VALUES(DEFAULT, '/images/auction/auction16.jpg',16);
INSERT INTO auction_category VALUES(DEFAULT,7, 16);

INSERT INTO auction VALUES(DEFAULT,'Squirtle Card','Common Card', DEFAULT, 'Monday, January 10, 2023 5:58 PM',15, 15,DEFAULT);
INSERT INTO auction_image VALUES(DEFAULT, '/images/auction/auction17.jpg',17);
INSERT INTO auction_category VALUES(DEFAULT,7, 17);

INSERT INTO auction_list VALUES(DEFAULT,6, 1);
INSERT INTO auction_list VALUES(DEFAULT,7, 2);
INSERT INTO auction_list VALUES(DEFAULT,2, 3);
INSERT INTO auction_list VALUES(DEFAULT,5, 4);
INSERT INTO auction_list VALUES(DEFAULT,10, 5);
INSERT INTO auction_list VALUES(DEFAULT,11, 6);
INSERT INTO auction_list VALUES(DEFAULT,15, 7);
INSERT INTO auction_list VALUES(DEFAULT,13, 8);
INSERT INTO auction_list VALUES(DEFAULT,12, 9);
INSERT INTO auction_list VALUES(DEFAULT,2, 10);
INSERT INTO auction_list VALUES(DEFAULT,5, 11);
INSERT INTO auction_list VALUES(DEFAULT,1, 12);
INSERT INTO auction_list VALUES(DEFAULT,7, 13);
INSERT INTO auction_list VALUES(DEFAULT,9, 14);
INSERT INTO auction_list VALUES(DEFAULT,10, 15);
INSERT INTO auction_list VALUES(DEFAULT,11, 16);
INSERT INTO auction_list VALUES(DEFAULT,12, 17);

INSERT INTO manage VALUES(DEFAULT,1, 3);
INSERT INTO manage VALUES(DEFAULT,2, 1);

INSERT INTO moderate VALUES(DEFAULT,1, 2);
INSERT INTO moderate VALUES(DEFAULT,2, 1);



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
--CREATE INDEX auction_item ON auction USING hash(id_item);
--CREATE INDEX search_item ON item USING GIST (to_tsvector('english', name));

-----------------------------------------
-- Triggers
-----------------------------------------

-- TRIGGER 1 Edit review comment by owner
/*DROP FUNCTION IF EXISTS edit_review_comment CASCADE;
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
*/

-- TRIGGER 2 stop auction from being ongoing (BR04)
DROP FUNCTION IF EXISTS auction_time_expired CASCADE;
CREATE FUNCTION auction_time_expired () RETURNS trigger AS
$BODY$
BEGIN
    IF(OLD.ending_date <= now()) THEN
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
    IF NOT EXISTS (select id_bidder,id_auction from watch_list where id_bidder=new.id_bidder AND id_auction= new.id_auction) THEN
    INSERT INTO watch_list VALUES (DEFAULT,NEW.id_bidder, NEW.id_auction);
    RETURN NEW;
    END IF;
    RETURN NULL;
END;
$BODY$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS add_auction_to_watch_list on bid CASCADE;
CREATE TRIGGER add_auction_to_watch_list
AFTER INSERT ON bid
FOR EACH ROW
EXECUTE PROCEDURE add_auction_to_watch_list();


