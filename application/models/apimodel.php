<?php
class apimodel extends CI_Model {
    public function getAPIkey(){
        $key ="";
        $query = $this->db->select("*")
			  ->from("project")
			  ->where('project.project', 'SHISH')
			  ->get();
        if($query->num_rows()>0){
            $row = $query->row();
            $key = $row->apikey;
                    
        }
        return $key;
    }
    
}
