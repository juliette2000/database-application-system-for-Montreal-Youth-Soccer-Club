CREATE TABLE `teamformations` (
  `formation_id` int NOT NULL AUTO_INCREMENT,
  `team_id` int DEFAULT NULL,
  `session_date` date DEFAULT NULL,
  `session_time` time DEFAULT NULL,
  `session_type` enum('Game','Training') COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `score` int DEFAULT NULL,
  PRIMARY KEY (`formation_id`),
  KEY `team_id` (`team_id`),
  CONSTRAINT `teamformations_ibfk_1` FOREIGN KEY (`team_id`) REFERENCES `Teams` (`TeamID`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;