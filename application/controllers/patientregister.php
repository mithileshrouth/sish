<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Patientregister extends CI_Controller {
	public function __construct()
	{
	    parent::__construct();
		$this->load->library('session');
		$this->load->model('locationmodel','locations',TRUE);
                $this->load->model('patientregistrationmodel','patientregistrationmodel',TRUE);
                $this->load->model('apimodel','apimodel',TRUE);
                $this->load->model('locationmodel','location',TRUE);
                $this->load->model('tuberculosisunitmodel','tu',TRUE);
                
	}
	
	
	public function index()
	{
		
	}

	public function addpatient()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['token']))
		{
                        $patientId="";
			if ($this->uri->segment(3) === FALSE)
			{
				$result['mode'] = "ADD";
				$result['btnText'] = "Save";
				$result['btnTextLoader'] = "Saving...";
				$patientId = 0;
				$result['patientregister'] = [];
			}
			else
			{
				$result['mode'] = "EDIT";
				$result['btnText'] = "Update";
				$result['btnTextLoader'] = "Updating...";
				$patientId = $this->uri->segment(3);
				$result['patientregister'] = $this->apimodel->getPtientDataById($patientId);
				
			}
//                        echo('<pre>');
//                        print_r($result['patientregister']);
//                        echo('</pre>');
                        
                        $result["district"] = $this->commondatamodel->getAllDropdownData('district'); 
                        if($result['mode']=="EDIT"){
                            $result["block"]= $this->getBlockByDistrictId($result['patientregister']->patient_district,0);
                        }else{
                            $result["block"]="";
                        }
                       //tuberculosisunit
                       
                        if($result['mode']=="EDIT"){
                            $result["tubclsunit"]= $this->getTubclsUnitByBlockId($result['patientregister']->patient_block,0);
                        }else{
                            $result["tubclsunit"]="";
                        }
                        
                        //dmc
                        if($result['mode']=="EDIT"){
                            $result["dmc"]= $this->getDmcByTuId($result['patientregister']->patient_tuid,0);
                        }else{
                            $result["dmc"]="";
                        }
                        
                        
                        $result["coordinatorList"] = $this->commondatamodel->getAllDropdownData("coordinator");
                        if($result['mode']=="EDIT"){
                            $result["nfhp"]= $this->getNFHPByCoordinator($result['patientregister']->group_cord_id,0);
                        }else{
                            $result["nfhp"]="";
                        }
                        $result["symptom"]=$this->commondatamodel->getAllDropdownData("symptoms_master");
                        
                        if($result['mode']=='EDIT'){
                            $smptm = $this->getPatientSymptoms($patientId);
                            $result["selectedSymtp"][]="";
                            
                            foreach($smptm as $vl){
                            $result["selectedSymtp"][]=  $vl->symptom_id;  
                            }
                             //pre($result["selectedSymtp"]);
                            //= $this->getPatientSymptoms($patientId);
                        }
                        
                        
			$header = "";
			$page = "dashboard/adminpanel_dashboard/patientregister/add_edit";
			createbody_method($result, $page, $header,$session);
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}
        public function getBlockByDistrictId($dist_id=0,$is_ajax=0){
            $block="";
//            $is_ajax = $this->input->post('ajxtag');
            $dictrictId = (int)$dist_id;
            if($dictrictId!=0){
                //echo($dictrictId);
                $table="block";
                $where=[
                    "district_id"=>$dictrictId
                ];
                $block = $this->commondatamodel->getAllRecordWhere($table,$where);
                
            }
            if($is_ajax!=0){
                $data['rslt']=$block;
                $this->load->view("dashboard/adminpanel_dashboard/patientregister/partial_bloack_view",$data);
            } else {
                return $block;
            }
            
            
        }
        
        public function getTubclsUnitByBlockId($blockId="",$is_ajax=0)
         {
            $tubclsUnit="";
            if($blockId!=""){
                $table = "tu_unit";
                $where=[
                        "block_id"=>$blockId
                    ];
                $tubclsUnit = $this->commondatamodel->getAllRecordWhere($table,$where);
            }
            
            if($is_ajax!=0){
                $data['rslt']=$tubclsUnit;
                $this->load->view("dashboard/adminpanel_dashboard/patientregister/partial_tu_view",$data);
            } else {
                return $tubclsUnit;
            }
         }
         
         public function getDmcByTuId($tuid="",$is_ajax=0)
         {
             $dmc="";
             if($tuid!=""){
                $table = "dmc";
                $where=[
                        "tuid"=>$tuid
                    ];
                $dmc = $this->commondatamodel->getAllRecordWhere($table,$where);
            }
            
            if($is_ajax!=0){
                $data['rslt']=$dmc;
                $this->load->view("dashboard/adminpanel_dashboard/patientregister/partial_dmc_view",$data);
            } else {
                return $dmc;
            }
             
         }


         public function getNFHPByCoordinator($coordinatorId="",$is_ajax=0)
        {
            //$Non-formal Health Providers
            $nonFormalHlthPrvdr =[];
            if($coordinatorId!=""){
                $table="nqpp";
                $where=[
                    "coordinator_id"=>$coordinatorId
                ];
                $nonFormalHlthPrvdr=$this->commondatamodel->getAllRecordWhere($table,$where);
            }
            
            if($is_ajax!=0){
                $data['rslt']=$nonFormalHlthPrvdr;
                $this->load->view("dashboard/adminpanel_dashboard/patientregister/partial_nfhp_view",$data);
            } else {
                return $nonFormalHlthPrvdr;
            }
            
        }
        
        public function getPatientSymptoms($patientId="")
        {
            $symptoms =[];
            if($patientId!=""){
                $table="patient_symptom_detail";
                $where=[
                    "patient_id"=>$patientId
                ];
                $symptoms = $this->commondatamodel->getAllRecordWhere($table,$where);
            }
            return $symptoms;
        }


        

	public function patientregAction()
	{
		
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['token']))
		{
			$json_response = array();
			$formData = $this->input->post('formDatas');
			parse_str($formData, $dataArry);
                        
                        $mode = trim(htmlspecialchars($dataArry['mode']));
			$patient_id = trim(htmlspecialchars($dataArry['patient_id']));
                        $patient_name=trim(htmlspecialchars($dataArry['patient_name']));
                        $patient_mobile_primary = trim(htmlspecialchars($dataArry['patient_mobile_primary']));
                        $patient_age= trim(htmlspecialchars($dataArry['patient_age']));
                        $patient_sex = $dataArry['patient_sex'];
                        $patient_village = $dataArry['patient_village'];
                        $patient_gram_panchayat = $dataArry['patient_gram_panchayat'];
                        $patient_postoffice  = $dataArry['patient_postoffice'];
                        $patient_pin = $dataArry['patient_pin'];
                        $patient_district = $dataArry['patient_district'];
                        $patient_block=$dataArry['patient_block'];
                        $patient_tuid=$dataArry['tubclunit'];
                        $dmc_id=$dataArry['dmcdrp'];
                        $patient_full_address = $dataArry['patient_full_address'];
                        $patient_adhar = $dataArry['patient_adhar'];
                        $patient_ration = $dataArry['patient_ration'];
                        $patient_voter = $dataArry['patient_voter'];
                        $patient_referal_date =$dataArry['patient_referal_date'];
                        $coordinator= $dataArry['coordinator'];
                        $sel_nqpp = $dataArry['sel_nqpp'];
                        $patient_mobile_alternative = $dataArry['patient_mobile_alternative'];
                        $patient_pulmonary = $dataArry['patient_pulmonary'];
                        $patient_symptom = $dataArry['patient_symptom'];
                        
                        //pre($dataArry); exit;
			

			
                        	if($patient_id>0 && $mode=="EDIT")
				{
					/*  EDIT MODE
					 *	-----------------
					*/
                                        $updt_data=[
                                            "patient_name"=>$patient_name,
                                            "patient_mobile_primary"=>$patient_mobile_primary,
                                            "patient_age"=>$patient_age,
                                            "patient_sex"=> $patient_sex,
                                            "patient_village"=> $patient_village,
                                            "patient_gram_panchayat"=> $patient_gram_panchayat,
                                            "patient_postoffice"=> $patient_postoffice,
                                            "patient_pin"=> $patient_pin,
                                            "patient_district"=> $patient_district,
                                            "patient_block"=> $patient_block,
                                            "patient_tuid"=>$patient_tuid,
                                            "dmc_id"=>$dmc_id,
                                            "patient_full_address"=> $patient_full_address,
                                            "patient_adhar"=> $patient_adhar,
                                            "patient_ration"=> $patient_ration,
                                            "patient_voter"=> $patient_voter,
                                            "patient_referal_date"=>$patient_referal_date,
                                            "group_cord_id"=> $coordinator,
                                            "nqpp_id"=> $sel_nqpp,
                                            "patient_mobile_alternative"=> $patient_mobile_alternative,
                                            "patient_pulmonary"=> $patient_pulmonary,
                                            "registered_by_user"=> $session['userid']
                                            //"patient_symptom"=> $patient_symptom
                                        ];
					
//					$where_upd = array(
//						"patient_id"=> $patient_id
//					);

					$user_activity = array(
						"activity_module" => 'PATREG',
						"action" => 'Update',
						"from_method" => 'patientregister/patientregAction',
						"user_id" => $session['userid'],
						"ip_address" => getUserIPAddress(),
						"user_browser" => getUserBrowserName(),
						"user_platform" => getUserPlatform()
					 );


					/*
					@updateData_WithUserActivity('update table name','update table data','update table where condition','user activity table name','user activity table data');
					*/
					//updatePTCData($data=[],$ptcId,$symptom=[])
                                        
                                        $update = $this->patientregistrationmodel->updatePTCData($updt_data,$patient_id,$patient_symptom);
					
					
					if($update)
					{
						$json_response = array(
							"msg_status" => 1,
							"msg_data" => "Updated successfully",
							"mode" => "EDIT"
						);
					}
					else
					{
						$json_response = array(
							"msg_status" => 0,
							"msg_data" => "There is some problem while updating ...Please try again."
						);
					}



				} // end if mode
				else
				{
				$district_row = $this->location->getDistrict($patient_district);
				$block_row = $this->location->getBlock($patient_block);
				$latest_serial = $this->apimodel->getLatestSerialNumber("REG",1);
				$patient_uniqID = NULL;
				if(sizeof($district_row)>0 && sizeof($block_row)>0){
					$district_code = $district_row->dist_code;
					$block_code = $block_row->block_code;
					
					$patient_uniqID = "PTC/".$district_code."/".$block_code."/".$latest_serial;
				}
                                

					$insertdata=[
                                            "patient_uniq_id" => $patient_uniqID,
                                            "patient_name"=>$patient_name,
                                            "patient_mobile_primary"=>$patient_mobile_primary,
                                            "patient_age"=>$patient_age,
                                            "patient_sex"=> $patient_sex,
                                            "patient_village"=> $patient_village,
                                            "patient_gram_panchayat"=> $patient_gram_panchayat,
                                            "patient_postoffice"=> $patient_postoffice,
                                            "patient_pin"=> $patient_pin,
                                            "patient_district"=> $patient_district,
                                            "patient_block"=> $patient_block,
                                            "patient_tuid"=>$patient_tuid,
                                            "dmc_id"=>$dmc_id,
                                            
                                            "patient_full_address"=> $patient_full_address,
                                            "patient_adhar"=> $patient_adhar,
                                            "patient_ration"=> $patient_ration,
                                            "patient_voter"=> $patient_voter,
                                            "patient_referal_date"=>$patient_referal_date,
                                            "group_cord_id"=> $coordinator,
                                            "nqpp_id"=> $sel_nqpp,
                                            "patient_mobile_alternative"=> $patient_mobile_alternative,
                                            "patient_pulmonary"=> $patient_pulmonary,
                                            "registered_by_user"=> $session['userid'],
                                            
                                        ];

                                       $insertData=$this->patientregistrationmodel->insertIntoPTC($insertdata,$patient_symptom);
					
					
	
					

					if($insertData)
					{
						$json_response = array(
							"msg_status" => 1,
							"msg_data" => "Saved successfully",
							"mode" => "ADD"
						);
					}
					else
					{
						$json_response = array(
							"msg_status" => 1,
							"msg_data" => "There is some problem.Try again"
						);
					}

				} // end add mode ELSE PART




				

			
			

			header('Content-Type: application/json');
			echo json_encode( $json_response );
			exit;

			

		}
		else
		{
			redirect('adminpanel','refresh');
		}
	}


	


	
	

}
?>