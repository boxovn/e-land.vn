<footer>
                                <div class="footer">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 co-xl-6 col-xxl-6 col-info">
                                                <a href="#"><img class="img-logo" src="<?php echo Yii::$app->getUrlManager()->baseUrl?>/e-land/img/logo.png"/></a>
                                                <div class="address"><?php echo $about->address;?></div>
                                                <div class="hot-line">Tổng đài CSKH: <?php echo $about->phone;?></div>
                                                <div class="hotro">Hỗ trợ khách hàng: <?php echo $about->phone_security;?></div>
                                                <div class="security">Báo lỗi bảo mật <?php echo $about->email_security;?></div>
                                            </div>
                                            <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 co-xl-6 col-xxl-6 col-category">
                                                <div class="row row-category">
                                                    <div class="col">
                                                        <h3 class="title">Về E-land</h3>
                                                        <ul> 
                                                            <li><a href="<?php echo yii::$app->urlManager->createUrl(['about/index']) ?>"> Giới thiệu</a></li>
                                                            <li><a href="<?php echo yii::$app->urlManager->createUrl(['recruitment/index']) ?>"> Tuyển dụng </a></li>
                                                            <li><a href="<?php echo yii::$app->urlManager->createUrl(['contact/index']) ?>"> Liên hệ </a></li>
                                                            <li><a href="<?php echo yii::$app->urlManager->createUrl(['privacy-policy/index']) ?>"> Chính sách bảo mật </a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="col">
                                                        <h3 class="title">Các dịch vụ tại E-land</h3>
                                                        <ul> 
                                                            <li><a href="https://e-land.vn/ky-gui-nha-dat"> Gửi BDS miễn phí</a></li>
                                                            <li><a href="https://thongtinquyhoach.hochiminhcity.gov.vn/ban-do-quy-hoach"> Thông tin quy hoạch </a></li>
                                                            <li><a href="#"> Tư vấn định giá BDS </a></li>
                                                            <li><a href="#"> Thủ tục vay mua nhà </a></li>
                                                            <li><a href="#"> Đảm bảo thanh toán qua ngân hàng </a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="col">
                                                        <h3 class="title">Hệ thống E-land</h3>
                                                        <ul> 
                                                            <li><a href="<?php echo yii::$app->urlManager->createUrl(['article/index']) ?>"> Mua bán</a></li>
                                                            <li><a href="<?php echo yii::$app->urlManager->createUrl(['rent/index']) ?>"> Thuê nhà </a></li>
                                                            <li><a href="<?php echo yii::$app->urlManager->createUrl(['project/index']) ?>"> Dự án </a></li>
                                                            <li><a href="https://chat.e-land.vn/home?sender_id=37876"> Cộng đồng môi giới E-land</a></li>
                                                            
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row row-connect">
                                            <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                                                <div class="download-text"> Tải app ngay</div>
                                                <a href="javascript:void(0)" onclick="alert('App đang trong quá trình phát triển. Mọi ý kiến đống góp xin liên hệ qua số điện thoại 05-9696-234');">
                                                <img src="<?php echo Yii::$app->getUrlManager()->baseUrl?>/e-land/img/download-appstore.png"/>
                                                </a>
                                                <a   href="javascript:void(0)" onclick="alert('App đang trong quá trình phát triển. Mọi ý kiến đống góp xin liên hệ qua số điện thoại 05-9696-234');">
                                                <img src="<?php echo Yii::$app->getUrlManager()->baseUrl?>/e-land/img/download-googleplay.png"/>
                                                </a>
                                            </div>
                                            <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                                                <div class="row row-submit">
                                                    <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6"> 
                                                        <div class="register-email">Đăng ký nhận tin mới nhất từ E-land</div>
                                                        <div class="input-group-register-email input-group input-group-lg">
                                                        <input type="text" class="form-control" placeholder="Nhập email để nhận thông tin" aria-label="Nhập email để nhận thông tin" aria-describedby="button-addon2">
                                                        <button class="btn btn-register-email btn-outline-secondary" type="button" id="button-addon2">
                                                        <img src="<?php echo Yii::$app->getUrlManager()->baseUrl?>/e-land/img/icon-sendarrow.png">
                                                    </button>
                                                    </div>
                                                    </div>
                                                    <div class="col col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-cocial">
                                                        <div class="social-text">Kết nối với chúng tôi</div>
                                                        <a class="link-light" target="_blank" href="<?php echo $about->facebook;?>" >
                                                            <img src="<?php echo Yii::$app->getUrlManager()->baseUrl?>/e-land/img/social (1).png"/>
                                                        </a>
                                                        <a class="link-light" target="_blank" href="<?php echo $about->zalo;?>" >
                                                        <img src="<?php echo Yii::$app->getUrlManager()->baseUrl?>/e-land/img/social (2).png"/>
                                                        </a>
                                                        
                                                            <a class="link-light" target="_blank" href="<?php echo $about->youtube;?>" >
                                                                <img src="<?php echo Yii::$app->getUrlManager()->baseUrl?>/e-land/img/social (4).png"/>
                                                            </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="copyright">
                                    <p class="text-white">
                                        2021 @ Copyright E-land. All rights reserved.
                                     </p>
                                </div>
                            </footer>