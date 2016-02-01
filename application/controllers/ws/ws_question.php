<?php 

class ws_question extends CI_Controller{

	//this is temp funciton and must delete early
	public function all_qpage(){
		$this->load->model('m_question_page');
		$this->load->model('m_term_date');

		$this->db->join('term_date' , m_term_date::COLUMN_ID . ' = ' . m_question_page::COLUMN_TERMDATE_ID) ;
		$qpage_list = $this->m_question_page->get() ;
		$qpage_arr = array() ;
		foreach ($qpage_list as $key => $qpage_obj) {
			$new_qpage = array(
					'qpage_id' => $qpage_obj->{m_question_page::COLUMN_ID} ,
					'term_name' => $qpage_obj->{m_term_date::COLUMN_NAME} ,
					'term_id' => $qpage_obj->{m_term_date::COLUMN_ID} ,
					'name' => $qpage_obj->{m_question_page::COLUMN_NAME} ,
					'seri' => $qpage_obj->{m_question_page::COLUMN_SERI} ,
					'test_n' => $qpage_obj->{m_question_page::COLUMN_TEST_N} ,
					'tashrihi_n' => $qpage_obj->{m_question_page::COLUMN_TASHRIHI_N} ,
					'test_time' => $qpage_obj->{m_question_page::COLUMN_TEST_TIME} ,
					'tashrihi_time' => $qpage_obj->{m_question_page::COLUMN_TASHRIHI_TIME} ,
				);
			array_push($qpage_arr , $new_qpage);
		}
		echo json_encode($qpage_arr , JSON_UNESCAPED_UNICODE  ) ;

	}

	/** echo list of question page
	* @todo all key must be contraction
	*  */
	public function question_page_list($lesson_id){
		$this->load->model('m_question_page');
		$this->load->model('m_qpage_lesson');
		$this->load->model('m_term_date');

		$qpage_list = $this->m_qpage_lesson->getQpageList($lesson_id) ;
		$qpage_arr = array() ;
		foreach ($qpage_list as $key => $qpage_obj) {
			$qpage_arr[$qpage_obj->{m_question_page::COLUMN_ID}] = array(
					'term_name' => $qpage_obj->{m_term_date::COLUMN_NAME} ,
					'term_id' => $qpage_obj->{m_term_date::COLUMN_NAME} ,
					'name' => $qpage_obj->{m_question_page::COLUMN_NAME} ,
					'seri' => $qpage_obj->{m_question_page::COLUMN_SERI} ,
					'test_n' => $qpage_obj->{m_question_page::COLUMN_TEST_N} ,
					'tashrihi_n' => $qpage_obj->{m_question_page::COLUMN_TASHRIHI_N} ,
					'test_time' => $qpage_obj->{m_question_page::COLUMN_TEST_TIME} ,
					'tashrihi_time' => $qpage_obj->{m_question_page::COLUMN_TASHRIHI_TIME} ,
				);
		}
		echo json_encode($qpage_arr , JSON_UNESCAPED_UNICODE  ) ;

	}

	public function question_list($qpage_id){
		$this->load->model('m_question') ;
		$questions = $this->m_question->getQuestions($qpage_id) ;
		$questions_arr = array() ;
		foreach ($questions as $key => $questions_obj) {
			$temp = array(
					'number' => $questions_obj->{m_question::COLUMN_NUMBER},
					'text' => $questions_obj->{m_question::COLUMN_TEXT} ,	
					'type' => $questions_obj->{m_question::COLUMN_TYPE} ,
					'type' => $questions_obj->{m_question::COLUMN_TYPE} ,
					'answer_text' => $questions_obj->{m_question::COLUMN_ANSWER_TEXT} ,	
					'answer' => $questions_obj->{m_question::COLUMN_ANSWER} ,	
					'a' => $questions_obj->{m_question::COLUMN_A} ,	
					'b' => $questions_obj->{m_question::COLUMN_B} ,	
					'c' => $questions_obj->{m_question::COLUMN_C} ,	
					'd' => $questions_obj->{m_question::COLUMN_D} ,
				) ;
			array_push($questions_arr , $temp) ;
		}
		echo json_encode($questions_arr , JSON_UNESCAPED_UNICODE  ) ;
	}

	public function test()
	{
		$this->load->model('m_question');
		$question = $this->m_question->get(NULL , TRUE) ;
		$data['text'] = $question->qst_text ;
		$data['number'] = $question->qst_number_in_page ;
		$data['a']  = $question->qst_a ;
		$data['b']  = $question->qst_b ;
		$data['c']  = $question->qst_c ;
		$data['d']  = $question->qst_d ;

		$this->load->view('test', $data);
	}
}