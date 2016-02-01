<?php

class dash_lesson extends Admin_Controller{

	public function __construct(){
		parent::__construct() ;
		$this->load->model('m_lesson');
		$this->load->model('m_qpage_lesson');
	}


	public function add_lesson($id = ''){


		if($id != '' && !is_numeric($id)) die('loading problem .. Call Administrator Plzz ..') ;
		$this->data['edit'] = ($id != '' && $this->m_lesson->get($id,TRUE) != NULL ) ? TRUE : FALSE ;

		$lesson = null ;
		if($this->data['edit']) {
			$lesson = $this->m_lesson->get($id , TRUE) ;
			if($lesson == NULL) die('there is a problem call Administrator plz ...') ;
		}

		if($this->data['edit']){
			if($lesson->{m_lesson::COLUMN_CREATOR} == $this->data['user_id'])
				$capability = CAP_EDIT_LESSON ;
			else
				$capability = CAP_EDIT_ALL_LESSON ;
		}else{
			$capability = CAP_ADD_LESSON ;
		}
		if(!checkPermision($capability)) return ;


		//form validation rules
		$rule = array(
	            "id" => array( "field" => "id" , "label" => __l('my_form_lesson_id') , "rules" => "required|trim|tr_num|numeric|is_unsigned_int|is_unique[lesson." . m_lesson::COLUMN_ID . ']' ),
	            "name" => array( "field" => "name" , "label" => __l('my_form_lesson_name') , "rules" => "required|trim" ) ,
	            "amali_n" => array( "field" => "amali_n" , "label" => __l('my_form_amali_n') , "rules" => "trim|tr_num|numeric" ) ,
	            "nazari_n" => array( "field" => "nazari_n" , "label" => __l('my_form_nazari_n') , "rules" => "trim|tr_num|numeric" ) ,
	            "amali_h" => array( "field" => "amali_h" , "label" => __l('my_form_amali_h') , "rules" => "trim|tr_num|numeric" ) ,
	            "nazari_h" => array( "field" => "nazari_h" , "label" => __l('my_form_nazari_h') , "rules" => "trim|tr_num|numeric" ) ,
	            "azmoon_type" => array( "field" => "azmoon_type" , "label" => __l('my_form_azmoon_type') , "rules" => "trim|numeric" ) ,
      		);

		//custom rules for edit
		if($this->data['edit']){
			$rule["id"] = array( "field" => "id" , "label" => __l('my_form_lesson_id') , "rules" => "required|trim|tr_num|numeric|trim|is_unique_except_id[lesson." . m_lesson::COLUMN_ID .'.'. m_lesson::COLUMN_ID .'.'. $id .']' ) ;
		}


		$this->form_validation->set_rules($rule) ;
		if($this->form_validation->run() == TRUE){

			$data = array(
	                m_lesson::COLUMN_NAME => $this->input->post('name') ,
	                m_lesson::COLUMN_ID => $this->input->post('id') ,
	                m_lesson::COLUMN_AMALI_N => $this->input->post('amali_n') ,
	                m_lesson::COLUMN_NAZARI_N => $this->input->post('nazari_n') ,
	                m_lesson::COLUMN_AMALI_H => $this->input->post('amali_h') ,
	                m_lesson::COLUMN_NAZARI_H => $this->input->post('nazari_h') ,
	                m_lesson::COLUMN_AZMOON_TYPE => $this->input->post('azmoon_type') 
	            );

	            //remove empty indexes  ..
	            foreach ($data as $key => $val) if(strlen($val) == 0) $data[$key] = NULL; 

	            $result_id = ($this->data['edit']) ? $this->m_lesson->save($data , $id) : $this->m_lesson->save($data) ;

			if($this->m_lesson->get($data[m_lesson::COLUMN_ID] , TRUE) == NULL)
				$this->session->set_flashdata('error', __l('my_error_transaction'));
			else 
				$this->session->set_flashdata('message', __l('my_form_success_message') . $data[m_lesson::COLUMN_NAME]);

        		///PRG Pattern
                   	header("Location: " . $_SERVER['REQUEST_URI']);

		}else{
			if(strlen(validation_errors() )  > 0 ){
				$this->session->set_flashdata('error', validation_errors());	
			}
			
		}

		$this->data['title'] = __l('my_page_add_lesson') ;
		$this->data['lesson_id'] = $id ;

		if($this->data['edit']){
			$lesson = $this->m_lesson->get($id , TRUE) ;
			if($lesson == NULL) die('there is a problem call Administrator plz ...') ;
			$this->data['values'] = array(
					'id' => $lesson->{m_lesson::COLUMN_ID} ,
					'name' => $lesson->{m_lesson::COLUMN_NAME} ,
					'nazari_n' => $lesson->{m_lesson::COLUMN_NAZARI_N} ,
					'amali_n' => $lesson->{m_lesson::COLUMN_AMALI_N} ,
					'nazari_h' => $lesson->{m_lesson::COLUMN_NAZARI_H} ,
					'amali_h' => $lesson->{m_lesson::COLUMN_AMALI_H} ,
					'azmoon_type' => $lesson->{m_lesson::COLUMN_AZMOON_TYPE} ,
				);
			$this->data['title'] = __l('my_page_edit_lesson') ;	
		}

		$this->load->view('admin/component/header');
		$this->load->view('admin/component/nav' , $this->data);
		$this->load->view('admin/lesson/add_lesson' , $this->data);
		$this->load->view('admin/component/footer');

	}

