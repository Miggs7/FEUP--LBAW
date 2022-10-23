-----------------------------------------
-- INDEX
-----------------------------------------
DROP INDEX IF EXISTS bid_auction CASCADE;
DROP INDEX IF EXISTS bid CASCADE;
DROP INDEX IF EXISTS auction_item CASCADE;
DROP INDEX IF EXISTS search_item CASCADE;

CREATE INDEX bid_auction ON bid USING hash(id_auction);
CREATE INDEX value ON bid USING hash(bid_value);
CREATE INDEX auction_item ON auction USING hash(id_item);
CREATE INDEX search_item ON item USING GIST (to_tsvector('english', name));