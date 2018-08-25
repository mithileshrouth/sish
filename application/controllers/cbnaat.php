<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class cbnaat extends CI_Controller {
	public function __construct()
	{
	    parent::__construct();
		$this->load->library('session');
		$this->load->model('cbnaatmodel','cbnaat',TRUE);
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
				$distwhere = [];
				
			 }
			$result['cbnaatlist'] = $this->cbnaat->getAllCbnaatByRole($distwhere); 
			$page = "dashboard/adminpanel_dashboard/cbnaat/cbnaatlist_view";
			createbody_method($result, $page, $header, $session);
		}
		else
		{
			redirect('adminpanel','refresh');
		}
	}

	public function addcbnaat()
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
				$result['cbnaatEditdata'] = [];
				
				//getAllRecordWhereOrderBy($table,$where,$orderby)
				
				
			
			}
			else
			{
				$result['mode'] = "EDIT";
				$result['btnText'] = "Update";
				$result['btnTextLoader'] = "Updating...";
				$cbnatId = $this->uri->segment(3);
				$whereAry = array(
					'cbnaat.id' => $cbnatId
				);
				// getSingleRowByWhereCls(tablename,where params)
				$result['cbnaatEditdata'] = $this->cbnaat->getCbnaatEditDataByID($cbnatId); 
				
		//	pre($result['cbnaatEditdata']);exit;
				
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
				$distwhere = ["tu_unit.is_active" => 1 ];
			
			 }
			
			$result['tuList'] = $this->cbnaat->getAllTUListbyDist($distwhere); 
			
			
			$page = "dashboard/adminpanel_dashboard/cbnaat/cbnaat_add_edit_view";
			createbody_method($result, $page, $header,$session);
		}
		else
		{
			redirect('adminpanel','refresh');
		}
	}

	public function cbnaat_action()
	{
		
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['token']))
		{
			$json_response = array();
			$formData = $this->input->post('formDatas');
			parse_str($formData, $dataArry);
			

			
		
			$cbnatId = trim(htmlspecialchars($dataArry['cbnatId']));
			$mode = trim(htmlspecialchars($dataArry['mode']));

			
			$seltu = trim(htmlspecialchars($dataArry['seltu']));
			$cbnatcntrname = trim(htmlspecialchars($dataArry['cbnatcntrname']));
			$cbnatcntradd = trim(htmlspecialchars($dataArry['cbnatcntradd']));
			
			


			if($seltu!="0" && $cbnatcntrname!="" && $cbnatcntradd!="")
			{
	
				
				
				if($cbnatId>0 && $mode=="EDIT")
				{
					/*  EDIT MODE
					 *	-----------------
					*/

					

					$update = $this->cbnaat->updateCbnaatCenter($dataArry,$session);
					
					
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

			
					$insertData = $this->cbnaat->insertIntoCbnaatCenter($dataArry,$session);
					

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
				"cbnaat.id" => $updID
				);
			
			
			$user_activity = array(
					"activity_module" => 'CB-NAAT',
					"action" => "Update",
					"from_method" => "cbnaat/setStatus",
					"user_id" => $session['userid'],
					"ip_address" => getUserIPAddress(),
					"user_browser" => getUserBrowserName(),
					"user_platform" => getUserPlatform()
					
					
				);
				$update = $this->commondatamodel->updateData_WithUserActivity('cbnaat',$update_array,$where,'activity_log',$user_activity);
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