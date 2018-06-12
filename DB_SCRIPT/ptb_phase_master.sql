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

/*Table structure for table `ptb_phase_master` */

DROP TABLE IF EXISTS `ptb_phase_master`;

CREATE TABLE `ptb_phase_master` (
  `phase_id` int(20) NOT NULL AUTO_INCREMENT,
  `phase_name` varchar(255) DEFAULT NULL,
  `phase_des` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`phase_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `ptb_phase_master` */

insert  into `ptb_phase_master`(`phase_id`,`phase_name`,`phase_des`) values (1,'Registration','Registration'),(2,'Sputum for DMC','Sputum for DMC'),(3,'X-Ray','X-Ray'),(4,'CBNAAT','CBNAAT');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
