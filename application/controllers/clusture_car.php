<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class clusture_car extends CI_Controller {
	public function __construct()
	{
	    parent::__construct();
		$this->load->library('session');
		$this->load->model('clusture_carmodel','clusturecar',TRUE);
	}


	public function index()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['token']))
		{
			$header = "";
			$result['carclusterList'] = $this->clusturecar->getAllClustureCarList(); 
			$page = "dashboard/adminpanel_dashboard/clusture_car/clusture_car_list_view";
			createbody_method($result, $page, $header, $session);
			
		}
		else
		{
			redirect('adminpanel','refresh');
		}
	}

public function addclusturecar()
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
				$result['clusturecarEditdata'] = [];
				
				
			
			}
			else
			{
				$result['mode'] = "EDIT";
				$result['btnText'] = "Update";
				$result['btnTextLoader'] = "Updating...";
				$CCID = $this->uri->segment(3);
				$whereAry = array(
					'clusture_car.id' => $CCID
				);
				// getSingleRowByWhereCls(tablename,where params)
				$result['clusturecarEditdata'] = $this->commondatamodel->getSingleRowByWhereCls('clusture_car',$whereAry); 
				
			}
			//pre($result['symptomsEditdata']);exit;
			$header = "";

			$page = "dashboard/adminpanel_dashboard/clusture_car/clusture_car_add_edit_view";
			createbody_method($result, $page, $header,$session);
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}

public function clusturecar_action()
	{
		
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['token']))
		{
			$json_response = array();
			$formData = $this->input->post('formDatas');
			parse_str($formData, $dataArry);
			
			
			
			$CCID = trim(htmlspecialchars($dataArry['CCID']));
			$mode = trim(htmlspecialchars($dataArry['mode']));
		
			$carclusture = trim(htmlspecialchars($dataArry['carclusture']));


			if($carclusture!="")
			{
	
				
				
				if($CCID>0 && $mode=="EDIT")
				{
					/*  EDIT MODE
					 *	-----------------
					*/

					$array_upd = array(
						"name" => $carclusture
					);

					$where_upd = array(
						"clusture_car.id" => $CCID
					);

					$user_activity = array(
						"activity_module" => 'Carclusture',
						"action" => 'Update',
						"from_method" => 'clusture_car/clusturecar_action',
						"user_id" => $session['userid'],
						"ip_address" => getUserIPAddress(),
						"user_browser" => getUserBrowserName(),
						"user_platform" => getUserPlatform()
					 );


					/*
					@updateData_WithUserActivity('update table name','update table data','update table where condition','user activity table name','user activity table data');
					*/
					$update = $this->commondatamodel->updateData_WithUserActivity('clusture_car',$array_upd,$where_upd,'activity_log',$user_activity);
					
					
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
						"name" => $carclusture,
						"is_active" => 1,
						"created_by" => $session['userid']
					);
					
					
	
					$user_activity = array(
						"activity_module" => 'Carclusture',
						"action" => 'Insert',
						"from_method" => 'clusture_car/clusturecar_action',
						"user_id" => $session['userid'],
						"ip_address" => getUserIPAddress(),
						"user_browser" => getUserBrowserName(),
						"user_platform" => getUserPlatform()
						
					 );

						
					$tbl_name = array('clusture_car','activity_log');
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
				"clusture_car.id" => $updID
				);
			
			
			$user_activity = array(
					"activity_module" => 'Carclusture',
					"action" => "Update",
					"from_method" => "clusture_car/setStatus",
					"user_id" => $session['userid'],
					"ip_address" => getUserIPAddress(),
					"user_browser" => getUserBrowserName(),
					"user_platform" => getUserPlatform()
					
					
				);
		
				$update = $this->commondatamodel->updateData_WithUserActivity('clusture_car',$update_array,$where,'activity_log',$user_activity);
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

} // end of class