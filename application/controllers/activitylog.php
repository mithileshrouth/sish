<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class activitylog extends CI_Controller {
	public function __construct()
	{
	    parent::__construct();
		$this->load->library('session');
		$this->load->model('activitylogmodel','activitylogmodel',TRUE);
	}
	
	
	public function index()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['token']))
		{
			$header = "";
			$result['activityList'] = $this->activitylogmodel->getAllActivitylog(); 
			

			$page = "dashboard/adminpanel_dashboard/activity_log/activity_log_view";
			createbody_method($result, $page, $header, $session);
			
		}
		else
		{
			redirect('adminpanel','refresh');
		}
	}

}// end of class