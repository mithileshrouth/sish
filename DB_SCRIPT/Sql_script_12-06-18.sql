CREATE TABLE `sish_db`.`patient` (
  `patient_id` INT (20) NOT NULL AUTO_INCREMENT,
  `patient_name` VARCHAR (255),
  `patient_mobile_primary` INT (20),
  `patient_mobile_alternative` INT (20),
  `patient_reg_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `patient_age` INT,
  `patient_full_address` VARCHAR (255),
  `patient_village` VARCHAR (255),
  `patient_postoffice` VARCHAR (255),
  `patient_pin` INT (20),
  `patient_state` INT (20),
  `patient_country` INT (20),
  `patient_gurdian` VARCHAR (255),
  `patient_sex` CHAR(1),
  `patient_block` INT (20),
  `patient_district` INT (20),
  `patient_adhar` VARCHAR (255),
  `patient_voter` VARCHAR (255),
  `patient_ration` VARCHAR (255),
  `patient_symptom` TEXT,
  `dmc_sputum_done` ENUM ('Y', 'N') DEFAULT 'N',
  `dmc_sputum_date` DATETIME,
  `dmc_id` INT (20),
  `dmc_spt_is_positive` ENUM ('Y', 'N') DEFAULT 'N',
  `dmc_rslt` VARCHAR (255),
  `xray_is_done` ENUM ('Y', 'N') DEFAULT 'N',
  `xray_date` DATETIME,
  `xary_cntr_id` INT (20),
  `xray_is_postive` ENUM ('Y', 'N') DEFAULT 'N',
  `xray_rslt` VARCHAR (255),
  `cbnaat_is_done` ENUM ('Y', 'N') DEFAULT 'N',
  `cbnaat_date` DATETIME,
  `cbnaat_id` INT (20),
  `cbnaat_pstv` ENUM ('Y', 'N') DEFAULT 'N',
  `cbnaat_rslt` VARCHAR (255),
  `is_ptb_srt_treatmnt` ENUM ('Y', 'N'),
  `trtmnt_start_date` DATETIME,
  `trtmnt_end_date` DATETIME,
  `trtmnt_duration` INT,
  `nqpp_id` INT,
  `group_cord_id` INT,
  PRIMARY KEY (`patient_id`)
) ENGINE = INNODB CHARSET = utf8 COLLATE = utf8_general_ci ;

===================================
CREATE TABLE `ptb_phase_master` (
  `phase_id` int(20) NOT NULL AUTO_INCREMENT,
  `phase_name` varchar(255) DEFAULT NULL,
  `phase_des` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`phase_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
===========================
INSERT INTO `ptb_phase_master` (
  `phase_id`,
  `phase_name`,
  `phase_des`
) 
VALUES
  (1, 'Registration', 'Registration'),
  (2,'Sputum for DMC','Sputum for DMC'),
  (3, 'X-Ray', 'X-Ray'),
  (4, 'CBNAAT', 'CBNAAT') ;
=========================================
ALTER TABLE `sish_db`.`patient` ADD COLUMN `patient_phase` INT(20) NULL AFTER `group_cord_id`;