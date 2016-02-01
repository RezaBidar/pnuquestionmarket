<?php

/**
 *
 * @author ReZaBiDaR
 *        
 */
class Login extends MY_Controller {
	
	/**
	 */
	public function __construct() {
		parent::__construct ();
	}
	
	/*
	 * index page of login
	 */
	public function index(){
		//echo md5("pnetms" . config_item('encryption_key')) ;
		//echo urldecode($redirect_url) ;
		$this->load->model('m_user');
		$this->data = array() ;

		//@todo inja bayad badan check konam age az filemanager oomad in tabeha ejra nashan dar gheyere insoorat redirect she
		// $this->m_user->loggedin() && $this->m_user->logout();
		// $this->m_user->loggedin() && redirect('admin/dashboard');
		$rules = $this->m_user->rule;
		$this->form_validation->set_rules($rules);

		if($this->form_validation->run() == TRUE){
			if($this->m_user->login()){
			   // if(true || preg_match("/^(". site_url("admin") .").*/", $_SERVER['HTTP_REFERER'])) echo $_SERVER['HTTP_REFERER'] ;
			     redirect(($this->session->userdata('redirect_url') == NULL) ? 'admin/dashboard' : $this->session->userdata('redirect_url') );
			}else{
    		    $this->data['error']['wrong_user'] = __l('my_error_incorrect_user_pass') ;
		    }
			//echo $this->db->last_query();
		}
		
		//var_dump($this->session->userdata);
		$this->load->view('login' , $this->data);
		
	}
}

?>