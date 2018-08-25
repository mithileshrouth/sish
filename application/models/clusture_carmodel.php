<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class clusture_carmodel extends CI_Model{
	public function __construct()
	{
	   // parent::__construct();
	
		$this->load->model('rolemastermodel','rolemodel',TRUE);
	}
	
		public function getAllClustureCarList(){
		$data = [];
		$query = $this->db->select("*")
				->from('clusture_car')
			    ->order_by('clusture_car.name')
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
	
	       
	}//end of class