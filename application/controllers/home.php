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
        "searchdata"=>$this->homemodel->getSearchResult("","","","")
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
     $asondate =($this->input->post("asondate")==""? "":date('Y-m-d', strtotime($this->input->post("asondate")))); 
     $todate = ($this->input->post("todate")==""? "":date('Y-m-d', strtotime($this->input->post("todate"))));//date('Y-m-d', strtotime($this->input->post("todate"))) ;
     $disctrict = $this->input->post("disctrict");
     $blocksrch = $this->input->post("blocksrch");
//     $test=[
//       "asondate"=>date('Y-m-d', strtotime($asondate)) ,
//       "disctrict"=>$disctrict,
//       "blocksrch"=>$blocksrch
//         
//     ];
//     pre($test);
     $result["searchdata"] = $this->homemodel->getSearchResult($asondate,$todate,$disctrict,$blocksrch);
     $result["toDate"] =  ($this->input->post("todate")==""? "":date('d-m-Y', strtotime($this->input->post("todate"))));
     $result["fromDate"] =  ($this->input->post("asondate")==""? "":date('d-m-Y', strtotime($this->input->post("asondate")))); 
     
     $page = 'home/search_result';
     $this->load->view($page,$result);
     
     
 }
    
    
    
}
