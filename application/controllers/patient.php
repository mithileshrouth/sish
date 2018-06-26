<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class patient extends CI_Controller {
	public function __construct()
	{
	    parent::__construct();
		$this->load->library('session');
		$this->load->model('patientmodel','patientmodel',TRUE);
	}

	public function index()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['token']))
		{
			$header = "";
			$whereAry = array();
			$result['patientList'] = $this->patientmodel->getAllPatient(); 
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

} //End of class