<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class projetstatus_report extends CI_Controller {
	public function __construct()
	{
	    parent::__construct();
		$this->load->library('session');
		$this->load->model('projetstatus_reportmodel','projectreport',TRUE);
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
				
				$result['distCoordinatorList']=$this->projectreport->getDistrictCoordinatorbyRole($where_dist);
			 }else{
				$result['distCoordinatorList'] = $this->commondatamodel->getAllRecordOrderBy('district','district.id','ASC');
			 }
			


			$page = "dashboard/adminpanel_dashboard/project_report/project_list_view";
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
			$data['blockList'] = $this->projectreport->getBlockListByMulDistCoordinator($distcoordinator_ids);
			}else{
			$data['blockList']=[];

			}
       
       
       
       $viewTemp = $this->load->view('dashboard/adminpanel_dashboard/project_report/block_view',$data);
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
			$data['groupcoordinatorList'] = $this->projectreport->getGrpCoordListByMulBlock($block_ids);
			}else{
			$data['groupcoordinatorList']=[];

			}
       
       
       
       $viewTemp = $this->load->view('dashboard/adminpanel_dashboard/project_report/group_cordinator_view',$data);
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
			$data['nqppList'] = $this->projectreport->getNqppListByMulGrpCoord($grpcoordinator_ids);
			}else{
			$data['nqppList']=[];

			}
       
       
       
       $viewTemp = $this->load->view('dashboard/adminpanel_dashboard/project_report/nqpp_view',$data);
			echo $viewTemp;
		}
		else
		{
			redirect('login','refresh');
		}
	}

public function getProjectReportList()
	{   $session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data'))
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

			  	if ($session['roleid']==9) {
				$where_dist = array('district.web_userid' => $session['userid'], );
				$rowDistrict=$this->commondatamodel->getSingleRowByWhereCls('district',$where_dist);
				$whereAry = array('district.id' =>$rowDistrict->id);

				 }else{
					$whereAry = [];
				 }

	if(isset($dataArry['project']) && isset($dataArry['distcoordinator']) && isset($dataArry['sel_block']) && isset($dataArry['grpcoordinator']) && isset($dataArry['sel_nqpp'])) {
		 			
		 	$nqpp_ids = $dataArry['sel_nqpp'];

			$wherein='patient.nqpp_id';
			$data['projectReportList'] = $this->projectreport->getPatientCount($wherein,$nqpp_ids,$from_dt,$to_date,$whereAry);
			 
	 }elseif (isset($dataArry['project']) && isset($dataArry['distcoordinator']) && isset($dataArry['sel_block']) && isset($dataArry['grpcoordinator'])) {

			 $grpcoordinator_ids = $dataArry['grpcoordinator'];
			 $wherein='coordinator.id';
			 $data['projectReportList'] = $this->projectreport->getPatientCount($wherein,$grpcoordinator_ids,$from_dt,$to_date,$whereAry);

	
	 }elseif (isset($dataArry['project']) && isset($dataArry['distcoordinator']) && isset($dataArry['sel_block'])) {
			 
			 	$block_ids=$dataArry['sel_block'];
			 	$wherein='block.id';
			 	$data['projectReportList'] = $this->projectreport->getPatientCount($wherein,$block_ids,$from_dt,$to_date,$whereAry);

	
	 }elseif (isset($dataArry['project']) && isset($dataArry['distcoordinator'])) {
			 	$distcoordinator_ids=$dataArry['distcoordinator'];
			 	$wherein='district.id';
			 	$data['projectReportList'] = $this->projectreport->getPatientCount($wherein,$distcoordinator_ids,$from_dt,$to_date,$whereAry);
	
	}elseif (isset($dataArry['project'])) {

			 	$project_ids=$dataArry['project'];
			 	$wherein='project.id';
			 	$data['projectReportList'] = $this->projectreport->getPatientCount($wherein,$project_ids,$from_dt,$to_date,$whereAry);
			 }
	else{
			$data['projectReportList']=[];

		}

       
       $viewTemp = $this->load->view('dashboard/adminpanel_dashboard/project_report/project_list_data',$data);
			echo $viewTemp;
		}
		else
		{
			redirect('login','refresh');
		}
	}



}//end of class