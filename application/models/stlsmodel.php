<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class stlsmodel extends CI_Model{
	
	
	public function getAllSTLS(){
		$data = [];
		$query = $this->db->select("
					stls.id as stlsid,
					stls.name as stlsname,
					stls.mobile as stlsmobile,
					stls.is_active as active,
					tu_unit.name AS tuname
					")
				->from('stls')
				->join('tu_unit','tu_unit.id = stls.tu_id','INNER')
				->order_by('stls.name')
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


	public function getAllSTLSbyRoll($where_dist){
		$data = [];
		$query = $this->db->select("
					stls.id as stlsid,
					stls.name as stlsname,
					stls.mobile as stlsmobile,
					stls.is_active as active,
					tu_unit.name AS tuname
					")
				->from('stls')
				->join('tu_unit','tu_unit.id = stls.tu_id','INNER')
				->join('block','block.id = tu_unit.block_id','INNER')
				->join('district','district.id = block.district_id','INNER')
				->where($where_dist)
				->order_by('stls.name')
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