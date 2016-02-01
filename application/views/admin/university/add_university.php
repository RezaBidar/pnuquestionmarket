<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php 
if(!$edit) $values = array('state' => '' , 'city' => '') ;
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
echo btform::form_input( __l('my_form_state') . __l('my_form_required') . ' : ' , array('name' => 'state' ) , $values['state']) ;
echo btform::form_input( __l('my_form_city') .  __l('my_form_required') . ' : ' , array('name' => 'city') , $values['city']) ;
echo btform::form_submit(array("name"=>"submit" , "class"=>"btn btn-primary" ) , __l('my_form_save'));
echo btform::form_close();

?>

</div>
</div>