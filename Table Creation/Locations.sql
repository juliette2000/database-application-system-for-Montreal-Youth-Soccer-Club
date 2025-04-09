CREATE TABLE `Locations` (
  `location_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb3_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `city` varchar(100) COLLATE utf8mb3_unicode_ci NOT NULL,
  `province` varchar(100) COLLATE utf8mb3_unicode_ci NOT NULL,
  `postal_code` varchar(20) COLLATE utf8mb3_unicode_ci NOT NULL,
  `phone_number` varchar(20) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `web_address` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `type` varchar(10) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `capacity` int NOT NULL,
  PRIMARY KEY (`location_id`),
  CONSTRAINT `Locations_chk_1` CHECK ((`type` in (_utf8mb3'Head',_utf8mb3'Branch')))
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;