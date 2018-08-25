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
	

	public function getAllSTSByRoll($where_dist){
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
				->join('block','block.id = tu_unit.block_id','INNER')
				->join('district','district.id = block.district_id','INNER')
				->where($where_dist)
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

	public function getAllTUListbyDist($whereAry){
		$data = [];
		$query = $this->db->select("tu_unit.*")
				->from('tu_unit')
				->join('block','block.id = tu_unit.block_id','INNER')
				->join('district','district.id = block.district_id','INNER')
				->where($whereAry)
			    ->order_by('tu_unit.name')
				->get();
			#q();
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