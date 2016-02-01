<?php
class My_Table {

    
    public function getView($thead, $tbody, $id_cel, $data , $update_url = NULL , $delete_url = NULL, $select_url = NULL ){
    
    
        $msg = "<thead>";
        $msg .= "<tr>";
        $msg .= "<td>ردیف</td>";
        foreach ($thead as $td){
            $msg .= "<td>" . $td . "</td>";
        }
        if($select_url != NULL)
            $msg .= "<td>انتخاب</td>";
        if($update_url != NULL)
            $msg .= "<td>ویرایش</td>";
        if($delete_url != NULL)
            $msg .= "<td>حذف</td>";
        $msg .= "</tr>";
        $msg .= "</thead>";
        $msg .= "<tbody>";
    
        foreach ($data as $tr => $td){
            $msg .= "<tr>";
            $msg .= "<td>". (string)(intval($tr) + 1) ."</td>";
            foreach ($tbody as $cell_name)
                $msg .= "<td>". $this->excerpts($td->{$cell_name} , 150)."</td>";
            if($select_url != NULL)
                $msg .= "<td><a href=\"". site_url($select_url . '/' . $td->{$id_cel}) ."\" class=\"glyphicon glyphicon-ok-sign enter_icon \" ></a></td>";
            if($update_url != NULL)
                $msg .= "<td><a href=\"". site_url($update_url . '/' . $td->{$id_cel}) ."\" class=\"glyphicon glyphicon-pencil edit_icon \" ></a></td>";
            if($delete_url != NULL)
                $msg .= "<td><a href=\"". site_url($delete_url . '/' . $td->{$id_cel}) ."\" onclick=\"return confirm('از حذف مطمئن هستید ؟'); \" class=\"glyphicon glyphicon-remove remove_icon\" ></a></td>";
            $msg .= "</tr>";
        }
    
        $msg .= "</tbody>";
        return $msg;
    }
    
    /**
     * ye matn migire va be andazeye limit string barmigardoone .. kholase
     * @param string $string
     * @param int $limit
     * @return string
     */
    function excerpts($string , $limit = 255){
        // if($this->startsWith($string, '<')) return $string ;
        
        $str = substr($string,0,$limit) ;
        $str .= (strlen($string) > $limit) ? '...' : '' ;
    
        return $str ;
    }
    
    function startsWith($haystack, $needle) {
        // search backwards starting from haystack length characters from the end
        return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== FALSE;
    }
}