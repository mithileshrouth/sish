<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class incentive extends CI_Controller {
	public function __construct()
	{
	    parent::__construct();
		$this->load->library('session');
		$this->load->model('incentivemodel','incent',TRUE);
		$this->load->model('smsconfigmodel','smscon',TRUE);
	}


	public function index()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['token']))
		{
			$header = "";
			$result['incentiveList'] = $this->incent->getAllIncentiveList(); 
			$page = "dashboard/adminpanel_dashboard/incentive/incentive_list_view";
			createbody_method($result, $page, $header, $session);
			
		}
		else
		{
			redirect('adminpanel','refresh');
		}
	}


	public function addIncentive()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['token']))
		{
			if ($this->uri->segment(3) === FALSE)
			{
				$result['mode'] = "ADD";
				$result['btnText'] = "Save";
				$result['btnTextLoader'] = "Saving...";
				$OTID = 0;
				$result['incentiveEditdata'] = [];
				
				
			
			}
			else
			{
				$result['mode'] = "EDIT";
				$result['btnText'] = "Update";
				$result['btnTextLoader'] = "Updating...";
				$IncentiveID = $this->uri->segment(3);
				$whereAry = array(
					'incentive.id' => $IncentiveID
				);
				// getSingleRowByWhereCls(tablename,where params)
				$result['incentiveEditdata'] = $this->commondatamodel->getSingleRowByWhereCls('incentive',$whereAry); 
				
			}
			
			$header = "";
			$result['roleList'] = $this->incent->getAllRoll(); 
			$page = "dashboard/adminpanel_dashboard/incentive/incentive_add_edit_view";
			createbody_method($result, $page, $header,$session);
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}

public function incentive_action()
	{
		
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['token']))
		{
			$json_response = array();
			$formData = $this->input->post('formDatas');
			parse_str($formData, $dataArry);
			
			
			
			$IncentiveID = trim(htmlspecialchars($dataArry['IncentiveID']));
			$mode = trim(htmlspecialchars($dataArry['mode']));
		
			$sel_role = trim(htmlspecialchars($dataArry['sel_role']));
			$amount = trim(htmlspecialchars($dataArry['amount']));


			if($sel_role!="" && $amount!="")
			{
	
				
				
				if($IncentiveID>0 && $mode=="EDIT")
				{
					/*  EDIT MODE
					 *	-----------------
					*/

					$array_upd = array(
						"amount" => $amount
					);

					$where_upd = array(
						"incentive.id" => $IncentiveID
					);

					$user_activity = array(
						"activity_module" => 'Incentive',
						"action" => 'Update',
						"from_method" => 'incentive/incentive_action',
						"user_id" => $session['userid'],
						"ip_address" => getUserIPAddress(),
						"user_browser" => getUserBrowserName(),
						"user_platform" => getUserPlatform()
					 );


					/*
					@updateData_WithUserActivity('update table name','update table data','update table where condition','user activity table name','user activity table data');
					*/
					$update = $this->commondatamodel->updateData_WithUserActivity('incentive',$array_upd,$where_upd,'activity_log',$user_activity);
					
					
					if($update)
					{
						$json_response = array(
							"msg_status" => 1,
							"msg_data" => "Updated successfully",
							"mode" => "EDIT"
						);
					}
					else
					{
						$json_response = array(
							"msg_status" => 0,
							"msg_data" => "There is some problem while updating ...Please try again."
						);
					}



				} // end if mode
				else
				{
					/*  ADD MODE
					 *	-----------------
					*/


					$array_insert = array(
						"role_id" => $sel_role,
						"amount" => $amount,
						"is_active" => 1
						
					);
					
					
	
					$user_activity = array(
						"activity_module" => 'Incentive',
						"action" => 'Insert',
						"from_method" => 'incentive/incentive_action',
						"user_id" => $session['userid'],
						"ip_address" => getUserIPAddress(),
						"user_browser" => getUserBrowserName(),
						"user_platform" => getUserPlatform()
						
					 );

						
					$tbl_name = array('incentive','activity_log');
					$insert_array = array($array_insert,$user_activity);
					$insertData = $this->commondatamodel->insertMultiTableData($tbl_name,$insert_array);

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

				} // end add mode ELSE PART




				

			}
			else
			{
				$json_response = array(
						"msg_status" =>0,
						"msg_data" => "All fields are required"
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

	public function setStatus(){
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['token']))
		{
			$updID = trim($this->input->post('uid'));
			$setstatus = trim($this->input->post('setstatus'));
			
			$update_array  = array(
				"is_active" => $setstatus
				);
				
			$where = array(
				"incentive.id" => $updID
				);
			
			
			$user_activity = array(
					"activity_module" => 'Incentive',
					"action" => "Update",
					"from_method" => "incentive/setStatus",
					"user_id" => $session['userid'],
					"ip_address" => getUserIPAddress(),
					"user_browser" => getUserBrowserName(),
					"user_platform" => getUserPlatform()
					
					
				);
				$update = $this->commondatamodel->updateData_WithUserActivity('incentive',$update_array,$where,'activity_log',$user_activity);
			if($update)
			{
				$json_response = array(
					"msg_status" => 1,
					"msg_data" => "Status updated"
				);
			}
			else
			{
				$json_response = array(
					"msg_status" => 0,
					"msg_data" => "Failed to update"
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
}//end of class