<?php
class loginmodel extends CI_Model{
    
	 public function verifymobilelogin($mobileno,$password,$projectid){
        //$this->db->escape($login)
        $userid= 0;
        $sql="SELECT user_master.`id` FROM
				user_master 
				INNER JOIN role_master
				ON role_master.`id` = user_master.`role_id`
				WHERE 
                user_master.`mobile_no`=".trim($this->db->escape($mobileno))."
                AND
                user_master.`password` =".trim($this->db->escape($password))."
				AND 
				user_master.project_id =".(int)$projectid."
                AND
                role_master.`role_code`='ADMIN'";
        
        $query = $this->db->query($sql);
		//echo $this->db->last_query();
         if($query->num_rows()>0){
             $row = $query->row();
             $userid = $row->id;
         }
         return $userid;
    }
}