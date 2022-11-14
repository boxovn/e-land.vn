<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo Yii::$app->params['url-page'] . 'channels/avatar/' . (isset($user->image)?$user->image:'no-image.png');?>"
                    class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?php echo isset($user->name)?$user->name:'';?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <ul class="sidebar-menu">
            <li data-link="homepage">
                <a href="<?php echo yii::$app->urlManager->baseUrl?>/index.php">
                    <i class="fa fa-home"></i>
                    <span>Trang chủ</span>
                </a>
            </li>
            <li class="header"></li>
              <li data-link="meta" class="<?php echo (Yii::$app->request->get('menu_level') == 'menu_level') ? 'active' : '' ?>">
                <a href="<?php echo yii::$app->urlManager->createUrl(['card/index', 'menu_level' => 'menu_level'])?>">
                    <i class="fa fa-building"></i>
                    <span>Dịch vụ</span>
                </a>
            </li>
            <li class="header">
            </li>
            <li data-link="homepage" <?php echo (Yii::$app->request->get('menu_level') == 'page') ? 'class="active"' : '' ?>>
                <a href="<?php echo yii::$app->urlManager->createUrl(['index/index', 'menu_level' => 'page'])?>">
                    <i class="fa fa-home"></i>
                    <span>Quảng lý trang</span>
                </a>
                <ul class="treeview-menu" <?php echo (Yii::$app->request->get('menu_level') == 'page') ? 'style="display: block;"' : '' ?>>
                    <li>
                        <a
                            href="<?php echo yii::$app->urlManager->createUrl(['question/index','menu_level' => 'page'])?>">
                            <i class="fa fa-building"></i>
                            <span>Hỏi đáp</span>
                        </a>
                    </li>
                    <li>
                        <a
                            href="<?php echo yii::$app->urlManager->createUrl(['contact/index','menu_level' => 'page'])?>">
                            <i class="fa fa-building"></i>
                            <span>Đóng góp ý kiến</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo yii::$app->urlManager->createUrl(['about/index','menu_level' => 'page'])?>">
                            <i class="fa fa-building"></i>
                            <span>Giới thiệu</span>
                        </a>
                    </li>
                    <li>
                        <a
                            href="<?php echo yii::$app->urlManager->createUrl(['recruitment/index','menu_level' => 'page'])?>">
                            <i class="fa fa-building"></i>
                            <span>Tuyển dụng</span>
                        </a>

                    </li>
                    <li>
                        <a
                            href="<?php echo yii::$app->urlManager->createUrl(['privacy-policies/index','menu_level' => 'page'])?>">
                            <i class="fa fa-building"></i>
                            <span>Chính sách bảo mật</span>
                        </a>
                    </li>
                    <li>
                        <a
                            href="<?php echo yii::$app->urlManager->createUrl(['complain/index','menu_level' => 'page'])?>">
                            <i class="fa fa-building"></i>
                            <span>Chính sách khiếu nại</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo yii::$app->urlManager->createUrl(['rule/index','menu_level' => 'page'])?>">
                            <i class="fa fa-building"></i>
                            <span>Điều khoản</span>
                        </a>
                    </li>

                </ul>
            </li>

            <li class="header">
            </li>
            <li
                data-link="meta" <?php echo (Yii::$app->request->get('menu_level') == 'article') ? 'class="active"' : '' ?>>
                <a href="<?php echo yii::$app->urlManager->createUrl(['index/index', 'menu_level' => 'article'])?>">
                    <i class="fa fa-home"></i>
                    <span>Tin rao</span>
                </a>
                                <ul class="treeview-menu" <?php echo (Yii::$app->request->get('menu_level') == 'article') ? 'style="display: block;"' : '' ?>>
                                        <li class="<?php echo (Yii::$app->request->get('menu') == 'article') ? 'active' : '' ?>">
                                            <a  href="<?php echo yii::$app->urlManager->createUrl(['category-type/index', 'menu_level' => 'article'])?>">
                                                <i class="fa fa-building"></i>
                                                <span>Danh mục</span>
                                            </a>
                                        </li>
                                       
                                        <li class="<?php echo (Yii::$app->request->get('menu_level') == 'article') ? 'active' : '' ?>">
                                            <a href="<?php echo yii::$app->urlManager->createUrl(['article/index', 'menu_level' => 'article'])?>">
                                                <i class="fa fa-building"></i>
                                                <span>Tin rao bán</span>
                                            </a>
                                        </li>
                                        <li class="<?php echo (Yii::$app->request->get('menu_level') == 'article') ? 'active' : '' ?>">
                                            <a href="<?php echo yii::$app->urlManager->createUrl(['article/index', 'menu_level' => 'article'])?>">
                                                <i class="fa fa-building"></i>
                                                <span>Tin rao cho thuê</span>
                                            </a>
                                        </li>
                                </ul>
            </li>
            <li class="header">
            </li>

            <li
                data-link="meta" <?php echo (Yii::$app->request->get('menu_level') == 'project') ? 'class="active"' : '' ?>>
                <a href="<?php echo yii::$app->urlManager->createUrl(['index/index', 'menu_level' => 'project'])?>">
                    <i class="fa fa-home"></i>
                    <span>Quản lý dự án</span>
                </a>
                                <ul class="treeview-menu" <?php echo (Yii::$app->request->get('menu_level') == 'project') ? 'style="display: block;"' : '' ?>>
                                            <li data-link="meta" class="<?php echo (Yii::$app->request->get('menu') == 'project') ? 'active' : '' ?>">
                                                <a href="<?php echo yii::$app->urlManager->createUrl(['category/index', 'menu_level' => 'project'])?>">
                                                    <i class="fa fa-building"></i>
                                                    <span>Danh mục</span>
                                                </a>
                                            </li>
                                            <li data-link="project" class="<?php echo (Yii::$app->request->get('menu') == 'project') ? 'active' : '' ?>">
                                                <a href="<?php echo yii::$app->urlManager->createUrl(['project/index', 'menu_level' => 'project'])?>">
                                                    <i class="fa fa-building"></i>
                                                    <span>Dự án</span>
                                                </a>
                                            </li>
                                             <li data-link="project" class="<?php echo (Yii::$app->request->get('menu') == 'project') ? 'active' : '' ?>">
                                                <a href="<?php echo yii::$app->urlManager->createUrl(['building-project-info/index', 'menu_level' => 'project'])?>">
                                                    <i class="fa fa-building"></i>
                                                    <span>danh sach dự án </span>
                                                </a>
                                            </li>
                                            
                                    </ul>
            </li>
            <li class="header">
            </li>

            <li
                data-link="meta" <?php echo (Yii::$app->request->get('menu_level') == 'user') ? 'class="active"' : '' ?>>
                <a href="<?php echo yii::$app->urlManager->createUrl(['index/index', 'menu_level' => 'user'])?>">
                    <i class="fa fa-home"></i>
                    <span>Quảng lý người dùng</span>
                </a>
                <ul class="treeview-menu"
                    <?php echo (Yii::$app->request->get('menu_level') == 'page') ? 'style="display: block;"' : '' ?>>
                    <li data-link="meta"
                        class="<?php echo (Yii::$app->request->get('menu') == 'user') ? 'active' : '' ?>">
                        <a href="<?php echo yii::$app->urlManager->createUrl(['user/index', 'menu' => 'user'])?>">
                            <i class="fa fa-building"></i>
                            <span>Thành viên</span>
                        </a>
                    </li>
                    <li data-link="meta"
                        class="<?php echo (Yii::$app->request->get('menu') == 'customer') ? 'active' : '' ?>">
                        <a href="<?php echo yii::$app->urlManager->createUrl(['article-booking/index', 'menu' => 'customer'])?>">
                            <i class="fa fa-building"></i>
                            <span>Khách hàng đăng ký xem nhà</span>
                        </a>
                    </li>
                    <li data-link="meta"
                        class="<?php echo (Yii::$app->request->get('menu') == 'user') ? 'active' : '' ?>">
                        <a href="<?php echo yii::$app->urlManager->createUrl(['user/batdongsan', 'menu' => 'user'])?>">
                            <i class="fa fa-building"></i>
                            <span>Thành viên batdongsan.com.vn</span>
                        </a>
                    </li>
                    <li data-link="meta"
                        class="<?php echo (Yii::$app->request->get('menu') == 'user') ? 'active' : '' ?>">
                        <a
                            href="<?php echo yii::$app->urlManager->createUrl(['setting-cronjob-get-user/index', 'menu' => 'user'])?>">
                            <i class="fa fa-building"></i>
                            <span>Cài đặt cronjob</span>
                        </a>
                    </li>
                 
                    <li data-link="meta" class="<?php echo (Yii::$app->request->get('menu') == 'buyer') ? 'active' : '' ?>">
                <a href="<?php echo yii::$app->urlManager->createUrl(['buyer/index', 'menu' => 'buyer'])?>">
                    <i class="fa fa-building"></i>
                    <span>Khách mua</span>
                </a>
            </li>
            <li data-link="meta" class="<?php echo (Yii::$app->request->get('menu') == 'owner') ? 'active' : '' ?>">
                <a href="<?php echo yii::$app->urlManager->createUrl(['owner/index', 'menu' => 'owner'])?>">
                    <i class="fa fa-building"></i>
                    <span>Khách gửi</span>
                </a>
            </li>

                </ul>
            </li>

  <li class="header">
            </li>
            <li
                data-link="meta" <?php echo (Yii::$app->request->get('menu_level') == 'house') ? 'class="active"' : '' ?>>
                <a href="<?php echo yii::$app->urlManager->createUrl(['index/index', 'menu_level' => 'house'])?>">
                    <i class="fa fa-home"></i>
                    <span>Quảng lý nguồn nhà</span>
                </a>
                <ul class="treeview-menu" <?php echo (Yii::$app->request->get('menu_level') == 'house') ? 'style="display: block;"' : '' ?>>
                            <li data-link="meta" class="<?php echo (Yii::$app->request->get('menu_level') == 'house') ? 'active' : '' ?>">
                                <a href="<?php echo yii::$app->urlManager->createUrl(['house/index', 'menu_level' => 'house'])?>">
                                    <i class="fa fa-building"></i>
                                    <span>Nguồn nhà</span>
                                </a>
                            </li>
                            <li data-link="meta"
                                class="<?php echo (Yii::$app->request->get('menu_level') == 'house') ? 'active' : '' ?>">
                                <a href="<?php echo yii::$app->urlManager->createUrl(['house-info/index', 'menu_level' => 'house'])?>">
                                    <i class="fa fa-building"></i>
                                    <span>Sản phẩm nhà</span>
                                </a>
                            </li>

                </ul>
            </li>
          
            <li class="header">
            </li>

            <li
                data-link="meta" <?php echo (Yii::$app->request->get('menu_level') == 'product') ? 'class="active"' : '' ?>>
                <a href="<?php echo yii::$app->urlManager->createUrl(['index/index', 'menu_level' => 'product'])?>">
                    <i class="fa fa-home"></i>
                    <span>Quảng lý sản phẩm</span>
                </a>
                <ul class="treeview-menu" <?php echo (Yii::$app->request->get('menu_level') == 'product') ? 'style="display: block;"' : '' ?>>
                                        <li data-link="meta" class="<?php echo (Yii::$app->request->get('menu_level') == 'product') ? 'active' : '' ?>">
                                            <a href="<?php echo yii::$app->urlManager->createUrl(['order/index', 'menu_level' => 'product'])?>">
                                                <i class="fa fa-building"></i>
                                                <span>Đơn đặt hàng</span>
                                            </a>
                                        </li>
                                        <li data-link="meta" class="<?php echo (Yii::$app->request->get('menu_level') == 'product') ? 'active' : '' ?>">
                                            <a href="<?php echo yii::$app->urlManager->createUrl(['order-detail/index', 'menu_level' => 'product'])?>">
                                                <i class="fa fa-building"></i>
                                                <span>Đơn hàng chi tiết</span>
                                            </a>
                                        </li>
                                        <li data-link="meta" class="<?php echo (Yii::$app->request->get('menu_level') == 'product') ? 'active' : '' ?>">
                                            <a href="<?php echo yii::$app->urlManager->createUrl(['product/index', 'menu_level' => 'product'])?>">
                                                <i class="fa fa-building"></i>
                                                <span>Sản phẩm sách</span>
                                            </a>
                                        </li>
                                        <li data-link="meta" class="<?php echo (Yii::$app->request->get('menu_level') == 'product') ? 'active' : '' ?>">
                                            <a href="<?php echo yii::$app->urlManager->createUrl(['payment/index', 'menu_level' => 'product'])?>">
                                                <i class="fa fa-building"></i>
                                                <span>Hình thứ giao hàng</span>
                                            </a>
                                        </li>
                                        <li data-link="meta" class="<?php echo (Yii::$app->request->get('menu_level') == 'product') ? 'active' : '' ?>">
                                            <a href="<?php echo yii::$app->urlManager->createUrl(['delivery/index', 'menu_level' => 'product'])?>">
                                                <i class="fa fa-building"></i>
                                                <span>Hình thức thanh toán</span>
                                            </a>
                                        </li>
               </ul>
            </li>
            <li class="header">
            </li>

             <li
                data-link="meta" <?php echo (Yii::$app->request->get('menu_level') == 'province') ? 'class="active"' : '' ?>>
                <a href="<?php echo yii::$app->urlManager->createUrl(['index/index', 'menu_level' => 'province'])?>">
                    <i class="fa fa-home"></i>
                    <span>Quảng lý tỉnh thành</span>
                </a>
                <ul class="treeview-menu" <?php echo (Yii::$app->request->get('menu_level') == 'province') ? 'style="display: block;"' : '' ?>>
                                         <li data-link="meta" class="<?php echo (Yii::$app->request->get('menu_level') == 'province') ? 'active' : '' ?>">
                                            <a href="<?php echo yii::$app->urlManager->createUrl(['province/index', 'menu_level' => 'province'])?>">
                                                <i class="fa fa-building"></i>
                                                <span>Tỉnh thành</span>
                                            </a>
                                        </li>
                                        <li data-link="meta" class="<?php echo (Yii::$app->request->get('menu_level') == 'province') ? 'active' : '' ?>">
                                            <a href="<?php echo yii::$app->urlManager->createUrl(['district/index', 'menu_level' => 'province'])?>">
                                                <i class="fa fa-building"></i>
                                                <span>Quận/Huyện</span>
                                            </a>
                                        </li>
                                        <li data-link="meta" class="<?php echo (Yii::$app->request->get('menu_level') == 'province') ? 'active' : '' ?>">
                                            <a href="<?php echo yii::$app->urlManager->createUrl(['ward/index', 'menu_level' => 'province'])?>">
                                                <i class="fa fa-building"></i>
                                                <span>Phường/Xã</span>
                                            </a>
                                        </li>
                                        <li data-link="meta" class="<?php echo (Yii::$app->request->get('menu_level') == 'province') ? 'active' : '' ?>">
                                            <a href="<?php echo yii::$app->urlManager->createUrl(['street/index', 'menu_level' => 'province'])?>">
                                                <i class="fa fa-building"></i>
                                                <span>Đường</span>
                                            </a>
                                        </li>
                </ul>
            </li>

            <li class="header">
            </li>
            <li data-link="meta"
                        class="<?php echo (Yii::$app->request->get('menu') == 'user') ? 'active' : '' ?>">
                        <a
                            href="<?php echo yii::$app->urlManager->createUrl(['customer/index', 'menu' => 'customer'])?>">
                            <i class="fa fa-building"></i>
                            <span>Khách hàng mua Web</span>
                        </a>
                         <ul class="treeview-menu" <?php echo (Yii::$app->request->get('menu_level') == 'house') ? 'style="display: block;"' : '' ?>>

                            <li data-link="meta" class="<?php echo (Yii::$app->request->get('menu_level') == 'house') ? 'active' : '' ?>">
                                <a href="<?php echo yii::$app->urlManager->createUrl(['page/index', 'menu_level' => 'house'])?>">
                                    <i class="fa fa-building"></i>
                                    <span>Trang</span>
                                </a>
                            </li>
                            <li data-link="meta"
                                class="<?php echo (Yii::$app->request->get('menu_level') == 'house') ? 'active' : '' ?>">
                                <a href="<?php echo yii::$app->urlManager->createUrl(['customer/index', 'menu_level' => 'house'])?>">
                                    <i class="fa fa-building"></i>
                                    <span>Khách hàng</span>
                                </a>
                            </li>
                            <li data-link="meta"
                                class="<?php echo (Yii::$app->request->get('menu_level') == 'house') ? 'active' : '' ?>">
                                <a href="<?php echo yii::$app->urlManager->createUrl(['customer-info/index', 'menu_level' => 'house'])?>">
                                    <i class="fa fa-building"></i>
                                    <span>Thông tin khách hàng chi tiết</span>
                                </a>
                            </li>
                            <li data-link="meta"
                                class="<?php echo (Yii::$app->request->get('menu_level') == 'house') ? 'active' : '' ?>">
                                <a href="<?php echo yii::$app->urlManager->createUrl(['page_samples/index', 'menu_level' => 'house'])?>">
                                    <i class="fa fa-building"></i>
                                    <span>Mẫu web</span>
                                </a>
                            </li>

                        </ul>
            </li>
            <li class="header">
            </li>
            <li data-link="meta" class="<?php echo (Yii::$app->request->get('menu') == 'meta') ? 'active' : '' ?>">
                <a href="<?php echo yii::$app->urlManager->createUrl(['meta/index', 'menu' => 'meta'])?>">
                    <i class="fa fa-building"></i>
                    <span>Meta</span>
                </a>
            </li>
            <li class="header">
            </li>
            <?php

             if (!Yii::$app->user->isGuest && Yii::$app->user->identity->is_admin == 1) { ?>
            <li data-link="admin">
                <a href="<?php echo yii::$app->urlManager->createUrl(['admin/index'])?>">
                    <i class="fa fa-users"></i>
                    <span>Quản trị</span>
                </a>
            </li>
            <?php } ?>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>