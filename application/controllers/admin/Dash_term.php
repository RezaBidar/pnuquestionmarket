<?php

class dash_term extends Admin_Controller{

	public function __construct(){
		parent::__construct() ;
		$this->load->model('m_term_date');
	}


	public function add_term($id = ''){

		if($id != '' && !is_numeric($id)) die('loading problem .. Call Administrator Plzz ..') ;
		$this->data['edit'] = ($id != '') ? TRUE : FALSE ;


		$m_term_date = null ;
		if($this->data['edit']) {
			$term = $this->m_term_date->get($id , TRUE) ;
			if($term == NULL) die('there is a problem call Administrator plz ...') ;
		}
		
		if($this->data['edit']){
			if($m_term_date->{m_term_date::COLUMN_CREATOR} == $this->data['user_id'])
				$capability = CAP_EDIT_TERM ;
			else
				$capability = CAP_EDIT_ALL_TERM ;
		}else{
			$capability = CAP_ADD_TERM ;
		}
		if(!checkPermision($capability)) return ;		

		//form validation rules
		$rule = array(
	            "id" => array( "field" => "id" , "label" => __l('my_form_term_id') , "rules" => "required|trim|tr_num|numeric|is_unique[term_date." . m_term_date::COLUMN_ID . ']' ),
	            "name" => array( "field" => "name" , "label" => __l('my_form_name') , "rules" => "required|trim" ),
	            "sal" => array( "field" => "sal" , "label" => __l('my_form_sal') , "rules" => "required|trim|tr_num|numeric" ) ,
	            "nimsal" => array( "field" => "nimsal" , "label" => __l('my_form_nimsal') , "rules" => "required|trim|tr_num|numeric" ) ,
      		);

		//custom rules for edit
		if($this->data['edit']){
			$rule["id"] = array( "field" => "id" , "label" => __l('my_form_term_id') , "rules" => "required|trim|tr_num|numeric|trim|is_unique_except_id[term_date." . m_term_date::COLUMN_ID .'.'. m_term_date::COLUMN_ID .'.'. $id .']' ) ;
		}

		$this->form_validation->set_rules($rule) ;
		if($this->form_validation->run() == TRUE){
			$data = array(
	                m_term_date::COLUMN_ID => $this->input->post('id') ,
	                m_term_date::COLUMN_NAME => $this->input->post('name') ,
	                m_term_date::COLUMN_SAL => $this->input->post('sal') ,
	                m_term_date::COLUMN_NIMSAL => $this->input->post('nimsal') ,
	                
	            );

	            //remove empty indexes  .. in faghat vase insert estefade mishavad va shayad dar ayande asan hazfesh kardam :D
	            foreach ($data as $key => $val) if(strlen($val) == 0) $data[$key] = NULL; 
	            
	            $result_id = ($this->data['edit']) ? $this->m_term_date->save($data , $id) : $this->m_term_date->save($data) ;

			if($result_id == NULL)
				$this->session->set_flashdata('error', __l('my_error_transaction'));
			else 
				$this->session->set_flashdata('message', __l('my_form_success_message') . $data[m_term_date::COLUMN_NAME]);

        		///PRG Pattern
                   	header("Location: " . $_SERVER['REQUEST_URI']);

		}else{
			if(strlen(validation_errors() )  > 0 ){
				$this->session->set_flashdata('error', validation_errors());	
			}
			
		}

		$this->data['title'] = __l('my_page_add_term') ;

		if($this->data['edit']){
			$this->data['values'] = array(
					'id' => $term->{m_term_date::COLUMN_ID} ,
					'name' => $term->{m_term_date::COLUMN_NAME} ,
					'nimsal' => $term->{m_term_date::COLUMN_NIMSAL} ,
					'sal' => $term->{m_term_date::COLUMN_SAL} ,
				);
			$this->data['title'] = __l('my_page_edit_term') ;	
		}

		$this->load->view('admin/component/header');
		$this->load->view('admin/component/nav' , $this->data);
		$this->load->view('admin/term/add_term');
		$this->load->view('admin/component/footer');

	}

	public function term_list(){
		$capability = CAP_VIEW_TERM_LIST ;
		if(!checkPermision($capability)) return ;

		$this->data['table'] = $this->m_term_date->getTable('admin/dash_term/add_term') ;

		$this->data['title'] = __l('my_page_term_list') ;
		$this->data['add_url'] = site_url('admin/dash_term/add_term') ;

		$this->load->view('admin/component/header');
		$this->load->view('admin/component/nav' , $this->data);
		$this->load->view('admin/list' , $this->data);
		$this->load->view('admin/component/footer');
	}
}

