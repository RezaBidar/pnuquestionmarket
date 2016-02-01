<?php

class dash_user extends Admin_Controller{


	public function add_user($id = ''){

		if($id != '' && !is_numeric($id)) die('loading problem .. Call Administrator Plzz ..') ;
		$this->data['edit'] = ($id != '') ? TRUE : FALSE ;

		$user = null ;
		if($this->data['edit']) {
			$user = $this->m_user->get($id , TRUE) ;
			if($user == NULL) die('there is a problem call Administrator plz ...') ;
		}

		if($this->data['edit']){
			if($user->{m_user::COLUMN_CREATOR} == $this->data['user_id'])
				$capability = CAP_EDIT_USER ;
			else
				$capability = CAP_EDIT_ALL_USER ;
		}else{
			$capability = CAP_ADD_USER ;
		}
		if(!checkPermision($capability)) return ;


		//form validation rules
		$rule = array(
	            "fname" => array( "field" => "fname" , "label" => __l('my_form_fname') , "rules" => "required|trim" ),
	            "lname" => array( "field" => "lname" , "label" => __l('my_form_lname') , "rules" => "required|trim" ),
	            "username" => array( "field" => "username" , "label" => __l('my_form_username') , "rules" => "required|trim|is_unique[user." . m_user::COLUMN_USERNAME . ']' ),
	            "password" => array("field" => "password" , "label" => __l('my_form_password') , "rules" => "required|trim"),
	            "email" => array("field" => "email" , "label" => __l('my_form_email') , "rules" => "valid_email|required|trim|is_unique[user.". m_user::COLUMN_EMAIL .']' ),
	            "gender" => array("field" => "gender" , "label" => __l('my_form_gender') , "rules" => "required|trim"),
	            "tel" => array("field" => "tel" , "label" => __l('my_form_tel') , "rules" => "trim"),
	            "mobile" => array("field" => "mobile" , "label" => __l('my_form_mobile') , "rules" => "trim"),
	            "address" => array("field" => "address" , "label" => __l('my_form_address') , "rules" => "trim"),
	            "avatar" => array("field" => "avatar" , "label" => __l('my_form_avatar') , "rules" => "trim"),
	            "level" => array("field" => "level" , "label" => __l('my_form_level') , "rules" => "required|trim")
      		);
		
		//custom rules for edit
		if($this->data['edit']){
			$rule["password"] = array("field" => "password" , "label" => __l('my_form_password') , "rules" => "trim");
			$rule["email"] = array("field" => "email" , "label" => __l('my_form_email') , "rules" => "valid_email|required|trim|is_unique_except_id[user.". m_user::COLUMN_EMAIL .'.'. m_user::COLUMN_ID .'.'. $id .']' ) ;
			$rule["username"] = array( "field" => "username" , "label" => __l('my_form_username') , "rules" => "required|trim|is_unique_except_id[user." . m_user::COLUMN_USERNAME .'.'. m_user::COLUMN_ID .'.'. $id .']' ) ;
		}
		
		$this->form_validation->set_rules($rule) ;
		if($this->form_validation->run() == TRUE){
			$data = array(
	                m_user::COLUMN_FIRST_NAME => $this->input->post('fname') ,
	                m_user::COLUMN_LAST_NAME => $this->input->post('lname') ,
	                m_user::COLUMN_USERNAME => $this->input->post('username') ,
	                m_user::COLUMN_PASSWORD => $this->m_user->hash( $this->input->post('password') ) ,
	                m_user::COLUMN_EMAIL => $this->input->post('email') ,
	                m_user::COLUMN_GENDER => $this->input->post('gender') ,
	                m_user::COLUMN_TEL => $this->input->post('tel') ,
	                m_user::COLUMN_MOBILE => $this->input->post('mobile') ,
	                m_user::COLUMN_ADDRESS => $this->input->post('address') ,
	                m_user::COLUMN_LEVEL => $this->input->post('level') ,
	            );

			if($this->data['edit'] && $this->input->post('password') == ''){
				unset($data[m_user::COLUMN_PASSWORD]) ;
			}
	            	
	            	$result_id = ($this->data['edit']) ? $this->m_user->save($data , $id) : $this->m_user->save($data) ;

			if($result_id == NULL)
				$this->session->set_flashdata('error', __l('my_error_transaction'));
			else 
				$this->session->set_flashdata('message', __l('my_form_success_message'));
			///PRG Pattern
			header("Location: " . $_SERVER['REQUEST_URI']);

		}else{
			if(strlen(validation_errors() )  > 0 ){
				$this->session->set_flashdata('error', validation_errors());	
			}
			
		}
		
		$this->data['title'] = __l('my_page_add_user') ;
		
		if($this->data['edit']){
			
			$this->data['values'] = array(
					'fname' => $user->{m_user::COLUMN_FIRST_NAME} ,
					'lname' => $user->{m_user::COLUMN_LAST_NAME} ,
					'username' => $user->{m_user::COLUMN_USERNAME} ,
					'password' => '' ,//$user->{m_user::COLUMN_PASSWORD} ,
					'email' => $user->{m_user::COLUMN_EMAIL} ,
					'gender' => $user->{m_user::COLUMN_GENDER} ,
					'level' => $user->{m_user::COLUMN_LEVEL} ,
					'tel' => $user->{m_user::COLUMN_TEL} ,
					'mobile' => $user->{m_user::COLUMN_MOBILE} ,
					'address' => $user->{m_user::COLUMN_ADDRESS} ,
				);
			$this->data['title'] = __l('my_page_edit_user') ;	
		}
		

		$this->load->view('admin/component/header');
		$this->load->view('admin/component/nav' , $this->data);
		$this->load->view('admin/user/add_user');
		$this->load->view('admin/component/footer');

	}

