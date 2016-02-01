<?php

class dash_question extends Admin_Controller{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_term_date');
		$this->load->model('m_question_page');
		$this->load->model('m_qpage_lesson' );
		$this->load->model('m_question' );
		$this->load->model('m_lesson' );
	}	


	public function add_qpage($id = ''){

		if($id != '' && !is_numeric($id)) die('loading problem .. Call Administrator Plzz ..') ;
		$this->data['edit'] = ($id != '') ? TRUE : FALSE ;


		$qpage = null ;
		if($this->data['edit']) {
			$qpage = $this->m_question_page->get($id , TRUE) ;
			if($qpage == NULL) die('there is a problem call Administrator plz ...') ;
		}

		if($this->data['edit']){
			if($qpage->{m_question_page::COLUMN_CREATOR} == $this->data['user_id'])
				$capability = CAP_EDIT_QUESTION ;
			else
				$capability = CAP_EDIT_ALL_QUESTION ;
		}else{
			$capability = CAP_ADD_QUESTION ;
		}
		if(!checkPermision($capability)) return ;

		//form validation rules
		$rule = array(
	            // "id" => array( "field" => "id" , "label" => __l('my_form_lesson_id') , "rules" => "required|trim|tr_num|integer|is_unique[lesson." . m_lesson::COLUMN_ID . ']' ),
	            "term_date_id" => array( "field" => "term_date_id" , "label" => __l('my_form_term_list') , "rules" => "required|trim|numeric" ) ,
	            "name" => array( "field" => "name" , "label" => __l('my_form_qpage_name') , "rules" => "required|trim" ) ,
	            "majors" => array( "field" => "majors" , "label" => __l('my_form_qpage_majors') , "rules" => "required|trim" ) ,
	            "seri" => array( "field" => "seri" , "label" => __l('my_form_qpage_seri') , "rules" => "required|trim|tr_num|in_list[1,2,3,4]" ) ,
	            "lesson_id" => array( "field" => "lesson_id[]" , "label" => __l('my_form_qpage_lesson_id') , "rules" => "required|trim|numeric" ) ,
	            "test_n" => array( "field" => "test_n" , "label" => __l('my_form_qpage_test_n') , "rules" => "required|trim|numeric" ) ,
	            "tashrihi_n" => array( "field" => "tashrihi_n" , "label" => __l('my_form_qpage_tashrihi_n') , "rules" => "required|trim|numeric" ) ,
	            "test_time" => array( "field" => "test_time" , "label" => __l('my_form_qpage_test_time') , "rules" => "required|trim|numeric" ) ,
	            "tashrihi_time" => array( "field" => "tashrihi_time" , "label" => __l('my_form_qpage_tashrihi_time') , "rules" => "required|trim|numeric" ) ,
      		);

		$this->form_validation->set_rules($rule) ;
		if($this->form_validation->run() == TRUE){

			$data = array(
	                m_question_page::COLUMN_NAME => $this->input->post('name') ,
	                m_question_page::COLUMN_SERI => $this->input->post('seri') ,
	                m_question_page::COLUMN_MAJORS => $this->input->post('majors') ,
	                m_question_page::COLUMN_TASHRIHI_N => $this->input->post('tashrihi_n') ,
	                m_question_page::COLUMN_TASHRIHI_TIME => $this->input->post('tashrihi_time') ,
	                m_question_page::COLUMN_TEST_N => $this->input->post('test_n') ,
	                m_question_page::COLUMN_TEST_TIME => $this->input->post('test_time') ,
	                m_question_page::COLUMN_TERMDATE_ID => $this->input->post('term_date_id') ,
	            );

	            $lsn_id_arr = $this->input->post('lesson_id') ;			

	            
			//remove empty indexes  
			foreach ($data as $key => $val) if(strlen($val) == 0) $data[$key] = NULL ; 
	            

	            $this->db->trans_start() ;
	            $qpage_id = ($this->data['edit']) ? $this->m_question_page->save($data , $id) : $this->m_question_page->save($data) ;
	            $this->m_qpage_lesson->safeSave($qpage_id , $lsn_id_arr) ;
	            $this->db->trans_complete();

			if ($this->db->trans_status() === FALSE){
				$this->session->set_flashdata('error', __l('my_error_transaction'));	
				// var_dump($this->session->flashdata('dberror')) ;
			}
			else {
				$this->session->set_flashdata('message', __l('my_form_success_message') . '  ' . $data[m_question_page::COLUMN_NAME]);
				if($this->data['edit'])
					redirect('admin/dash_question/question_list/' . $qpage_id) ;
				else
					//redireto to add question
					redirect('admin/dash_question/add_question/' . $qpage_id) ;
			}
	            
        		//PRG Pattern
                   	// header("Location: " . $_SERVER['REQUEST_URI']);

		}else{
			if(strlen(validation_errors() )  > 0 ){
				$this->session->set_flashdata('error', validation_errors());	
				//PRG Pattern
                   		// header("Location: " . $_SERVER['REQUEST_URI']);
			}
			
		}	

		$this->data["title"] = __l('my_page_add_qpage');

		$this->data['lesson_list'] = array() ;
		if($this->data['edit']){
			$this->data['lesson_list'] = $this->m_qpage_lesson->getLessons($qpage->{m_question_page::COLUMN_ID}) ;
			$this->data['values'] = array(
					'name' => $qpage->{m_question_page::COLUMN_NAME} ,
					'seri' => $qpage->{m_question_page::COLUMN_SERI} ,
					'majors' => $qpage->{m_question_page::COLUMN_MAJORS} ,
					'tashrihi_n' => $qpage->{m_question_page::COLUMN_TASHRIHI_N} ,
					'tashrihi_time' => $qpage->{m_question_page::COLUMN_TASHRIHI_TIME} ,
					'test_n' => $qpage->{m_question_page::COLUMN_TEST_N} ,
					'test_time' => $qpage->{m_question_page::COLUMN_TEST_TIME} ,
					'term_date_id' => $qpage->{m_question_page::COLUMN_TERMDATE_ID} ,
				);
			$this->data['title'] = __l('my_page_edit_qpage') ;	
		}

		$this->load->view('admin/component/header');
		$this->load->view('admin/component/nav' , $this->data );
		$this->load->view('admin/qpage/add_qpage' ,$this->data);
		$this->load->view('admin/component/footer');
	}


	public function question_list($qpage_id){

		$capability = CAP_VIEW_QUESTION_LIST ;
		if(!checkPermision($capability)) return ;

		$qpage = $this->m_question_page->get($qpage_id , TRUE) ;
		if($qpage_id == '' || $qpage == NULL) die('Call Administrator Plzz ...') ;

		$this->data['table'] = $this->m_question->getTable($qpage_id , 'admin/dash_question/add_question/'.$qpage_id , 'admin/dash_question/delete_question' , 'admin/dash_question/question_review/'.$qpage_id) ;

		$this->data['title'] = __l('my_page_question_list') . ' - <small>' . $qpage->{m_question_page::COLUMN_NAME} . '</small>' ;
		$this->data['add_url'] = site_url('admin/dash_question/add_question/' . $qpage_id) ;
		$this->data['info_url'] = site_url('admin/dash_question/qpage_review/' . $qpage_id) ;
		$this->data['info_text'] = 'نمای کامل برگه سوال' ;

		$this->load->view('admin/component/header');
		$this->load->view('admin/component/nav' , $this->data);
		$this->load->view('admin/list' , $this->data);
		$this->load->view('admin/component/footer');
	}


	public function qpage_list($user_id = ''){
		if($user_id != '' && !is_numeric($user_id)) die('loading problem .. Call Administrator Plzz ..') ;

		$capability = CAP_VIEW_QUESTION_LIST ;
		if(!checkPermision($capability)) return ;
		
		if($user_id != '')
			$this->db->where(m_question_page::COLUMN_CREATOR , $user_id);
		
		$this->data['table'] = $this->m_question_page->getTable('admin/dash_question/add_qpage' , 'admin/dash_question/delete_qpage' , 'admin/dash_question/question_list') ;

		$this->data['title'] = __l('my_page_qpage_list') ;
		$this->data['add_url'] = site_url('admin/dash_question/add_qpage') ;

		if($user_id != ''){
			$this->data['title'] = __l('my_page_my_qpage_list') ;
		}

		$this->load->view('admin/component/header');
		$this->load->view('admin/component/nav' , $this->data);
		$this->load->view('admin/list' , $this->data);
		$this->load->view('admin/component/footer');
	}


	public function add_question($qpage_id , $id = ''){
		$qpage_id = intval($qpage_id) ;

		if($id != '' && !is_numeric($id)) die('loading problem .. Call Administrator Plzz ..') ;
		$this->data['edit'] = ($id != '') ? TRUE : FALSE ;

		//get qpage info 
		$qpage = $this->m_question_page->getInfo($qpage_id) ;
		if($qpage == NULL) die('there is no question page with this ID ');
		$this->data['qpage_name'] = $qpage->{m_question_page::COLUMN_NAME} ;

		$question = null ;
		if($this->data['edit']) {
			$question = $this->m_question->get($id , TRUE) ;
			if($question == NULL) die('there is a problem call Administrator plz ...') ;
		}

		if($this->data['edit']){
			if($question->{m_question::COLUMN_CREATOR} == $this->data['user_id'])
				$capability = CAP_EDIT_QUESTION ;
			else
				$capability = CAP_EDIT_ALL_QUESTION ;
		}else{
			if($qpage->{m_question_page::COLUMN_CREATOR} != $this->data['user_id'])
				$capability = CAP_EDIT_ALL_QUESTION ;
			else 
				$capability = CAP_ADD_QUESTION ;
				
		}
		if(!checkPermision($capability)) return ;


		//testi ya tashrihi
		$type = 1 ;
		if(isset($_POST['type'])){
			$type = intval($this->input->post('type')) ;
		}

		if($type == 1){
			//form validation rules
			$rule = array(
		            "number_in_page" => array( "field" => "number_in_page" , "label" => __l('my_form_question_number') , "rules" => "required|trim|tr_num|numeric|callback_question_number_unique_check[{$qpage_id}.{$id}]" ) ,
		            "type" => array( "field" => "type" , "label" => __l('my_form_question_type') , "rules" => "required|trim|tr_num|numeric" ) ,
		            "text" => array( "field" => "text" , "label" => __l('my_form_question_text') , "rules" => "required|trim" ) ,
		            "answer" => array( "field" => "answer" , "label" => __l('my_form_question_answer') , "rules" => "required|trim|numeric" ) ,
		            "a" => array( "field" => "a" , "label" => __l('my_form_question_answer_a') , "rules" => "required|trim" ) ,
		            "b" => array( "field" => "b" , "label" => __l('my_form_question_answer_b') , "rules" => "required|trim" ) ,
		            "c" => array( "field" => "c" , "label" => __l('my_form_question_answer_c') , "rules" => "required|trim" ) ,
		            "d" => array( "field" => "d" , "label" => __l('my_form_question_answer_d') , "rules" => "required|trim" ) ,
	      		);

			$data = array(
				m_question::COLUMN_NUMBER => $this->input->post('number_in_page') ,
				m_question::COLUMN_TYPE => $this->input->post('type') ,
				m_question::COLUMN_TEXT => img2shortcode($this->input->post('text')) ,
				m_question::COLUMN_ANSWER => $this->input->post('answer') ,
				m_question::COLUMN_A => img2shortcode($this->input->post('a')) ,
				m_question::COLUMN_B => img2shortcode($this->input->post('b')) ,
				m_question::COLUMN_C => img2shortcode($this->input->post('c')) ,
				m_question::COLUMN_D => img2shortcode($this->input->post('d')) ,
				m_question::COLUMN_QPAGE_ID => $qpage_id ,
				m_question::COLUMN_ANSWER_TEXT => NULL ,
			);

		}else if($type == 2){
			$rule = array(
		            "number_in_page" => array( "field" => "number_in_page" , "label" => __l('my_form_question_number') , "rules" => "required|trim|tr_num|numeric|callback_question_number_unique_check[{$qpage_id}.{$id}]" ) ,
		            "type" => array( "field" => "type" , "label" => __l('my_form_question_type') , "rules" => "required|trim|tr_num|numeric" ) ,
		            "text" => array( "field" => "text" , "label" => __l('my_form_question_text') , "rules" => "required|trim" ) ,
		            "answer_text" => array( "field" => "answer_text" , "label" => __l('my_form_question_answer') , "rules" => "trim" ) ,
	      		);

			$data = array(
				m_question::COLUMN_NUMBER => $this->input->post('number_in_page') ,
				m_question::COLUMN_TYPE => $this->input->post('type') ,
				m_question::COLUMN_TEXT => img2shortcode($this->input->post('text')) ,
				m_question::COLUMN_ANSWER_TEXT => img2shortcode($this->input->post('answer_text')) ,
				m_question::COLUMN_QPAGE_ID => $qpage_id ,
				m_question::COLUMN_ANSWER => NULL ,
				m_question::COLUMN_A => NULL ,
				m_question::COLUMN_B => NULL ,
				m_question::COLUMN_C => NULL ,
				m_question::COLUMN_D => NULL ,
			);
		}else {
			die('call administrator please !!!') ;
		}

		$this->form_validation->set_rules($rule) ;
		if($this->form_validation->run() == TRUE){

			//set NULL for empty indexes
			foreach ($data as $key => $val) if(strlen($val) == 0) $data[$key] = NULL ; 

			$result_id = ($this->data['edit']) ? $this->m_question->save($data , $id) : $this->m_question->save($data) ;

			if($result_id == NULL)
				$this->session->set_flashdata('error', __l('my_error_transaction'));
			else 
				$this->session->set_flashdata('message', __l('my_form_success_message') . addInParagraph($data[m_question::COLUMN_NUMBER] .' - ' , my_excerpts(shortcode2img($data[m_question::COLUMN_TEXT]))));

			///PRG Pattern
			header("Location: " . $_SERVER['REQUEST_URI']);

		}else{
			if(strlen(validation_errors() )  > 0 ){
				$this->session->set_flashdata('error', validation_errors());	
			}
		}


		$this->data['number_in_page'] = '';
		
		if($this->data['edit']){
			$this->data['values'] = array(
					'number_in_page' => $question->{m_question::COLUMN_NUMBER} ,
					'type' => $question->{m_question::COLUMN_TYPE} ,
					'text' => shortcode2img($question->{m_question::COLUMN_TEXT} ) ,
					'answer' => shortcode2img($question->{m_question::COLUMN_ANSWER}) ,
					'answer_text' => shortcode2img($question->{m_question::COLUMN_ANSWER_TEXT} ) ,
					'a' => shortcode2img($question->{m_question::COLUMN_A} ) ,
					'b' => shortcode2img($question->{m_question::COLUMN_B} ) ,
					'c' => shortcode2img($question->{m_question::COLUMN_C} ) ,
					'd' => shortcode2img($question->{m_question::COLUMN_D} ) ,
				);
			$this->data['title'] = __l('my_page_edit_question') ;	
		}else{
			$this->data['number_in_page'] = $this->m_question->maxNumber($qpage_id) + 1;
			$this->data['type'] = ($this->data['number_in_page'] <= $qpage->{m_question_page::COLUMN_TEST_N}) ? m_question::TYPE_TESTI : m_question::TYPE_TASHRIHI ;
		}

		$this->data["title"] = __l('my_page_add_question');
		$this->data["question_list_url"] = site_url('admin/dash_question/question_list/'.$qpage_id);
		$this->load->view('admin/component/header');
		$this->load->view('admin/component/nav' , $this->data );
		$this->load->view('admin/question/add_question' ,$this->data);
		$this->load->view('admin/component/footer');
	}

	public function qpage_unique_check($term_date_id , $lesson_id , $seri){

		$this->db->join('question_page' , m_question_page::COLUMN_ID . ' = ' . m_qpage_lesson::COLUMN_QPAGE_ID );
		$this->db->join('lesson' , m_lesson::COLUMN_ID . ' = ' . m_qpage_lesson::COLUMN_LESSON_ID );
		$this->db->where(m_question_page::COLUMN_TERMDATE_ID , $term_date_id) ;
		$this->db->where(m_question_page::COLUMN_SERI , $seri) ;
		$this->db->where(m_qpage_lesson::COLUMN_LESSON_ID , $lesson_id) ;
		$qpage = $this->m_qpage_lesson->get( NULL , TRUE ) ;
		if($qpage == NULL ) echo 'برگه ی سوالی همانند برگه ی سوال شما پیدا نشد . میتوانید ادامه دهید '  ;
		else echo '<p>یک برگه سوال همانند برگه سوال شما در سیستم پیدا شده . لطفا با کلیک بر روی لینک زیر برگه را مشاهده نمایید و در صورت یکی بودن برگه ها این موضوع را به مدیر سیستم اطلاع دهید </p>
					<a target="_blank" href="'. site_url('admin/dash_question/qpage_review/' . $qpage->{m_question_page::COLUMN_ID} ) .'" >مشاهده برگه سوال</a>' ;
	}


	public function qpage_review($qpage_id){

		$capability = CAP_VIEW_QUESTION_LIST ;
		if(!checkPermision($capability)) return ;
		
		$this->data['qpage'] = $this->m_question_page->get($qpage_id , TRUE ) ;

		$this->db->where(m_question::COLUMN_QPAGE_ID , $qpage_id) ;
		$this->db->order_by(m_question::COLUMN_NUMBER);
		$this->data['question_list'] = $this->m_question->get(); 

		$this->data["title"] = __l('my_page_qpage_review');
		$this->load->view('admin/component/header');
		$this->load->view('admin/component/nav' , $this->data );
		$this->load->view('admin/qpage/qpage_review' , $this->data);
		$this->load->view('admin/component/footer');	
	}

	public function question_review($qpage_id , $question_id){
		redirect('admin/dash_question/qpage_review/' . $qpage_id . '#q_' . $question_id);
	}

	/**
	 * show table of question that has incorrect numeric
	 * @return [type] [description]
	 */
	public function wrong_number_qpages(){
		$this->db->select(array(
				'MAX('.m_question::COLUMN_NUMBER .') as max' ,
				'COUNT(DISTINCT('.m_question::COLUMN_NUMBER .')) as count' ,
			)
		);
		$this->db->group_by(m_question::COLUMN_QPAGE_ID);

		var_dump($this->m_question->get()) ;
	}



	/**
	 * form_validation callback function
	 * it protect this number in page must be unique
	 * @return Boolean      if we have no same number it return true otherwise false
	 */
	public function question_number_unique_check($str , $field){
		sscanf($field, '%[^.].%[^.]', $qpage_id, $question_id);

		log_message('error',$qpage_id . ' ' . $question_id);
		$this->db->where(array(
	                m_question::COLUMN_NUMBER => $str ,
	                m_question::COLUMN_QPAGE_ID => $qpage_id ,
	       ));


		$number = $this->m_question->get() ;
		if(sizeof($number) > 0 && $number[0]->{m_question::COLUMN_ID}  != $question_id) {
			$this->form_validation->set_message('question_number_unique_check' , __l('my_error_fv_number_in_page_unique')) ;
			return FALSE ;
		}
		return TRUE ;
		
	}

	public function delete_question($id){
	
		$question = $this->m_question->get($id , TRUE) ;
		if($question == NULL) die('there is a problem call Administrator plz ...') ;
		
		if($question->{m_question::COLUMN_CREATOR} == $this->data['user_id'])
			$capability = CAP_EDIT_QUESTION ;
		else
			$capability = CAP_EDIT_ALL_QUESTION ;

		if(!checkPermision($capability)) return ;

		$this->m_question->delete($id);
		redirect('admin/dash_question/question_list/' . $question->{m_question::COLUMN_QPAGE_ID}) ;


	}
	
	public function delete_qpage($id){
	
		$qpage = $this->m_question_page->get($id , TRUE) ;
		if($qpage == NULL) die('there is a problem call Administrator plz ...') ;
		
		if($qpage->{m_question_page::COLUMN_CREATOR} == $this->data['user_id'])
			$capability = CAP_EDIT_QUESTION ;
		else
			$capability = CAP_EDIT_ALL_QUESTION ;

		if(!checkPermision($capability)) return ;
		
		$this->db->trans_start() ;	
			$this->m_question->delete(array(m_question::COLUMN_QPAGE_ID => $id));
			$this->m_question_page->delete($id);
		$this->db->trans_complete() ;

		if($this->db->trans_status() === FALSE){
			$data['heading'] = "Transaction Error" ;
			$data['message'] = __l('my_error_transaction') ;
		}else {
			redirect($_SERVER['HTTP_REFERER']) ;
		}


	}
}