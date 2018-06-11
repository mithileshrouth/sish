<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class coordinatormodel extends CI_Model{
	
	public function __construct()
	{
	  $this->load->model('rolemastermodel','rolemodel',TRUE);
	}
	
	
	public function getAllCoordinator(){
		$data = [];
		$query = $this->db->select("
					coordinator.id as cordid,
					coordinator.name as cordname,
					coordinator.mobile_no as cordmobile,
					coordinator.post_office,
					coordinator.pin_code,
					coordinator.village,
					coordinator.full_address,
					coordinator.aadhar_no,
					coordinator.voter_id,
					coordinator.is_active as active,
					block.name as blockname,
					district.name as districtname,
					state.state,
					user_master.password as cordpsw
					")
				->from('coordinator')
				->join('block','block.id = coordinator.block_id','INNER')
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
	
	
	public function insertIntoCoordinator($data,$session){
		try {
            $this->db->trans_begin();
			
			$crd_data = [];
			$user_data = [];
			
			$user_data = [
				"mobile_no" => trim(htmlspecialchars($data['cordmobile'])),
				"password" => trim(htmlspecialchars($data['cordpassword'])),
				"role_id" => $this->rolemodel->getRoleIDByRoleType("CORD"),
				"project_id" => 1,
				"is_active" => 1
			];
			
			$this->db->insert('user_master', $user_data);
			$user_id = $this->db->insert_id();
			
			$crd_data = [
				"name" => trim(htmlspecialchars($data['cordname'])),
				"mobile_no" => trim(htmlspecialchars($data['cordmobile'])),
				"village" => trim(htmlspecialchars($data['cordvill'])),
				"post_office" => trim(htmlspecialchars($data['cordpo'])),
				"full_address" => trim(htmlspecialchars($data['cordadd'])),
				"pin_code" => trim(htmlspecialchars($data['cordpin'])),
				"block_id" => trim(htmlspecialchars($data['cordblock'])),
				"aadhar_no" => trim(htmlspecialchars($data['cordaadhar'])),
				"voter_id" => trim(htmlspecialchars($data['cordvoterid'])),
				"userid" => $user_id,
				"tu_id" => NULL,
				"project_id" => 1, // need to change dynamically according to requirement
				"is_active" => 1,
				"created_by" => $session['userid']
			];
			
			$this->db->insert('coordinator', $crd_data);
			
			$user_activity = array(
					"activity_module" => 'Coordinator',
					"action" => "Insert",
					"from_method" => "coordinator/coordinator_action/insertIntoCoordinator",
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
	
	
	public function getCoordinatorEditDataByID($id){
		$data = [];
		$query = $this->db->select("
					coordinator.id as cordid,
					coordinator.name as cordname,
					coordinator.mobile_no as cordmobile,
					coordinator.post_office,
					coordinator.pin_code,
					coordinator.village,
					coordinator.full_address,
					coordinator.aadhar_no,
					coordinator.voter_id,
					coordinator.block_id,
					coordinator.is_active as active,
					user_master.id as userid,
					user_master.password as cordpsw
					")
				->from('coordinator')
				->join('user_master','user_master.id = coordinator.userid','INNER')
				->where('coordinator.id',$id)
				->get();
			
			//echo $this->db->last_query();
			if($query->num_rows()> 0)
			{
				$data = $query->row();
	        }
			
	        return $data;
	}
	
	public function updateCoordinator($data,$session){
		try {
            $this->db->trans_begin();
			
			$crd_data = [];
			$user_data = [];
			
			$user_data = [
				"mobile_no" => trim(htmlspecialchars($data['cordmobile'])),
				"password" => trim(htmlspecialchars($data['cordpassword']))
			];
			
			$userid = trim(htmlspecialchars($data['cuid']));
			$cordID = trim(htmlspecialchars($data['cordID']));
			
			$this->db->where('user_master.id', $userid);
			$this->db->update('user_master', $user_data); 
			
			
			
			$crd_data = [
				"name" => trim(htmlspecialchars($data['cordname'])),
				"mobile_no" => trim(htmlspecialchars($data['cordmobile'])),
				"village" => trim(htmlspecialchars($data['cordvill'])),
				"post_office" => trim(htmlspecialchars($data['cordpo'])),
				"full_address" => trim(htmlspecialchars($data['cordadd'])),
				"pin_code" => trim(htmlspecialchars($data['cordpin'])),
				"block_id" => trim(htmlspecialchars($data['cordblock'])),
				"aadhar_no" => trim(htmlspecialchars($data['cordaadhar'])),
				"voter_id" => trim(htmlspecialchars($data['cordvoterid'])),
				"tu_id" => NULL
				
			];
			
			$this->db->where('coordinator.id', $cordID);
			$this->db->update('coordinator', $crd_data); 
			
		
			$user_activity = array(
					"activity_module" => 'Coordinator',
					"action" => "Update",
					"from_method" => "coordinator/coordinator_action/updateCoordinator",
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

	
	
}