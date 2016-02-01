<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php 
if(!$edit) $values = array('id' => $lesson_id , 'name' => '' , 'nazari_n' => '' , 'amali_n' => '' , 'nazari_h' => '' , 'amali_h' => '' , 'azmoon_type' => '' , ) ; 
foreach ($values as $key => $value)  if(set_value($key) != '') $values[$key] = set_value($key) ;
?>
<div class="container col-md-6 col-lg-6 col-sm-10"><br>
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

<div class="col-md-12">
<?php 
echo btform::form_open();
echo btform::form_input( __l('my_form_lesson_id') . __l('my_form_required') . ' : ' , array("style"=>"max-width:120px" , 'name' => 'id' ) , $values['id']) ;
echo btform::form_input( __l('my_form_lesson_name') . __l('my_form_required') . ' : ' , array('name' => 'name' ) , $values['name']) ;
echo btform::form_input( __l('my_form_nazari_n') . ' : ' , array("style"=>"max-width:120px" , 'name' => 'nazari_n') , $values['nazari_n']) ;
echo btform::form_input( __l('my_form_amali_n') . ' : ' , array("style"=>"max-width:120px" , 'name' => 'amali_n') , $values['amali_n']) ;
echo btform::form_input( __l('my_form_nazari_h') . ' : ' , array("style"=>"max-width:120px" , 'name' => 'nazari_h') , $values['nazari_h']) ;
echo btform::form_input( __l('my_form_amali_h') . ' : ' , array("style"=>"max-width:120px" , 'name' => 'amali_h') , $values['amali_h']) ;
$radio_arr = $this->m_lesson->getAzmoonTypes() ;
echo btform::form_radio_button(__l('my_form_azmoon_type') , $radio_arr , array("name" => "azmoon_type")  , $values['azmoon_type']);
echo btform::form_submit(array("name"=>"submit" , "class"=>"btn btn-primary" ) , __l('my_form_save'));
echo btform::form_close();

?>
</div>
</div>
</div>