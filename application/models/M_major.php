<?php
/**
 * id -> int(14) auto increment
 * name -> varchar(100)
 * group -> varchar(100)
 * daneshkade -> varchar(100)
 * maghta -> int // 1-> karshenasi 2->arshad 3->doctora
 */
class m_major extends MY_Model{
	//column names
	const COLUMN_ID = 'mjr_id' ;
	const COLUMN_NAME = 'mjr_name' ;
	const COLUMN_GROUP = 'mjr_group' ;
	const COLUMN_DANESHKADE = 'mjr_daneshkade' ;
	const COLUMN_MAGHTA = 'mjr_maghta' ;
	const COLUMN_FIRST_IN = 'mjr_first_in' ;
	const COLUMN_LAST_IN = 'mjr_last_in' ;

	const COLUMN_CREATED_TIME = 'mjr_created' ;
	const COLUMN_MODIFIED_TIME = 'mjr_modified' ;
	const COLUMN_CREATOR = 'mjr_inserter' ;
	const COLUMN_MODIFIER = 'mjr_modifier' ;


	protected $_table_name = 'major';
	protected $_primary_key = 'mjr_id';
	protected $_primary_filter = 'trim';
	protected $_prefix = 'mjr_';
	protected $_ai = FALSE ;
	protected $_timestamp = TRUE;
	protected $_creator_id = TRUE ;
	protected $_modifier_id = TRUE ;
	
	
	public function getTable($update_url = NULL , $delete_url = NULL , $select_url = NULL){
		$table = new My_Table() ;

		$thead = array(
		    __l('my_form_major_id'),
		    __l('my_form_major_name'),
		    __l('my_form_major_group'),
		    __l('my_form_major_daneshkade'),
		    __l('my_form_major_maghta')
		);

		$tbody = array(
			self::COLUMN_ID ,
			self::COLUMN_NAME ,
			self::COLUMN_GROUP ,
			self::COLUMN_DANESHKADE ,
			self::COLUMN_MAGHTA ,
		);

		$data = $this->get() ;
		foreach ($data as $key => $value) {
			$data[$key]->{self::COLUMN_NAME} = $this->getMajorName($value->{self::COLUMN_NAME} , $value->{self::COLUMN_FIRST_IN} , $value->{self::COLUMN_LAST_IN}) ;
			$data[$key]->{self::COLUMN_MAGHTA} = $this->getMaghtaTypeName($value->{self::COLUMN_MAGHTA}) ;
		}

		return $table->getView($thead, $tbody, $this->_primary_key, $data , $update_url, $delete_url , $select_url );
	}
	
	

	public function getMaghtaTypes(){
		return array(
			__l('my_form_maghta_karshenasi') => 1,
			__l('my_form_maghta_arshad') => 2,
			__l('my_form_maghta_doctora') => 3 ,
		);
	}

	public function getMaghtaTypeName($index){
		$maghta_types = $this->getMaghtaTypes() ;
		return array_search($index , $maghta_types) ;
	}

	public function getMajorName($name , $first_in = NULL , $last_in = NULL){
		$str = '' ;
		if($first_in != NULL && $last_in != NULL){
			$str = "(مخصوص ورودیهای{$first_in} الی{$last_in})" ;
		}else if($last_in != NULL){
			$str = "(مخصوص ورودیهای {$last_in} و قبل)" ;
		}else if($first_in != NULL){
			$str = "(مخصوص ورودیهای {$first_in} و بعد)" ;
		}
		return $name . $str ;

	}
	
	
}
