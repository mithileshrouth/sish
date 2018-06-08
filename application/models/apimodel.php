<?php
class apimodel extends CI_Model {
    public function getAPIkey(){
        $key ="";
        $query = $this->db->select("*")
			  ->from("project")
			  ->where('project.project', 'SHISH')
			  ->get();
        if($query->num_rows()>0){
            $row = $query->row();
            $key = $row->apikey;
                    
        }
        return $key;
    }
    
    public function verifymobilelogin($mobileno,$password,$roleid,$projectid){
        //$this->db->escape($login)
        $userid= 0;
        $sql="SELECT user_master.`id` FROM user_master WHERE 
                user_master.`mobile_no`=".trim($this->db->escape($mobileno))."
                AND
                user_master.`password` =".trim($this->db->escape($password))."
				AND 
				user_master.project_id =".(int)$projectid."
                AND
                user_master.`role_id`=".(int)$roleid;
        
        $query = $this->db->query($sql);
		//echo $this->db->last_query();
         if($query->num_rows()>0){
             $row = $query->row();
             $userid = $row->id;
         }
         return $userid;
    }
    
}
