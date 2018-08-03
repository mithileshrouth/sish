<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class projetstatus_reportmodel extends CI_Model{


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




	/*get payment List report by selected ids*/
	public function getPatientCount($wherein,$selected_ids,$frmdt=NULL,$todt=NULL){
		$data = [];
		
		if ($frmdt!=NULL && $todt!=NULL) {
			$where_date ="patient.patient_reg_date BETWEEN '".$frmdt."' AND '".$todt."'";
		}else{
			$where_date = [];
		}
	 

		$query = $this->db->select('patient.nqpp_id,
									COUNT(patient.nqpp_id) as totalReg,
									nqpp.name as nqpp_name,
									coordinator.name as coordname,
									block.name as block,
									district.dist_coordinator
									')
				->from('patient')
				
				->join('nqpp','nqpp.id = patient.nqpp_id','INNER')
				->join('coordinator','coordinator.id = nqpp.coordinator_id','INNER')
				->join('block','block.id = coordinator.block_id','INNER')
				->join('district','district.id = block.district_id','INNER')
				->join('project','project.id = district.project_id','INNER')

				
				->where($where_date)
				->where_in($wherein, $selected_ids)
				->group_by('patient.nqpp_id')
				->get();
			q();
			if($query->num_rows()> 0)
				{
		          foreach($query->result() as $rows)
					{
						
						$data[] = array(
                        "nqpp_id" => $rows->nqpp_id,
                        "dist_coordinator" => $rows->dist_coordinator,
                        "block" => $rows->block,
                        "nqpp_name" => $rows->nqpp_name,
                        "coordinator" => $rows->coordname,
                        "totalReg" =>$rows->totalReg,
                        "totalDiagnosed" =>$this->getCountDiagnosed($rows->nqpp_id),
                        "totalPaymentGenerated" =>$this->getCountPaymentGenerated($rows->nqpp_id),
                        "totalPaid" =>$this->getCountPaid($rows->nqpp_id)
                    
				      ); 
					}
		             
		        }
			
	        return $data;
	       
		
	}


	public function getCountDiagnosed($nqpp_id){
		$data = 0;
		
		$where = array(
			'patient.nqpp_id' =>$nqpp_id,
			'patient.is_tb_diagnosed' =>'Y'
	);
		$query = $this->db->select(
									'COUNT(patient.nqpp_id) as countNumber,
									')
				->from('patient')
				->join('nqpp','nqpp.id = patient.nqpp_id','INNER')
				->where($where)
				->get();
			#q();
			if($query->num_rows()> 0)
				{
		         
						 $row = $query->row();
                        return $data = $row->countNumber;
					
		        }
			
	        return $data;
	       
		
	}


	public function getCountPaymentGenerated($nqpp_id){
		$data = 0;
		
		$where = array(
			'payment_gen_master.nqpp_id' =>$nqpp_id,
			'payment_gen_master.is_payment_done' =>'N'
		);
		$query = $this->db->select(
									'COUNT(payment_gen_master.nqpp_id) as countNumber,
									')
				->from('payment_gen_master')
				->join('payment_gen_details','payment_gen_details.payment_id = payment_gen_master.id','INNER')
				->where($where)
				->get();
			#q();
			if($query->num_rows()> 0)
				{
		         
						 $row = $query->row();
                        return $data = $row->countNumber;
					
		        }
			
	        return $data;
	       
		
	}


	public function getCountPaid($nqpp_id){
		$data = 0;
		
		$where = array(
			'payment_gen_master.nqpp_id' =>$nqpp_id,
			'payment_gen_master.is_payment_done' =>'Y'
		);
		$query = $this->db->select(
									'COUNT(payment_gen_master.nqpp_id) as countNumber,
									')
				->from('payment_gen_master')
				->join('payment_gen_details','payment_gen_details.payment_id = payment_gen_master.id','INNER')
				->where($where)
				->get();
			#q();
			if($query->num_rows()> 0)
				{
		         
						 $row = $query->row();
                        return $data = $row->countNumber;
					
		        }
			
	        return $data;
	       
		
	}

} // end of class