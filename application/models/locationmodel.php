<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class locationmodel extends CI_Model{
	
	
	
	/****************************************************************************/
	/*******************************BLOCK AREA**********************************/
	/**************************************************************************/
	
	public function getAllBlockList(){
		$data = [];
		$query = $this->db->select("
					block.id as blockid,
					block.name as blockname,
					block.block_code,
					block.is_active,
					district.name as districtname
					
					")
				->from('block')
				->join('district','district.id = block.district_id','INNER')
			    ->order_by('block.name')
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
	
	public function getBlock($id=NULL){
			$data = [];
			
			if($id == "ALL"){
				$where_param = [
				"block.is_active" => 1
				];
				
			}
			else{
				$where_param = [
				"block.is_active" => 1,
				"block.id" => $id
				];
				
			}
			$query = $this->db->select("block.*")
					->from('block')
					->where($where_param)
					->order_by('block.name')
					->get();
				
			if($query->num_rows()> 0)
			{
				if($id == "ALL"){
					foreach($query->result() as $rows)
					{
						$data[] = $rows;
					}
				}
				else{
					 $data = $query->row();
				}
			}
			return $data;
		}

		/********************************************************/
		/**************************STATE*************************/
		/********************************************************/
		
			public function getState($id=NULL){
			$data = [];
			
			if($id == "ALL"){
				$where_param = [
				"state.is_active" => 1
				];
				
			}
			else{
				$where_param = [
				"state.is_active" => 1,
				"state.id" => $id
				];
				
			}
			$query = $this->db->select("state.*")
					->from('state')
					->where($where_param)
					->order_by('state.state')
					->get();
				
			if($query->num_rows()> 0)
			{
				if($id == "ALL"){
				  foreach($query->result() as $rows)
				  {
					$data[] = $rows;
				  }
				}
				else{
					 $data = $query->row();
				}
			}
			return $data;
		}
		
		
		
		public function getStateByDistrictID($distID){
			$state_id = 0;
			$where = [
				"district.id"=>$distID,
				"district.is_active"=>1
			];
			$query = $this->db->select("*")
					->from("district")
					->join("state","state.id=district.state_id","INNER")
					->where($where)
					->get();
					
			if($query->num_rows()>0){
				$row = $query->row();
				$state_id = $row->state_id;
			}
			return $state_id;
		}
		
		
		/*******************************************************/
		/*****************************DISTRICT*****************/
		/*****************************************************/


		public function getDistrict($id=NULL){
			$data = [];
			
			if($id == "ALL"){
				$where_param = [
				"district.is_active" => 1
				];
				
			}
			else{
				$where_param = [
				"district.is_active" => 1,
				"district.id" => $id
				];
				
			}
			$query = $this->db->select("district.*")
					->from('district')
					->where($where_param)
					->order_by('district.name')
					->get();
			//echo $this->db->last_query();	
			if($query->num_rows()> 0)
			{
				if($id == "ALL"){
				  foreach($query->result() as $rows)
					{
						$data[] = $rows;
					}
				}
				else{
					 $data = $query->row();
				}
			}
			return $data;
		}
	
	/*******************************************************/
	/********************COUNTRY***************************/
	/*****************************************************/


		public function getCountry($id=NULL){
			$data = [];
			
			if($id == "ALL"){
				$where_param = [];
				
			}
			else{
				$where_param = [
					"country.id" => $id
				];
				
			}
			$query = $this->db->select("country.*")
					->from('country')
					->where($where_param)
					->order_by('country.name')
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
		
		public function getCountryIDByStateID($sateID){
			$country_id = 0;
			$where = [
				"state.id"=>$sateID,
				"state.is_active"=>1
			];
			$query = $this->db->select("*")
					->from("state")
					->join("country","country.id=state.country_id","INNER")
					->where($where)
					->get();
					
			if($query->num_rows()>0){
				$row = $query->row();
				$country_id = $row->country_id;
			}
			return $country_id;
		}
	
	
}