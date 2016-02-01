<?php

/**
*	get key and return the word from lang files
*	@param String $word_key 	
*	@return String 
*
*/
function __l($word_key){

	//get instance from codeigniter 
	$CI = &get_instance() ;

	//load all custom lang files 
	$CI->lang->load('my_form') ;
	$CI->lang->load('my_error') ;
	$CI->lang->load('my_navbar') ;
	$CI->lang->load('my_page') ;


	//return word
	return $CI->lang->line($word_key) ;
	
}