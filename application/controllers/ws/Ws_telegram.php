<?php 

class ws_telegram extends CI_Controller{


	public function qpage_list($lesson_id)
	{
		$this->load->model('m_question_page');
		$this->load->model('m_qpage_lesson');
		$this->load->model('m_term_date');

		$qpage_list = $this->m_qpage_lesson->getQpageList($lesson_id) ;
		$qpage_arr = array() ;
		foreach ($qpage_list as $key => $qpage_obj) {
			$qpage_arr[$qpage_obj->{m_question_page::COLUMN_ID}] = array(
					'term_name' => $qpage_obj->{m_term_date::COLUMN_NAME} ,
				);
		}
		echo json_encode($qpage_arr , JSON_UNESCAPED_UNICODE  ) ;
	}

	public function question($lesson_id,$question_number,$term_name)
	{
		$this->load->model('m_question_page');
		$this->load->model('m_qpage_lesson');
		$this->load->model('m_term_date');
		$this->load->model('m_question');

		$this->db->join('term_date', m_term_date::COLUMN_ID . ' = ' . m_question_page::COLUMN_TERMDATE_ID);
		$this->db->join('qpage_lesson', m_qpage_lesson::COLUMN_QPAGE_ID . ' = ' . m_question_page::COLUMN_ID);
		$this->db->join('question', m_question::COLUMN_QPAGE_ID . ' = ' . m_question_page::COLUMN_ID);

		$this->db->where(m_term_date::COLUMN_NAME , urldecode($term_name));
		$this->db->where(m_qpage_lesson::COLUMN_LESSON_ID , $lesson_id);
		$this->db->where(m_question::COLUMN_NUMBER,$question_number);

		$question = $this->m_question_page->get(NULL,TRUE);
		if($question == null) die(null) ;
		$output['question'] = $question->{m_question::COLUMN_TEXT} ;
		$output['a'] = $question->{m_question::COLUMN_A} ;
		$output['b'] = $question->{m_question::COLUMN_B} ;
		$output['c'] = $question->{m_question::COLUMN_C} ;
		$output['d'] = $question->{m_question::COLUMN_D} ;

		echo json_encode($output , JSON_UNESCAPED_UNICODE  ) ;
	}


}