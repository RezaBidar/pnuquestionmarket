<?php

/**
 *
 * @author Reza Bidar
 *        
 */
class m_app_user extends MY_Model {
	protected $_table_name = 'user';
	protected $_primary_key = 'usr_id';
	protected $_primary_filter = 'trim'; 
	
	public function __construct() {
		parent::__construct ();
	}
	
	public function login(){
		$where = array(
			"usr_password" => $this->hash($this->input->post('password')),
			"usr_username" => $this->input->post('username')	
		);
		$user = $this->get_by($where,true);
		if(count($user)){
			return TRUE;
		}
		return FALSE;
		
	}
	
	public function reg($data){
		$row = array(
			"usr_fname" => $data["fname"] ,
			"usr_lname" => $data["lname"] ,
			"usr_password" => $this->makeRandom() ,
			"usr_school" => $data["school"] ,
			"usr_major" => $data["major"] ,
			"usr_os" => $data["os"] ,
			"usr_created" => $data["time"] ,
			"usr_ip" => $data["ip"] ,
			"app_id" => $data["app_id"]	
		);
		return array("id" => $this->save($row) , "password" => $row["usr_password"]);
	}
	
	public function hash($input){
		return md5($input . config_item('encryption_key'));
	}
	
	/*
	 * this func make random string for user pass
	 */
	public function makeRandom($length = 10){
		$valids = "aAbBcCdDeEfFgGhHiIjJkKlLmMnNoOpPqQrRsStTuUvVwWxXyYzZ123456789";
		$num = strlen($valids);
		$random_string = "";
		for ($i = 0; $i < $length; $i++) {
			$random_string .= $valids[mt_rand(0, $num-1)];
		}
		return $random_string;
	}
}

?>