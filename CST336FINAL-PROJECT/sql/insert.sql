-- TEAM MAKESMART FINAL
-- CST336 Plant Database
-- TEAM MEMBERS Jake McGhee, Pavlos Papadonikolakis, Maco Doussias 
-- 07-27-18

-- ----------------------------------------------------------------INSERT SQL STATEMENTS
-- Create the administrator account
INSERT INTO `admin` (`idadmin`, `username`, `password`) VALUES ('1', 'admin', SHA1('secret'));

-- Create a user account
INSERT INTO `customer` (`idcustomer`, `firstName`, `lastName`, `address`) VALUES ('1', ' Seymour', 'Krelborn', 'sk@apple.com');

-- Create a few plants
-- All images and plant info retrieved 08-04-18 from https://en.wikipedia.org/wiki/List_of_poisonous_plants
INSERT INTO `plant` (`idplant`, `plantName`, `plantDesc`, `priceDollar`, `priceCent`, `imgLink`) VALUES ('1', 'Rosary Pea', 'The rosary pea gets its name from its beautiful red seeds.  It has effects similar to ricin.', '12', '99', 'img/rosarypea.png');
INSERT INTO `plant` (`idplant`, `plantName`, `plantDesc`, `priceDollar`, `priceCent`, `imgLink`) VALUES ('2', 'Aconite', 'This entire plant is poisonous.   It is best to avoid skin contact as it can cause cardiac arrest.', '12', '99', 'img/aconite.png');
INSERT INTO `plant` (`idplant`, `plantName`, `plantDesc`, `priceDollar`, `priceCent`, `imgLink`) VALUES ('3', 'White Baneberry', 'This plant is especially poisonous in its berry.  Be careful not to ingest as it can cause cardiac arrest.', '12', '99', 'img/baneberry.png');
INSERT INTO `plant` (`idplant`, `plantName`, `plantDesc`, `priceDollar`, `priceCent`, `imgLink`) VALUES ('4', 'White Snakeroot', 'This plant is often dangerous when livestock like cattle ingest it, as it can be present in the milk they produce.', '12', '99', 'img/whitesnakeroot.png');
INSERT INTO `plant` (`idplant`, `plantName`, `plantDesc`, `priceDollar`, `priceCent`, `imgLink`) VALUES ('5', 'Frangipani', 'The latex of this plant is more annoying than poisonous as it can cause irritation.  However, it can be bad in large doses.', '12', '99', 'img/frangipani.png');
INSERT INTO `plant` (`idplant`, `plantName`, `plantDesc`, `priceDollar`, `priceCent`, `imgLink`) VALUES ('6', 'Manchineel', 'This may look like a tastey treat, but all parts of this plant are considered toxic.  They are known to cause blindness.', '12', '99', 'img/manchineel.png');
INSERT INTO `plant` (`idplant`, `plantName`, `plantDesc`, `priceDollar`, `priceCent`, `imgLink`) VALUES ('7', 'Buttonbush', 'The button bush is toxic, but it can also be used for medicine.', '15', '99', 'img/buttonbush.png');
INSERT INTO `plant` (`idplant`, `plantName`, `plantDesc`, `priceDollar`, `priceCent`, `imgLink`) VALUES ('8', 'Suicide Tree', 'A single seed of this plant can have catastrophic consequences.  Keep away from pets and small children.', '2', '99', 'img/suicidetree.png');
INSERT INTO `plant` (`idplant`, `plantName`, `plantDesc`, `priceDollar`, `priceCent`, `imgLink`) VALUES ('9', 'Arum Lily', 'This entire plant has calcium oxalate, which can be a serious irritant if ingested.  In large doses it can be fatal.', '20', '99', 'img/arumlily.png');
INSERT INTO `plant` (`idplant`, `plantName`, `plantDesc`, `priceDollar`, `priceCent`, `imgLink`) VALUES ('10', 'Lemon', 'These common plants may not be toxic to humans, but some of their aromatic oils can be toxic to house pets.', '8', '99', 'img/lemon.png');
INSERT INTO `plant` (`idplant`, `plantName`, `plantDesc`, `priceDollar`, `priceCent`, `imgLink`) VALUES ('11', 'Tomato', 'The leaves and stems are usually mildly toxic and they can cause stomach upset and nervous system issues.', '7', '99', 'img/tomato.png');
INSERT INTO `plant` (`idplant`, `plantName`, `plantDesc`, `priceDollar`, `priceCent`, `imgLink`) VALUES ('12', 'Apple', 'The common apple seed is mildly poisonous and can be fatal in large doses.', '13', '50', 'img/apple.png');
INSERT INTO `plant` (`idplant`, `plantName`, `plantDesc`, `priceDollar`, `priceCent`, `imgLink`) VALUES ('13', 'Mountain Laurel', 'All non-flowering and green parts of this plant are toxic.  Can cause hemorrhaging and difficulty breathing.', '8', '99', 'img/mountainlaurel.png');
INSERT INTO `plant` (`idplant`, `plantName`, `plantDesc`, `priceDollar`, `priceCent`, `imgLink`) VALUES ('14', 'Bleeding Heart', 'This plant can cause rashes and skin irritation if touched.', '7', '15', 'img/bleedingheart.png');
INSERT INTO `plant` (`idplant`, `plantName`, `plantDesc`, `priceDollar`, `priceCent`, `imgLink`) VALUES ('15', 'Privet', 'The berrys of this plant look similar to blackberries, but are poisonous.  Even the pollen can disrupt common allergy sufferers.', '25', '50', 'img/privet.png');
INSERT INTO `plant` (`idplant`, `plantName`, `plantDesc`, `priceDollar`, `priceCent`, `imgLink`) VALUES ('16', 'Passion Flower', 'The leaves of this plant contain a substances that can become cyanide on decomposition.', '12', '99', 'img/passionflower.png');
INSERT INTO `plant` (`idplant`, `plantName`, `plantDesc`, `priceDollar`, `priceCent`, `imgLink`) VALUES ('17', 'Mistletoe', 'This plant, popular during holidays, contains many different types of toxins.', '12', '99', 'img/mistletoe.png');
INSERT INTO `plant` (`idplant`, `plantName`, `plantDesc`, `priceDollar`, `priceCent`, `imgLink`) VALUES ('18', 'Pokeweed', 'The berries and roots of this plant are most toxic, however, it is mostly dangerous only if concentrated.  Easier for begginner.', '12', '99', 'img/pokeweed.png');
INSERT INTO `plant` (`idplant`, `plantName`, `plantDesc`, `priceDollar`, `priceCent`, `imgLink`) VALUES ('19', 'Mayapple', 'All one name, the mayapple fruit can be eaten once ripe, but if unripe it contains toxins that may lead to digestive issues.', '12', '99', 'img/mayapple.png');
INSERT INTO `plant` (`idplant`, `plantName`, `plantDesc`, `priceDollar`, `priceCent`, `imgLink`) VALUES ('20', 'Buckthorn', 'The seeds of this plant are delectable to birds, but mildly toxic to humans.', '12', '99', 'img/buckthorn.png');
INSERT INTO `plant` (`idplant`, `plantName`, `plantDesc`, `priceDollar`, `priceCent`, `imgLink`) VALUES ('21', 'Wild Carrot', 'This wild root plant variety can cause irritation, especially to the skin.  It is not to be mistaken for the carrots seen at the store.', '12', '99', 'img/wildcarrot.png');
INSERT INTO `plant` (`idplant`, `plantName`, `plantDesc`, `priceDollar`, `priceCent`, `imgLink`) VALUES ('22', 'Poinsettia', 'Common in California landscape designs for its low maintenance, the leaves of these plants can be especially toxic.', '12', '99', 'img/poinsettia.png');


