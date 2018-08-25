<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class payment_report extends CI_Controller {
	public function __construct()
	{
	    parent::__construct();
		$this->load->library('session');
		$this->load->model('paymentreportmodel','paymentreport',TRUE);
		$this->load->model('coordinatormodel','coordmodel',TRUE);
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
			$result['coordinatorList'] = $this->coordmodel->getAllCoordinatorByDistrict($whereAry);

			/*$result['coordinatorList'] = $this->commondatamodel->getAllRecordOrderBy('coordinator','coordinator.name','ASC');*/
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
			 	$result['paymentlistData']=$this->paymentreport->getPaymentListBymultipleSelect($wherein,$nqpp_ids,$from_dt,$to_date);
			 }elseif (isset($dataArry['coordinator'])) {
			 	
			 	$coordinator_ids = $dataArry['coordinator'];
				$wherein='nqpp.coordinator_id';

			 	$result['paymentlistData']=$this->paymentreport->getPaymentListBymultipleSelect($wherein,$coordinator_ids,$from_dt,$to_date);
			 
			 }elseif(isset($dataArry['from_date']) && isset($dataArry['to_date'])){

			 		if ($session['roleid']==9) {
						$where_dist = array('district.web_userid' => $session['userid'], );
						$rowDistrict=$this->commondatamodel->getSingleRowByWhereCls('district',$where_dist);
						$whereAry = array('district.id' =>$rowDistrict->id);

					 }else{
						$whereAry = [];
					 }
			 	
			  	$result['paymentlistData'] = $this->paymentreport->getPaymentListByPaymentDate($from_dt,$to_date,$whereAry);
			  }
			 else{
			 	
			 	$result['paymentlistData']=[];
			 }
			 
			$page = "dashboard/adminpanel_dashboard/payment_report/payment_list_details_view";
			$partial_view = $this->load->view($page,$result);
			echo $partial_view;
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}


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