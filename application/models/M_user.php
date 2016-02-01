<?php

/**
 *
 * @author Reza Bidar
 *        
 */
class m_user extends MY_Model {

	//column names
	const COLUMN_ID = 'usr_id' ;
	const COLUMN_USERNAME = 'usr_username' ;
	const COLUMN_PASSWORD = 'usr_password' ;
	const COLUMN_FIRST_NAME = 'usr_fname' ;
	const COLUMN_LAST_NAME = 'usr_lname' ;
	const COLUMN_LEVEL = 'usr_level' ;
	const COLUMN_GENDER = 'usr_gender' ;
	const COLUMN_TEL = 'usr_tel' ;
	const COLUMN_MOBILE = 'usr_mobile' ;
	const COLUMN_AVATAR = 'usr_avatar' ;
	const COLUMN_ADDRESS = 'usr_address' ;
	const COLUMN_EMAIL = 'usr_email' ;

	const COLUMN_CREATED_TIME = 'usr_created' ;
	const COLUMN_MODIFIED_TIME = 'usr_modified' ;
	const COLUMN_CREATOR = 'usr_inserter' ;
	const COLUMN_MODIFIER = 'usr_modifier' ;


	protected $_table_name = 'user';
	protected $_primary_key = 'usr_id';
	protected $_primary_filter = 'trim'; 
	protected $_timestamp = TRUE;
	protected $_orderby = '';
	protected $_prefix = "usr_";
	protected $_creator_id = TRUE ;
	protected $_modifier_id = TRUE ;

	
	
	public $rule = array (
			'username' => array (
					'field' => 'username',
					'label' => 'username',
					'rules' => 'trim|required' 
			),
			'password' => array (
					'field' => 'password',
					'label' => 'password',
					'rules' => 'trim|required' 
			) 
	);
	
	
	public function login(){
		$where = array(
			"usr_password" => $this->hash($this->input->post('password')),
			"usr_username" => $this->input->post('username')	
		);
		$user = $this->get_by($where,true);
		if(count($user)){
			$session_data = array(
				"fname" => $user->usr_fname,
				"lname"	=> $user->usr_lname,
				"username" => $user->usr_username,
				"level"	=> $user->usr_level,
				"id" => $user->usr_id ,
				"logged_in" => TRUE ,
				"rule" => $this->getEnglishLevelName($user->usr_level) ,
			);
			$this->session->set_userdata($session_data);
			return TRUE;
		}
		return FALSE;
		
	}
	
	public function logout(){
		
		$this->session->sess_destroy();
	}
	
	/**
	* felan chon 2ta sath darim az is_admin estefade mikonim
	* @return bool
	*/
	public function isAdmin(){
		return (bool) $this->session->userdata('admin') ;
	}

	/**
	 * chech this user has the capability or not
	 * @param  string $capability 
	 * @return bool            
	 */
	public function permission($capability){
		$rule = $this->session->userdata('rule') ;
		$a = config_item('rules') ;
		$capabilities = $a[$rule]['capabilities'] ;
		$answer = in_array($capability , $capabilities) || (isset($a[$rule]['is_admin']) && $a[$rule]['is_admin']) ;
		return $answer;
	}
	
	public function loggedin(){
		return (bool) $this->session->userdata('logged_in');
	}
	
	public function hash($input){
		return md5($input . config_item('encryption_key'));
	}

	public function getTable($update_url = NULL , $delete_url = NULL , $select_url = NULL){
		$table = new My_Table() ;

		$thead = array(
		    __l('my_form_fname'),
		    __l('my_form_lname'),
		    __l('my_form_email'),
		);
		$tbody = array(
			self::COLUMN_FIRST_NAME ,
			self::COLUMN_LAST_NAME,
			self::COLUMN_EMAIL
		);

		$data = $this->get() ;
		
		return $table->getView($thead, $tbody, $this->_primary_key, $data , $update_url, $delete_url , $select_url );
	}

	public function getGenderList(){
		return array(
				__l('my_form_gender_male') => 'male' ,
				__l('my_form_gender_female') => 'female' ,
			) ;
	}

	public function getGenderName($index){
		$gender_list = $this->getGenderList() ;
		return array_search($index , $gender_list) ;
	}

	public function getLevelList(){
		return array(
			__l('my_form_level_writer') => '4' ,
			__l('my_form_level_editor') => '5' ,
			__l('my_form_level_manager') => '8' ,
			__l('my_form_level_admin') => '10' ,

		);	
	}
	public function getLevelName($index){
		$level_list = $this->getLevelList() ;
		return array_search($index , $level_list) ;
	}
	public function getEnglishLevelName($index)
	{
		$a = array(
			'4' => 'writer' , 
			'5' => 'editor' , 
			'8' => 'manager' , 
			'10' => 'admin' , 
		) ; 
		return $a[$index];	
	}

	/**
	 * get user id and return her or his full name 
	 * @param  int $user_id user id
	 * @return string          full name
	 */
	public function getName($user_id){
		$user = $this->get($user_id , true);
		if($user == null) return null ;
		return $user->{self::COLUMN_FIRST_NAME} . ' ' . $user->{self::COLUMN_LAST_NAME} ;
	}
}

?>