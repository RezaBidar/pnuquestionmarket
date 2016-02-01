<?php


/**
 * ye matn migire va be andazeye limit string barmigardoone .. kholase
 * @param string $string
 * @param int $limit
 * @return string
 */
function excerpts($string , $limit = 255){
    $str = substr($string,0,$limit) ;
    $str .= (strlen($string) > $limit) ? '...' : '' ;
    
    return $str ;
}

function download_link($file_name , $class = '' , $pre = '' , $post =''){
    if($file_name != NULL)
        return '<a href="' . site_url('file/upload/' . $file_name) . '" target="_blank">دانلود فایل ضمیمه</a>' ;
    else 
        return '' ;
}

function my_escapeshellarg($input)
{
    $input = str_replace('\'', '\\\'', $input);

    return '\''.$input.'\'';
}

/**
 * matne feedback va type feedback ra migirad va html monasebe task_view ra barmigardanad
 * @param string $text
 * @param integer $type
 * @param Object $counter_obj
 */
function my_get_feedback_view($text , $type , &$counter_obj){
    
    switch ($type){
        case 0 :
            return '<p class="alert alert-feedback0">گزارش شماره ' . $counter_obj->f_0++ . ' : <br/>' . nl2br($text) . '</p>';
            break ;
        case 1 :
            return '<p class="alert alert-feedback1">اخطار شماره ' . $counter_obj->f_1++ . ' : <br/>' . nl2br($text) . '</p>';
            break ;
        case 2 :
            return '<p class="alert alert-feedback2">پیام شماره ' . $counter_obj->f_2++ . ' : <br/>' . nl2br($text) . '</p>';
            break ;
        case 3 :
            return '<p class="alert alert-feedback3">درخواست تصریح شماره ' . $counter_obj->f_3++ . ' : <br/>' . nl2br($text) . '</p>';
            break ;
        case 4 :
            return '<p class="alert alert-feedback4">تشریح شماره ' . $counter_obj->f_4++ . ' : <br/>' . nl2br($text) . '</p>';
            break ;
        case 5 :
            return '<p class="alert alert-feedback5">گزارش ناظر شماره ' . $counter_obj->f_5++ . ' : <br/>' . nl2br($text) . '</p>';
            break ;
        
    }
}

/**
 * get status view 
 */

