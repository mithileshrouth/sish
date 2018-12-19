<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class patient extends CI_Controller {
	public function __construct()
	{
	    parent::__construct();
		$this->load->library('session');
		$this->load->model('patientmodel','patientmodel',TRUE);
		$this->load->model('nqppmodel','nqpp',TRUE);
		$this->load->model('coordinatormodel','coordinator',TRUE);
		$this->load->model('locationmodel','locations',TRUE);
                $this->load->model('dmcmodel','dmcmodel',TRUE);
                $this->load->model('xraycentermodel','xray',TRUE);
                $this->load->model('cbnaatmodel','cbnaat',TRUE);
	}

	public function index()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['token']))
		{
			$header = "";
			
		  	/* Role id 9: District Coordinator*/
			if ($session['roleid']==9) {
				$where_dist = array('district.web_userid' => $session['userid'], );
				$rowDistrict=$this->commondatamodel->getSingleRowByWhereCls('district',$where_dist);
				$whereAry = array('district.id' =>$rowDistrict->id);

			 }else{
				$whereAry = [];
			 }
			
			$result['patientList'] = $this->patientmodel->getAllPatient($whereAry); 
			$page = "dashboard/adminpanel_dashboard/patient/patient_list_view.php";
			//pre($result['patientList']);exit;
			createbody_method($result, $page, $header, $session);
		}
		else
		{
			redirect('adminpanel','refresh');
		}
	}


	public function viewpatient()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['token']))
		{
			if ($this->uri->segment(3) === FALSE)
			{
					
			$patientId=0;	
			
			}
			else
			{
				$result['mode'] = "EDIT";
				$result['btnText'] = "Update";
				$result['btnTextLoader'] = "Updating...";
				$patientId = $this->uri->segment(3);

				$result['patientInfo'] = $this->patientmodel->getPatientDetailsById($patientId); 
				
				$result['patientTreatmentInfo'] = $this->patientmodel->getPatientTreatmentDetailsById($patientId);
				
				
			}
			//pre($result['patientInfo']);exit;
			$header="";
			$page = "dashboard/adminpanel_dashboard/patient/patient_details.php";
			createbody_method($result, $page, $header,$session);
		}
		else
		{
			redirect('adminpanel','refresh');
		}
	}
