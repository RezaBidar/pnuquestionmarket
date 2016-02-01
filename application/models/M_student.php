<?php
/**
 * id -> int(14) auto increment
 * name -> varchar(100)
 * family -> varchar(100)
 * android_ver -> var(4)
 * api_code -> varchar(255)
 * ip -> varchar(255)
 * major_id -> int(15) reference to major(_id)
 * uni_id -> int(15) reference to university(_id)
 */
class m_student extends MY_Model{
	//CELLs name
	const COLUMN_ID = 'st_id' ;
	const COLUMN_NAME = 'st_name' ;
	const COLUMN_ANDROID_VER = 'st_android_ver' ;
	const COLUMN_API_CODE = 'st_api_code' ;
	const COLUMN_IP = 'st_ip' ;
	const COLUMN_MAJOR_ID = 'st_major_id' ;
	const COLUMN_UNI_ID = 'st_uni_id' ;

	protected $_table_name = 'student';
	protected $_primary_filter = 'trim';
	protected $_primary_key = 'st_id';
	protected $_prefix = 'st';
	protected $_timestamp = TRUE;

	public function makeApiCode(){
		$length = 5 ;
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}


}
