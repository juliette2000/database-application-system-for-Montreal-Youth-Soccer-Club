CREATE TABLE `opponent` (
  `formation_id` int NOT NULL,
  `opponent_id` int DEFAULT NULL,
  PRIMARY KEY (`formation_id`),
  KEY `fk_opponent` (`opponent_id`),
  CONSTRAINT `fk_formation` FOREIGN KEY (`formation_id`) REFERENCES `teamformations` (`formation_id`),
  CONSTRAINT `fk_opponent` FOREIGN KEY (`opponent_id`) REFERENCES `teamformations` (`formation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;