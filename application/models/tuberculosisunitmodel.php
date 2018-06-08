<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class tuberculosisunitmodel extends CI_Model{
	
	
	
	/****************************************************************************/
	/*******************************BLOCK AREA**********************************/
	/**************************************************************************/
	
	public function getAllBlockList(){
		$data = [];
		$query = $this->db->select("
					block.id as blockid,
					block.name as blockname,
					block.is_active,
					district.name as districtname
					
					")
				->from('block')
				->join('district','district.id = block.district_id','INNER')
			    ->order_by('block.name')
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



	 public function getLocationDetailByPin($pincode)
	 {
	 	$where = array(
	 		"pincode_master.pincode" => $pincode,
	 		"pincode_master.is_active" => 'Y'
	 	);
	 	$data = [];
		try
	 	{
			$this->db->select("pincode_master.`id` AS pincodeID,
								pincode_master.pincode,
								district.`name` AS districtname,
								district.`id` AS districtID,
								states.`name` AS statename,
								states.`id` AS stateID,
								countries.`name` AS countryname,
								countries.`id` AS countryID")
				->from('pincode_master')
				->join('district','district.id = pincode_master.district_id','INNER')
				->join('states','states.id = district.state_id','INNER')
				->join('countries','countries.id = states.country_id','INNER')
				->where($where);

			$query = $this->db->get();
			if($query->num_rows()> 0)
			{
	           $row = $query->row();
	           return $data = $row;
	             
	        }
			else
			{
	            return $data;
	        }
		}
	 	catch(Exception $err)
	 	{
	 		 echo $err->getTraceAsString();
	 	}

	 }
	
	

	
	
}