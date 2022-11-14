 <?php 
use yii\helpers\Html;
use yii\widgets\ActiveForm;
 ?>
 <!--====== PRELOADER PART START ======-->

    <div class="preloader">
        <div class="spin">
            <div class="cube1"></div>
            <div class="cube2"></div>
        </div>
    </div>

    <!--====== PRELOADER PART START ======-->

    <!--====== HEADER PART START ======-->

    <header class="header-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg">
                        <a class="navbar-brand" href="\">
                            <img src="page/landing/images/logo.png" alt="Logo">
                        </a>
                        <!-- Logo -->
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="bar-icon"></span>
                            <span class="bar-icon"></span>
                            <span class="bar-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul id="nav" class="navbar-nav ml-auto">
                                <li class="nav-item active">
                                    <a data-scroll-nav="0" href="#ky-gui">Ký gửi nhà đất</a>
                                </li>
											<li class="nav-item">
                                    <a data-scroll-nav="0" href="#gioi-thieu">Giới thiệu</a>
                                </li>
                                <li class="nav-item">
                                    <a data-scroll-nav="0" href="#bang-gia">Bảng giá</a>
                                </li>
                                <li class="nav-item">
                                    <a data-scroll-nav="0" href="#ho-chi-minh">Hồ Chí Minh</a>
                                </li>
                                <li class="nav-item">
                                    <a data-scroll-nav="0" href="#ha-noi">Hà Nội</a>
                                </li>
                                <li class="nav-item">
                                    <a data-scroll-nav="0" href="#toan-quoc">Toàn quốc</a>
                                </li>
                                <li class="nav-item-btn">
                                    <a data-scroll-nav="0" href="#lien-he"><button class="main-btn">Liên hệ</button></a>
                                </li>

                            </ul>
                            <!-- navbar nav -->
                        </div>
                    </nav>
                    <!-- navbar -->
                </div>
            </div>
            <!-- row -->
        </div>
        <!-- container -->
    </header>

    <!--====== HEADER PART ENDS ======-->

    <!--====== SECTION1 PART START ======-->
    <section id="ky-gui" class="slider-area pt-100">
        <div class="container position-relative">
            <div class="row">
                <div class="col-lg-12">

                </div>

            </div>
        </div>
        <div class="hero-ctn pt-100">
            <div class="left-ctn">
                <h2>Ký gửi nhà đất</h2>
                <p>Nhanh chóng tiện lợi</p>
                <div class="sec1-form-ctn">
                    <?php  $form = ActiveForm::begin() ?>
                   
         <?php
        foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
            echo '<div style="font-size: 12px; padding:5px;" class="alert alert-' . $key . '"><small>' . $message . '</small></div>';
        }
        ?>
    <?= $form->field($model, 'name', ['template' => '<div class="single-form form-group">{label}{input}{error}</div>'])->textInput(['placeholder'=>'Họ tên*'])->label(false) ?>
    <?= $form->field($model, 'phone', ['template' => '<div class="single-form form-group">{label}{input}{error}</div>'])->textInput(['placeholder'=>'Điện thoại*'])->label(false) ?>
    <?= $form->field($model, 'address', ['template' => '<div class="single-form form-group">{label}{input}{error}</div>'])->textInput(['placeholder'=>'Địa chỉ*'])->label(false) ?> 
    <?= $form->field($model, 'email', ['template' => '<div class="single-form form-group">{label}{input}{error}</div>'])->textInput(['placeholder'=>'Email'])->label(false) ?>
    <?= $form->field($model, 'description', ['template' => '<div class="single-form form-group">{label}{input}{error}</div>'])->textArea(['placeholder'=>'Nhập thông tin chi tiết cần ký gửi'])->label(false) ?>             
 <div class="sep"></div>
        
                 
                </div>
                <div class="cta-form-ctn center">
                   <button type="submit" class="main-btn">Đăng ký ngay</button>
                </div>
               <?= $form->errorSummary($model,['header' => '']) ?>

                <?php ActiveForm::end() ?>
            </div>

        </div>
        <div class="right-ctn pt-100">
            <div class="img-ctn"><img src="./page/landing/images/unnamed.png" alt=""></div>

        </div>
        <!-- container fluid -->
    </section>

    <!--====== SECTION1 PART ENDS ======-->

    <!--====== INTRO PART START ======-->
    <section id="gioi-thieu" class="intro pt-100">
        <div class="intro-container">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="intro-content">
                            <p>
                                Với hơn 15 năm kinh nghiệm làm nghề ký gửi nhà đất, <a href="#"> E-land.vn</a> đã có hơn 2.375 khách hàng đã và đang sử dụng dịch vụ ký gửi của chúng tôi và tất cả khách hàng điều hài lòng về phong cách phục vụ cũng như
                                sự hiệu quả của việc ký gửi mang lại. </p><br>
                            <p> Hiện nay, Công ty chúng tôi có rất nhiều Khách hàng có nhu cầu tìm Mua & Bán: Đất nền, Đất thổ cư, Đất nền dự án, Đất xây dựng nhà xưởng, Nhà kho, Nhà xưởng, Nhà cho thuê, Văn phòng cho thuê, Mặt bằng cho thuê, Nhà cấp 4, Nhà
                                trọ, Nhà nghỉ, Khách sạn, Resort…tại các quận trong TP.Hồ Chí Minh cũng như các khu vực lân cận. Ngoài ra <a href="#"> E-land.vn</a> còn tư vấn đầu tư, hỗ trợ pháp lý, đo vẽ, thiết kế, xây dựng, hợp thức hóa nhà đất cho
                                khách hàng.
                            </p>
                            <h5>
                                Dịch vụ Ký gửi nhà đất uy tín
                            </h5>
                            <p>
                                <a href="#"> E-land.vn</a> là công ty chuyên nghiệp trong lĩnh vực môi giới bất động sản, chúng tôi làm việc trên tinh thần hợp tác lâu dài và minh bạch giúp Người Bán nhanh chóng bán được bất động sản theo giá mình mong
                                muốn thỏa thuận trực tiếp với Người Mua trên phạm vi Toàn Cầu mà không bị môi giới tự do đẩy giá quá cao dẫn đến khó bán, thậm chí không thể bán được. <br>
                                <a href="#"> E-land.vn</a> đã phát triển dịch vụ ký gửi nhà đất để giúp người bán nhà, cho thuê bất động sản một cách <strong>NHANH CHÓNG và HIỆU QUẢ NHẤT</strong> .<br> Chúng tôi cam kết <strong>"Không kê giá bán - Mua bán Chính Chủ - Pháp lý hoàn thiện".</strong>
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====== INTRO PART ENDS ======-->
    <!--====== PRICE PART START ======-->
    <section id="gia" class="price pt-100">
        <div class="price-container">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="price-content">
                            <div class="price-title pb-50">
                                <h3>Bảng giá ký gửi nhà đất</h3>
                                <span><div class="line"></div></span>
                                <p>Bảng giá chỉ mang tính chất tham khảo, chúng tôi sẽ gửi báo giá chính xác sau khi xem tình hình thực tế bất động sản ký gửi.</p>
                            </div>
                            <div class="price-detail " data-aos="fade-up">
                                <div class="price-item">
                                    <div class="item-title">
                                        KÝ GỬI BÁN NHÀ
                                    </div>
                                    <div class="item-ct">
                                        <a class="title-bold " href="#">
                                            Giá trị bất động sản
                                        </a>
                                        <a class="title-bold title-gray" href="#">
                                            < 2 tỷ <br><span> Phí Môi Giới: 20 Triệu/Giao Dịch</span>
                                        </a>
                                        <a class="title-bold" href="#">
                                            < 3 tỷ <br><span> Phí Môi Giới: 25 Triệu/Giao Dịch</span>
                                        </a>
                                        <a class="title-bold title-gray" href="#">
                                            > 3 tỷ
                                            <br><span>Phí Môi Giới: 1% /Giao Dịch</span>
                                        </a>
                                        <p>Không bao gồm phí làm thủ tục giấy tờ.</p>
                                    </div>
                                </div>
                                <div class="price-item">
                                    <div class="item-title">
                                        KÝ GỬI BÁN ĐẤT
                                    </div>
                                    <div class="item-ct">
                                        <a class="title-bold" href="#">
                                            Giá trị bất động sản
                                        </a>
                                        <a class="title-bold title-gray" href="#">
                                            < 1 tỷ <br><span> Phí Môi Giới: 15 Triệu/Giao Dịch</span>
                                        </a>
                                        <a class="title-bold" href="#">
                                            < 2 tỷ <br><span>Phí Môi Giới: 1,5%/Giao Dịch</span>
                                        </a>
                                        <a class="title-bold title-gray" href="#">
                                            > 2 tỷ <br><span>Phí Môi Giới: 2% /Giao Dịch</span>
                                        </a>
                                        <p>Không bao gồm phí làm thủ tục giấy tờ.</p>
                                    </div>
                                </div>
                                <div class="price-item">
                                    <div class="item-title">
                                        KÝ GỬI CHO THUÊ
                                    </div>
                                    <div class="item-ct">
                                        <a class="title-bold" href="#">
                                            Thời gian ký hợp đồng
                                        </a>
                                        <a class="title-bold title-gray" href="#">
                                            6 tháng <br><span>Phí Môi Giới: 1/2 tháng thuê</span>
                                        </a>
                                        <a class="title-bold" href="#">
                                            1 năm <br><span>Phí Môi Giới: 2/3 tháng thuê</span>
                                        </a>
                                        <a class="title-bold title-gray" href="#">
                                            2 năm <br><span>Phí Môi Giới: 1 tháng thuê</span>
                                        </a>
                                        <p>Không bao gồm phí làm thủ tục giấy tờ.</p>
                                    </div>
                                </div>
                                <div class="price-item">
                                    <div class="item-title">
                                        KÝ GỬI ĐẶC BIỆT
                                    </div>
                                    <div class="item-ct">
                                        <a class="title-bold" href="#">
                                            Cam kết thời hạn
                                        </a>
                                        <a class="title-bold title-gray" href="#">
                                            Ký gửi bán nhà <br><span>3 tháng/ 5 triệu + phí gửi x2</span>
                                        </a>
                                        <a class="title-bold" href="#">
                                            Ký gửi bán đất<br><span>3 tháng/ 5 triệu + phí gửi x2</span>
                                        </a>
                                        <a class="title-bold title-gray" href="#">
                                            Ký gửi cho thuê <br><span>3 tháng/ 2 triệu + phí gửi x2</span>
                                        </a>
                                        <p>Không bao gồm phí làm thủ tục giấy tờ.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="price-btn-ctn">
                            <button class="second-btn">ký gửi ngay</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====== PRICE PART ENDS ======-->

    <!--====== REASON PART START ======-->
    <section id="REASON" class="reason pt-100">
        <div class="reason-container">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="reason-content">
                            <div class="reason-title pb-50">
                                <h3>Tại sao lại chọn dịch vụ ký gửi bất động sản của chúng tôi?</h3>
                                <span><div class="line"></div></span>
                                <p>Dịch vụ ký gửi nhà đất của công ty chúng tôi đem đến giá trị thực cho khách hàng với chính sách hoa hồng thấp, thủ tục chuyển nhượng nhanh chóng và tiện lợi nhất. Chúng tôi làm việc với phương châm "Hiệu quả - An toàn -
                                    Uy tín - Chi phí thấp"</p>
                            </div>
                            <div class="reason-detail">
                                <div class="reason-item">
                                    <img src="./page/landing/images/procedure.png" alt="">
                                    <div class="item-title">
                                        Thủ tục ký gửi đơn giản
                                    </div>
                                    <div class="item-ct">
                                        <p>Chỉ cần bạn gởi thông tin ký gửi bất động sản cho chúng tôi, Còn lại chúng tôi sẽ lo từ A-Z, bạn chỉ việc chờ khách ký hợp đồng mua bán và nhận tiền.</p>
                                    </div>
                                </div>
                                <div class="reason-item">
                                    <img src="./page/landing/images/shield.png" alt="">
                                    <div class="item-title">
                                        Bảo mật thông tin khách hàng
                                    </div>
                                    <div class="item-ct">
                                        <p>Trong suốt quá trình ký gửi chúng tôi luôn đảm bảo thông tin khách hàng luôn bảo mật tuyệt đối, không gây ảnh hưởng đến đời tư, công việc của khách hàng.</p>
                                    </div>
                                </div>
                                <div class="reason-item">
                                    <img src="./page/landing/images/business.png" alt="">
                                    <div class="item-title">
                                        Tiết kiệm chi phí tối đa
                                    </div>
                                    <div class="item-ct">
                                        <p>Bạn chỉ trả % như thỏa thuận khi ký hợp đồng môi giới mà không mất thêm bất kỳ chi phí nào nữa. bạn không sợ bị kê giá bán, chi phí phát sinh khi làm thủ tục...</p>
                                    </div>
                                </div>
                                <div class="reason-item">
                                    <img src="./page/landing/images/greenhouse.png" alt="">
                                    <div class="item-title">
                                        Hiệu quả ngoài sự mong đợi
                                    </div>
                                    <div class="item-ct">
                                        <p>"Có khách hàng đồng ý MUA rồi ah!, tôi chỉ mới ký gửi được có 7 ngày?" là câu nói của khách hàng sau khi đã sử dụng dịch vụ ký gửi trong 30 ngày của chúng tôi.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====== REASON PART ENDS ======-->
    <!--====== CONTACT PART START ======-->
    <section id="lien-he" class="contact pt-100 pb-100">
        <div class="contact-container">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="contact-content">
                            <h3>Hãy liên hệ với chúng tôi ngay hôm nay</h3>
                            <p>"Để sản phẩm ký gửi của bạn<br> được bán ra nhanh nhất với giá tốt nhất"</p>
                            <div class="contact-btn-ctn">
                                <button class="second-btn">Ký gửi ngay</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====== CONTACT PART ENDS ======-->

    <!--====== STEPS PART START ======-->
    <section id="step" class="step pt-100">
        <div class="step-container">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="step-content">
                            <div class="step-title pb-50">
                                <h3>Các bước nhận ký gửi</h3>
                                <span><div class="line"></div></span>

                            </div>
                            <div class="step-detail">
                                <div class="step-item">

                                    <div class="item-title">
                                        <a href="#">1. Tiếp nhận yêu cầu ký gửi bất động sản</a>
                                    </div>
                                    <div class="item-ct">
                                        <p>Điền thông tin liên hệ vào form bên cạnh.<br> Nội dung gửi bao gồm:<br> + Loại nhà đất, diện tích, giá bán...<br> + Hướng nhà, số tầng, số phòng [khách-ngủ-bếp]... <br><br>- Cung cấp ảnh chụp thực tế sản phẩm. <br>-
                                            Bản photo giấy chứng nhận quyền sử dụng đất. <br>- Bản photo các tài sản gắn liền với sản phẩm ký gửi.</p>
                                    </div>
                                </div>
                                <div class="step-item">

                                    <div class="item-title">
                                        <a href="#">2. Báo giá dịch vụ & ký hợp đồng môi giới</a>
                                    </div>
                                    <div class="item-ct">
                                        <p>- Xử lý & Phân loại sản phẩm ký gửi.<br> - Báo giá dịch vụ ký gửi dựa trên giá trị sản phẩm.<br> - Ký hợp đồng môi giới dựa trên thỏa thuận hai bên.</p>
                                    </div>
                                </div>
                                <div class="step-item">

                                    <div class="item-title">
                                        <a href="#">3. Tìm kiếm & Chốt giá với khách hàng</a>
                                    </div>
                                    <div class="item-ct">
                                        <p>- Xây dựng kế hoạch Marketing, tìm kiếm khách hàng.<br> - Dẫn khách hàng tới xem trực tiếp sản phẩm ký gửi.<br> - Báo giá & tư vấn các thủ tục pháp lý.</p>
                                    </div>
                                </div>
                                <div class="step-item">
                                    <div class="item-title">
                                        <a href="#">4. Bàn giao Giấy tờ nhà & Nhận Hoa Hồng</a>
                                    </div>
                                    <div class="item-ct">
                                        <p>- Hộ trợ làm giấy tờ nhà đất cho khách hàng.<br> - Nhận Hoa Hồng Môi giới khi giao dịch thành công.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--====== STEPS PART ENDS ======-->

    <!--====== FOOTER PART START ======-->
    <footer class="footer-area">
        <div class="container">
            <div class="footer-widget pt-50 pb-50">
                <div class="row">
                    <div class="col-md-12">
                        <div class="ft-content">
                            <div class="col-item">
                                <div class="footer-logo ">
                                    <a href="#">
                                        <img src="page/landing/images/white-logo.png" alt="Logo">
                                    </a>
                                    <div class="ft-left-ctn">
                                        <p class="mt-10 bold-p">Dịch vụ ký gửi nhà đất</p>
                                        <p>Miễn phí, bảo mật, uy tín, hiệu quả!</p>
                                    </div>
                                    <p class="phone-ft"><a href="tel:+84359696234">0359696234</a></p>

                                </div>
                                <!-- footer logo -->
                            </div>
                            <div class="col-item">
                                <div class="footer-link mt-50">
                                    <ul>
                                        <li><a href="#">Ký gửi nhà đất Thủ Đức</a></li>
                                        <li><a href="#">Ký gửi nhà đất Quận 9</a></li>
                                        <li><a href="#">Ký gửi nhà đất Bình Thạnh</a></li>
                                        <li><a href="#">Ký gửi nhà đất Phú Nhuận</a></li>
                                        <li><a href="#">Ký gửi nhà đất Gò Vấp</a></li>
                                        <li><a href="#">Ký gửi nhà đất Tân Bình</a></li>
                                    </ul>
                                </div>
                                <!-- footer link -->
                            </div>
                            <div class="col-item">
                                <div class="footer-link mt-50">
                                    <ul>
                                        <li><a href="#">Ký gửi nhà đất Quận 8</a></li>
                                        <li><a href="#">Ký gửi nhà đất Quận 2</a></li>
                                        <li><a href="#">Ký gửi nhà đất Quận 4</a></li>
                                        <li><a href="#">Ký gửi nhà đất Quận 5</a></li>
                                        <li><a href="#">Ký gửi nhà đất Quận 6</a></li>
                                        <li><a href="#">Ký gửi nhà đất Quận 11</a></li>
                                    </ul>
                                </div>
                                <!-- footer link -->
                            </div>
                            <div class="col-item">
                                <div class="footer-link mt-50">
                                    <ul>
                                        <li><a href="#">Ký gửi nhà đất Bình Tân</a></li>
                                        <li><a href="#">Ký gửi nhà đất Quận 1</a></li>
                                        <li><a href="#">Ký gửi nhà đất Quận 3</a></li>
                                        <li><a href="#">Ký gửi nhà đất Quận 10</a></li>
                                        <li><a href="#">Ký gửi nhà đất Quận 7</a></li>
                                    </ul>
                                </div>
                                <!-- footer link -->
                            </div>
                            <div class="col-item">
                                <div class="footer-link mt-50">
                                    <ul>
                                        <li><a href="#">Ký gửi nhà đất Quận 12</a></li>
                                        <li><a href="#">Ký gửi nhà đất Tân Phú</a></li>
                                        <li><a href="#">Ký gửi nhà đất Củ Chi</a></li>
                                        <li><a href="#">Ký gửi nhà đất Nhà Bè</a></li>
                                        <li><a href="#">Ký gửi nhà đất Hóc Môn</a></li>
                                    </ul>
                                </div>
                                <!-- footer link -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- row -->
            </div>
            <!-- footer widget -->
            <!--  footer copyright -->
        </div>
    </footer>
    <section id="footer" class="footer-area">

        <!-- container -->
    </section>

    <!--====== FOOTER PART ENDS ======-->

    <!--====== BACK TO TOP PART START ======-->

    <a href="#" class="back-to-top"><i class="lni-chevron-up"></i></a>

    