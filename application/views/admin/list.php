<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div id="page-wrapper">
<div class="container col-md-10 col-lg-10 col-sm-10">
<h3><span class="glyphicon glyphicon-th-list"></span> <?php if(isset($title)) echo $title; else echo "بدون عنوان"?></h3>

<?php if(isset($message_info)):?>
<div class="alert alert-info"><?php echo $message_info?></div>
<?php endif;?>

<br>

<?php if(isset($add_url) && $add_url != NULL):?>
<a href="<?php if(isset($add_url)) echo $add_url; else echo "#"?>" class="btn btn-success pull-right"><span class="glyphicon glyphicon-plus-sign"></span> <?php echo __l('my_form_add_btn') ?> </a>
<?php endif;?>
<?php if(isset($info_url) && $info_url != NULL):?>
<a href="<?php if(isset($info_url)) echo $info_url; else echo "#"?>" class="btn btn-info pull-left"><span class="glyphicon glyphicon-info-sign"></span> <?php echo isset($info_text) ? $info_text : __l('my_form_info_btn') ?> </a>
<?php endif;?>


<table class="datatable table table-hover table-striped table-bordered" cellspacing="0" width="100%">
<?php echo $table?>
</table>

</div>
</div>