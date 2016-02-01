<!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo site_url('admin/dashboard') ?>">سیستم دانشجو یار</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-left top-nav">
                
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $user_fullname; ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="<?php echo site_url('admin/dash_user/profile') ?>"><i class="fa fa-fw fa-user"></i> پروفایل</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="<?php echo site_url('admin/dashboard/logout') ?>"><i class="fa fa-fw fa-power-off"></i> خارج شدن</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                
                <?php 
                    $text = ' active ' ;
                    foreach ($menu as $key => $value) {
                        echo '<li>' ;
                        
                        if(isset($value['submenu']) ) {
     
                            echo '<a href="javascript:;" data-toggle="collapse" data-target="#'. $key .'"><i class="'. $value['icon'] .'"></i> '. $value['label'] .' <i class="fa fa-fw fa-caret-down"></i></a>' ;
                            echo       '<ul id="'. $key .'" class="collapse">' ;
                            foreach ($value['submenu'] as $key => $value) {
                                            echo '<li>' ;
                                            echo '<a href="'. site_url( $value['address'] ) .'"><i class="'. $value['icon'] .'"></i> '. $value['label'] .'</a>' ;
                                            $text = '' ;
                                            echo '</li>' ;
                            }            
                            echo        '</ul>' ;
                            
                        }else{
                            echo '<a href="'. site_url( $value['address'] ) .'"><i class="'. $value['icon'] .'"></i> '. $value['label'] .'</a>' ;
                        }

                        echo '</li>' ;
                    }

                ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>