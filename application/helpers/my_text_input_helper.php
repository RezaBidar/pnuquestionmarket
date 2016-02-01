<?php

/**
 * detect site_url and ../../ .. and replace it with shortcode({{rb_site_url}})
 * its usefull for responsive filemanager filepicker
 * @param  string $text 
 * @return string      
 */
function img2shortcode($text){
	$site_url = str_replace('/' , '\/' , site_url()) ;
	// preg_match_all('/(<img[^(?:src)]*src=")((?:..\/)*){1}(source\/(?:[^"]*)")/i', $text, $matches);
	// var_dump( preg_replace('/(<img[^(?:src)]*src=")((?:..\/)*|'. $site_url .'){1}(source\/(?:[^"]*)")/i', '$1{{rb_site_url}}$3',$text) );
	return preg_replace('/(<img[^(?:src)]*src=")((?:..\/)*|'. $site_url .'){1}(source\/(?:[^"]*)")/i', '$1{{rb_site_url}}$3',$text) ;
}

/**
 * get string and replace {{rb_site_url}} with real site url like http://rezabidar.com/
 * its usefull for responsive filemanager filepicker
 * @param  string $text 
 * @return string       
 */
function shortcode2img($text){
	return str_replace('{{rb_site_url}}' , site_url() , $text) ;
}

function my_excerpts($string , $limit = 500){
        
        
        $str = substr($string,0,$limit) ;
        $str .= (strlen($string) > $limit) ? '...' : '' ;
    
        return $str ;
}
