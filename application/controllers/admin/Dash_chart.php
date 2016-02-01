<?php 
class dash_chart extends Admin_Controller{

	public function __construct(){
		parent::__construct() ;
		$this->load->model('m_term_date');
		$this->load->model('m_chart_page');
		$this->load->model('m_chart_content');
		$this->load->model('m_major');
		$this->load->model('m_lesson');
	}

	public function add_chartpg($id = ''){


		if($id != '' && !is_numeric($id)) die('loading problem .. Call Administrator Plzz ..') ;
		$this->data['edit'] = ($id != '') ? TRUE : FALSE ;

		$chartpage = null ;
		if($this->data['edit']){
			$chartpage = $this->m_chart_page->get($id , TRUE) ;
			if($chartpage == NULL) die('there is a problem call Administrator plz ...') ;
		}

		if($this->data['edit']){
			if($chartpage->{m_chart_page::COLUMN_CREATOR} == $this->data['user_id'])
				$capability = CAP_EDIT_CHART ;
			else
				$capability = CAP_EDIT_ALL_CHART ;
		}else{
			$capability = CAP_ADD_CHART ;
		}
		if(!checkPermision($capability)) return ;


		//form validation rules
		$rule = array(
	            "term_date_id" => array( "field" => "term_date_id" , "label" => __l('my_form_term_list') , "rules" => "required|trim|numeric" ) ,
	            "major_id" => array( "field" => "major_id" , "label" => __l('my_form_major_id') , "rules" => "required|trim|numeric|is_available[major." . m_major::COLUMN_ID . "]|callback_chartpg_unique_check[" . $id . "]" ) ,
      		);


		$this->form_validation->set_rules($rule) ;
		if($this->form_validation->run() == TRUE){
			$data = array(
	                m_chart_page::COLUMN_TERMDATE_ID => $this->input->post('term_date_id') ,
	                m_chart_page::COLUMN_MAJOR_ID => $this->input->post('major_id') ,
	                
	            );

	            // remove empty indexes  .. in faghat vase insert estefade mishavad va shayad dar ayande asan hazfesh kardam :D
	            foreach ($data as $key => $val) if(strlen($val) == 0) unset($data[$key]) ; 

	             $chartpg_id = ($this->data['edit']) ? $this->m_chart_page->save($data , $id) : $this->m_chart_page->save($data) ;

			if($chartpg_id == NULL)
				$this->session->set_flashdata('error', __l('my_error_transaction'));
			else 
				$this->session->set_flashdata('message', __l('my_form_success_message') . $data[m_chart_page::COLUMN_TERMDATE_ID]);
        		
        		redirect('admin/dash_chart/add_chart_content/' . $chartpg_id ) ;

		}else{
			if(strlen(validation_errors() )  > 0 ){
				$this->session->set_flashdata('error', validation_errors());	
				///PRG Pattern
                   		header("Location: " . $_SERVER['REQUEST_URI']);
			}
			
		}

		$this->data['title'] = __l('my_page_add_chartpage') ;

		if($this->data['edit']){
			$this->data['values'] = array(
					'term_date_id' => $chartpage->{m_chart_page::COLUMN_TERMDATE_ID} ,
					'major_id' => $chartpage->{m_chart_page::COLUMN_MAJOR_ID} ,
				);
			$this->data['title'] = __l('my_page_edit_chartpage') ;	
		}

		$this->load->view('admin/component/header');
		$this->load->view('admin/component/nav' , $this->data);
		$this->load->view('admin/chartpage/add_chartpage' , $this->data);
		$this->load->view('admin/component/footer');
	}

	/**
	 * form_validation callback function
	 * it check that exist only one chart for a major and term
	 * @return Boolean      if we have no same chart it return true otherwise false
	 */
	public function chartpg_unique_check($str , $field){

		$this->db->where(array(
	                m_chart_page::COLUMN_MAJOR_ID => $this->input->post('major_id') ,
	                m_chart_page::COLUMN_TERMDATE_ID => $this->input->post('term_date_id') ,
	       ));

		$chart = $this->m_chart_page->get() ;
		if(sizeof($chart) > 0  && $uni[0]->{m_chart_page::COLUMN_ID}  != $field ) {
			$this->form_validation->set_message('chartpg_unique_check' , __l('my_error_fv_chartpage_unique')) ;
			return FALSE ;
		}
		return TRUE ;
		
	}


	public function chartpg_list($major_id = ''){

		$capability = CAP_VIEW_CHART_LIST ;
		if(!checkPermision($capability)) return ;


		$this->data['table'] = $this->m_chart_page->getTable($major_id , 'admin/dash_chart/add_chartpg' , '' , 'admin/dash_chart/chart_content_list') ;

		$this->data['title'] = __l('my_page_chartpage_list') ;
		$this->data['add_url'] = site_url('admin/dash_chart/add_chartpg') ;

		$this->load->view('admin/component/header');
		$this->load->view('admin/component/nav' , $this->data);
		$this->load->view('admin/list' , $this->data);
		$this->load->view('admin/component/footer');
	}


