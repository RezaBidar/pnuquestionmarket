<?php

function ci_include(){

	ob_start();
	require('index.php');
	ob_end_clean();
	$CI =& get_instance();
	var_dump($CI->session->userdata('fname')) ;
	// if($CI->session->userdata('loged_in')){
	// 	var_dump('logged_in') ;
	// }
	
}