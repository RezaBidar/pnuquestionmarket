<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php 
if(!$edit) $values = array('term' => '' , 'number' => '' ,'lesson_id' => '' , 'pishniaz' => '' , 'type' => '' ,'ekhtiari_nazari_n' => '') ;
foreach ($values as $key => $value)  if(set_value($key) != '') $values[$key] = set_value($key) ;
?>
<div class="container col-md-8 col-lg-6 col-sm-10"><br>
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
<?php if(isset($title)) echo $title; else echo ""?>
</h3>
<br>

<?php 
echo btform::form_open();
echo '<div class="col-md-12" >' ;

//term list
$radio_arr = $this->m_chart_content->getTermList() ;
echo btform::form_radio_button(__l('my_form_chartcon_term') . __l('my_form_required') . ' : ', $radio_arr , array("name" => "term") , $values['term']);

//number in page // ajax show same number_in_page 
echo btform::form_input( __l('my_form_chartcon_number') . __l('my_form_required') . ' : ' , array("style"=>"max-width:120px" , 'name' => 'number' ) , $values['number']) ;

//lesson_id -> ajax checker
echo btform::form_input( __l('my_form_chartcon_lesson_id') . ' : ' , array("style"=>"max-width:120px" , 'name' => 'lesson_id' ) , $values['lesson_id']) ;

//pishniaz
echo btform::form_input( __l('my_form_chartcon_pishniaz') . ' : ' , array('name' => 'pishniaz' ) , $values['pishniaz']) ;

//type
$radio_arr = $this->m_chart_content->getTypeList() ;
echo btform::form_radio_button(__l('my_form_chartcon_type') . __l('my_form_required') . ' : ', $radio_arr , array("name" => "type") , $values['type']);

//vahede ekhtiari
if($values['type'] == m_chart_content::TYPE_EKHTIARI) echo '<div id="ekhtiari_nazari_n">' ;
else echo '<div id="ekhtiari_nazari_n" style="display:none">' ;
echo btform::form_input( __l('my_form_chartcon_ekhtiari_nazari_n') . __l('my_form_required') . ' : ' , array("style"=>"max-width:120px" , 'name' => 'ekhtiari_nazari_n' ) , $values['ekhtiari_nazari_n']) ;
echo '</div>' ;

echo btform::form_submit(array("name"=>"submit" , "class"=>"btn btn-primary" ) , __l('my_form_save'));
echo '</div>' ;


echo btform::form_close();

?>

</div>
</div>
