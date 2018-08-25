<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class diagnostic_reportmodel extends CI_Model{

public function getDistrictCoordinatorbyRole($where_dist)
	{
		$data = array();
		$this->db->select("*")
				->from('district')
				->where($where_dist)
				->order_by('district.id','ASC');
		$query = $this->db->get();
		#echo $this->db->last_query();

		if($query->num_rows()> 0)
		{
            foreach ($query->result() as $rows)
			{
				$data[] = $rows;
            }
            return $data;
             
        }
		else
		{
             return $data;
         }
	}

public function getBlockListByMulDistCoordinator($distcoordinator_ids){
		$data = [];
		
		$query = $this->db->select("*")
				->from('block')
				->where_in('block.district_id',$distcoordinator_ids)
				->order_by('block.name')
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

	public function getGrpCoordListByMulBlock($block_ids){
		$data = [];
		
		$query = $this->db->select("*")
				->from('coordinator')
				->where_in('coordinator.block_id',$block_ids)
				->order_by('coordinator.name')
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


		public function getNqppListByMulGrpCoord($grpcoordinator_ids){
		$data = [];
		
		$query = $this->db->select("*")
				->from('nqpp')
				->where_in('nqpp.coordinator_id',$grpcoordinator_ids)
				->order_by('nqpp.name')
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


	/*get patient List report by selected ids*/
	public function getPatientRegCount($wherein,$selected_ids,$where_date,$where_dist){
		$data = [];
		
		
	 

		$query = $this->db->select('COUNT(*) as total')
				->from('patient')
				
				->join('nqpp','nqpp.id = patient.nqpp_id','INNER')
				->join('coordinator','coordinator.id = nqpp.coordinator_id','INNER')
				->join('block','block.id = coordinator.block_id','INNER')
				->join('district','district.id = block.district_id','INNER')
				->join('project','project.id = district.project_id','INNER')

				
				->where($where_date)
				->where_in($wherein, $selected_ids)
				->where($where_dist)
				->get();
			#q();
			if($query->num_rows()> 0)
				{
		          foreach($query->result() as $rows)
					{
						
						$data = $rows->total;
					}
		             
		        }
			
	        return $data;
	       
		
	}

	/*get patient List report groupby block and  selected ids*/
	public function getPatientListCountByblock($wherein,$selected_ids,$from_dt,$to_date,$where_dist){
		$data = [];
	$where_reg_date = "patient.patient_reg_date BETWEEN '".$from_dt."' AND '".$to_date."'";	
	$where_sputum_test_date = "patient.dmc_sputum_date BETWEEN '".$from_dt."' AND '".$to_date."'";
	$where_xray_date = "patient.xray_date BETWEEN '".$from_dt."' AND '".$to_date."'";	
	$where_cbnaat_test_date = "patient.cbnaat_date BETWEEN '".$from_dt."' AND '".$to_date."'"; 
	$where_diagnosed_date = "patient.patient_reg_date BETWEEN '".$from_dt."' AND '".$to_date."'
	and patient.is_tb_diagnosed='Y'";
	$where_treatment_date = "patient.trtmnt_start_date BETWEEN '".$from_dt."' AND '".$to_date."'";

		$query = $this->db->select('block.id as block_id,block.name as block_name')
				->from('block')
				->join('district','district.id = block.district_id','INNER')
				->join('coordinator','block.id = coordinator.block_id','INNER')
				->join('nqpp','coordinator.id = nqpp.coordinator_id','INNER')
				
				->where_in($wherein, $selected_ids)
				->where($where_dist)
				->group_by('block.id')
				->get();
			#q();
			if($query->num_rows()> 0)
				{
		          foreach($query->result() as $rows)
					{
						
						//$data[] = $rows;
							$data[] = array(
                        "block_id" => $rows->block_id,
                        "block_name" => $rows->block_name,
                        "ptc_reg_count" =>$this->getPatientRegCountByBlock($wherein,$selected_ids,$where_reg_date,$where_dist,$rows->block_id),
                        "sputum_count" =>$this->getPatientRegCountByBlock($wherein,$selected_ids,$where_sputum_test_date,$where_dist,$rows->block_id),
                        "xray_count" =>$this->getPatientRegCountByBlock($wherein,$selected_ids,$where_xray_date,$where_dist,$rows->block_id),
                        "cbnaat_count" =>$this->getPatientRegCountByBlock($wherein,$selected_ids,$where_cbnaat_test_date,$where_dist,$rows->block_id),
                         "diagnosed_count" =>$this->getPatientRegCountByBlock($wherein,$selected_ids,$where_diagnosed_date,$where_dist,$rows->block_id),
                         "treatment_count" =>$this->getPatientRegCountByBlock($wherein,$selected_ids,$where_treatment_date,$where_dist,$rows->block_id),

                       
                    
				      ); 
					}
		             
		        }
			
	        return $data;
	       
		
	}

/*get patient List report by selected ids*/
	public function getPatientRegCountByBlock($wherein,$selected_ids,$where_date,$where_dist,$blockid){
		$data = [];
		
		$whereblock = array('patient.patient_block' =>$blockid);
	 

		$query = $this->db->select('COUNT(*) as total')
				->from('patient')
				
				->join('nqpp','nqpp.id = patient.nqpp_id','INNER')
				->join('coordinator','coordinator.id = nqpp.coordinator_id','INNER')
				->join('block','block.id = coordinator.block_id','INNER')
				->join('district','district.id = block.district_id','INNER')
				->join('project','project.id = district.project_id','INNER')

				
				->where($where_date)
				->where_in($wherein, $selected_ids)
				->where($where_dist)
				->where($whereblock)
				->get();
			#q();
			if($query->num_rows()> 0)
				{
		          foreach($query->result() as $rows)
					{
						
						$data = $rows->total;
					}
		             
		        }
			
	        return $data;
	       
		
	}

}// end of class