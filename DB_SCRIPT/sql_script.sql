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


///
ALTER TABLE `sish_db`.`user_master` ADD COLUMN `role_id` INT(20) NULL AFTER `full_address`; 
///
 ALTER TABLE `sish_db`.`user_master` ADD COLUMN `is_active` ENUM('Y','N') DEFAULT 'Y' NULL AFTER `role_id`, ADD COLUMN `date_of_creation` TIMESTAMP DEFAULT 'CURRENT_TIMESTAMP()' NULL AFTER `is_active`; 
 ALTER TABLE `sish_db`.`user_master` ADD COLUMN `is_active` ENUM('Y','N') DEFAULT 'Y' NULL AFTER `role_id`, ADD COLUMN `date_of_creation` TIMESTAMP DEFAULT CURRENT_TIMESTAMP NULL AFTER `is_active`; 

 
 
 // Mithilesh ------- 08-06-2018
ALTER TABLE `sish_db`.`user_master` ADD COLUMN `project_id` INT(10) NULL AFTER `role_id`; 


CREATE TABLE `activity_log` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `activity_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `activity_module` varchar(255) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `from_method` varchar(100) DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `user_browser` varchar(255) DEFAULT NULL,
  `user_platform` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;



CREATE TABLE `admin_menu_master` (
  `adm_menu_id` int(10) NOT NULL AUTO_INCREMENT,
  `adm_menu_name` varchar(255) DEFAULT NULL,
  `adm_menu_link` varchar(255) DEFAULT NULL,
  `is_parent` enum('P','SM','SSM','C') DEFAULT NULL COMMENT 'P= Parent,SM=Sub Menu, SSM= Sub Sub Menu',
  `parent_id` int(10) DEFAULT NULL,
  `menu_srl` int(10) DEFAULT NULL,
  `is_active` enum('Y','N') DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  PRIMARY KEY (`adm_menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

insert  into `admin_menu_master`(`adm_menu_id`,`adm_menu_name`,`adm_menu_link`,`is_parent`,`parent_id`,`menu_srl`,`is_active`,`created_on`) values (1,'Get Ready','#','P',NULL,1,'Y','2018-06-08 13:16:12');
insert  into `admin_menu_master`(`adm_menu_id`,`adm_menu_name`,`adm_menu_link`,`is_parent`,`parent_id`,`menu_srl`,`is_active`,`created_on`) values (2,'Block','block','C',1,1,'Y','2018-06-08 13:16:48');
insert  into `admin_menu_master`(`adm_menu_id`,`adm_menu_name`,`adm_menu_link`,`is_parent`,`parent_id`,`menu_srl`,`is_active`,`created_on`) values (3,'TU','tuberculosisunit','C',1,2,'Y','2018-06-08 13:17:14');
insert  into `admin_menu_master`(`adm_menu_id`,`adm_menu_name`,`adm_menu_link`,`is_parent`,`parent_id`,`menu_srl`,`is_active`,`created_on`) values (4,'DMC','#','C',1,3,'Y','2018-06-08 13:18:11');
insert  into `admin_menu_master`(`adm_menu_id`,`adm_menu_name`,`adm_menu_link`,`is_parent`,`parent_id`,`menu_srl`,`is_active`,`created_on`) values (5,'Coordinators','#','C',1,4,'Y','2018-06-08 13:18:13');
insert  into `admin_menu_master`(`adm_menu_id`,`adm_menu_name`,`adm_menu_link`,`is_parent`,`parent_id`,`menu_srl`,`is_active`,`created_on`) values (6,'NQPP','#','C',1,5,'Y','2018-06-08 13:18:40');
insert  into `admin_menu_master`(`adm_menu_id`,`adm_menu_name`,`adm_menu_link`,`is_parent`,`parent_id`,`menu_srl`,`is_active`,`created_on`) values (7,'STS','#','C',1,6,'Y','2018-06-08 13:18:58');
insert  into `admin_menu_master`(`adm_menu_id`,`adm_menu_name`,`adm_menu_link`,`is_parent`,`parent_id`,`menu_srl`,`is_active`,`created_on`) values (8,'STLS','#','C',1,7,'Y','2018-06-08 13:19:17');


CREATE TABLE `block` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `district_id` int(10) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

insert  into `block`(`id`,`name`,`district_id`,`is_active`,`created_on`,`created_by`) values (4,'Block 1',1,1,'2018-06-08 17:13:31',1);


CREATE TABLE `country` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `shortname` varchar(10) DEFAULT NULL,
  `phonecode` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `country` */

insert  into `country`(`id`,`name`,`shortname`,`phonecode`) values (1,'India','IN','91');



CREATE TABLE `district` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `state_id` int(10) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `district` */

insert  into `district`(`id`,`name`,`state_id`,`is_active`) values (1,'North 24 Pargana',1,1);



CREATE TABLE `state` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `state` varchar(255) DEFAULT NULL,
  `shortname` varchar(10) DEFAULT NULL,
  `country_id` int(10) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `state` */

insert  into `state`(`id`,`state`,`shortname`,`country_id`,`is_active`) values (1,'West Bengal','WB',1,1);


CREATE TABLE `tu_unit` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `block_id` int(10) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(10) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
-- Abhik Ghosh
-- 08-06-2018
CREATE TABLE `sish_db`.`coordinator`
( 
`coordinatorId` INT(20) NOT NULL AUTO_INCREMENT, 
`name` VARCHAR(255), 
`address` VARCHAR(255), 
`blockid` INT(20), 
`userid` INT(20),
 PRIMARY KEY (`coordinatorId`) )
 ENGINE=INNODB CHARSET=utf8 COLLATE=utf8_general_ci; 
 
ALTER TABLE `sish_db`.`coordinator` 
ADD COLUMN `state_id` INT(20) NULL AFTER `userid`, 
ADD COLUMN `country_id` INT(20) NULL AFTER `state_id`, 
ADD COLUMN `district_id` INT(20) NULL AFTER `country_id`, 
ADD COLUMN `tu_id` INT(20) NULL AFTER `district_id`; 
