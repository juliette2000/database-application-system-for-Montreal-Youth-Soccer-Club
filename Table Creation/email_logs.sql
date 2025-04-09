CREATE TABLE `email_logs` (
  `email_log_id` int NOT NULL AUTO_INCREMENT,
  `email_date` datetime DEFAULT NULL,
  `sender` varchar(100) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `receiver` varchar(100) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `body_preview` varchar(100) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`email_log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;