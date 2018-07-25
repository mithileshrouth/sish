<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class locationmodel extends CI_Model{
	public function __construct()
	{
	   // parent::__construct();
	
		$this->load->model('rolemastermodel','rolemodel',TRUE);
	}
	
	
	/****************************************************************************/
	/*******************************BLOCK AREA**********************************/
	/**************************************************************************/
	
	public function getAllBlockList(){
		$data = [];
		$query = $this->db->select("
					block.id as blockid,
					block.name as blockname,
					block.block_code,
					block.is_active,
					district.name as districtname
					
					")
				->from('block')
				->join('district','district.id = block.district_id','INNER')
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
	
	public function getBlock($id=NULL){
			$data = [];
			
			if($id == "ALL"){
				$where_param = [
				"block.is_active" => 1
				];
				
			}
			else{
				$where_param = [
				"block.is_active" => 1,
				"block.id" => $id
				];
				
			}
			$query = $this->db->select("block.*")
					->from('block')
					->where($where_param)
					->order_by('block.name')
					->get();
				
			if($query->num_rows()> 0)
			{
				if($id == "ALL"){
					foreach($query->result() as $rows)
					{
						$data[] = $rows;
					}
				}
				else{
					 $data = $query->row();
				}
			}
			return $data;
		}
		
		public function getBlockBYDistrictID($distID){
			$data = [];
			$where_param = [
				"block.is_active" => 1,
				"district.id" => $distID
				];
				
				$query = $this->db->select("block.*")
					->from('block')
					->join('district','district.id=block.district_id')
					->where($where_param)
					->order_by('block.name')
					->get();
					foreach($query->result() as $rows)
					{
						$data[] = $rows;
					}
					return $data;
		}

		/********************************************************/
		/**************************STATE*************************/
		/********************************************************/
		
			public function getState($id=NULL){
			$data = [];
			
			if($id == "ALL"){
				$where_param = [
				"state.is_active" => 1
				];
				
			}
			else{
				$where_param = [
				"state.is_active" => 1,
				"state.id" => $id
				];
				
			}
			$query = $this->db->select("state.*")
					->from('state')
					->where($where_param)
					->order_by('state.state')
					->get();
				
			if($query->num_rows()> 0)
			{
				if($id == "ALL"){
				  foreach($query->result() as $rows)
				  {
					$data[] = $rows;
				  }
				}
				else{
					 $data = $query->row();
				}
			}
			return $data;
		}
		
		
		
		public function getStateByDistrictID($distID){
			$state_id = 0;
			$where = [
				"district.id"=>$distID,
				"district.is_active"=>1
			];
			$query = $this->db->select("*")
					->from("district")
					->join("state","state.id=district.state_id","INNER")
					->where($where)
					->get();
					
			if($query->num_rows()>0){
				$row = $query->row();
				$state_id = $row->state_id;
			}
			return $state_id;
		}
		
		
		/*******************************************************/
		/*****************************DISTRICT*****************/
		/*****************************************************/


	public function getAllDistrictList(){
		$data = [];
		$query = $this->db->select("
							 district.id,
							 district.dist_code,
							 district.is_active,
							 district.name,
							 district.dist_coordinator,
							 district.dist_cordinator_mbl,
							 state.state as state
					")
				->from('district')
				->join('state','state.id = district.state_id','INNER')
			    ->order_by('district.name')
				->get();
			#echo $this->db->last_query();	
			if($query->num_rows()> 0)
			{
	          foreach($query->result() as $rows)
				{
					$data[] = $rows;
				}
	             
	        }
			
	        return $data;
	       
		
	}


		public function getDistrict($id=NULL){
			$data = [];
			
			if($id == "ALL"){
				$where_param = [
				"district.is_active" => 1
				];
				
			}
			else{
				$where_param = [
				"district.is_active" => 1,
				"district.id" => $id
				];
				
			}
			$query = $this->db->select("district.*")
					->from('district')
					->where($where_param)
					->order_by('district.name')
					->get();
			//echo $this->db->last_query();	
			if($query->num_rows()> 0)
			{
				if($id == "ALL"){
				  foreach($query->result() as $rows)
					{
						$data[] = $rows;
					}
				}
				else{
					 $data = $query->row();
				}
			}
			return $data;
		}
		
		// Save District Data
		public function insertIntoDistrict($data,$session){
		try {
            $this->db->trans_begin();
			
			$district_data = [];
			$user_data = [];
			
			$user_data = [
				"mobile_no" => trim(htmlspecialchars($data['distcoordinatormbl'])),
				"password" => trim(htmlspecialchars($data['distcoordinatorpassword'])),
				"role_id" => $this->rolemodel->getRoleIDByRoleType("DISTCORD"),
				"project_id" => 1,
				"is_active" => 1
			];
			
			$this->db->insert('user_master', $user_data);
				
			$user_id = $this->db->insert_id();
			
				$district_data = [
					"name" => trim(htmlspecialchars($data['districtname'])),
					"dist_code" => trim(htmlspecialchars($data['districtcode'])),
					"state_id" => trim(htmlspecialchars($data['state'])),
					"dist_coordinator" => trim(htmlspecialchars($data['distcoordinator'])),
					"dist_cordinator_mbl" => trim(htmlspecialchars($data['distcoordinatormbl'])),
					"userid" => $user_id,
					"project_id" => 1, // need to change dynamically according to requirement
					"is_active" => 1,
					"created_by" => $session['userid']
				];
			
				$this->db->insert('district', $district_data);
				
				
				$user_activity = array(
					"activity_module" => 'District',
					"action" => 'Insert',
					"from_method" => 'district/district_action/insertIntoDistrict',
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
	
	
	// update district data
		public function updateDistrict($data,$session){
		try {
            $this->db->trans_begin();
			
			$district_data = [];
			$user_data = [];
			
			$user_data = [
				"mobile_no" => trim(htmlspecialchars($data['distcoordinatormbl'])),
				"password" => trim(htmlspecialchars($data['distcoordinatorpassword'])),
			];
			
			$userid = trim(htmlspecialchars($data['uid']));
			$districtID = trim(htmlspecialchars($data['districtID']));
			
			$this->db->where('user_master.id', $userid);
			$this->db->update('user_master', $user_data); 
			
			
			
			$district_data = [
				"name" => trim(htmlspecialchars($data['districtname'])),
				"dist_code" => trim(htmlspecialchars($data['districtcode'])),
				"state_id" => trim(htmlspecialchars($data['state'])),
				"dist_coordinator" => trim(htmlspecialchars($data['distcoordinator'])),
				"dist_cordinator_mbl" => trim(htmlspecialchars($data['distcoordinatormbl']))
			];
			
			$this->db->where('district.id', $districtID);
			$this->db->update('district', $district_data); 
			
		
			
			$user_activity = array(
					"activity_module" => 'District',
					"action" => 'Update',
					"from_method" => 'district/district_action/updateDistrict',
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
	
	public function getDistrictEditDataByID($id){
		$data = [];
		$query = $this->db->select("
					district.id as distid,
					district.name as distname,
					district.dist_code,
					district.state_id,
					district.dist_coordinator,
					district.dist_cordinator_mbl ,
					district.is_active as active ,
					user_master.id as userid,
					user_master.password as userpass
					")
				->from('district')
			
				->join('user_master','user_master.id = district.userid','INNER')
				->where('district.id',$id)
				->order_by('district.name')
				->get();
			
			//echo $this->db->last_query();
			if($query->num_rows()> 0)
			{
				$data = $query->row();
	        }
			
	        return $data;
	}
	
	/*******************************************************/
	/********************COUNTRY***************************/
	/*****************************************************/


		public function getCountry($id=NULL){
			$data = [];
			
			if($id == "ALL"){
				$where_param = [];
				
			}
			else{
				$where_param = [
					"country.id" => $id
				];
				
			}
			$query = $this->db->select("country.*")
					->from('country')
					->where($where_param)
					->order_by('country.name')
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
		
		public function getCountryIDByStateID($sateID){
			$country_id = 0;
			$where = [
				"state.id"=>$sateID,
				"state.is_active"=>1
			];
			$query = $this->db->select("*")
					->from("state")
					->join("country","country.id=state.country_id","INNER")
					->where($where)
					->get();
					
			if($query->num_rows()>0){
				$row = $query->row();
				$country_id = $row->country_id;
			}
			return $country_id;
		}
		
		
		
	
	
}