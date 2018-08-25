<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class eye_record extends CI_Controller {
	public function __construct()
	{
	    parent::__construct();
		$this->load->library('session');
		$this->load->model('eye_recordmodel','eye_record',TRUE);
	}


	public function index()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['token']))
		{
			$header = "";
			$result['grCoordinatorList'] = $this->commondatamodel->getAllRecordOrderBy('coordinator','coordinator.name','ASC');
			$result['clusturecarList'] = $this->commondatamodel->getAllRecordOrderBy('clusture_car','clusture_car.name','ASC');


			$page = "dashboard/adminpanel_dashboard/eye_record/eye_record_list_view.php";
			createbody_method($result, $page, $header, $session);
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}

public function getEyeRecordList()
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
			 	$wherein='shis_eye_record.grpcord_id';
			 	$data['recordList'] = $this->eye_record->getAllEyeRecordByCoordinator($wherein,$grpcoordinator_ids,$clustercar,$from_dt,$to_date);
	
	}
	elseif (isset($dataArry['clustercar'])) {
		$clustercar=$dataArry['clustercar'];
		$data['recordList'] = $this->eye_record->getAllEyeRecord($clustercar,$from_dt,$to_date);
	}
	else{
		
	$data['recordList']=[];

	}

     
  
     

    	  $viewTemp = $this->load->view('dashboard/adminpanel_dashboard/eye_record/eye_record_list_data',$data);
     
   
       

			echo $viewTemp;
		}
		else
		{
			redirect('login','refresh');
		}
	}

}// end of class