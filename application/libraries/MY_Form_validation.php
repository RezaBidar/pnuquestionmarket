<?php 

class MY_Form_validation extends CI_Form_validation
{
	public function __construct()
	{
		parent::__construct();
	}

	public function tr_num($str){
		$num_a=array('0','1','2','3','4','5','6','7','8','9','.');
		$key_a=array('٠','١','٢','٣','۴','۵','۶','٧','٨','٩','٫');
		return str_replace($key_a , $num_a , $str) ;
	}

	/**
	 * Is Available
	 *
	 * Check if the input value already exist
	 * in the specified database field.
	 *
	 * @param	string	$str
	 * @param	string	$field
	 * @return	bool
	 */
	public function is_available($str, $field)
	{
		if(strlen($str) == 0) return TRUE ;
		
		sscanf($field, '%[^.].%[^.]', $table, $field);
		if( isset($this->CI->db) && ($this->CI->db->limit(1)->get_where($table, array($field => $str))->num_rows() > 0) )
			return TRUE ;
		$this->set_message('is_available', __l('form_validation_is_available'));
		return FALSE ;
	}

	/**
	 * check str is in int range or not
	 * @param  String  $str 
	 * @return boolean      
	 */
	public function is_unsigned_int($str){
		//range 1  to  4294967295
		$max = '4294967295' ;
		if(is_numeric($str) && intval($str[0]) > 0 ){
			if(strlen($str) < 10 && intval($str) >= 0){
				return TRUE ;
			}else if(strlen($str) == 10){
				for ($i=0; $i < 10 ; $i++) { 
					if(intval($str[$i]) > intval($max[$i]) ) goto L;
					else if(intval($str[$i]) < intval($max[$i]) ) return TRUE;
				}
				return TRUE ;
			}
		}

		L:
		$this->set_message('is_unsigned_int', __l('form_validation_is_unsigned_int'));
		return FALSE ;	

	}

	/**
	 * Is Unique except id
	 *
	 * Check if the input value doesn't already exist
	 * in the specified database field.
	 *
	 * @param	string	$str
	 * @param	string	$field
	 * @return	bool
	 */
	public function is_unique_except_id($str, $field)
	{
		sscanf($field, '%[^.].%[^.].%[^.].%[^.]', $table, $field , $id_field , $id);
		log_message('error',$table . ' - ' . $field . ' - ' . $id_field . ' - ' . $id);
		if(isset($this->CI->db)){
			$obj = $this->CI->db->limit(1)->get_where($table, array($field => $str))->row() ;
			if($obj == NULL || $obj->{$id_field} == $id) return TRUE ;
		}
		$this->set_message('is_unique_except_id', __l('form_validation_is_unique_except_id'));
		return FALSE ;	

	}

  
} 