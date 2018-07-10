<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class payment_generation extends CI_Controller {
	public function __construct()
	{
	    parent::__construct();
		$this->load->library('session');
		$this->load->model('paymentgenerationmodel','paygen',TRUE);
	}

	public function index()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['token']))
		{
			$header = "";
			$result['coordinatorList'] = $this->commondatamodel->getAllRecordOrderBy('coordinator','coordinator.name','ASC');
			$page = "dashboard/adminpanel_dashboard/payment_generation/payment_generation_list_view";
			createbody_method($result, $page, $header, $session);
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}

	public function getNqpp()
	{
		if($this->session->userdata('user_data'))
		{
				$coordinatorid = $this->input->post('coordinatorid');

       $data['nqppList'] = $this->paygen->getNqppListByCoordinator($coordinatorid);
       
       $viewTemp = $this->load->view('dashboard/adminpanel_dashboard/payment_generation/nqpp_view',$data);
			echo $viewTemp;
		}
		else
		{
			redirect('login','refresh');
		}
	}

	public function getNqppt2()
	{
		if($this->session->userdata('user_data'))
		{
				$coordinatorid = $this->input->post('coordinatorid');

       $data['nqppList'] = $this->paygen->getNqppListByCoordinator($coordinatorid);
       
       $viewTemp = $this->load->view('dashboard/adminpanel_dashboard/payment_generation/nqpp_viewt2',$data);
			echo $viewTemp;
		}
		else
		{
			redirect('login','refresh');
		}
	}


	public function getTransactionNo()
	{
		if($this->session->userdata('user_data'))
		{
				$nqppid = $this->input->post('nqppid');

       $data['txnList'] = $this->paygen->getTransactionListByNqpp($nqppid);
       
       $viewTemp = $this->load->view('dashboard/adminpanel_dashboard/payment_generation/transaction_view',$data);
			echo $viewTemp;
		}
		else
		{
			redirect('login','refresh');
		}
	}

	public function getPatientList()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['token']))
		{
			$formData = $this->input->post('formDatas');
			parse_str($formData, $dataArry);

			$coordinator = trim(htmlspecialchars($dataArry['coordinator']));
			$nqpp = trim(htmlspecialchars($dataArry['sel_nqpp']));
		
			$result['coordinator'] = $coordinator;
			$result['nqpp'] = $nqpp;
			$result['patientlistData'] = $this->paygen->gePatientListByNqpp($nqpp);
			$result['incentive'] = $this->paygen->getNqppIncentive();
			
			$page = "dashboard/adminpanel_dashboard/payment_generation/patient_list_partial_view";
			$partial_view = $this->load->view($page,$result);
			echo $partial_view;
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}


