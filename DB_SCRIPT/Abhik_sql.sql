-- 07/09/2018
ALTER TABLE `role_master` ADD COLUMN `is_action_active` ENUM('Y','N') DEFAULT 'N' NULL AFTER `is_visible_web`;
INSERT INTO `sish_db`.`role_master` (`id`, `name`, `description`, `role_code`, `is_active`, `is_visible_app`, `app_order`, `created_on`, `is_visible_web`) 
VALUES (NULL, 'STS', 'Senior Treatment Supervisor', 'STS', '1', 'N', '10', CURRENT_TIMESTAMP, 'Y'); 
ALTER TABLE `sish_db`.`sts` ADD COLUMN `user_id` INT(10) NULL AFTER `created_by`;
-- sp to update sts

DELIMITER $$

CREATE
    
    PROCEDURE `sts_updt`()
   
BEGIN
DECLARE cfinished INTEGER DEFAULT 0;
DECLARE sts_mobile VARCHAR(255);
DECLARE sts_id INTEGER;
DECLARE cursor_sts CURSOR FOR 
SELECT sts.id,sts.mobile FROM sts;
 
-- declare NOT FOUND handler
DECLARE CONTINUE HANDLER 
FOR NOT FOUND SET cfinished = 1;
OPEN cursor_sts;

get_sts : LOOP
FETCH cursor_sts INTO sts_id,sts_mobile;
IF cfinished = 1 THEN 
	LEAVE get_sts;
END IF;
INSERT INTO user_master_web
            ( mobile_no,
             `PASSWORD`,
             role_id,
             project_id,
             is_active
             )
VALUES (
        sts_mobile,
        sts_mobile,
        10,
        1,
        'Y'
        );

UPDATE sish_db.sts
SET 
  user_id = LAST_INSERT_ID() 
WHERE id = sts_id;        

END LOOP get_sts;

CLOSE cursor_sts;
    END$$
DELIMITER ;

-- call sts_updt();