CREATE TABLE `PersonnelLocation` (
  `personnel_id` int NOT NULL,
  `location_id` int NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  PRIMARY KEY (`personnel_id`,`location_id`,`start_date`),
  KEY `location_id` (`location_id`),
  CONSTRAINT `PersonnelLocation_ibfk_1` FOREIGN KEY (`personnel_id`) REFERENCES `Personnel` (`personnel_id`),
  CONSTRAINT `PersonnelLocation_ibfk_2` FOREIGN KEY (`location_id`) REFERENCES `Locations` (`location_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;