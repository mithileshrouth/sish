/*
SQLyog Ultimate v10.00 Beta1
MySQL - 5.6.16 : Database - sish_db
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `role_master` */

DROP TABLE IF EXISTS `role_master`;

CREATE TABLE `role_master` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `role_master` */

insert  into `role_master`(`id`,`name`,`description`,`is_active`,`created_on`) values (1,'Admin',NULL,1,'2018-06-05 11:36:19');
insert  into `role_master`(`id`,`name`,`description`,`is_active`,`created_on`) values (2,'Project Manager',NULL,1,'2018-06-05 11:37:27');
insert  into `role_master`(`id`,`name`,`description`,`is_active`,`created_on`) values (3,'Coordinator',NULL,1,'2018-06-05 11:37:49');
insert  into `role_master`(`id`,`name`,`description`,`is_active`,`created_on`) values (4,'NQPP',NULL,1,'2018-06-05 11:38:27');
insert  into `role_master`(`id`,`name`,`description`,`is_active`,`created_on`) values (5,'DMC-LT',NULL,1,'2018-06-05 11:38:50');
insert  into `role_master`(`id`,`name`,`description`,`is_active`,`created_on`) values (6,'X-Ray - LT',NULL,1,'2018-06-05 11:43:03');
insert  into `role_master`(`id`,`name`,`description`,`is_active`,`created_on`) values (7,'CBNAAT - LT',NULL,1,'2018-06-05 11:43:05');

/*Table structure for table `user_master` */

DROP TABLE IF EXISTS `user_master`;

CREATE TABLE `user_master` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `mobile_no` varchar(20) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `gender` enum('M','F') DEFAULT NULL,
  `full_address` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `user_master` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
