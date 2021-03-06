<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class coordinator extends CI_Controller {
	public function __construct()
	{
	    parent::__construct();
		$this->load->library('session');
		$this->load->model('coordinatormodel','coordinator',TRUE);
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
				$distwhere = array(
					'district.id' =>$rowDistrict->id,
					'district.is_active' => 1
				);

			 }else{
				$distwhere = ["district.is_active" => 1 ];
				$where_dist=[];
			 }
			
			/*$result['districtList'] = $this->commondatamodel->getAllRecordWhereOrderBy('district',$distwhere,'district.name');
			$distwhere = [
				"district.is_active" => 1 
				];*/
			$result['districtList'] = $this->commondatamodel->getAllRecordWhereOrderBy('district',$distwhere,'district.name'); 
			$result['coordinatorList'] = $this->coordinator->getAllCoordinatorbyRole($distwhere); 
			$page = "dashboard/adminpanel_dashboard/coordinator/coordinator_list_view";
			createbody_method($result, $page, $header, $session);
		}
		else
		{
			redirect('adminpanel','refresh');
		}
	}

	public function addcoordinator()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['token']))
		{
			if ($this->uri->segment(3) === FALSE)
			{
				$result['mode'] = "ADD";
				$result['btnText'] = "Save";
				$result['btnTextLoader'] = "Saving...";
				$cordID = 0;
				$result['cordEditdata'] = [];
				
			}
			else
			{
				$result['mode'] = "EDIT";
				$result['btnText'] = "Update";
				$result['btnTextLoader'] = "Updating...";
				$cordID = $this->uri->segment(3);
				$whereAry = array(
					'coordinator.id' => $cordID
				);
				// getSingleRowByWhereCls(tablename,where params)
				$result['cordEditdata'] = $this->coordinator->getCoordinatorEditDataByID($cordID); 
				
			
				
			}

			$header = "";
				
			/* Role id 9: District Coordinator*/
			if ($session['roleid']==9) {
				$where_dist = array('district.web_userid' => $session['userid'], );
				$rowDistrict=$this->commondatamodel->getSingleRowByWhereCls('district',$where_dist);
				
				$blockwhere = ['block.district_id'=>$rowDistrict->id,'block.is_active' => 1];
			 }else{
				
				$blockwhere = ['block.is_active' => 1];
			 }
			
			$result['blockList'] = $this->commondatamodel->getAllRecordWhereOrderBy('block',$blockwhere,'block.name'); 
			
			$page = "dashboard/adminpanel_dashboard/coordinator/coordinator_add_edit_view";
			createbody_method($result, $page, $header,$session);
		}
		else
		{
			redirect('adminpanel','refresh');
		}
	}

	public function coordinator_action()
	{
		
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['token']))
		{
			$json_response = array();
			$formData = $this->input->post('formDatas');
			parse_str($formData, $dataArry);
			
			
			$cordID = trim(htmlspecialchars($dataArry['cordID']));
			$mode = trim(htmlspecialchars($dataArry['mode']));

			$cordname = trim(htmlspecialchars($dataArry['cordname']));
			$gender = trim(htmlspecialchars($dataArry['cordgender']));
			$cordmobile = trim(htmlspecialchars($dataArry['cordmobile']));
			$cordadd = trim(htmlspecialchars($dataArry['cordadd']));
			$cordpin = trim(htmlspecialchars($dataArry['cordpin']));
			$cordpassword = trim(htmlspecialchars($dataArry['cordpassword']));

			


			if($cordname!="" && $cordmobile!="" &&  $cordadd!="" &&  $cordpin!="" && $cordpassword!="")
			{
	
				
				
				if($cordID>0 && $mode=="EDIT")
				{
					/*  EDIT MODE
					 *	-----------------
					*/

					$update = $this->coordinator->updateCoordinator($dataArry,$session);
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

			
					$insertData = $this->coordinator->insertIntoCoordinator($dataArry,$session);
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
				"coordinator.id" => $updID
				);
			
			
			$user_activity = array(
					"activity_module" => 'Coordinator',
					"action" => "Update",
					"from_method" => "coordinator/setStatus",
					"user_id" => $session['userid'],
					"ip_address" => getUserIPAddress(),
					"user_browser" => getUserBrowserName(),
					"user_platform" => getUserPlatform()
				);
				$update = $this->commondatamodel->updateData_WithUserActivity('coordinator',$update_array,$where,'activity_log',$user_activity);
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

/*----------------------------check mobile availability-----------------------------*/

public function checkmobile(){

		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['token']))
		{
			$mobile = trim($this->input->post('mobile'));
			$oldmobile = trim($this->input->post('oldmobile'));
			$mode = trim($this->input->post('mode'));

			if($mode=='ADD'){
					$where = array('coordinator.mobile_no' => $mobile);
					
					$result = $this->commondatamodel->checkExistanceData('coordinator',$where);
					
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

									$where = array('coordinator.mobile_no' => $mobile);
									
									$result = $this->commondatamodel->checkExistanceData('coordinator',$where);
									
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
	

public function getBlock()
	{
		if($this->session->userdata('user_data'))
		{
				$block_ids = $this->input->post('blockids');


				$formData = $this->input->post('formDatas');
			parse_str($formData, $dataArry);
			$result=[];
			
			if (isset($dataArry['sel_dist'])) {
				$in_district = $dataArry['sel_dist'];
				

         $data['blockList'] = $this->locations->getAllBlockListINDistict($in_district);
			}else{

         $data['blockList'] = []; 
			}

    
      // pre($data['tuList']);
       $viewTemp = $this->load->view('dashboard/adminpanel_dashboard/coordinator/block_view',$data);
			echo $viewTemp;
		}
		else
		{
			redirect('login','refresh');
		}
	}


	public function getCoordinatorList()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['token']))
		{
			$formData = $this->input->post('formDatas');
			parse_str($formData, $dataArry);
			$result=[];
			/* Role id 9: District Coordinator*/
			if ($session['roleid']==9) {
				$where_dist = array('district.web_userid' => $session['userid'], );
				$rowDistrict=$this->commondatamodel->getSingleRowByWhereCls('district',$where_dist);
				$distwhere = array(
					'district.id' =>$rowDistrict->id,
					'district.is_active' => 1
				);

			 }else{
				$distwhere = ["district.is_active" => 1 ];
				$where_dist=[];
			 }
			
			if (isset($dataArry['sel_block'])) {
				$in_block = $dataArry['sel_block'];
				

            $result['coordinatorList'] = $this->coordinator->getAllCoordinatorINblock($in_block);
			}else{
				if (isset($dataArry['sel_dist'])) {
					$district_ids = $dataArry['sel_dist'];
					 $result['coordinatorList'] = $this->coordinator->getAllCoordinatorINDistrict($district_ids);
				}else{
					//$result['coordinatorList'] = $this->coordinator->getAllCoordinator(); 
					$result['coordinatorList'] = $this->coordinator->getAllCoordinatorbyRole($distwhere); 
				}

         
			}


			
			$page = "dashboard/adminpanel_dashboard/coordinator/coordinator_list_data.php";
			$partial_view = $this->load->view($page,$result);
			echo $partial_view;
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}		

}// end of class
?>