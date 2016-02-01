<?php


//define capabilities 
define('CAP_PUBLIC' , "public") ;

define('CAP_VIEW_USER' , "view_user") ;
define('CAP_VIEW_USER_LIST' , "view_user_list") ;
define('CAP_ADD_USER' , "add_user") ;
define('CAP_EDIT_USER' , "edit_user") ;
define('CAP_EDIT_ALL_USER' , "edit_all_user") ;

define('CAP_VIEW_QUESTION' , "view_question") ;
define('CAP_VIEW_QUESTION_LIST' , "view_question_list") ;
define('CAP_ADD_QUESTION' , "add_question") ;
define('CAP_EDIT_QUESTION' , "edit_question") ;
define('CAP_EDIT_ALL_QUESTION' , "edit_all_question") ;

define('CAP_VIEW_LESSON' , "view_lesson") ;
define('CAP_VIEW_LESSON_LIST' , "view_lesson_list") ;
define('CAP_ADD_LESSON' , "add_lesson") ;
define('CAP_EDIT_LESSON' , "edit_lesson") ;
define('CAP_EDIT_ALL_LESSON' , "edit_all_lesson") ;

define('CAP_VIEW_CHART' , "view_chart") ;
define('CAP_VIEW_CHART_LIST' , "view_chart_list") ;
define('CAP_ADD_CHART' , "add_chart") ;
define('CAP_EDIT_CHART' , "edit_chart") ;
define('CAP_EDIT_ALL_CHART' , "edit_all_chart") ;

define('CAP_VIEW_TERM' , "view_term") ;
define('CAP_VIEW_TERM_LIST' , "view_term_list") ;
define('CAP_ADD_TERM' , "add_term") ;
define('CAP_EDIT_TERM' , "edit_term") ;
define('CAP_EDIT_ALL_TERM' , "edit_all_term") ;

define('CAP_VIEW_MAJOR' , "view_major") ;
define('CAP_VIEW_MAJOR_LIST' , "view_major_list") ;
define('CAP_ADD_MAJOR' , "add_major") ;
define('CAP_EDIT_MAJOR' , "edit_major") ;
define('CAP_EDIT_ALL_MAJOR' , "edit_all_major") ;

define('CAP_VIEW_UNIVERSITY' , "view_university") ;
define('CAP_VIEW_UNIVERSITY_LIST' , "view_university_list") ;
define('CAP_ADD_UNIVERSITY' , "add_university") ;
define('CAP_EDIT_UNIVERSITY' , "edit_university") ;
define('CAP_EDIT_ALL_UNIVERSITY' , "edit_all_university") ;


$config['rules']['admin'] = array(
		'capabilities' => array(CAP_PUBLIC ) ,
		'is_admin' => true ,
	) ;

$config['rules']['manager'] = array(
		'capabilities' => array( 
				CAP_PUBLIC ,

				CAP_VIEW_QUESTION_LIST,
				CAP_VIEW_QUESTION ,
				CAP_VIEW_CHART_LIST ,
				CAP_VIEW_CHART ,
				CAP_VIEW_LESSON_LIST,
				CAP_VIEW_LESSON,
				CAP_VIEW_MAJOR_LIST ,
				CAP_VIEW_MAJOR ,
				CAP_VIEW_TERM_LIST ,
				CAP_VIEW_TERM ,
				CAP_VIEW_UNIVERSITY_LIST ,
				CAP_VIEW_UNIVERSITY ,

				CAP_ADD_QUESTION ,
				CAP_ADD_CHART ,
				CAP_ADD_LESSON ,

				CAP_EDIT_QUESTION ,
				CAP_EDIT_CHART ,
				CAP_EDIT_LESSON ,)
	) ;


$config['rules']['editor'] = array(
		'capabilities' => array(
				CAP_PUBLIC ,

				CAP_VIEW_QUESTION_LIST,
				CAP_VIEW_QUESTION ,
				CAP_VIEW_LESSON_LIST,
				CAP_VIEW_LESSON,

				CAP_ADD_QUESTION ,
				CAP_ADD_LESSON ,

				CAP_EDIT_QUESTION ,
				CAP_EDIT_ALL_QUESTION ,
				CAP_EDIT_LESSON ,
				CAP_EDIT_ALL_LESSON ,
			) 
	) ;


$config['rules']['writer'] = array(
		'capabilities' => array(
				CAP_PUBLIC ,

				CAP_VIEW_QUESTION_LIST,
				CAP_VIEW_QUESTION ,
				CAP_VIEW_LESSON_LIST,
				CAP_VIEW_LESSON,

				CAP_ADD_QUESTION ,
				CAP_ADD_LESSON ,

				CAP_EDIT_QUESTION ,
				CAP_EDIT_LESSON ,
			) ,
	) ;
