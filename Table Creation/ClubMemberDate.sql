CREATE TABLE `ClubMemberDate` (
  `member_id` int NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `location_id` int NOT NULL,
  PRIMARY KEY (`member_id`,`location_id`,`start_date`),
  KEY `location_id` (`location_id`),
  CONSTRAINT `ClubMemberDate_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `ClubMembers` (`member_id`),
  CONSTRAINT `ClubMemberDate_ibfk_2` FOREIGN KEY (`location_id`) REFERENCES `Locations` (`location_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;