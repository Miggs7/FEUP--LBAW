-- TRIGGER 1 Add auction to bider's watch list
CREATE FUNCTION add_auction_to_watch_list() RETURNS trigger AS
$BODY$
BEGIN
	INSERT INTO watch_list VALUES (NEW.id_bidder, NEW.id_auction);
	RETURN NEW;
END;
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER add_auction_to_watch_list
AFTER INSERT ON bid
FOR EACH ROW
EXECUTE PROCEDURE add_auction_to_watch_list();




-- TRIGGER 2 REMOVE auction from bider's watch list
CREATE FUNCTION remove_auction_from_watch_list() RETURNS trigger AS
$BODY$
BEGIN
	DELETE FROM watch_list WHERE id_auction = OLD.id_auction;
	RETURN OLD;
END;
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER remove_auction_from_watch_list
AFTER DELETE ON bid
FOR EACH ROW
EXECUTE PROCEDURE remove_auction_from_watch_list();

-- TRIGGER 3 Edit review comment by owner
CREATE FUNCTION edit_review_comment() RETURNS trigger AS
$BODY$
BEGIN
	UPDATE review SET comment = NEW.comment WHERE id = OLD.id;
	RETURN NEW;
END;
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER edit_review_comment
AFTER UPDATE ON review
FOR EACH ROW
EXECUTE PROCEDURE edit_review_comment();


