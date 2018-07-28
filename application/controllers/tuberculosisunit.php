<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class tuberculosisunit extends CI_Controller {
	public function __construct()
	{
	    parent::__construct();
		$this->load->library('session');
		$this->load->model('locationmodel','locations',TRUE);
		$this->load->model('tuberculosisunitmodel','tuunit',TRUE);

	}
	
	
	public function index()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['token']))
		{
			$header = "";
			$result['tuList'] = $this->tuunit->getAllTUList(); 

			$blockwhere = [
				"block.is_active" => 1 
				];
			$result['blockList'] = $this->commondatamodel->getAllRecordWhereOrderBy('block',$blockwhere,'block.name'); 
			$page = "dashboard/adminpanel_dashboard/tu_unit/tuunit_list_view";
			createbody_method($result, $page, $header, $session);
		}
		else
		{
			redirect('adminpanel','refresh');
		}
	}

	public function addtuunit()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['token']))
		{
			if ($this->uri->segment(3) === FALSE)
			{
				$result['mode'] = "ADD";
				$result['btnText'] = "Save";
				$result['btnTextLoader'] = "Saving...";
				$TUID = 0;
				$result['TuEditdata'] = [];
				
				//getAllRecordWhereOrderBy($table,$where,$orderby)
				
				
			
			}
			else
			{
				$result['mode'] = "EDIT";
				$result['btnText'] = "Update";
				$result['btnTextLoader'] = "Updating...";
				$TUID = $this->uri->segment(3);
				$whereAry = array(
					'tu_unit.id' => $TUID
				);
				// getSingleRowByWhereCls(tablename,where params)
				$result['TuEditdata'] = $this->commondatamodel->getSingleRowByWhereCls('tu_unit',$whereAry); 
				
			}

			$header = "";
			$blockwhere = [
				"block.is_active" => 1 
				];
			$result['blockList'] = $this->commondatamodel->getAllRecordWhereOrderBy('block',$blockwhere,'block.name'); 
			
			$page = "dashboard/adminpanel_dashboard/tu_unit/tuunit_add_edit_view";
			createbody_method($result, $page, $header,$session);
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}

	public function tuunit_action()
	{
		
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['token']))
		{
			$json_response = array();
			$formData = $this->input->post('formDatas');
			parse_str($formData, $dataArry);
			
			
			
			$tuID = trim(htmlspecialchars($dataArry['TUID']));
			$mode = trim(htmlspecialchars($dataArry['mode']));
			
			$blockID = trim(htmlspecialchars($dataArry['block']));
			$tuname = trim(htmlspecialchars($dataArry['tuunitname']));


			if($blockID!="0" && $tuname!="")
			{
	
				
				
				if($tuID>0 && $mode=="EDIT")
				{
					/*  EDIT MODE
					 *	-----------------
					*/

					$array_upd = array(
						"name" => $tuname,
						"block_id" => $blockID
						
					
					);

					$where_upd = array(
						"tu_unit.id" => $tuID
					);

					$user_activity = array(
						"activity_module" => 'TU',
						"action" => 'Update',
						"from_method" => 'tuberculosisunit/tuunit_action',
						"user_id" => $session['userid'],
						"ip_address" => getUserIPAddress(),
						"user_browser" => getUserBrowserName(),
						"user_platform" => getUserPlatform()
					 );


					/*
					@updateData_WithUserActivity('update table name','update table data','update table where condition','user activity table name','user activity table data');
					*/
					$update = $this->commondatamodel->updateData_WithUserActivity('tu_unit',$array_upd,$where_upd,'activity_log',$user_activity);
					
					
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
						"name" => $tuname,
						"block_id" => $blockID,
						"project_id" => 1,
						"is_active" => 1,
						"created_by" => $session['userid']
					);
					
					
	
					$user_activity = array(
						"activity_module" => 'TU',
						"action" => 'Insert',
						"from_method" => 'tuberculosisunit/tuunit_action',
						"user_id" => $session['userid'],
						"ip_address" => getUserIPAddress(),
						"user_browser" => getUserBrowserName(),
						"user_platform" => getUserPlatform()
						
					 );

						
					$tbl_name = array('tu_unit','activity_log');
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
				"tu_unit.id" => $updID
				);
			
			
			$user_activity = array(
					"activity_module" => 'TU',
					"action" => "Update",
					"from_method" => "tuberculosisunit/setStatus",
					"user_id" => $session['userid'],
					"ip_address" => getUserIPAddress(),
					"user_browser" => getUserBrowserName(),
					"user_platform" => getUserPlatform()
					
					
				);
				$update = $this->commondatamodel->updateData_WithUserActivity('tu_unit',$update_array,$where,'activity_log',$user_activity);
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

public function getTuList()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['token']))
		{
			$formData = $this->input->post('formDatas');
			parse_str($formData, $dataArry);
			$result=[];
			
			if (isset($dataArry['sel_block'])) {
				$block_ids = $dataArry['sel_block'];
	
            $result['tuList'] = $this->tuunit->getAllTuunitListINBlock($block_ids);
			}else{

            $result['tuList'] = $this->tuunit->getAllTUList(); 
			}

			//pre($result['tuList']);
			
			$page = "dashboard/adminpanel_dashboard/tu_unit/tuunit_list_data";
			$partial_view = $this->load->view($page,$result);
			echo $partial_view;
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}
	
	

}//end of class
?>