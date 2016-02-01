<?php

function checkPermision($capability){
	$CI =& get_instance();
	if( ! $CI->m_user->permission($capability)) {
		$data['heading'] = "Access Limit" ;
		$data['message'] = __l('my_error_dont_permission_to_see_page') ;
		$CI->load->view('errors/html/error_403', $data);
		return FALSE ;
	}

	return TRUE ;
}

/**
 * get a date_time in english and return jalali format
 * @param  String $date_time // its format is like this 2015-09-18 18:27:37
 * @return String            // its format is like this 
 */
function myJalaliFormat($date_time){
	$time = strtotime($date_time);
	$new_date = jdate('H:i:s Y/m/d' ,$time);
	return $new_date ;
}

/**
 * insert str before paragraph // after <p> tag
 * @param  string $paragraph
 * @param  string $str      
 * @return string           
 */
function addInParagraph($str , $paragraph){
	$paragraph = trim($paragraph) ;
	if(substr($paragraph , 0 , 2) == '<p'){
		return preg_replace('/^(<p[^>]*>)(.*)/is' , '$1 '. $str .' $2' , $paragraph);
	}
	else return $str . $paragraph ;
}