<?php
class MY_Model extends CI_Model{
	protected $_ai = TRUE ;
	protected $_table_name = '';
	protected $_primary_key = '';
	protected $_primary_filter = 'trim';//tabdile prametr be int
	protected $_timestamp = FALSE;
	public $rule = array();
	protected $_orderby = '';
	protected $_prefix = "";
	
	protected $_creator_id = FALSE ;
	protected $_modifier_id = FALSE ;

	protected $_creator_ip = FALSE ;
	protected $_modifier_ip = FALSE ;
	
	/**
	 * constructor
	 */
	function __construct(){
		parent::__construct();
	}
	
	public function get($id=NULL,$single=NULL,$custom_method = NULL){
		$method ='';
		if($id!=NULL){
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db->where($this->_primary_key,$id);
			$method = 'row';
		}elseif ($single){
			$method = 'row';
		}else {
			$method = 'result';
		}
		
		if($custom_method != NULL) $method = $custom_method ;
		
		return $this->db->get($this->_table_name)->$method();
	}
	
	/**
	 * 
	 * @param array $where
	 * @param string $single
	 * @param string $set_pre
	 */
	public function get_by($where, $single=FALSE , $set_pre = TRUE){
	    if($set_pre) $where = $this->setPrefix($where);
		$this->db->where($where);
		return $this->get(NULL,$single);
	}
	
	public function save($data,$id = NULL){
	    
	    //set user ip
	    if(!$id && $this->_creator_ip) $data["creator_ip"] = $this->getUserIP() ;
	    if($this->_modifier_ip) $data["modifier_ip"] = $this->getUserIP() ; 

	    
	    //set user id
	    if(!$id && $this->_creator_id) $data["inserter"] = $this->session->userdata('id') ;
	    if($this->_modifier_id) $data["modifier"] = $this->session->userdata('id') ;
	     
	    
		//set timestamp
		if($this->_timestamp == TRUE){
			$now = date('Y-m-d H:i:s');
			$id || $data['created'] = $now;
			$data['modified'] = $now ;
		}
		
		//insert 
		if($id === NULL){
			if($this->_ai) !isset($data[$this->_primary_key]) || $data[$this->_primary_key] = NULL; 
			$data = $this->setPrefix($data);
			$this->db->set($data);
			$this->db->insert($this->_table_name);
			$id = $this->db->insert_id();
			//handle error 
			$e = $this->db->error() ;
			if($e['code'] > 0 ) $this->session->set_flashdata('dberror', $this->db->error());
			
			return $id;
			
		}
		
		//update
		else {
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$data = $this->setPrefix($data);
			$this->db->set($data);
			$this->db->where($this->_primary_key,$id);
			$this->db->update($this->_table_name);	

			//handle error 
			$e = $this->db->error() ;
			if($e['code'] > 0 ) $this->session->set_flashdata('dberror', $this->db->error());

			return $id ;
		}
	}
	
	public function delete($data){
	    
		$filter = $this->_primary_filter;
		if(!is_array($data)) $data = $filter($data);
		if(!$data){
			return FALSE;
		}else{
			if(is_array($data)) $this->db->where($data);
			else $this->db->where($this->_primary_key,$data);
			$this->db->limit(0);
			$this->db->delete($this->_table_name);
			return TRUE ;
		}
		return FALSE ;
	}
	
	public function insert_batch($data){
	    
	    $now = date('Y-m-d H:i:s');
	    
	    foreach ($data as $key => $val){
	        
	        //set user ip
	        if($this->_creator_ip) $val["creator_ip"] = $this->getUserIP() ;
	        if($this->_modifier_id) $val["modifier_ip"] = $this->getUserIP() ;
	        
	         
	        //set user id
	        if($this->_creator_id) $val["inserter"] = $this->session->userdata('id') ;
	        if($this->_modifier_id) $val["modifier"] = $this->session->userdata('id') ;
	        
	         
	        //set timestamp
	        if($this->_timestamp == TRUE){        
	            $val['created'] = $now;
	            $val['modified'] = $now ;
	        }
	        
	        $data[$key] = $this->setPrefix($val) ; 
	    }
	    
	    $this->db->insert_batch($this->_table_name, $data);
	}
	
	/**
	 * @return the $_table_name
	 */
	public function getTableName() {
		return $this->_table_name;
	}

	/**
	 * try to get real user ip
	 * @return string ip
	 */
	protected function getUserIP(){
        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = $_SERVER['REMOTE_ADDR'];
        
        if(filter_var($client, FILTER_VALIDATE_IP)){
            $ip = $client;
        }
        elseif(filter_var($forward, FILTER_VALIDATE_IP)){
            $ip = $forward;
        }
        else{
            $ip = $remote;
        }
        
        return $ip;
    }
    
    /**
     * get an array and append column prefix to first of all keys 
     * @param array $data
     * @return array
     */
    protected function setPrefix($data){
        $new_data = array();
        foreach ($data as $key => $val){
            if(!preg_match("/^(".$this->_prefix .")/", $key))
                $new_data[$this->_prefix . $key] = $val ;
            else $new_data[$key] = $val ;
        }
        return $new_data ;
    }
	
}