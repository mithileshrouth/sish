<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class dashboardmodel extends CI_Model{


	public function rowcount($table)
	{
		
		$this->db->select('*')
				->from($table);

		$query = $this->db->get();
		$rowcount = $query->num_rows();
	
		if($query->num_rows()>0){
			return $rowcount;
		}
		else
		{
			return 0;
		}
		
	}


}
	