	public function user_list(){
		$capability = CAP_VIEW_USER_LIST ;
		if(!checkPermision($capability)) return ;

		$this->data['table'] = $this->m_user->getTable('admin/dash_user/add_user' ) ;

		$this->data['title'] = __l('my_page_user_list') ;
		$this->data['add_url'] = site_url('admin/dash_user/add_user') ;

		$this->load->view('admin/component/header');
		$this->load->view('admin/component/nav' , $this->data);
		$this->load->view('admin/list' , $this->data);
		$this->load->view('admin/component/footer');
	}

	public function profile(){
		$capability = CAP_PUBLIC ;
		if(!checkPermision($capability)) return ;

		$this->data['user'] = $this->m_user->get($this->data['user_id'] , true ) ;
		if($this->data['user'] == NULL) die("Call Administrator plz ...");

		$this->data['title'] = __l('my_page_profile_view') ;	

		$this->load->view('admin/component/header');
		$this->load->view('admin/component/nav' , $this->data);
		$this->load->view('admin/user/profile' , $this->data);
		$this->load->view('admin/component/footer');
		

	}

	public function edit_profile(){
		$capability = CAP_PUBLIC ;
		if(!checkPermision($capability)) return ;

		$id = $this->data['user_id'] ;
		//form validation rules
		$rule = array(
	            "fname" => array( "field" => "fname" , "label" => __l('my_form_fname') , "rules" => "required|trim" ),
	            "lname" => array( "field" => "lname" , "label" => __l('my_form_lname') , "rules" => "required|trim" ),
							"email" => array("field" => "email" , "label" => __l('my_form_email') , "rules" => "valid_email|required|trim|is_unique_except_id[user.". m_user::COLUMN_EMAIL .'.'. m_user::COLUMN_ID .'.'. $id .']' ) ,
							"username" => array( "field" => "username" , "label" => __l('my_form_username') , "rules" => "required|trim|is_unique_except_id[user." . m_user::COLUMN_USERNAME .'.'. m_user::COLUMN_ID .'.'. $id .']' ) ,
	            "gender" => array("field" => "gender" , "label" => __l('my_form_gender') , "rules" => "required|trim"),
	            "tel" => array("field" => "tel" , "label" => __l('my_form_tel') , "rules" => "trim"),
	            "mobile" => array("field" => "mobile" , "label" => __l('my_form_mobile') , "rules" => "trim"),
	            "address" => array("field" => "address" , "label" => __l('my_form_address') , "rules" => "trim"),
      		);
		$this->form_validation->set_rules($rule) ;
		if($this->form_validation->run() == TRUE){
			$data = array(
	                m_user::COLUMN_FIRST_NAME => $this->input->post('fname') ,
	                m_user::COLUMN_LAST_NAME => $this->input->post('lname') ,
	                m_user::COLUMN_USERNAME => $this->input->post('username') ,
	                m_user::COLUMN_EMAIL => $this->input->post('email') ,
	                m_user::COLUMN_GENDER => $this->input->post('gender') ,
	                m_user::COLUMN_TEL => $this->input->post('tel') ,
	                m_user::COLUMN_MOBILE => $this->input->post('mobile') ,
	                m_user::COLUMN_ADDRESS => $this->input->post('address') ,
	            );

	            	
			$result_id = $this->m_user->save($data , $id) ;
			if($result_id == NULL)
				$this->session->set_flashdata('error', __l('my_error_transaction'));
			else 
				$this->session->set_flashdata('message', __l('my_form_success_message'));
			///PRG Pattern
			header("Location: " . $_SERVER['REQUEST_URI']);
		}else{
			if(strlen(validation_errors() )  > 0 ){
				$this->session->set_flashdata('error', validation_errors());	
			}	
		}
		
		$user = $this->m_user->get($this->data['user_id'] , true ) ;
		if($user == NULL) die("Call Administrator plz ...");

		$this->data['values'] = array(
				'fname' => $user->{m_user::COLUMN_FIRST_NAME} ,
				'lname' => $user->{m_user::COLUMN_LAST_NAME} ,
				'username' => $user->{m_user::COLUMN_USERNAME} ,
				'email' => $user->{m_user::COLUMN_EMAIL} ,
				'gender' => $user->{m_user::COLUMN_GENDER} ,
				'tel' => $user->{m_user::COLUMN_TEL} ,
				'mobile' => $user->{m_user::COLUMN_MOBILE} ,
				'address' => $user->{m_user::COLUMN_ADDRESS} ,
			);
		$this->data['title'] = __l('my_page_profile_edit') ;	

		$this->load->view('admin/component/header');
		$this->load->view('admin/component/nav' , $this->data);
		$this->load->view('admin/user/edit_profile' , $this->data);
		$this->load->view('admin/component/footer');
		
		
	}

