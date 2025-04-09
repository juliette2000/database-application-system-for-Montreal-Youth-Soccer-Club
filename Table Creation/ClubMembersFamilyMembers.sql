CREATE TABLE `ClubMembersFamilyMembers` (
  `club_member_id` int NOT NULL,
  `family_member_id` int NOT NULL,
  `relationship` varchar(20) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`club_member_id`,`family_member_id`),
  KEY `family_member_id` (`family_member_id`),
  CONSTRAINT `ClubMembersFamilyMembers_ibfk_1` FOREIGN KEY (`club_member_id`) REFERENCES `ClubMembers` (`member_id`),
  CONSTRAINT `ClubMembersFamilyMembers_ibfk_2` FOREIGN KEY (`family_member_id`) REFERENCES `FamilyMembers` (`family_member_id`),
  CONSTRAINT `ClubMembersFamilyMembers_chk_1` CHECK ((`relationship` in (_utf8mb4'Father',_utf8mb4'Mother',_utf8mb4'GrandFather',_utf8mb4'GrandMother',_utf8mb4'Tutor',_utf8mb4'Partner',_utf8mb4'Friend',_utf8mb4'Other')))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;