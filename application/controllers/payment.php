<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class payment extends CI_Controller {
	public function __construct()
	{
	    parent::__construct();
		$this->load->library('session');
		$this->load->model('paymentmodel','paymentmodel',TRUE);
	}

	public function index()
	{
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['token']))
		{
			$header = "";
			$result['coordinatorList'] = $this->commondatamodel->getAllRecordOrderBy('coordinator','coordinator.name','ASC');
			$page = "dashboard/adminpanel_dashboard/payment/payment_list_view";
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

       $data['nqppList'] = $this->paymentmodel->getNqppListByCoordinator($coordinatorid);
       
       $viewTemp = $this->load->view('dashboard/adminpanel_dashboard/payment/nqpp_view',$data);
			echo $viewTemp;
		}
		else
		{
			redirect('login','refresh');
		}
	}


	public function getTransactionList()
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
			$result['transactionlistData'] = $this->paymentmodel->getTransactionListByNqpp($nqpp);
		
			
			$page = "dashboard/adminpanel_dashboard/payment/transaction_list_partial_view";
			$partial_view = $this->load->view($page,$result);
			echo $partial_view;
		}
		else
		{
			redirect('administratorpanel','refresh');
		}
	}






	/*******Update payment generation ********/

public function payment_action_update()
	{
		
		$session = $this->session->userdata('user_data');
		if($this->session->userdata('user_data') && isset($session['token']))
		{
			$json_response = array();
			$formData = $this->input->post('formDatas');
			parse_str($formData, $dataArry);
			
			
			
			$paygenid = $dataArry['paygen'];
			$amt = $dataArry['amt'];
			$txn = $dataArry['txn'];
			$chkpay = $dataArry['chkpay'];
			$nqpp = $dataArry['nqpp'];
			$payment_date = $dataArry['payment_date'];
		    $totalamount = $dataArry['totalamount'];
		    $remarks = $dataArry['remarks'];

		     if($payment_date!=""){
				$payment_date = str_replace('/', '-', $payment_date);
				$payment_date = date("Y-m-d",strtotime($payment_date));
			 }
			 else{
				 $payment_date = NULL;
			 }
		    
			
			
				
					/*  ADD MODE
					 *	-----------------
					*/

				
					
				
				
				foreach ($chkpay as $value) {


			//echo $txn[$value];
				
                 $payment_mst_insert = array(
						"payment_gen_id" => $paygenid[$value],
						"amount" => $amt[$value],
						"payment_dt" => date("Y-m-d",strtotime($payment_date)),
						"due" => 0,
						"remarks" => $remarks,
						"created_by" => $session['userid']
							
					);

				$insert_paymst=$this->commondatamodel->insertSingleTableData('payment_master',$payment_mst_insert);
                  



                	$array_upd = array(
						"is_payment_done" =>'Y'
						
					);

					$where_upd = array(
						"payment_gen_master.id" => $paygenid[$value]
					);

					
				
					$user_activity = array(
						"activity_module" => 'Payment Generation',
						"action" => 'Update',
						"from_method" => 'payment/payment_action_update',
						"user_id" => $session['userid'],
						"ip_address" => getUserIPAddress(),
						"user_browser" => getUserBrowserName(),
						"user_platform" => getUserPlatform()
						
					 );

				    
					

$update = $this->commondatamodel->updateData_WithUserActivity('payment_gen_master',$array_upd,$where_upd,'activity_log',$user_activity);
					if($update)
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