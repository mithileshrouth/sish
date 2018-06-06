<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class roleAPI extends CI_Controller{
public function __construct()
 {
   parent::__construct();
    $this->load->model('rolemastermodel','role',TRUE);
    $this->load->library('session');
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
}
