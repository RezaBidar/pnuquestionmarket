<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="container col-md-8 col-lg-6 col-sm-10"><br>
<div id="page-wrapper" >


<h3><span class="glyphicon glyphicon-list-alt"></span> <?php if(isset($title)) echo $title; else echo "مشاهده پروفایل" ;?></h3>
<br>


<div class="panel panel-info" id="qpage_details">
		<div class="panel-heading">پروفایل
		<?php echo '<a target="_blank" href="'. site_url('admin/dash_user/edit_profile/') .'" class="glyphicon glyphicon-pencil edit_icon"></a>' 
		  . '<a class="btn btn-danger pull-left" href="'. site_url('admin/dash_user/change_password') .'">تغیر کلمه عبور</a>';
		?>
		</div>
		<div class="panel-body">
		<?php //var_dump($lesson); 
		echo '<p><b> '.__l('my_form_username').' : </b>' . $user->{m_user::COLUMN_USERNAME} . '</p>' ;
		echo '<p><b> '.__l('my_form_fname').' : </b>' . $user->{m_user::COLUMN_FIRST_NAME} . '</p>' ;
		echo '<p><b> '.__l('my_form_lname').' : </b>' . $user->{m_user::COLUMN_LAST_NAME} . '</p>' ;
		echo '<p><b> '.__l('my_form_level').' : </b>' . $this->m_user->getLevelName($user->{m_user::COLUMN_LEVEL}) . '</p>' ;
		echo '<p><b> '.__l('my_form_email').' : </b>' . $user->{m_user::COLUMN_EMAIL} . '</p>' ;
		echo '<p><b> '.__l('my_form_gender').' : </b>' . $this->m_user->getGenderName($user->{m_user::COLUMN_GENDER}) . '</p>' ;
		echo '<p><b> '.__l('my_form_tel').' : </b>' . $user->{m_user::COLUMN_TEL} . '</p>' ;
		echo '<p><b> '.__l('my_form_mobile').' : </b>' . $user->{m_user::COLUMN_MOBILE} . '</p>' ;
		echo '<p><b> '.__l('my_form_address').' : </b>' . $user->{m_user::COLUMN_ADDRESS} . '</p>' ;
		?>
		</div>

</div>
<hr />


</div>
</div>
