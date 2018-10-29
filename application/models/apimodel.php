<?php
class apimodel extends CI_Model {
	public function __construct()
	{
		$this->load->model('rolemastermodel','rolemodel',TRUE);
		$this->load->model('coordinatormodel','coordinator',TRUE);
		$this->load->model('nqppmodel','nqpp',TRUE);
		$this->load->model('dmcmodel','dmc',TRUE);
		$this->load->model('locationmodel','location',TRUE);
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
	
	public function getSymptomList(){
		$data = [];
		$query = $this->db->select("*")
					->from("symptoms_master")
					->where("symptoms_master.is_active",1)
					->order_by("symptoms_master.symptom","ASC")
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
			$this->load->library('parser');
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
				$tuunitid = $addressdata->tuunit;
				//$country = $addressdata->country;
				$district = $addressdata->district;
				$fulladdress = $addressdata->fulladdress;
				$pincode = $addressdata->pincode;
				$postoffice = $addressdata->postoffice;
				//$state = $addressdata->state;
				$village = $addressdata->village;
				$grampanchayat = $addressdata->grampanchayat;
				$dmcid = $addressdata->selecteddmc;
				
				// Document Data Info
				$documentdata = $data->documentInfo;
				
				$aadharno = $documentdata->aadharno;
				$rationno = $documentdata->rationno;
				$voterid = $documentdata->voterid;
				
				// Referral & Others
				$referaldata = $data->refferalInfo;
				$referraldate = $referaldata->referraldate;
				$refferedbycord = $referaldata->refferedbycoordinator;
				
				$nqppdata = $referaldata->refferedbynqpp;
				
				$refferedbynqpp = $nqppdata->id;
				$pulmonary = $referaldata->pulmonarytype;
				$symptom = $referaldata->symptom;
				
				
				$referral_date = substr($referaldata->referraldate,0,10); // substr because time format is coming as ISO
			
				
				$latest_serial = $this->getLatestSerialNumber("REG",$localsession->prj);
				
				$district_row = $this->location->getDistrict($district);
				$block_row = $this->location->getBlock($block);
				
				$patient_uniqID = NULL;
				if(sizeof($district_row)>0 && sizeof($block_row)>0){
					$district_code = $district_row->dist_code;
					$block_code = $block_row->block_code;
					
					$patient_uniqID = "PTC/".$district_code."/".$block_code."/".$latest_serial;
				}
			
			$state_id = $this->location->getStateByDistrictID($district);
			
			
			
			$reg_data = [
				"patient_uniq_id" => $patient_uniqID,
				"patient_name" => trim(htmlspecialchars($name)),
				"patient_mobile_primary" => trim(htmlspecialchars($mobile)),
				"patient_age" => trim(htmlspecialchars($age)),
				"patient_full_address" => trim(htmlspecialchars($fulladdress)),
				"patient_village" => trim(htmlspecialchars($village)),
				"patient_gram_panchayat" => trim(htmlspecialchars($grampanchayat)),
				"patient_postoffice" => trim(htmlspecialchars($postoffice)),
				"patient_pin" => trim(htmlspecialchars($pincode)),
				"patient_state" =>  $state_id,
				"patient_country" => $this->location->getCountryIDByStateID($state_id),
				"patient_gurdian" => trim(htmlspecialchars($guardianname)),
				"patient_guardian_contact" => trim(htmlspecialchars($guardiancontact)),
				"patient_sex" => trim(htmlspecialchars($gender)),
				"patient_block" => $block,
				"patient_tuid" => $tuunitid,
				"patient_district" => $district,
				"patient_adhar" => trim(htmlspecialchars($aadharno)),
				"patient_voter" => trim(htmlspecialchars($voterid)),
				"patient_ration" => trim(htmlspecialchars($rationno)),
				"patient_referal_date" => date("Y-m-d",strtotime($referral_date)),
				"patient_pulmonary" => trim(htmlspecialchars($pulmonary)),
				"patient_symptom" => NULL,
				"nqpp_id" =>  $refferedbynqpp,
				"group_cord_id" =>  $refferedbycord,
				"dmc_id" => $dmcid,
				"registered_by_user" => $localsession->uid
			];
			
			//pre($reg_data);
			
			$this->db->insert('patient', $reg_data);
			$ptb_inserted_id = $this->db->insert_id();
			//echo "Q ".$this->db->last_query();
			//exit;
			// INSERT INTO PATIENTsYMPTOM
			if(isset($symptom)){
				$this->insertIntoPTBSymptomDtl($ptb_inserted_id,$symptom);
			}
			

						
			$sms_row = $this->getMessageContentToSendSMS("REG");
			$result_data = $this->getRolesToSendSMS("REG");
			
			$param_value = [
				"PTB_NAME" => trim(htmlspecialchars($name)),
				"PTB_ID" => $patient_uniqID,
				"PTB_REG_DATE" => date("d/m/Y"),
				"PTB_MOBILE" => trim(htmlspecialchars($mobile))
			];
			$smstext = $this->parser->parse_string($sms_row->sms_content, $param_value, true);
			
			foreach($result_data as $sendsms_to_role){
				if($sendsms_to_role->role_code=="CORD"){
					$coordinator_row = $this->coordinator->getCoordinatorEditDataByID($refferedbycord);
					if(sizeof($coordinator_row)>0){
						$coordinator_mobile = $coordinator_row->cordmobile;
						
						/*
						$sms_status = $this->sendSMS($coordinator_mobile,$smstext);	

						$sms_log = [
							"performed_by_user_id" => $localsession->uid,
							"sms_sent_against_ptb_id" => $ptb_inserted_id,
							"sms_action_mst_id" => $sms_row->id,
							"send_to_role" => $sendsms_to_role->send_to_roleid,
							"receiver_user_id" => $coordinator_row->userid,
							"receiver_mobile_no" => $coordinator_mobile,
							"is_sent" => $sms_status
						];

						$this->db->insert('sms_sent_report', $sms_log);  
						*/
						
						
						
					}
					
				}
				if($sendsms_to_role->role_code=="DISTCORD"){
					$distcord_row = $this->location->getDistrict($district);
					if(sizeof($distcord_row)>0){
						$distcord_mobile = $distcord_row->dist_cordinator_mbl;
						
						/*
						$sms_status = $this->sendSMS($distcord_mobile,$smstext);	

						$sms_log = [
							"performed_by_user_id" => $localsession->uid,
							"sms_sent_against_ptb_id" => $ptb_inserted_id,
							"sms_action_mst_id" => $sms_row->id,
							"send_to_role" => $sendsms_to_role->send_to_roleid,
							"receiver_user_id" => $distcord_row->userid,
							"receiver_mobile_no" => $distcord_mobile,
							"is_sent" => $sms_status
						];

						$this->db->insert('sms_sent_report', $sms_log);  
						*/
						
						
					}
					
				}
				elseif($sendsms_to_role->role_code=="NQPP"){
					$nqpp_row = $this->nqpp->getNQPPEditDataByID($refferedbynqpp);
					if(sizeof($nqpp_row)>0){
						$nqpp_mobile = $nqpp_row->nqppmobile;
						
						/*
						 $sms_status = $this->sendSMS($nqpp_mobile,$smstext);
						 $sms_log = [
							"performed_by_user_id" => $localsession->uid,
							"sms_sent_against_ptb_id" => $ptb_inserted_id,
							"sms_action_mst_id" => $sms_row->id,
							"send_to_role" => $sendsms_to_role->send_to_roleid,
							"receiver_user_id" => $nqpp_row->userid,
							"receiver_mobile_no" => $nqpp_mobile,
							"is_sent" => $sms_status
						];

						$this->db->insert('sms_sent_report', $sms_log); 
						*/
						
						
					}
					
				}
				elseif($sendsms_to_role->role_code=="DMC"){
					$dmc_row = $this->dmc->getDMCEditDataByID($dmcid);
					if(sizeof($dmc_row)>0){
						$dmc_lt_mobile = $dmc_row->ltmobile;
						
						/*
						$sms_status = $this->sendSMS($dmc_lt_mobile,$smstext);
						$sms_log = [
							"performed_by_user_id" => $localsession->uid,
							"sms_sent_against_ptb_id" => $ptb_inserted_id,
							"sms_action_mst_id" => $sms_row->id,
							"send_to_role" => $sendsms_to_role->send_to_roleid,
							"receiver_user_id" => $dmc_row->userid,
							"receiver_mobile_no" => $dmc_lt_mobile,
							"is_sent" => $sms_status
						];

						$this->db->insert('sms_sent_report', $sms_log); 
						*/
						
					

						
						
					}
					
				}
				elseif($sendsms_to_role->role_code=="PTB"){
					
					/*
					$sms_status = $this->sendSMS($mobile,$smstext);
					$sms_log = [
							"performed_by_user_id" => $localsession->uid,
							"sms_sent_against_ptb_id" => $ptb_inserted_id,
							"sms_action_mst_id" => $sms_row->id,
							"send_to_role" => $sendsms_to_role->send_to_roleid,
							"receiver_user_id" => $ptb_inserted_id, // receiver userid = patient id in this case
							"receiver_mobile_no" => $mobile,
							"is_sent" => $sms_status
						];
					$this->db->insert('sms_sent_report', $sms_log); 
					*/
					
				}
				
			}
			
			
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
        } 
		catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
	}
	
	
	
