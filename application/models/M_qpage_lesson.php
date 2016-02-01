<?php
/**
 * @author ReZaBiDaR
 * id -> int(14) auto increment
 * qpage_id -> int(15) reference to question_page(_id)
 * lesson_id -> int(15) reference to lesson(_id)
 */
class m_qpage_lesson extends MY_Model{
	//columns name
	const COLUMN_ID = 'qpglsn_id' ;
	const COLUMN_QPAGE_ID = 'qpglsn_qpage_id' ;
	const COLUMN_LESSON_ID = 'qpglsn_lesson_id' ;

	protected $_table_name = 'qpage_lesson';
	protected $_primary_key = 'qpglsn_id';
	protected $_primary_filter = 'trim';
	protected $_prefix = 'qpglsn_';
	protected $_timestamp = TRUE;
	protected $_creator_id = TRUE ;
	protected $_modifier_id = TRUE ;
	

	/**
	 * it take qpage_id and an array of lesson id and save it
	 * @param  Integer $qpaeg_id   
	 * @param  Integer $lsn_id_arr 
	 */
	public function safeSave($qpage_id , $lsn_id_arr){

		//get all of lsn where qpage_id
		$this->db->where(array(self::COLUMN_QPAGE_ID => $qpage_id)) ;
		$result = $this->get() ;
		$delete_lsn_arr = array() ;
		$result_arr = array() ;
		//minus lsn_id_arr from result and delete
		foreach ($result as $key => $obj) {
			$lsn_id = $obj->{self::COLUMN_LESSON_ID} ;
			array_push($result_arr , $lsn_id) ;
			if(! in_array($lsn_id , $lsn_id_arr)) array_push($delete_lsn_arr , $lsn_id) ;	
		}

		//delete delete_lsn_arr from db
		foreach ($delete_lsn_arr as $lsn_id) {
			$this->delete(array( self::COLUMN_LESSON_ID => $lsn_id )) ;
		}
		

		//minus result from lsn_id_arr and save
		$save_lsn_arr = array() ;
		foreach ($lsn_id_arr as $key => $lsn_id) {
			if(! in_array($lsn_id , $result_arr)) array_push($save_lsn_arr , $lsn_id) ;
		}

		//save all unsaved into database
		foreach ($save_lsn_arr as $lsn_id) {
			$data = array(self::COLUMN_QPAGE_ID => $qpage_id , self::COLUMN_LESSON_ID => $lsn_id);
			$this->save($data) ;
		}
	}
	

	public function getLessons($qpage_id){
		$CI =& get_instance();
		$CI->load->model('m_lesson') ;

		$this->db->join('lesson' , m_lesson::COLUMN_ID . ' = ' . self::COLUMN_LESSON_ID) ;
		$this->db->where(self::COLUMN_QPAGE_ID , $qpage_id) ;
		$lessons  = $this->get() ;
		$lessons_arr = array() ;
		foreach ($lessons as $key => $lsn_obj) {
			$lessons_arr[$lsn_obj->{m_lesson::COLUMN_ID}] = $lsn_obj->{m_lesson::COLUMN_NAME} ;
		}
		return $lessons_arr ;
	}


	/**
	 * it used for qpage table that show all leasson that add to this qpage_id
	 * @param  Integer $qpage_id 
	 * @return String           all lesson_id in string format and ( - ) delimited
	 */
	public function getLessonsStr($qpage_id){
		$text = '';
		$this->db->where(self::COLUMN_QPAGE_ID , $qpage_id) ;
		$lessons  = $this->get() ;
		foreach ($lessons as $key => $obj) {
			$text .= $obj->{self::COLUMN_LESSON_ID} . ' ' ;
		}
		return str_replace(' ', ' - ', trim($text)) ;
	}

	/**
	 * use for Web Services
	 * @param  [type] $lesson_id [description]
	 * @return [type]            [description]
	 */
	public function getQpageList($lesson_id){
		$CI =& get_instance();
		$CI->load->model('m_question_page') ;
		$CI->load->model('m_term_date') ;

		$this->db->join('question_page' , m_question_page::COLUMN_ID . ' = ' . self::COLUMN_QPAGE_ID) ;
		$this->db->join('term_date' , m_term_date::COLUMN_ID . ' = ' . m_question_page::COLUMN_TERMDATE_ID) ;
		$this->db->where(self::COLUMN_LESSON_ID , $lesson_id) ;

		return $this->get() ;
	}


}
