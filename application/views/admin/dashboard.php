<div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row col-lg-9">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            داشبورد
                        </h1>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-9">
                        <div class="alert alert-info">
                            <i class="fa fa-star"></i>  سلام <?php echo $user_fullname ?>
                        </div>
                    </div>
                </div>

                <!-- /.row -->
				<div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-print fa-4x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"> <?php echo $qpage_count . ' / ' . $my_qpage_count ?></div>
                                        <div>برگه سوال ثبت شده توسط شما</div>
                                    </div>
                                </div>
                            </div>
                            <a href="<?php echo site_url('admin/dash_question/qpage_list/' . $user_id ) ?>">
                                <div class="panel-footer">
                                    <span class="pull-left">مشاهده لیست برگه سوال</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-purple">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-question fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"> <?php echo $question_count . ' / ' . $my_question_count ?></div>
                                        <div>سوال ثبت شده توسط شما</div>
                                    </div>
                                </div>
                            </div>
                            <a href="<?php echo site_url('admin/dash_question/add_qpage') ?>">
                                <div class="panel-footer">
                                    <span class="pull-left">ثبت برگه سوال جدید</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-book fa-4x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge"> <?php echo $lesson_count . ' / ' . $my_lesson_count ?></div>
                                        <div>درس ثبت شده توسط شما</div>
                                    </div>
                                </div>
                            </div>
                            <a href="<?php echo site_url('admin/dash_lesson/lesson_list/' . $user_id) ?>">
                                <div class="panel-footer">
                                    <span class="pull-left">مشاهده لیست دروس</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>

                    </div>
                </div>
                <!-- /.row -->
                
                <div class="row col-md-12 col-lg-9">
                    <div class="col-md-8">
                        <hr/>
                        <h3>جدول تایپیست ها <small>بر اساس تعداد برگه سوال تایپ شده</small></h3>
                        <table class="datatable_without_pagin table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                        <?php echo $table?>
                        </table>
                    </div>

                    <div class="col-md-4">
                        <hr/>
                        <h3>دانلود فیلم اموزشی</h3>
                        <table class="datatable_without_pagin table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                        <?php echo $vids_table?>
                        </table>
                    </div>
                </div>
</div>