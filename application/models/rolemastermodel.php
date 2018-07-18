<?php
class rolemastermodel extends CI_Model{
    
	public function getActiveRole()
	{
		$query = $this->db->select("*")
				->from("role_master")
				->where_not_in('role_master.id', 1)
				->get();
		// $this->db->last_query();		
		
		if ($query->num_rows() > 0) 
		{
		    foreach($query->result() as $rows)
			{
				$data[] = $rows;
			}
		}
		   return $data;
	}
	
	public function getActiveRoleForApp()
	{
		$where = [
			"role_master.is_visible_app"=>'Y'
		];
		$query = $this->db->select("*")
				->from("role_master")
				->where($where)
				->get();
		// $this->db->last_query();		
		
		if ($query->num_rows() > 0) 
		{
		    foreach($query->result() as $rows)
			{
				$data[] = $rows;
			}
		}
		   return $data;
	}
	
	
	public function getRoleIDByRoleType($roletype){
		$roleid = 0;
		$query = $this->db->select("*")
				->from("role_master")
				->where('role_master.role_code', $roletype)
				->limit(1)
				->get();
				
		if ($query->num_rows() > 0) 
		{
		   $roledata = $query->row();
		   $roleid = $roledata->id;
		}
		
		return $roleid;
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
}