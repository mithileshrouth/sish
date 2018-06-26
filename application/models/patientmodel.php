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

	public function getPatientDetailsById($patientid)
	{
		$where = array('patient.patient_id' => $patientid );
		$data = array();
		$this->db->select("
							 patient.patient_id,
							 patient.patient_name,
							 patient.patient_sex,
							 patient.patient_mobile_primary,
							 patient.patient_uniq_id,
							 patient.patient_reg_date,
							 patient.patient_full_address,
							 patient.patient_age,
							 patient.patient_gurdian,
							 patient.patient_village,
							 patient.patient_postoffice,
							 patient.patient_pin,
							 patient.patient_block,
							 patient.patient_district,
							 patient.patient_adhar,
							 patient.patient_voter,
							 patient.patient_ration,
							 patient.dmc_sputum_done,
							 patient.dmc_sputum_date,
							 patient.dmc_result_done,
							 patient.dmc_spt_is_positive,
							 patient.dmc_rslt,
							 patient.xray_is_done,
							 patient.xray_date,
							 patient.xray_result_done,
							 patient.xray_is_postive,
							 patient.xray_rslt,
							 patient.is_cbnaat_done,
							 patient.cbnaat_date,
							 patient.cbnaat_result_done,
							 patient.cbnaat_pstv,
							 patient.is_ptb_trtmnt_done,
							 patient.trtmnt_start_date,
							 patient.trtmnt_duration,

							 patient.cbnaat_rslt,
							 state.state as statename,
							 nqpp.name as nqpp_name,
							 district.name as districtname,
							 block.name as blockname,
							 coordinator.name as coordinator_name,
							 country.name as countryname,
							 dmc.name as dmcname,
							 dmc.lt_name as dmclt_name,
							 dmc.mobile_no as dmcmobile_no,
							 xray_center.name as xraycntname,
							 xray_center.lt_name as xraylt_name,
							 xray_center.mobile_no as xraymobile_no,
							 cbnaat.name as cbnaatname,
							 cbnaat.lt_name as cbnaatlt_name,
							 cbnaat.mobile_no as cbnaatmobile_no
							 " )
							->from('patient')
							->join('nqpp','nqpp.id = patient.nqpp_id','LEFT')
							->join('coordinator','coordinator.id = patient.group_cord_id','LEFT')
							->join('state','state.id = patient.patient_state','LEFT')
							->join('district','district.id = patient.patient_district','LEFT')
							->join('block','block.id = patient.patient_block','LEFT')
							->join('country','country.id = patient.patient_country','LEFT')
							->join('dmc','dmc.id = patient.dmc_id','LEFT')
							->join('xray_center','xray_center.id = patient.xray_cntr_id','LEFT')
							->join('cbnaat','cbnaat.id = patient.cbnaat_id','LEFT')
							->where($where)
							->limit(1);
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


	public function getPatientTreatmentDetailsById($patientid){
		$data = [];
		$where = array('ptb_treatment_detail.patient_id' => $patientid );
		$query = $this->db->select("
									ptb_treatment_detail.id,
									treatment_category.category_name,
									ptb_treatment_detail.first_followup_dt,
									ptb_treatment_detail.second_followup_dt,
									ptb_treatment_detail.outcome

									")
				->from('ptb_treatment_detail')
				->join('treatment_category','treatment_category.id = ptb_treatment_detail.category_id','LEFT')
				->where($where)
				->order_by('ptb_treatment_detail.id','desc')
				->limit(1)
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