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
				//$country = $addressdata->country;
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
				$dmcid = $referaldata->selecteddmc;
				$symptom = $referaldata->symptom;
				
				$latest_serial = $this->getLatestSerialNumber("REG",$localsession->prj);
				
				$district_row = $this->location->getDistrict($district);
				$block_row = $this->location->getBlock($block);
				
				$patient_uniqID = NULL;
				if(sizeof($district_row)>0 && sizeof($block_row)>0){
					$district_code = $district_row->dist_code;
					$block_code = $block_row->block_code;
					
					$patient_uniqID = "PTB/".$district_code."/".$block_code."/".$latest_serial;
				}
			
			$reg_data = [
				"patient_uniq_id" => $patient_uniqID,
				"patient_name" => trim(htmlspecialchars($name)),
				"patient_mobile_primary" => trim(htmlspecialchars($mobile)),
				"patient_age" => trim(htmlspecialchars($age)),
				"patient_full_address" => trim(htmlspecialchars($fulladdress)),
				"patient_village" => trim(htmlspecialchars($village)),
				"patient_postoffice" => trim(htmlspecialchars($postoffice)),
				"patient_pin" => trim(htmlspecialchars($pincode)),
				"patient_state" => $state,
				"patient_country" => $this->location->getCountryIDByStateID($state),
				"patient_gurdian" => trim(htmlspecialchars($guardianname)),
				"patient_sex" => trim(htmlspecialchars($gender)),
				"patient_block" => $block,
				"patient_district" => $district,
				"patient_adhar" => trim(htmlspecialchars($aadharno)),
				"patient_voter" => trim(htmlspecialchars($voterid)),
				"patient_ration" => trim(htmlspecialchars($rationno)),
				"patient_symptom" => trim(htmlspecialchars($symptom)),
				"nqpp_id" =>  $refferedbynqpp,
				"group_cord_id" =>  $refferedbycord,
				"dmc_id" => $dmcid,
				"registered_by_user" => $localsession->uid
			];
			
			
			$this->db->insert('patient', $reg_data);
			$ptb_inserted_id = $this->db->insert_id();
			
			$sms_row = $this->getMessageContentToSendSMS("REG");
			$result_data = $this->getRolesToSendSMS("REG");
			
			$param_value = [
				"PTB_NAME" => trim(htmlspecialchars($name)),
				"PTB_ID" => $patient_uniqID,
				"PTB_REG_DATE" => date("d/m/Y")
			];
			$smstext = $this->parser->parse_string($sms_row->sms_content, $param_value, true);
			
			foreach($result_data as $sendsms_to_role){
				if($sendsms_to_role->role_code=="CORD"){
					$coordinator_row = $this->coordinator->getCoordinatorEditDataByID($refferedbycord);
					if(sizeof($coordinator_row)>0){
						$coordinator_mobile = $coordinator_row->cordmobile;
						
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
						
					}
					
				}
				elseif($sendsms_to_role->role_code=="NQPP"){
					$nqpp_row = $this->nqpp->getNQPPEditDataByID($refferedbynqpp);
					if(sizeof($nqpp_row)>0){
						$nqpp_mobile = $nqpp_row->nqppmobile;
						
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
						
					}
					
				}
				elseif($sendsms_to_role->role_code=="DMC"){
					$dmc_row = $this->dmc->getDMCEditDataByID($dmcid);
					if(sizeof($dmc_row)>0){
						$dmc_lt_mobile = $dmc_row->ltmobile;
						
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
						
						
					}
					
				}
				elseif($sendsms_to_role->role_code=="PTB"){
				
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
	
	
	
	private function getLatestSerialNumber($from,$project_id){
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
			$query = $this->db->select("patient.*,dmc.name AS dmcname,nqpp.name as selectednqpp,coordinator.name as selectedcoordinatorname, DATE_FORMAT(patient.`patient_reg_date`,'%d/%m%/%Y') AS patient_reg_date",FALSE)
					->from("patient")
					->join("coordinator","coordinator.id = patient.group_cord_id","INNER")
					->join("dmc","dmc.id = patient.dmc_id","INNER")
					->join("nqpp","nqpp.id = patient.nqpp_id","INNER")
					->where($where)
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
					->order_by("patient.patient_reg_date","DESC")->get();
		}
		else{
			// Role = Project Manager
			$query = $this->db->select("patient.*,dmc.name AS dmcname,nqpp.name as selectednqpp,coordinator.name as selectedcoordinatorname, DATE_FORMAT(patient.`patient_reg_date`,'%d/%m%/%Y') AS patient_reg_date",FALSE)
					->from("patient")
					->join("coordinator","coordinator.id = patient.group_cord_id","INNER")
					->join("dmc","dmc.id = patient.dmc_id","INNER")
					->join("nqpp","nqpp.id = patient.nqpp_id","INNER")
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
	
	
	
	public function getStatusWisePTB($status,$localsession){
		if($status=="NEW"){
			
			$newRegisterWhere = [
				"dmc_sputum_done" => "N",
				"xray_is_done" => "N",
				"is_cbnaat_done" => "N",
				"is_ptb_trtmnt_done" => "N"
			
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
		
		
		// In Progress
		
		if($status=="INPROGRESS"){
			
		$inProgressORWhere = [
			"dmc_sputum_done" => "Y",
			"xray_is_done" => "Y",
			"is_cbnaat_done" => "Y"
		];
		
		$inProgressWhere = [
			"is_ptb_trtmnt_done" => "N"
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
							->where($inProgressWhere)
							->or_where($inProgressWhere)
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
							->where($inProgressWhere)
							->or_where($inProgressWhere)
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
							->where($inProgressWhere)
							->or_where($inProgressWhere)
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
							->where($inProgressWhere)
							->or_where($inProgressWhere)
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
							->where($inProgressWhere)
							->or_where($inProgressWhere)
							->order_by("patient.patient_reg_date","DESC")->get();
				}
				else{
					// Role = Project Manager
					$query = $this->db->select("patient.*,dmc.name AS dmcname,nqpp.name as selectednqpp,coordinator.name as selectedcoordinatorname, DATE_FORMAT(patient.`patient_reg_date`,'%d/%m%/%Y') AS patient_reg_date",FALSE)
							->from("patient")
							->join("coordinator","coordinator.id = patient.group_cord_id","INNER")
							->join("dmc","dmc.id = patient.dmc_id","INNER")
							->join("nqpp","nqpp.id = patient.nqpp_id","INNER")
							->where($inProgressWhere)
							->or_where($inProgressWhere)
							->order_by("patient.patient_reg_date","DESC")->get();
				}
		}
		
		
		echo $this->db->last_query();
		
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
		$query = $this->db->select("patient.*,ptb_treatment_detail.*,nqpp.name as selectednqpp,coordinator.name as selectedcoordinatorname,
						 DATE_FORMAT(ptb_treatment_detail.`first_followup_dt`,'%d/%m%/%Y') AS first_followup_dt,
						DATE_FORMAT(ptb_treatment_detail.`second_followup_dt`, '%d/%m%/%Y') AS second_followup_dt
						",FALSE)
					->from("patient")
					->join("ptb_treatment_detail","ptb_treatment_detail.patient_id = patient.patient_id","LEFT")
					->join("nqpp","nqpp.id = patient.nqpp_id","INNER")
					->join("coordinator","coordinator.id = patient.group_cord_id","INNER")
					->where($where)
					->get();
			//echo $this->db->last_query();

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
	
	
}
