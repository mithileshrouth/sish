<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class diagnostic_report extends CI_Controller {
	public function __construct()
	{
	    parent::__construct();
		$this->load->library('session');
		$this->load->model('diagnostic_reportmodel','diagnosticreport',TRUE);
	}


	public function index()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['token']))
		{
			$header = "";
			$result['projectList'] = $this->commondatamodel->getAllRecordOrderBy('project','project.project','ASC');


	/* Role id 9: District Coordinator*/
			if ($session['roleid']==9) {  
				$where_dist = array('district.web_userid' => $session['userid'], );
				
				$result['distCoordinatorList']=$this->diagnosticreport->getDistrictCoordinatorbyRole($where_dist);
			 }else{
				$result['distCoordinatorList'] = $this->commondatamodel->getAllRecordOrderBy('district','district.id','ASC');
			 }
			


			$page = "dashboard/adminpanel_dashboard/diagnostic_report/diagnostic_report_list_view.php";
			createbody_method($result, $page, $header, $session);
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}

public function getBlockList()
	{
		if($this->session->userdata('user_data'))
		{
			$formData = $this->input->post('formDatas');
			parse_str($formData, $dataArry);
			$result=[];

			if (isset($dataArry['distcoordinator'])) {
				$distcoordinator_ids = $dataArry['distcoordinator'];
			$data['blockList'] = $this->diagnosticreport->getBlockListByMulDistCoordinator($distcoordinator_ids);
			}else{
			$data['blockList']=[];

			}

       $viewTemp = $this->load->view('dashboard/adminpanel_dashboard/diagnostic_report/block_view',$data);
			echo $viewTemp;
		}
		else
		{
			redirect('login','refresh');
		}
	}

public function getGroopCordinatorList()
	{
		if($this->session->userdata('user_data'))
		{
			$formData = $this->input->post('formDatas');
			parse_str($formData, $dataArry);
			$result=[];

			if (isset($dataArry['sel_block'])) {
				$block_ids = $dataArry['sel_block'];
			$data['groupcoordinatorList'] = $this->diagnosticreport->getGrpCoordListByMulBlock($block_ids);
			}else{
			$data['groupcoordinatorList']=[];

			}
       
       
       
       $viewTemp = $this->load->view('dashboard/adminpanel_dashboard/diagnostic_report/group_cordinator_view',$data);
			echo $viewTemp;
		}
		else
		{
			redirect('login','refresh');
		}
	}

public function getNqppList()
	{
		if($this->session->userdata('user_data'))
		{
			$formData = $this->input->post('formDatas');
			parse_str($formData, $dataArry);
			$result=[];

			if (isset($dataArry['grpcoordinator'])) {
				$grpcoordinator_ids = $dataArry['grpcoordinator'];
			$data['nqppList'] = $this->diagnosticreport->getNqppListByMulGrpCoord($grpcoordinator_ids);
			}else{
			$data['nqppList']=[];

			}
       
       
       
       $viewTemp = $this->load->view('dashboard/adminpanel_dashboard/diagnostic_report/nqpp_view',$data);
			echo $viewTemp;
		}
		else
		{
			redirect('login','refresh');
		}
	}

