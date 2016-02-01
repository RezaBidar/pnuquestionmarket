<?php
/**
 * @author ReZaBiDaR
 * id -> int(14) auto increment
 * major_id -> int(15) reference to major(_id)
 * term_date_id -> int(15) reference to term_date(_id)
 */
class m_chart_page extends MY_Model{
	
	//cells name 
	const COLUMN_ID = 'chartpg_id' ;
	const COLUMN_TERMDATE_ID = 'chartpg_term_date_id' ;
	const COLUMN_MAJOR_ID = 'chartpg_major_id' ;

	const COLUMN_CREATED_TIME = 'chartpg_created' ;
	const COLUMN_MODIFIED_TIME = 'chartpg_modified' ;
	const COLUMN_CREATOR = 'chartpg_inserter' ;
	const COLUMN_MODIFIER = 'chartpg_modifier' ;

	protected $_table_name = 'chart_page';
	protected $_pre_table_name;
	protected $_primary_key = 'chartpg_id';
	protected $_primary_filter = 'trim';
	protected $_prefix = 'chartpg_';
	protected $_timestamp = TRUE;
	protected $_creator_id = TRUE ;
	protected $_modifier_id = TRUE ;

	
	
	public function getTable($major_id = '' , $update_url = NULL , $delete_url = NULL , $select_url = NULL){
		$table = new My_Table() ;
		$CI =& get_instance();
		$CI->load->model('m_term_date') ;

		$thead = array(
		    __l('my_form_term_id'),
		    __l('my_form_term_name'),
		);

		$tbody = array(
			m_term_date::COLUMN_ID ,
			m_term_date::COLUMN_NAME ,
		);

		$this->db->join('term_date' , m_term_date::COLUMN_ID . ' = ' . self::COLUMN_TERMDATE_ID) ;
		if($major_id != '')
			$this->db->where(self::COLUMN_MAJOR_ID , $major_id) ;
		$data = $this->get() ;

		return $table->getView($thead, $tbody, $this->_primary_key, $data , $update_url, $delete_url , $select_url );
	}
	
	
	

}
