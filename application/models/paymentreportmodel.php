<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class paymentreportmodel extends CI_Model{


	public function getNqppListByCoordinator($coordinatorid){
			$where = array('nqpp.coordinator_id' => $coordinatorid );
			$data = [];
			$query = $this->db->select("*")
					->from('nqpp')
					->where($where)
				    ->order_by('nqpp.name')
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

	public function getNqppListByMultipleCoordinator($coordinator_ids){
		$data = [];
		
		$query = $this->db->select("*")
				->from('nqpp')
				->where_in('nqpp.coordinator_id', $coordinator_ids)
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


		public function getPaymentListByNqpp($nqppid){
			$where = array(
						'payment_gen_master.nqpp_id' => $nqppid,
						'payment_gen_master.is_payment_done' => 'Y'
						 );
			$data = [];
			$query = $this->db->select("
									payment_gen_master.id,
									payment_gen_master.generation_dt,
									payment_gen_master.transaction_id,
									payment_gen_master.nqpp_id,
									payment_gen_master.payable_amt,
									nqpp.name AS nqppname,
									payment_master.amount,
									payment_master.due,
									payment_master.payment_dt,
									payment_master.remarks
				                  ")
					->from('payment_gen_master')
					->join('payment_master','payment_master.payment_gen_id = payment_gen_master.id','INNER')
					->join('nqpp','nqpp.id = payment_gen_master.nqpp_id','INNER')
					->where($where)
				    ->order_by('payment_gen_master.id')
					->get();
				
				if($query->num_rows()> 0)
				{
		          foreach($query->result() as $rows)
					{
						//$data[] = $rows;
						$data[] = array(
                        "paymentmstData" => $rows,
                        "paymentDetailsData" =>$this->getPaymentGenDetails($rows->id)
                    
				      ); 
					}
		             
		        }
				
		        return $data;
	       
		
	}

	/*get payment List report by selected ids*/
	public function getPaymentListBymultipleSelect($wherein,$selected_ids,$frmdt=NULL,$todt=NULL){
		$data = [];
		
		if ($frmdt!=NULL && $todt!=NULL) {
			$where_date ="payment_master.payment_dt BETWEEN '".$frmdt."' AND '".$todt."'";
		}else{
			$where_date = [];
		}
		$where_pmtdone = array(
						'payment_gen_master.is_payment_done' => 'Y'
						 );
		$query = $this->db->select("payment_gen_master.*,
									nqpp.name AS nqppname,
									coordinator.name as coordinator_name,
									payment_master.amount,
									payment_master.due,
									payment_master.payment_dt,
									payment_master.remarks
								   ")
				->from('payment_gen_master')
				->join('payment_master','payment_master.payment_gen_id = payment_gen_master.id','INNER')
				->join('nqpp','nqpp.id = payment_gen_master.nqpp_id','INNER')
				->join('coordinator','coordinator.id = nqpp.coordinator_id','INNER')
				->where($where_pmtdone)
				->where($where_date)
				->where_in($wherein, $selected_ids)
				->order_by('payment_gen_master.id')
				->get();
			#q();
			if($query->num_rows()> 0)
				{
		          foreach($query->result() as $rows)
					{
						//$data[] = $rows;
						$data[] = array(
                        "paymentmstData" => $rows,
                        "paymentDetailsData" =>$this->getPaymentGenDetails($rows->id)
                    
				      ); 
					}
		             
		        }
			
	        return $data;
	       
		
	}


/*get payment List report by selected ids*/
	public function getPaymentListByPaymentDate($frmdt,$todt){
		$data = [];
		
		
		$where_date ="payment_master.payment_dt BETWEEN '".$frmdt."' AND '".$todt."'";
		
		$where_pmtdone = array(
						'payment_gen_master.is_payment_done' => 'Y'
						 );
		$query = $this->db->select("payment_gen_master.*,
									nqpp.name AS nqppname,
									coordinator.name as coordinator_name,
									payment_master.amount,
									payment_master.due,
									payment_master.payment_dt,
									payment_master.remarks
								   ")
				->from('payment_gen_master')
				->join('payment_master','payment_master.payment_gen_id = payment_gen_master.id','INNER')
				->join('nqpp','nqpp.id = payment_gen_master.nqpp_id','INNER')
				->join('coordinator','coordinator.id = nqpp.coordinator_id','INNER')
				->where($where_pmtdone)
				->where($where_date)
				->order_by('payment_gen_master.id')
				->get();
			#q();
			if($query->num_rows()> 0)
				{
		          foreach($query->result() as $rows)
					{
						//$data[] = $rows;
						$data[] = array(
                        "paymentmstData" => $rows,
                        "paymentDetailsData" =>$this->getPaymentGenDetails($rows->id)
                    
				      ); 
					}
		             
		        }
			
	        return $data;
	       
		
	}

	public function getPaymentGenDetails($payment_gen_id){
     $data = [];
    	$where = array(
			
			"payment_gen_details.payment_id"=>$payment_gen_id
		);
        $data = array();
		$this->db->select("
							payment_gen_details.amount,
							patient.patient_uniq_id,
							patient.patient_name,
							patient.patient_mobile_primary,
							patient.patient_village,
							patient.patient_gram_panchayat

							")
				->from('payment_gen_details')
				->join('patient','patient.patient_id = payment_gen_details.patient_id','INNER')
				->where($where);
		$query = $this->db->get();
		
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




}