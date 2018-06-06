CREATE TABLE `keys` (
 `id` INT(11) NOT NULL AUTO_INCREMENT,
 `user_id` INT(11) NOT NULL,
 `key` VARCHAR(40) NOT NULL,
 `level` INT(2) NOT NULL,
 `ignore_limits` TINYINT(1) NOT NULL DEFAULT '0',
 `is_private_key` TINYINT(1) NOT NULL DEFAULT '0',
 `ip_addresses` TEXT,
 `date_created` DATETIME NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8;