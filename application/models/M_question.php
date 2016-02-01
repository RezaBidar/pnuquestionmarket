<?php
/**
 * @author ReZaBiDaR
 * id -> int(14) auto increment
 * text -> text
 * number_in_page -> int(4) default 0
 * a -> text 
 * b -> text
 * c -> text
 * d -> text
 * answer -> int(4) default 0 // 0=>noAnswer , 1=>a , 2=>b , 3=>c , 4=>d
 * type -> int(4) default 1 // 1=>testi , 2=>tashrihi
 * qpage_id -> int(15) reference to question_page(_id)
 */
class m_question extends MY_Model{
	//cells name 
	const COLUMN_ID = 'qst_id' ;	
	const COLUMN_TEXT = 'qst_text' ;	
	const COLUMN_NUMBER = 'qst_number_in_page' ;	
	const COLUMN_A = 'qst_a' ;	
	const COLUMN_B = 'qst_b' ;
	const COLUMN_C = 'qst_c' ;
	const COLUMN_D = 'qst_d' ;
	const COLUMN_ANSWER = 'qst_answer' ;
	const COLUMN_ANSWER_TEXT = 'qst_answer_text' ;
	const COLUMN_TYPE = 'qst_type' ;
	const COLUMN_QPAGE_ID = 'qst_qpage_id' ;

	const COLUMN_CREATED_TIME = 'qst_created' ;
	const COLUMN_MODIFIED_TIME = 'qst_modified' ;
	const COLUMN_CREATOR = 'qst_inserter' ;
	const COLUMN_MODIFIER = 'qst_modifier' ;

	protected $_table_name = 'question';
	protected $_primary_key = 'qst_id';
	protected $_primary_filter = 'trim';
	protected $_prefix = 'qst_';
	protected $_timestamp = TRUE;
	protected $_creator_id = TRUE ;
	protected $_modifier_id = TRUE ;

	const TYPE_TESTI = '1' ;
	const TYPE_TASHRIHI = '2' ;

	public function getTable($qpage_id , $update_url = NULL , $delete_url = NULL , $select_url = NULL){
		$table = new My_Table() ;

		$thead = array(
		    __l('my_form_question_number'),
		    __l('my_form_question_text') ,
		    __l('my_form_question_type') ,
		);
		$tbody = array(
			self::COLUMN_NUMBER ,
			self::COLUMN_TEXT ,
			self::COLUMN_TYPE ,
		);

		$this->db->order_by(self::COLUMN_NUMBER) ;
		$this->db->where(self::COLUMN_QPAGE_ID , $qpage_id) ;
		$data = $this->get() ;
		foreach ($data as $key => $value) {
			$value->{self::COLUMN_TYPE} = $this->getTypeName($value->{self::COLUMN_TYPE}) ;
			$value->{self::COLUMN_TEXT} = shortcode2img($value->{self::COLUMN_TEXT}) ;
		}

		return $table->getView($thead, $tbody, $this->_primary_key, $data , $update_url, $delete_url , $select_url );
	}

	public function getTypeList(){
		return 	array(
					__l('my_form_question_type_testi') => "1" ,
					__l('my_form_question_type_tashrihi') => "2"
				);
	}

	public function getTypeName($index){
		$type_list = $this->getTypeList();
		return array_search($index , $type_list) ;
	}

	public function getAnswerChoiceList(){
		return	array(
					__l('my_form_question_answer_none') => "0" ,
					__l('my_form_question_answer_a') => "1" ,
					__l('my_form_question_answer_b') => "2" ,
					__l('my_form_question_answer_c') => "3" ,
					__l('my_form_question_answer_d') => "4" 
				);
	}

	public function getAnswerChoiceName($index){
		$choice_list = $this->getAnswerChoiceList() ;
		return array_search($index , $choice_list) ;
	}

	public function getQuestions($qpage_id){
		$this->db->order_by(self::COLUMN_NUMBER);
		$this->db->where(self::COLUMN_QPAGE_ID , $qpage_id) ;
		return $this->get() ;
	}

	public function maxNumber($qpage_id){
		$this->db->select_max(self::COLUMN_NUMBER);
		$this->db->where(self::COLUMN_QPAGE_ID , $qpage_id) ;
		$answer = $this->get(NULL , TRUE);
		return ($answer)?($answer->{self::COLUMN_NUMBER}):NULL ;
	}
	
}