	// Update PTC 
	public function updatePTCData($ptcid,$data,$localsession){
		try {
			$this->load->library('parser');
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
				$tuunitid = $addressdata->tuunit;
				//$country = $addressdata->country;
				$district = $addressdata->district;
				$fulladdress = $addressdata->fulladdress;
				$pincode = $addressdata->pincode;
				$postoffice = $addressdata->postoffice;
				//$state = $addressdata->state;
				$village = $addressdata->village;
				$grampanchayat = $addressdata->grampanchayat;
				$dmcid = $addressdata->selecteddmc;
				
				// Document Data Info
				$documentdata = $data->documentInfo;
				
				$aadharno = $documentdata->aadharno;
				$rationno = $documentdata->rationno;
				$voterid = $documentdata->voterid;
				
				// Referral & Others
				$referaldata = $data->refferalInfo;
				$referraldate = $referaldata->referraldate;
				$refferedbycord = $referaldata->refferedbycoordinator;
				
				$nqppid = $referaldata->refferedbynqpp;
				
				//$refferedbynqpp = $nqppdata->id;
				$pulmonary = $referaldata->pulmonarytype;
				$symptom = $referaldata->symptom;
				
				
				$referral_date = substr($referaldata->referraldate,0,10); // substr because time format is coming as ISO
			
				
				//$latest_serial = $this->getLatestSerialNumber("REG",$localsession->prj);
				
				$district_row = $this->location->getDistrict($district);
				$block_row = $this->location->getBlock($block);
				
				$patient_uniqID = NULL;
				if(sizeof($district_row)>0 && sizeof($block_row)>0){
					$district_code = $district_row->dist_code;
					$block_code = $block_row->block_code;
					
					//$patient_uniqID = "PTC/".$district_code."/".$block_code."/".$latest_serial;
				}
			
			$state_id = $this->location->getStateByDistrictID($district);
			
			
			
			$reg_data = [
				
				"patient_name" => trim(htmlspecialchars($name)),
				"patient_mobile_primary" => trim(htmlspecialchars($mobile)),
				"patient_age" => trim(htmlspecialchars($age)),
				"patient_full_address" => trim(htmlspecialchars($fulladdress)),
				"patient_village" => trim(htmlspecialchars($village)),
				"patient_gram_panchayat" => trim(htmlspecialchars($grampanchayat)),
				"patient_postoffice" => trim(htmlspecialchars($postoffice)),
				"patient_pin" => trim(htmlspecialchars($pincode)),
				"patient_state" =>  $state_id,
				"patient_country" => $this->location->getCountryIDByStateID($state_id),
				"patient_gurdian" => trim(htmlspecialchars($guardianname)),
				"patient_guardian_contact" => trim(htmlspecialchars($guardiancontact)),
				"patient_sex" => trim(htmlspecialchars($gender)),
				"patient_block" => $block,
				"patient_tuid" => $tuunitid,
				"patient_district" => $district,
				"patient_adhar" => trim(htmlspecialchars($aadharno)),
				"patient_voter" => trim(htmlspecialchars($voterid)),
				"patient_ration" => trim(htmlspecialchars($rationno)),
				"patient_referal_date" => date("Y-m-d",strtotime($referral_date)),
				"patient_pulmonary" => trim(htmlspecialchars($pulmonary)),
				"patient_symptom" => NULL,
				"nqpp_id" =>  $nqppid,
				"group_cord_id" =>  $refferedbycord,
				"dmc_id" => $dmcid
			//	"registered_by_user" => $localsession->uid
			];
			
			$this->db->where('patient.patient_id', $ptcid);
			$this->db->update('patient', $reg_data); 
			
			
			
			// INSERT INTO PATIENTsYMPTOM
			if(isset($symptom)){
				
				$this->db->where('patient_symptom_detail.patient_id', $ptcid);
				$this->db->delete('patient_symptom_detail');

				$this->insertIntoPTBSymptomDtl($ptcid,$symptom);
			}
			

			$user_activity = array(
					"activity_module" => 'PTB REG',
					"action" => "Update",
					"from_method" => "roleAPI/registerPTB/updatePTCData",
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
        } 
		catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
	}
	
	
	public function insertIntoPTBSymptomDtl($patientID,$symptom){
		$ins_ary = [];
		if(isset($symptom)){
			if(sizeof($symptom)>0){
				for($i=0;$i<sizeof($symptom);$i++){
					$ins_ary = [
						"patient_id" => $patientID,
						"symptom_id" => $symptom[$i]
					];
					$this->db->insert("patient_symptom_detail",$ins_ary);
				}
			}
		}
		
	}
	
	
	private function getMessageContentToSendSMS($module_type){
		$row = [];
		$where = [
			"sms_action_master.action_code" => $module_type,
		];
		$query = $this->db->select("*")
				->from("sms_action_master")
				->where($where)
				->get();
				
			if($query->num_rows()> 0)
			{
				 $row = $query->row();
				
			}
		return $row;
	}
	
	private function getRolesToSendSMS($module_type){
		$data = [];
		$where = [
			"sms_action_master.action_code" => $module_type,
		];
		$query = $this->db->select("*")
				->from("sms_action_rolewise_detail")
				->join("sms_action_master","sms_action_master.id = sms_action_rolewise_detail.sms_action_id","INNER")
				->join("role_master","role_master.id = sms_action_rolewise_detail.send_to_roleid","INNER")
				->where($where)
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
        if($digit==5){
            $serialno =$lastnumber;
        }
		elseif($digit==4){
              $serialno = "0".$lastnumber;
        }
		elseif($digit==3){
            $serialno = "00".$lastnumber;
        }
		elseif($digit==2){
            $serialno = "000".$lastnumber;
        }
		elseif($digit==1){
            $serialno = "0000".$lastnumber;
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
	
	public function getPtientList($localsession){
		if($localsession->rcode=="CORD"){
			$where = [
				"coordinator.userid" =>$localsession->uid
			];
			$query = $this->db->select("patient.*,dmc.name AS dmcname,nqpp.name as selectednqpp,coordinator.name as selectedcoordinatorname, DATE_FORMAT(patient.`patient_reg_date`,'%d/%m%/%Y') AS patient_reg_date,DATE_FORMAT(patient.`patient_referal_date`,'%Y-%m%-%d') AS ptc_referal_date,payment_gen_details.`payment_id` AS paymentgenID,payment_master.`id` AS paymentDoneID",FALSE)
					->from("patient")
					->join("coordinator","coordinator.id = patient.group_cord_id","INNER")
					->join("dmc","dmc.id = patient.dmc_id","INNER")
					->join("nqpp","nqpp.id = patient.nqpp_id","INNER")
					->join("payment_gen_details","payment_gen_details.patient_id = patient.patient_id","LEFT")
					->join("payment_gen_master","payment_gen_master.id = payment_gen_details.payment_id","LEFT")
					->join("payment_master","payment_master.payment_gen_id = payment_gen_master.id","LEFT")
					->where($where)
					->order_by("patient.patient_reg_date","DESC")->get();
		}
		
		elseif($localsession->rcode=="DISTCORD"){
			$where = [
				"district.userid" =>$localsession->uid
			];
			$query = $this->db->select("patient.*,dmc.name AS dmcname,nqpp.name as selectednqpp,coordinator.name as selectedcoordinatorname, DATE_FORMAT(patient.`patient_reg_date`,'%d/%m%/%Y') AS patient_reg_date,DATE_FORMAT(patient.`patient_referal_date`,'%Y-%m%-%d') AS ptc_referal_date,payment_gen_details.`payment_id` AS paymentgenID,payment_master.`id` AS paymentDoneID",FALSE)
					->from("patient")
					->join("coordinator","coordinator.id = patient.group_cord_id","INNER")
					->join("dmc","dmc.id = patient.dmc_id","INNER")
					->join("nqpp","nqpp.id = patient.nqpp_id","INNER")
					->join("block","block.id = coordinator.block_id","INNER")
					->join("district","district.id = block.district_id","INNER")
					->join("payment_gen_details","payment_gen_details.patient_id = patient.patient_id","LEFT")
					->join("payment_gen_master","payment_gen_master.id = payment_gen_details.payment_id","LEFT")
					->join("payment_master","payment_master.payment_gen_id = payment_gen_master.id","LEFT")
					->where($where)
					->order_by("patient.patient_reg_date","DESC")->get();
		
		}
		
		elseif($localsession->rcode=="NQPP"){
			$where = [
				"nqpp.userid" =>$localsession->uid
			];
			$query = $this->db->select("patient.*,dmc.name AS dmcname,nqpp.name as selectednqpp,coordinator.name as selectedcoordinatorname, DATE_FORMAT(patient.`patient_reg_date`,'%d/%m%/%Y') AS patient_reg_date,DATE_FORMAT(patient.`patient_referal_date`,'%Y-%m%-%d') AS ptc_referal_date,payment_gen_details.`payment_id` AS paymentgenID,payment_master.`id` AS paymentDoneID",FALSE)
					->from("patient")
					->join("coordinator","coordinator.id = patient.group_cord_id","INNER")
					->join("dmc","dmc.id = patient.dmc_id","INNER")
					->join("nqpp","nqpp.id = patient.nqpp_id","INNER")
					->join("payment_gen_details","payment_gen_details.patient_id = patient.patient_id","LEFT")
					->join("payment_gen_master","payment_gen_master.id = payment_gen_details.payment_id","LEFT")
					->join("payment_master","payment_master.payment_gen_id = payment_gen_master.id","LEFT")
					->where($where)
					->order_by("patient.patient_reg_date","DESC")->get();
		}
		elseif($localsession->rcode=="DMC"){
			$where = [
				"dmc.userid" =>$localsession->uid
			];
			$query = $this->db->select("patient.*,dmc.name AS dmcname,nqpp.name as selectednqpp,coordinator.name as selectedcoordinatorname, DATE_FORMAT(patient.`patient_reg_date`,'%d/%m%/%Y') AS patient_reg_date,DATE_FORMAT(patient.`patient_referal_date`,'%Y-%m%-%d') AS ptc_referal_date,payment_gen_details.`payment_id` AS paymentgenID,payment_master.`id` AS paymentDoneID",FALSE)
					->from("patient")
					->join("coordinator","coordinator.id = patient.group_cord_id","INNER")
					->join("dmc","dmc.id = patient.dmc_id","INNER")
					->join("nqpp","nqpp.id = patient.nqpp_id","INNER")
					->join("payment_gen_details","payment_gen_details.patient_id = patient.patient_id","LEFT")
					->join("payment_gen_master","payment_gen_master.id = payment_gen_details.payment_id","LEFT")
					->join("payment_master","payment_master.payment_gen_id = payment_gen_master.id","LEFT")
					->where($where)
					->order_by("patient.patient_reg_date","DESC")->get();
		}
		elseif($localsession->rcode=="XRAY"){
			$where = [
				"xray_center.userid" =>$localsession->uid
			];
			$query = $this->db->select("patient.*,dmc.name AS dmcname,nqpp.name as selectednqpp,coordinator.name as selectedcoordinatorname, DATE_FORMAT(patient.`patient_reg_date`,'%d/%m%/%Y') AS patient_reg_date,DATE_FORMAT(patient.`patient_referal_date`,'%Y-%m%-%d') AS ptc_referal_date,payment_gen_details.`payment_id` AS paymentgenID,payment_master.`id` AS paymentDoneID",FALSE)
					->from("patient")
					->join("coordinator","coordinator.id = patient.group_cord_id","INNER")
					->join("dmc","dmc.id = patient.dmc_id","INNER")
					->join("nqpp","nqpp.id = patient.nqpp_id","INNER")
					->join("xray_center","xray_center.id = patient.xray_cntr_id","INNER")
					->join("payment_gen_details","payment_gen_details.patient_id = patient.patient_id","LEFT")
					->join("payment_gen_master","payment_gen_master.id = payment_gen_details.payment_id","LEFT")
					->join("payment_master","payment_master.payment_gen_id = payment_gen_master.id","LEFT")
					->where($where)
					->order_by("patient.patient_reg_date","DESC")->get();
		}
		elseif($localsession->rcode=="CBNAAT"){
			$where = [
				"cbnaat.userid" =>$localsession->uid
			];
			$query = $this->db->select("patient.*,dmc.name AS dmcname,nqpp.name as selectednqpp,coordinator.name as selectedcoordinatorname, DATE_FORMAT(patient.`patient_reg_date`,'%d/%m%/%Y') AS patient_reg_date,DATE_FORMAT(patient.`patient_referal_date`,'%Y-%m%-%d') AS ptc_referal_date,payment_gen_details.`payment_id` AS paymentgenID,payment_master.`id` AS paymentDoneID",FALSE)
					->from("patient")
					->join("coordinator","coordinator.id = patient.group_cord_id","INNER")
					->join("dmc","dmc.id = patient.dmc_id","INNER")
					->join("nqpp","nqpp.id = patient.nqpp_id","INNER")
					->join("cbnaat","cbnaat.id = patient.cbnaat_id","INNER")
					->join("payment_gen_details","payment_gen_details.patient_id = patient.patient_id","LEFT")
					->join("payment_gen_master","payment_gen_master.id = payment_gen_details.payment_id","LEFT")
					->join("payment_master","payment_master.payment_gen_id = payment_gen_master.id","LEFT")
					->where($where)
					->order_by("patient.patient_reg_date","DESC")->get();
		}
		else{
			// Role = Project Manager
			$query = $this->db->select("patient.*,dmc.name AS dmcname,nqpp.name as selectednqpp,coordinator.name as selectedcoordinatorname, DATE_FORMAT(patient.`patient_reg_date`,'%d/%m%/%Y') AS patient_reg_date,DATE_FORMAT(patient.`patient_referal_date`,'%Y-%m%-%d') AS ptc_referal_date,payment_gen_details.`payment_id` AS paymentgenID,payment_master.`id` AS paymentDoneID",FALSE)
					->from("patient")
					->join("coordinator","coordinator.id = patient.group_cord_id","INNER")
					->join("dmc","dmc.id = patient.dmc_id","INNER")
					->join("nqpp","nqpp.id = patient.nqpp_id","INNER")
					->join("payment_gen_details","payment_gen_details.patient_id = patient.patient_id","LEFT")
					->join("payment_gen_master","payment_gen_master.id = payment_gen_details.payment_id","LEFT")
					->join("payment_master","payment_master.payment_gen_id = payment_gen_master.id","LEFT")
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
	
	public function getPatientSymptomByPtc($ptcid){
		$data = [];
		$where = [
			"patient_symptom_detail.patient_id" => $ptcid
		];
			$query = $this->db->select("*")
					->from("patient_symptom_detail")
					->where($where)
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
	
	
	
	public function getStatusWisePTB($status,$localsession){
		
		$data = [];
		if($status=="NEW"){
			
				$newRegisterWhere = [
					"dmc_sputum_done" => "N",
					"xray_is_done" => "N",
					"is_cbnaat_done" => "N",
					"is_ptb_trtmnt_done" => "N",
					"is_tb_diagnosed" => NULL
				
				];
			
				if($localsession->rcode=="CORD"){
					$where = [
						"coordinator.userid" =>$localsession->uid
					];
					$query = $this->db->select("patient.*,dmc.name AS dmcname,nqpp.name as selectednqpp,coordinator.name as selectedcoordinatorname, DATE_FORMAT(patient.`patient_reg_date`,'%d/%m%/%Y') AS patient_reg_date",FALSE)
							->from("patient")
							->join("coordinator","coordinator.id = patient.group_cord_id","INNER")
							->join("dmc","dmc.id = patient.dmc_id","INNER")
							->join("nqpp","nqpp.id = patient.nqpp_id","INNER")
							->where($where)
							->where($newRegisterWhere)
							->order_by("patient.patient_reg_date","DESC")->get();
				}
				elseif($localsession->rcode=="DISTCORD"){
					$where = [
						"district.userid" =>$localsession->uid
					];
					$query = $this->db->select("patient.*,dmc.name AS dmcname,nqpp.name as selectednqpp,coordinator.name as selectedcoordinatorname, DATE_FORMAT(patient.`patient_reg_date`,'%d/%m%/%Y') AS patient_reg_date",FALSE)
							->from("patient")
							->join("coordinator","coordinator.id = patient.group_cord_id","INNER")
							->join("dmc","dmc.id = patient.dmc_id","INNER")
							->join("nqpp","nqpp.id = patient.nqpp_id","INNER")
							->join("block","block.id = coordinator.block_id","INNER")
							->join("district","district.id = block.district_id","INNER")
							->where($where)
							->where($newRegisterWhere)
							->order_by("patient.patient_reg_date","DESC")->get();
							
				}
				elseif($localsession->rcode=="NQPP"){
					$where = [
						"nqpp.userid" =>$localsession->uid
					];
					$query = $this->db->select("patient.*,dmc.name AS dmcname,nqpp.name as selectednqpp,coordinator.name as selectedcoordinatorname, DATE_FORMAT(patient.`patient_reg_date`,'%d/%m%/%Y') AS patient_reg_date",FALSE)
							->from("patient")
							->join("coordinator","coordinator.id = patient.group_cord_id","INNER")
							->join("dmc","dmc.id = patient.dmc_id","INNER")
							->join("nqpp","nqpp.id = patient.nqpp_id","INNER")
							->where($where)
							->where($newRegisterWhere)
							->order_by("patient.patient_reg_date","DESC")->get();
				}
				elseif($localsession->rcode=="DMC"){
					$where = [
						"dmc.userid" =>$localsession->uid
					];
					$query = $this->db->select("patient.*,dmc.name AS dmcname,nqpp.name as selectednqpp,coordinator.name as selectedcoordinatorname, DATE_FORMAT(patient.`patient_reg_date`,'%d/%m%/%Y') AS patient_reg_date",FALSE)
							->from("patient")
							->join("coordinator","coordinator.id = patient.group_cord_id","INNER")
							->join("dmc","dmc.id = patient.dmc_id","INNER")
							->join("nqpp","nqpp.id = patient.nqpp_id","INNER")
							->where($where)
							->where($newRegisterWhere)
							->order_by("patient.patient_reg_date","DESC")->get();
				}
				elseif($localsession->rcode=="XRAY"){
					$where = [
						"xray_center.userid" =>$localsession->uid
					];
					$query = $this->db->select("patient.*,dmc.name AS dmcname,nqpp.name as selectednqpp,coordinator.name as selectedcoordinatorname, DATE_FORMAT(patient.`patient_reg_date`,'%d/%m%/%Y') AS patient_reg_date",FALSE)
							->from("patient")
							->join("coordinator","coordinator.id = patient.group_cord_id","INNER")
							->join("dmc","dmc.id = patient.dmc_id","INNER")
							->join("nqpp","nqpp.id = patient.nqpp_id","INNER")
							->join("xray_center","xray_center.id = patient.xray_cntr_id","INNER")
							->where($where)
							->where($newRegisterWhere)
							->order_by("patient.patient_reg_date","DESC")->get();
				}
				elseif($localsession->rcode=="CBNAAT"){
					$where = [
						"cbnaat.userid" =>$localsession->uid
					];
					$query = $this->db->select("patient.*,dmc.name AS dmcname,nqpp.name as selectednqpp,coordinator.name as selectedcoordinatorname, DATE_FORMAT(patient.`patient_reg_date`,'%d/%m%/%Y') AS patient_reg_date",FALSE)
							->from("patient")
							->join("coordinator","coordinator.id = patient.group_cord_id","INNER")
							->join("dmc","dmc.id = patient.dmc_id","INNER")
							->join("nqpp","nqpp.id = patient.nqpp_id","INNER")
							->join("cbnaat","cbnaat.id = patient.cbnaat_id","INNER")
							->where($where)
							->where($newRegisterWhere)
							->order_by("patient.patient_reg_date","DESC")->get();
				}
				else{
					// Role = Project Manager
					$query = $this->db->select("patient.*,dmc.name AS dmcname,nqpp.name as selectednqpp,coordinator.name as selectedcoordinatorname, DATE_FORMAT(patient.`patient_reg_date`,'%d/%m%/%Y') AS patient_reg_date",FALSE)
							->from("patient")
							->join("coordinator","coordinator.id = patient.group_cord_id","INNER")
							->join("dmc","dmc.id = patient.dmc_id","INNER")
							->join("nqpp","nqpp.id = patient.nqpp_id","INNER")
							->where($newRegisterWhere)
							->order_by("patient.patient_reg_date","DESC")->get();
				}
		}
		
		

		
		// Detected
		
		if($status=="DETECTED"){
			
			/*
			$whereDetected = "(patient.dmc_sputum_done='Y' AND patient.dmc_spt_is_positive='Y') 
								OR (patient.xray_is_done='Y' AND patient.xray_is_postive='Y') 
								OR (patient.`is_cbnaat_done`='Y' AND patient.`cbnaat_pstv`='Y') AND is_ptb_trtmnt_done='N'";
			*/					
			
			$whereDetected = [
				"patient.is_tb_diagnosed" => "Y",
				"patient.is_ptb_trtmnt_done" => "N"
			];
		
				if($localsession->rcode=="CORD"){
					$where = [
						"coordinator.userid" =>$localsession->uid
					];
					$query = $this->db->select("patient.*,dmc.name AS dmcname,nqpp.name as selectednqpp,coordinator.name as selectedcoordinatorname, DATE_FORMAT(patient.`patient_reg_date`,'%d/%m%/%Y') AS patient_reg_date",FALSE)
							->from("patient")
							->join("coordinator","coordinator.id = patient.group_cord_id","INNER")
							->join("dmc","dmc.id = patient.dmc_id","INNER")
							->join("nqpp","nqpp.id = patient.nqpp_id","INNER")
							->where($where)
							->where($whereDetected)
							->order_by("patient.patient_reg_date","DESC")->get();
				}
				elseif($localsession->rcode=="DISTCORD"){
					$where = [
						"district.userid" =>$localsession->uid
					];
					$query = $this->db->select("patient.*,dmc.name AS dmcname,nqpp.name as selectednqpp,coordinator.name as selectedcoordinatorname, DATE_FORMAT(patient.`patient_reg_date`,'%d/%m%/%Y') AS patient_reg_date",FALSE)
							->from("patient")
							->join("coordinator","coordinator.id = patient.group_cord_id","INNER")
							->join("dmc","dmc.id = patient.dmc_id","INNER")
							->join("nqpp","nqpp.id = patient.nqpp_id","INNER")
							->join("block","block.id = coordinator.block_id","INNER")
							->join("district","district.id = block.district_id","INNER")
							->where($where)
							->where($whereDetected)
							->order_by("patient.patient_reg_date","DESC")->get();
				}
				elseif($localsession->rcode=="NQPP"){
					$where = [
						"nqpp.userid" =>$localsession->uid
					];
					$query = $this->db->select("patient.*,dmc.name AS dmcname,nqpp.name as selectednqpp,coordinator.name as selectedcoordinatorname, DATE_FORMAT(patient.`patient_reg_date`,'%d/%m%/%Y') AS patient_reg_date",FALSE)
							->from("patient")
							->join("coordinator","coordinator.id = patient.group_cord_id","INNER")
							->join("dmc","dmc.id = patient.dmc_id","INNER")
							->join("nqpp","nqpp.id = patient.nqpp_id","INNER")
							->where($where)
							->where($whereDetected)
							->order_by("patient.patient_reg_date","DESC")->get();
				}
				elseif($localsession->rcode=="DMC"){
					$where = [
						"dmc.userid" =>$localsession->uid
					];
					$query = $this->db->select("patient.*,dmc.name AS dmcname,nqpp.name as selectednqpp,coordinator.name as selectedcoordinatorname, DATE_FORMAT(patient.`patient_reg_date`,'%d/%m%/%Y') AS patient_reg_date",FALSE)
							->from("patient")
							->join("coordinator","coordinator.id = patient.group_cord_id","INNER")
							->join("dmc","dmc.id = patient.dmc_id","INNER")
							->join("nqpp","nqpp.id = patient.nqpp_id","INNER")
							->where($where)
							->where($whereDetected)
							->order_by("patient.patient_reg_date","DESC")->get();
				}
				elseif($localsession->rcode=="XRAY"){
					$where = [
						"xray_center.userid" =>$localsession->uid
					];
					$query = $this->db->select("patient.*,dmc.name AS dmcname,nqpp.name as selectednqpp,coordinator.name as selectedcoordinatorname, DATE_FORMAT(patient.`patient_reg_date`,'%d/%m%/%Y') AS patient_reg_date",FALSE)
							->from("patient")
							->join("coordinator","coordinator.id = patient.group_cord_id","INNER")
							->join("dmc","dmc.id = patient.dmc_id","INNER")
							->join("nqpp","nqpp.id = patient.nqpp_id","INNER")
							->join("xray_center","xray_center.id = patient.xray_cntr_id","INNER")
							->where($where)
							->where($whereDetected)
							->order_by("patient.patient_reg_date","DESC")->get();
				}
				elseif($localsession->rcode=="CBNAAT"){
					$where = [
						"cbnaat.userid" =>$localsession->uid
					];
					$query = $this->db->select("patient.*,dmc.name AS dmcname,nqpp.name as selectednqpp,coordinator.name as selectedcoordinatorname, DATE_FORMAT(patient.`patient_reg_date`,'%d/%m%/%Y') AS patient_reg_date",FALSE)
							->from("patient")
							->join("coordinator","coordinator.id = patient.group_cord_id","INNER")
							->join("dmc","dmc.id = patient.dmc_id","INNER")
							->join("nqpp","nqpp.id = patient.nqpp_id","INNER")
							->join("cbnaat","cbnaat.id = patient.cbnaat_id","INNER")
							->where($where)
							->where($whereDetected)
							->order_by("patient.patient_reg_date","DESC")->get();
				}
				else{
					// Role = Project Manager
					$query = $this->db->select("patient.*,dmc.name AS dmcname,nqpp.name as selectednqpp,coordinator.name as selectedcoordinatorname, DATE_FORMAT(patient.`patient_reg_date`,'%d/%m%/%Y') AS patient_reg_date",FALSE)
							->from("patient")
							->join("coordinator","coordinator.id = patient.group_cord_id","INNER")
							->join("dmc","dmc.id = patient.dmc_id","INNER")
							->join("nqpp","nqpp.id = patient.nqpp_id","INNER")
							->where($whereDetected)
							->order_by("patient.patient_reg_date","DESC")->get();
				}
		}
		
		if($status=="TREATMENT"){
			
			/*
			$whereTreatment = "(patient.dmc_sputum_done='Y' AND patient.dmc_spt_is_positive='Y') 
								OR (patient.xray_is_done='Y' AND patient.xray_is_postive='Y') 
								OR (patient.`is_cbnaat_done`='Y' AND patient.`cbnaat_pstv`='Y') AND is_ptb_trtmnt_done='Y'";
			*/
			
				$whereTreatment = [
					"patient.is_tb_diagnosed" => "Y",
					"patient.is_ptb_trtmnt_done" => "Y"
				];
		
		
				if($localsession->rcode=="CORD"){
					$where = [
						"coordinator.userid" =>$localsession->uid
					];
					$query = $this->db->select("patient.*,dmc.name AS dmcname,nqpp.name as selectednqpp,coordinator.name as selectedcoordinatorname, DATE_FORMAT(patient.`patient_reg_date`,'%d/%m%/%Y') AS patient_reg_date",FALSE)
							->from("patient")
							->join("coordinator","coordinator.id = patient.group_cord_id","INNER")
							->join("dmc","dmc.id = patient.dmc_id","INNER")
							->join("nqpp","nqpp.id = patient.nqpp_id","INNER")
							->where($where)
							->where($whereTreatment)
							->order_by("patient.patient_reg_date","DESC")->get();
				}
				
				
							
				if($localsession->rcode=="DISTCORD"){
					$where = [
						"district.userid" =>$localsession->uid
					];
					$query = $this->db->select("patient.*,dmc.name AS dmcname,nqpp.name as selectednqpp,coordinator.name as selectedcoordinatorname, DATE_FORMAT(patient.`patient_reg_date`,'%d/%m%/%Y') AS patient_reg_date",FALSE)
							->from("patient")
							->join("coordinator","coordinator.id = patient.group_cord_id","INNER")
							->join("dmc","dmc.id = patient.dmc_id","INNER")
							->join("nqpp","nqpp.id = patient.nqpp_id","INNER")
							->join("block","block.id = coordinator.block_id","INNER")
							->join("district","district.id = block.district_id","INNER")
							->where($where)
							->where($whereTreatment)
							->order_by("patient.patient_reg_date","DESC")->get();
				}
				
				elseif($localsession->rcode=="NQPP"){
					$where = [
						"nqpp.userid" =>$localsession->uid
					];
					$query = $this->db->select("patient.*,dmc.name AS dmcname,nqpp.name as selectednqpp,coordinator.name as selectedcoordinatorname, DATE_FORMAT(patient.`patient_reg_date`,'%d/%m%/%Y') AS patient_reg_date",FALSE)
							->from("patient")
							->join("coordinator","coordinator.id = patient.group_cord_id","INNER")
							->join("dmc","dmc.id = patient.dmc_id","INNER")
							->join("nqpp","nqpp.id = patient.nqpp_id","INNER")
							->where($where)
							->where($whereTreatment)
							->order_by("patient.patient_reg_date","DESC")->get();
				}
				elseif($localsession->rcode=="DMC"){
					$where = [
						"dmc.userid" =>$localsession->uid
					];
					$query = $this->db->select("patient.*,dmc.name AS dmcname,nqpp.name as selectednqpp,coordinator.name as selectedcoordinatorname, DATE_FORMAT(patient.`patient_reg_date`,'%d/%m%/%Y') AS patient_reg_date",FALSE)
							->from("patient")
							->join("coordinator","coordinator.id = patient.group_cord_id","INNER")
							->join("dmc","dmc.id = patient.dmc_id","INNER")
							->join("nqpp","nqpp.id = patient.nqpp_id","INNER")
							->where($where)
							->where($whereTreatment)
							->order_by("patient.patient_reg_date","DESC")->get();
				}
				elseif($localsession->rcode=="XRAY"){
					$where = [
						"xray_center.userid" =>$localsession->uid
					];
					$query = $this->db->select("patient.*,dmc.name AS dmcname,nqpp.name as selectednqpp,coordinator.name as selectedcoordinatorname, DATE_FORMAT(patient.`patient_reg_date`,'%d/%m%/%Y') AS patient_reg_date",FALSE)
							->from("patient")
							->join("coordinator","coordinator.id = patient.group_cord_id","INNER")
							->join("dmc","dmc.id = patient.dmc_id","INNER")
							->join("nqpp","nqpp.id = patient.nqpp_id","INNER")
							->join("xray_center","xray_center.id = patient.xray_cntr_id","INNER")
							->where($where)
							->where($whereTreatment)
							->order_by("patient.patient_reg_date","DESC")->get();
				}
				elseif($localsession->rcode=="CBNAAT"){
					$where = [
						"cbnaat.userid" =>$localsession->uid
					];
					$query = $this->db->select("patient.*,dmc.name AS dmcname,nqpp.name as selectednqpp,coordinator.name as selectedcoordinatorname, DATE_FORMAT(patient.`patient_reg_date`,'%d/%m%/%Y') AS patient_reg_date",FALSE)
							->from("patient")
							->join("coordinator","coordinator.id = patient.group_cord_id","INNER")
							->join("dmc","dmc.id = patient.dmc_id","INNER")
							->join("nqpp","nqpp.id = patient.nqpp_id","INNER")
							->join("cbnaat","cbnaat.id = patient.cbnaat_id","INNER")
							->where($where)
							->where($whereTreatment)
							->order_by("patient.patient_reg_date","DESC")->get();
				}
				else{
					// Role = Project Manager
					$query = $this->db->select("patient.*,dmc.name AS dmcname,nqpp.name as selectednqpp,coordinator.name as selectedcoordinatorname, DATE_FORMAT(patient.`patient_reg_date`,'%d/%m%/%Y') AS patient_reg_date",FALSE)
							->from("patient")
							->join("coordinator","coordinator.id = patient.group_cord_id","INNER")
							->join("dmc","dmc.id = patient.dmc_id","INNER")
							->join("nqpp","nqpp.id = patient.nqpp_id","INNER")
							->where($whereTreatment)
							->order_by("patient.patient_reg_date","DESC")->get();
				}
			
		}
		
		
		
		
		
		
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
		 $query = $this->db->select("   patient.patient_id as ptcid,
                                                patient.*,ptb_treatment_detail.*,nqpp.name as selectednqpp,coordinator.name as selectedcoordinatorname,
						 DATE_FORMAT(patient.`dmc_sputum_test_date`,'%d %M% %Y') AS sputumTestDate,
						 DATE_FORMAT(patient.`dmc_sputum_date`,'%d %M% %Y') AS sputumColDate,
						 DATE_FORMAT(patient.`xray_date`,'%d %M% %Y') AS xrayDate,
						 DATE_FORMAT(patient.`cbnaat_test_date`,'%d %M% %Y') AS cbnaatTestDt,
						 DATE_FORMAT(patient.`cbnaat_date`,'%d %M% %Y') AS cbnaatColDt,
						 DATE_FORMAT(ptb_treatment_detail.`first_followup_dt`,'%d/%m%/%Y') AS first_followup_dt,
						 IFNULL (DATE_FORMAT(ptb_treatment_detail.first_followup_taken_on,'%d/%m%/%Y'),NULL) AS firstfollowuptaken,
					
					DATE_FORMAT(ptb_treatment_detail.`second_followup_dt`, '%d/%m%/%Y') AS second_followup_dt,
					IFNULL (DATE_FORMAT(ptb_treatment_detail.second_followup_taken_on,'%d/%m%/%Y'),NULL) AS secondfollowuptaken,payment_gen_details.id AS ptb_payment_gen_dtl_id,
					xray_center.name as xraycenter,
					cbnaat.name as cbnaatname,
					treatment_category.category_name,
					outcome_master.name as outcomename
						",FALSE)
					->from("patient")
					->join("ptb_treatment_detail","ptb_treatment_detail.patient_id = patient.patient_id","LEFT")
					->join("nqpp","nqpp.id = patient.nqpp_id","INNER")
					->join("coordinator","coordinator.id = patient.group_cord_id","INNER")
					->join("xray_center","xray_center.id=patient.xray_cntr_id","LEFT")
					->join("cbnaat","cbnaat.id=patient.cbnaat_id","LEFT")
					->join("treatment_category","treatment_category.id = ptb_treatment_detail.category_id","LEFT")
					->join("outcome_master","outcome_master.id = ptb_treatment_detail.outcome","LEFT")
					->join("payment_gen_details","payment_gen_details.patient_id = patient.patient_id","LEFT")
					->where($where)
					->get();
		//echo "Q ".$this->db->last_query();
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
					"dmc_sputum_test_date" => date("Y-m-d",strtotime($updateDatas->sputumTestDate)),
					"dmc_sputum_date" => date("Y-m-d",strtotime($updateDatas->sputumColDate))
					//"dmc_id" => $updateDatas->sputumDmc
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
					"cbnaat_test_date" => date("Y-m-d",strtotime($updateDatas->cbnaatTestdate)),
					"cbnaat_date" => date("Y-m-d",strtotime($updateDatas->cbnaatColdate)),
					"cbnaat_id" => $updateDatas->cbnaatCenterName
				];
				
				$this->db->where('patient.patient_id', $patientid);
				$this->db->update('patient', $upd_data); 
			}
			if($updFrom=="CBNAAT_RESULT"){
				if($updateDatas->cbnaatResultFeed=="Y"){
					$upd_data = [
					"cbnaat_result_done" => "Y",
					"cbnaat_pstv" => $updateDatas->cbnaatResultFeed,
					"rif_value" => $updateDatas->selectedRIF
					];
				}
				else{
					$upd_data = [
					"cbnaat_result_done" => "Y",
					"cbnaat_pstv" => $updateDatas->cbnaatResultFeed,
					"rif_value" => NULL
					];
				}
				
				
				
				$this->db->where('patient.patient_id', $patientid);
				$this->db->update('patient', $upd_data); 
			}
			if($updFrom=="TB_DIAGNOSED"){
				$upd_data = [
					"is_tb_diagnosed" => $updateDatas->tbDiagnosedFeed
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
				
				// delete before insert
				$this->db->where('ptb_treatment_detail.patient_id', $patientid);
				$this->db->delete('ptb_treatment_detail');
				
				// insert category detail
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
	
	
	public function updatePTBFollowUP($ptbdata,$patientid,$localsession){
		try {
            $this->db->trans_begin();
			
			$upd_data = [];
			if($ptbdata->followuptype == "FIRST"){
				$upd_data = [
					"first_followup_taken_on" => date("Y-m-d",strtotime($ptbdata->firstfollowupdoneDt)),
					"first_follow_up_feed" => $ptbdata->firstfollowupFeed
				];
			
				$this->db->where('ptb_treatment_detail.patient_id', $patientid);
				$this->db->update('ptb_treatment_detail', $upd_data); 
			}
			
			
			if($ptbdata->followuptype == "SECOND"){
				$upd_data = [
					"second_followup_taken_on" => date("Y-m-d",strtotime($ptbdata->secondfollowupdoneDt)),
					"second_followup_feed" => $ptbdata->secondfollowupFeed
				];
			
				$this->db->where('ptb_treatment_detail.patient_id', $patientid);
				$this->db->update('ptb_treatment_detail', $upd_data); 
			}
			
			
			
				$user_activity = array(
					"module_master_id" => $patientid,
					"activity_module" => "PATIENT '".$ptbdata->followuptype."' FOLLOWUP",
					"action" => "Update",
					"from_method" => "roleAPI/updatePTBFollowUP/updatePTBFollowUP",
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
	
	
	public function removePTBStatus($patientdata,$localsession){
		try {
            $this->db->trans_begin();
			
			$patientid = $patientdata->pid;
			$updFrom = $patientdata->removefrom;
			$upd_data = [];
			
			if($updFrom=="SPUTUM"){
				$upd_data = [
					"dmc_sputum_done" => "N",
					"dmc_sputum_test_date" => NULL,
					"dmc_sputum_date" => NULL
				];
			
				$this->db->where('patient.patient_id', $patientid);
				$this->db->update('patient', $upd_data); 
			}
			if($updFrom=="SPUTUM_RESULT"){
				$upd_data = [
					"dmc_result_done" => "N",
					"dmc_spt_is_positive" => NULL
				];
				
				$this->db->where('patient.patient_id', $patientid);
				$this->db->update('patient', $upd_data); 
			}
			if($updFrom=="XRAY"){
				$upd_data = [
					"xray_is_done" => "N",
					"xray_date" => NULL,
					"xray_cntr_id" => NULL
				];
				
				$this->db->where('patient.patient_id', $patientid);
				$this->db->update('patient', $upd_data); 
			}
			if($updFrom=="XRAY_RESULT"){
				$upd_data = [
					"xray_result_done" => "N",
					"xray_is_postive" => NULL
				];
				
				$this->db->where('patient.patient_id', $patientid);
				$this->db->update('patient', $upd_data); 
			}
			if($updFrom=="CBNAAT"){
				$upd_data = [
					"is_cbnaat_done" => "N",
					"cbnaat_test_date" => NULL,
					"cbnaat_date" => NULL,
					"cbnaat_id" => NULL
				];
				
				$this->db->where('patient.patient_id', $patientid);
				$this->db->update('patient', $upd_data); 
			}
			if($updFrom=="CBNAAT_RESULT"){
				$upd_data = [
					"cbnaat_result_done" => "N",
					"cbnaat_pstv" => NULL,
					"rif_value" => NULL
				];
				
				$this->db->where('patient.patient_id', $patientid);
				$this->db->update('patient', $upd_data); 
			}
			if($updFrom=="TB_DIAGNOSED"){
				$upd_data = [
					"is_tb_diagnosed" => NULL
				];
				
				$this->db->where('patient.patient_id', $patientid);
				$this->db->update('patient', $upd_data); 
			}
			if($updFrom=="OUTCOME"){
				$upd_data = [
					"outcome" => NULL
				];
				
				$this->db->where('ptb_treatment_detail.patient_id', $patientid);
				$this->db->update('ptb_treatment_detail', $upd_data); 
			}

				$user_activity = array(
					"module_master_id" => $patientid,
					"activity_module" => "PATIENT ".$updFrom,
					"action" => "DELETE",
					"from_method" => "roleAPI/removePTBStatus/removePTBStatus",
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
	
	
	public function clearTreatmentCategory($patientid,$localsession){
		try {
            $this->db->trans_begin();
			
				$upd_data = [];
				$upd_data['is_ptb_trtmnt_done'] = "N";
				$upd_data['trtmnt_start_date'] = NULL;
				$upd_data['trtmnt_end_date'] = NULL;
				$upd_data['trtmnt_duration'] = NULL;
			
				$this->db->where('patient.patient_id', $patientid);
				$this->db->update('patient', $upd_data); 
				
			
				$this->db->where('ptb_treatment_detail.patient_id', $patientid);
				$this->db->delete('ptb_treatment_detail'); 
				
				
				$user_activity = array(
					"module_master_id" => $patientid,
					"activity_module" => "TREATMENT",
					"action" => "Delete",
					"from_method" => "roleAPI/clearTreatmentCategory/clearTreatmentCategory",
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
	
	public function getTotalIncomeByRole($localsession){
		$totalIncome = 0;
		$userid = $localsession->uid;
		$rcode = $localsession->rcode;
		if($rcode == "NQPP"){
				
				$where = [
					"nqpp.userid" => $userid,
					"payment_gen_master.is_payment_done" => 'Y'
				];
		
			$query = $this->db->select("SUM(`payment_master`.`amount`) AS totalIncome")
					->from("payment_master")
					->join('payment_gen_master','payment_gen_master.id = payment_master.payment_gen_id','INNER')
					->join('nqpp','nqpp.id = payment_gen_master.nqpp_id','INNER')
					->where($where)
				
					->get();
				
				if($query->num_rows()>0){
					$row = $query->row();
					$totalIncome = $row->totalIncome;
					}
				}
			return $totalIncome;
	}
	
	
	public function getGeneratedReferralAmount($localsession){
		$data = [];
			$userid = $localsession->uid;
			$rcode = $localsession->rcode;
			if($rcode == "NQPP"){
				$sql = "SELECT 
					payment_gen_master.`id` AS paygenerated_id,
					DATE_FORMAT(payment_gen_master.`generation_dt`,'%m') AS formonth,
					DATE_FORMAT(payment_gen_master.`generation_dt`,'%Y') AS foryear,
					DATE_FORMAT(payment_gen_master.`generation_dt`,'%M %Y') AS generatedMonthYr,
					SUM(payment_gen_master.`payable_amt`) AS generatedAmt
					FROM `payment_gen_master`
					INNER JOIN `nqpp`
					ON nqpp.`id` = payment_gen_master.`nqpp_id`
					WHERE nqpp.`userid` = ".$userid."
					AND payment_gen_master.`is_payment_done` = 'N'
					GROUP BY  DATE_FORMAT(payment_gen_master.`generation_dt`,'%M %Y')
					ORDER BY `payment_gen_master`.`generation_dt` DESC";
			
				$query = $this->db->query($sql);
				if($query->num_rows()>0){
					foreach($query->result() as $rows)
					{
						$data[] = [
							//"payment_generated_id" => $rows->paygenerated_id,
							"generated_amt" => $rows->generatedAmt,
							"generated_month_year" => $rows->generatedMonthYr,
							"month" =>  $rows->formonth,
							"foryear" =>  $rows->foryear
						];
					}
				}
				
			}
		
		return $data;
	
	}
	
	public function getPaidReferralAmount($localsession){
		$data = [];
			$userid = $localsession->uid;
			$rcode = $localsession->rcode;
			if($rcode == "NQPP"){
				$sql = "SELECT 
					payment_master.`id` AS payment_id,
					DATE_FORMAT(payment_master.`payment_dt`,'%m') AS formonth,
					DATE_FORMAT(payment_master.`payment_dt`,'%Y') AS foryear,
					DATE_FORMAT(payment_master.`payment_dt`,'%M %Y') AS paidMonthYr,
					SUM(payment_master.amount) AS paidAmt
					FROM `payment_master`
					INNER JOIN `payment_gen_master`
					ON `payment_master`.`payment_gen_id` = payment_gen_master.`id`
					INNER JOIN `nqpp`
					ON nqpp.`id` = payment_gen_master.`nqpp_id`
					
					WHERE nqpp.`userid` = '".$userid."'
					AND payment_gen_master.`is_payment_done` = 'Y'
					GROUP BY  DATE_FORMAT(payment_master.`payment_dt`,'%M %Y')
					ORDER BY `payment_master`.`payment_dt` DESC";
			
				$query = $this->db->query($sql);
				if($query->num_rows()>0){
					foreach($query->result() as $rows)
					{
						$data[] = [
							//"payment_generated_id" => $rows->paygenerated_id,
							"paid_amt" => $rows->paidAmt,
							"paid_month_year" => $rows->paidMonthYr,
							"month" =>  $rows->formonth,
							"foryear" =>  $rows->foryear
						];
					}
				}
				
			}
		
		return $data;
	
	}
	
	public function getPendingReferralData($localsession){
		$data = [];
			$userid = $localsession->uid;
			$rcode = $localsession->rcode;
			if($rcode == "NQPP"){
				
				$where = [
					"nqpp.userid" => $userid,
					"patient.is_tb_diagnosed" => 'Y'
				];
		
			$query = $this->db->select("patient.`patient_id`,
						patient.`patient_name`,
						patient.`patient_mobile_primary`,
						patient.`patient_uniq_id`,
						DATE_FORMAT(patient.`patient_reg_date`,'%d/%m%/%Y') AS patient_reg_date,
						payment_gen_details.`patient_id`",FALSE)
					->from("patient")
					->join('nqpp','nqpp.id = patient.nqpp_id','INNER')
					->join('payment_gen_details','payment_gen_details.patient_id = patient.patient_id','LEFT')
					->where($where)
					->where('payment_gen_details.patient_id IS NULL')
					->get();
				
				

				if($query->num_rows()>0){
					foreach($query->result() as $rows)
					{
						$data[] = $rows;
					}
				}
				
			}
		
		return $data;
	
	}
	
	public function getPaymentRefDetailByType($type,$dtldata,$localsession){
		$data = [];
		
		$userid = $localsession->uid;
		$rcode = $localsession->rcode;
		$month = $dtldata->month;
		$foryear = $dtldata->foryear;
		$where = [];
		if($type=="GENERATED"){
				$sql = "SELECT 
						patient.`patient_id`,
						patient.`patient_name`,
						patient.`patient_mobile_primary`,
						patient.`patient_uniq_id`,
						DATE_FORMAT(patient.`patient_reg_date`,'%d/%m%/%Y') AS patient_reg_date,
						payment_gen_details.`amount`,
						DATE_FORMAT(payment_gen_master.`generation_dt`,'%d/%m%/%Y') AS pdate
						FROM `payment_gen_master`
						INNER JOIN `nqpp`
						ON nqpp.`id` = payment_gen_master.`nqpp_id`
						INNER JOIN `payment_gen_details`
						ON `payment_gen_details`.`payment_id`= payment_gen_master.`id`
						INNER JOIN `patient`
						ON patient.`patient_id` = `payment_gen_details`.`patient_id`
						WHERE nqpp.`userid` = ".$userid."
						AND DATE_FORMAT(payment_gen_master.`generation_dt`,'%m')='".$month."' 
						AND DATE_FORMAT(payment_gen_master.`generation_dt`,'%Y')='".$foryear."' 
						AND payment_gen_master.`is_payment_done` = 'N'
						ORDER BY `payment_gen_master`.`generation_dt` DESC";
			
				$query = $this->db->query($sql);
				if($query->num_rows()>0){
					foreach($query->result() as $rows)
					{
						$data[] = $rows;
					}
				}
		}
		
		
		if($type=="PAID"){
				$sql = "SELECT 
						patient.`patient_id`,
						patient.`patient_name`,
						patient.`patient_mobile_primary`,
						patient.`patient_uniq_id`,
						DATE_FORMAT(patient.`patient_reg_date`,'%d/%m%/%Y') AS patient_reg_date,
						payment_gen_details.`amount`,
						DATE_FORMAT(payment_master.`payment_dt`,'%d/%m%/%Y') AS pdate
						FROM `payment_master`
						INNER JOIN `payment_gen_master`
						ON `payment_master`.`payment_gen_id` = payment_gen_master.`id`
						INNER JOIN `nqpp`
						ON nqpp.`id` = payment_gen_master.`nqpp_id`
						INNER JOIN `payment_gen_details`
						ON `payment_gen_details`.`payment_id`= payment_gen_master.`id`
						INNER JOIN `patient`
						ON patient.`patient_id` = `payment_gen_details`.`patient_id`
						WHERE nqpp.`userid` = '".$userid."'
						AND DATE_FORMAT(payment_master.`payment_dt`,'%m')='".$month."' 
						AND DATE_FORMAT(payment_master.`payment_dt`,'%Y')='".$foryear."' 
						AND payment_gen_master.`is_payment_done` = 'Y'
						ORDER BY `payment_master`.`payment_dt` DESC";
			
				$query = $this->db->query($sql);
				if($query->num_rows()>0){
					foreach($query->result() as $rows)
					{
						$data[] = $rows;
					}
				}
		}
		return $data;
	}
	
	public function getOutcomeByIDAndRole($outcomeid,$localsession){
		$data = [];
		$no = 0;
		$userid = $localsession->uid;
		$rcode = $localsession->rcode;
		
		if($rcode=="CORD"){
			$where_param = [
				"ptb_treatment_detail.outcome" => $outcomeid,
				"coordinator.userid" => $userid
				
			];
			$query = $this->db->select("COUNT(*) AS total")
							->from('ptb_treatment_detail')
							->join('patient','ptb_treatment_detail.patient_id = patient.patient_id','INNER')
							->join('coordinator','coordinator.id = patient.group_cord_id','INNER')
							->where($where_param)
							->order_by('patient.patient_name')
							->get();
		}
		
		elseif($rcode=="NQPP"){
			$where_param = [
				"ptb_treatment_detail.outcome" => $outcomeid,
				"nqpp.userid" => $userid
				
			];
			$query = $this->db->select("COUNT(*) AS total")
							->from('ptb_treatment_detail')
							->join('patient','ptb_treatment_detail.patient_id = patient.patient_id','INNER')
							->join('nqpp','nqpp.id = patient.nqpp_id','INNER')
							->where($where_param)
							->order_by('patient.patient_name')
							->get();
		}
		elseif($rcode=="DISTCORD"){
			$where_param = [
				"ptb_treatment_detail.outcome" => $outcomeid,
				"district.userid" => $userid
				
			];
			$query = $this->db->select("COUNT(*) AS total")
							->from('ptb_treatment_detail')
							->join('patient','ptb_treatment_detail.patient_id = patient.patient_id','INNER')
							->join('district','district.id = patient.patient_district','INNER')
							->where($where_param)
							->order_by('patient.patient_name')
							->get();
		}
		else{
			$where_param = [
				"ptb_treatment_detail.outcome" => $outcomeid
				
			];
			$query = $this->db->select("COUNT(*) AS total")
							->from('ptb_treatment_detail')
							->join('patient','ptb_treatment_detail.patient_id = patient.patient_id','INNER')
							->where($where_param)
							->order_by('patient.patient_name')
							->get();
		}
		
	
		
		if($query->num_rows()> 0)
		{
			$row = $query->row();
			$no = $row->total;
			
			
			
		}
		
		return $no;
		
		
		
	}
	
	public function getOutcomeListByIDAndRole($outcomeid,$localsession){
		$data = [];
		$no = 0;
		$userid = $localsession->uid;
		$rcode = $localsession->rcode;
		
		if($rcode=="CORD"){
			$where_param = [
				"ptb_treatment_detail.outcome" => $outcomeid,
				"coordinator.userid" => $userid
				
			];
			$query = $this->db->select("patient.*,DATE_FORMAT(patient.`patient_reg_date`,'%d/%m%/%Y') AS patient_reg_date",FALSE)
							->from('ptb_treatment_detail')
							->join('patient','ptb_treatment_detail.patient_id = patient.patient_id','INNER')
							->join('coordinator','coordinator.id = patient.group_cord_id','INNER')
							->where($where_param)
							->order_by('patient.patient_name')
							->get();
		}
		
		elseif($rcode=="NQPP"){
			$where_param = [
				"ptb_treatment_detail.outcome" => $outcomeid,
				"nqpp.userid" => $userid
				
			];
			$query = $this->db->select("patient.*,DATE_FORMAT(patient.`patient_reg_date`,'%d/%m%/%Y') AS patient_reg_date",FALSE)
							->from('ptb_treatment_detail')
							->join('patient','ptb_treatment_detail.patient_id = patient.patient_id','INNER')
							->join('nqpp','nqpp.id = patient.nqpp_id','INNER')
							->where($where_param)
							->order_by('patient.patient_name')
							->get();
		}
		elseif($rcode=="DISTCORD"){
			$where_param = [
				"ptb_treatment_detail.outcome" => $outcomeid,
				"district.userid" => $userid
				
			];
			$query = $this->db->select("patient.*,DATE_FORMAT(patient.`patient_reg_date`,'%d/%m%/%Y') AS patient_reg_date",FALSE)
							->from('ptb_treatment_detail')
							->join('patient','ptb_treatment_detail.patient_id = patient.patient_id','INNER')
							->join('district','district.id = patient.patient_district','INNER')
							->where($where_param)
							->order_by('patient.patient_name')
							->get();
		}
		else{
			$where_param = [
				"ptb_treatment_detail.outcome" => $outcomeid
				
			];
			$query = $this->db->select("patient.*,DATE_FORMAT(patient.`patient_reg_date`,'%d/%m%/%Y') AS patient_reg_date",FALSE)
							->from('ptb_treatment_detail')
							->join('patient','ptb_treatment_detail.patient_id = patient.patient_id','INNER')
							->where($where_param)
							->order_by('patient.patient_name')
							->get();
		}
		
	
		
		if($query->num_rows()> 0)
		{
			foreach($query->result() as $rows)
			{
				$data[] = $rows;
			}
			
		}
		
		return $data;
	}
	
	
	public function getOutComeListWithCount($sessdata){
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
				//$data[] = $rows;
				$data[] = [
					"listdata" => $rows,
					"total" => $this->getOutcomeByIDAndRole($rows->id,$sessdata)
				];
			}
	            
	    }
			
	    return $data;
	}

	
	
	public function getNewDateByNoOfDays($startdate,$days){
		$newDate = date('Y-m-d', strtotime($startdate. " + $days days"));
		return date("d/m/Y",strtotime($newDate));
	}
	
	
	public function checkIsPTBExist($datas){
		$isPTBexist = false;
		
		$whereSql = "patient.patient_mobile_primary =  '".$datas->mbl."' 
					AND LOWER(REPLACE(patient.patient_name, ' ','')) = '".strtolower(str_replace(' ','', $datas->name))."'";
		
		$query = $this->db->select("*")
					->from("patient")
					->where($whereSql)
					->get();
		//echo $this->db->last_query();	
		if($query->num_rows()>0){
			$isPTBexist = true;
		}
		return $isPTBexist;
		
	}
	
	private function sendSMS($phone,$sms_text){
		//$mantra_url = "http://myvaluefirst.com/smpp/sendsms?";
		$shis_url = "http://203.212.70.200/smpp/sendsms?";
		$message = $sms_text;
		$feed=$this->shisAppSend($phone,$message);
		return $feed;
	}
	
	private function shisAppSend($phone,$msg){
		$shis_user = "shisapi";
		$shis_password = "shisapi";
		$shis_url = "http://203.212.70.200/smpp/sendsms?";
		$shis_from = "SHISAP";
		$shis_udh = 0;
		
		/*$mantra_user = "shisapi";
		$mantra_password = "shisapi";
		$mantra_url = "http://203.212.70.200/smpp/sendsms?";
		$mantra_from = "SHISAP";
		$mantra_udh = 0;*/

      $url = 'username='.$shis_user;
      $url.= '&password='.$shis_password;
      $url.= '&to='.urlencode($phone);
      $url.= '&from='.$shis_from;
      $url.= '&udh='.$shis_udh;
      $url.= '&text='.urlencode($msg);
      $url.= '&dlr-mask=19&dlr-url*';

      $urltouse =  $shis_url.$url;
		
	  
	 $file = file_get_contents($urltouse);
      if ($file=="Sent.")
	  {
		  $response="Y";
	  }
	  else
	  {
          $response="N";
	  }

      return($response);
	}
	
	
	/************************************************************************/
	/********************************MMU************************************/
	/**********************************************************************/
	
	

	public function insertIntoMMU($data,$localsession,$mode,$masterID){
		try {
			
			$this->db->trans_begin();
				
				$mmudate = substr($data->muuentrydate,0,10); // substr because time format is coming as ISO
			
				
				$reg_data = [];
				$muuentrydate =date("Y-m-d",strtotime($mmudate)); 
				$carclusture = $data->carclusture;
				$opd = $data->opd;
				$anc = $data->anc;
				$ocp = $data->ocp;
				$cc = $data->cc;
				$ms = $data->ms;
				$lab = $data->lab;
				$rdt = $data->rdt;
				$refd = $data->refd;
				$ncd = $data->ncd;
				
		
			if($mode=="EDIT"){
				$mmu_data = [
					"mmu_date" => $muuentrydate,
					"car_cluster_id" => trim(htmlspecialchars($carclusture)),
					"opd" => trim(htmlspecialchars($opd)),
					"anc" => trim(htmlspecialchars($anc)),
					"ocp" => trim(htmlspecialchars($ocp)),
					"cc" => trim(htmlspecialchars($cc)),
					"ms" => trim(htmlspecialchars($ms)),
					"lab" => trim(htmlspecialchars($lab)),
					"rdt" => trim(htmlspecialchars($rdt)),
					"refd" =>  trim(htmlspecialchars($refd)),
					"ncd" => trim(htmlspecialchars($ncd))
					
				];
				
				$this->db->where('mmu_shis.id', $masterID);
				$this->db->update('mmu_shis', $mmu_data); 
				
			}
			else{
				$grpcordinatorid = $this->getGroupCordinatorID($localsession->uid);
				$mmu_data = [
				"mmu_date" => date("Y-m-d",strtotime($muuentrydate)),
				"car_cluster_id" => trim(htmlspecialchars($carclusture)),
				"opd" => trim(htmlspecialchars($opd)),
				"anc" => trim(htmlspecialchars($anc)),
				"ocp" => trim(htmlspecialchars($ocp)),
				"cc" => trim(htmlspecialchars($cc)),
				"ms" => trim(htmlspecialchars($ms)),
				"lab" => trim(htmlspecialchars($lab)),
				"rdt" => trim(htmlspecialchars($rdt)),
				"refd" =>  trim(htmlspecialchars($refd)),
				"ncd" => trim(htmlspecialchars($ncd)),
				"grpcord_id" => $grpcordinatorid,
				"created_by" => $localsession->uid
			];
				$this->db->insert('mmu_shis', $mmu_data);
			}
			
			
			
			
			$user_activity = array(
					"activity_module" => 'MMU',
					"action" => "Insert",
					"from_method" => "roleAPI/saveMMU/insertIntoMMU",
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
        } 
		catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
	}
	
	
	public function getMMUList($localsession){
		$data = [];
		$grpcordinatorid = $this->getGroupCordinatorID($localsession->uid);
		
		$where = [
			"mmu_shis.grpcord_id" => $grpcordinatorid
		];
		
		$query = $this->db->select("mmu_shis.*,clusture_car.*,mmu_shis.id AS mmumastid,DATE_FORMAT(mmu_shis.`mmu_date`,'%d-%m-%Y') AS mmudate",FALSE)
					->from("mmu_shis")
					->join('clusture_car','clusture_car.id = mmu_shis.car_cluster_id','INNER')
					->where($where)
					->order_by("mmu_shis.mmu_date","DESC")
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
	
	
	public function getMMUDetailByID($masterid){
		$data = [];
		$where = [
			"mmu_shis.id" => $masterid
		];
		
		$query = $this->db->select("mmu_shis.*,mmu_shis.id AS mmumastid,DATE_FORMAT(mmu_shis.`mmu_date`,'%Y-%m-%d') AS mmudate",FALSE)
					->from("mmu_shis")
					->where($where)
					->order_by("mmu_shis.mmu_date","DESC")
					->get();
		
		
		if($query->num_rows()> 0)
		{
			$row = $query->row();
			$data = $row;
		}
		
		return $data;
		
	}
	
	
	public function deleteMMU($mid,$localsession){
				try {
				$this->db->trans_begin();
				$this->db->where('mmu_shis.id', $mid);
				$this->db->delete('mmu_shis'); 
				
				
				$user_activity = array(
					"module_master_id" => $mid,
					"activity_module" => "EYE",
					"action" => "Delete",
					"from_method" => "roleAPI/deleteMMU/deleteMMU",
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
	
	/************************************************************************/
	/********************************SHIS EYE************************************/
	/**********************************************************************/
	
	

	public function insertIntoSHISEye($data,$localsession,$mode,$masterID){
		try {
			
			$this->db->trans_begin();
				
				$shiseyedate = substr($data->shiseyeentrydate,0,10); // substr because time format is coming as ISO
			
				
				$reg_data = [];
				$shiseyeentrydate =date("Y-m-d",strtotime($shiseyedate)); 
				$carclusture = $data->carclusture;
				$cataret = $data->cataret;
				$spectacles = $data->spectacles;
				
				
		
			if($mode=="EDIT"){
				$shiseye_data = [
					"given_date" => $shiseyeentrydate,
					"car_cluster_id" => trim(htmlspecialchars($carclusture)),
					"catarat_no" => trim(htmlspecialchars($cataret)),
					"spectacles_no" => trim(htmlspecialchars($spectacles))
				];
				
				$this->db->where('shis_eye_record.id', $masterID);
				$this->db->update('shis_eye_record', $shiseye_data); 
				
			}
			else{
				$grpcordinatorid = $this->getGroupCordinatorID($localsession->uid);
				
				$shiseye_data = [
					"given_date" => $shiseyeentrydate,
					"car_cluster_id" => trim(htmlspecialchars($carclusture)),
					"catarat_no" => trim(htmlspecialchars($cataret)),
					"spectacles_no" => trim(htmlspecialchars($spectacles)),
					"grpcord_id" => $grpcordinatorid,
					"created_by" => $localsession->uid
					];
					
				$this->db->insert('shis_eye_record', $shiseye_data);
				
			}
			
			
			
			
			$user_activity = array(
					"activity_module" => 'EYE',
					"action" => "Insert",
					"from_method" => "roleAPI/saveEyeData/insertIntoSHISEye",
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
        } 
		catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
	}
	
	
	public function getShisEyeList($localsession){
		$data = [];
		$grpcordinatorid = $this->getGroupCordinatorID($localsession->uid);
		
		$where = [
			"shis_eye_record.grpcord_id" => $grpcordinatorid
		];
		
		$query = $this->db->select("shis_eye_record.*,clusture_car.*,shis_eye_record.id AS shiseyemstid,DATE_FORMAT(shis_eye_record.`given_date`,'%d-%m-%Y') AS shiseyedate",FALSE)
					->from("shis_eye_record")
					->join('clusture_car','clusture_car.id = shis_eye_record.car_cluster_id','INNER')
					->where($where)
					->order_by("shis_eye_record.given_date","DESC")
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
	
	
	
	public function getShisEyeDetail($masterid){
		$data = [];
		$where = [
			"shis_eye_record.id" => $masterid
		];
		
		$query = $this->db->select("shis_eye_record.*,shis_eye_record.id AS shiseyemstid,DATE_FORMAT(shis_eye_record.`given_date`,'%d-%m-%Y') AS shiseyedate,DATE_FORMAT(shis_eye_record.`given_date`,'%Y-%m-%d') AS givendate",FALSE)
					->from("shis_eye_record")
					->where($where)
					->order_by("shis_eye_record.given_date","DESC")
					->get();
		
		
		if($query->num_rows()> 0)
		{
			$row = $query->row();
			$data = $row;
		}
		
		return $data;
		
	}
	
	public function deleteShisEye($mid,$localsession){
				try {
				$this->db->trans_begin();
				$this->db->where('shis_eye_record.id', $mid);
				$this->db->delete('shis_eye_record'); 
				
				
				$user_activity = array(
					"module_master_id" => $mid,
					"activity_module" => "EYE",
					"action" => "Delete",
					"from_method" => "roleAPI/deleteShisEye/deleteShisEye",
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
	
	
	private function getGroupCordinatorID($user_id){
		$groupcorid = 0;
		$where = [
			"coordinator.userid" => $user_id
		];
	
		
		$query = $this->db->select("*")
					->from("coordinator")
					->where($where)
					->get();
		
		if($query->num_rows()>0){
			$row = $query->row();
			$groupcorid = $row->id;
		}
		return $groupcorid;
		
	}
	
	public function getCarCluster(){
		$data = [];
		$query = $this->db->select("*")
					->from("clusture_car")
					->where("clusture_car.is_active",1)
					->order_by("clusture_car.name","ASC")
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
	
	
}
