<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo Yii::$app->params['url-page'] . 'channels/avatar/' . $user->image;?>"
                    onerror="if (this.src != 'error.jpg') this.src ='<?php echo Yii::$app->params['url-page'];?>images/no-image200x200.png';"
                    style="border:1px solid #ddd" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?php echo $user->name;?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">

            <li data-link="homepage">
                <a href="<?php echo yii::$app->urlManager->baseUrl?>/index.php">
                    <i class="fa fa-home"></i>
                    <span>Trang chủ</span>
                </a>
            </li>
            <li class="header">MAIN NAVIGATION</li>
            <!--<li data-link="meta" class="<?php echo (Yii::$app->request->get('menu') == 'article') ? 'active' : '' ?>">
                        <a href="<?php echo yii::$app->urlManager->createUrl(['article/index','menu' => 'article'])?>">
                            <i class="fa fa-building"></i>
                            <span>Bài đăng</span>
                        </a>
                    </li> -->
            <li data-link="meta" class="<?php echo (Yii::$app->request->get('menu') == 'partner') ? 'active' : '' ?>">
                <a href="<?php echo yii::$app->urlManager->createUrl(['partner/index','menu' => 'partner'])?>">
                    <i class="fa fa-building"></i>
                    <span>Đối tác</span>
                </a>
            </li>
            <!-- <li data-link="meta" class="<?php echo (Yii::$app->request->get('menu') == 'house') ? 'active' : '' ?>">
                        <a href="<?php echo yii::$app->urlManager->createUrl(['house/partner-index','menu' => 'house'])?>">
                            <i class="fa fa-building"></i>
                            <span>Nguồn nhà của đầu chủ</span>
                        </a>
                    </li>-->
            <li data-link="meta" class="<?php echo (Yii::$app->request->get('menu') == 'house') ? 'active' : '' ?>">
                <a href="<?php echo yii::$app->urlManager->createUrl(['house/index','menu' => 'house'])?>">
                    <i class="fa fa-building"></i>
                    <span>Nguồn nhà của tôi</span>
                </a>
            </li>
            <li data-link="meta" class="<?php echo (Yii::$app->request->get('menu') == 'article') ? 'active' : '' ?>">
                <a href="<?php echo yii::$app->urlManager->createUrl(['article/index','menu' => 'article'])?>">
                    <i class="fa fa-building"></i>
                    <span>Tin rao</span>
                </a>
            </li>
            <li data-link="meta" class="<?php echo (Yii::$app->request->get('menu') == 'post') ? 'active' : '' ?>">
                <a href="<?php echo yii::$app->urlManager->createUrl(['blog-post/index','menu' => 'post'])?>">
                    <i class="fa fa-building"></i>
                    <span>Tin tức</span>
                </a>
            </li>
            <li data-link="meta" class="<?php echo (Yii::$app->request->get('menu') == 'project') ? 'active' : '' ?>">
                <a href="<?php echo yii::$app->urlManager->createUrl(['project/index','menu' => 'project'])?>">
                    <i class="fa fa-building"></i>
                    <span>Dự án</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>