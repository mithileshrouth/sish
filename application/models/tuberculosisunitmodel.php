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

	public function getAllTUListbyDist($whereAry){
		$data = [];
		$query = $this->db->select("
					tu_unit.id as tuid,
					tu_unit.name as tuname,
					tu_unit.is_active as active,
					block.name as blockname
					
					")
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

	public function getAllTuunitListINBlock($block_ids){
		$data = [];
		$query = $this->db->select("
					tu_unit.id as tuid,
					tu_unit.name as tuname,
					tu_unit.is_active as active,
					block.name as blockname
					
					")
				->from('tu_unit')
				->join('block','block.id = tu_unit.block_id','INNER')
				->where_in('tu_unit.block_id', $block_ids)
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
	
	public function getTUUnitByBlock($blockid){
		$data = [];
		$where = [
			"tu_unit.block_id" => $blockid,
			"tu_unit.is_active" => 1
		];
		$query = $this->db->select("
					tu_unit.id as tuid,
					tu_unit.name as tuname
					")
				->from('tu_unit')
				->join('block','block.id = tu_unit.block_id','INNER')
			    ->order_by('tu_unit.name')
				->where($where)
				->get();
		//	echo $this->db->last_query();exit;
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