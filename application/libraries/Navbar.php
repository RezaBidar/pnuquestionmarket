<?php

class Navbar {
	
	public static function getArray($rule = NULL){
		$navbar = array() ;

		$CI =& get_instance();

		if($rule == 'admin') {
			$navbar = array(
						    	'dashboard' => 
						    		array(
						    				"address" => "admin/dashboard" ,
						         			"icon" =>"glyphicon glyphicon-home" ,
						         			"label" => __l('my_navbar_dashboard') ,
						         			"active" =>FALSE
						         	) ,
						    	'users'=> 
						    		array(
						    				"address" => "admin/dashboard" ,
						         			"icon" =>"glyphicon glyphicon-user" ,
						         			"label" => __l('my_navbar_users') ,
						         			"active" =>FALSE ,
						         			"submenu" => 
						         				array(
						             				'user_list' => 
						             					array(
						             						"address" => "admin/dash_user/user_list" ,
								                 				"icon" =>"glyphicon glyphicon-user" ,
								                 				"label" => __l('my_navbar_user_list') ,
								                 				"active" =>FALSE 
								                 			) ,
						             				'add_user' => 
						             					array(
						             						"address" => "admin/dash_user/add_user" ,
								                 				"icon" =>"glyphicon glyphicon-user" ,
								                 				"label" => __l('my_navbar_add_user') ,
								                 				"active" =>FALSE 
								                 			) ,
						          				)
						         	) ,
						    	'questions'=> 
						    		array(
						    				"address" => "admin/dashboard" ,
						         			"icon" =>"glyphicon glyphicon-user" ,
						         			"label" => __l('my_navbar_questions') ,
						         			"active" =>FALSE ,
						         			"submenu" => 
						         				array(
						             				'question_list' => 
						             					array(
						             						"address" => "admin/dash_question/qpage_list" ,
								                 				"icon" =>"glyphicon glyphicon-user" ,
								                 				"label" => __l('my_navbar_question_list') ,
								                 				"active" =>FALSE 
								                 			) ,
						             				'add_question' => 
						             					array(
						             						"address" => "admin/dash_question/add_qpage" ,
								                 				"icon" =>"glyphicon glyphicon-user" ,
								                 				"label" => __l('my_navbar_add_question') ,
								                 				"active" =>FALSE 
								                 			) ,
						          				)
						         	) ,
						    	'charts'=> 
						    		array(
						    				"address" => "admin/dashboard" ,
						         			"icon" =>"glyphicon glyphicon-user" ,
						         			"label" => __l('my_navbar_charts') ,
						         			"active" =>FALSE ,
						         			"submenu" => 
						         				array(
						             				'chartpg_list' => 
						             					array(
						             						"address" => "admin/dash_chart/chartpg_list" ,
								                 				"icon" =>"glyphicon glyphicon-user" ,
								                 				"label" => __l('my_navbar_chartpg_list') ,
								                 				"active" =>FALSE 
								                 			) ,
						             				'add_chartpg' => 
						             					array(
						             						"address" => "admin/dash_chart/add_chartpg" ,
								                 				"icon" =>"glyphicon glyphicon-user" ,
								                 				"label" => __l('my_navbar_add_chartpg') ,
								                 				"active" =>FALSE 
								                 			) ,
						          				)
						         	) ,
						    	'lessons'=> 
						    		array(
						    				"address" => "admin/dashboard" ,
						         			"icon" =>"glyphicon glyphicon-user" ,
						         			"label" => __l('my_navbar_lessons') ,
						         			"active" =>FALSE ,
						         			"submenu" => 
						         				array(
						             				'lesson_list' => 
						             					array(
						             						"address" => "admin/dash_lesson/lesson_list" ,
								                 				"icon" =>"glyphicon glyphicon-user" ,
								                 				"label" => __l('my_navbar_lesson_list') ,
								                 				"active" =>FALSE 
								                 			) ,
						             				'add_lesson' => 
						             					array(
						             						"address" => "admin/dash_lesson/add_lesson" ,
								                 				"icon" =>"glyphicon glyphicon-user" ,
								                 				"label" => __l('my_navbar_add_lesson') ,
								                 				"active" =>FALSE 
								                 			) ,
						          				)
						         	) ,
						    	'majors'=> 
						    		array(
						    				"address" => "admin/dashboard" ,
						         			"icon" =>"glyphicon glyphicon-user" ,
						         			"label" => __l('my_navbar_majors') ,
						         			"active" =>FALSE ,
						         			"submenu" => 
						         				array(
						             				'major_list' => 
						             					array(
						             						"address" => "admin/dash_major/major_list" ,
								                 				"icon" =>"glyphicon glyphicon-user" ,
								                 				"label" => __l('my_navbar_major_list') ,
								                 				"active" =>FALSE 
								                 			) ,
						             				'add_major' => 
						             					array(
						             						"address" => "admin/dash_major/add_major" ,
								                 				"icon" =>"glyphicon glyphicon-user" ,
								                 				"label" => __l('my_navbar_add_major') ,
								                 				"active" =>FALSE 
								                 			) ,
						          				)
						         	) ,
						    	'terms'=> 
						    		array(
						    				"address" => "admin/dashboard" ,
						         			"icon" =>"glyphicon glyphicon-user" ,
						         			"label" => __l('my_navbar_terms') ,
						         			"active" =>FALSE ,
						         			"submenu" => 
						         				array(
						             				'term_list' => 
						             					array(
						             						"address" => "admin/dash_term/term_list" ,
								                 				"icon" =>"glyphicon glyphicon-user" ,
								                 				"label" => __l('my_navbar_term_list') ,
								                 				"active" =>FALSE 
								                 			) ,
						             				'add_term' => 
						             					array(
						             						"address" => "admin/dash_term/add_term" ,
								                 				"icon" =>"glyphicon glyphicon-user" ,
								                 				"label" => __l('my_navbar_add_term') ,
								                 				"active" =>FALSE 
								                 			) ,
						          				)
						         	) ,
						    	'universities'=> 
						    		array(
						    				"address" => "admin/dashboard" ,
						         			"icon" =>"glyphicon glyphicon-user" ,
						         			"label" => __l('my_navbar_universities') ,
						         			"active" =>FALSE ,
						         			"submenu" => 
						         				array(
						             				'university_list' => 
						             					array(
						             						"address" => "admin/dash_university/university_list" ,
								                 				"icon" =>"glyphicon glyphicon-user" ,
								                 				"label" => __l('my_navbar_university_list') ,
								                 				"active" =>FALSE 
								                 			) ,
						             				'add_university' => 
						             					array(
						             						"address" => "admin/dash_university/add_university" ,
								                 				"icon" =>"glyphicon glyphicon-user" ,
								                 				"label" => __l('my_navbar_add_university') ,
								                 				"active" =>FALSE 
								                 			) ,
						          				)
						         	) ,
						    	'students' => 
						    		array(
						    				"address" => "admin/dashboard" ,
						         			"icon" =>"glyphicon glyphicon-home" ,
						         			"label" => __l('my_navbar_students') ,
						         			"active" =>FALSE
						         	) ,
						    	'reports' => 
						    		array(
						    				"address" => "admin/dashboard" ,
						         			"icon" =>"glyphicon glyphicon-home" ,
						         			"label" => __l('my_navbar_reports') ,
						         			"active" =>FALSE
						         	) ,
						    
						);

		}else if($rule == 'editor'){
			$navbar = array(
						    	'dashboard' => 
						    		array(
						    				"address" => "admin/dashboard" ,
						         			"icon" =>"glyphicon glyphicon-home" ,
						         			"label" => __l('my_navbar_dashboard') ,
						         			"active" =>FALSE
						         	) ,
						    	'questions'=> 
						    		array(
						    				"address" => "admin/dashboard" ,
						         			"icon" =>"fa fa-question-circle" ,
						         			"label" => __l('my_navbar_questions') ,
						         			"active" =>FALSE ,
						         			"submenu" => 
						         				array(
						             				'add_question' => 
						             					array(
						             						"address" => "admin/dash_question/add_qpage" ,
								                 				"icon" =>"glyphicon glyphicon-ok" ,
								                 				"label" => __l('my_navbar_add_question') ,
								                 				"active" =>FALSE 
								                 			) ,
						             				'question_list' => 
						             					array(
						             						"address" => "admin/dash_question/qpage_list" ,
								                 				"icon" =>"glyphicon glyphicon-menu-hamburger" ,
								                 				"label" => __l('my_navbar_question_list') ,
								                 				"active" =>FALSE 
								                 			) ,
						             				'my_question_list' => 
						             					array(
						             						"address" => "admin/dash_question/qpage_list/". $CI->session->userdata('id') ,
								                 				"icon" =>"glyphicon glyphicon-heart" ,
								                 				"label" => __l('my_navbar_my_question_list') ,
								                 				"active" =>FALSE 
								                 			) ,
						          				)
						         	) ,
						    	'lessons'=> 
						    		array(
						    				"address" => "admin/dashboard" ,
						         			"icon" =>"fa fa-book" ,
						         			"label" => __l('my_navbar_lessons') ,
						         			"active" =>FALSE ,
						         			"submenu" => 
						         				array(
						             				'add_lesson' => 
						             					array(
						             						"address" => "admin/dash_lesson/add_lesson" ,
								                 				"icon" =>"glyphicon glyphicon-ok" ,
								                 				"label" => __l('my_navbar_add_lesson') ,
								                 				"active" =>FALSE 
								                 			) ,
						             				'add_group_lessen' => 
						             					array(
						             						"address" => "admin/dash_lesson/possible_add_lesson" ,
								                 				"icon" =>"glyphicon glyphicon-paste" ,
								                 				"label" => __l('my_navbar_add_group_lesson') ,
								                 				"active" =>FALSE 
								                 			) ,
						             				'lesson_list' => 
						             					array(
						             						"address" => "admin/dash_lesson/lesson_list" ,
								                 				"icon" =>"glyphicon glyphicon-menu-hamburger" ,
								                 				"label" => __l('my_navbar_lesson_list') ,
								                 				"active" =>FALSE 
								                 			) ,
						             				'my_lesson_list' => 
						             					array(
						             						"address" => "admin/dash_lesson/lesson_list/". $CI->session->userdata('id') ,
								                 				"icon" =>"glyphicon glyphicon-heart" ,
								                 				"label" => __l('my_navbar_my_lesson_list') ,
								                 				"active" =>FALSE 
								                 			) ,
						          				)
						         	) ,
						    
						);
		}else if($rule == 'writer'){
			
			$navbar = array(
						    	'dashboard' => 
						    		array(
						    				"address" => "admin/dashboard" ,
						         			"icon" =>"glyphicon glyphicon-home" ,
						         			"label" => __l('my_navbar_dashboard') ,
						         			"active" =>FALSE
						         	) ,
						    	'questions'=> 
						    		array(
						    				"address" => "admin/dashboard" ,
						         			"icon" =>"fa fa-question-circle" ,
						         			"label" => __l('my_navbar_questions') ,
						         			"active" =>FALSE ,
						         			"submenu" => 
						         				array(
						             				'add_question' => 
						             					array(
						             						"address" => "admin/dash_question/add_qpage" ,
								                 				"icon" =>"glyphicon glyphicon-ok" ,
								                 				"label" => __l('my_navbar_add_question') ,
								                 				"active" =>FALSE 
								                 			) ,
						             				'question_list' => 
						             					array(
						             						"address" => "admin/dash_question/qpage_list" ,
								                 				"icon" =>"glyphicon glyphicon-menu-hamburger" ,
								                 				"label" => __l('my_navbar_question_list') ,
								                 				"active" =>FALSE 
								                 			) ,
						             				'my_question_list' => 
						             					array(
						             						"address" => "admin/dash_question/qpage_list/". $CI->session->userdata('id') ,
								                 				"icon" =>"glyphicon glyphicon-heart" ,
								                 				"label" => __l('my_navbar_my_question_list') ,
								                 				"active" =>FALSE 
								                 			) ,
						          				)
						         	) ,
						    	'lessons'=> 
						    		array(
						    				"address" => "admin/dashboard" ,
						         			"icon" =>"fa fa-book" ,
						         			"label" => __l('my_navbar_lessons') ,
						         			"active" =>FALSE ,
						         			"submenu" => 
						         				array(
						             				'add_lesson' => 
						             					array(
						             						"address" => "admin/dash_lesson/add_lesson" ,
								                 				"icon" =>"glyphicon glyphicon-ok" ,
								                 				"label" => __l('my_navbar_add_lesson') ,
								                 				"active" =>FALSE 
								                 			) ,
						             				'add_group_lessen' => 
						             					array(
						             						"address" => "admin/dash_lesson/possible_add_lesson" ,
								                 				"icon" =>"glyphicon glyphicon-paste" ,
								                 				"label" => __l('my_navbar_add_group_lesson') ,
								                 				"active" =>FALSE 
								                 			) ,
						             				'lesson_list' => 
						             					array(
						             						"address" => "admin/dash_lesson/lesson_list" ,
								                 				"icon" =>"glyphicon glyphicon-menu-hamburger" ,
								                 				"label" => __l('my_navbar_lesson_list') ,
								                 				"active" =>FALSE 
								                 			) ,
						             				'my_lesson_list' => 
						             					array(
						             						"address" => "admin/dash_lesson/lesson_list/". $CI->session->userdata('id') ,
								                 				"icon" =>"glyphicon glyphicon-heart" ,
								                 				"label" => __l('my_navbar_my_lesson_list') ,
								                 				"active" =>FALSE 
								                 			) ,
						          				)
						         	) ,
						    
						);
		}else {
			echo 'we have no option' ;
		}

		return $navbar ;
	}
}