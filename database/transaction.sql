--TRAN01
-- CREATE SQL TRANSACTION
BEGIN TRANSACTION;
SET TRANSACTION ISOLATION LEVEL REPEATABLE READ;

-- INSERT NEW ITEM INTO DATABASE

INSERT INTO item(id, name, description,"id_bidder") 
VALUES($id, $name, $description, $id_bidder);

INSERT INTO auction(id, name, description, "starting_date", "ending_date", current_bid, starting_bid, ongoing, "id_item") 
VALUES($id, $name, $description, $starting_date, $ending_date, $current_bid, $starting_bid, $ongoing, currval('item_id_seq'));

END TRANSACTION;    

COMMIT;

--TRAN02
-- CREATE SQL TRANSACTION
BEGIN TRANSACTION;

SET TRANSACTION ISOLATION LEVEL REPEATABLE READ;

-- update current bid value in auction
UPDATE auction SET current_bid = $bid_value WHERE id = $id_auction;

--insert bid
INSERT INTO bid(id_bidder,id_auction,bid_value)
VALUES($id_bidder,$id_auction,$bid_value);

COMMIT;

