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

<h3><span class="glyphicon glyphicon-plus-sign"></span> <?php if(isset($title)) echo $title; else echo "اضافه کردن نظر"?></h3>
<br>
<div class="col-md-12">
<div class="alert alert-info">
<p> <span class="fa fa-info-circle"></span> کد دروس را با "," از هم جدا کنید - مانند : 3424 , 23432 , 434 </p>
<p> <span class="fa fa-info-circle"></span> وجود هر کاراکتری در داخل یک کد درس به جز "," بلا مانع است - مانند : 33-22-15 , 19-96-25 </p>
</div>
<?php 
echo btform::form_open();
echo btform::form_textarea( __l('my_form_lesson_lessonlist') . __l('my_form_required') . ' : ' , array('name' => 'lesson_list' , "dir" => "ltr")) ;
echo btform::form_submit(array("name"=>"submit" , "class"=>"btn btn-primary" ) , __l('my_form_calculate_btn'));
echo btform::form_close();

?>
<div id="lesson_list">
<?php 
	if(isset($lesson_list))
		foreach($lesson_list as $lesson_id => $lesson_name){
			if($lesson_name == NULL )
				echo '<div class="alert alert-success"><a target="_blank" 
						href="' . site_url('admin/dash_lesson/add_lesson/' . $lesson_id ). '">اضافه کردن درس با کد '. $lesson_id . '</a></div>' ;
			else
				echo '<div class="alert alert-danger">'. $lesson_id  .' - ' . $lesson_name . '</div>' ;
		}
?>
</div>

</div>
</div>
</div>