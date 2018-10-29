<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class patientregistrationmodel extends CI_Model{
    public function __construct() {
        parent::__construct();
     $this->load->model('rolemastermodel','rolemodel',TRUE);
		$this->load->model('coordinatormodel','coordinator',TRUE);
		$this->load->model('nqppmodel','nqpp',TRUE);
		$this->load->model('dmcmodel','dmc',TRUE);
		$this->load->model('locationmodel','location',TRUE);
    }
    
    public function updatePTCData($data=[],$ptcId,$symptom=[])
    {
      
        try {
            $this->db->trans_begin(); 
            $this->db->where('patient.patient_id', $ptcId);
            $this->db->update('patient', $data);
           
            if(isset($symptom)){
				
				$this->db->where('patient_symptom_detail.patient_id', $ptcId);
				$this->db->delete('patient_symptom_detail');

				$this->insertIntoPTBSymptomDtl($ptcId,$symptom);
			}
	  if($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
				return false;
            } else {
				$this->db->trans_commit();
                return true;
            }
        } catch (Exception $exc){
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
        
 public function insertIntoPTC($data=[],$symptom=[]){
    
     
     try {
                        $this->db->insert('patient', $data);
			$ptb_inserted_id = $this->db->insert_id();
			//echo "Q ".$this->db->last_query();
			//exit;
			// INSERT INTO PATIENTsYMPTOM
			if(isset($symptom)){
				$this->insertIntoPTBSymptomDtl($ptb_inserted_id,$symptom);
			}    
                        
//                        $sms_row = $this->getMessageContentToSendSMS("REG");
//			$result_data = $this->getRolesToSendSMS("REG");
//			
//			$param_value = [
//				"PTB_NAME" => trim(htmlspecialchars($name)),
//				"PTB_ID" => $patient_uniqID,
//				"PTB_REG_DATE" => date("d/m/Y"),
//				"PTB_MOBILE" => trim(htmlspecialchars($mobile))
//			];
//			$smstext = $this->parser->parse_string($sms_row->sms_content, $param_value, true);
//			
//			foreach($result_data as $sendsms_to_role){
//				if($sendsms_to_role->role_code=="CORD"){
//					$coordinator_row = $this->coordinator->getCoordinatorEditDataByID($refferedbycord);
//					if(sizeof($coordinator_row)>0){
//						$coordinator_mobile = $coordinator_row->cordmobile;
//						
//						
//						$sms_status = $this->sendSMS($coordinator_mobile,$smstext);	
//
//						$sms_log = [
//							"performed_by_user_id" => $localsession->uid,
//							"sms_sent_against_ptb_id" => $ptb_inserted_id,
//							"sms_action_mst_id" => $sms_row->id,
//							"send_to_role" => $sendsms_to_role->send_to_roleid,
//							"receiver_user_id" => $coordinator_row->userid,
//							"receiver_mobile_no" => $coordinator_mobile,
//							"is_sent" => $sms_status
//						];
//
//						$this->db->insert('sms_sent_report', $sms_log);  
//						
//						
//						
//						
//					}
//					
//				}
//				if($sendsms_to_role->role_code=="DISTCORD"){
//					$distcord_row = $this->location->getDistrict($district);
//					if(sizeof($distcord_row)>0){
//						$distcord_mobile = $distcord_row->dist_cordinator_mbl;
//						
//						
//						$sms_status = $this->apimodel->sendSMS($distcord_mobile,$smstext);	
//
//						$sms_log = [
//							"performed_by_user_id" => $localsession->uid,
//							"sms_sent_against_ptb_id" => $ptb_inserted_id,
//							"sms_action_mst_id" => $sms_row->id,
//							"send_to_role" => $sendsms_to_role->send_to_roleid,
//							"receiver_user_id" => $distcord_row->userid,
//							"receiver_mobile_no" => $distcord_mobile,
//							"is_sent" => $sms_status
//						];
//
//						$this->db->insert('sms_sent_report', $sms_log);  
//						
//						
//						
//					}
//					
//				}
//				elseif($sendsms_to_role->role_code=="NQPP"){
//					$nqpp_row = $this->nqpp->getNQPPEditDataByID($refferedbynqpp);
//					if(sizeof($nqpp_row)>0){
//						$nqpp_mobile = $nqpp_row->nqppmobile;
//						
//						
//						 $sms_status = $this->sendSMS($nqpp_mobile,$smstext);
//						 $sms_log = [
//							"performed_by_user_id" => $localsession->uid,
//							"sms_sent_against_ptb_id" => $ptb_inserted_id,
//							"sms_action_mst_id" => $sms_row->id,
//							"send_to_role" => $sendsms_to_role->send_to_roleid,
//							"receiver_user_id" => $nqpp_row->userid,
//							"receiver_mobile_no" => $nqpp_mobile,
//							"is_sent" => $sms_status
//						];
//
//						$this->db->insert('sms_sent_report', $sms_log); 
//						
//						
//						
//					}
//					
//				}
//				elseif($sendsms_to_role->role_code=="DMC"){
//					$dmc_row = $this->dmc->getDMCEditDataByID($dmcid);
//					if(sizeof($dmc_row)>0){
//						$dmc_lt_mobile = $dmc_row->ltmobile;
//						
//						
//						$sms_status = $this->sendSMS($dmc_lt_mobile,$smstext);
//						$sms_log = [
//							"performed_by_user_id" => $localsession->uid,
//							"sms_sent_against_ptb_id" => $ptb_inserted_id,
//							"sms_action_mst_id" => $sms_row->id,
//							"send_to_role" => $sendsms_to_role->send_to_roleid,
//							"receiver_user_id" => $dmc_row->userid,
//							"receiver_mobile_no" => $dmc_lt_mobile,
//							"is_sent" => $sms_status
//						];
//
//						$this->db->insert('sms_sent_report', $sms_log); 
//						
//						
//					
//
//						
//						
//					}
//					
//				}
//				elseif($sendsms_to_role->role_code=="PTB"){
//					
//					
//					$sms_status = $this->sendSMS($mobile,$smstext);
//					$sms_log = [
//							"performed_by_user_id" => $localsession->uid,
//							"sms_sent_against_ptb_id" => $ptb_inserted_id,
//							"sms_action_mst_id" => $sms_row->id,
//							"send_to_role" => $sendsms_to_role->send_to_roleid,
//							"receiver_user_id" => $ptb_inserted_id, // receiver userid = patient id in this case
//							"receiver_mobile_no" => $mobile,
//							"is_sent" => $sms_status
//						];
//					$this->db->insert('sms_sent_report', $sms_log); 
//				
//					
//				}
//				
//			}
			
			
			$user_activity = array(
					"activity_module" => 'PTB REG',
					"action" => "Insert",
					"from_method" => "patientregistrationmodel/insertIntoPatient",
					"user_id" => 1,
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
                                
         
     } catch (Exception $ex) {
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
 
}