/**
 * @date 29/10/2018
 * @param type $patient_id
 * @author Abhik
 */
 public function patientTestProcess($patient_id){
             $session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['token']))
		{
                        $result["patientStaticHeader"]= $this->patientmodel->getPatientDetails($patient_id);
                        $result["dmc"] = $this->dmcmodel->getAllDMC();
                        $result["xray"]= $this->xray->getAllXrayCenter();
                        $result["cbnaat"] = $this->cbnaat->getAllCbnaat();
                        
			$header = "";
			$page = "dashboard/adminpanel_dashboard/patient/patient_test_process";
			createbody_method($result, $page, $header,$session);
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
             
         }
         public function investigationUpdate(){
            
                $session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['token']))
		{
                   $Data = json_decode(file_get_contents('php://input'), true);
                   //pre($Data);
                   $json_response;
                   $patientId="";
                   $update=[];
                   //str_replace('/', '-', $var)
                   if($Data["from"]=="dmc"){
                       $patientId = $Data["patient_id"];
                       $update=[
                           "dmc_sputum_done"=>($Data["dmc_sputum_test_date"]!=""?"Y":"N"),
                           "dmc_sputum_test_date"=>($Data["dmc_sputum_test_date"]!=""? date('Y-m-d', strtotime(str_replace('/', '-', $Data["dmc_sputum_test_date"]))):NULL),
                           "dmc_sputum_date"=>($Data["dmc_sputum_date"]!=""? date('Y-m-d',strtotime(str_replace('/', '-', $Data["dmc_sputum_date"]))):NULL),
                           "dmc_spt_is_positive"=>$Data["dmc_spt_is_positive"],
                           "dmc_result_done"=>($Data["dmc_spt_is_positive"]!=""?"Y":"N")
                       ];
                       
                   }else if($Data["from"]=="xray"){
                       
                        $patientId = $Data["patient_id"];
                       $update=[
                           "xray_is_done"=>($Data["xray_date"]!=""?"Y":"N"),
                           "xray_date"=>($Data["xray_date"]!=""? date('Y-m-d', strtotime(str_replace('/', '-', $Data["xray_date"]))):NULL),
                           "xray_cntr_id"=>$Data["xray_cntr_id"],
                           "xray_result_done"=>($Data["xray_is_postive"]!=""?"Y":"N"),
                           "xray_is_postive"=>$Data["xray_is_postive"]
                       ];
                       
                       
                       
                   }else if($Data["from"]=="cbnaat"){
                       $rif=NULL;
                       $tbdignosed = "NULL";
                       if($Data["cbnaat_pstv"]=="Y"){
                           $rif=$Data["rif_value"];
                       }
                       $patientId = $Data["patient_id"];
                        $update=[
                           "is_cbnaat_done"=>($Data["cbnaat_test_date"]!=""?"Y":"N"),
                           "cbnaat_test_date"=>($Data["cbnaat_test_date"]!=""? date('Y-m-d', strtotime(str_replace('/', '-', $Data["cbnaat_test_date"]))):NULL),
                           "cbnaat_date"=>($Data["cbnaat_date"]!=""? date('Y-m-d', strtotime(str_replace('/', '-', $Data["cbnaat_date"]))):NULL),
                           "cbnaat_id"=>$Data["cbnaat_id"],
                           "cbnaat_pstv"=>$Data["cbnaat_pstv"],
                           "rif_value"=>$rif,
                           "is_tb_diagnosed"=>($Data["tbdignosed"]==""?NULL:$Data["tbdignosed"])
                        ];
                   }
                   $updt=$this->patientmodel->testObservationUpdate($update,$patientId) ;
                   
                   if($updt)
			{
				$json_response = array(
					"msg_status" => 1,
					"msg_data" => "Status updated"
				);
			}
			else
			{
				$json_response = array(
					"msg_status" => 0,
					"msg_data" => "Failed to update"
				);
			}
                        
                header('Content-Type: application/json');
		echo json_encode( $json_response );
		exit;
                }
               else
		{
			redirect('administratorpanel','refresh');
		}
                   
         }


                  public function patient_report()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['token']))
		{
			$header = "";
			if ($session['roleid']==9) {
				$where_dist = array('district.web_userid' => $session['userid'], );
				$rowDistrict=$this->commondatamodel->getSingleRowByWhereCls('district',$where_dist);
				$distwhere = array(
					'district.id' =>$rowDistrict->id,
					'district.is_active' => 1
				);

			 }else{
				$distwhere = ["district.is_active" => 1 ];
			 }

			
			
			$result['districtList'] = $this->commondatamodel->getAllRecordWhereOrderBy('district',$distwhere,'district.name'); 
			$page = "dashboard/adminpanel_dashboard/patient/patient_report_list_view.php";
			
			createbody_method($result, $page, $header, $session);
		}
		else
		{
			redirect('adminpanel','refresh');
		}
	}


	public function getBlock()
	{
		if($this->session->userdata('user_data'))
		{
				$block_ids = $this->input->post('blockids');


				$formData = $this->input->post('formDatas');
			parse_str($formData, $dataArry);
			$result=[];
			
			if (isset($dataArry['sel_dist'])) {
				$in_district = $dataArry['sel_dist'];
				

         $data['blockList'] = $this->locations->getAllBlockListINDistict($in_district);
			}else{

         $data['blockList'] = []; 
			}

    
      // pre($data['tuList']);
       $viewTemp = $this->load->view('dashboard/adminpanel_dashboard/patient/block_view',$data);
			echo $viewTemp;
		}
		else
		{
			redirect('login','refresh');
		}
	}


	public function getCoordinator()
	{
		if($this->session->userdata('user_data'))
		{
				$block_ids = $this->input->post('blockids');


				$formData = $this->input->post('formDatas');
			parse_str($formData, $dataArry);
			$result=[];
			
			if (isset($dataArry['sel_block'])) {
				$block_ids = $dataArry['sel_block'];
				

         $data['cordinatorList'] = $this->coordinator->getAllCoordinatorINblock($block_ids);
			}else{

         $data['cordinatorList'] = []; 
			}

    
      // pre($data['tuList']);
       $viewTemp = $this->load->view('dashboard/adminpanel_dashboard/patient/coordinator_view',$data);
			echo $viewTemp;
		}
		else
		{
			redirect('login','refresh');
		}
	}



