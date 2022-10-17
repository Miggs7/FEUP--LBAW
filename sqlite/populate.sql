INSERT INTO user VALUES(1,'Harry_Warren3153@nanoff.biz','Harry Warren','#3ac1bb',40);
INSERT INTO user VALUES(2,'Bree_Hepburn4560@bauros.biz','Bree Hepburn','#92000A',99);
INSERT INTO user VALUES(3,'Tony_Wellington1196@naiker.biz','Tony Wellington','#144187',90);
INSERT INTO user VALUES(4,'Harvey_Briggs7652@corti.com','Harvey Briggs','	#964B00',48);
INSERT INTO user VALUES(5,'Allison_Appleton3129@twace.org','Allison Appleton','#0e4210',86);
INSERT INTO user VALUES(6,'Benjamin_Vince3261@nickia.com','Benjamin Vince','	#FFC0CB',92);
INSERT INTO user VALUES(7,'Henry_Barrett1954@deons.tech','Henry Barrett','#4286f4',95);
INSERT INTO user VALUES(8,'Rocco_Dunbar6506@bretoux.com','Rocco Dunbar','#e5c427',55);
INSERT INTO user VALUES(9,'Cristal_Pearce6806@supunk.biz','Cristal Pearce','#e5c427',80);
INSERT INTO user VALUES(10,'Chris_Johnson6157@guentu.biz','Chris Johnson','#e03ecd',61);
INSERT INTO user VALUES(11,'Daron_Baxter1161@ovock.tech','Daron Baxter','	#C0C0C0',36);
INSERT INTO user VALUES(12,'William_Purvis4083@liret.org','William Purvis','	#964B00',72);
INSERT INTO user VALUES(13,'Lucas_Newman8198@nimogy.biz','Lucas Newman','	#FFC0CB',28);
INSERT INTO user VALUES(14,'Hailey_Stanley2818@corti.com','Hailey Stanley','#efe6d7',93);
INSERT INTO user VALUES(15,'Doug_Bailey1953@famism.biz','Doug Bailey','#4a1d99',53);
INSERT INTO user VALUES(16,'Allison_Buckley3465@bulaffy.com','Allison Buckley','#4286f4',19);
INSERT INTO user VALUES(17,'Ramon_Adams1655@kideod.biz','Ramon Adams','#FF0000',80);
INSERT INTO user VALUES(18,'Chris_Wise1974@naiker.biz','Chris Wise','#b2aea7',70);
INSERT INTO user VALUES(19,'Cherish_Waterhouse4762@qater.org','Cherish Waterhouse','#f22e2b',30);
INSERT INTO user VALUES(20,'Wendy_Jennson1741@yahoo.com','Wendy Jennson','#4286f4',27);


-- create admins

INSERT INTO manager VALUES(1,'Marvin_Marshall2818@typill.biz','Marvin Marshall','#b2aea7');
INSERT INTO manager VALUES(2,'Lauren_Reyes2900@irrepsy.com','Lauren Reyes','#f22e2b');
INSERT INTO manager VALUES(3,'Mike_Lee7536@ubusive.com','Mike Lee','#ff9400');


-- create items
INSERT INTO item VALUES(1,'This is a medicine', 'Makena');
INSERT INTO item VALUES(2,'This is a medicine','Symbicort');
INSERT INTO item VALUES(3,'This is a medicine','Zoloft');

INSERT INTO item VALUES(4,'This is a drink', 'Orange Bird');
INSERT INTO item VALUES(5,'This is a drink', 'Guaranito');
INSERT INTO item VALUES(6,'This is a drink', 'Malibu');

INSERT INTO item VALUES(7,'This is clothing', 'Forever 21');
INSERT INTO item VALUES(8,'This is clothing','Angels Jeanswear');
INSERT INTO item VALUES(9,'This is clothing','SABA');

-- create auction


INSERT INTO auction VALUES(1,'Orange Bird', 'Saturday, October 1, 2022 5:58 PM', 'Monday, October 3, 2022 5:58 PM',12136, 13333);
INSERT INTO auction VALUES(2,'Malibu', 'Saturday, October 1, 2022 9:42 PM', 'Monday, October 17, 2022 8:42 PM', 42289, 42289);
INSERT INTO auction VALUES(3,'Makena', 'Friday, October 7, 2022 5:01 PM', 'Monday, October 17, 2022 8:42 PM',51079, 53087);

INSERT INTO _notification VALUES(0, 'Saturday, October 1, 2022 9:42 PM', 'You won the auction');

INSERT INTO auctionImage VALUES('https://think2.eu/1622116-thickbox_default/jeans-wear-men-s-denim-shorts.jpg');


INSERT INTO category VALUES('clothing');
INSERT INTO category VALUES('drinks');
INSERT INTO category VALUES('cars');