	public function lesson_list($user_id = ''){
		$capability = CAP_VIEW_LESSON_LIST ;
		if(!checkPermision($capability)) return ;
		$this->data['title'] = __l('my_page_lesson_list') ;

		if($user_id != '' && is_numeric($user_id)){
			$this->db->where(m_lesson::COLUMN_CREATOR , $user_id);
			$this->data['title'] = __l('my_page_my_lesson_list') ;
		}

		$this->data['table'] = $this->m_lesson->getTable('admin/dash_lesson/add_lesson','admin/dash_lesson/delete','admin/dash_lesson/lesson_review') ;

		
		$this->data['add_url'] = site_url('admin/dash_lesson/add_lesson') ;

		$this->load->view('admin/component/header');
		$this->load->view('admin/component/nav' , $this->data);
		$this->load->view('admin/list' , $this->data);
		$this->load->view('admin/component/footer');
	}

	public function possible_add_lesson(){

		$capability = CAP_ADD_LESSON ;
		if(!checkPermision($capability)) return ;

		//form validation rules
		$rule = array(
	            "lesson_list" => array( "field" => "lesson_list" , "label" => __l('my_form_lesson_lessonlist') , "rules" => "required|trim|tr_num" ),
      		);


		$this->form_validation->set_rules($rule) ;
		if($this->form_validation->run() == TRUE){
			$lesson_list = explode(',' , $this->input->post('lesson_list') ) ;
			$this->data['lesson_list'] = array() ;
			foreach ($lesson_list as $lesson_id) {
				$lesson_id = preg_replace('/\D/' , '' , $lesson_id) ;
				if(is_numeric($lesson_id)){
					$lesson_obj = $this->m_lesson->get($lesson_id , TRUE) ;
					$this->data['lesson_list'][$lesson_id] = ($lesson_obj == NULL) ? NULL : $lesson_obj->{m_lesson::COLUMN_NAME} ;
				}
			}
		}else{
			if(strlen(validation_errors() )  > 0 ){
				$this->session->set_flashdata('error', validation_errors());	
			}
		}

		$capability = CAP_PUBLIC ;
		if(!checkPermision($capability)) return ;
		$this->data['title'] = __l('my_page_lesson_possible_add') ;

		$this->load->view('admin/component/header');
		$this->load->view('admin/component/nav' , $this->data);
		$this->load->view('admin/lesson/possible_add_lesson' , $this->data);
		$this->load->view('admin/component/footer');		
	}

	public function lesson_review($id = ''){		
		$capability = CAP_VIEW_LESSON ;
		if(!checkPermision($capability)) return ;

		$this->data['lesson'] = $this->m_lesson->get($id , TRUE) ;
		if($this->data['lesson'] == NULL) die("Call Administrator Plzz...");

		$this->data['title'] = __l('my_page_lesson_review') ;

		$this->load->view('admin/component/header');
		$this->load->view('admin/component/nav' , $this->data);
		$this->load->view('admin/lesson/lesson_review' , $this->data);
		$this->load->view('admin/component/footer');			

		
	}

	public function delete($id)
	{

		$lesson = $this->m_lesson->get($id , TRUE) ;
		if($lesson == NULL) die('there is a problem call Administrator plz ...') ;
	
		if($lesson->{m_lesson::COLUMN_CREATOR} == $this->data['user_id'])
			$capability = CAP_EDIT_LESSON ;
		else
			$capability = CAP_EDIT_ALL_LESSON ;
		if(!checkPermision($capability)) return ;

		if($id == NULL) die('Call Administrator Plz ...') ;
		//find is there any qpage with this lesson id
		$question_list = $this->m_qpage_lesson->get_by(array(m_qpage_lesson::COLUMN_LESSON_ID => $id) , FALSE , FALSE ) ;
		//if this lesson didnt use in any qpage than we can delete otherwise show error to user 
		if(sizeof($question_list) == 0){
			//delete lesson
			$this->m_lesson->delete($id) ;	
			redirect($_SERVER['HTTP_REFERER']);
	
		}else {
			$data['heading'] = "Delete Limit " ;
			$data['message'] = __l('my_error_lesson_delete_limit') ;
			$this->load->view('errors/html/error_general', $data);
		}
	}

	/**
	 * give lesson id and return lesson name 
	 * use for ajax
	 * if lesson not found return -1
	 * @param  integer $lesson_id 
	 * @return string       lesson name            
	 */
	public function get_lesson_name($lesson_id){
		if( !is_numeric($lesson_id) ) die('-1') ;

		$lesson = $this->m_lesson->get_by(array( m_lesson::COLUMN_ID => $lesson_id ) , TRUE , FALSE) ;
		if($lesson == NULL ) die('-1') ;
		
		echo $lesson->{m_lesson::COLUMN_NAME} ;
 	}

}

