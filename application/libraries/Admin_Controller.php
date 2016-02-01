<?php
class Admin_Controller extends MY_Controller {
	function __construct(){
		parent::__construct();
		$this->load->library('session');
		
		$this->load->model('m_user'); 
		
		//check if not logged redirect to login page
		$this->session->set_userdata(array('redirect_url' => NULL)) ;
		if(!$this->m_user->loggedin()){
		    $this->session->set_userdata(array('redirect_url' => uri_string() ) );
		    redirect('login');
		}
		
		// load menu for admin panel
		// $this->data["menu"] = ($this->session->userdata('admin'))?config_item("admin_menu"):config_item("user_menu");
		$this->data['menu'] = Navbar::getArray($this->session->userdata('rule')) ;
		$this->data["base_url"] = base_url() ;
		$this->data["user_id"] = $this->session->userdata('id') ;
		$this->data["user_fullname"] = $this->session->userdata('fname') . " " . $this->session->userdata('lname') ;
		// $this->data["avatar"] = $this->m_user->get($this->data["user_id"],TRUE)->usr_avatar;
		
		// Get the current logged in user (however your app does it)
// 		$user_id = $this->session->userdata('user_id');
		
		// You might want to validate that the user exists here
		
		// If you only want to update in intervals, check the last_activity.
		// You may need to load the date helper, or simply use time() instead.
		// $time_since = now() - $this->session->userdata('last_activity');
		// $interval = 300;
		
		// // Do nothing if last activity is recent
		// if ($time_since < $interval) {
			
		// 	// Update database
		// 	$updated = $this->db
		// 	->set('usr_last_login', date('Y-m-d H:i:s'))
		// 	->where('usr_id', $this->data["user_id"])
		// 	->update('user');
			
		// 	// Log errors if you please
		// 	$updated or log_message('error', 'Failed to update last activity.');
		// }
	}
}
