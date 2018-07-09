<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class paymentmodel extends CI_Model{


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


	public function getTransactionListByNqpp($nqppid){
			$where = array(
						'payment_gen_master.nqpp_id' => $nqppid,
						'payment_gen_master.is_payment_done' => 'N'
						 );
			$data = [];
			$query = $this->db->select("
									payment_gen_master.id,
									payment_gen_master.generation_dt,
									payment_gen_master.transaction_id,
									payment_gen_master.nqpp_id,
									payment_gen_master.payable_amt,
									nqpp.name AS nqppname 
				                  ")
					->from('payment_gen_master')
					->join('nqpp','nqpp.id = payment_gen_master.nqpp_id','INNER')
					->where($where)
				    ->order_by('payment_gen_master.id')
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
	       
		
} //end of class