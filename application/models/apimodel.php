<?php
class apimodel extends CI_Model {
	public function __construct()
	{
		$this->load->model('rolemastermodel','rolemodel',TRUE);
	}
	
	
    public function getAPIkey(){
        $key ="";
        $query = $this->db->select("*")
			  ->from("project")
			  ->where('project.project', 'SHIS')
			  ->get();
        if($query->num_rows()>0){
            $row = $query->row();
            $key = $row->apikey;
                    
        }
        return $key;
    }
    
    public function verifymobilelogin($mobileno,$password,$roleid,$projectid){
        //$this->db->escape($login)
        $userid= 0;
        $sql="SELECT user_master.`id` FROM user_master WHERE 
                user_master.`mobile_no`=".trim($this->db->escape($mobileno))."
                AND
                user_master.`password` =".trim($this->db->escape($password))."
				AND 
				user_master.project_id =".(int)$projectid."
                AND
                user_master.`role_id`=".(int)$roleid;
        
        $query = $this->db->query($sql);
		//echo $this->db->last_query();
         if($query->num_rows()>0){
             $row = $query->row();
             $userid = $row->id;
         }
         return $userid;
    }
	
	public function getAllPTBPhase(){
		$data = [];
		$query = $this->db->select("*")
					->from("ptb_phase_master")
					->order_by("ptb_phase_master.phase_order","ASC")->get();
		
		if($query->num_rows()> 0)
		{
	        foreach($query->result() as $rows)
			{
				$data[] = $rows;
			}
	            
	    }
			
	    return $data;
	}
	
	
	public function getAllCategory(){
		$data = [];
		$query = $this->db->select("*")
					->from("treatment_category")
					->where("treatment_category.is_active",1)
					->order_by("treatment_category.category_name","ASC")
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
	
	public function getOutComeList(){
		$data = [];
		$query = $this->db->select("*")
					->from("outcome_master")
					->where("outcome_master.is_active",1)
					->order_by("outcome_master.name","ASC")
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
	
	
	

	
	public function insertIntoPatient($data,$localsession){
		try {
            $this->db->trans_begin();
			
			
			$reg_data = [];
			
			
				// Personal Data Info
				$personaldata = $data->personalInfo;
				
				$name = $personaldata->name; 
				$age = $personaldata->age;
				$gender = $personaldata->gender;
				$guardiancontact = $personaldata->guardiancontact;
				$guardianname = $personaldata->guardianname;
				$mobile = $personaldata->mobile;
				$mblalternate = $personaldata->mblalternate;
				
				// Address Data Info
				$addressdata = $data->addressInfo;
				
				$block = $addressdata->block;
				$country = $addressdata->country;
				$district = $addressdata->district;
				$fulladdress = $addressdata->fulladdress;
				$pincode = $addressdata->pincode;
				$postoffice = $addressdata->postoffice;
				$state = $addressdata->state;
				$village = $addressdata->village;
				
				// Document Data Info
				$documentdata = $data->documentInfo;
				
				$aadharno = $documentdata->aadharno;
				$rationno = $documentdata->rationno;
				$voterid = $documentdata->voterid;
				
				// Referral & Others
				$referaldata = $data->refferalInfo;
				$referraldate = $referaldata->referraldate;
				$refferedbycord = $referaldata->refferedbycoordinator;
				$refferedbynqpp = $referaldata->refferedbynqpp;
				$symptom = $referaldata->symptom;
				
				
			
			$reg_data = [
				"patient_uniq_id" => NULL,
				"patient_name" => trim(htmlspecialchars($name)),
				"patient_mobile_primary" => trim(htmlspecialchars($mobile)),
				"patient_age" => trim(htmlspecialchars($age)),
				"patient_full_address" => trim(htmlspecialchars($fulladdress)),
				"patient_village" => trim(htmlspecialchars($village)),
				"patient_postoffice" => trim(htmlspecialchars($postoffice)),
				"patient_pin" => trim(htmlspecialchars($pincode)),
				"patient_state" => $state,
				"patient_country" => $country,
				"patient_gurdian" => trim(htmlspecialchars($guardianname)),
				"patient_sex" => trim(htmlspecialchars($gender)),
				"patient_block" => $block,
				"patient_district" => $district,
				"patient_adhar" => trim(htmlspecialchars($aadharno)),
				"patient_voter" => trim(htmlspecialchars($voterid)),
				"patient_ration" => trim(htmlspecialchars($rationno)),
				"patient_symptom" => trim(htmlspecialchars($symptom)),
				"nqpp_id" =>  $refferedbynqpp,
				"group_cord_id" =>  $refferedbycord
			];
			
			
			$this->db->insert('patient', $reg_data);
		
		
			
			$user_activity = array(
					"activity_module" => 'PTB REG',
					"action" => "Insert",
					"from_method" => "roleAPI/registerPTB/insertIntoPatient",
					"user_id" => $localsession->uid,
					"ip_address" => getUserIPAddress(),
					"user_browser" => getUserBrowserName(),
					"user_platform" => getUserPlatform()
				);
			
			$this->db->insert('activity_log', $user_activity);
           
            if($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return false;
            } else {
                $this->db->trans_commit();
                return true;
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
	}
	
	
	public function getPtientList($localsession){
		if($localsession->rcode=="CORD"){
			$where = [
				"coordinator.userid" =>$localsession->uid
			];
			$query = $this->db->select("*")
					->from("patient")
					->join("coordinator","coordinator.id = patient.group_cord_id","INNER")
					->where($where)
					->order_by("patient.patient_reg_date","DESC")->get();
		}
		elseif($localsession->rcode=="NQPP"){
			$where = [
				"nqpp.userid" =>$localsession->uid
			];
			$query = $this->db->select("*")
					->from("patient")
					->join("nqpp","nqpp.id = patient.nqpp_id","INNER")
					->where($where)
					->order_by("patient.patient_reg_date","DESC")->get();
		}
		else{
			$query = $this->db->select("*")
					->from("patient")
					->where($where)
					->order_by("patient.patient_reg_date","DESC")->get();
		}
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
    
	
	public function getPtientDataById($pid){
		$data = [];
		$where = [
				"patient.patient_id" =>$pid
			];
			//$this->db->_protect_identifiers=true;
		$query = $this->db->select("patient.*,ptb_treatment_detail.*,
						 DATE_FORMAT(ptb_treatment_detail.`first_followup_dt`,'%d/%m%/%Y') AS first_followup_dt,
						DATE_FORMAT(ptb_treatment_detail.`second_followup_dt`, '%d/%m%/%Y') AS second_followup_dt
						",FALSE)
					->from("patient")
					->join("ptb_treatment_detail","ptb_treatment_detail.patient_id = patient.patient_id","INNER")
					->where($where)
					->get();
				
		 if($query->num_rows()>0){
            $data = $query->row();
           
                    
        }
        return $data;
	}
	
	
	public function updatePatientDataStatusWise($patientdata,$localsession){
		try {
            $this->db->trans_begin();
			
			$patientid = $patientdata->pid;
			$updFrom = $patientdata->sfrom;
			$updateDatas = $patientdata->fval;	
			$upd_data = [];
			
			if($updFrom=="SPUTUM"){
				$upd_data = [
					"dmc_sputum_done" => "Y",
					"dmc_sputum_date" => date("Y-m-d",strtotime($updateDatas->sputumColDate)),
					"dmc_id" => $updateDatas->sputumDmc
				];
			
				$this->db->where('patient.patient_id', $patientid);
				$this->db->update('patient', $upd_data); 
			}
			if($updFrom=="SPUTUM_RESULT"){
				$upd_data = [
					"dmc_result_done" => "Y",
					"dmc_spt_is_positive" => $updateDatas->sputumResultFeed
				];
				
				$this->db->where('patient.patient_id', $patientid);
				$this->db->update('patient', $upd_data); 
			}
			if($updFrom=="XRAY"){
				$upd_data = [
					"xray_is_done" => "Y",
					"xray_date" => date("Y-m-d",strtotime($updateDatas->xrayColdate)),
					"xray_cntr_id" => $updateDatas->xrayCenter
				];
				
				$this->db->where('patient.patient_id', $patientid);
				$this->db->update('patient', $upd_data); 
			}
			if($updFrom=="XRAY_RESULT"){
				$upd_data = [
					"xray_result_done" => "Y",
					"xray_is_postive" => $updateDatas->xrayResultFeed
				];
				
				$this->db->where('patient.patient_id', $patientid);
				$this->db->update('patient', $upd_data); 
			}
			if($updFrom=="CBNAAT"){
				$upd_data = [
					"is_cbnaat_done" => "Y",
					"cbnaat_date" => date("Y-m-d",strtotime($updateDatas->cbnaatColdate)),
					"cbnaat_id" => $updateDatas->cbnaatCenterName
				];
				
				$this->db->where('patient.patient_id', $patientid);
				$this->db->update('patient', $upd_data); 
			}
			if($updFrom=="CBNAAT_RESULT"){
				$upd_data = [
					"cbnaat_result_done" => "Y",
					"cbnaat_pstv" => $updateDatas->cbnaatResultFeed
				];
				
				$this->db->where('patient.patient_id', $patientid);
				$this->db->update('patient', $upd_data); 
			}
			if($updFrom=="TREATMENT"){
				
				$treatmentDtl = $this->gettreatmentStructureDatas($updateDatas);
				$firstfollowupdt = str_replace('/', '-', $treatmentDtl['first_followup_date']);
				$treatmentenddate = str_replace('/', '-', $treatmentDtl['second_followup_date']);
				$upd_data = [
					"is_ptb_trtmnt_done" => "Y",
					"trtmnt_start_date" => date("Y-m-d",strtotime($updateDatas->treatmentStartDt)),
					"trtmnt_end_date" => date("Y-m-d",strtotime($treatmentenddate)),
					"trtmnt_duration" =>  $treatmentDtl["treatment_tenure_days"]
				];
				
				
				$patien_detail_data = [
					"patient_id" => $patientid,
					"category_id" => $updateDatas->treatmentCategory,
					"first_followup_dt" => date("Y-m-d",strtotime($firstfollowupdt)),
					"second_followup_dt" => date("Y-m-d",strtotime($treatmentenddate))
				];
				
				$this->db->where('patient.patient_id', $patientid);
				$this->db->update('patient', $upd_data); 
				$this->db->insert('ptb_treatment_detail', $patien_detail_data); 
			}
			
			if($updFrom=="OUTCOME"){
				$trtmnt_dtl = [
					"outcome" => $updateDatas->outcomeStatus
				];
				
				$this->db->where('ptb_treatment_detail.patient_id', $patientid);
				$this->db->update('ptb_treatment_detail', $trtmnt_dtl); 
			
			}
			
			
			
				$user_activity = array(
					"module_master_id" => $patientid,
					"activity_module" => "PATIENT ".$updFrom,
					"action" => "Update",
					"from_method" => "roleAPI/updatePTBStatusData/updatePatientDataStatusWise",
					"user_id" => $localsession->uid,
					"ip_address" => getUserIPAddress(),
					"user_browser" => getUserBrowserName(),
					"user_platform" => getUserPlatform()
				);
			
			$this->db->insert('activity_log', $user_activity);
           
            if($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return false;
            } else {
                $this->db->trans_commit();
                return true;
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
	}
	
	
	
	public function gettreatmentStructureDatas($datas){
		$data = [];
		$where = [
			"treatment_structure.category_id" => $datas->treatmentCategory,
			"treatment_structure.is_active" => 1
		];
		
		$query = $this->db->select("*")
					->from("treatment_structure")
					->where($where)
					->get();
		//echo $this->db->last_query();
		if($query->num_rows()>0){
            $row = $query->row();
            $data = [
				"treatment_tenure_days" => $row->treatment_tenure,
				"first_followup" => $row->first_followup,
				"second_followup" => $row->second_folloup,
				
				"first_followup_date" => $this->getNewDateByNoOfDays($datas->treatmentStartDt,$row->first_followup),
				"second_followup_date" => $this->getNewDateByNoOfDays($datas->treatmentStartDt,$row->second_folloup),
			];
			
			
         }
		 
		 return $data;
		
	}
	
	public function getNewDateByNoOfDays($startdate,$days){
		
		$newDate = date('Y-m-d', strtotime($startdate. " + $days days"));
		return date("d/m/Y",strtotime($newDate));

	}
}