	public function add_chart_content($chartpg_id  , $id =''){

		if(! is_numeric($chartpg_id))
			die('invalid operation please call administrator ') ;


		$chart_content = null ;
		if($this->data['edit']){
			$chart_content = $this->m_chart_content->get($id , TRUE) ;
			if($chart_content == NULL) die('there is a problem call Administrator plz ...') ;
		}

		if($this->data['edit']){
			if($chart_content->{m_chart_content::COLUMN_CREATOR} == $this->data['user_id'])
				$capability = CAP_EDIT_CHART ;
			else
				$capability = CAP_EDIT_ALL_CHART ;
		}else{
			$capability = CAP_ADD_CHART ;
		}
		if(!checkPermision($capability)) return ;
		
		if($id != '' && !is_numeric($id)) die('loading problem .. Call Administrator Plzz ..') ;
		$this->data['edit'] = ($id != '') ? TRUE : FALSE ;

		//form validation rules
		$rule = array(
	            "term" => array( "field" => "term" , "label" => __l('my_form_chartcon_term') , "rules" => "required|trim|numeric" ) ,
	            "number" => array( "field" => "number" , "label" => __l('my_form_chartcon_number') , "rules" => "required|trim|numeric" ) ,
	            "lesson_id" => array( "field" => "lesson_id" , "label" => __l('my_form_chartcon_lesson_id') , "rules" => "required|trim|numeric|is_available[lesson." . m_lesson::COLUMN_ID . "]" ) ,
	            "pishniaz" => array( "field" => "pishniaz" , "label" => __l('my_form_chartcon_pishniaz') , "rules" => "trim" ) ,
	            "type" => array( "field" => "type" , "label" => __l('my_form_chartcon_type') , "rules" => "required|trim|numeric" ) ,
	            "ekhtiari_nazari_n" => array( "field" => "ekhtiari_nazari_n" , "label" => __l('my_form_chartcon_ekhtiari_nazari_n') , "rules" => "trim|numeric" ) ,
      		);	

		//agar type == 4 bood lesson_id ejbari nist
		if($this->input->post('type') == m_chart_content::TYPE_EKHTIARI){
			$rule['lesson_id'] = array( "field" => "lesson_id" , "label" => __l('my_form_chartcon_lesson_id') , "rules" => "trim|numeric|is_available[lesson." . m_lesson::COLUMN_ID . "]" ) ;
			$rule["ekhtiari_nazari_n"] = array( "field" => "ekhtiari_nazari_n" , "label" => __l('my_form_chartcon_ekhtiari_nazari_n') , "rules" => "required|trim|numeric" ) ;
		}

		$this->form_validation->set_rules($rule) ;
		if($this->form_validation->run() == TRUE){
			$data = array(
	                m_chart_content::COLUMN_TERM => $this->input->post('term') ,
	                m_chart_content::COLUMN_NUMBER => $this->input->post('number') ,
	                m_chart_content::COLUMN_LESSON_ID => $this->input->post('lesson_id') ,
	                m_chart_content::COLUMN_PISHNIAZ => $this->input->post('pishniaz') ,
	                m_chart_content::COLUMN_TYPE => $this->input->post('type') ,
	                m_chart_content::COLUMN_EKHTIARI_N => $this->input->post('ekhtiari_nazari_n') ,
	                m_chart_content::COLUMN_CHARTPAGE_ID => $chartpg_id ,
	                
	            );

	            // Set Null for Empty Indexes
	            foreach ($data as $key => $val) if(strlen($val) == 0) $data[$key] = NULL ; 
	            
	            $result_id = ($this->data['edit']) ? $this->m_chart_content->save($data , $id) : $this->m_chart_content->save($data) ;

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
		
		$this->data['title'] = __l('my_page_add_chart_content') ;
		
		if($this->data['edit']){
			$this->data['values'] = array(
					'term' => $chart_content->{m_chart_content::COLUMN_TERM} ,
					'number' => $chart_content->{m_chart_content::COLUMN_NUMBER} ,
					'lesson_id' => $chart_content->{m_chart_content::COLUMN_LESSON_ID} ,
					'type' => $chart_content->{m_chart_content::COLUMN_TYPE} ,
					'pishniaz' => $chart_content->{m_chart_content::COLUMN_PISHNIAZ} ,
					'ekhtiari_nazari_n' => $chart_content->{m_chart_content::COLUMN_EKHTIARI_N} ,
				);
			$this->data['title'] = __l('my_page_edit_university') ;	
		}

		$this->load->view('admin/component/header');
		$this->load->view('admin/component/nav' , $this->data);
		$this->load->view('admin/chartcontent/add_chart_content');
		$this->load->view('admin/component/footer');
	}

	public function chart_content_list($chartpg_id){

		$capability = CAP_VIEW_CHART_LIST ;
		if(!checkPermision($capability)) return ;
		
		$this->data['table'] = $this->m_chart_content->getTable($chartpg_id , 'admin/dash_chart/add_chart_content/' . $chartpg_id ) ;

		$this->data['title'] = __l('my_page_chart_content_list') ;
		$this->data['add_url'] = site_url('admin/dash_chart/add_chart_content/' . $chartpg_id) ;

		$this->load->view('admin/component/header');
		$this->load->view('admin/component/nav' , $this->data);
		$this->load->view('admin/list' , $this->data);
		$this->load->view('admin/component/footer');
	}
}