-- Purchase one for customer one
INSERT INTO `purchase` (`idpurchase`, `purchaseDate`, `customer_idcustomer`) VALUES ('1', CURRENT_TIMESTAMP(), '1');
	INSERT INTO `lineItem` (`purchase_idpurchase`, `plant_idplant`, `quantity`, `priceDollar`, `priceCent`) VALUES ('1', '1', '3', '5', '99');

-- Purchase two for customer one
INSERT INTO `purchase` (`idpurchase`, `purchaseDate`, `customer_idcustomer`) VALUES ('2', CURRENT_TIMESTAMP(), '1');
	INSERT INTO `lineItem` (`purchase_idpurchase`, `plant_idplant`, `quantity`, `priceDollar`, `priceCent`) VALUES ('2', '1', '1', '10', '99');
	
-- Purchase three for customer one
INSERT INTO `purchase` (`idpurchase`, `purchaseDate`, `customer_idcustomer`) VALUES ('3', CURRENT_TIMESTAMP(), '1');
	INSERT INTO `lineItem` (`purchase_idpurchase`, `plant_idplant`, `quantity`, `priceDollar`, `priceCent`) VALUES ('3', '2', '7', '15', '99');

-- Purchase four for customer one
INSERT INTO `purchase` (`idpurchase`, `purchaseDate`, `customer_idcustomer`) VALUES ('4', CURRENT_TIMESTAMP(), '1');
	INSERT INTO `lineItem` (`purchase_idpurchase`, `plant_idplant`, `quantity`, `priceDollar`, `priceCent`) VALUES ('4', '3', '2', '8', '99');
			
-- Purchase five for customer one
INSERT INTO `purchase` (`idpurchase`, `purchaseDate`, `customer_idcustomer`) VALUES ('5', CURRENT_TIMESTAMP(), '1');
	INSERT INTO `lineItem` (`purchase_idpurchase`, `plant_idplant`, `quantity`, `priceDollar`, `priceCent`) VALUES ('5', '4', '3', '7', '50');
