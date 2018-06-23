<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class patientmodel extends CI_Model{
	public function __construct()
	{
	   // parent::__construct();
	
		$this->load->model('rolemastermodel','rolemodel',TRUE);
	}
	
	
	public function getAllPatient(){
		$data = [];
		$query = $this->db->select("*")
				->from('patient')
				->order_by('patient.patient_id')
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


}// End of Class