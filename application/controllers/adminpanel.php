<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class adminpanel extends CI_Controller {
 public function __construct()
 {
   parent::__construct();
	
	$this->load->model('loginmodel','login',TRUE);
	$this->load->model('usermastermodel','user',TRUE);
    $this->load->library('session');
	
 }
	
 public function index()
 {
    $page = 'loginpanel/admin_login';
	//$result['roles'] = $this->role->getActiveRole();
	
	$result = [];
	$where = ["role_master.is_visible_web" => 'Y' ];
	$result['roleList'] = $this->commondatamodel->getAllRecordWhereOrderBy('role_master',$where,'role_master.name'); 
	$this->load->view($page,$result);
 }

 
 public function verifyLogin()
 {
	$json_response = array();
	$formData = $this->input->post('formDatas');
	parse_str($formData, $dataArry);
	$mobileno =  htmlspecialchars($dataArry['mobileno']);
	$password =  htmlspecialchars($dataArry['password']);
	$role =  htmlspecialchars($dataArry['role']);
	//$role =  htmlspecialchars($dataArry['role']);
	
	
	
	if($mobileno=="" OR $password=="")
	{
		$json_response = array(
			 "msg_status" => 0,
			 "msg_data" => "All fields are required"
		);
		
	}
	else
	{
		$userID = 0;
		$userID = $this->login->verifymobilelogin($mobileno,$password,$role,1); // 1== will change later dyanamically
		if($userID>0)
		{
			$userdata = $this->user->getWebUserById($userID);
			
			
			
			$sessionData = [
				"mobileno" => $userdata->mobile_no,
				"userid" => $userdata->userid,
				"roleid" => $userdata->roleid,
				"token" => $this->getSecureToken()
			];
			
			
			
			$this->setSessionData($sessionData);
			$session = $this->session->userdata('user_data');
			
			/*
			$update_array  = array(
				"last_login" => date("Y-m-d H:i:s"),
				"is_looged_in" => TRUE
				);
			
			$where_admin_user = array(
				"administrator_user_master.id" => $session['userid']
				);
			
			
			$user_activity = array(
					"activity_date" => date("Y-m-d H:i:s"),
					"activity_module" => 'AdministratorLogin',
					"action" => "Login",
					"from_method" => "administratorpanel/verifyLogin",
					"user_id" => $session['userid'],
					"ip_address" => getUserIPAddress(),
					"user_browser" => getUserBrowserName(),
					"user_platform" => getUserPlatform(),
					"login_time" => date("Y-m-d H:i:s"),
					"logout_time" => NULL
					
				);
				*/
			
			//$update = $this->commondatamodel->updateData_WithUserActivity('administrator_user_master',$update_array,$where_admin_user,'user_activity_report',$user_activity);
			
			
			
				$json_response = array(
					"msg_status" => 1,
					"msg_data" => "Logged in successfully..."
				);
			
			
		}
		else
		{
			$json_response = array(
				"msg_status" => 0,
				 "msg_data" => "Invalid login data.Please check your login details..."
			);
		}
		
	}
	
	header('Content-Type: application/json');
    echo json_encode( $json_response );
	exit;
	
 }
 
 private function getSecureToken()
 {
	$token="";
	$token = openssl_random_pseudo_bytes(16);
	$token = bin2hex($token);
	return $token;
 }
 
 
 
 private function setSessionData($result=NULL){
   
   if($result)
   { 
        $this->session->set_userdata("user_data",$result);
   }
 }
 
 public function logmeout(){
	 $this->session->sess_destroy();
	
	
	redirect('adminpanel','location');
	header('location:');
	exit;
	
 }
 

	

}