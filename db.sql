CREATE TABLE `page_views` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `page_id` INT(11) NOT NULL,
  `ip_address` VARCHAR(45) NOT NULL,
  `view_time` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_view` (`page_id`, `ip_address`)
);
