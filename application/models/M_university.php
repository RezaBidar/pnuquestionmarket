<?php
/**
 * id -> int(15) auto increment
 * state -> varchar(100)
 * city -> varchar(100)
 */
class m_university extends MY_Model {

	//column names
	const COLUMN_ID = 'uni_id' ;
	const COLUMN_STATE = 'uni_state' ;
	const COLUMN_CITY = 'uni_city' ;

	const COLUMN_CREATED_TIME = 'uni_created' ;
	const COLUMN_MODIFIED_TIME = 'uni_modified' ;
	const COLUMN_CREATOR = 'uni_inserter' ;
	const COLUMN_MODIFIER = 'uni_modifier' ;

	protected $_table_name = 'university';
	protected $_primary_key = 'uni_id';
	protected $_prefix = 'uni_';
	protected $_timestamp = TRUE;
	
	protected $_creator_id = TRUE ;
	protected $_modifier_id = TRUE ;
	
	
	/**
	 * get table
	 */
	public function getTable($update_url = NULL , $delete_url = NULL , $select_url = NULL){
		$table = new My_Table() ;

		$thead = array(
		    __l('my_form_state'),
		    __l('my_form_city'),
		);
		$tbody = array(
			self::COLUMN_STATE ,
			self::COLUMN_CITY
		);

		$data = $this->get() ;
		
		return $table->getView($thead, $tbody, $this->_primary_key, $data , $update_url, $delete_url , $select_url );
	}
	
	
	
}