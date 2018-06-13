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
 
  public function getuser(){
//     $key = $this->input->get('key');
//     $mobile = $this->input->get('mobile');
//     $password = $this->input->get('password');
//     $roleid = $this->input->get('roleid');
  
     //$input = file_get_contents('php://input');
     $_POST = json_decode(file_get_contents("php://input"), true);
     $key = $this->input->post('key');
     $mobile = $this->input->post('mobile');
     $password = $this->input->post('password');
     $roleid = $this->input->post('roleid');
     
     
     $apikey = $this->apimodel->getAPIkey();
     $result = array();
     if($key!="" && $key==$apikey){
         if(!validation($mobile,$password,$roleid)){
             $result=array(
                 "status"=>401,
                 "statuscode"=>"FIELD_EMPTY",
                 "user"=>"NULL"
             );
         }else{
             $userId = $this->apimodel->verifymobilelogin($mobile,$password,$roleid,$projectid);
             if($userId>0){
                 $user = $this->user->getUserById($userId);
                 if(!empty($user)){
                     $result=array(
                        "status"=>200,
                        "statuscode"=>"SUCCESS",
                        "user"=>array($user)
                    );
                 }else{
                     $result=array(
                        "status"=>420,
                        "statuscode"=>"IN_ACTIVE",
                        "user"=>"NULL"
                    );
                 }
                 
             }else{
               $result=array(
                 "status"=>402,
                 "statuscode"=>"INVALID_AUTH",
                 "user"=>"NULL"
                );  
             }
             
         }
     }else{
           $result=array(
                 "status"=>403,
                 "statuscode"=>"KEY_MISSING",
                 "user"=>"NULL"
             );
     }
    $json = json_encode($result);
    header('Access-Control-Allow-Origin: *'); 
    echo $json;
    exit();
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
                        "user"=>array($user)
                    );
                 }else{
                     $result=array(
                        "status"=>420,
                        "statuscode"=>"IN_ACTIVE",
                        "user"=>"NULL"
                    );
                 }
                 
             }else{
               $result=array(
                 "status"=>402,
                 "statuscode"=>"INVALID_AUTH",
                 "user"=>"NULL"
                );  
             }
             
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
 
 
 public function registerPTB(){
	header('Access-Control-Allow-Origin: *');  
	header('Content-Type: application/json');
	$postdata = file_get_contents("php://input");
	$request = json_decode($postdata);
	pre($request);
	
	
	
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
 
 
}
