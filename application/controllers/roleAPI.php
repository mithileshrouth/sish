<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class roleAPI extends CI_Controller{
public function __construct()
 {
   parent::__construct();
	
	$this->load->library('session');
	$this->load->model('rolemastermodel','role',TRUE);
    $this->load->model('apimodel','apimodel',TRUE);
    $this->load->model('usermastermodel','user',TRUE);
    $this->load->model('locationmodel','location',TRUE);
    $this->load->model('coordinatormodel','coordinator',TRUE);
    $this->load->model('nqppmodel','nqpp',TRUE);
    $this->load->model('dmcmodel','dmc',TRUE);
    $this->load->model('xraycentermodel','xray',TRUE);
    $this->load->model('cbnaatmodel','cbnaat',TRUE);
 }

 
 public function getrole($id=""){

     $result = [];
     if($id=="all"){
         $data["role"]= $this->role->getActiveRole();
         if(!empty($data["role"])){
             $result=[
                 "status"=>200,
                 "statuscode"=>"OK",
                 "roles"=>$data["role"]
             ];
		 }else{
             $result=array(
                 "status"=>400,
                 "statuscode"=>"NOK",
                 "roles"=>"NULL"
             );
         }
     } else {
         $roleId = (int)$id;
     }
     
    $json = json_encode($result);
    header('Access-Control-Allow-Origin: *'); 
    echo $json;
    exit();
     
 }
 
  /* @method getState
  *  @param postdata
  */
  
  public function getState(){
		header('Access-Control-Allow-Origin: *');  
		header('Content-Type: application/json');
		$postdata = file_get_contents("php://input");
		$request = json_decode($postdata);
		$apikey = $this->apimodel->getAPIkey();
		
		$id = $request->id;
		$key = $request->key;
		
		if(!empty($key) && $apikey == trim($key)){
			$data = $this->location->getState($id);
			if(sizeof($data)>0)
			{
				$result = [
				 "status"=>200,
                 "statuscode"=>"SUCCESS",
				 "data"=> $data
				];
			}
			else{
				$result = [
				 "status"=>400,
                 "statuscode"=>"NO DATA FOUND",
				 "data"=> NULL
				];
			}
			
		}
		else{
			$result = [
				 "status"=>403,
                 "statuscode"=>"KEY_MISSING",
				 "data"=> NULL
			];
		}
		
	
		
		$resultdata = json_encode($result);
		echo $resultdata;
		exit;
  }
 
 /*  @method getDistrict
  *  @param postdata
  */
  
  public function getDistrict(){
		header('Access-Control-Allow-Origin: *');  
		header('Content-Type: application/json');
		$postdata = file_get_contents("php://input");
		$request = json_decode($postdata);
		$apikey = $this->apimodel->getAPIkey();
		
		$id = $request->id;
		$key = $request->key;
		
		if(!empty($key) && $apikey == trim($key)){
			$data = $this->location->getDistrict($id);
			if(sizeof($data)>0)
			{
				$result = [
				 "status"=>200,
                 "statuscode"=>"SUCCESS",
				 "data"=> $data
				];
			}
			else{
				$result = [
				 "status"=>400,
                 "statuscode"=>"NO DATA FOUND",
				 "data"=> NULL
				];
			}
		}
		else{
			$result = [
				 "status"=>403,
                 "statuscode"=>"KEY_MISSING",
				 "data"=> NULL
			];
		}
		
	
		
		$resultdata = json_encode($result);
		echo $resultdata;
		exit;
  }
  
  /* @method getCountry
  *  @param postdata
  */
  
  public function getCountry(){
		header('Access-Control-Allow-Origin: *');  
		header('Content-Type: application/json');
		$postdata = file_get_contents("php://input");
		$request = json_decode($postdata);
		$apikey = $this->apimodel->getAPIkey();
		
		$id = $request->id;
		$key = $request->key;
		
		if(!empty($key) && $apikey == trim($key)){
			$data = $this->location->getCountry($id);
			if(sizeof($data)>0)
			{
				$result = [
				 "status"=>200,
                 "statuscode"=>"SUCCESS",
				 "data"=> $data
				];
			}
			else{
				$result = [
				 "status"=>400,
                 "statuscode"=>"NO DATA FOUND",
				 "data"=> NULL
				];
			}
			
		}
		else{
			$result = [
				 "status"=>403,
                 "statuscode"=>"KEY_MISSING",
				 "data"=> NULL
			];
		}
		
	
		
		$resultdata = json_encode($result);
		echo $resultdata;
		exit;
  }
 
 
   /* @method getBlock
  *  @param postdata
  */
  
  public function getBlock(){
		header('Access-Control-Allow-Origin: *');  
		header('Content-Type: application/json');
		$postdata = file_get_contents("php://input");
		$request = json_decode($postdata);
		$apikey = $this->apimodel->getAPIkey();
		
		$id = $request->id;
		$key = $request->key;
		
		if(!empty($key) && $apikey == trim($key)){
			$data = $this->location->getBlock($id);
			if(sizeof($data)>0)
			{
				$result = [
				 "status"=>200,
                 "statuscode"=>"SUCCESS",
				 "data"=> $data
				];
			}
			else{
				$result = [
				 "status"=>400,
                 "statuscode"=>"NO DATA FOUND",
				 "data"=> NULL
				];
			}
			
		}
		else{
			$result = [
				 "status"=>403,
                 "statuscode"=>"KEY_MISSING",
				 "data"=> NULL
			];
		}
		
	
		
		$resultdata = json_encode($result);
		echo $resultdata;
		exit;
  }
  
  /* @method getCoordinator
  *  @param postdata
  */
  
  public function getCoordinator(){
		header('Access-Control-Allow-Origin: *');  
		header('Content-Type: application/json');
		$postdata = file_get_contents("php://input");
		$request = json_decode($postdata);
		$apikey = $this->apimodel->getAPIkey();
		$sessiondata = $request->sdata;
		$key = $request->key;
		
	
		if(!empty($key) && $apikey == trim($key)){
				
			if($sessiondata->rcode=="CORD"){
				$resultset = $this->coordinator->getCoordinatorBYId($sessiondata->uid);
			}
			elseif($sessiondata->rcode=="NQPP"){
				$resultset = $this->coordinator->getCoordinatorOfNQPP($sessiondata->uid);
			}
			elseif($sessiondata->rcode=="PM"){
				$resultset = $this->coordinator->getCoordinatorByPM(); // Need to change if necessary
			}
			
			
			
			if(sizeof($resultset)>0)
			{
				$result = [
				 "status"=>200,
                 "statuscode"=>"SUCCESS",
				 "data"=> $resultset
				];
			}
			else{
				$result = [
				 "status"=>400,
                 "statuscode"=>"NO DATA FOUND",
				 "data"=> NULL
				];
			}
			
		}
		else{
			$result = [
				 "status"=>403,
                 "statuscode"=>"KEY_MISSING",
				 "data"=> NULL
			];
		}
		
	
		
		$resultdata = json_encode($result);
		echo $resultdata;
		exit;
  }
 
 
   /* @method getNQPP
  *  @param postdata
  */
  
  public function getNQPP(){
		header('Access-Control-Allow-Origin: *');  
		header('Content-Type: application/json');
		$postdata = file_get_contents("php://input");
		$request = json_decode($postdata);
		$apikey = $this->apimodel->getAPIkey();
		$sessiondata = $request->sdata;
		$key = $request->key;
		
	
		if(!empty($key) && $apikey == trim($key)){
			
			if($sessiondata->rcode=="CORD"){
				$resultset = $this->nqpp->getNQPPbyCoordinator($sessiondata->uid);
			}
			elseif($sessiondata->rcode=="NQPP"){
				$resultset = $this->nqpp->getNQPPbyUserID($sessiondata->uid);
			}
			else{
				$resultset = NULL;
			}
			
			
			
			if(sizeof($resultset)>0)
			{
				$result = [
				 "status"=>200,
                 "statuscode"=>"SUCCESS",
				 "data"=> $resultset
				];
			}
			else{
				$result = [
				 "status"=>400,
                 "statuscode"=>"NO DATA FOUND",
				 "data"=> NULL
				];
			}
			
		}
		else{
			$result = [
				 "status"=>403,
                 "statuscode"=>"KEY_MISSING",
				 "data"=> NULL
			];
		}
		
	
		
		$resultdata = json_encode($result);
		echo $resultdata;
		exit;
  }
 
 
 public function getAllPTBPhase(){
		header('Access-Control-Allow-Origin: *');  
		header('Content-Type: application/json');
		$postdata = file_get_contents("php://input");
		$request = json_decode($postdata);
		$apikey = $this->apimodel->getAPIkey();
		$key = $request->key;
		
	
		if(!empty($key) && $apikey == trim($key)){
			
			
			$resultset = $this->apimodel->getAllPTBPhase();
			
			if(sizeof($resultset)>0)
			{
				$result = [
				 "status"=>200,
                 "statuscode"=>"SUCCESS",
				 "data"=> $resultset
				];
			}
			else{
				$result = [
				 "status"=>400,
                 "statuscode"=>"NO DATA FOUND",
				 "data"=> NULL
				];
			}
			
		}
		else{
			$result = [
				 "status"=>403,
                 "statuscode"=>"KEY_MISSING",
				 "data"=> NULL
			];
		}
		
	
		
		$resultdata = json_encode($result);
		echo $resultdata;
		exit;
 }
 
  public function getAllCategory(){
		header('Access-Control-Allow-Origin: *');  
		header('Content-Type: application/json');
		$postdata = file_get_contents("php://input");
		$request = json_decode($postdata);
		$apikey = $this->apimodel->getAPIkey();
		$key = $request->key;
		
	
		if(!empty($key) && $apikey == trim($key)){
			
			
			$resultset = $this->apimodel->getAllCategory();
			
			if(sizeof($resultset)>0)
			{
				$result = [
				 "status"=>200,
                 "statuscode"=>"SUCCESS",
				 "data"=> $resultset
				];
			}
			else{
				$result = [
				 "status"=>400,
                 "statuscode"=>"NO DATA FOUND",
				 "data"=> NULL
				];
			}
			
		}
		else{
			$result = [
				 "status"=>403,
                 "statuscode"=>"KEY_MISSING",
				 "data"=> NULL
			];
		}
		
	
		
		$resultdata = json_encode($result);
		echo $resultdata;
		exit;
 }
 
 
   public function getDMCCenter(){
		header('Access-Control-Allow-Origin: *');  
		header('Content-Type: application/json');
		$postdata = file_get_contents("php://input");
		$request = json_decode($postdata);
		$apikey = $this->apimodel->getAPIkey();
		$key = $request->key;
		
	
		if(!empty($key) && $apikey == trim($key)){
			
			
			$resultset = $this->dmc->getAllActiveDMC();
			
			if(sizeof($resultset)>0)
			{
				$result = [
				 "status"=>200,
                 "statuscode"=>"SUCCESS",
				 "data"=> $resultset
				];
			}
			else{
				$result = [
				 "status"=>400,
                 "statuscode"=>"NO DATA FOUND",
				 "data"=> NULL
				];
			}
			
		}
		else{
			$result = [
				 "status"=>403,
                 "statuscode"=>"KEY_MISSING",
				 "data"=> NULL
			];
		}
		
	
		
		$resultdata = json_encode($result);
		echo $resultdata;
		exit;
 }
 
    public function getXrayCenter(){
		header('Access-Control-Allow-Origin: *');  
		header('Content-Type: application/json');
		$postdata = file_get_contents("php://input");
		$request = json_decode($postdata);
		$apikey = $this->apimodel->getAPIkey();
		$key = $request->key;
		
	
		if(!empty($key) && $apikey == trim($key)){
			
			
			$resultset = $this->xray->getAllActiveXrayCenter();
			
			if(sizeof($resultset)>0)
			{
				$result = [
				 "status"=>200,
                 "statuscode"=>"SUCCESS",
				 "data"=> $resultset
				];
			}
			else{
				$result = [
				 "status"=>400,
                 "statuscode"=>"NO DATA FOUND",
				 "data"=> NULL
				];
			}
			
		}
		else{
			$result = [
				 "status"=>403,
                 "statuscode"=>"KEY_MISSING",
				 "data"=> NULL
			];
		}
		
	
		
		$resultdata = json_encode($result);
		echo $resultdata;
		exit;
 }
 
  public function geCbnaatCenter(){
		header('Access-Control-Allow-Origin: *');  
		header('Content-Type: application/json');
		$postdata = file_get_contents("php://input");
		$request = json_decode($postdata);
		$apikey = $this->apimodel->getAPIkey();
		$key = $request->key;
		
	
		if(!empty($key) && $apikey == trim($key)){
			
			
			$resultset = $this->cbnaat->getAllActiveCbnaatCenter();
			
			if(sizeof($resultset)>0)
			{
				$result = [
				 "status"=>200,
                 "statuscode"=>"SUCCESS",
				 "data"=> $resultset
				];
			}
			else{
				$result = [
				 "status"=>400,
                 "statuscode"=>"NO DATA FOUND",
				 "data"=> NULL
				];
			}
			
		}
		else{
			$result = [
				 "status"=>403,
                 "statuscode"=>"KEY_MISSING",
				 "data"=> NULL
			];
		}
		
	
		
		$resultdata = json_encode($result);
		echo $resultdata;
		exit;
 }
 
 public function getOutCome(){
	header('Access-Control-Allow-Origin: *');  
	header('Content-Type: application/json');
	$postdata = file_get_contents("php://input");
	$request = json_decode($postdata);
	$apikey = $this->apimodel->getAPIkey();
	$key = $request->key;
		
	
		if(!empty($key) && $apikey == trim($key)){
			
			
			$resultset = $this->apimodel->getOutComeList();
			
			if(sizeof($resultset)>0)
			{
				$result = [
				 "status"=>200,
                 "statuscode"=>"SUCCESS",
				 "data"=> $resultset
				];
			}
			else{
				$result = [
				 "status"=>400,
                 "statuscode"=>"NO DATA FOUND",
				 "data"=> NULL
				];
			}
			
		}
		else{
			$result = [
				 "status"=>403,
                 "statuscode"=>"KEY_MISSING",
				 "data"=> NULL
			];
		}
		
	
		
		$resultdata = json_encode($result);
		echo $resultdata;
		exit;
 }
 
 
  public function getSymptoms(){
	header('Access-Control-Allow-Origin: *');  
	header('Content-Type: application/json');
	$postdata = file_get_contents("php://input");
	$request = json_decode($postdata);
	$apikey = $this->apimodel->getAPIkey();
	$key = $request->key;
		
	
		if(!empty($key) && $apikey == trim($key)){
			
			
			$resultset = $this->apimodel->getSymptomList();
			
			if(sizeof($resultset)>0)
			{
				$result = [
				 "status"=>200,
                 "statuscode"=>"SUCCESS",
				 "data"=> $resultset
				];
			}
			else{
				$result = [
				 "status"=>400,
                 "statuscode"=>"NO DATA FOUND",
				 "data"=> NULL
				];
			}
			
		}
		else{
			$result = [
				 "status"=>403,
                 "statuscode"=>"KEY_MISSING",
				 "data"=> NULL
			];
		}
		
	
		
		$resultdata = json_encode($result);
		echo $resultdata;
		exit;
 }
 
 

 public function verifyLogin(){
	header('Access-Control-Allow-Origin: *');  
		header('Content-Type: application/json');
		$postdata = file_get_contents("php://input");
		$request = json_decode($postdata);
		$apikey = $this->apimodel->getAPIkey();
		
		
		
		$logindata = $request->data;
		
		$mobile = $logindata->lgnmobileno;
		$password = $logindata->lgnpass;
		$roleid = $logindata->lgnrole;
		$projectid = $logindata->prjid;
		
		$key = $request->key;
	
			if(!empty($key) && $apikey == trim($key)){
			
			if(!$this->validation($mobile,$password,$roleid)){
				 $result=array(
					 "status"=>401,
					 "statuscode"=>"FIELD_EMPTY",
					 "user"=>"NULL"
				 );
			}
			else{
             $userId = $this->apimodel->verifymobilelogin($mobile,$password,$roleid,$projectid);
             if($userId>0){
                 $user = $this->user->getUserById($userId);
                 if(!empty($user)){
                     $result=array(
                        "status"=>200,
                        "statuscode"=>"SUCCESS",
                        "data"=>$user,
						"token"=>$this->generateToken()
                    );
                 }else{
                     $result=array(
                        "status"=>420,
                        "statuscode"=>"IN_ACTIVE",
                        "data"=>NULL,
						"token"=>NULL
                    );
                 }
                 
             }else{
               $result=array(
                 "status"=>402,
                 "statuscode"=>"INVALID_AUTH",
                 "data"=>NULL,
				 "token"=>NULL
                );  
             }
             
			}
			
		}
		else{
			$result = [
				 "status"=>403,
                 "statuscode"=>"KEY_MISSING",
				 "data"=> NULL,
				 "token"=>NULL
			];
		}
		
	
		
		$resultdata = json_encode($result);
		echo $resultdata;
		exit;
	
 }
 
 
 
 

 
 public function registerPTB(){
	header('Access-Control-Allow-Origin: *');  
	header('Content-Type: application/json');
	$postdata = file_get_contents("php://input");
	$request = json_decode($postdata);
	$key = $request->key;
	$apikey = $this->apimodel->getAPIkey();
	$data = $request->data;
	$session = $request->session;
	
	
	
	if(!empty($key) && $apikey == trim($key)){
		
		// Insert Into Patient // Registration Of New patient
		$register = $this->apimodel->insertIntoPatient($data,$session);
		if($register){
			$result = [
			"status"=>200,
            "statuscode"=>"SUCCESS",
			"data"=> NULL
			];
		}
		else{
			$result = [
			"status"=>400,
            "statuscode"=>"ERROR",
			"data"=> NULL
			];
		}

	}
	else{
		$result = [
			"status"=>403,
            "statuscode"=>"KEY_MISSING",
			"data"=> NULL,
			"token"=>NULL
			];
	}
		
	$resultdata = json_encode($result);
	echo $resultdata;
	exit;
	
 }
 
 
 public function getPatientList(){
	header('Access-Control-Allow-Origin: *');  
	header('Content-Type: application/json');
	$postdata = file_get_contents("php://input");
	$request = json_decode($postdata);
	$key = $request->key;
	$apikey = $this->apimodel->getAPIkey();
	$sessiondata = $request->session;
	
		
	if(!empty($key) && $apikey == trim($key)){
			
			$resultset = $this->apimodel->getPtientList($sessiondata);
			if(sizeof($resultset)>0)
			{
				$result = [
				 "status"=>200,
                 "statuscode"=>"SUCCESS",
				 "data"=> $resultset
				];
			}
			else{
				$result = [
				 "status"=>400,
                 "statuscode"=>"NO DATA FOUND",
				 "data"=> NULL
				];
			}
			
		}
		else{
			$result = [
				 "status"=>403,
                 "statuscode"=>"KEY_MISSING",
				 "data"=> NULL
			];
		}
		
	$resultdata = json_encode($result);
		echo $resultdata;
		exit;
 }
 
	/*
	* getStatusWisePTB
	* Status = "NEW","DETECTED","TREATMENT"
	* @date 02.07.2018
	* 
	*/
	
	public function getStatusWisePTB(){
		header('Access-Control-Allow-Origin: *');  
		header('Content-Type: application/json');
		$postdata = file_get_contents("php://input");
		$request = json_decode($postdata);
		$key = $request->key;
		$status = $request->status;
		$apikey = $this->apimodel->getAPIkey();
		$sessiondata = $request->session;
		
			
		if(!empty($key) && $apikey == trim($key)){
				
				$resultset = $this->apimodel->getStatusWisePTB($status,$sessiondata);
				if(sizeof($resultset)>0)
				{
					$result = [
					 "status"=>200,
					 "statuscode"=>"SUCCESS",
					 "data"=> $resultset
					];
				}
				else{
					$result = [
					 "status"=>400,
					 "statuscode"=>"NO DATA FOUND",
					 "data"=> NULL
					];
				}
				
			}
			else{
				$result = [
					 "status"=>403,
					 "statuscode"=>"KEY_MISSING",
					 "data"=> NULL
				];
			}
			
		$resultdata = json_encode($result);
			echo $resultdata;
			exit;
	}
 
 
 public function getPatientStatus(){
	header('Access-Control-Allow-Origin: *');  
	header('Content-Type: application/json');
	$postdata = file_get_contents("php://input");
	$request = json_decode($postdata);
	$key = $request->key;
	$apikey = $this->apimodel->getAPIkey();
	$patientdata = $request->data;

		
	if(!empty($key) && $apikey == trim($key)){
			
			$resultset = $this->apimodel->getPtientDataById($patientdata->pid);
			if(sizeof($resultset)>0)
			{
				$result = [
				 "status"=>200,
                 "statuscode"=>"SUCCESS",
				 "data"=> $resultset
				];
			}
			else{
				$result = [
				 "status"=>400,
                 "statuscode"=>"NO DATA FOUND",
				 "data"=> NULL
				];
			}
			
		}
		else{
			$result = [
				 "status"=>403,
                 "statuscode"=>"KEY_MISSING",
				 "data"=> NULL
			];
		}
		
	$resultdata = json_encode($result);
		echo $resultdata;
		exit;
 }
 
 
 
	
 
  public function getTreatmentStructure(){
	header('Access-Control-Allow-Origin: *');  
	header('Content-Type: application/json');
	$postdata = file_get_contents("php://input");
	$request = json_decode($postdata);
	$key = $request->key;
	$apikey = $this->apimodel->getAPIkey();
	$datas = $request->data;

	if(!empty($key) && $apikey == trim($key)){
			
			$resultset = $this->apimodel->gettreatmentStructureDatas($datas);
			if(sizeof($resultset)>0)
			{
				$result = [
				 "status"=>200,
                 "statuscode"=>"SUCCESS",
				 "data"=> $resultset
				];
			}
			else{
				$result = [
				 "status"=>400,
                 "statuscode"=>"NO DATA FOUND",
				 "data"=> NULL
				];
			}
			
		}
		else{
			$result = [
				 "status"=>403,
                 "statuscode"=>"KEY_MISSING",
				 "data"=> NULL
			];
		}
		
	$resultdata = json_encode($result);
		echo $resultdata;
		exit; 
 }
 
 
 public function updatePTBStatusData(){
	header('Access-Control-Allow-Origin: *');  
	header('Content-Type: application/json');
	$postdata = file_get_contents("php://input");
	$request = json_decode($postdata);
	$key = $request->key;
	$apikey = $this->apimodel->getAPIkey();
	$patientdata = $request->data;
	$sessiondata = $request->session;
	
	if(!empty($key) && $apikey == trim($key)){
			
			$resultset = $this->apimodel->updatePatientDataStatusWise($patientdata,$sessiondata);
			if(sizeof($resultset)>0)
			{
				$result = [
				 "status"=>200,
                 "statuscode"=>"SUCCESS",
				 "data"=> $resultset
				];
			}
			else{
				$result = [
				 "status"=>400,
                 "statuscode"=>"ERROR",
				 "data"=> NULL
				];
			}
			
		}
		else{
			$result = [
				 "status"=>403,
                 "statuscode"=>"KEY_MISSING",
				 "data"=> NULL
			];
		}
		
	$resultdata = json_encode($result);
		echo $resultdata;
		exit;
 }
 
 
 public function updatePTBFollowUP(){
	header('Access-Control-Allow-Origin: *');  
	header('Content-Type: application/json');
	$postdata = file_get_contents("php://input");
	$request = json_decode($postdata);
	$key = $request->key;
	$apikey = $this->apimodel->getAPIkey();
	$patientdata = $request->data;
	$ptbid = $request->ptbid;
	$sessiondata = $request->session;
	
	if(!empty($key) && $apikey == trim($key)){
			
			$resultset = $this->apimodel->updatePTBFollowUP($patientdata,$ptbid,$sessiondata);
			if(sizeof($resultset)>0)
			{
				$result = [
				 "status"=>200,
                 "statuscode"=>"SUCCESS",
				 "data"=> $resultset
				];
			}
			else{
				$result = [
				 "status"=>400,
                 "statuscode"=>"ERROR",
				 "data"=> NULL
				];
			}
			
		}
		else{
			$result = [
				 "status"=>403,
                 "statuscode"=>"KEY_MISSING",
				 "data"=> NULL
			];
		}
		
	$resultdata = json_encode($result);
		echo $resultdata;
		exit;
 }
	
	
 
 public function clearTreatmentCategory(){
	header('Access-Control-Allow-Origin: *');  
	header('Content-Type: application/json');
	$postdata = file_get_contents("php://input");
	$request = json_decode($postdata);
	$key = $request->key;
	$apikey = $this->apimodel->getAPIkey();
	$ptbid = $request->ptbid;
	$sessiondata = $request->session;
	
	if(!empty($key) && $apikey == trim($key)){
			
			$resultset = $this->apimodel->clearTreatmentCategory($ptbid,$sessiondata);
			if(sizeof($resultset)>0)
			{
				$result = [
				 "status"=>200,
                 "statuscode"=>"SUCCESS",
				 "data"=> $resultset
				];
			}
			else{
				$result = [
				 "status"=>400,
                 "statuscode"=>"ERROR",
				 "data"=> NULL
				];
			}
			
		}
		else{
			$result = [
				 "status"=>403,
                 "statuscode"=>"KEY_MISSING",
				 "data"=> NULL
			];
		}
		
	$resultdata = json_encode($result);
		echo $resultdata;
		exit;
 } 
 
	
	public function removePTBStatus(){
		header('Access-Control-Allow-Origin: *');  
		header('Content-Type: application/json');
		$postdata = file_get_contents("php://input");
		$request = json_decode($postdata);
		$key = $request->key;
		$apikey = $this->apimodel->getAPIkey();
		$patientdata = $request->data;
		$sessiondata = $request->session;
	
			if(!empty($key) && $apikey == trim($key)){
				
				$resultset = $this->apimodel->removePTBStatus($patientdata,$sessiondata);
				if(sizeof($resultset)>0)
				{
					$result = [
					 "status"=>200,
					 "statuscode"=>"SUCCESS",
					 "data"=> $resultset
					];
				}
				else{
					$result = [
					 "status"=>400,
					 "statuscode"=>"ERROR",
					 "data"=> NULL
					];
				}
				
			}
			else{
				$result = [
					 "status"=>403,
					 "statuscode"=>"KEY_MISSING",
					 "data"=> NULL
				];
			}
		
	$resultdata = json_encode($result);
		echo $resultdata;
		exit;
 }
 
 public function getActiveUserData(){
	header('Access-Control-Allow-Origin: *');  
	header('Content-Type: application/json');
	$postdata = file_get_contents("php://input");
	$request = json_decode($postdata);
	$key = $request->key;
	$apikey = $this->apimodel->getAPIkey();
	$sessiondata = $request->session;

		
	if(!empty($key) && $apikey == trim($key)){
			
			$resultset = $this->user->getActiveUserData($sessiondata);
			if(sizeof($resultset)>0)
			{
				$result = [
				 "status"=>200,
                 "statuscode"=>"SUCCESS",
				 "data"=> $resultset
				];
			}
			else{
				$result = [
				 "status"=>400,
                 "statuscode"=>"NO DATA FOUND",
				 "data"=> NULL
				];
			}
			
		}
		else{
			$result = [
				 "status"=>403,
                 "statuscode"=>"KEY_MISSING",
				 "data"=> NULL
			];
		}
		
	$resultdata = json_encode($result);
		echo $resultdata;
		exit;
 }
 
 
 
  public function isPatientExist(){
	header('Access-Control-Allow-Origin: *');  
	header('Content-Type: application/json');
	$postdata = file_get_contents("php://input");
	$request = json_decode($postdata);
	$key = $request->key;
	$apikey = $this->apimodel->getAPIkey();
	$ptbdata = $request->data;
	

		
	if(!empty($key) && $apikey == trim($key)){
			
			$isexist = $this->apimodel->checkIsPTBExist($ptbdata);
			if($isexist)
			{
				$result = [
				 "status"=>200,
                 "statuscode"=>"EXIST",
				 "data"=> NULL
				];
			}
			else{
				$result = [
				 "status"=>400,
                 "statuscode"=>"NOTEXIST",
				 "data"=> NULL
				];
			}
			
		}
		else{
			$result = [
				 "status"=>403,
                 "statuscode"=>"KEY_MISSING",
				 "data"=> NULL
			];
		}
		
	$resultdata = json_encode($result);
		echo $resultdata;
		exit;
 }
 
 
 
 
  private function generateToken()
 {
	$token="";
	$token = openssl_random_pseudo_bytes(16);
	$token = bin2hex($token);
	return $token;
 }
 
 
 private function validation($mobile,$password,$roleid)
 {
     if($mobile=="")
     {
         return false;
     }
     if($password=="")
     {
         return false;
     }
     if($roleid==""){
         return false;
     }
     
     return true;
 }
 
 
 
 
 

 
 
 
 
 
 
 
	private function sendSMS($phone,$sms_text){
		//$mantra_url = "http://myvaluefirst.com/smpp/sendsms?";
		$mantra_url = "http://203.212.70.200/smpp/sendsms?";
		$message = $sms_text;
		$feed=$this->mantraSend($phone,$message);
		return $feed;
	}
	
	private function mantraSend($phone,$msg){
		$mantra_user = "mantraapi1";
		$mantra_password = "mantraapi1";
		$mantra_url = "http://myvaluefirst.com/smpp/sendsms?";
		$mantra_from = "MANTRA";
		$mantra_udh = 0;
		
		/*$mantra_user = "shisapi";
		$mantra_password = "shisapi";
		$mantra_url = "http://203.212.70.200/smpp/sendsms?";
		$mantra_from = "SHISAP";
		$mantra_udh = 0;*/

      $url = 'username='.$mantra_user;
      $url.= '&password='.$mantra_password;
      $url.= '&to='.urlencode($phone);
      $url.= '&from='.$mantra_from;
      $url.= '&udh='.$mantra_udh;
      $url.= '&text='.urlencode($msg);
      $url.= '&dlr-mask=19&dlr-url*';

      echo $urltouse =  $mantra_url.$url;
		exit;
	  
	 $file = file_get_contents($urltouse);
      if ($file=="Sent.")
	  {
		  $response="Y";
	  }
	  else
	  {
          $response="N";
	  }

      return($response);
	}
	
 
 
 
 
 
 
 
 
}
