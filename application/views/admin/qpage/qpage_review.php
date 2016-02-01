<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="container col-md-8 col-lg-6 col-sm-10"><br>
<div id="page-wrapper" >


<h3><span class="glyphicon glyphicon-list-alt"></span> <?php if(isset($title)) echo $title; else echo "بدون عنوان" ;?></h3>
<br>


<div class="panel panel-info" id="qpage_details">
		<div class="panel-heading">مشخصات برگه ی سوال
		<?php echo '<a target="_blank" href="'. site_url('admin/dash_question/add_qpage/' 
			. $qpage->{m_question_page::COLUMN_ID}).'" class="glyphicon glyphicon-pencil edit_icon"></a>' ;
		?>
		</div>
		<div class="panel-body">
		<?php //var_dump($qpage); 
		echo '<p><b> '.__l('my_form_qpage_name').' : </b>' . $qpage->{m_question_page::COLUMN_NAME} . '</p>' ;
		echo '<p><b> '.__l('my_form_term_list').' : </b>' . $this->m_term_date->getTermName($qpage->{m_question_page::COLUMN_TERMDATE_ID}) . '</p>' ;
		echo '<p><b> '.__l('my_form_qpage_seri').' : </b>' . $qpage->{m_question_page::COLUMN_SERI} . '</p>' ;
		echo '<p><b> '.__l('my_form_qpage_majors').' : </b>' . $qpage->{m_question_page::COLUMN_MAJORS} . '</p>' ;
		echo '<p><b> '.__l('my_form_qpage_lessons').' : </b>' . $this->m_qpage_lesson->getLessonsStr($qpage->{m_question_page::COLUMN_ID}) . '</p>' ;
		echo '<p><b> '.__l('my_form_qpage_tashrihi_n').' : </b>' . $qpage->{m_question_page::COLUMN_TASHRIHI_N} . '</p>' ;
		echo '<p><b> '.__l('my_form_qpage_test_n').' : </b>' . $qpage->{m_question_page::COLUMN_TEST_N} . '</p>' ;
		echo '<p><b> '.__l('my_form_qpage_tashrihi_time').' : </b>' . $qpage->{m_question_page::COLUMN_TASHRIHI_TIME} . '</p>' ;
		echo '<p><b> '.__l('my_form_qpage_test_time').' : </b>' . $qpage->{m_question_page::COLUMN_TEST_TIME} . '</p>' ;
		echo '<p><b> نویسنده : </b>' . $this->m_user->getName($qpage->{m_question_page::COLUMN_CREATOR}) . '</p>' ;
		echo '<p><b> تاریخ نوشتن این سوال : </b>' . myJalaliFormat($qpage->{m_question_page::COLUMN_CREATED_TIME}) . '</p>' ;
		if($qpage->{m_question_page::COLUMN_MODIFIED_TIME} != $qpage->{m_question_page::COLUMN_CREATED_TIME}){
			echo '<p><b> ویرایش کننده : </b>' . $this->m_user->getName($qpage->{m_question_page::COLUMN_MODIFIER}) . '</p>' ;
			echo '<p><b> تاریخ اخرین ویرایش : </b>' . myJalaliFormat($qpage->{m_question_page::COLUMN_MODIFIED_TIME}) . '</p>' ;
		}
		?>
		</div>

</div>
<hr />
<div class="" id="questions">
		<?php //var_dump($question_list) 
			foreach ($question_list as $question) {
				echo '<div class="well well-md" id="q_'. $question->{m_question::COLUMN_ID} .'">';

				echo '<a target="_blank" href="'. site_url('admin/dash_question/add_question/' 
					. $question->{m_question::COLUMN_QPAGE_ID} . '/' . $question->{m_question::COLUMN_ID})
				 	.'" class="glyphicon glyphicon-cog edit_icon"></a>' ;
				
				echo '  <a onClick="bootbox.alert(\'' ;
					echo '<p> نویسنده : ' . $this->m_user->getName($question->{m_question::COLUMN_CREATOR}) . '</p>' ;
					echo '<p> تاریخ نوشتن این سوال : ' . myJalaliFormat($question->{m_question::COLUMN_CREATED_TIME}) . '</p>' ;
					if($question->{m_question::COLUMN_MODIFIED_TIME} != $question->{m_question::COLUMN_CREATED_TIME}){
						echo '<p> ویرایش کننده : ' . $this->m_user->getName($question->{m_question::COLUMN_MODIFIER}) . '</p>' ;
						echo '<p> تاریخ اخرین ویرایش : ' . myJalaliFormat($question->{m_question::COLUMN_MODIFIED_TIME}) . '</p>' ;
					}
				echo '\')" href="#q_chertopert" class="glyphicon glyphicon-exclamation-sign info_icon"></a>' ;

				if($question->{m_question::COLUMN_TYPE} == m_question::TYPE_TESTI){
					
					echo shortcode2img(addInParagraph($question->{m_question::COLUMN_NUMBER}.' - ' , $question->{m_question::COLUMN_TEXT} ))  ;
					echo '<hr/>';

					if($question->{m_question::COLUMN_ANSWER} == 1) echo '<div class="alert alert-answer">' ; else echo '<div class="alert alert-info">' ;
					echo shortcode2img(addInParagraph('الف - ' , $question->{m_question::COLUMN_A}) ) . '</div>' ;
					if($question->{m_question::COLUMN_ANSWER} == 2) echo '<div class="alert alert-answer">' ; else echo '<div class="alert alert-info">' ;
					echo shortcode2img(addInParagraph('ب - ' ,$question->{m_question::COLUMN_B})) . '</div>';
					if($question->{m_question::COLUMN_ANSWER} == 3) echo '<div class="alert alert-answer">' ; else echo '<div class="alert alert-info">' ;
					echo shortcode2img(addInParagraph('ج - ' ,$question->{m_question::COLUMN_C})) . '</div>' ;
					if($question->{m_question::COLUMN_ANSWER} == 4) echo '<div class="alert alert-answer">' ; else echo '<div class="alert alert-info">' ;
					echo  shortcode2img(addInParagraph('د - ' ,$question->{m_question::COLUMN_D})) . '</div>';

				}else if($question->{m_question::COLUMN_TYPE} == m_question::TYPE_TASHRIHI){
					echo addInParagraph($question->{m_question::COLUMN_NUMBER}.' - ' , $question->{m_question::COLUMN_TEXT} )  ;
					echo '<hr/>';
					echo '<div class="alert alert-answer">' . addInParagraph('جواب - ' , $question->{m_question::COLUMN_ANSWER_TEXT}) . '</div>';
				}else{
					echo "an error accurred plz tel Administrator" ;
				}
				echo '</div>';
			}
		?>
</div>


</div>
</div>
