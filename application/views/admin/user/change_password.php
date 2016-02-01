<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
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

	<span class="glyphicon glyphicon-edit"></span> 

<?php if(isset($title)) echo $title; else echo ""?></h3>
<br>

<?php 
echo btform::form_open();
echo btform::form_password( __l('my_form_old_password') .__l('my_form_required'). ' : ' ,array('name' => 'old_password' ) ) ;
echo btform::form_password( __l('my_form_new_password') .__l('my_form_required'). ' : ' ,array('name' => 'new_password' ) ) ;
echo btform::form_password( __l('my_form_repeat_password') .__l('my_form_required'). ' : ' ,array('name' => 'repeat_password' ) ) ;
echo btform::form_submit(array("name"=>"submit" , "class"=>"btn btn-primary" ) , __l('my_form_save'));
echo btform::form_close();

?>

</div>
</div>