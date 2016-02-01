<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php 
if(!$edit) $values = array('number_in_page' => $number_in_page , 'type' => $type , 'text' => '' , 'answer' => '' , 'answer_text' => '' , 'a' => '' , 'b' => '' , 'c' => '' , 'd' => '' , ) ;

foreach ($values as $key => $value)  if(set_value($key) != '') $values[$key] = set_value($key) ;
?>
<div id="page-wrapper">
<div class="container col-md-10 col-lg-10 col-sm-10">
<br>

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

<?php if(isset($title)) echo $title; else echo ""?> <small> <?php echo $qpage_name?> <a href="<?php echo $question_list_url ?>" class="label label-primary" target="_blank">لیست سوالات</a></small> </h3>
<br>

<?php 
echo form_open();

echo btform::form_input(__l('my_form_question_number')  . __l('my_form_required') . ' : ', array("name" => "number_in_page" , "style"=>"max-width:120px") , $values['number_in_page'] );

$radio_arr = $this->m_question->getTypeList() ;
echo btform::form_radio_button(__l('my_form_question_type') . __l('my_form_required') . ' : ' , $radio_arr , array("name" => "type" ) , $values['type']);

echo btform::form_textarea(__l('my_form_question_text') . __l('my_form_required') . ' : ' , array("name" => "text", "class"=>"full_textarea" , "rows" => "3"  ) , $values['text'] );

if($values['type'] == '1')	echo '<div id="question_type_1">' ;
else echo '<div id="question_type_1" style="display:none;">' ;

$radio_arr = $this->m_question->getAnswerChoiceList();
echo btform::form_radio_button(__l('my_form_question_answer') . __l('my_form_required') . ' : ' , $radio_arr , array("name" => "answer") , $values['answer']);

echo '<div class="row" >' ;
echo '<div class="col-md-6 col-sm-12" >' ;
echo btform::form_textarea(__l('my_form_question_answer_a') . __l('my_form_required') . ' : ' , array("name" => "a", "class"=>"full_textarea " , "rows" => "3" ) , $values['a'] );
echo '</div>';
echo '<div class="col-md-6 col-sm-12" >' ;
echo btform::form_textarea(__l('my_form_question_answer_b') . __l('my_form_required') . ' : ' , array("name" => "b", "class"=>"full_textarea" , "rows" => "3") , $values['b'] );
echo '</div>';
echo '</div>';

echo '<div class="row" >' ;
echo '<div class="col-md-6 col-sm-12" >' ;
echo btform::form_textarea(__l('my_form_question_answer_c') . __l('my_form_required') . ' : ' , array("name" => "c", "class"=>"full_textarea" , "rows" => "3" ) , $values['c'] );
echo '</div>';
echo '<div class="col-md-6 col-sm-12" >' ;
echo btform::form_textarea(__l('my_form_question_answer_d') . __l('my_form_required') . ' : ' , array("name" => "d", "class"=>"full_textarea" , "rows" => "3" ), $values['d']  );
echo '</div>';
echo '</div>';

echo '</div>';

if($values['type'] == '2')	echo '<div id="question_type_2">' ;
else echo '<div id="question_type_2" style="display:none;">' ;
echo btform::form_textarea(__l('my_form_question_answer') . ' : ' , array("name" => "answer_text", "class"=>"full_textarea" , "rows" => "3"  ) , $values['answer_text'] );
echo '</div>';

echo btform::form_submit(array("name"=>"submit" , "class"=>"btn btn-primary" ) , __l('my_form_save'));
echo btform::form_close();
?>
<br/>
</div>
</div>