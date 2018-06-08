<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class usermastermodel extends CI_Model{
    
    public function getUserById($userId=""){
        $row=array();
         $query = $this->db->select("user_master.id AS userid,role_master.id AS roleid,user_master.*,role_master.*")
				->from("user_master")
                                ->join("role_master","user_master.role_id=role_master.id","LEFT")    
				->where('user_master.id',$userId )
                                ->where('user_master.is_active','Y')
				->get();
			//echo $this->db->last_query();
         if($query->num_rows()>0){
            $row = $query->row();
           }
           return $row;
    }
}
