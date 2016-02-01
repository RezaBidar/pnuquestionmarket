<?php
/**
 * id -> int(14) auto increment
 * name -> varchar(100)
 * nazari_n -> int(4) //tedade vahede nazari
 * amali_n -> int(4)  //tedade vahede amali
 */
class m_lesson extends MY_Model{
	
	//column names
	const COLUMN_ID = 'lsn_id' ;
	const COLUMN_NAME = 'lsn_name' ;
	const COLUMN_NAZARI_N = 'lsn_nazari_n' ;
	const COLUMN_AMALI_N = 'lsn_amali_n' ;
	const COLUMN_NAZARI_H = 'lsn_nazari_h' ;
	const COLUMN_AMALI_H = 'lsn_amali_h' ;
	const COLUMN_AZMOON_TYPE = 'lsn_azmoon_type' ;

	const COLUMN_CREATED_TIME = 'lsn_created' ;
	const COLUMN_MODIFIED_TIME = 'lsn_modified' ;
	const COLUMN_CREATOR = 'lsn_inserter' ;
	const COLUMN_MODIFIER = 'lsn_modifier' ;

	protected $_table_name = 'lesson';
	protected $_primary_key = 'lsn_id';
	protected $_primary_filter = 'trim';
	protected $_prefix = 'lsn_';
	protected $_ai = FALSE ;
	protected $_timestamp = TRUE;
	protected $_creator_id = TRUE ;
	protected $_modifier_id = TRUE ;
	
	
	public function getTable($update_url = NULL , $delete_url = NULL , $select_url = NULL){
		$table = new My_Table() ;

		$thead = array(
		    __l('my_form_lesson_id'),
		    __l('my_form_lesson_name'),
		    // __l('my_form_nazari_n'),
		    // __l('my_form_amali_n'),
		    // __l('my_form_nazari_h'),
		    // __l('my_form_amali_h'),
		    // __l('my_form_azmoon_type'),
		);
		$tbody = array(
			self::COLUMN_ID ,
			self::COLUMN_NAME ,
			// self::COLUMN_NAZARI_N ,
			// self::COLUMN_AMALI_N ,
			// self::COLUMN_NAZARI_H ,
			// self::COLUMN_AMALI_H ,
			// self::COLUMN_AZMOON_TYPE ,
		);

		$data = $this->get() ;
		// foreach ($data as $key => $value) {
		// 	$data[$key]->{self::COLUMN_AZMOON_TYPE} = $this->getAzmoonTypeName($data[$key]->{self::COLUMN_AZMOON_TYPE}) ;
		// }

		return $table->getView($thead, $tbody, $this->_primary_key, $data , $update_url, $delete_url , $select_url );
	}

	public function getAzmoonTypes(){
		return array(
			__l('my_form_azmoon_testi') => 1,
			__l('my_form_azmoon_tashrihi') => 2,
			__l('my_form_azmoon_testi_tashrihi') => 3 ,
		);
	}

	public function getAzmoonTypeName($index){
		$azmoon_types = $this->getAzmoonTypes() ;
		return array_search($index , $azmoon_types) ;
	}
	
	
}
