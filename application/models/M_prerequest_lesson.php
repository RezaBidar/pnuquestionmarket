<?php 
class m_prerequest_lesson extends MY_Model{
	//cells name 
	const COLUMN_ID = 'chartpg_id' ;
	const COLUMN_TERMDATE_ID = 'chartpg_term_date_id' ;
	const COLUMN_MAJOR_ID = 'chartpg_major_id' ;

	protected $_table_name = 'chart_page';
	protected $_pre_table_name;
	protected $_primary_key = 'chartpg_id';
	protected $_primary_filter = 'trim';
	protected $_prefix = 'chartpg_';
	protected $_timestamp = TRUE;
	protected $_creator_id = TRUE ;
	protected $_modifier_id = TRUE ;

	
	
	public function getTable($update_url = NULL , $delete_url = NULL , $select_url = NULL){
		// $table = new My_Table() ;

		// $thead = array(
		//     __l('my_form_major_id'),
		//     __l('my_form_major_name'),
		//     __l('my_form_major_group'),
		// );

		// $tbody = array(
		// 	self::COLUMN_ID ,
		// 	self::COLUMN_NAME ,
		// 	self::COLUMN_GROUP ,
		// 	self::COLUMN_DANESHKADE ,
		// 	self::COLUMN_MAGHTA ,
		// );

		// $data = $this->get() ;
		// foreach ($data as $key => $value) {
		// 	$data[$key]->{self::COLUMN_MAGHTA} = $this->getMaghtaTypeName($data[$key]->{self::COLUMN_MAGHTA}) ;
		// }

		// return $table->getView($thead, $tbody, $this->_primary_key, $data , $update_url, $delete_url , $select_url );
	}
	
	
	

}