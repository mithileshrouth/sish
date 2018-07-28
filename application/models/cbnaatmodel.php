<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class cbnaatmodel extends CI_Model{
	public function __construct()
	{
	   // parent::__construct();
	
		$this->load->model('rolemastermodel','rolemodel',TRUE);
	}
	
	
	public function getAllCbnaat(){
		$data = [];
		$query = $this->db->select("
					`cbnaat`.`id` AS cbnat_id,
					`cbnaat`.`name` AS cbnat_name,
					`cbnaat`.`address` AS cbnat_add,
					`cbnaat`.`lt_name`,
					`cbnaat`.`mobile_no` AS ltmobile,
					`cbnaat`.`is_active` AS active,
						tu_unit.name AS tuname,
						block.name as blockname
						")
				->from('cbnaat')
				->join('tu_unit','tu_unit.id = cbnaat.tuid','INNER')
				->join('block','block.id = tu_unit.block_id','INNER')
				->order_by('cbnaat.tuid')
				->get();
				 //q();
			
			if($query->num_rows()> 0)
			{
                            foreach($query->result() as $rows)
				{
					$data[] = $rows;
				}
	             
                        }
			
	        return $data;
	       
	}
	
	
	public function insertIntoCbnaatCenter($data,$session){
		try {
            $this->db->trans_begin();
			
			$cbnaatcntr_data = [];
			$user_data = [];
			
			/*$user_data = [
				"mobile_no" => trim(htmlspecialchars($data['mobile'])),
				"password" => trim(htmlspecialchars($data['ltpass'])),
				"role_id" => $this->rolemodel->getRoleIDByRoleType("CBNAAT"),
				"project_id" => 1,
				"is_active" => 1
			];
			
			$this->db->insert('user_master', $user_data);
			$user_id = $this->db->insert_id();*/
			
			$cbnaatcntr_data = [
				"name" => trim(htmlspecialchars($data['cbnatcntrname'])),
				"address" => trim(htmlspecialchars($data['cbnatcntradd'])),
				"tuid" => trim(htmlspecialchars($data['seltu'])),
				"lt_name" => NULL,
				"mobile_no" => NULL,
				"userid" => NULL,
				"project_id" => 1, // need to change dynamically according to requirement
				"is_active" => 1,
				"created_by" => $session['userid']
			];
			
			$this->db->insert('cbnaat', $cbnaatcntr_data);
			
			$user_activity = array(
					"activity_module" => 'CB-NAAT Center',
					"action" => "Insert",
					"from_method" => "cbnaat/cbnaat_action/insertIntoCbnaat",
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
	
	
	public function getCbnaatEditDataByID($id){
		$data = [];
		$query = $this->db->select("

			`cbnaat`.`id` AS cbnatId,
					`cbnaat`.`name` AS cbnat_name,
					`cbnaat`.`address` AS cbnat_add,
					`cbnaat`.`lt_name`,
					`cbnaat`.`mobile_no` AS ltmobile,
					`cbnaat`.tuid
				
					
				   ")

				->from('cbnaat')

				->where('cbnaat.id',$id)
				->order_by('cbnaat.name')
				->get();
			//q();
			//echo $this->db->last_query();
			if($query->num_rows()> 0)
			{
				$data = $query->row();
	        }
			
	        return $data;
	}
	
	public function updateCbnaatCenter($data,$session){
		try {
            $this->db->trans_begin();
			
			$cbnaatcntr_data = [];
			$user_data = [];
			
			/*$user_data = [
				"mobile_no" => trim(htmlspecialchars($data['mobile'])),
				"password" => trim(htmlspecialchars($data['ltpass']))
			];
			
			$userid = trim(htmlspecialchars($data['uid']));
			
			
			$this->db->where('user_master.id', $userid);
			$this->db->update('user_master', $user_data);*/

			$cbnatId = trim(htmlspecialchars($data['cbnatId']));
			
			
			$cbnaatcntr_data = [
				"name" => trim(htmlspecialchars($data['cbnatcntrname'])),
				"address" => trim(htmlspecialchars($data['cbnatcntradd'])),
				"tuid" => trim(htmlspecialchars($data['seltu']))
				
				
			];
                        
                 
			$this->db->where('cbnaat.id', $cbnatId);
			$this->db->update('cbnaat', $cbnaatcntr_data); 
			
		
			
			$user_activity = array(
					"activity_module" => 'CB-NAAT',
					"action" => "Update",
					"from_method" => "cbnaat/cbnaat_action/updateCbnaat",
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
	public function getAllActiveCbnaatCenter(){
		$data = [];
		$query = $this->db->select("*")
				->from('cbnaat')
				->where('cbnaat.is_active',1)
				->order_by('cbnaat.name')
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

	
	
}