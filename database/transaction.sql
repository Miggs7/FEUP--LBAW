--TR01
BEGIN TRANSACTION;
SET TRANSACTION ISOLATION LEVEL SERIALIZABLE;

-- fetch bid history for a given auction
SELECT _user.username as username, bid.bid_value as bid_value
	FROM bid 
	INNER JOIN _user 
	ON _user.id = bid.id_bidder AND bid.id_auction = id_auction
	ORDER BY bid_value DESC LIMIT 10;

-- get highest bid for a given auction
SELECT bid.bid_value as bid_value
	FROM bid
	INNER JOIN auction
	ON auction.id = bid.id_auction
	ORDER BY bid_value DESC LIMIT 1;

COMMIT;
