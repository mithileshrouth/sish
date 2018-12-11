<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class dashboard extends CI_Controller 
{
	public function __construct()
	{
	   parent::__construct();
	   $this->load->library('session');
	   $this->load->model('dashboardmodel','dashboardmodel',TRUE);
		
	}
		
	public function index()
	{
		if($this->session->userdata('user_data'))
		{
			$session = $this->session->userdata('user_data');
			$page = 'dashboard/adminpanel_dashboard/ds-home/dashboard-home';
			$result = "";
			$header = "";
			$result['patient']=$this->commondatamodel->rowcount('patient');
// changed on 11/12/18 by sandipan sarkar //
			$result['nqpp']=$this->dashboardmodel->nqppCountWithBlockIdNotNull('nqpp','block_id');
			$result['coordinator']=$this->commondatamodel->rowcount('coordinator');
			$result['is_tb_diagnosed']=$this->dashboardmodel->TBDiagnosedRowCount('patient','is_tb_diagnosed');

			createbody_method($result, $page, $header, $session);
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
		
	}

 
}