<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class payment_report extends CI_Controller {
	public function __construct()
	{
	    parent::__construct();
		$this->load->library('session');
		$this->load->model('paymentreportmodel','paymentreport',TRUE);
	}


	public function index()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['token']))
		{
			$header = "";
			$result['coordinatorList'] = $this->commondatamodel->getAllRecordOrderBy('coordinator','coordinator.name','ASC');
			$page = "dashboard/adminpanel_dashboard/payment_report/payment_list_view";
			createbody_method($result, $page, $header, $session);
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}

	public function getNqpp()
	{
		if($this->session->userdata('user_data'))
		{
				$coordinatorid = $this->input->post('coordinatorid');

       $data['nqppList'] = $this->paymentreport->getNqppListByCoordinator($coordinatorid);
       
       $viewTemp = $this->load->view('dashboard/adminpanel_dashboard/payment_report/nqpp_view',$data);
			echo $viewTemp;
		}
		else
		{
			redirect('login','refresh');
		}
	}

public function getPaymentList()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['token']))
		{
			$formData = $this->input->post('formDatas');
			parse_str($formData, $dataArry);

			$coordinator = trim(htmlspecialchars($dataArry['coordinator']));
			$nqpp = trim(htmlspecialchars($dataArry['sel_nqpp']));
			
		
			$result['coordinator'] = $coordinator;
			$result['nqpp'] = $nqpp;
			$result['paymentlistData'] = $this->paymentreport->getPaymentListByNqpp($nqpp);
		
			//pre($result['paymentlistData']);
			//exit;
			$page = "dashboard/adminpanel_dashboard/payment_report/payment_list_details_view";
			$partial_view = $this->load->view($page,$result);
			echo $partial_view;
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}



}// end of class