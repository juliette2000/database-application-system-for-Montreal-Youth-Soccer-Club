CREATE TABLE `Teams` (
  `TeamID` int NOT NULL AUTO_INCREMENT,
  `TeamName` varchar(100) COLLATE utf8mb3_unicode_ci NOT NULL,
  `location_id` int DEFAULT NULL,
  `HeadCoachID` int DEFAULT NULL,
  `Type` enum('Girls','Boys') CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`TeamID`),
  KEY `location_id` (`location_id`),
  KEY `HeadCoachID` (`HeadCoachID`),
  CONSTRAINT `Teams_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `Locations` (`location_id`),
  CONSTRAINT `Teams_ibfk_2` FOREIGN KEY (`HeadCoachID`) REFERENCES `Personnel` (`personnel_id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;