<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class verifyAPI {
 public function __construct()
 {
    parent::__construct();
    $this->load->model('rolemastermodel','role',TRUE);
    $this->load->model('apimodel','apimodel',TRUE);
    $this->load->model('usermastermodel','user',TRUE);
    
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
             $userId = $this->apimodel->verifymobilelogin();
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
