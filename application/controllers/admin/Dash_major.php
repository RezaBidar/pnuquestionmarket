<?php

class dash_major extends Admin_Controller{

	public function __construct(){
		parent::__construct() ;
		$this->load->model('m_major');
	}


	public function add_major($id = '' ){
		
		if($id != '' && !is_numeric($id)) die('loading problem .. Call Administrator Plzz ..') ;
		$this->data['edit'] = ($id != '') ? TRUE : FALSE ;

		$major = null ;
		if($this->data['edit']) {
			$major = $this->m_major->get($id , TRUE) ;
			if($major == NULL) die('there is a problem call Administrator plz ...') ;
		}

		if($this->data['edit']){
			if($major->{m_major::COLUMN_CREATOR} == $this->data['user_id'])
				$capability = CAP_EDIT_MAJOR ;
			else
				$capability = CAP_EDIT_ALL_MAJOR ;
		}else{
			$capability = CAP_ADD_MAJOR ;
		}
		if(!checkPermision($capability)) return ;

		//form validation rules
		$rule = array(
	            "id" => array( "field" => "id" , "label" => __l('my_form_major_id') , "rules" => "required|trim|tr_num|integer|is_unique[major." . m_major::COLUMN_ID . ']' ),
	            "name" => array( "field" => "name" , "label" => __l('my_form_major_name') , "rules" => "required|trim" ) ,
	            "group" => array( "field" => "group" , "label" => __l('my_form_major_group') , "rules" => "required|trim" ) ,
	            "daneshkade" => array( "field" => "daneshkade" , "label" => __l('my_form_major_daneshkade') , "rules" => "required|trim" ) ,
	            "maghta" => array( "field" => "maghta" , "label" => __l('my_form_major_maghta') , "rules" => "required|trim|integer" ) ,
	            "first_in" => array( "field" => "first_in" , "label" => __l('my_form_major_first_in') , "rules" => "trim|integer" ) ,
	            "last_in" => array( "field" => "last_in" , "label" => __l('my_form_major_last_in') , "rules" => "trim|integer" ) ,
      		);

		//custom rules for edit
		if($this->data['edit']){
			$rule["id"] = array( "field" => "id" , "label" => __l('my_form_major_id') , "rules" => "required|trim|tr_num|numeric|trim|is_unique_except_id[major." . m_major::COLUMN_ID .'.'. m_major::COLUMN_ID .'.'. $id .']' ) ;
		}

		$this->form_validation->set_rules($rule) ;
		if($this->form_validation->run() == TRUE){
			$data = array(
	                m_major::COLUMN_NAME => $this->input->post('name') ,
	                m_major::COLUMN_ID => $this->input->post('id') ,
	                m_major::COLUMN_GROUP => $this->input->post('group') ,
	                m_major::COLUMN_DANESHKADE => $this->input->post('daneshkade') ,
	                m_major::COLUMN_MAGHTA => $this->input->post('maghta') ,
	                m_major::COLUMN_FIRST_IN => $this->input->post('first_in') ,
	                m_major::COLUMN_LAST_IN => $this->input->post('last_in') ,
	                
	            );

			//remove empty indexes  
			foreach ($data as $key => $val) if(strlen($val) == 0) $data[$key] = NULL ; 
	            
	            $result_id = ($this->data['edit']) ? $this->m_major->save($data , $id) : $this->m_major->save($data) ;

			if($result_id == NULL)
				$this->session->set_flashdata('error', __l('my_error_transaction'));
			else 
				$this->session->set_flashdata('message', __l('my_form_success_message') . '  ' . $data[m_major::COLUMN_NAME]);

        		///PRG Pattern
                   	header("Location: " . $_SERVER['REQUEST_URI']);

		}else{
			if(strlen(validation_errors() )  > 0 ){
				$this->session->set_flashdata('error', validation_errors());	
				///PRG Pattern
                   		header("Location: " . $_SERVER['REQUEST_URI']);
			}
			
		}

		$this->data['title'] = __l('my_page_add_major') ;
		if($this->data['edit']){
			$this->data['values'] = array(
					'id' => $major->{m_major::COLUMN_ID} ,
					'name' => $major->{m_major::COLUMN_NAME} ,
					'group' => $major->{m_major::COLUMN_GROUP} ,
					'daneshkade' => $major->{m_major::COLUMN_DANESHKADE} ,
					'maghta' => $major->{m_major::COLUMN_MAGHTA} ,
					'first_in' => $major->{m_major::COLUMN_FIRST_IN} ,
					'last_in' => $major->{m_major::COLUMN_LAST_IN} ,
				);
			$this->data['title'] = __l('my_page_edit_major') ;	
		}

		$this->load->view('admin/component/header');
		$this->load->view('admin/component/nav' , $this->data);
		$this->load->view('admin/major/add_major' , $this->data);
		$this->load->view('admin/component/footer');

	}

	public function major_list(){
		$capability = CAP_VIEW_LESSON_LIST ;
		if(!checkPermision($capability)) return ;

		$this->data['table'] = $this->m_major->getTable('admin/dash_major/add_major') ;

		$this->data['title'] = __l('my_page_major_list') ;
		$this->data['add_url'] = site_url('admin/dash_major/add_major') ;

		$this->load->view('admin/component/header');
		$this->load->view('admin/component/nav' , $this->data);
		$this->load->view('admin/list' , $this->data);
		$this->load->view('admin/component/footer');
	}


}

