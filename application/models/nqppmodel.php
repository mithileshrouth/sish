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
				"mobile_no" => trim(htmlspecialchars($data['nqppmobile'])),
				"village" => trim(htmlspecialchars($data['nqppvill'])),
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
					nqpp.full_address,
					nqpp.aadhar_no,
					nqpp.voter_id,
					nqpp.block_id,
					nqpp.is_active as active,
					user_master.id as userid,
					user_master.password as nqpppsw
					")
				->from('nqpp')
				->join('user_master','user_master.id = nqpp.userid','INNER')
				->where('nqpp.id',$id)
				->get();
			
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
				"mobile_no" => trim(htmlspecialchars($data['nqppmobile'])),
				"village" => trim(htmlspecialchars($data['nqppvill'])),
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

	
	
}