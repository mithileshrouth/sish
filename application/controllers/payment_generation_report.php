<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class payment_generation_report extends CI_Controller {
	public function __construct()
	{
	    parent::__construct();
		$this->load->library('session');
		$this->load->model('paymentreportmodel','paymentreport',TRUE);
		$this->load->model('paymentgenerationreportmodel','paymengentreport',TRUE);
	}


	public function index()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['token']))
		{
			$header = "";
			$result['coordinatorList'] = $this->commondatamodel->getAllRecordOrderBy('coordinator','coordinator.name','ASC');
			$page = "dashboard/adminpanel_dashboard/payment_generation_report/payment_generation_list_view";
			createbody_method($result, $page, $header, $session);
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}



public function getPaymentGenerationList()
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


			 if (isset($dataArry['coordinator']) && isset($dataArry['sel_nqpp'])) {
			 	
			 	$nqpp_ids = $dataArry['sel_nqpp'];
			    $wherein='payment_gen_master.nqpp_id';
			 	$result['paymentgenerationlistData']=$this->paymengentreport->getPaymentGenerationListBymultipleSelect($wherein,$nqpp_ids,$from_dt,$to_date);
			 }elseif (isset($dataArry['coordinator'])) {
			 	
			 	$coordinator_ids = $dataArry['coordinator'];
				$wherein='nqpp.coordinator_id';

			 	$result['paymentgenerationlistData']=$this->paymengentreport->getPaymentGenerationListBymultipleSelect($wherein,$coordinator_ids,$from_dt,$to_date);
			 
			 }elseif(isset($dataArry['from_date']) && isset($dataArry['to_date'])){
			 	
			 $result['paymentgenerationlistData'] = $this->paymengentreport->getPaymentGenerationListByGenerationDate($from_dt,$to_date);

			  }
			 else{
			 	
			 	$result['paymentgenerationlistData']=[];
			 }

			
			$page = "dashboard/adminpanel_dashboard/payment_generation_report/payment_generation_details_view";
			$partial_view = $this->load->view($page,$result);
			echo $partial_view;
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}

/* working progress... */
public function getNqppMultiple()
	{
		if($this->session->userdata('user_data'))
		{
			$formData = $this->input->post('formDatas');
			parse_str($formData, $dataArry);
			$result=[];

			if (isset($dataArry['coordinator'])) {
				$coordinator_ids = $dataArry['coordinator'];
			$data['nqppList'] = $this->paymentreport->getNqppListByMultipleCoordinator($coordinator_ids);
			}else{
			$data['nqppList']=[];

			}
       
       
       
       $viewTemp = $this->load->view('dashboard/adminpanel_dashboard/payment_report/nqpp_view_multiple',$data);
			echo $viewTemp;
		}
		else
		{
			redirect('login','refresh');
		}
	}

}// end of class