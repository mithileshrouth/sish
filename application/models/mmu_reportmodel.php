<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class mmu_reportmodel extends CI_Model{
	public function __construct()
	{
	   // parent::__construct();
	
		$this->load->model('rolemastermodel','rolemodel',TRUE);
	}
	
	
	public function getAllMMUReportByCoordinator($wherein,$selected_ids,$car_cluster_id,$from_dt,$to_date){
		$data = [];

		$where_mmu_date = "DATE_FORMAT(mmu_shis.mmu_date,'%Y-%m-%d') BETWEEN '".$from_dt."' AND '".$to_date."'";
		$wherecarcls = array('mmu_shis.car_cluster_id' =>$car_cluster_id );

		$query = $this->db->select("mmu_shis.*,
									clusture_car.name as clusture_car_name,
									coordinator.name as coordinator_name")
				->from('mmu_shis')
				->join('clusture_car','clusture_car.id = mmu_shis.car_cluster_id','INNER')
				->join('coordinator','coordinator.id = mmu_shis.grpcord_id','INNER')
				->where($where_mmu_date)
				->where_in($wherein, $selected_ids)
				->where($wherecarcls)
				->order_by('mmu_shis.id')
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

public function getAllMMUReport($car_cluster_id,$from_dt,$to_date){
		$data = [];

		$where_mmu_date = "DATE_FORMAT(mmu_shis.mmu_date,'%Y-%m-%d') BETWEEN '".$from_dt."' AND '".$to_date."'";
		$wherecarcls = array('mmu_shis.car_cluster_id' =>$car_cluster_id );

		$query = $this->db->select("mmu_shis.*,
								   clusture_car.name as clusture_car_name,
								   coordinator.name as coordinator_name")
				->from('mmu_shis')
				->join('clusture_car','clusture_car.id = mmu_shis.car_cluster_id','INNER')
				->join('coordinator','coordinator.id = mmu_shis.grpcord_id','INNER')
				->where($where_mmu_date)
				->where($wherecarcls)
				->order_by('mmu_shis.id')
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