public function getDiagnosticReportList()
	{   $session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data'))
		{
			$formData = $this->input->post('formDatas');
			parse_str($formData, $dataArry);
			$result=[];

			$report_type = $dataArry['report_type'];
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

			  	if ($session['roleid']==9) {
				$where_dist = array('district.web_userid' => $session['userid'], );
				$rowDistrict=$this->commondatamodel->getSingleRowByWhereCls('district',$where_dist);
				$whereAry = array('district.id' =>$rowDistrict->id);

				 }else{
					$whereAry = [];
				 }

	if(isset($dataArry['distcoordinator']) && isset($dataArry['sel_block']) && isset($dataArry['grpcoordinator']) && isset($dataArry['sel_nqpp'])) {
		 			
		 	$nqpp_ids = $dataArry['sel_nqpp'];

			$wherein='nqpp.id';
			$data['reportList'] = $this->detailsCount($wherein,$nqpp_ids,$from_dt,$to_date,$whereAry,$report_type);
			 
	 }elseif (isset($dataArry['distcoordinator']) && isset($dataArry['sel_block']) && isset($dataArry['grpcoordinator'])) {

			 $grpcoordinator_ids = $dataArry['grpcoordinator'];
			 $wherein='coordinator.id';
			 $data['reportList'] = $this->detailsCount($wherein,$grpcoordinator_ids,$from_dt,$to_date,$whereAry,$report_type);

	
	 }elseif (isset($dataArry['distcoordinator']) && isset($dataArry['sel_block'])) {
			 
			 	$block_ids=$dataArry['sel_block'];
			 	$wherein='block.id';
			 	$data['reportList'] = $this->detailsCount($wherein,$block_ids,$from_dt,$to_date,$whereAry,$report_type);

	
	 }elseif (isset($dataArry['distcoordinator'])) {
			 	$distcoordinator_ids=$dataArry['distcoordinator'];
			 	$wherein='district.id';
			 	$data['reportList'] = $this->detailsCount($wherein,$distcoordinator_ids,$from_dt,$to_date,$whereAry,$report_type);
	
	}
	else{
			$data['reportList']=[];

		}

      // pre($data['reportList']);
     
      if ($report_type=='S') {

    	  $viewTemp = $this->load->view('dashboard/adminpanel_dashboard/diagnostic_report/report_list_data_summary',$data);
     
      }else{

     	  $viewTemp = $this->load->view('dashboard/adminpanel_dashboard/diagnostic_report/report_list_data_details',$data);
      }
       

			echo $viewTemp;
		}
		else
		{
			redirect('login','refresh');
		}
	}

function detailsCount($wherein,$selected_ids,$from_dt,$to_date,$whereAry,$report_type){
$data=[];

if ($report_type=="S") {
	

	$where_reg_date = "patient.patient_reg_date BETWEEN '".$from_dt."' AND '".$to_date."'";
	 $data['ptc_reg_count'] = $this->diagnosticreport->getPatientRegCount($wherein,$selected_ids,$where_reg_date,$whereAry);

	 $where_sputum_test_date = "patient.dmc_sputum_date BETWEEN '".$from_dt."' AND '".$to_date."'";
	 $data['sputum_count'] = $this->diagnosticreport->getPatientRegCount($wherein,$selected_ids,$where_sputum_test_date,$whereAry);

	 $where_xray_date = "patient.xray_date BETWEEN '".$from_dt."' AND '".$to_date."'";
	 $data['xray_count'] = $this->diagnosticreport->getPatientRegCount($wherein,$selected_ids,$where_xray_date,$whereAry);

	$where_cbnaat_test_date = "patient.cbnaat_date BETWEEN '".$from_dt."' AND '".$to_date."'";
	 $data['cbnaat_count'] = $this->diagnosticreport->getPatientRegCount($wherein,$selected_ids,$where_cbnaat_test_date,$whereAry);
	$where_diagnosed_date = "patient.patient_reg_date BETWEEN '".$from_dt."' AND '".$to_date."' and patient.is_tb_diagnosed='Y'";
	$data['diagnosed_count']=$this->diagnosticreport->getPatientRegCount($wherein,$selected_ids,$where_diagnosed_date,$whereAry);

	 $where_treatment_date = "patient.trtmnt_start_date BETWEEN '".$from_dt."' AND '".$to_date."'";
	 $data['treatment_count'] = $this->diagnosticreport->getPatientRegCount($wherein,$selected_ids,$where_cbnaat_test_date,$whereAry);
}else{
$data['reportbyblock'] = $this->diagnosticreport->getPatientListCountByblock($wherein,$selected_ids,$from_dt,$to_date,$whereAry);

}


return $data;
}


} //end of class