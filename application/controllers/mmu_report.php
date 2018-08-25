<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mmu_report extends CI_Controller {
	public function __construct()
	{
	    parent::__construct();
		$this->load->library('session');
		$this->load->model('mmu_reportmodel','mmureport',TRUE);
	}


	public function index()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['token']))
		{
			$header = "";
			$result['grCoordinatorList'] = $this->commondatamodel->getAllRecordOrderBy('coordinator','coordinator.name','ASC');
			$result['clusturecarList'] = $this->commondatamodel->getAllRecordOrderBy('clusture_car','clusture_car.name','ASC');


			$page = "dashboard/adminpanel_dashboard/mmu_report/mmu_report_list_view.php";
			createbody_method($result, $page, $header, $session);
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}

public function getMMUReportList()
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

			

	if (isset($dataArry['clustercar']) && isset($dataArry['grpcoordinator'])) {
			 	$clustercar=$dataArry['clustercar'];
			 	$grpcoordinator_ids=$dataArry['grpcoordinator'];
			 	$wherein='mmu_shis.grpcord_id';
			 	$data['reportList'] = $this->mmureport->getAllMMUReportByCoordinator($wherein,$grpcoordinator_ids,$clustercar,$from_dt,$to_date);
	
	}elseif (isset($dataArry['clustercar'])) {
		$clustercar=$dataArry['clustercar'];
		$data['reportList'] = $this->mmureport->getAllMMUReport($clustercar,$from_dt,$to_date);
	}
	else{
			$data['reportList']=[];

		}

      
  
      

    	  $viewTemp = $this->load->view('dashboard/adminpanel_dashboard/mmu_report/mmu_list_data_summary',$data);
     
   
       

			echo $viewTemp;
		}
		else
		{
			redirect('login','refresh');
		}
	}

}// end of class