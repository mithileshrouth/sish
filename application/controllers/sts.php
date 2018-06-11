<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class sts extends CI_Controller {
	public function __construct()
	{
	    parent::__construct();
		$this->load->library('session');
		$this->load->model('stsmodel','sts',TRUE);
	}
	
	
	public function index()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['token']))
		{
			$header = "";
			$result['stsList'] = $this->sts->getAllSTS(); 
			$page = "dashboard/adminpanel_dashboard/sts/sts_list_view";
			createbody_method($result, $page, $header, $session);
		}
		else
		{
			redirect('adminpanel','refresh');
		}
	}

	public function addsts()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['token']))
		{
			if ($this->uri->segment(3) === FALSE)
			{
				$result['mode'] = "ADD";
				$result['btnText'] = "Save";
				$result['btnTextLoader'] = "Saving...";
				$stsID = 0;
				$result['stsEditdata'] = [];
				
				//getAllRecordWhereOrderBy($table,$where,$orderby)
				
				
			
			}
			else
			{
				$result['mode'] = "EDIT";
				$result['btnText'] = "Update";
				$result['btnTextLoader'] = "Updating...";
				$stsID = $this->uri->segment(3);
				$whereAry = array(
					'sts.id' => $stsID
				);
				// getSingleRowByWhereCls(tablename,where params)
				$result['stsEditdata'] = $this->commondatamodel->getSingleRowByWhereCls('sts',$whereAry); 
				
			}

			$header = "";
			$tuwhere = [
				"tu_unit.is_active" => 1 
				];
			//getAllRecordWhereOrderBy($table,$where,$orderby)
			$result['tuList'] = $this->commondatamodel->getAllRecordWhereOrderBy('tu_unit',$tuwhere,'tu_unit.name'); 
			
			$page = "dashboard/adminpanel_dashboard/sts/sts_add_edit_view";
			createbody_method($result, $page, $header,$session);
		}
		else
		{
			redirect('adminpanel','refresh');
		}
	}

	public function sts_action()
	{
		
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['token']))
		{
			$json_response = array();
			$formData = $this->input->post('formDatas');
			parse_str($formData, $dataArry);
			
			
			
			$stsID = trim(htmlspecialchars($dataArry['stsID']));
			$mode = trim(htmlspecialchars($dataArry['mode']));

			$tuID = trim(htmlspecialchars($dataArry['seltu']));
			$stsname = trim(htmlspecialchars($dataArry['stsname']));
			$stsmobile = trim(htmlspecialchars($dataArry['stsmobile']));
			


			if($tuID!="0" && $stsname!="" && $stsmobile!="")
			{
	
				
				
				if($stsID>0 && $mode=="EDIT")
				{
					/*  EDIT MODE
					 *	-----------------
					*/

					$array_upd = array(
						"name" => $stsname,
						"mobile" => $stsmobile,
						"tu_id" => $tuID,
						"created_by" => $session['userid']
					
					);

					$where_upd = array(
						"sts.id" => $stsID
					);

					$user_activity = array(
						"activity_module" => 'STS',
						"action" => 'Update',
						"from_method" => 'sts/sts_action',
						"user_id" => $session['userid'],
						"ip_address" => getUserIPAddress(),
						"user_browser" => getUserBrowserName(),
						"user_platform" => getUserPlatform()
					 );


					/*
					@updateData_WithUserActivity('update table name','update table data','update table where condition','user activity table name','user activity table data');
					*/
					$update = $this->commondatamodel->updateData_WithUserActivity('sts',$array_upd,$where_upd,'activity_log',$user_activity);
					
					
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
						"name" => $stsname,
						"mobile" => $stsmobile,
						"tu_id" => $tuID,
						"is_active" => 1,
						"created_by" => $session['userid']
					);
					
					
	
					$user_activity = array(
						"activity_module" => 'STLS',
						"action" => 'Insert',
						"from_method" => 'sts/sts_action',
						"user_id" => $session['userid'],
						"ip_address" => getUserIPAddress(),
						"user_browser" => getUserBrowserName(),
						"user_platform" => getUserPlatform()
						
					 );

						
					$tbl_name = array('sts','activity_log');
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
				"sts.id" => $updID
				);
			
			
			$user_activity = array(
					"activity_module" => 'STS',
					"action" => "Update",
					"from_method" => "sts/setStatus",
					"user_id" => $session['userid'],
					"ip_address" => getUserIPAddress(),
					"user_browser" => getUserBrowserName(),
					"user_platform" => getUserPlatform()
					
					
				);
				$update = $this->commondatamodel->updateData_WithUserActivity('sts',$update_array,$where,'activity_log',$user_activity);
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


	
	

}
?>