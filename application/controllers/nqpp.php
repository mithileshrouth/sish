<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class nqpp extends CI_Controller {
	public function __construct()
	{
	    parent::__construct();
		$this->load->library('session');
		$this->load->model('nqppmodel','nqpp',TRUE);
	}
	
	
	public function index()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['token']))
		{
			$header = "";
			$result['nqppList'] = $this->nqpp->getAllNQPP(); 
			$page = "dashboard/adminpanel_dashboard/nqpp/nqpp_list_view";
			createbody_method($result, $page, $header, $session);
		}
		else
		{
			redirect('adminpanel','refresh');
		}
	}

	public function addnqpp()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['token']))
		{
			if ($this->uri->segment(3) === FALSE)
			{
				$result['mode'] = "ADD";
				$result['btnText'] = "Save";
				$result['btnTextLoader'] = "Saving...";
				$nqppID = 0;
				$result['nqppEditdata'] = [];
				
			}
			else
			{
				$result['mode'] = "EDIT";
				$result['btnText'] = "Update";
				$result['btnTextLoader'] = "Updating...";
				$nqppID = $this->uri->segment(3);
				$whereAry = array(
					'nqpp.id' => $nqppID
				);
				// getSingleRowByWhereCls(tablename,where params)
				$result['nqppEditdata'] = $this->nqpp->getNQPPEditDataByID($nqppID); 
				
			
				
			}

			$header = "";
			
			$blockwhere = [
				"block.is_active" => 1 
				];
			$result['blockList'] = $this->commondatamodel->getAllRecordWhereOrderBy('block',$blockwhere,'block.name'); 
			
			$coordinatorwhere = [
				"coordinator.is_active" => 1 
				];
			$result['coordinatorList'] = $this->commondatamodel->getAllRecordWhereOrderBy('coordinator',$coordinatorwhere,'coordinator.name'); 
			
			$page = "dashboard/adminpanel_dashboard/nqpp/nqpp_add_edit_view";
			createbody_method($result, $page, $header,$session);
		}
		else
		{
			redirect('adminpanel','refresh');
		}
	}

	public function nqpp_action()
	{
		
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['token']))
		{
			$json_response = array();
			$formData = $this->input->post('formDatas');
			parse_str($formData, $dataArry);
			
			
			$nqppID = trim(htmlspecialchars($dataArry['nqppID']));
			$mode = trim(htmlspecialchars($dataArry['mode']));

			$nqppname = trim(htmlspecialchars($dataArry['nqppname']));
			$nqppmobile = trim(htmlspecialchars($dataArry['nqppmobile']));
			$nqppadd = trim(htmlspecialchars($dataArry['nqppadd']));
			$nqpppin = trim(htmlspecialchars($dataArry['nqpppin']));
			$nqpppassword = trim(htmlspecialchars($dataArry['nqpppassword']));

			


			if($nqppname!="" && $nqppmobile!="" &&  $nqppadd!="" &&  $nqpppin!="" && $nqpppassword!="")
			{
	
				if($nqppID>0 && $mode=="EDIT")
				{
					/*  EDIT MODE
					 *	-----------------
					*/

					$update =  $this->nqpp->updateNqpp($dataArry,$session);
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

			
					$insertData = $this->nqpp->insertIntoNqpp($dataArry,$session);
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
				"nqpp.id" => $updID
				);
			
			
			$user_activity = array(
					"activity_module" => 'NQPP',
					"action" => "Update",
					"from_method" => "nqpp/setStatus",
					"user_id" => $session['userid'],
					"ip_address" => getUserIPAddress(),
					"user_browser" => getUserBrowserName(),
					"user_platform" => getUserPlatform()
				);
				$update = $this->commondatamodel->updateData_WithUserActivity('nqpp',$update_array,$where,'activity_log',$user_activity);
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