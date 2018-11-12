<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class home extends CI_Controller {
    
public function __construct()
 {
   parent::__construct();
	
   $this->load->model("locationmodel","",TRUE);
   $this->load->model("nqppmodel","",TRUE);
   $this->load->model("homemodel","",TRUE);
	
 }
 public  function index(){
     
      $page = 'home/home';
      $result = [];
      $fromDate = date('Y-m-d');
      $result=[
        "district"=>$this->locationmodel->getAllDistrictList(),  
        "NFHP"=> count($this->nqppmodel->getAllNQPP()),
        "searchdata"=>$this->homemodel->getSearchResult($fromDate,"","")
      ];
      $this->load->view($page,$result);
 }
 
 public function getBlock(){
     
     $districtId = $this->input->post("districtId");
     $blocks=$this->locationmodel->getBlockBYDistrictID($districtId);
     $select="<select id='block-srch' name='block-srch' class='form-control'><option value=''>--Select Block--</option>";
     foreach($blocks as $value){
         $select.="<option value='".$value->id."'>".$value->name."</option>";
     }
     $select.="</select>";
     echo($select);
     exit();
 }
 
 public function getResultData(){
     $asondate =date('Y-m-d', strtotime($this->input->post("asondate"))) ;
     $disctrict = $this->input->post("disctrict");
     $blocksrch = $this->input->post("blocksrch");
//     $test=[
//       "asondate"=>date('Y-m-d', strtotime($asondate)) ,
//       "disctrict"=>$disctrict,
//       "blocksrch"=>$blocksrch
//         
//     ];
//     pre($test);
     $result["searchdata"] = $this->homemodel->getSearchResult($asondate,$disctrict,$blocksrch);
     
     $page = 'home/search_result';
     $this->load->view($page,$result);
     
     
 }
    
    
    
}
