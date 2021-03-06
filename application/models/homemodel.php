<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class homemodel extends CI_Model
{
	public function __construct()
	{
	    parent::__construct();
	}
        public function getSearchResult($fromDate="",$todate="",$districtId="",$blockId="")
        {
            $data = "";
            $whereClause = "";
            if($districtId!="" && $blockId!=""){
               $whereClause =  " WHERE district.id =".$districtId." AND block.id=".$blockId; 
                    
            }elseif ($districtId!="" && $blockId=="") 
            {
                $whereClause = " WHERE district.id =".$districtId ;
            }else{
                $whereClause ="";
            }
            
            $sql="SELECT district.id as districtid,district.name AS district,block.name as block,
                    block.id as blockid
                    FROM district
                   INNER JOIN block ON district.id = block.district_id ".$whereClause." ORDER BY district.name,block.name" ;
            
            $query = $this->db->query($sql);
           
            if($query->num_rows()>0){
                
                $i=0;
                foreach($query->result() as $rows)
				{
                                        $i=$i+1;
					$data []= array(
                                            "serial"=>$i,
                                            "patient_reg_date"=>"",//$rows->patient_reg_date,
                                            "district"=>$rows->district,
                                            "block"=>$rows->block,
                                            "NFHP"=> $this->getNFHP($rows->blockid),
                                            "registered"=>$this->getRegisteredPatient($fromDate,$todate,$rows->districtid,$rows->blockid),
                                            "sputumClctDone"=>$this->getSputumCollectionCount($fromDate,$todate,$rows->districtid,$rows->blockid),
                                            "xrayCount"=> $this->getXrayCount($fromDate,$todate, $rows->districtid,$rows->blockid),
                                            "cbnaatCount"=> $this->getCbnaatCount($fromDate,$todate, $rows->districtid,$rows->blockid),
                                            "tbCount"=> $this->getTbDignCount($fromDate,$todate, $rows->districtid,$rows->blockid)
                                            
                                            
                                        );
				}
            }
            return $data;
            
            
        }
        public function getRegisteredPatient($fromDate="",$todate="",$districtId="",$blockId=""){
            $numberOfRegistered=0;
            $havingClause="";
            $whereClause="";
            if($districtId!="" && $blockId!=""){
                $havingClause = " HAVING patient.patient_district =".$districtId." AND patient.patient_block =".$blockId;
            }
            elseif ($districtId!="" && $blockId=="") 
            {
                $havingClause = " HAVING patient.patient_district =".$districtId ;
            }else{
                $havingClause ="";
            }
            if($fromDate!="" && $todate!=""){
                $whereClause=" WHERE DATE_FORMAT (patient.patient_reg_date,'%Y-%m-%d') BETWEEN '".$fromDate."' AND '".$todate."'";
            }elseif($fromDate!="" && $todate==""){
               $whereClause=" WHERE DATE_FORMAT (patient.patient_reg_date,'%Y-%m-%d') BETWEEN '".$fromDate."' AND '".date('Y-m-d')."'"; 
            }elseif ($fromDate=="" && $todate!="") 
            {
                $whereClause=" WHERE DATE_FORMAT (patient.patient_reg_date,'%Y-%m-%d') <= '".$todate."'";
            }
            else{
                $whereClause=" WHERE DATE_FORMAT (patient.patient_reg_date,'%Y-%m-%d') = '".date('Y-m-d')."'";
            }
            $sql = "SELECT COUNT(patient_id) AS registered,patient.patient_district,patient.patient_block
                    FROM patient
                    LEFT JOIN block ON patient.patient_block =block.id
                    LEFT JOIN district ON patient.patient_district = district.id".$whereClause.
                    " GROUP BY patient.patient_block ".$havingClause." ORDER BY district.name,block.name";
            
            $query = $this->db->query($sql);
           
            if($query->num_rows()>0){
                $data = $query->row();
                $numberOfRegistered = $data->registered;
               
            }
            return $numberOfRegistered;
            
        }
        
        public function getSputumCollectionCount($fromDate="",$todate="",$districtId,$blockId)
        {
            $sptumCount=0;
            
           if($fromDate!="" && $todate!=""){
                $whereClause=" WHERE DATE_FORMAT (patient.patient_reg_date,'%Y-%m-%d') BETWEEN '".$fromDate."' AND '".$todate."'";
            }elseif($fromDate!="" && $todate==""){
               $whereClause=" WHERE DATE_FORMAT (patient.patient_reg_date,'%Y-%m-%d') BETWEEN '".$fromDate."' AND '".date('Y-m-d')."'"; 
            }elseif ($fromDate=="" && $todate!="") 
            {
                $whereClause=" WHERE DATE_FORMAT (patient.patient_reg_date,'%Y-%m-%d') <= '".$todate."'";
            }
            else{
                $whereClause=" WHERE DATE_FORMAT (patient.patient_reg_date,'%Y-%m-%d') = '".date('Y-m-d')."'";
            }
            
            
            $sql = "SELECT COUNT(patient.dmc_result_done) AS no_of_spt_clct_trns,
                    patient.patient_district,
                    patient.patient_block
                    FROM patient
                    LEFT JOIN block ON patient.patient_block =block.id
                    LEFT JOIN district ON patient.patient_district = district.id ".$whereClause.
                    
                    " AND patient.dmc_result_done ='Y'
                    GROUP BY patient.patient_block
                    HAVING patient.patient_district =".$districtId."
                    AND patient.patient_block =".$blockId."
                    ORDER BY district.name,block.name";
            $query = $this->db->query($sql);
            if($query->num_rows()>0){
                 $data = $query->row();
		   $sptumCount = $data->no_of_spt_clct_trns;
            }
            return $sptumCount;
        }
        
        public function getXrayCount($fromDate="",$todate="",$districtId,$blockId){
            
            
            $noOfCount=0;
            
             if($fromDate!="" && $todate!=""){
                $whereClause=" WHERE DATE_FORMAT (patient.patient_reg_date,'%Y-%m-%d') BETWEEN '".$fromDate."' AND '".$todate."'";
            }elseif($fromDate!="" && $todate==""){
               $whereClause=" WHERE DATE_FORMAT (patient.patient_reg_date,'%Y-%m-%d') BETWEEN '".$fromDate."' AND '".date('Y-m-d')."'"; 
            }elseif ($fromDate=="" && $todate!="") 
            {
                $whereClause=" WHERE DATE_FORMAT (patient.patient_reg_date,'%Y-%m-%d') <= '".$todate."'";
            }
            else{
                $whereClause=" WHERE DATE_FORMAT (patient.patient_reg_date,'%Y-%m-%d') = '".date('Y-m-d')."'";
            }
            $sql="SELECT COUNT(patient.xray_is_done) AS no_of_xaray,
                    patient.patient_district,
                    patient.patient_block
                    FROM patient
                    LEFT JOIN block ON patient.patient_block =block.id
                    LEFT JOIN district ON patient.patient_district = district.id
                    ".$whereClause."
                    AND patient.xray_is_done='Y'
                    GROUP BY patient.patient_block
                    HAVING patient.patient_district =".$districtId."
                    AND patient.patient_block =".$blockId."
                    ORDER BY district.name";
                    
            $query = $this->db->query($sql);
            if($query->num_rows()>0){
                 $data = $query->row();
		   $noOfCount = $data->no_of_xaray;
            }
            return $noOfCount;
        }
        public function getCbnaatCount($fromDate="",$todate="",$districtId,$blockId){
            $noOfCbnaat=0;
            
          if($fromDate!="" && $todate!=""){
                $whereClause=" WHERE DATE_FORMAT (patient.patient_reg_date,'%Y-%m-%d') BETWEEN '".$fromDate."' AND '".$todate."'";
            }elseif($fromDate!="" && $todate==""){
               $whereClause=" WHERE DATE_FORMAT (patient.patient_reg_date,'%Y-%m-%d') BETWEEN '".$fromDate."' AND '".date('Y-m-d')."'"; 
            }elseif ($fromDate=="" && $todate!="") 
            {
                $whereClause=" WHERE DATE_FORMAT (patient.patient_reg_date,'%Y-%m-%d') <= '".$todate."'";
            }
            else{
                $whereClause=" WHERE DATE_FORMAT (patient.patient_reg_date,'%Y-%m-%d') = '".date('Y-m-d')."'";
            }
            $sql="SELECT COUNT(patient.is_cbnaat_done) AS no_of_cbnat,
                    patient.patient_district,
                    patient.patient_block
                    FROM patient
                    LEFT JOIN block ON patient.patient_block =block.id
                    LEFT JOIN district ON patient.patient_district = district.id
                    ".$whereClause."
                    AND patient.is_cbnaat_done='Y'
                    GROUP BY patient.patient_block
                    HAVING patient.patient_district =".$districtId."
                    AND patient.patient_block =".$blockId."
                    ORDER BY district.name";
                    
            $query = $this->db->query($sql);
            if($query->num_rows()>0){
                 $data = $query->row();
		   $noOfCbnaat = $data->no_of_cbnat;
            }
            return $noOfCbnaat;
        }
        
        public function getTbDignCount($fromDate="",$todate="",$districtId,$blockId)
        {
            $noOftbCount=0;
            
         if($fromDate!="" && $todate!=""){
                $whereClause=" WHERE DATE_FORMAT (patient.patient_reg_date,'%Y-%m-%d') BETWEEN '".$fromDate."' AND '".$todate."'";
            }elseif($fromDate!="" && $todate==""){
               $whereClause=" WHERE DATE_FORMAT (patient.patient_reg_date,'%Y-%m-%d') BETWEEN '".$fromDate."' AND '".date('Y-m-d')."'"; 
            }elseif ($fromDate=="" && $todate!="") 
            {
                $whereClause=" WHERE DATE_FORMAT (patient.patient_reg_date,'%Y-%m-%d') <= '".$todate."'";
            }
            else{
                $whereClause=" WHERE DATE_FORMAT (patient.patient_reg_date,'%Y-%m-%d') = '".date('Y-m-d')."'";
            }
            $sql="SELECT COUNT(patient.is_tb_diagnosed) AS no_of_tb,
                    patient.patient_district,
                    patient.patient_block
                    FROM patient
                    LEFT JOIN block ON patient.patient_block =block.id
                    LEFT JOIN district ON patient.patient_district = district.id
                    ".$whereClause."
                    AND patient.is_tb_diagnosed='Y'
                    GROUP BY patient.patient_block
                    HAVING patient.patient_district =".$districtId."
                    AND patient.patient_block =".$blockId."
                    ORDER BY district.name";
                    
            $query = $this->db->query($sql);
            if($query->num_rows()>0){
                 $data = $query->row();
		   $noOftbCount = $data->no_of_tb;
            }
            return $noOftbCount;
            
        }
        public function getNFHP($blockId)
        {
            $noOfNFHP = 0;
            $sql="SELECT COUNT(nqpp.id) AS nfhp
                    FROM nqpp 
                  GROUP BY 
                  nqpp.block_id
                  HAVING nqpp.block_id=".$blockId;
            $query = $this->db->query($sql);
            if($query->num_rows()>0){
                 $data = $query->row();
		   $noOfNFHP = $data->nfhp;
            }
            return $noOfNFHP;
            
        }
	
	
}