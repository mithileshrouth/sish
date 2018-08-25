<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class eye_recordmodel extends CI_Model{
	public function __construct()
	{
	   // parent::__construct();
	
		$this->load->model('rolemastermodel','rolemodel',TRUE);
	}
	
	
	public function getAllEyeRecordByCoordinator($wherein,$selected_ids,$car_cluster_id,$from_dt,$to_date){
		$data = [];

		$where_given_date = "DATE_FORMAT(shis_eye_record.given_date,'%Y-%m-%d') BETWEEN '".$from_dt."' AND '".$to_date."'";
		$wherecarcls = array('shis_eye_record.car_cluster_id' =>$car_cluster_id );

		$query = $this->db->select("shis_eye_record.*,
									clusture_car.name as clusture_car_name,
									coordinator.name as coordinator_name")
				->from('shis_eye_record')
				->join('clusture_car','clusture_car.id = shis_eye_record.car_cluster_id','INNER')
				->join('coordinator','coordinator.id = shis_eye_record.grpcord_id','INNER')
				->where($where_given_date)
				->where_in($wherein, $selected_ids)
				->where($wherecarcls)
				->order_by('shis_eye_record.id')
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

public function getAllEyeRecord($car_cluster_id,$from_dt,$to_date){
		$data = [];

		$where_given_date = "DATE_FORMAT(shis_eye_record.given_date,'%Y-%m-%d') BETWEEN '".$from_dt."' AND '".$to_date."'";
		$wherecarcls = array('shis_eye_record.car_cluster_id' =>$car_cluster_id );

		$query = $this->db->select("shis_eye_record.*,
								   clusture_car.name as clusture_car_name,
								   coordinator.name as coordinator_name")
			    ->from('shis_eye_record')
				->join('clusture_car','clusture_car.id = shis_eye_record.car_cluster_id','INNER')
				->join('coordinator','coordinator.id = shis_eye_record.grpcord_id','INNER')
				->where($where_given_date)
				->where($wherecarcls)
				->order_by('shis_eye_record.id')
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


}