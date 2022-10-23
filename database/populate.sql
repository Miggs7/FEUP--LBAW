INSERT INTO _user VALUES(1,'Harry_Warren3153@nanoff.biz','gmcleoid0','Harry Warren','#3ac1bb',40);
INSERT INTO _user VALUES(2,'Bree_Hepburn4560@bauros.biz','asmewin1','Bree Hepburn','#92000A',99);
INSERT INTO _user VALUES(3,'Tony_Wellington1196@naiker.biz','apoulden2','Tony Wellington','#144187',90);
INSERT INTO _user VALUES(4,'Harvey_Briggs7652@corti.com','etraynor3','Harvey Briggs','	#964B00',48);
INSERT INTO _user VALUES(5,'Allison_Appleton3129@twace.org','ghanvey4','Allison Appleton','#0e4210',86);
INSERT INTO _user VALUES(6,'Benjamin_Vince3261@nickia.com','abickle5','Benjamin Vince','	#FFC0CB',92);
INSERT INTO _user VALUES(7,'Henry_Barrett1954@deons.tech','gmaisey6','Henry Barrett','#4286f4',95);
INSERT INTO _user VALUES(8,'Rocco_Dunbar6506@bretoux.com','sgavahan7', 'Rocco Dunbar','#e5c427',55);
INSERT INTO _user VALUES(9,'Cristal_Pearce6806@supunk.biz','sbolesma8','Cristal Pearce','#e5c427',80);
INSERT INTO _user VALUES(10,'Chris_Johnson6157@guentu.biz','ggallelli9','Chris Johnson','#e03ecd',61);
INSERT INTO _user VALUES(11,'Daron_Baxter1161@ovock.tech','mwaytea','Daron Baxter','	#C0C0C0',36);
INSERT INTO _user VALUES(12,'William_Purvis4083@liret.org','mludyb','William Purvis','	#964B00',72);
INSERT INTO _user VALUES(13,'Lucas_Newman8198@nimogy.biz','awardesworthc','Lucas Newman','	#FFC0CB',28);
INSERT INTO _user VALUES(14,'Hailey_Stanley2818@corti.com','mhuied','Hailey Stanley','#efe6d7',93);
INSERT INTO _user VALUES(15,'Doug_Bailey1953@famism.biz','lfowlse','Doug Bailey','#4a1d99',53);
INSERT INTO _user VALUES(16,'Allison_Buckley3465@bulaffy.com','cscannellf','Allison Buckley','#4286f4',19);
INSERT INTO _user VALUES(17,'Ramon_Adams1655@kideod.biz','hkeithg','Ramon Adams','#FF0000',80);
INSERT INTO _user VALUES(18,'Chris_Wise1974@naiker.biz','hmanuellih','Chris Wise','#b2aea7',70);
INSERT INTO _user VALUES(19,'Cherish_Waterhouse4762@qater.org','bbrainsbyi','Cherish Waterhouse','#f22e2b',30);
INSERT INTO _user VALUES(20,'Wendy_Jennson1741@yahoo.com','jmcgawj','Wendy Jennson','#4286f4',27);


-- create admins

INSERT INTO manager VALUES(1,'Marvin_Marshall2818@typill.biz','Marvin Marshall','#b2aea7');
INSERT INTO manager VALUES(2,'Lauren_Reyes2900@irrepsy.com','Lauren Reyes','#f22e2b');
INSERT INTO manager VALUES(3,'Mike_Lee7536@ubusive.com','Mike Lee','#ff9400');


-- create items
INSERT INTO item VALUES(1, 'Makena','This is a medicine', 8);
INSERT INTO item VALUES(2,'Symbicort','This is a medicine', 10);
INSERT INTO item VALUES(3,'Zoloft', 'This is a medicine', 7);

INSERT INTO item VALUES(4, 'Orange Bird', 'This is a drink', 5);
INSERT INTO item VALUES(5, 'Guaranito','This is a drink', 5);
INSERT INTO item VALUES(6,'Malibu','This is a drink', 4);

INSERT INTO item VALUES(7,'Forever 21', 'This is clothing', 8);
INSERT INTO item VALUES(8,'Angels Jeanswear','This is clothing', 7);
INSERT INTO item VALUES(9,'SABA','This is clothing', 1);

-- create auction


INSERT INTO auction VALUES(1,'Orange Bird','This is an auction', 'Saturday, October 1, 2022 5:58 PM', 'Monday, October 3, 2022 5:58 PM',13333, 12136, 7);
INSERT INTO auction VALUES(2,'Malibu', 'This is an auction','Saturday, October 1, 2022 9:42 PM', 'Monday, October 17, 2022 8:42 PM', 42289, 42289, 4);
INSERT INTO auction VALUES(3,'Makena', 'This is an auction','Friday, October 7, 2022 5:01 PM', 'Monday, October 17, 2022 8:42 PM',53087, 51079, 1);

INSERT INTO transaction VALUES(1, 25500, 'Buy');

INSERT INTO bidder VALUES (1, 1);
INSERT INTO bidder VALUES (3, 1);

INSERT INTO auctioneer VALUES (6, 1);
INSERT INTO auctioneer VALUES (5, 1);

INSERT INTO review VALUES(0, 'Annonymous clown', 'Product does not match the description! It is awful', 1, 6);
INSERT INTO review VALUES(1, 'Grandma', 'Amazing, this car will make my friends jealous', 1, 6);

INSERT INTO notification VALUES(0, 'Saturday, October 1, 2022 9:42 PM', 'You won the auction', 'Auction Status Notification',1, 1, 1);

INSERT INTO auction_image VALUES(1, 'https://cdn.shopify.com/s/files/1/0017/2100/8243/products/QX-1_FRONT_BrightRed_400x.jpg?v=1610646148',1);
INSERT INTO auction_image VALUES(2, 'https://france-export-fv-online.com/6484-large_default/absolut-vodka.jpg',2);
INSERT INTO auction_image VALUES(3, 'https://s0.minipreco.pt/medias/h9b/hf3/9005083033630.jpg',3);


INSERT INTO category VALUES(1, 'Clothing');
INSERT INTO category VALUES(2, 'Other');
INSERT INTO category VALUES(3, 'Cars');
INSERT INTO category VALUES(4, 'Jewelry');
INSERT INTO category VALUES(5, 'Furnitures');
INSERT INTO category VALUES(6, 'Accessories');
INSERT INTO category VALUES(7, 'Memorabilia');

INSERT INTO auction_category VALUES(1, 1);
INSERT INTO auction_category VALUES(2, 2);
INSERT INTO auction_category VALUES(2, 3);

INSERT INTO manage VALUES(1, 3);
INSERT INTO manage VALUES(2, 1);

INSERT INTO moderate VALUES(1, 2);
INSERT INTO moderate VALUES(2, 1);

INSERT INTO auction_list VALUES(6, 1);
INSERT INTO watch_list VALUES(1, 1);