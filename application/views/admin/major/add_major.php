<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php 
if(!$edit) $values = array('id' => '' , 'name' => '' , 'daneshkade' => '' , 'group' => '' , 'maghta' => '' , 'first_in' => '' , 'last_in' => '' , );
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

<?php 
echo btform::form_open();
echo btform::form_input( __l('my_form_major_id') . __l('my_form_required') . ' : ' , array("style"=>"max-width:120px" , 'name' => 'id' ) , $values['id']) ;
echo btform::form_input( __l('my_form_major_name') . __l('my_form_required') . ' : ' , array('name' => 'name' ) , $values['name']) ;
echo btform::form_input( __l('my_form_major_group') . __l('my_form_required') . ' : ' , array('name' => 'group' ) , $values['group']) ;
echo btform::form_input( __l('my_form_major_first_in') . ' : ' , array("style"=>"max-width:120px" , 'name' => 'first_in' ) , $values['first_in']) ;
echo btform::form_input( __l('my_form_major_last_in') . ' : ' , array("style"=>"max-width:120px" , 'name' => 'last_in' ) , $values['last_in']) ;
echo btform::form_input( __l('my_form_major_daneshkade') . __l('my_form_required') . ' : ' , array('name' => 'daneshkade' ) , $values['daneshkade']) ;
$radio_arr = $this->m_major->getMaghtaTypes() ;
echo btform::form_radio_button(__l('my_form_major_maghta') . __l('my_form_required') , $radio_arr , array("name" => "maghta")  , $values['maghta']);
echo btform::form_submit(array("name"=>"submit" , "class"=>"btn btn-primary" ) , __l('my_form_save'));
echo btform::form_close();

?>

</div>
</div>