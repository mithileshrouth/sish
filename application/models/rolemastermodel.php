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
}