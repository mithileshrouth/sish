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
        public function insertSTS($data){
            $insertId = 0;
            $this->db->insert("sts",$data);
            $insertId = $this->db->insert_id();
            return $insertId;
         }
         
         public function insertActivityLog($data){
             $insertid=0;
             $this->db->insert("activity_log",$data);
             $insertid = $this->db->insert_id();
             return $insertid;
         }
        public function getStsData($stsId){
            $sts="";
            $query = $this->db->select("sts.*,user_master_web.*")
                    ->from("sts")
                    ->join("user_master_web","sts.user_id=user_master_web.id","LEFT")
                    ->where("sts.id",$stsId)
                    ->get();
            if($query->num_rows()>0){
                $sts= $query->row();
            }
            return $sts;
        }
        
        
	
	

	
	
}