<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class xraycentermodel extends CI_Model{
	public function __construct()
	{
	   // parent::__construct();
	
		$this->load->model('rolemastermodel','rolemodel',TRUE);
	}
	
	
	public function getAllXrayCenter(){
		$data = [];
		$query = $this->db->select("
					xray_center.id as xraycenter_id,
                                        xray_center.name as xray_center_name,
                                        xray_center.address as xray_center_add,
                                        xray_center.lt_name,
                                        xray_center.mobile_no as ltmobile,
                                        xray_center.is_active as active,
					tu_unit.name AS tuname,
					block.name as blockname
					")
				->from('xray_center')
				->join('tu_unit','tu_unit.id = xray_center.tuid','INNER')
				->join('block','block.id = tu_unit.block_id','INNER')
				->order_by('xray_center.tuid')
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
	
	
	public function insertIntoXrayCenter($data,$session){
		try {
            $this->db->trans_begin();
			
			$xraycntr_data = [];
			$user_data = [];
			
			$user_data = [
				"mobile_no" => trim(htmlspecialchars($data['mobile'])),
				"password" => trim(htmlspecialchars($data['ltpass'])),
				"role_id" => $this->rolemodel->getRoleIDByRoleType("XRAY"),
				"project_id" => 1,
				"is_active" => 1
			];
			
			$this->db->insert('user_master', $user_data);
			$user_id = $this->db->insert_id();
			
			$xraycntr_data = [
				"name" => trim(htmlspecialchars($data['xraycntrname'])),
				"address" => trim(htmlspecialchars($data['xraycntradd'])),
				"tuid" => trim(htmlspecialchars($data['seltu'])),
				"lt_name" => trim(htmlspecialchars($data['ltname'])),
				"mobile_no" => trim(htmlspecialchars($data['mobile'])),
				"userid" => $user_id,
				"project_id" => 1, // need to change dynamically according to requirement
				"is_active" => 1,
				"created_by" => $session['userid']
			];
			
			$this->db->insert('xray_center', $xraycntr_data);
			
			$user_activity = array(
					"activity_module" => 'X-Ray Center',
					"action" => "Insert",
					"from_method" => "xraycenter/xray_action/insertIntoXray",
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
	
	
	public function getXrayCenterEditDataByID($id){
		$data = [];
		$query = $this->db->select("
					xray_center.id as xraycntrId,
					xray_center.name as xraycentername,
					xray_center.address as xraycntradd,
					xray_center.mobile_no as ltmobile,
					xray_center.tuid ,
					xray_center.lt_name ,
					user_master.id as userid,
					user_master.password as userpass
					
				   ")
				->from('xray_center')
			
				->join('user_master','user_master.id = xray_center.userid','INNER')
				->where('xray_center.id',$id)
				->order_by('xray_center.name')
				->get();
			
			//echo $this->db->last_query();
			if($query->num_rows()> 0)
			{
				$data = $query->row();
	        }
			
	        return $data;
	}
	
	public function updateXrayCenter($data,$session){
		try {
            $this->db->trans_begin();
			
			$xraycenter_data = [];
			$user_data = [];
			
			$user_data = [
				"mobile_no" => trim(htmlspecialchars($data['mobile'])),
				"password" => trim(htmlspecialchars($data['ltpass']))
			];
			
			$userid = trim(htmlspecialchars($data['uid']));
			$xraycenterId = trim(htmlspecialchars($data['xraycntrId']));
			
			$this->db->where('user_master.id', $userid);
			$this->db->update('user_master', $user_data); 
			
			
			
			$xraycenter_data = [
				"name" => trim(htmlspecialchars($data['xraycntrname'])),
				"address" => trim(htmlspecialchars($data['xraycntradd'])),
				"tuid" => trim(htmlspecialchars($data['seltu'])),
				"lt_name" => trim(htmlspecialchars($data['ltname'])),
				"mobile_no" => trim(htmlspecialchars($data['mobile']))
				
			];
                        
                        

                        
                        
                        
                        
			
			$this->db->where('xray_center.id', $xraycenterId);
			$this->db->update('xray_center', $xraycenter_data); 
			
		
			
			$user_activity = array(
					"activity_module" => 'X-Ray Center',
					"action" => "Update",
					"from_method" => "xraycenter/xray_action/updateXray",
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

	public function getAllActiveXrayCenter(){
		$data = [];
		$query = $this->db->select("
					xray_center.id as xraycenter_id,
                                        xray_center.name as xray_center_name,
                                        xray_center.address as xray_center_add,
                                        xray_center.lt_name,
                                        xray_center.mobile_no as ltmobile,
                                        xray_center.is_active as active
					
					")
				->from('xray_center')
				
				->where('xray_center.is_active',1)
				->order_by('xray_center.tuid')
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