public function getPaymetGenPatientList()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['token']))
		{
			$formData = $this->input->post('formDatas');
			parse_str($formData, $dataArry);

			$coordinator = trim(htmlspecialchars($dataArry['coordinatort2']));
			$nqpp = trim(htmlspecialchars($dataArry['sel_nqppt2']));
			$payment_gen_id = trim(htmlspecialchars($dataArry['sel_txn']));
		
			$result['coordinator'] = $coordinator;
			$result['nqpp'] = $nqpp;
			$result['patientlistData'] = $this->paygen->gePatientListByPmtGenID($payment_gen_id);
			$result['incentive'] = $this->paygen->getNqppIncentive();
			
			$page = "dashboard/adminpanel_dashboard/payment_generation/gen_patient_list_partial_view";
			$partial_view = $this->load->view($page,$result);
			echo $partial_view;
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}



	public function payment_action()
	{
		
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['token']))
		{
			$json_response = array();
			$formData = $this->input->post('formDatas');
			parse_str($formData, $dataArry);
			
			
			
			$patient = $dataArry['patient'];
			$amt = $dataArry['amt'];
			$chkpay = $dataArry['chkpay'];
			$nqpp = $dataArry['nqpp'];
			$generation_date = $dataArry['generation_date'];
		    $totalamount = $dataArry['totalamount'];
			
			
			  $latest_serial = $this->paygen->getLatestSerialNumber("PAY-GEN",1); //it will change
			 $trnID = "B/".$latest_serial;
			  
				
					/*  ADD MODE
					 *	-----------------
					*/


					$array_insert = array(
						"nqpp_id" => $nqpp,
						"generation_dt" => date("Y-m-d",strtotime($generation_date)),
						"transaction_id" => $trnID,
						"payable_amt" =>$totalamount
					);
					
				$insert_payment_mst_id=$this->paygen->insertIntoPaymentMaster($array_insert);
				
				foreach ($chkpay as $value) {
			
				$payment_dtl_insert = array(
						"payment_id" => $insert_payment_mst_id,
						"patient_id" => $patient[$value],
						"amount" => $amt[$value]
							
					);

				$insert_pay_gen_dtl=$this->commondatamodel->insertSingleTableData('payment_gen_details',$payment_dtl_insert);
                  }
					

					$user_activity = array(
						"activity_module" => 'Payment Generation',
						"action" => 'Insert',
						"from_method" => 'payment_generation/payment_action',
						"user_id" => $session['userid'],
						"ip_address" => getUserIPAddress(),
						"user_browser" => getUserBrowserName(),
						"user_platform" => getUserPlatform()
						
					 );

				    
					$tbl_name = array('activity_log');
					$insert_array = array($user_activity);
					$insertData = $this->commondatamodel->insertMultiTableData($tbl_name,$insert_array);

					if($insertData)
					{
						$json_response = array(
							"msg_status" => 1,
							"msg_data" => "Saved successfully",
							"mode" => "ADD",
							"txnid" => $trnID
						);
					}
					else
					{
						$json_response = array(
							"msg_status" => 1,
							"msg_data" => "There is some problem.Try again"
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



/*******Update payment generation ********/

// working on progress 8:20pm
public function payment_action_update()
	{
		
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['token']))
		{
			$json_response = array();
			$formData = $this->input->post('formDatas');
			parse_str($formData, $dataArry);
			
			
			
			$patient = $dataArry['patient'];
			$amt = $dataArry['amt'];
			$chkpay = $dataArry['chkpay'];
			$nqpp = $dataArry['nqpp'];
			$generation_date = $dataArry['generation_date'];
		    $totalamount = $dataArry['totalamount'];
		    $trnID = $dataArry['txnno'];
			
			
			
			$rowpaymentgenmst=$this->paygen->getpaymentid($trnID); 
			
			
			foreach ($rowpaymentgenmst as $value) {
				$patment_gen_id= $value->id;
			}
			
			$delete=$this->paygen->deletePaymentGenerationDetails($patment_gen_id);

			
			  
				
					/*  ADD MODE
					 *	-----------------
					*/

					if($delete){
					$array_insert = array(
						"nqpp_id" => $nqpp,
						"generation_dt" => date("Y-m-d",strtotime($generation_date)),
						"transaction_id" => $trnID,
						"payable_amt" =>$totalamount
					);
					
				
				
				foreach ($chkpay as $value) {
			
				$payment_dtl_insert = array(
						"payment_id" => $patment_gen_id,
						"patient_id" => $patient[$value],
						"amount" => $amt[$value]
							
					);

				$insert_pay_gen_dtl=$this->commondatamodel->insertSingleTableData('payment_gen_details',$payment_dtl_insert);
                  }
					
					$array_upd = array(
						"payable_amt" => $totalamount
						
					);

					$where_upd = array(
						"payment_gen_master.id" => $patment_gen_id
					);

					$user_activity = array(
						"activity_module" => 'Payment Generation',
						"action" => 'Insert',
						"from_method" => 'payment_generation/payment_action',
						"user_id" => $session['userid'],
						"ip_address" => getUserIPAddress(),
						"user_browser" => getUserBrowserName(),
						"user_platform" => getUserPlatform()
						
					 );

				    
					/*$tbl_name = array('activity_log');
					$insert_array = array($user_activity);
					$insertData = $this->commondatamodel->insertMultiTableData($tbl_name,$insert_array);*/

$update = $this->commondatamodel->updateData_WithUserActivity('payment_gen_master',$array_upd,$where_upd,'activity_log',$user_activity);
					if($update)
					{
						$json_response = array(
							"msg_status" => 1,
							"msg_data" => "Updated successfully",
							"mode" => "ADD",
							"txnid" => $trnID
						);
					}
					else
					{
						$json_response = array(
							"msg_status" => 1,
							"msg_data" => "There is some problem.Try again"
						);
					}

				}else{

					$json_response = array(
							"msg_status" => 1,
							"msg_data" => "There is some problem.Try again"
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


}//end of class