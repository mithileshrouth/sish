<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class dmcmodel extends CI_Model{
	public function __construct()
	{
	   // parent::__construct();
	
		$this->load->model('rolemastermodel','rolemodel',TRUE);
	}
	
	
	public function getAllDMC(){
		$data = [];
		$query = $this->db->select("
					dmc.id as dmcid,
					dmc.name as dmcname,
					dmc.address as dmcadd,
					dmc.mobile_no as ltmobile,
					dmc.lt_name ,
					dmc.is_active as active,
					tu_unit.name AS tuname,
					block.name as blockname
					")
				->from('dmc')
				->join('tu_unit','tu_unit.id = dmc.tuid','INNER')
				->join('block','block.id = tu_unit.block_id','INNER')
				->order_by('dmc.name')
				->get();
			
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

		public function getAllDMCbyRoll($where_dist){
		$data = [];
		$query = $this->db->select("
					dmc.id as dmcid,
					dmc.name as dmcname,
					dmc.address as dmcadd,
					dmc.mobile_no as ltmobile,
					dmc.lt_name ,
					dmc.is_active as active,
					tu_unit.name AS tuname,
					block.name as blockname
					")
				->from('dmc')
				->join('tu_unit','tu_unit.id = dmc.tuid','INNER')
				->join('block','block.id = tu_unit.block_id','INNER')
				->join('district','district.id = block.district_id','INNER')
				->where($where_dist)
				->order_by('dmc.name')
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

	public function getAllTUListbyDist($whereAry){
		$data = [];
		$query = $this->db->select("tu_unit.*")
				->from('tu_unit')
				->join('block','block.id = tu_unit.block_id','INNER')
				->join('district','district.id = block.district_id','INNER')
				->where($whereAry)
			    ->order_by('tu_unit.name')
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

	public function getAllDmcINTu($tu_ids){
		$data = [];
		
		$query = $this->db->select("
					dmc.id as dmcid,
					dmc.name as dmcname,
					dmc.address as dmcadd,
					dmc.mobile_no as ltmobile,
					dmc.lt_name ,
					dmc.is_active as active,
					tu_unit.name AS tuname,
					block.name as blockname
					")
				->from('dmc')
				->join('tu_unit','tu_unit.id = dmc.tuid','INNER')
				->join('block','block.id = tu_unit.block_id','INNER')
				->where_in('dmc.tuid', $tu_ids)
				->order_by('dmc.name')
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

	public function getAllDmcINblock($block_ids){
		$data = [];
		
		$query = $this->db->select("
					dmc.id as dmcid,
					dmc.name as dmcname,
					dmc.address as dmcadd,
					dmc.mobile_no as ltmobile,
					dmc.lt_name ,
					dmc.is_active as active,
					tu_unit.name AS tuname,
					block.name as blockname
					")
				->from('dmc')
				->join('tu_unit','tu_unit.id = dmc.tuid','INNER')
				->join('block','block.id = tu_unit.block_id','INNER')
				->where_in('block.id', $block_ids)
				->order_by('dmc.name')
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
	
	
	
	public function getAllActiveDMC(){
		$data = [];
		$query = $this->db->select("*")
				->from('dmc')
				->where('dmc.is_active',1)
				->order_by('dmc.name')
				->get();
			
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
	
	
	public function insertIntoDMC($data,$session){
		try {
            $this->db->trans_begin();
			
			$dmc_data = [];
			$user_data = [];
			
			$user_data = [
				"mobile_no" => trim(htmlspecialchars($data['mobile'])),
				"password" => trim(htmlspecialchars($data['ltpass'])),
				"role_id" => $this->rolemodel->getRoleIDByRoleType("DMC"),
				"project_id" => 1,
				"is_active" => 1
			];
			
			$this->db->insert('user_master', $user_data);
			$user_id = $this->db->insert_id();
			
			$dmc_data = [
				"name" => trim(htmlspecialchars($data['dmcname'])),
				"address" => trim(htmlspecialchars($data['dmcadd'])),
				"tuid" => trim(htmlspecialchars($data['seltu'])),
				"lt_name" => trim(htmlspecialchars($data['ltname'])),
				"mobile_no" => trim(htmlspecialchars($data['mobile'])),
				"userid" => $user_id,
				"project_id" => 1, // need to change dynamically according to requirement
				"is_active" => 1,
				"created_by" => $session['userid']
			];
			
			$this->db->insert('dmc', $dmc_data);
			
			$user_activity = array(
					"activity_module" => 'DMC',
					"action" => "Insert",
					"from_method" => "dmc/dmc_action/insertIntoDMC",
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
	
	
	public function getDMCEditDataByID($id){
		$data = [];
		$query = $this->db->select("
					dmc.id as dmcid,
					dmc.name as dmcname,
					dmc.address as dmcadd,
					dmc.mobile_no as ltmobile,
					dmc.tuid ,
					dmc.lt_name ,
					user_master.id as userid,
					user_master.password as userpass
					
				   ")
				->from('dmc')
			
				->join('user_master','user_master.id = dmc.userid','INNER')
				->where('dmc.id',$id)
				->order_by('dmc.name')
				->get();
			
			//echo $this->db->last_query();
			if($query->num_rows()> 0)
			{
				$data = $query->row();
	        }
			
	        return $data;
	}
	
	public function updateDMC($data,$session){
		try {
            $this->db->trans_begin();
			
			$dmc_data = [];
			$user_data = [];
			
			$user_data = [
				"mobile_no" => trim(htmlspecialchars($data['mobile'])),
				"password" => trim(htmlspecialchars($data['ltpass']))
			];
			
			$userid = trim(htmlspecialchars($data['uid']));
			$dmcId = trim(htmlspecialchars($data['dmcID']));
			
			$this->db->where('user_master.id', $userid);
			$this->db->update('user_master', $user_data); 
			
			
			
			$dmc_data = [
				"name" => trim(htmlspecialchars($data['dmcname'])),
				"address" => trim(htmlspecialchars($data['dmcadd'])),
				"tuid" => trim(htmlspecialchars($data['seltu'])),
				"lt_name" => trim(htmlspecialchars($data['ltname'])),
				"mobile_no" => trim(htmlspecialchars($data['mobile']))
				
			];
			
			$this->db->where('dmc.id', $dmcId);
			$this->db->update('dmc', $dmc_data); 
			
		
			
			$user_activity = array(
					"activity_module" => 'DMC',
					"action" => "Update",
					"from_method" => "dmc/dmc_action/updateDMC",
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

	
	/*----------------------API--------------------*/
	
	public function getDMCbyTU($tuid){
		$data = [];
		$where_param = [
			"dmc.is_active" => 1,
			"dmc.tuid" => $tuid
		];
				
		$query = $this->db->select("dmc.*")
				->from('dmc')
				->where($where_param)
				->order_by('dmc.name')
				->get();
				foreach($query->result() as $rows)
				{
					$data[] = $rows;
				}
				return $data;
	}
	
	
}