<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class usermastermodel extends CI_Model{
    
    public function getUserById($userId=""){
        $row=array();
			$query = $this->db->select("
						user_master.id AS userid,
						role_master.id AS roleid,
						user_master.*,
						role_master.*,
						CASE WHEN (coordinator.`name` IS NOT NULL) THEN coordinator.`name`
						 WHEN (nqpp.`name` IS NOT NULL) THEN nqpp.`name`
						/*
						 WHEN (dmc.`name` IS NOT NULL) THEN dmc.`name`
						 WHEN (`xray_center`.`name` IS NOT NULL) THEN `xray_center`.`name`
						 WHEN (`cbnaat`.`name`IS NOT NULL) THEN `cbnaat`.`name`
						*/
						 WHEN (`district`.`dist_coordinator`IS NOT NULL) THEN `district`.`dist_coordinator`
						 WHEN (`project`.`prj_mng_name`IS NOT NULL) THEN `project`.`prj_mng_name`
						 END AS username
						",FALSE)
				->from("user_master")
                ->join("role_master","user_master.role_id=role_master.id","LEFT")    
                ->join("coordinator","coordinator.userid=user_master.id","LEFT")    
                ->join("nqpp","nqpp.userid=user_master.id","LEFT") 
				/*				
                ->join("dmc","dmc.userid=user_master.id","LEFT")    
                ->join("xray_center","xray_center.userid=user_master.id","LEFT")    
                ->join("cbnaat","cbnaat.userid=user_master.id","LEFT")    
				*/
                ->join("district","district.userid=user_master.id","LEFT")    
                ->join("project","project.userid=user_master.id","LEFT")    
				->where('user_master.id',$userId )
                ->where('user_master.is_active','Y')
				->get(); 
			
		//echo $this->db->last_query();
        if($query->num_rows()>0){
            $row = $query->row();
           }
           return $row;
    }
	
	public function getActiveUserData($userId){
		 $row = [];
         $sql = "SELECT `user_master`.*, 
				  CASE 
				 WHEN (coordinator.`name` IS NOT NULL) THEN coordinator.`name`
				 WHEN (nqpp.`name` IS NOT NULL) THEN nqpp.`name`
				/*
				 WHEN (dmc.`name` IS NOT NULL) THEN dmc.`name`
				 WHEN (`xray_center`.`name` IS NOT NULL) THEN `xray_center`.`name`
				 WHEN (`cbnaat`.`name`IS NOT NULL) THEN `cbnaat`.`name`
				 */
				 WHEN (`district`.`dist_coordinator`IS NOT NULL) THEN `district`.`dist_coordinator`
				 WHEN (`project`.`prj_mng_name`IS NOT NULL) THEN `project`.`prj_mng_name`
				 END AS username, `role_master`.`name` AS role
				FROM (`user_master`)
				LEFT JOIN `coordinator` ON `coordinator`.`userid` = `user_master`.`id`
				LEFT JOIN `nqpp` ON `nqpp`.`userid` = `user_master`.`id`
				/*
				LEFT JOIN `dmc` ON `dmc`.`userid` = `user_master`.`id`
				LEFT JOIN `xray_center` ON `xray_center`.`userid`=`user_master`.`id`
				LEFT JOIN `cbnaat` ON `cbnaat`.`userid`=`user_master`.`id`
				*/
				LEFT JOIN `district` ON `district`.`userid`=`user_master`.`id`
				LEFT JOIN `project` ON `project`.`userid`=`user_master`.`id`
				LEFT JOIN `role_master` ON `role_master`.`id`=`user_master`.`role_id`
				WHERE `user_master`.`id` =  ".$userId."
				AND `user_master`.`is_active` =  'Y'";
	
		
		$query = $this->db->query($sql);
        if($query->num_rows()>0){
            $row = $query->row();
           }
        return $row;
	}
}