	public function change_password(){
		$capability = CAP_PUBLIC ;
		if(!checkPermision($capability)) return ;

		$id = $this->data['user_id'] ;
		//form validation rules
		$rule = array(
	            "old_password" => array( "field" => "old_password" , "label" => __l('my_form_old_password') , "rules" => "required|trim" ),
	            "new_password" => array( "field" => "new_password" , "label" => __l('my_form_new_password') , "rules" => "required|trim" ),
	            "repeat_password" => array( "field" => "repeat_password" , "label" => __l('my_form_repeat_password') , "rules" => "required|trim|matches[new_password]" ),
      		);


		$this->form_validation->set_rules($rule) ;
		if($this->form_validation->run() == TRUE){
			$data = array(
	                m_user::COLUMN_FIRST_NAME => $this->m_user->hash($this->input->post('new_password')) ,
	            );

			//check user pass if incorrect trow error
			$user = $this->m_user->get_by(
				array(
					m_user::COLUMN_USERNAME => $this->session->userdata('username') ,
					m_user::COLUMN_PASSWORD => $this->m_user->hash($this->input->post('old_password')) ,
					)
				, FALSE , FALSE);
			if($user == NULL){
				$this->session->set_flashdata('error', __l('my_error_fv_wrong_old_password'));
			}else{
				$result_id = $this->m_user->save($data , $id) ;
				if($result_id == NULL)
					$this->session->set_flashdata('error', __l('my_error_transaction'));
				else 
					$this->session->set_flashdata('message', __l('my_form_success_message'));	
			}
			///PRG Pattern
			header("Location: " . $_SERVER['REQUEST_URI']);
		}else{
			if(strlen(validation_errors() )  > 0 ){
				$this->session->set_flashdata('error', validation_errors());	
			}	
		}
		

		$this->data['title'] = __l('my_page_change_password') ;	

		$this->load->view('admin/component/header');
		$this->load->view('admin/component/nav' , $this->data);
		$this->load->view('admin/user/change_password' , $this->data);
		$this->load->view('admin/component/footer');
		
	}
}

