<?php 
class m_chart_content extends MY_Model{
	//cells name 
	const COLUMN_ID = 'chartcon_id' ;
	const COLUMN_TYPE = 'chartcon_type' ;
	const COLUMN_TERM = 'chartcon_term' ;
	const COLUMN_NUMBER = 'chartcon_number_in_term' ;
	const COLUMN_LESSON_ID = 'chartcon_lsn_id' ;
	const COLUMN_CHARTPAGE_ID = 'chartcon_chartpg_id' ;
	const COLUMN_PISHNIAZ = 'chartcon_pishniaz' ;
	const COLUMN_EKHTIARI_N = 'chartcon_ekhtiari_nazari_n' ;

	const COLUMN_CREATED_TIME = 'chartcon_created' ;
	const COLUMN_MODIFIED_TIME = 'chartcon_modified' ;
	const COLUMN_CREATOR = 'chartcon_inserter' ;
	const COLUMN_MODIFIER = 'chartcon_modifier' ;

	protected $_table_name = 'chart_content';
	protected $_primary_key = 'chartcon_id';
	protected $_primary_filter = 'trim';
	protected $_prefix = 'chartcon_';
	protected $_timestamp = TRUE;
	protected $_creator_id = TRUE ;
	protected $_modifier_id = TRUE ;

	//other const
	const TYPE_EKHTIARI = '4' ;
	
	
	public function getTable($chartpg_id , $update_url = NULL , $delete_url = NULL , $select_url = NULL){
		$table = new My_Table() ;
		$CI =& get_instance();
		$CI->load->model('m_lesson') ;
		$thead = array(
		    __l('my_form_chartcon_term'),
		    __l('my_form_chartcon_number'),
		    __l('my_form_lesson_id'),
		    __l('my_form_lesson_name'),
		    __l('my_form_nazari_n'),
		    __l('my_form_amali_n'),
		    __l('my_form_chartcon_pishniaz'),
		    __l('my_form_chartcon_type'),
		);

		$tbody = array(
			self::COLUMN_TERM ,
			self::COLUMN_NUMBER ,
			m_lesson::COLUMN_ID ,
			m_lesson::COLUMN_NAME ,
			m_lesson::COLUMN_NAZARI_N ,
			m_lesson::COLUMN_AMALI_N ,
			self::COLUMN_PISHNIAZ ,
			self::COLUMN_TYPE ,
		);

		$this->db->join('lesson' , m_lesson::COLUMN_ID . ' = ' . self::COLUMN_LESSON_ID) ;
		$this->db->where(self::COLUMN_CHARTPAGE_ID , $chartpg_id) ;
		$data = $this->get() ;
		foreach ($data as $key => $value) {
			$data[$key]->{self::COLUMN_TYPE} = $this->getTypeName($data[$key]->{self::COLUMN_TYPE}) ;
			$data[$key]->{self::COLUMN_TYPE} = $this->getTermName($data[$key]->{self::COLUMN_TERM}) ;
		}

		return $table->getView($thead, $tbody, $this->_primary_key, $data , $update_url, $delete_url , $select_url );
	}
	
	
	public function getTermList(){
		return array(
			__l('my_form_chartcon_term_1') => '1',
			__l('my_form_chartcon_term_2') => '2',
			__l('my_form_chartcon_term_3') => '3',
			__l('my_form_chartcon_term_4') => '4',
			__l('my_form_chartcon_term_5') => '5',
			__l('my_form_chartcon_term_6') => '6',
			__l('my_form_chartcon_term_7') => '7',
			__l('my_form_chartcon_term_8') => '8',
			__l('my_form_chartcon_term_9') => '9',
			__l('my_form_chartcon_term_10') => '10',
			__l('my_form_chartcon_term_ekhtiari') => '0',
		);
	}

	public function getTermName($index){
		$term_list = $this->getTermList() ;
		return array_search($index , $term_list) ;
	}

	public function getTypeList(){
		return array(
			__l('my_form_chartcon_type_asli') => '0',
			__l('my_form_chartcon_type_omoomi') => '1',
			__l('my_form_chartcon_type_takhasosi') => '2',
			__l('my_form_chartcon_type_paye') => '3',
			__l('my_form_chartcon_type_ekhtiari') => '4',
		);
	}

	public function getTypeName($index){
		$type_list = $this->getTypeList() ;
		return array_search($index , $type_list) ;
	}

}