<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class paymentgenerationmodel extends CI_Model{


		public function getAllPatientList(){
		$data = [];
		$query = $this->db->select("*")
				->from('patient')
			    ->order_by('patient.patient_name')
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
			$query = $this->db->select("*")
					->from('payment_gen_master')
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


		public function gePatientListByNqpp($nqppid){
			$where = array(
				'patient.nqpp_id' => $nqppid,
				'patient.is_tb_diagnosed' =>'Y' 
			);
			$data = [];
			$query = $this->db->select("
									   patient.patient_id,
							           patient.patient_name,
							           patient.patient_mobile_primary,
							           patient.patient_village,
							           patient.patient_gram_panchayat,
							           block.name as blockname
							           ")
					->from('patient')
					->join('block','block.id = patient.patient_block','LEFT')
					->join('payment_gen_details','payment_gen_details.patient_id = patient.patient_id','LEFT')
					->where('payment_gen_details.patient_id IS NULL')
					->where($where)
				    ->order_by('patient.patient_name')
					->get();
				//q();
				if($query->num_rows()> 0)
				{
		          foreach($query->result() as $rows)
					{
						$data[] = $rows;
					}
		             
		        }
				
		        return $data;
	       
		
	}



	public function gePatientListByPmtGenID($payment_gen_id){
			$where = array('payment_gen_details.payment_id' => $payment_gen_id );
			$data = [];
			$query = $this->db->select("
									   patient.patient_id,
							           patient.patient_name,
							           patient.patient_mobile_primary,
							           patient.patient_village,
							           patient.patient_gram_panchayat,
							           block.name as blockname,
							           payment_gen_master.transaction_id
							           ")
					->from('payment_gen_details')
					->join('patient','patient.patient_id = payment_gen_details.patient_id','INNER')
					->join('payment_gen_master','payment_gen_master.id = payment_gen_details.payment_id','INNER')
					->join('block','block.id = patient.patient_block','LEFT')
					->where($where)
					->get();
				//q();
				if($query->num_rows()> 0)
				{
		          foreach($query->result() as $rows)
					{
						$data[] = $rows;
					}
		             
		        }
				
		        return $data;
	       
		
	}


		public function getNqppIncentive(){
			$where = array('incentive.role_id' => 4,
						   'incentive.is_active' => 1 );
			$data = [];
			$query = $this->db->select("*")
					->from('incentive')
					->where($where)
				    ->order_by('incentive.id','desc')
				    ->limit(1)
					->get();
				//q();
				if($query->num_rows()> 0)
				{
		          foreach($query->result() as $rows)
					{
						$data[] = $rows;
					}
		             
		        }
				
		        return $data;
	       
		
	}

	public function insertIntoPaymentMaster($data){

			$this->db->insert('payment_gen_master', $data);
			
			$last_id = $this->db->insert_id();
			return $last_id;
       
	}


	public function getLatestSerialNumber($from,$project_id){
        $lastnumber = (int)(0);
        $serialno="";
        $sql="SELECT *
            FROM serial_master
            WHERE serial_master.project_id=".$project_id." 
			AND serial_master.type='".$from."'
			LOCK IN SHARE MODE";
        $query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			  $row = $query->row(); 
			  $lastnumber = $row->next_serial_no;
        }
        $digit = (int)(log($lastnumber,10)+1) ; 
        if($digit==7){
            $serialno ="0".$lastnumber;
        }
        elseif($digit==6){
            $serialno ="00".$lastnumber;
        } 
        elseif($digit==5){
            $serialno ="00".$lastnumber;
        }
		elseif($digit==4){
              $serialno = "000".$lastnumber;
        }
		elseif($digit==3){
            $serialno = "0000".$lastnumber;
        }
		elseif($digit==2){
            $serialno = "00000".$lastnumber;
        }
		elseif($digit==1){
            $serialno = "000000".$lastnumber;
        }
        $lastnumber = $lastnumber + 1;
        
        //update
        $upddata = [
			'serial_master.next_serial_no' => $lastnumber,
        ];
        $where = [
			'project_id' => $project_id,
			'serial_master.type' => $from
			];
        $this->db->where($where); 
        $this->db->update('serial_master', $upddata);
        return $serialno;
    }


	public function getpaymentid($txnno){
			$where = array('payment_gen_master.transaction_id' => $txnno );
			$data = [];
			$query = $this->db->select("*")
					->from('payment_gen_master')
					->where($where)
					->limit(1)
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

  function deletePaymentGenerationDetails($payment_gen_id){

  	   $this->db->where('payment_gen_details.payment_id', $payment_gen_id)
                ->delete('payment_gen_details');
                if ($this->db->affected_rows()) {
                	return 1;
                }else{
                	return 0;
                }
  }

}// end of class
