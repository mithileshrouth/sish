<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class nqppmodel extends CI_Model{
	
	public function __construct()
	{
	  $this->load->model('rolemastermodel','rolemodel',TRUE);
	}
	
	
	public function getAllNQPP(){
		$data = [];
		$query = $this->db->select("
					nqpp.id as nqppid,
					nqpp.name as nqppname,
					nqpp.mobile_no as nqppmobile,
					nqpp.post_office,
					nqpp.pin_code,
					nqpp.village,
					nqpp.panchayat,
					nqpp.full_address,
					nqpp.aadhar_no,
					nqpp.voter_id,
					nqpp.is_active as active,
					block.name as blockname,
					coordinator.name as cordinatorname,
					district.name as districtname,
					state.state,
					user_master.password as cordpsw
					")
				->from('nqpp')
				/*->join('block','block.id = coordinator.block_id','INNER')*/
				->join('block','block.id = nqpp.block_id','INNER')
				->join('coordinator','coordinator.id = nqpp.coordinator_id','INNER')
				->join('district','district.id = block.district_id','INNER')
				->join('state','state.id = district.state_id','INNER')
				->join('user_master','user_master.id = coordinator.userid','INNER')
				->order_by('coordinator.name')
				->get();
			
		
			if($query->num_rows()> 0)
			{
	          foreach($query->result() as $rows)
				{
					$data[] = $rows;
				}
	             
	        }
			
	        return $data;
	       
	}

		public function getAllNQPPByRoll($where_dist){
		$data = [];
		$query = $this->db->select("
					nqpp.id as nqppid,
					nqpp.name as nqppname,
					nqpp.mobile_no as nqppmobile,
					nqpp.post_office,
					nqpp.pin_code,
					nqpp.village,
					nqpp.panchayat,
					nqpp.full_address,
					nqpp.aadhar_no,
					nqpp.voter_id,
					nqpp.is_active as active,
					block.name as blockname,
					coordinator.name as cordinatorname,
					district.name as districtname,
					state.state,
					user_master.password as cordpsw
					")
				->from('nqpp')
				/*->join('block','block.id = coordinator.block_id','INNER')*/
				->join('block','block.id = nqpp.block_id','INNER')
				->join('coordinator','coordinator.id = nqpp.coordinator_id','INNER')
				->join('district','district.id = block.district_id','INNER')
				->join('state','state.id = district.state_id','INNER')
				->join('user_master','user_master.id = coordinator.userid','INNER')
				->where($where_dist)
				->order_by('coordinator.name')
				->get();
			
		
			if($query->num_rows()> 0)
			{
	          foreach($query->result() as $rows)
				{
					$data[] = $rows;
				}
	             
	        }
			
	        return $data;
	       
	}
	public function getAllNfhpINCordinator($cordinator_ids){
		$data = [];
		
		$query = $this->db->select("
					nqpp.id as nqppid,
					nqpp.name as nqppname,
					nqpp.mobile_no as nqppmobile,
					nqpp.post_office,
					nqpp.pin_code,
					nqpp.village,
					nqpp.panchayat,
					nqpp.full_address,
					nqpp.aadhar_no,
					nqpp.voter_id,
					nqpp.is_active as active,
					block.name as blockname,
					coordinator.name as cordinatorname,
					district.name as districtname,
					state.state,
					user_master.password as cordpsw
					")
				->from('nqpp')
				
				->join('block','block.id = nqpp.block_id','INNER')
				->join('coordinator','coordinator.id = nqpp.coordinator_id','INNER')
				->join('district','district.id = block.district_id','INNER')
				->join('state','state.id = district.state_id','INNER')
				->join('user_master','user_master.id = coordinator.userid','INNER')
				->where_in('nqpp.coordinator_id', $cordinator_ids)
				->order_by('coordinator.name')
				->get();
			#q();
			if($query->num_rows()> 0)
			{
	          foreach($query->result() as $rows)
				{
					$data[] = $rows;
				}
	             
	        }
			
	        return $data;
	       
		
	}


	public function getAllBlockListByRole($where_dist){
		$data = [];
		$query = $this->db->select("block.*")
				->from('block')
				->join('district','district.id = block.district_id','INNER')
				->where($where_dist)
			    ->order_by('block.name')
				->get();
			
			if($query->num_rows()> 0)
			{
	          foreach($query->result() as $rows)
				{
					$data[] = $rows;
				}
	             
	        }
			
	        return $data;
	       
		
	}

	public function getAllCoordinatorbyRole($distwhere){
		$data = [];
		$query = $this->db->select("coordinator.*")
				->from('coordinator')
				->join('block','block.id = coordinator.block_id','INNER')
				->join('district','district.id = block.district_id','INNER')
				->join('state','state.id = district.state_id','INNER')
				->join('user_master','user_master.id = coordinator.userid','INNER')
				->where($distwhere)
				->order_by('coordinator.name')
				->get();
			
		
			if($query->num_rows()> 0)
			{
	          foreach($query->result() as $rows)
				{
					$data[] = $rows;
				}
	             
	        }
			
	        return $data;
	       
	}


	public function getAllNfhpINBlock($block_ids){
		$data = [];
		
		$query = $this->db->select("
					nqpp.id as nqppid,
					nqpp.name as nqppname,
					nqpp.mobile_no as nqppmobile,
					nqpp.post_office,
					nqpp.pin_code,
					nqpp.village,
					nqpp.panchayat,
					nqpp.full_address,
					nqpp.aadhar_no,
					nqpp.voter_id,
					nqpp.is_active as active,
					block.name as blockname,
					coordinator.name as cordinatorname,
					district.name as districtname,
					state.state,
					user_master.password as cordpsw
					")
				->from('nqpp')
				
				->join('block','block.id = nqpp.block_id','INNER')
				->join('coordinator','coordinator.id = nqpp.coordinator_id','INNER')
				->join('district','district.id = block.district_id','INNER')
				->join('state','state.id = district.state_id','INNER')
				->join('user_master','user_master.id = coordinator.userid','INNER')
				->where_in('nqpp.block_id', $block_ids)
				->order_by('coordinator.name')
				->get();
			#q();
			if($query->num_rows()> 0)
			{
	          foreach($query->result() as $rows)
				{
					$data[] = $rows;
				}
	             
	        }
			
	        return $data;
	       
		
	}

		public function getAllNfhpINDistrict($district_ids){
		$data = [];
		
		$query = $this->db->select("
					nqpp.id as nqppid,
					nqpp.name as nqppname,
					nqpp.mobile_no as nqppmobile,
					nqpp.post_office,
					nqpp.pin_code,
					nqpp.village,
					nqpp.panchayat,
					nqpp.full_address,
					nqpp.aadhar_no,
					nqpp.voter_id,
					nqpp.is_active as active,
					block.name as blockname,
					coordinator.name as cordinatorname,
					district.name as districtname,
					state.state,
					user_master.password as cordpsw
					")
				->from('nqpp')
				
				->join('block','block.id = nqpp.block_id','INNER')
				->join('coordinator','coordinator.id = nqpp.coordinator_id','INNER')
				->join('district','district.id = block.district_id','INNER')
				->join('state','state.id = district.state_id','INNER')
				->join('user_master','user_master.id = coordinator.userid','INNER')
				->where_in('district.id', $district_ids)
				->order_by('coordinator.name')
				->get();
			#q();
			if($query->num_rows()> 0)
			{
	          foreach($query->result() as $rows)
				{
					$data[] = $rows;
				}
	             
	        }
			
	        return $data;
	       
		
	}
	
	
	public function insertIntoNqpp($data,$session){
		try {
            $this->db->trans_begin();
			
			$nqpp_data = [];
			$user_data = [];
			
			$user_data = [
				"mobile_no" => trim(htmlspecialchars($data['nqppmobile'])),
				"password" => trim(htmlspecialchars($data['nqpppassword'])),
				"role_id" => $this->rolemodel->getRoleIDByRoleType("NQPP"),
				"project_id" => 1,
				"is_active" => 1
			];
			
			
			
			$this->db->insert('user_master', $user_data);
			$user_id = $this->db->insert_id();
			
			$nqpp_data = [
				"coordinator_id" => trim(htmlspecialchars($data['coordinator'])),
				"name" => trim(htmlspecialchars($data['nqppname'])),
				"gender" => trim(htmlspecialchars($data['nqppgender'])),
				"mobile_no" => trim(htmlspecialchars($data['nqppmobile'])),
				"village" => trim(htmlspecialchars($data['nqppvill'])),
				"panchayat" => trim(htmlspecialchars($data['nqpppanchayat'])),
				"post_office" => trim(htmlspecialchars($data['nqpppo'])),
				"full_address" => trim(htmlspecialchars($data['nqppadd'])),
				"pin_code" => trim(htmlspecialchars($data['nqpppin'])),
				"block_id" => trim(htmlspecialchars($data['nqppblock'])),
				"aadhar_no" => trim(htmlspecialchars($data['nqppaadhar'])),
				"voter_id" => trim(htmlspecialchars($data['nqppvoterid'])),
				"userid" => $user_id,
				
				"project_id" => 1, // need to change dynamically according to requirement
				"is_active" => 1,
				"created_by" => $session['userid']
			];
			
			
			$this->db->insert('nqpp', $nqpp_data);
			
			$user_activity = array(
					"activity_module" => 'NQPP',
					"action" => "Insert",
					"from_method" => "nqpp/nqpp_action/insertIntoNqpp",
					"user_id" => $session['userid'],
					"ip_address" => getUserIPAddress(),
					"user_browser" => getUserBrowserName(),
					"user_platform" => getUserPlatform()
				);
			
			$this->db->insert('activity_log', $user_activity);
           
            if($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return false;
            } else {
                $this->db->trans_commit();
                return true;
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
	}
	
	
	public function getNQPPEditDataByID($id){
		$data = [];
		$query = $this->db->select("
					nqpp.id as nqppid,
					nqpp.name as nqppname,
					nqpp.mobile_no as nqppmobile,
					nqpp.coordinator_id,
					nqpp.post_office,
					nqpp.pin_code,
					nqpp.village,
					nqpp.panchayat,
					nqpp.full_address,
					nqpp.aadhar_no,
					nqpp.voter_id,
					nqpp.block_id,
					nqpp.gender,
					nqpp.is_active as active,
					user_master.id as userid,
					user_master.password as nqpppsw
					")
				->from('nqpp')
				->join('user_master','user_master.id = nqpp.userid','INNER')
				->where('nqpp.id',$id)
				->get();
			//q();
			//echo $this->db->last_query();
			if($query->num_rows()> 0)
			{
				$data = $query->row();
	        }
			
	        return $data;
	}
	
	public function updateNqpp($data,$session){
		try {
            $this->db->trans_begin();
			
			$nqpp_data = [];
			$user_data = [];
			
			$user_data = [
				"mobile_no" => trim(htmlspecialchars($data['nqppmobile'])),
				"password" => trim(htmlspecialchars($data['nqpppassword']))
			];
			
			$userid = trim(htmlspecialchars($data['nqppuid']));
			$nqppID = trim(htmlspecialchars($data['nqppID']));
			
			$this->db->where('user_master.id', $userid);
			$this->db->update('user_master', $user_data); 
			
			
			
			$nqpp_data = [
				"coordinator_id" => trim(htmlspecialchars($data['coordinator'])),
				"name" => trim(htmlspecialchars($data['nqppname'])),
				"gender" => trim(htmlspecialchars($data['nqppgender'])),
				"mobile_no" => trim(htmlspecialchars($data['nqppmobile'])),
				"village" => trim(htmlspecialchars($data['nqppvill'])),
				"panchayat" => trim(htmlspecialchars($data['nqpppanchayat'])),
				"post_office" => trim(htmlspecialchars($data['nqpppo'])),
				"full_address" => trim(htmlspecialchars($data['nqppadd'])),
				"pin_code" => trim(htmlspecialchars($data['nqpppin'])),
				"block_id" => trim(htmlspecialchars($data['nqppblock'])),
				"aadhar_no" => trim(htmlspecialchars($data['nqppaadhar'])),
				"voter_id" => trim(htmlspecialchars($data['nqppvoterid']))
				
			];
			
			$this->db->where('nqpp.id', $nqppID);
			$this->db->update('nqpp', $nqpp_data); 
			
		
			$user_activity = array(
					"activity_module" => 'NQPP',
					"action" => "Update",
					"from_method" => "nqpp/nqpp_action/updateNqpp",
					"user_id" => $session['userid'],
					"ip_address" => getUserIPAddress(),
					"user_browser" => getUserBrowserName(),
					"user_platform" => getUserPlatform()
					
					
				);
			
			$this->db->insert('activity_log', $user_activity);
           
            if($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return false;
            } else {
                $this->db->trans_commit();
                return true;
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
	}

	/*-----------For API------------*/
	public function getNQPPbyCoordinator($corduserid){
		$data = [];
		$where = [
			"nqpp.is_active"=>1,
			"coordinator.userid"=>$corduserid
		];
		$query = $this->db->select("nqpp.id,nqpp.name")
				->from('nqpp')
				->join('coordinator','coordinator.id = nqpp.coordinator_id')
				->where($where)
				->order_by('nqpp.name','ASC')
				->get();
			
			if($query->num_rows()> 0)
			{
	          foreach($query->result() as $rows)
				{
					$data[] = $rows;
				}
	             
	        }
			
	        return $data;
	}
	
	public function getNqppByCoordID($cordid){
		$data = [];
		$where = [
			"nqpp.is_active"=>1,
			"nqpp.coordinator_id"=>$cordid
		];
		$query = $this->db->select("nqpp.id,nqpp.name")
				->from('nqpp')
			
				->where($where)
				->order_by('nqpp.name','ASC')
				->get();
			
			if($query->num_rows()> 0)
			{
	          foreach($query->result() as $rows)
				{
					$data[] = $rows;
				}
	             
	        }
			
	        return $data;
	}
	
	/*
	public function getNQPPbyDistCodeUserID($distcorduid){
		$data = [];
		$where = [
			"nqpp.is_active"=>1,
			"district.userid"=>$distcorduid
		];
		$query = $this->db->select("nqpp.id,nqpp.name")
				->from('nqpp')
				->join('coordinator','coordinator.id = nqpp.coordinator_id')
				->where($where)
				->order_by('nqpp.name','ASC')
				->get();
			
			if($query->num_rows()> 0)
			{
	          foreach($query->result() as $rows)
				{
					$data[] = $rows;
				}
	             
	        }
			
	        return $data;
	}
	*/
	
	public function getNQPPbyUserID($userid){
		$data = [];
		$where = [
			"nqpp.is_active"=>1,
			"nqpp.userid"=>$userid
		];
		$query = $this->db->select("nqpp.id,nqpp.name")
				->from('nqpp')
				->where($where)
				->get();
			
			if($query->num_rows()> 0)
			{
	          foreach($query->result() as $rows)
				{
					$data[] = $rows;
				}
	             
	        }
			
	        return $data;
	}



/*-------------------------File upload------------------*/




public function insertImportFileDataIntoNqpp($insertArray,$objReader,$session)
	{

		try
	 	{
	 		$this->db->trans_begin();
			
			$investigation_upload = $this->db->insert('nqpp_files_upload_master', $insertArray);
			$investigation_upload_id = $this->db->insert_id();
			//$investigation_upload_id = 5;

			$filename =  APPPATH .'assets/ds-documents/nqpp_upload/'.$insertArray['random_file_name'];
			$objReader->setReadDataOnly(true); 		
			$objPHPExcel=$objReader->load($filename);		 
         	$totalrows=$objPHPExcel->setActiveSheetIndex(0)->getHighestRow();   //Count Numbe of rows avalable in excel      	 
         	$objWorksheet=$objPHPExcel->setActiveSheetIndex(0);    
			
			$ins_investigations_master = array();
         	for($i=2;$i<=$totalrows;$i++)
          	{
            	$sl = $objWorksheet->getCellByColumnAndRow(0,$i)->getValue(); //Excel Column 1
			  	$name = ucfirst(strtolower(trim(htmlspecialchars($objWorksheet->getCellByColumnAndRow(1,$i)->getValue())))); //Excel Column 2
			  	$mobile_no = trim(htmlspecialchars($objWorksheet->getCellByColumnAndRow(2,$i)->getValue())); //Excel Column 3
			  	$village = ucfirst(strtolower(trim(htmlspecialchars($objWorksheet->getCellByColumnAndRow(3,$i)->getValue())))); //Excel Column 4
			  	$panchayat = ucfirst(strtolower(trim(htmlspecialchars($objWorksheet->getCellByColumnAndRow(4,$i)->getValue())))); //Excel Column 5
			  	$dmcname = ucfirst(strtolower(trim(htmlspecialchars($objWorksheet->getCellByColumnAndRow(5,$i)->getValue())))); //Excel Column 6
			  	$blockname = ucfirst(strtolower(trim(htmlspecialchars($objWorksheet->getCellByColumnAndRow(6,$i)->getValue())))); //Excel Column 7
			  


				$dmcid=$this->getDmcIdbyName($dmcname);
				$blockid=$this->getBlockIdbyName($blockname);


				
				
				$user_data = [
				"mobile_no" => trim(htmlspecialchars($mobile_no)),
				"password" => trim(htmlspecialchars($mobile_no)),
				"role_id" => $this->rolemodel->getRoleIDByRoleType("NQPP"),
				"project_id" => 1,
				"is_active" => 1
			    ];

			    $this->db->insert('user_master', $user_data);
			    $user_id = $this->db->insert_id();
				
					$nqpp_data_ins_arry = [
						"coordinator_id" => 38, // It will be change 
						"name" => $name,
						"mobile_no" => $mobile_no,
						"village" => $village,
						"panchayat" => $panchayat,
						"dmc_id" => $dmcid,
						"block_id" => $blockid,
						"is_active" => 1,
						"userid" => $user_id
						
					]; 
				$this->db->insert('nqpp', $nqpp_data_ins_arry);	
			
				

            }

            	if($this->db->trans_status() === FALSE) 
				{
		            $this->db->trans_rollback();
		            return false;
		        } 
			else 
				{
		            $this->db->trans_commit();
		            return true;
		        }
            }
			catch (Exception $err) 
			{
	            echo $err->getTraceAsString();
	        }   

	}



	public function getDmcIdbyName($name){
		$dmcid = 0;
		$query = $this->db->select("*")
				->from("dmc")
				->where('dmc.name', $name)
				->limit(1)
				->get();
				
		if ($query->num_rows() > 0) 
		{
		   $data = $query->row();
		   $dmcid = $data->id;
		}
		
		return $dmcid;
	}

		public function getBlockIdbyName($name){
		$blockid = 0;
		$query = $this->db->select("*")
				->from("block")
				->where('block.name', $name)
				->limit(1)
				->get();
				
		if ($query->num_rows() > 0) 
		{
		   $data = $query->row();
		   $blockid = $data->id;
		}
		
		return $blockid;
	}
	
	/*
		@by Mithilesh
		@date 26.07.2018
	*/
	public function getNqppByCoordAndRole($coordid,$sessiondata){
		$data = [];
			$role = $sessiondata->rcode;
			$userid = $sessiondata->uid;
			
			
			if($role=="CORD"){
				$where_param = [
					"nqpp.is_active" => 1,
					"coordinator.userid" => $userid,
					"nqpp.coordinator_id" => $coordid
				];
				$query = $this->db->select("nqpp.*")
								  ->from('nqpp')
								  ->join('coordinator','coordinator.id = nqpp.coordinator_id','INNER')
								  ->where($where_param)
								  ->order_by('nqpp.name')
								  ->get();
			}
			
			elseif($role=="NQPP"){
				$where_param = [
					"nqpp.is_active" => 1,
					"nqpp.userid" => $userid,
					"nqpp.coordinator_id" => $coordid
				];
				$query = $this->db->select("nqpp.*")
								  ->from('nqpp')
								  ->where($where_param)
								  ->order_by('nqpp.name')
								  ->get();
			}
			else{
				$where_param = [
					"nqpp.is_active" => 1,
					"nqpp.coordinator_id" => $coordid
					
				];
				$query = $this->db->select("nqpp.*")
								  ->from('nqpp')
								  ->where($where_param)
								  ->order_by('nqpp.name')
								  ->get();
			}
			
			//echo $this->db->last_query();
			
			
			if($query->num_rows()> 0)
			{
				foreach($query->result() as $rows)
					{
						$data[] = $rows;
					}
			}
				
			
			return $data;
	}
	
	
}