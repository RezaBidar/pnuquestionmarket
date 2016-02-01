<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php 
if(!$edit) $values = array('major_id' => '' , 'term_date_id' => '' , ) ;
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
<?php if(isset($title)) echo $title; else echo ""?>
</h3>
<br>

<?php 
echo btform::form_open();
echo '<div class="col-md-12" >' ;
echo btform::form_input( __l('my_form_major_id') . __l('my_form_required') . ' : ' , array("style"=>"max-width:120px" , 'name' => 'major_id' ) , $values['major_id']) ;
$select_arr = $this->m_term_date->getTermList() ;
echo btform::form_select(__l('my_form_term_list') . __l('my_form_required') . ' : ', 'term_date_id' , $select_arr , $values['term_date_id'] , ' class="form-control" ') ;
echo btform::form_submit(array("name"=>"submit" , "class"=>"btn btn-primary" ) , __l('my_form_save'));
echo '</div>' ;

echo btform::form_close();

?>
</div>
</div>
