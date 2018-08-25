<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class dmc extends CI_Controller {
	public function __construct()
	{
	    parent::__construct();
		$this->load->library('session');
		$this->load->model('dmcmodel','dmc',TRUE);
		$this->load->model('tuberculosisunitmodel','tuunit',TRUE);
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
				$blockwhere = ["block.district_id" =>$rowDistrict->id,"block.is_active" => 1];

			 }else{
			 	$whereAry=[];
				$blockwhere = ["block.is_active" => 1];
			 }
			$result['dmcList'] = $this->dmc->getAllDMCbyRoll($whereAry); 
			//$blockwhere = ["block.is_active" => 1];
			$result['blockList'] = $this->commondatamodel->getAllRecordWhereOrderBy('block',$blockwhere,'block.name'); 
			$page = "dashboard/adminpanel_dashboard/dmc/dmc_list_view";
			createbody_method($result, $page, $header, $session);
		}
		else
		{
			redirect('adminpanel','refresh');
		}
	}

	public function adddmc()
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
				$result['dmcEditdata'] = [];
				
				//getAllRecordWhereOrderBy($table,$where,$orderby)
				
				
			
			}
			else
			{
				$result['mode'] = "EDIT";
				$result['btnText'] = "Update";
				$result['btnTextLoader'] = "Updating...";
				$dmcID = $this->uri->segment(3);
				$whereAry = array(
					'dmc.id' => $dmcID
				);
				// getSingleRowByWhereCls(tablename,where params)
				$result['dmcEditdata'] = $this->dmc->getDMCEditDataByID($dmcID); 
				
			
				
			}

			$header = "";
			/* Role id 9: District Coordinator*/
			if ($session['roleid']==9) {  
				$where_dist = array('district.web_userid' => $session['userid'], );
				$rowDistrict=$this->commondatamodel->getSingleRowByWhereCls('district',$where_dist);
				$whereAry = array('district.id' =>$rowDistrict->id,'tu_unit.is_active' => 1 );
				
			 }else{
			 	$whereAry=['tu_unit.is_active' => 1];
				
			 }
		
			//getAllRecordWhereOrderBy($table,$where,$orderby)
			$result['tuList'] = $this->dmc->getAllTUListbyDist($whereAry); 
			//$result['tuList'] = $this->commondatamodel->getAllRecordWhereOrderBy('tu_unit',$tuwhere,'tu_unit.name'); 
			
			$page = "dashboard/adminpanel_dashboard/dmc/dmc_add_edit_view";
			createbody_method($result, $page, $header,$session);
		}
		else
		{
			redirect('adminpanel','refresh');
		}
	}

	public function dmc_action()
	{
		
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['token']))
		{
			$json_response = array();
			$formData = $this->input->post('formDatas');
			parse_str($formData, $dataArry);
			
			
			
			$dmcID = trim(htmlspecialchars($dataArry['dmcID']));
			$mode = trim(htmlspecialchars($dataArry['mode']));

			$tuID = trim(htmlspecialchars($dataArry['seltu']));
			$dmcname = trim(htmlspecialchars($dataArry['dmcname']));
			$dmcadd = trim(htmlspecialchars($dataArry['dmcadd']));
			$ltname = trim(htmlspecialchars($dataArry['ltname']));
			$mobile = trim(htmlspecialchars($dataArry['mobile']));
			$ltpass = trim(htmlspecialchars($dataArry['ltpass']));
			


			if($tuID!="0" && $dmcname!="" && $ltname!="" &&  $mobile!="" &&  $ltpass!="" )
			{
	
				
				
				if($dmcID>0 && $mode=="EDIT")
				{
					/*  EDIT MODE
					 *	-----------------
					*/

					

					$update = $this->dmc->updateDMC($dataArry,$session);
					
					
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

			
					$insertData = $this->dmc->insertIntoDMC($dataArry,$session);
					

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
				"dmc.id" => $updID
				);
			
			
			$user_activity = array(
					"activity_module" => 'DMC',
					"action" => "Update",
					"from_method" => "dmc/setStatus",
					"user_id" => $session['userid'],
					"ip_address" => getUserIPAddress(),
					"user_browser" => getUserBrowserName(),
					"user_platform" => getUserPlatform()
					
					
				);
				$update = $this->commondatamodel->updateData_WithUserActivity('dmc',$update_array,$where,'activity_log',$user_activity);
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
					$where = array('dmc.mobile_no' => $mobile);
					
					$result = $this->commondatamodel->checkExistanceData('dmc',$where);
					
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

									$where = array('dmc.mobile_no' => $mobile);
									
									$result = $this->commondatamodel->checkExistanceData('dmc',$where);
									
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

	
	public function getTu()
	{
		if($this->session->userdata('user_data'))
		{
				$block_ids = $this->input->post('blockids');


				$formData = $this->input->post('formDatas');
			parse_str($formData, $dataArry);
			$result=[];
			
			if (isset($dataArry['sel_block'])) {
				$block_ids = $dataArry['sel_block'];
				

            $data['tuList'] = $this->tuunit->getAllTuunitListINBlock($block_ids);
			}else{

           $data['tuList'] = []; 
			}

    
      // pre($data['tuList']);
       $viewTemp = $this->load->view('dashboard/adminpanel_dashboard/dmc/tu_view',$data);
			echo $viewTemp;
		}
		else
		{
			redirect('login','refresh');
		}
	}
	

	public function getDmcList()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['token']))
		{
			$formData = $this->input->post('formDatas');
			parse_str($formData, $dataArry);
			$result=[];

			if ($session['roleid']==9) {  
				$where_dist = array('district.web_userid' => $session['userid'], );
				$rowDistrict=$this->commondatamodel->getSingleRowByWhereCls('district',$where_dist);
				$whereAry = array('district.id' =>$rowDistrict->id);
				$blockwhere = ["block.district_id" =>$rowDistrict->id,"block.is_active" => 1];

			 }else{
			 	$whereAry=[];
				$blockwhere = ["block.is_active" => 1];
			 }
			
			
			if (isset($dataArry['sel_tu'])) {
				$in_tu = $dataArry['sel_tu'];
				

            $result['dmcList'] = $this->dmc->getAllDmcINTu($in_tu);
			}else{
				if (isset($dataArry['sel_block'])) {
					$block_ids = $dataArry['sel_block'];
					$result['dmcList'] = $this->dmc->getAllDmcINblock($block_ids);
				}else{
					//$result['dmcList'] = $this->dmc->getAllDMC(); 
					$result['dmcList'] = $this->dmc->getAllDMCbyRoll($whereAry); 
				}

         
			}


			
			$page = "dashboard/adminpanel_dashboard/dmc/dmc_list_data";
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