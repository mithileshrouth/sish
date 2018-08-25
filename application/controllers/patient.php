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