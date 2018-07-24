<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class smsconfigmodel extends CI_Model{
	public function __construct()
	{
	   // parent::__construct();
	
		
	}
	
	
	public function getAllRoll(){
		//$where = array('role_master.role_code!=>','ADMIN' );
		$data = [];
		$query = $this->db->select("*
									")
				->from('role_master')
				->where_not_in('role_master.role_code','ADMIN')
				->order_by('role_master.id','asc')
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




	 function deleteSmsRolewiseActionDetails($sms_action_id){

  	   $this->db->where('sms_action_rolewise_detail.sms_action_id', $sms_action_id)
                ->delete('sms_action_rolewise_detail');
                if ($this->db->affected_rows()) {
                	return 1;
                }else{
                	return 0;
                }
  }

	public function getAllSmsActionRolewiseDetails(){
		//$where = array('role_master.role_code!=>','ADMIN' );
		$data = [];
		$query = $this->db->select("
									sms_action_rolewise_detail.id,
									sms_action_rolewise_detail.sms_action_id,
									sms_action_rolewise_detail.send_to_roleid,
									sms_action_master.sms_name,
									sms_action_master.id as smsID
									")
				->from('sms_action_rolewise_detail')
				->join('sms_action_master','sms_action_master.id = sms_action_rolewise_detail.sms_action_id','INNER')
				->group_by('sms_action_rolewise_detail.sms_action_id')
				->order_by('sms_action_rolewise_detail.id','asc')
				->get();
			
			#echo $this->db->last_query();
			/*if($query->num_rows()> 0)
			{
	          foreach($query->result() as $rows)
				{
					$data[] = $rows;
				}
	             
	        }*/

	        if($query->num_rows()> 0)
				{
		          foreach($query->result() as $rows)
					{
						//$data[] = $rows;
						$data[] = array(
                        "smsactionrolewiseData" => $rows,
                        "RoleData" => $this->getsmsRoleDetails($rows->sms_action_id)
                        
                    
				      ); 
					}
		             
		        }
			
	        return $data;
	       
	}



public function getsmsRoleDetails($sms_action_id){
     $data = [];
    	$where = array(
			
			"sms_action_rolewise_detail.sms_action_id"=>$sms_action_id
		);
        $data = array();
		$this->db->select("role_master.name")
				->from('sms_action_rolewise_detail')
				->join('role_master','role_master.id = sms_action_rolewise_detail.send_to_roleid','INNER')
				->where($where);
		$query = $this->db->get();
		
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

    public function getSMSEditDataByRoleID($id){
		$data = [];
		$query = $this->db->select("*")
				->from('sms_action_rolewise_detail')
				->where('sms_action_rolewise_detail.sms_action_id',$id)
				->order_by('sms_action_rolewise_detail.id')
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
	        return $data;
	}

}//end of class