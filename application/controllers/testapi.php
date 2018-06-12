<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class testapi extends CI_Controller{
	public function index(){
		header('Access-Control-Allow-Origin: *');  
		header('Content-Type: application/json');
		
		$data = [
			"name"=>"Mithilesh",
			"from"=>"From Localhost"
		];
		
		$myJSON = json_encode($data);
		echo $myJSON;
		exit;
	}
}
?>