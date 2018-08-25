<?php
class loginmodel extends CI_Model{
    
	 public function verifymobilelogin($mobileno,$password,$role,$projectid){
        //$this->db->escape($login)
        $userid= 0;
        $sql="SELECT user_master_web.`id` FROM
				user_master_web 
				INNER JOIN role_master
				ON role_master.`id` = user_master_web.`role_id`
				WHERE 
                user_master_web.`mobile_no`=".trim($this->db->escape($mobileno))."
                AND
                user_master_web.`password` =".trim($this->db->escape($password))."
				AND 
				user_master_web.project_id =".(int)$projectid."
                AND user_master_web.role_id='".$role."'
               
                ";
        
        $query = $this->db->query($sql);
		#echo $this->db->last_query();
         if($query->num_rows()>0){
             $row = $query->row();
             $userid = $row->id;
         }
         return $userid;
    }
}