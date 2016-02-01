<?php
/**
 * @author ReZaBiDaR
 * id -> int(15) auto increment
 * name -> varchar(100)
 * seri -> int(4)
 * test_n -> int(4)
 * tashrihi_n -> int(4)
 * test_time -> int(4)
 * tashrihi_time -> int(4)
 * term_date_id -> int(4)
 */
class m_question_page extends MY_Model{
	//columns name
	const COLUMN_ID = 'qpg_id' ;
	const COLUMN_NAME = 'qpg_name' ;
	const COLUMN_MAJORS = 'qpg_majors' ;
	const COLUMN_SERI = 'qpg_seri' ;
	const COLUMN_TEST_N = 'qpg_test_n' ;
	const COLUMN_TASHRIHI_N = 'qpg_tashrihi_n' ;
	const COLUMN_TEST_TIME = 'qpg_test_time' ;
	const COLUMN_TASHRIHI_TIME = 'qpg_tashrihi_time' ;
	const COLUMN_TERMDATE_ID = 'qpg_term_date_id' ;

	const COLUMN_CREATED_TIME = 'qpg_created' ;
	const COLUMN_MODIFIED_TIME = 'qpg_modified' ;
	const COLUMN_CREATOR = 'qpg_inserter' ;
	const COLUMN_MODIFIER = 'qpg_modifier' ;

	protected $_table_name = 'question_page';
	protected $_primary_filter = 'trim';
	protected $_prefix = 'qpg_';	
	protected $_primary_key = 'qpg_id';
	protected $_timestamp = TRUE;
	protected $_creator_id = TRUE ;
	protected $_modifier_id = TRUE ;
	
	
	public function getTable($update_url = NULL , $delete_url = NULL , $select_url = NULL){
		$CI =& get_instance();
		$CI->load->model('m_term_date') ;
		$CI->load->model('m_qpage_lesson') ;

		$table = new My_Table() ;

		$thead = array(
		    __l('my_form_qpage_name'),
		    __l('my_form_term_name'),
		    __l('my_form_qpage_seri'),
		    __l('my_form_qpage_lessons'),

		);
		$tbody = array(
			self::COLUMN_NAME ,
			m_term_date::COLUMN_NAME ,
			self::COLUMN_SERI ,
			self::COLUMN_TEST_TIME , //barye zakhireye liste darsa az in estefade kardam :D 
		);

		$this->db->join('term_date' , self::COLUMN_TERMDATE_ID . ' = ' . m_term_date::COLUMN_ID) ;
		$data = $this->get() ;
		foreach ($data as $key => $value) {
			$data[$key]->{self::COLUMN_TEST_TIME} = $this->m_qpage_lesson->getLessonsStr($data[$key]->{self::COLUMN_ID}) ;
		}

		return $table->getView($thead, $tbody, $this->_primary_key, $data , $update_url, $delete_url , $select_url );
	}


	public function getSeriList(){
		return array(
			__l('my_form_qpage_seri_a') => 1,
			__l('my_form_qpage_seri_b') => 2,
			__l('my_form_qpage_seri_c') => 3,
			__l('my_form_qpage_seri_d') => 4,
		);
	}

	public function getSeriName($index){
		$seri_list = $this->getSeriList() ;
		return array_search($index , $seri_list) ;
	}

	public function getInfo($qpage_id){
		$CI =& get_instance();
		$CI->load->model('m_term_date') ;
		$CI->load->model('m_qpage_lesson') ;

		$this->db->join('term_date' , m_term_date::COLUMN_ID . ' = ' . self::COLUMN_TERMDATE_ID) ;
		return $this->get($qpage_id , TRUE) ;
	}

	public function getWritersTable(){
		$CI =& get_instance();
		$CI->load->model('m_user');

		$this->db->join('user' , m_user::COLUMN_ID .' = '. self::COLUMN_CREATOR);
		$this->db->join('question' , self::COLUMN_ID .' = '. m_question::COLUMN_QPAGE_ID);

		$this->db->select(array(
				m_user::COLUMN_ID ,
				m_user::COLUMN_FIRST_NAME ,
				m_user::COLUMN_LAST_NAME ,
				'COUNT(DISTINCT('. self::COLUMN_ID .')) as count_qpage' ,
				'COUNT(DISTINCT('. m_question::COLUMN_ID .')) as count_question' ,
			)
		);
		$this->db->group_by(m_user::COLUMN_ID);
		$this->db->order_by('count_qpage DESC' , 'count_question DESC');
		$users = $this->get();

		foreach ($users as $user) {
			$user->{m_user::COLUMN_FIRST_NAME} = $user->{m_user::COLUMN_FIRST_NAME} . ' ' . $user->{m_user::COLUMN_LAST_NAME} ;
		}

		$thead = array(
			'نام' ,
			'تعداد برگه سوال' ,
			'تعداد سوال' ,
			);
		$tbody = array(
				m_user::COLUMN_FIRST_NAME ,
				'count_qpage' ,
				'count_question' ,
			);
		$table = new My_Table();
		return $table->getView($thead , $tbody , self::COLUMN_ID , $users) ;


	}

	
}
