<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class smsconfig extends CI_Controller {
	public function __construct()
	{
	    parent::__construct();
		$this->load->library('session');
		$this->load->model('smsconfigmodel','smsconfigmodel',TRUE);
	}

	public function index()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['token']))
		{
			$header = "";
			

			$result['smsactionList'] = $this->smsconfigmodel->getAllSmsActionRolewiseDetails();
			//pre($result['smsactionList']);
			//exit;
			$page = "dashboard/adminpanel_dashboard/sms/sms_list_view";
			createbody_method($result, $page, $header, $session);
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}


public function addsms()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['token']))
		{
			if ($this->uri->segment(3) === FALSE)
			{
				$result['mode'] = "ADD";
				$result['btnText'] = "Save";
				$result['btnTextLoader'] = "Saving...";
				$dmcID = 0;
				$result['smsEditdata'] = [];
				
				//getAllRecordWhereOrderBy($table,$where,$orderby)
				
				
			
			}
			else
			{
				$result['mode'] = "EDIT";
				$result['btnText'] = "Update";
				$result['btnTextLoader'] = "Updating...";
				$smsID = $this->uri->segment(3);
			
				// getSingleRowByWhereCls(tablename,where params)
				$result['smsEditdata'] = $this->smsconfigmodel->getSMSEditDataByRoleID($smsID); 
				$result['smsphaseid']=$smsID;
			
				
			}

			$header = "";
					$result['smsnameList'] = $this->commondatamodel->getAllRecordOrderBy('sms_action_master','sms_action_master.id','ASC');

			$result['roleList'] = $this->smsconfigmodel->getAllRoll();

			//pre($result['smsEditdata']);//exit;
			
				$page = "dashboard/adminpanel_dashboard/sms/sms_add_edit_view";
			createbody_method($result, $page, $header,$session);
		}
		else
		{
			redirect('adminpanel','refresh');
		}
	}


	public function sms_action()
	{
		
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['token']))
		{
			$json_response = array();
			$formData = $this->input->post('formDatas');
			parse_str($formData, $dataArry);
			
			
			
			$smsID = trim(htmlspecialchars($dataArry['smsID']));
			$mode = trim(htmlspecialchars($dataArry['mode']));
			$smsphase = trim(htmlspecialchars($dataArry['smsphase']));
			$sel_role = $dataArry['sel_role'];
		

	//exit;
				
				

				$delete=$this->smsconfigmodel->deleteSmsRolewiseActionDetails($smsphase);
				foreach ($sel_role as $key => $value) {		
				$array_insert = array(
						"sms_action_id" => $smsphase,
						"send_to_roleid" => $value,
						
					);
					
					
					$user_activity = array(
						"activity_module" => 'SMS',
						"action" => 'Insert',
						"from_method" => 'smsconfig/sms_action',
						"user_id" => $session['userid'],
						"ip_address" => getUserIPAddress(),
						"user_browser" => getUserBrowserName(),
						"user_platform" => getUserPlatform()
						
					 );

						
					$tbl_name = array('sms_action_rolewise_detail','activity_log');
					$insert_array = array($array_insert,$user_activity);
					$insertData = $this->commondatamodel->insertMultiTableData($tbl_name,$insert_array);

				} //end of foreach

					if($insertData)
					{
						$json_response = array(
							"msg_status" => 1,
							"msg_data" => "Saved successfully",
							"mode" => "ADD"
						);
					}
					else
					{
						$json_response = array(
							"msg_status" => 1,
							"msg_data" => "There is some problem.Try again"
						);
					}





			

			header('Content-Type: application/json');
			echo json_encode( $json_response );
			exit;

			

		}
		else
		{
			redirect('adminpanel','refresh');
		}
	}


}// end of class