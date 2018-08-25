<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class stls extends CI_Controller {
	public function __construct()
	{
	    parent::__construct();
		$this->load->library('session');
		$this->load->model('stlsmodel','stls',TRUE);
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
				$distwhere = array(
					'district.id' =>$rowDistrict->id,
					
				);
				
			 }else{
				$distwhere = [];
			
			 }
			$result['stlsList'] = $this->stls->getAllSTLSbyRoll($distwhere); 
			$page = "dashboard/adminpanel_dashboard/stls/stls_list_view";
			createbody_method($result, $page, $header, $session);
		}
		else
		{
			redirect('adminpanel','refresh');
		}
	}

	public function addstls()
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
				$result['stlsEditdata'] = [];
				
				//getAllRecordWhereOrderBy($table,$where,$orderby)
				
				
			
			}
			else
			{
				$result['mode'] = "EDIT";
				$result['btnText'] = "Update";
				$result['btnTextLoader'] = "Updating...";
				$stlsID = $this->uri->segment(3);
				$whereAry = array(
					'stls.id' => $stlsID
				);
				// getSingleRowByWhereCls(tablename,where params)
				$result['stlsEditdata'] = $this->commondatamodel->getSingleRowByWhereCls('stls',$whereAry); 
				
			}

			$header = "";
			/* Role id 9: District Coordinator*/
			if ($session['roleid']==9) {
				$where_dist = array('district.web_userid' => $session['userid'], );
				$rowDistrict=$this->commondatamodel->getSingleRowByWhereCls('district',$where_dist);
				$distwhere = array(
					'district.id' =>$rowDistrict->id,
					'tu_unit.is_active' => 1 
				);
				
			 }else{
				$distwhere = [];
			
			 }
			
			$result['tuList'] = $this->stls->getAllTUListbyDist($distwhere); 
			
			$page = "dashboard/adminpanel_dashboard/stls/stls_add_edit_view";
			createbody_method($result, $page, $header,$session);
		}
		else
		{
			redirect('adminpanel','refresh');
		}
	}

	public function stls_action()
	{
		
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['token']))
		{
			$json_response = array();
			$formData = $this->input->post('formDatas');
			parse_str($formData, $dataArry);
			
			
			
			$stlsID = trim(htmlspecialchars($dataArry['stlsID']));
			$mode = trim(htmlspecialchars($dataArry['mode']));

			$tuID = trim(htmlspecialchars($dataArry['seltu']));
			$stlsname = trim(htmlspecialchars($dataArry['stlsname']));
			$stlsmobile = trim(htmlspecialchars($dataArry['stlsmobile']));
			


			if($tuID!="0" && $stlsname!="" && $stlsmobile!="")
			{
	
				
				
				if($stlsID>0 && $mode=="EDIT")
				{
					/*  EDIT MODE
					 *	-----------------
					*/

					$array_upd = array(
						"name" => $stlsname,
						"mobile" => $stlsmobile,
						"tu_id" => $tuID,
						"created_by" => $session['userid']
					
					);

					$where_upd = array(
						"stls.id" => $stlsID
					);

					$user_activity = array(
						"activity_module" => 'STLS',
						"action" => 'Update',
						"from_method" => 'stls/stls_action',
						"user_id" => $session['userid'],
						"ip_address" => getUserIPAddress(),
						"user_browser" => getUserBrowserName(),
						"user_platform" => getUserPlatform()
					 );


					/*
					@updateData_WithUserActivity('update table name','update table data','update table where condition','user activity table name','user activity table data');
					*/
					$update = $this->commondatamodel->updateData_WithUserActivity('stls',$array_upd,$where_upd,'activity_log',$user_activity);
					
					
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
						"name" => $stlsname,
						"mobile" => $stlsmobile,
						"tu_id" => $tuID,
						"is_active" => 1,
						"created_by" => $session['userid']
					);
					
					
	
					$user_activity = array(
						"activity_module" => 'STLS',
						"action" => 'Insert',
						"from_method" => 'stls/stls_action',
						"user_id" => $session['userid'],
						"ip_address" => getUserIPAddress(),
						"user_browser" => getUserBrowserName(),
						"user_platform" => getUserPlatform()
						
					 );

						
					$tbl_name = array('stls','activity_log');
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
				"stls.id" => $updID
				);
			
			
			$user_activity = array(
					"activity_module" => 'STLS',
					"action" => "Update",
					"from_method" => "stls/setStatus",
					"user_id" => $session['userid'],
					"ip_address" => getUserIPAddress(),
					"user_browser" => getUserBrowserName(),
					"user_platform" => getUserPlatform()
					
					
				);
				$update = $this->commondatamodel->updateData_WithUserActivity('stls',$update_array,$where,'activity_log',$user_activity);
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




public function checkmobile(){

		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['token']))
		{
			$mobile = trim($this->input->post('mobile'));
			$oldmobile = trim($this->input->post('oldmobile'));
			$mode = trim($this->input->post('mode'));

			if($mode=='ADD'){
					$where = array('stls.mobile' => $mobile);
					
					$result = $this->commondatamodel->checkExistanceData('stls',$where);
					
					if($result)
					{
						$json_response = array(
							"msg_status" => 1,
							"msg_data" => "This mobile number already registered."
						);
					}
					else
					{
						$json_response = array(
							"msg_status" => 0,
							"msg_data" => "available"
						);
					}

				}else{


						if ($mobile!=$oldmobile) {

									$where = array('stls.mobile' => $mobile);
									
									$result = $this->commondatamodel->checkExistanceData('stls',$where);
									
									if($result)
									{
										$json_response = array(
											"msg_status" => 1,
											"msg_data" => "This mobile number already registered."
										);
									}
									else
									{
										$json_response = array(
											"msg_status" => 0,
											"msg_data" => "available"
										);
									}



							
						}else{

									$json_response = array(
									"msg_status" => 0,
									"msg_data" => "available"
								);


						}

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