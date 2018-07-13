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