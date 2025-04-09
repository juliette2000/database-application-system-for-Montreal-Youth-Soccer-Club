CREATE TABLE `players` (
  `player_id` int NOT NULL AUTO_INCREMENT,
  `formation_id` int DEFAULT NULL,
  `club_member_id` int DEFAULT NULL,
  `role` enum('Goalkeeper','Defender','Midfielder','Forward') COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`player_id`),
  KEY `formation_id` (`formation_id`),
  KEY `club_member_id` (`club_member_id`),
  CONSTRAINT `players_ibfk_1` FOREIGN KEY (`formation_id`) REFERENCES `teamformations` (`formation_id`),
  CONSTRAINT `players_ibfk_2` FOREIGN KEY (`club_member_id`) REFERENCES `ClubMembers` (`member_id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;