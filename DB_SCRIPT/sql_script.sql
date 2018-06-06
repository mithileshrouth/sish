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

//
CREATE TABLE `sish_db`.`project`( `id` INT NOT NULL AUTO_INCREMENT, `project` VARCHAR(255) NOT NULL, `apikey` VARCHAR(255), PRIMARY KEY (`id`) ) ENGINE=INNODB CHARSET=utf8 COLLATE=utf8_general_ci; 