<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php 
if(!$edit) $values = array('name' => '' , 'majors'=>'' ,'term_date_id' => '' , 'seri' => '' , 'test_n' => '' , 'tashrihi_n' => '' , 'test_time' => '' , 'tashrihi_time' => '' , ) ;
foreach ($values as $key => $value)  if(set_value($key) != '') $values[$key] = set_value($key) ;
?>
<div class="container col-md-8 col-lg-8 col-sm-10"><br>
<div id="page-wrapper" >

<?php
$error = $this->session->flashdata('error');
$message = $this->session->flashdata('message');
?>

<?php if(isset($error) && strlen($error) > 0 ):?>
<div class="alert alert-danger"><?php echo $error?></div>
<?php endif;?>

<?php if(isset($message)):?>
<div class="alert alert-success"><?php echo $message?></div>
<?php endif;?>

<h3>
<?php if($edit) :?>
	<span class="glyphicon glyphicon-edit"></span> 
<?php else: ?>
	<span class="glyphicon glyphicon-plus-sign"></span> 
<?php endif; ?>

<?php if(isset($title)) echo $title; else echo ""?></h3>
<br>


<?php 
echo btform::form_open();
echo '<div class="col-md-12" >' ;
$select_arr = $this->m_term_date->getTermList() ;
echo btform::form_select(__l('my_form_term_list') . __l('my_form_required') . ' : ', 'term_date_id' , $select_arr , $values['term_date_id'] , ' class="form-control" ') ;
echo btform::form_input( __l('my_form_qpage_name') . __l('my_form_required') . ' : ' , array('name' => 'name' ) , $values['name']) ;

$radio_arr = $this->m_question_page->getSeriList() ;
echo btform::form_radio_button(__l('my_form_qpage_seri') . __l('my_form_required') . ' : ', $radio_arr , array("name" => "seri") , $values['seri']);
echo '</div>' ;

echo '<div class="col-md-6 col-sm-12 pull-right" >' ;
$btn = form_button(array("name"=>"add_lesson" , "class"=>"btn btn-success add_lesson_btn") , __l('my_form_btn_add'));
echo btform::form_input_with_button( $btn , __l('my_form_qpage_lesson_id') . ' : ' , array('name' => 'add_lesson_id'  , "id" => "lesson_id" ) , '' , '' , __l('my_form_qpage_lesson_id_help')) ;
echo '</div>' ;

echo '<div class="col-md-6 col-sm-12  col-xs-12 pull-left"  style="min-height : 100px ; padding-top: 26px"  >' ;
echo '<div id="lesson_id_div" class="alert alert-success" >' ;
foreach ($lesson_list as $lsn_id => $lsn_name) {
	echo '<div class="form-inline"><div class="checkbox"><label> ' . $lsn_name . '-' . $lsn_id . 
								'<input type="checkbox" name="lesson_id[]" class="lesson_id_checkbox" value="'. 
								$lsn_id . '"  checked /></label></div> <button value="'. 
								$lsn_id . '" class="btn btn-default btn-xs" type="button" onClick="questionPageUniqueChecker(this)"> <span class="glyphicon glyphicon-check"></span> </button> </div>' ;
}
echo '</div>' ;
echo '</div>' ;


echo '<div class="col-md-6 col-sm-12 col-xs-12 pull-right" >' ;
echo btform::form_textarea(__l('my_form_qpage_majors') . __l('my_form_required') . ' : ' , array("name" => "majors", "class"=>"" , "rows" => "3") , $values['majors'] ) ;
echo btform::form_input( __l('my_form_qpage_test_n') . __l('my_form_required') . ' : ' , array("style"=>"max-width:120px" , 'name' => 'test_n') , $values['test_n']) ;
echo btform::form_input( __l('my_form_qpage_tashrihi_n') . __l('my_form_required') . ' : ' , array("style"=>"max-width:120px" , 'name' => 'tashrihi_n') , $values['tashrihi_n']) ;
echo btform::form_input( __l('my_form_qpage_test_time') . __l('my_form_required') . ' : ' , array("style"=>"max-width:120px" , 'name' => 'test_time') , $values['test_time']) ;
echo btform::form_input( __l('my_form_qpage_tashrihi_time') . __l('my_form_required') . ' : ' , array("style"=>"max-width:120px" , 'name' => 'tashrihi_time') , $values['tashrihi_time']) ;
echo btform::form_submit(array("name"=>"submit" , "class"=>"btn btn-primary" ) , __l('my_form_save'));
echo '</div>' ;

echo btform::form_close();

?>
<div id="id_not_found_new_class_suggestion" style="display:none;">
	<p>درس مورد نظر یافت نشد</p>
	<p>if you want insert new class click <a href="#">this</a></p>
</div>

</div>
</div>
