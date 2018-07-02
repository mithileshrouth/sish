<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class symptomsmodel extends CI_Model{


	public function getAllSymptomsList(){
		$data = [];
		$query = $this->db->select("*")
				->from('symptoms_master')
			    ->order_by('symptoms_master.symptom')
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