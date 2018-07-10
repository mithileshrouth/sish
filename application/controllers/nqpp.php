<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class nqpp extends CI_Controller {
	public function __construct()
	{
	    parent::__construct();
		$this->load->library('session');
		$this->load->model('nqppmodel','nqpp',TRUE);
		$this->load->library('excel');//load PHPExcel library 
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
			$nqppgender = trim(htmlspecialchars($dataArry['nqppgender']));
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

public function importnqpp()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['token']))
		{
				$result['mode'] = "ADD";
				$result['btnText'] = "Upload";
				$subDepartmentID = 0;
				$result['nqppEditData'] = [];
			$header = "";
			
			$page = "dashboard/adminpanel_dashboard/nqpp/nqpp_import_view";
			createbody_method($result, $page, $header, $session);
		}
		else
		{
			redirect('adminpanel','refresh');
		}
	}
	


public function nqppimport_action()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['token']))
		{
			$formData = $this->input->post('formDatas');
			parse_str($formData, $dataArry);

			
			 $user_file_name = trim(htmlspecialchars($this->input->post('nqppUploaduserFileName')));
			 
				if($_FILES['nqppUploadFile']['error']!=4)
				{

					//$dir = APPPATH .'assets/UploadedDocs/InvestigationUpload/';
					  $dir = APPPATH . 'assets/ds-documents/nqpp_upload'; 
					// $dir = $_SERVER['DOCUMENT_ROOT'] . '/application/assets/document/candidateUpload/'; //FCPATH . '/posts';
					 $configUpload['upload_path'] = $dir;
			         $configUpload['allowed_types'] = 'xls|xlsx|csv';
			         $configUpload['max_size'] = '5000';
			         $configUpload['encrypt_name'] = 'true';
			         $this->load->library('upload', $configUpload);
			        // $this->upload->do_upload('nqppUploadFile');
			         

				        if ($this->upload->do_upload('nqppUploadFile'))
		                {
		                	$upload_data = $this->upload->data(); 
		                	$file_name = $upload_data['file_name']; 
		                	$extension=$upload_data['file_ext'];  
		                	
		 					
		                	$file_insert_arry = array(
		                		"random_file_name" => $file_name,
		                		"user_file_name" => $user_file_name,
		                		"created_by" => $session['userid'],
								"created_on" => date('Y-m-d H:i:s')
		                	);

		                	if($extension==".xls")
		                	{
		                		$objReader= PHPExcel_IOFactory::createReader('Excel5');	// For excel 2007 	  
		                	}
		                	else
		                	{
		                		$objReader= PHPExcel_IOFactory::createReader('Excel2007');	// For excel 2007 	  
		                	}

		                	$insert = $this->nqpp->insertImportFileDataIntoNqpp($file_insert_arry,$objReader,$session);

		                	if($insert)
		                	{
		                		$json_response = array(
							 	"msg_status" => 1,
							 	"msg_data" => "Imported successfully"
								);
		                	}
		                	else
		                	{
		                		$json_response = array(
							 	"msg_status" => 0,
							 	"msg_data" => "There is some problem.Please try again."
								);
		                	}
		                }
		                else
		                {
						    $json_response = array(
							 	"msg_status" => 0,
							 	"msg_data" => "Please check File size and file type"
							);
		                }

		        }
	            else
				{
					$json_response = array(
					 	"msg_status" => 0,
					 	"msg_data" => "Please select file"
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



/*---------------------check mobile no availablity--------------------*/


public function checkmobile(){

		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['token']))
		{
			$mobile = trim($this->input->post('mobile'));
			$oldmobile = trim($this->input->post('oldmobile'));
			$mode = trim($this->input->post('mode'));

			if($mode=='ADD'){
					$where = array('nqpp.mobile_no' => $mobile);
					
					$result = $this->commondatamodel->checkExistanceData('nqpp',$where);
					
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

									$where = array('nqpp.mobile_no' => $mobile);
									
									$result = $this->commondatamodel->checkExistanceData('nqpp',$where);
									
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