public function getPatientReportList()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['token']))
		{
			$formData = $this->input->post('formDatas');
			parse_str($formData, $dataArry);
			$result=[];

			$from_dt = $dataArry['from_date'];
			if($from_dt!=""){
				$from_dt = str_replace('/', '-', $from_dt);
				$from_dt = date("Y-m-d",strtotime($from_dt));
			 }
			 else{
				 $from_dt = NULL;
			 }
			$to_date = $dataArry['to_date'];
			if($to_date!=""){
				$to_date = str_replace('/', '-', $to_date);
				$to_date = date("Y-m-d",strtotime($to_date));
			 }
			 else{
				 $to_date = NULL;
			 }
			


			  if (isset($dataArry['sel_dist']) && isset($dataArry['sel_block']) && isset($dataArry['sel_coordinator'])) {
			  			
			  			if (isset($dataArry['sel_coordinator'])) {
			  					$coordinator_ids = $dataArry['sel_coordinator'];
				                 $where='patient.group_cord_id';
				         $result['patientList'] = $this->patientmodel->getAllPatientReportBymultipleSelect($where,$coordinator_ids,$from_dt,$to_date);       
			  			}


			  }elseif (isset($dataArry['sel_dist']) && isset($dataArry['sel_block'])) {
			  			
			  			if (isset($dataArry['sel_block'])) {
			  					$block_ids = $dataArry['sel_block'];
				                 $where='patient.patient_block';
				         $result['patientList'] = $this->patientmodel->getAllPatientReportBymultipleSelect($where,$block_ids,$from_dt,$to_date);       
			  			}


			  }elseif (isset($dataArry['sel_dist'])) {
			  			
			  			if (isset($dataArry['sel_dist'])) {
			  					$district_ids = $dataArry['sel_dist'];
				                 $where='patient.patient_district';
				         $result['patientList'] = $this->patientmodel->getAllPatientReportBymultipleSelect($where,$district_ids,$from_dt,$to_date);       
			  			}


			  }
			  elseif(isset($dataArry['from_date']) && isset($dataArry['to_date'])){

			  	if ($session['roleid']==9) {
				$where_dist = array('district.web_userid' => $session['userid'], );
				$rowDistrict=$this->commondatamodel->getSingleRowByWhereCls('district',$where_dist);
				$whereAry = array('district.id' =>$rowDistrict->id);

			 }else{
				$whereAry = [];
			 }


			  	$result['patientList'] = $this->patientmodel->getAllPatientReportByDate($from_dt,$to_date,$whereAry);
			  }else{
			  	$result['patientList']=[];
			  }


			/*if (isset($dataArry['sel_dist'])) {
				$district_ids = $dataArry['sel_dist'];
				$where='patient.patient_district';
				
           
			}else{}
		      
            $result['patientList'] = $this->patientmodel->getAllPatientReportBymultipleSelect($where,$district_ids,$from_dt,$to_date); */
			
			$page = "dashboard/adminpanel_dashboard/patient/patient_report_data.php";
			$partial_view = $this->load->view($page,$result);
			echo $partial_view;
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}	

} //End of class