<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class incentivemodel extends CI_Model{


	public function getAllIncentiveList(){
		$data = [];
		$query = $this->db->select("incentive.*,
									role_master.name as role")
				->from('incentive')
				->join("role_master","role_master.id=incentive.role_id","INNER") 
			    ->order_by('incentive.id')
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

	public function getAllRoll(){
		$where = array('role_master.id' => 4);
		$data = [];
		$query = $this->db->select("*
									")
				->from('role_master')
				->where($where)
				->order_by('role_master.id','asc')
				->get();
			
			#echo $this->db->last_query();
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