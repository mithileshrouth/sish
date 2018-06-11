<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class tuberculosisunitmodel extends CI_Model{
	
	

	public function getAllTUList(){
		$data = [];
		$query = $this->db->select("
					tu_unit.id as tuid,
					tu_unit.name as tuname,
					tu_unit.is_active as active,
					block.name as blockname
					
					")
				->from('tu_unit')
				->join('block','block.id = tu_unit.block_id','INNER')
			    ->order_by('tu_unit.name')
				->get();
			
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