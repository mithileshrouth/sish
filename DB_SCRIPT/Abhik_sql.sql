-- 07/09/2018
ALTER TABLE `role_master` ADD COLUMN `is_action_active` ENUM('Y','N') DEFAULT 'N' NULL AFTER `is_visible_web`;
INSERT INTO `sish_db`.`role_master` (`id`, `name`, `description`, `role_code`, `is_active`, `is_visible_app`, `app_order`, `created_on`, `is_visible_web`) 
VALUES (NULL, 'STS', 'Senior Treatment Supervisor', 'STS', '1', 'N', '10', CURRENT_TIMESTAMP, 'Y'); 
ALTER TABLE `sish_db`.`sts` ADD COLUMN `user_id` INT(10) NULL AFTER `created_by`;