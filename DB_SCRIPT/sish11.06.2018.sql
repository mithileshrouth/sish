/*
SQLyog Ultimate v10.00 Beta1
MySQL - 5.5.5-10.1.31-MariaDB : Database - sish_db
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`sish_db` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `sish_db`;

/*Table structure for table `activity_log` */

DROP TABLE IF EXISTS `activity_log`;

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
) ENGINE=InnoDB AUTO_INCREMENT=120 DEFAULT CHARSET=utf8;

/*Data for the table `activity_log` */


/*Table structure for table `admin_menu_master` */

DROP TABLE IF EXISTS `admin_menu_master`;

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

/*Data for the table `admin_menu_master` */

insert  into `admin_menu_master`(`adm_menu_id`,`adm_menu_name`,`adm_menu_link`,`is_parent`,`parent_id`,`menu_srl`,`is_active`,`created_on`) values (1,'Get Ready','#','P',NULL,1,'Y','2018-06-08 13:16:12'),(2,'Block','block','C',1,1,'Y','2018-06-08 13:16:48'),(3,'TU','tuberculosisunit','C',1,2,'Y','2018-06-08 13:17:14'),(4,'DMC','dmc','C',1,3,'Y','2018-06-08 13:18:11'),(5,'Coordinators','coordinator','C',1,4,'Y','2018-06-08 13:18:13'),(6,'NQPP','nqpp','C',1,5,'Y','2018-06-08 13:18:40'),(7,'STS','sts','C',1,6,'Y','2018-06-08 13:18:58'),(8,'STLS','stls','C',1,7,'Y','2018-06-08 13:19:17');

/*Table structure for table `block` */

DROP TABLE IF EXISTS `block`;

CREATE TABLE `block` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `district_id` int(10) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `block` */

insert  into `block`(`id`,`name`,`district_id`,`is_active`,`created_on`,`created_by`) values (4,'Block 1',1,1,'2018-06-08 17:13:31',1);

/*Table structure for table `coordinator` */

DROP TABLE IF EXISTS `coordinator`;

CREATE TABLE `coordinator` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `mobile_no` varchar(255) DEFAULT NULL,
  `village` varchar(100) DEFAULT NULL,
  `post_office` varchar(50) DEFAULT NULL,
  `full_address` varchar(255) DEFAULT NULL,
  `pin_code` varchar(20) DEFAULT NULL,
  `block_id` int(10) DEFAULT NULL,
  `tu_id` int(10) DEFAULT NULL,
  `aadhar_no` varchar(255) DEFAULT NULL,
  `voter_id` varchar(255) DEFAULT NULL,
  `userid` int(10) DEFAULT NULL,
  `project_id` int(10) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `coordinator` */



/*Table structure for table `country` */

DROP TABLE IF EXISTS `country`;

CREATE TABLE `country` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `shortname` varchar(10) DEFAULT NULL,
  `phonecode` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `country` */

insert  into `country`(`id`,`name`,`shortname`,`phonecode`) values (1,'India','IN','91');

/*Table structure for table `district` */

DROP TABLE IF EXISTS `district`;

CREATE TABLE `district` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `state_id` int(10) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `district` */

insert  into `district`(`id`,`name`,`state_id`,`is_active`) values (1,'North 24 Pargana',1,1);

/*Table structure for table `dmc` */

DROP TABLE IF EXISTS `dmc`;

CREATE TABLE `dmc` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `address` text,
  `tuid` int(10) DEFAULT NULL,
  `lt_name` varchar(255) DEFAULT NULL,
  `mobile_no` varchar(20) DEFAULT NULL,
  `project_id` int(10) DEFAULT NULL,
  `userid` int(10) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

/*Data for the table `dmc` */



/*Table structure for table `keys` */

DROP TABLE IF EXISTS `keys`;

CREATE TABLE `keys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `key` varchar(40) NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT '0',
  `is_private_key` tinyint(1) NOT NULL DEFAULT '0',
  `ip_addresses` text,
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `keys` */

/*Table structure for table `nqpp` */

DROP TABLE IF EXISTS `nqpp`;

CREATE TABLE `nqpp` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `coordinator_id` int(10) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `mobile_no` varchar(20) DEFAULT NULL,
  `village` varchar(255) DEFAULT NULL,
  `full_address` varchar(255) DEFAULT NULL,
  `post_office` varchar(255) DEFAULT NULL,
  `pin_code` varchar(10) DEFAULT NULL,
  `block_id` int(10) DEFAULT NULL,
  `aadhar_no` varchar(50) DEFAULT NULL,
  `voter_id` varchar(50) DEFAULT NULL,
  `userid` int(10) DEFAULT NULL,
  `project_id` int(10) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `nqpp` */



/*Table structure for table `project` */

DROP TABLE IF EXISTS `project`;

CREATE TABLE `project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project` varchar(255) NOT NULL,
  `apikey` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `project` */

insert  into `project`(`id`,`project`,`apikey`) values (1,'SHISH','24ecdccb1258eaacfd441e012ac034392403c692');

/*Table structure for table `role_master` */

DROP TABLE IF EXISTS `role_master`;

CREATE TABLE `role_master` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `role_code` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `role_master` */

insert  into `role_master`(`id`,`name`,`description`,`role_code`,`is_active`,`created_on`) values (1,'Admin',NULL,'ADMIN',1,'2018-06-09 13:21:24'),(2,'Project Manager',NULL,'PM',1,'2018-06-09 13:21:38'),(3,'Coordinator',NULL,'CORD',1,'2018-06-09 13:21:29'),(4,'NQPP',NULL,'NQPP',1,'2018-06-09 13:18:19'),(5,'DMC-LT',NULL,'DMC',1,'2018-06-09 13:18:23'),(6,'X-Ray - LT',NULL,'XRAY',1,'2018-06-09 13:18:27'),(7,'CBNAAT - LT',NULL,'CBNAAT',1,'2018-06-09 13:18:41');

/*Table structure for table `state` */

DROP TABLE IF EXISTS `state`;

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

/*Table structure for table `stls` */

DROP TABLE IF EXISTS `stls`;

CREATE TABLE `stls` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `tu_id` int(10) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `stls` */



/*Table structure for table `sts` */

DROP TABLE IF EXISTS `sts`;

CREATE TABLE `sts` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `tu_id` int(10) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `sts` */



/*Table structure for table `tu_unit` */

DROP TABLE IF EXISTS `tu_unit`;

CREATE TABLE `tu_unit` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `block_id` int(10) DEFAULT NULL,
  `project_id` int(10) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(10) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `tu_unit` */


/*Table structure for table `user_master` */

DROP TABLE IF EXISTS `user_master`;

CREATE TABLE `user_master` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `mobile_no` varchar(20) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role_id` int(20) DEFAULT NULL,
  `project_id` int(10) DEFAULT NULL,
  `is_active` enum('Y','N') DEFAULT 'Y',
  `date_of_creation` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

/*Data for the table `user_master` */


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
