<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php 
if(!$edit) $values = array('fname' => '' , 'lname' => '' , 'username' => '' , 'password' => '' , 'gender' => '' , 'level' => '' , 'email' => '' , 'tel' => '' , 'mobile' => '' , 'address' => '' , ) ;
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
echo btform::form_input( __l('my_form_fname') . __l('my_form_required') . ' : ' , array('name' => 'fname' ) , $values['fname']) ;
echo btform::form_input( __l('my_form_lname') .  __l('my_form_required') . ' : ' , array('name' => 'lname') , $values['lname']) ;
echo btform::form_input( __l('my_form_username') . __l('my_form_required') . ' : ' , array('name' => 'username') , $values['username']) ;

if($edit)
echo btform::form_input( __l('my_form_new_password') .  ' : ' , array('name' => 'password'  ) , $values['password']) ;
else
echo btform::form_input( __l('my_form_password') . __l('my_form_required') . ' : ' , array('name' => 'password'  ) , $values['password']) ;

$radio_arr = $this->m_user->getGenderList() ;
echo btform::form_radio_button(__l('my_form_gender') .  __l('my_form_required') . ' : ' , $radio_arr , array("name" => "gender")  , $values['gender'] );
$radio_arr = $this->m_user->getLevelList() ;
echo btform::form_radio_button(__l('my_form_level') .  __l('my_form_required') . ' : ' , $radio_arr , array("name" => "level")  , $values['level'] );
echo btform::form_input( __l('my_form_email') . __l('my_form_required') . ' : ' , array('name' => 'email') , $values['email']) ;
echo btform::form_input( __l('my_form_tel') . ' : ' , array('name' => 'tel') , $values['tel']) ;
echo btform::form_input( __l('my_form_mobile') . ' : ' , array('name' => 'mobile') , $values['mobile']) ;

echo btform::form_textarea(__l('my_form_address') . ' : ' , array("name" => "address" , "class" => "form-control" ) ,  $values['address']);
echo btform::form_submit(array("name"=>"submit" , "class"=>"btn btn-primary" ) , __l('my_form_save'));
echo btform::form_close();

?>

</div>
</div>