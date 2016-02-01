<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="container col-md-8 col-lg-6 col-sm-10"><br>
<div id="page-wrapper" >


<h3><span class="glyphicon glyphicon-list-alt"></span> <?php if(isset($title)) echo $title; else echo "بدون عنوان" ;?></h3>
<br>


<div class="panel panel-info" id="qpage_details">
		<div class="panel-heading">مشخصات درس
		<?php echo '<a target="_blank" href="'. site_url('admin/dash_lesson/add_lesson/' 
			. $lesson->{m_lesson::COLUMN_ID}).'" class="glyphicon glyphicon-pencil edit_icon"></a>' ;
		?>
		</div>
		<div class="panel-body">
		<?php //var_dump($lesson); 
		echo '<p><b> '.__l('my_form_lesson_id').' : </b>' . $lesson->{m_lesson::COLUMN_ID} . '</p>' ;
		echo '<p><b> '.__l('my_form_lesson_name').' : </b>' . $lesson->{m_lesson::COLUMN_NAME} . '</p>' ;
		echo '<p><b> '.__l('my_form_nazari_n').' : </b>' . $lesson->{m_lesson::COLUMN_NAZARI_N} . '</p>' ;
		echo '<p><b> '.__l('my_form_amali_n').' : </b>' . $lesson->{m_lesson::COLUMN_AMALI_N} . '</p>' ;
		echo '<p><b> '.__l('my_form_nazari_h').' : </b>' . $lesson->{m_lesson::COLUMN_NAZARI_H} . '</p>' ;
		echo '<p><b> '.__l('my_form_amali_h').' : </b>' . $lesson->{m_lesson::COLUMN_AMALI_H} . '</p>' ;
		echo '<p><b> '.__l('my_form_azmoon_type').' : </b>' . $this->m_lesson->getAzmoonTypeName($lesson->{m_lesson::COLUMN_AZMOON_TYPE})  . '</p>' ;
		
		echo '<p><b> نویسنده : </b>' . $this->m_user->getName($lesson->{m_lesson::COLUMN_CREATOR}) . '</p>' ;
		echo '<p><b> تاریخ اضافه کردن درس : </b>' . myJalaliFormat($lesson->{m_lesson::COLUMN_CREATED_TIME}) . '</p>' ;
		if($lesson->{m_lesson::COLUMN_MODIFIED_TIME} != $lesson->{m_lesson::COLUMN_CREATED_TIME}){
			echo '<p><b> ویرایش کننده : </b>' . $this->m_user->getName($lesson->{m_lesson::COLUMN_MODIFIER}) . '</p>' ;
			echo '<p><b> تاریخ اخرین ویرایش : </b>' . myJalaliFormat($lesson->{m_lesson::COLUMN_MODIFIED_TIME}) . '</p>' ;
		}
		?>
		</div>

</div>
<hr />


</div>
</div>
