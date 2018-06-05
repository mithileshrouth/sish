<?php
class loginmodel extends CI_Model{
    
	public function verifyLogin($data)
	{
		$mobileno = $data['mobileno'];
		$password = $data['password'];
		$role = $data['role'];
		$userDataInfo = array();
		
		$where_credentials = [
			"mobile_no" => $mobileno,
			"password" => $password,
			"role_master_id" => $role
		];
		
		$query = $this->db->select("*")
				->from("user_master")
				->where($where_credentials)
				->get();
		
				
		
		
         if($query->num_rows()> 0){
            $row = $query->row();
            $userDataInfo =array(
                "username"=>$row->username,
                "userid"=>$row->id
            );

          return $userDataInfo;
        }
        else{
            return $userDataInfo=array();
        }
		
	}
}