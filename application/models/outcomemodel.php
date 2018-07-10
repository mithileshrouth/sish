<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class outcomemodel extends CI_Model{


	public function getAllOutcomeList(){
		$data = [];
		$query = $this->db->select("*")
				->from('outcome_master')
			    ->order_by('outcome_master.name')
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


} //end of class