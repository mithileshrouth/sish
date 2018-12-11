<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class dashboardmodel extends CI_Model{


	public function rowcount($table)
	{
		
		$this->db->select('*')
				->from($table);

		$query = $this->db->get();
		$rowcount = $query->num_rows();
	
		if($query->num_rows()>0){
			return $rowcount;
		}
		else
		{
			return 0;
		}
		
	}
// created on 11/12/18 by sandipan sarkar //
	public function TBDiagnosedRowCount($table,$column)
	{
		
			$this->db->select($column)
				->from($table)
				->where($column,'Y');
		

		$query = $this->db->get();
		$rowcount = $query->num_rows();
	
		if($query->num_rows()>0){
			return $rowcount;
		}
		else
		{
			return 0;
		}
	}

	public function nqppCountWithBlockIdNotNull($table,$column)
	{
		$this->db->select('*')
				->from($table)
				->where($column.' IS NOT NULL');
		

		$query = $this->db->get();

		$rowcount = $query->num_rows();
	
		if($query->num_rows()>0){
			return $rowcount;
		}
		else
		{
			return 0;
		}
	}


}
	