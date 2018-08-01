<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class activitylogmodel extends CI_Model{
	public function __construct()
	{
	   // parent::__construct();
	
		$this->load->model('rolemastermodel','rolemodel',TRUE);
	}
	
	
	public function getAllActivitylog(){
		$data = [];
		$query = $this->db->select("activity_log.*,
									user_master.mobile_no,
									role_master.name as rollname")
				->from('activity_log')
				->join('user_master','user_master.id = activity_log.user_id','INNER')
				->join('role_master','role_master.id = user_master.role_id','INNER')
				->order_by('activity_log.id',"DESC")
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


}// end of file