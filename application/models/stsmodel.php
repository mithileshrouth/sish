<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class stsmodel extends CI_Model{
	
	
	public function getAllSTS(){
		$data = [];
		$query = $this->db->select("
					sts.id as stsid,
					sts.name as stsname,
					sts.mobile as stsmobile,
					sts.is_active as active,
					tu_unit.name AS tuname
					")
				->from('sts')
				->join('tu_unit','tu_unit.id = sts.tu_id','INNER')
				->order_by('sts.name')
				->get();
			
			//echo $this->db->last_query();
			if($query->num_rows()> 0)
			{
	          foreach($query->result() as $rows)
				{
					$data[] = $rows;
				}
	             
	        }
			
	        return $data;
	       
	}
	
	
	
	

	
	
}