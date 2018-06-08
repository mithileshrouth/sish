<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class roleAPI extends CI_Controller{
public function __construct()
 {
    parent::__construct();
    $this->load->model('rolemastermodel','role',TRUE);
    $this->load->model('apimodel','apimodel',TRUE);
    $this->load->library('session');
 }


<<<<<<< HEAD
     $result = [];
     if($id=="all"){
=======

public function getrole($key,$id=""){
$apikey = $this->apimodel->getAPIkey();
$result = array();

    if($key!="" && $key==$apikey){
    if($id=="all"){
>>>>>>> origin/master
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
    }else{
         $result=array(
                 "status"=>403,
                 "statuscode"=>"KEY_MISSING",
                 "roles"=>"NULL"
             );
    }
     
    $json = json_encode($result);
    header('Access-Control-Allow-Origin: *'); 
    echo $json;
    exit();
     
 }
}
