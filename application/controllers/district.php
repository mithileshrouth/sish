<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class district extends CI_Controller {
	public function __construct()
	{
	    parent::__construct();
		$this->load->library('session');
		$this->load->model('locationmodel','locations',TRUE);
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
			$result['districtList'] = $this->locations->getAllDistrictListbyRole($whereAry); 
			$page = "dashboard/adminpanel_dashboard/district/district_list_view";
			createbody_method($result, $page, $header, $session);
			
		}
		else
		{
			redirect('adminpanel','refresh');
		}
	}


	public function adddistrict()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['token']))
		{
			if ($this->uri->segment(3) === FALSE)
			{
				$result['mode'] = "ADD";
				$result['btnText'] = "Save";
				$result['btnTextLoader'] = "Saving...";
				$blockID = 0;
				$result['DistrictEditdata'] = [];
				
				//getAllRecordWhereOrderBy($table,$where,$orderby)
				
				
			
			}
			else
			{
				$result['mode'] = "EDIT";
				$result['btnText'] = "Update";
				$result['btnTextLoader'] = "Updating...";
				$districtID = $this->uri->segment(3);
				$whereAry = array(
					'district.id' => $districtID
				);
				// getSingleRowByWhereCls(tablename,where params)
			//	$result['DistrictEditdata'] = $this->commondatamodel->getSingleRowByWhereCls('district',$whereAry); 
					$result['DistrictEditdata'] = $this->locations->getDistrictEditDataByID($districtID); 
				
			}

			$header = "";
			$distwhere = [
				"state.is_active" => 1 
				];
			$result['stateList'] = $this->commondatamodel->getAllRecordWhereOrderBy('state',$distwhere,'state.state'); 
			
			$page = "dashboard/adminpanel_dashboard/district/district_add_edit_view";
			createbody_method($result, $page, $header,$session);
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}


	public function district_action()
	{
		
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['token']))
		{
			$json_response = array();
			$formData = $this->input->post('formDatas');
			parse_str($formData, $dataArry);
			
			
			
			$districtID = trim(htmlspecialchars($dataArry['districtID']));
			$stateID = trim(htmlspecialchars($dataArry['state']));
			$mode = trim(htmlspecialchars($dataArry['mode']));
			$district = trim(htmlspecialchars($dataArry['districtname']));
			$dist_code = trim(htmlspecialchars($dataArry['districtcode']));
			
			$distcoordinator = trim(htmlspecialchars($dataArry['distcoordinator']));
			$distcoordinatormbl = trim(htmlspecialchars($dataArry['distcoordinatormbl']));
			$distcoordinatorpassword = trim(htmlspecialchars($dataArry['distcoordinatorpassword']));
			
			

			
			if($stateID!="0" && $district!="" && $distcoordinator!="" && $distcoordinatormbl!="")
			{
	
				
				
				if($districtID>0 && $mode=="EDIT")
				{
					/*  EDIT MODE
					 *	-----------------
					*/
					
					$update = $this->locations->updateDistrict($dataArry,$session);
					
					
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

					$insertData = $this->locations->insertIntoDistrict($dataArry,$session);

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
				"district.id" => $updID
				);
			
			
			$user_activity = array(
					"activity_module" => 'District',
					"action" => "Update",
					"from_method" => "district/setStatus",
					"user_id" => $session['userid'],
					"ip_address" => getUserIPAddress(),
					"user_browser" => getUserBrowserName(),
					"user_platform" => getUserPlatform()
					
					
				);
				$update = $this->commondatamodel->updateData_WithUserActivity('district',$update_array,$where,'activity_log',$user_activity);
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
			redirect('administratorpanel','refresh');
		}
	}

}//end of class
	