<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class paymentgenerationreportmodel extends CI_Model{

	/*get payment generation List report by selected ids*/
	public function getPaymentGenerationListBymultipleSelect($wherein,$selected_ids,$frmdt=NULL,$todt=NULL){
		$data = [];
		
		if ($frmdt!=NULL && $todt!=NULL) {
			$where_date ="payment_gen_master.generation_dt BETWEEN '".$frmdt."' AND '".$todt."'";
		}else{
			$where_date = [];
		}
		$where_pmtdone = array(
						'payment_gen_master.is_payment_done' => 'N'
						 );
		$query = $this->db->select("payment_gen_master.*,
									nqpp.name AS nqppname,
									coordinator.name as coordinator_name,
									payment_gen_details.amount,
									payment_gen_master.generation_dt,
									patient.patient_name,
									patient.patient_uniq_id,
									patient.patient_mobile_primary,
									patient.patient_village

								   ")
				->from('payment_gen_master')
				->join('payment_gen_details','payment_gen_details.payment_id = payment_gen_master.id','INNER')
				->join('nqpp','nqpp.id = payment_gen_master.nqpp_id','INNER')
				->join('coordinator','coordinator.id = nqpp.coordinator_id','INNER')
				->join('patient','patient.patient_id = payment_gen_details.patient_id','INNER')
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
						$data[] = $rows;
						
				    
					}
		             
		        }
			
	        return $data;
	       
		
	}

	/*get payment generation List report by selected ids*/
	public function getPaymentGenerationListByGenerationDate($frmdt,$todt,$where_dist){
		$data = [];
		
		
			$where_date ="payment_gen_master.generation_dt BETWEEN '".$frmdt."' AND '".$todt."'";
	
		$where_pmtdone = array(
						'payment_gen_master.is_payment_done' => 'N'
						 );
		$query = $this->db->select("payment_gen_master.*,
									nqpp.name AS nqppname,
									coordinator.name as coordinator_name,
									payment_gen_details.amount,
									payment_gen_master.generation_dt,
									patient.patient_name,
									patient.patient_uniq_id,
									patient.patient_mobile_primary,
									patient.patient_village

								   ")
				->from('payment_gen_master')
				->join('payment_gen_details','payment_gen_details.payment_id = payment_gen_master.id','INNER')
				->join('nqpp','nqpp.id = payment_gen_master.nqpp_id','INNER')
				->join('coordinator','coordinator.id = nqpp.coordinator_id','INNER')
				->join('block','block.id = coordinator.block_id','INNER')
				->join('district','district.id = block.district_id','INNER')
				->join('patient','patient.patient_id = payment_gen_details.patient_id','INNER')
				->where($where_pmtdone)
				->where($where_date)
				->where($where_dist)
				->order_by('payment_gen_master.id')
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



	       
		
} // end of class