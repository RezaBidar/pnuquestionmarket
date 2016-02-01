<?php
/**
 * @author ReZaBiDaR
 * id -> int(15) auto increment
 * name -> varchar(100)
 * sal -> int(5)
 * numsal -> int(4)
 */
class m_term_date extends MY_Model{

	//column names
	const COLUMN_ID = 'trm_id' ;
	const COLUMN_NAME = 'trm_name' ;
	const COLUMN_SAL = 'trm_sal' ;
	const COLUMN_NIMSAL = 'trm_nimsal' ;

	const COLUMN_CREATED_TIME = 'trm_created' ;
	const COLUMN_MODIFIED_TIME = 'trm_modified' ;
	const COLUMN_CREATOR = 'trm_inserter' ;
	const COLUMN_MODIFIER = 'trm_modifier' ;

	protected $_table_name = 'term_date';
	protected $_primary_key = 'trm_id';
	protected $_primary_filter = 'trim';
	protected $_prefix = 'trm_';
	protected $_ai = FALSE ;
	protected $_timestamp = TRUE;
	
	
	protected $_creator_id = TRUE ;
	protected $_modifier_id = TRUE ;
	
	
	public function getTable($update_url = NULL , $delete_url = NULL , $select_url = NULL){
		$table = new My_Table() ;

		$thead = array(
			__l('my_form_term_id') ,
			__l('my_form_term_name'),
			__l('my_form_sal'),
			__l('my_form_nimsal'),
		);
		$tbody = array(
			self::COLUMN_ID ,
			self::COLUMN_NAME ,
			self::COLUMN_SAL ,
			self::COLUMN_NIMSAL
		);

		$data = $this->get() ;

		foreach ($data as $key => $value) {
			$data[$key]->{self::COLUMN_NIMSAL} = $this->nimsalName($data[$key]->{self::COLUMN_NIMSAL}) ;
		}
		return $table->getView($thead, $tbody, $this->_primary_key, $data , $update_url, $delete_url , $select_url );
	}
	
	/**
	 * get term list function return an array of term_names for select inputs
	 * @return array
	 */
	public function getTermList(){
		$result = $this->get();
		$array = array();
		foreach ($result as $row => $object){
			$array[$object->{self::COLUMN_ID}] = $object->{self::COLUMN_NAME} ;//ex : $array[3] = 932123
		}
		return $array ;
	}

	/**
	 * convert nimsal code to nimsal name for example get 3 and return tabestan
	 * @param  Integer $nimsal {1 , 2 , 3}
	 * @return String        nimsal name
	 */
	public function nimsalName($nimsal){
		$arr = array(
					__l('my_form_nimsal_aval') ,
					__l('my_form_nimsal_dovom') ,
					__l('my_form_nimsal_tabestan') ,
				) ;
		return $arr[$nimsal - 1] ;
	}

	public function getNimsalList(){
		return array(
				__l('my_form_nimsal_aval') => "1" ,
				__l('my_form_nimsal_dovom') => "2" ,
				__l('my_form_nimsal_tabestan') => "3" ,
		);
	}

	public function getTermName($term_id){
		$term = $this->get($term_id , TRUE) ;
		if($term != NULL) return $term->{self::COLUMN_NAME} ;
		return NULL ;
	}
	
	/**
	 * @override
	 */
	public function get($id=NULL,$single=NULL,$custom_method = NULL){
		$this->db->order_by(self::COLUMN_ID , 'DESC') ;
		return	parent::get($id,$single,$custom_method) ;
	}

	
}