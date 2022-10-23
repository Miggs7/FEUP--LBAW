--TR01
BEGIN TRANSACTION;

SET TRANSACTION ISOLATION LEVEL REPEATABLE READ

-- Insert item
INSERT INTO item (name,description)
 VALUES ($name, $description);

-- Insert auction
INSERT INTO auction (name, description, starting_date, ending_date, current_bid, starting_bid, id_item)
 VALUES ($name,$description,$starting_date,$ending_date,$current_bid,$starting_bid,$id_item);

END TRANSACTION;

--TR02
BEGIN TRANSACTION;
SET TRANSACTION SERIALIZED READ ONLY;

-- fetch bid history for a given auction
SELECT user.username as username, bid.bid_value as value
	FROM bid 
	INNER JOIN user 
	ON user.id = bid.bidder_id AND bid.auction_id = $auction_id
	ORDER BY value DESC LIMIT 10;

-- get highest bid for a given auction
SELECT bid_value as value
	FROM bid
	WHERE auction.id = bid.auction_id
	ORDER BY value DESC LIMIT 1;

COMMIT;
