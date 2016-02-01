<?php

class dash_university extends Admin_Controller{

	public function __construct(){
		parent::__construct() ;
		$this->load->model('m_university');
	}


	public function add_university($id = ''){


		if($id != '' && !is_numeric($id)) die('loading problem .. Call Administrator Plzz ..') ;
		$this->data['edit'] = ($id != '') ? TRUE : FALSE ;

		$uni = null ;
		if($this->data['edit']) {
			$uni = $this->m_university->get($id , TRUE) ;
			if($uni == NULL) die('there is a problem call Administrator plz ...') ;
		}

		if($this->data['edit']){
			if($uni->{m_university::COLUMN_CREATOR} == $this->data['user_id'])
				$capability = CAP_EDIT_UNIVERSITY ;
			else
				$capability = CAP_EDIT_ALL_UNIVERSITY ;
		}else{
			$capability = CAP_ADD_UNIVERSITY ;
		}
		if(!checkPermision($capability)) return ;

		//form validation rules
		$rule = array(
	            "state" => array( "field" => "state" , "label" => __l('my_form_state') , "rules" => "required|trim" ),
	            "city" => array( "field" => "city" , "label" => __l('my_form_city') , "rules" => "required|trim|callback_university_unique_check[" . $id . ']' )
      		);


		$this->form_validation->set_rules($rule) ;
		if($this->form_validation->run() == TRUE){
			$data = array(
	                m_university::COLUMN_STATE => $this->input->post('state') ,
	                m_university::COLUMN_CITY => $this->input->post('city') ,
	            );

	            //remove empty indexes  .. in faghat vase insert estefade mishavad va shayad dar ayande asan hazfesh kardam :D
	            foreach ($data as $key => $val) if(strlen($val) == 0) unset($data[$key]) ; 
	            
	            $result_id = ($this->data['edit']) ? $this->m_university->save($data , $id) : $this->m_university->save($data) ;

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

		$this->data['title'] = __l('my_page_add_university') ;

		if($this->data['edit']){
			$this->data['values'] = array(
					'state' => $uni->{m_university::COLUMN_STATE} ,
					'city' => $uni->{m_university::COLUMN_CITY} ,
				);
			$this->data['title'] = __l('my_page_edit_university') ;	
		}

		$this->load->view('admin/component/header');
		$this->load->view('admin/component/nav' , $this->data);
		$this->load->view('admin/university/add_university');
		$this->load->view('admin/component/footer');

	}

	/**
	 * form_validation callback function
	 * it protect this state and city must be unique
	 * @return Boolean      if we have no same uni it return true otherwise false
	 */
	public function university_unique_check($str , $field){

		$this->db->where(array(
	                m_university::COLUMN_STATE => $this->input->post('state') ,
	                m_university::COLUMN_CITY => $this->input->post('city') ,
	       ));

		$uni = $this->m_university->get() ;
		if(sizeof($uni) > 0 && $uni[0]->{m_university::COLUMN_ID}  != $field) {
			$this->form_validation->set_message('university_unique_check' , __l('my_error_fv_university_unique')) ;
			return FALSE ;
		}
		return TRUE ;
		
	}

	public function university_list(){
		$capability = CAP_VIEW_UNIVERSITY_LIST ;
		if(!checkPermision($capability)) return ;

		$this->data['table'] = $this->m_university->getTable( 'admin/dash_university/add_university') ;

		$this->data['title'] = __l('my_page_university_list') ;
		$this->data['add_url'] =site_url( 'admin/dash_university/add_university' );

		$this->load->view('admin/component/header');
		$this->load->view('admin/component/nav' , $this->data);
		$this->load->view('admin/list' , $this->data);
		$this->load->view('admin/component/footer');
	}
}

