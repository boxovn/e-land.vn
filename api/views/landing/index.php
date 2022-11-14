<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\widgets\LandingComment;
use common\libraries\CheckDevice;
$detect = new CheckDevice;

?>
<style>
    .timer_title{
         float:left;
        margin-right: 10px;
    }
    .timer {
        float:left;
    }
.timer .counter {
    margin-left: 10px;
    font-weight: bold;
    line-height: 1;
    text-align: right;
}
/* IE7 inline-block hack */
*+html .timer .counter{
    display: inline;
    zoom: 1;
}
.timer .counter:first-child {
    margin-left: 0;
}
.timer .title {
   padding-top: 3px;
       font-size: 12px;
    font-weight: bold;
  
    text-align: left;
}
.timer .day_wrapper, .timer .hour_wrapper, .timer .minute_wrapper, .timer .second_wrapper {
float: left;
text-align: center;
margin-right: 8px;
}
.timer.ended {
    background: #810014;
    color: #FFF;
    font-weight: bold;
    padding: 5px 0;
    text-align: center
}
.progressWrap {
position: relative;
height: 8px;
margin-bottom: 6px;
font-size: 1px;
margin-top: 20px;
    border-radius: 6px;
}
.progressWrap .fullbar {
position: absolute;
height: 6px;
width: 100%;
margin-top: 2px;
background-color: #ddd;

}
.progressWrap .progress {
position: absolute;
height: 6px;
background-color: #FF3B27;
margin-top: 2px;
border-top: 1px solid #FF3B27;
border-bottom: 1px solid #FF3B27;
border-left: 1px solid #FF3B27;
}
</style>


<script src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/js/jquery.countdown.js"></script>
<?php if($show && !$detect->isMobile()):?>
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <img style="width: 9%; cursor: pointer; height: 15%; position: absolute; top: 1%;right: 1%;" data-dismiss="modal"  src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/images/e-space-app-popup-close.png"/>
        <div style="width:600px; padding: 40px; color:#fff; font-weight: bold; height:360px; text-align: center; background-color: #009f00; border-radius: 20px;">
            <div>
					<img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/images/loading.gif" id="gif" class="loader" style="margin: 0px auto; left: 50%; position: absolute; top: 140px; display: none;z-index: 1;">
				
                <p style="font-size:18px; padding: 5px 0; margin-bottom:10px;">  <img style="position:relative; top:-10px; left:-5px;" src="/images/hot.gif">Nhận phiếu giảm giá</p>
                <p style="font-size:44px; padding: 10px 0;  margin-bottom:10px; font-weight: bold">Tặng 150.000VND </p>
                <div style="color:#333; padding: 10px 40px; height:160px; float:left; width:100%; opacity: 0.9; border-radius:10px; background-color: #fff; font-weight:bold; font-size: 12px; text-align:center">
					 <p style="color:red; margin-bottom: 0px; padding: 5px 0; background-color: #fff; font-weight:bold; font-size: 12px; text-align:center">  
                        Số lượng Voucher còn lại: <?php echo rand(10,100);?> phiếu
                    </p> 
                       <div class="timer_title"> Thời gian kết thúc sau</div>
                        <div class="timer deal1"></div>
                    
                    <div class="progressWrap">
                        <div class="fullbar"></div>
                        <div class="progress deal1" style="width:0%"></div>
                    </div>
                     
                            <input type="email" autofocus class="form-control " placeholder="Nhập Email" style="margin: 0px auto" name="email" id="email"/>
                            <button class="btn btn-danger" id="save-email" style="margin-top:10px">Nhận Voucher</button>
                       
                </div>
            </div>
             
        </div>
         
    </div>
</div>
<?php endif;?>
<script type="text/javascript">
    $('.timer.deal1').countdown({    
   end_time: '<?php echo date("Y/m/d H:i:s", strtotime("+1 week"));?>',//'2019/06/30 23:00:00', //Time Progress bar is at 100% and timer runs out
    start_time: '<?php echo date("Y/m/d H:i:s", strtotime("-1 month"));?>',//'2018/03/22 08:00:00', //Time when the progress bar is at 0%
    progress: $('.progress.deal1'), //There dom element which should display the progressbar.
       
    onComplete: function() {
                $('.timer.deal1').replaceWith("<div class=\"timer ended\">Kết thúc</div>");
    }    
});

</script>
<!--HEADER-->
<div class="header">

    <!--Main Navigation-->
    <nav class="main-nav navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">
                    <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/logo.png"/>
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
					 <li><a href="\">Trang chủ</a></li>
                    <li><a href="#number-section">Về E-SPACE</a></li>
                    <li><a href="#diff-section">Tại sao chọn E-SPACE</a></li>
                    <li><a href="#path-section">Chương trình học</a></li>
                    <li><a href="#price-section">Học phí</a></li>
                    <li class="apply"><a>Tổng đài CSKH 24/7:  1900-9485</a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>

</div>

<!--MAIN CONTENT-->
<div class="main-content">

    <!--HERO SECTION-->
    <div class="hero-section">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-6">
                    <div class="line01">
                        E-SPACE
                    </div>
                    <div class="line02">
                        Trung tâm Anh ngữ<br/>
                        trực tuyến 1 thầy 1 trò<br/>
                        đầu tiên tại Việt Nam
                    </div>
                    <div class="list">
                        <div><img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/icon-check-white.png" />Đảm bảo chất lượng trên từng buổi học</div>
                        <div><img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/icon-check-white.png" />Lộ trình học chuyên biệt</div>
                        <div><img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/icon-check-white.png" />Giáo viên ổn định, nhiều năm kinh nghiệm</div>
                    </div>
                </div>

                <div class="col-xs-12 col-md-6">
                     
  <?php  $form = ActiveForm::begin() ?>
                     <div class="text01">
                          Đăng ký ngay </div>
		 <?php
        foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
            echo '<div style="font-size: 12px; padding:5px;" class="alert alert-' . $key . '"><small>' . $message . '</small></div>';
        }
        ?>
    <?= $form->field($model, 'name', ['template' => '{label}{input}'])->textInput(['placeholder'=>'Họ và tên'])->label(false) ?>
    <?= $form->field($model, 'email', ['template' => '{label}{input}'])->textInput(['placeholder'=>'Email'])->label(false) ?>
     <?= $form->field($model, 'phone', ['template' => '{label}{input}'])->textInput(['placeholder'=>'Số điện thoại'])->label(false)->label(false) ?>
	                <?php echo $form->field($model, 'age_group', ['template' => '{label}{input}'])->dropDownList(array(1 =>'Tiếng anh cho người lớn',2=>'Tiếng anh cho trẻ em', 3 => 'Tiếng anh cho doanh nghiệp'))->label(false); ?>
              
   <?php $model->region = 1;
echo $form->field($model, 'region', [
         'options' => [
                    'tag' => false, // Don't wrap with "form-group" div
                ],
        'template' => '{input}{label}'])->radio(['label' => 'Miền Bắc', 'value' => 1, 'uncheck' => null]) ?>
<?= $form->field($model, 'region', [
     'options' => [
                    'tag' => false, // Don't wrap with "form-group" div
                ],
    'template' => '{input}{label}'])->radio(['label' => 'Miền Trung', 'value' => 2, 'uncheck' => null]) ?>
<?= $form->field($model, 'region', [
     'options' => [
                    'tag' => false, // Don't wrap with "form-group" div
                ],
    'template' => '{input}{label}'])->radio(['label' => 'Miền Nam', 'value' => 3, 'uncheck' => null]) ?>
 <div class="sep"></div>
          <?= Html::submitButton('Đăng ký để nhận buổi học miễn phí',['class'=>'submit']) ?>
                <?php echo $form->errorSummary($model, ['style' => 'margin-top: 5px; margin-bottom:0px; font-size: 12px; padding:5px;','class' => 'alert text-left alert-danger ', 'header' => '']) ?>
<?php ActiveForm::end() ?>
                  
                </div>
            </div>
        </div>
    </div>

    <!--NUMBER SECTION-->
    <div id="number-section" class="number-section">
        <div class="container">
            <div class="development">
                <div class="text01">+7</div>
                <div class="text02">năm phát triển</div>
                <div class="text03">
                    12/2012: Triển khai Chương trình đào tạo Tiếng Anh 1 thầy 1 trò đầu tiên tại Việt Nam từ E-space Nhật Bản
                </div>
                <div class="text03">
                    11/2014: Thành lập Công Ty TNHH E-SPACE Viet Nam
                </div>
                <div class="text03">
                    6/2017: Mở chi nhánh E-space Hà Nội
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-md-4">
                    <div class="box">
                        <div class="text01">+<?php echo number_format($count_teacher,0,',','.');?></div>
                        <div class="text02">giáo viên thường trực</div>
                        <div class="text03"><?php echo $teacherMore10;?>% GV trên 10 năm kinh nghiệm</div>
                        <div class="text03"><?php echo $teacherLess10;?>% GV 5 - 10 năm kinh nghiệm</div>
                    </div>
                </div>

                <div class="col-xs-12 col-md-4">
                    <div class="box">
                        <div class="text01">+<?php echo number_format($count_student,0,',','.');?></div>
                        <div class="text02">thành viên </div>
                        <div class="text03"><?php echo number_format($count_student_exchange,0,',','.');?> HV chính thức</div>
                        <div class="text03"><?php echo number_format($count_student_company,0,',','.');?> HV doanh nghiệp</div>
                    </div>
                </div>

                <div class="col-xs-12 col-md-4">
                    <div class="box">
                        <div class="text01">+<?php echo number_format($count_class,0,',','.');?></div>
                        <div class="text02">lớp học đã diễn ra</div>
                        <div class="text03"><?php echo number_format($count_class_month,0,',','.');?> lớp/tháng</div>
                        <div class="text03"><?php echo number_format($count_class_day,0,',','.');?> lớp/ngày</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--MIND SECTION-->
    <div class="mind-section">
        <div class="text">
            Thay đổi tư duy<br/>
            <span>học tiếng Anh thời 4.0!</span>
        </div>
    </div>

    <!--BENEFIT SECTION-->
    <div class="benefit-section">
        <div class="container">
            <div class="item">
                <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/icon-check-circle-green.png"/>
                <div class="text01">Ngồi nhà vẫn học tốt</div>
                <div class="text02">Bạn có thể học mọi lúc mọi nơi, ở bất kỳ đâu mà không cần đến trung tâm.</div>
            </div>

            <div class="item">
                <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/icon-check-circle-green.png"/>
                <div class="text01">Lớp học chỉ 1 học viên</div>
                <div class="text02">Một học viên đối thoại face to face với giáo viên, được giáo viên sửa lỗi liên tục suốt buổi học.</div>
            </div>

            <div class="item">
                <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/icon-check-circle-green.png"/>
                <div class="text01">Lịch học linh động</div>
                <div class="text02">Học viên có thể học vào bất cứ thời gian rảnh rỗi nào trong ngày từ 6h sáng đến 24h đêm. </div>
            </div>

            <div class="item">
                <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/icon-check-circle-green.png"/>
                <div class="text01">Giáo trình cá nhân hóa</div>
                <div class="text02">Giáo trình được biên soạn và chọn lọc của các NXB nổi tiếng: Oxford, Cambridge, Longman,... Phù hợp theo lộ trình học của từng học viên.</div>
            </div>
        </div>
    </div>

    <!--DIFF SECTION-->
    <div id="diff-section" class="diff-section">
        <div class="container">
            <div class="title">
                <span>E-SPACE có gì khác biệt</span><br/>
                so với các trung tâm trực tuyến<br/>
                1 thầy 1 trò khác
            </div>
            <div class="title-line"></div>

            <div class="row">
                <div class="col-xs-12 col-md-4">
                    <div class="item">
                        <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/icon-teacher.png"/>
                        <div>Học với bất kỳ giáo viên nào trong phạm vi Gói học</div>
                    </div>

                    <div class="item">
                        <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/icon-clock.png"/>
                        <div>Quản lý lịch học và nhắc giờ học trên Smartphone</div>
                    </div>

                    <div class="item">
                        <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/icon-switch.png"/>
                        <div> Chuyển đổi gói học giữa GV Bản Ngữ - GV Châu Á linh hoạt</div>
                    </div>
                </div>

                <div class="col-xs-12 col-md-4 visible-md visible-lg">
                    <img class="illus" src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/illus-student-boy-smile.jpg" />
                </div>

                <div class="col-xs-12 col-md-4">
                    <div class="item">
                        <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/icon-calendar.png"/>
                        <div>Hủy lịch học trước 2h không mất phí</div>
                    </div>

                    <div class="item">
                        <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/icon-app.png"/>
                        <div>Học trực tiếp trên App E-Space, không cần Skype</div>
                    </div>

                    <div class="item">
                        <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/icon-quality.png"/>
                        <div>Quản lý chất lượng từng buổi học</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<div>
		<img alt="Quy trình quản lý chất lượng 4.0" src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/images/e-space-chart.jpg" style="width: 100%; height: 100%;">
	</div>
    <!--PATH SECTION-->
    <div id="path-section" class="path-section">
        <div class="container">
            <div class="title">
                Lộ trình và giáo trình học<br/>
                <span>tinh gọn - logic nhất</span>
            </div>
            <div class="title-line"></div>

            <div class="row">
                <div class="col-xs-12 col-md-4">
                    <div class="box">
                        <div class="box-title">
                            Chương trình tiếng Anh
                            cho người lớn
                        </div>

                        <div class="box-sub-title">
                            TIẾNG ANH CHO NGƯỜI MẤT GỐC
                        </div>
                        <div class="item">
                            <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/icon-triangle-white.png"/>
                            <div><span>Khoá học đề xuất:</span> 30 tiết / 25 phút mỗi tiết.</div>
                        </div>
                        <div class="item">
                            <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/icon-triangle-white.png"/>
                            <div><span>Giáo trình đề xuất:</span> Person to Person starter, Side by Side, Headway,...</div>
                        </div>

                        <div class="box-sub-title">
                            TIẾNG ANH GIAO TIẾP
                        </div>
                        <div class="item">
                            <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/icon-triangle-white.png"/>
                            <div><span>Khoá học đề xuất:</span> 30 tiết / 50 phút mỗi tiết.</div>
                        </div>
                        <div class="item">
                            <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/icon-triangle-white.png"/>
                            <div><span>Giáo trình đề xuất:</span> Person to Person 1, Speak your mind, Communication-2, Business,..</div>
                        </div>

                        <a href="https://e-space.vn/lop-hoc-mau" class="button">Clip học mẫu</a>
                    </div>
                </div>

                <div class="col-xs-12 col-md-4">
                    <div class="box">
                        <div class="box-title">
                            Chương trình tiếng Anh
                            cho trẻ em
                        </div>

                        <div class="box-sub-title">
                            TIẾNG ANH CĂN BẢN CHO TRẺ EM<br/>
                            <span>(học viên từ 5 đến 10 tuổi)</span>
                        </div>
                        <div class="item">
                            <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/icon-triangle-white.png"/>
                            <div><span>Khoá học đề xuất:</span> 30 tiết / 25 phút mỗi tiết.</div>
                        </div>
                        <div class="item">
                            <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/icon-triangle-white.png"/>
                            <div><span>Giáo trình đề xuất:</span> Cambridge YLE Starters, Movers, Flyers,..</div>
                        </div>

                        <div class="box-sub-title">
                            TIẾNG ANH PHẢN XẠ CHO TRẺ EM<br/>
                            <span>(học viên từ 5 đến 15 tuổi)</span>
                        </div>
                        <div class="item">
                            <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/icon-triangle-white.png"/>
                            <div><span>Khoá học đề xuất:</span> 30 tiết / 25 phút mỗi tiết.</div>
                        </div>
                        <div class="item">
                            <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/icon-triangle-white.png"/>
                            <div><span>Giáo trình đề xuất:</span> Let’s go, Family and Friend, Oxford Discover, Side by Side,… </div>
                        </div>

                        <a href="https://e-space.vn/tieng-anh-thieu-nhi" class="button">Tham Khảo Thêm</a>
                    </div>
                </div>

                <div class="col-xs-12 col-md-4">
                    <div class="box">
                        <div class="box-title">
                            Chương trình tiếng Anh
                            cho doanh nghiệp
                        </div>

                        <div class="item">
                            <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/icon-triangle-white.png"/>
                            <div><span>Khoá học đề xuất:</span> 30 tiết / 50 phút mỗi tiết.</div>
                        </div>
                        <div class="item">
                            <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/icon-triangle-white.png"/>
                            <div><span>Giáo trình đề xuất:</span> Intelligent Business, Business, Let’s talk business</div>
                        </div>
                        <div class="item">
                            <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/icon-triangle-white.png"/>
                            <div><span>Các doanh nghiệp đang đào tạo:</span> Nestlé, Frislandcampina, Karcher, Vinagame...</div>
                        </div>

                        <a href="https://e-space.vn/tieng-anh-doanh-nghiep" class="button">Tham Khảo Thêm</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
	
    <!--INTEL SECTION-->
    <div class="intel-section">
        <div class="text">
			<p style="font-weight: bold; font-size: 40px;"> E-space Platform</p>
            <span style="font-weight: normal;">Hệ thống thông minh hơn!<br/>
            Học nhanh tiến bộ hơn!</span>
        </div>
    </div>

    <!--APP SECTION-->
    <div class="app-section">
        <div class="container">
            <div class="title">
                Công nghệ học trực tuyến<br/>
                <span>1 thầy 1 trò tiên tiến</span>
            </div>
            <div class="title-line"></div>

            <div class="row">
                <div class="col-xs-12 col-md-8 col-md-offset-2">
                    
                    <div class="item">
                        <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/icon-check-circle-white.png"/>
                        Không mất thời gian tạo tài khoản.
                    </div>
                    <div class="item">
                        <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/icon-check-circle-white.png"/>
                        Chất lượng gọi video call ổn định.
                    </div>
                    <div class="item">
                        <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/icon-check-circle-white.png"/>
                        Dễ sử dụng, dùng trên tất cả các thiết bị như smartphone, tablet, máy tính,..
                    </div>
                    <div class="item">
                        <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/icon-check-circle-white.png"/>
                        Tự động record lại clip bài học giúp học viên ôn lại bài cũ, cũng như phụ huynh giám sát được nội dung bài học.
                    </div>
                    <div class="item">
                        <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/icon-check-circle-white.png"/>
                        Bộ phận Quản lý chất lượng kiểm tra lại chất lượng sau mỗi buổi học.
                    </div>

                    <img class="ipad" src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/illus-ipad.png"/>

                    <div class="text02">
                        Tải app E-SPACE cho<br/>
                        di động!
                    </div>

                    <div class="text03">
                        Đặt hoặc hủy lịch học mọi lúc mọi nơi<br/>
                        Nhận thông báo không lo trễ giờ học<br/>
                        Cập nhật thông tin khuyến mãi mới nhất
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-md-4 download-app">
                            <div>Dành cho Android</div>
                            <a href="https://play.google.com/store/apps/details?id=tienganh.online.e_space#details-reviews"><img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/google-play.png"/></a>
                        </div>

                        <div class="col-xs-12 col-md-4 download-app">
                            <div>Dành cho iPhone/iPad</div>
                            <a href="https://itunes.apple.com/us/app/tieng-anh-online-e-space/id1202126893?ls=1&mt=8"><img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/app-store.png"/></a>
                        </div>
                        <div class="col-xs-12 col-md-4 download-app">
                            <div>Dành cho Windows</div>
                            <a href="https://call.e-space.vn/upload/files/espace_student/Espace_Student.zip"><img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/windows-badge.png"/></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--PRICE SECTION-->
    <div id="price-section" class="price-section">
        <div class="container">
            <div class="title">
                <span>Học phí 1 thầy 1 trò<br/>
                ưu đãi nhất!</span>
            </div>
            <div class="title-line"></div>

            <div class="row">
                <div class="col-xs-6 col-xs-offset-3 col-md-5 col-md-offset-0 col-lg-3 col-lg-offset-2">
                    <div class="box01">
                        <span style="font-size: 25px; line-height: 1.3;">Trung tâm<br/><span style="font-weight: 700;">E-SPACE</span></span><br/><br/>
                        <span style="font-size: 20px; line-height: 1.3;">Học phí trung bình<br/><span style="font-weight: 700; font-size: 25px;">88.000 vnd/buổi</span></span><br/><br/>
                        <span style="font-size: 14px;">Học phí chung cố định cho trong phạm vi giao viên và cho tất cả các khoá học</span>
                    </div>
                </div>

                <div class="col-xs-12 col-md-2">
                    <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/icon-plus.png" class="plus"/>
                </div>

                <div class="col-xs-6 col-xs-offset-3 col-md-5 col-md-offset-0 col-lg-3 col-lg-offset-0">
                    <div class="box01">
						<a title="Thông tin chi tiết tích lũy điểm" style="color:#fff; text-decoration: underline;" href="https://e-space.vn/tich-diem/">
							<span style="font-size: 25px; line-height: 1.3;">Ưu đãi lên đến<br/>15% học phí gốc</span>
						</a>
						<br/><br/>
                        <span>5% học phí cho học viên hạng <span style="font-weight: 700;">ĐỒNG</span></span><br/>
                        <span>8% học phí cho học viên hạng <span style="font-weight: 700;">BẠC</span></span><br/>
                        <span>12% học phí cho học viên hạng <span style="font-weight: 700;">VÀNG</span></span><br/>
                        <span>15% học phí cho học viên hạng <span style="font-weight: 700;">KIM CƯƠNG</span></span>
                    </div>
                </div>
				
            </div>
        </div>
    </div>

    <!--TEACHER SECTION-->
    <div class="teacher-section">
        <div class="container">
            <div class="title">
                <span>Giáo viên tiêu biểu tại E-SPACE</span>
            </div>
            <div class="title-line"></div>

            <div class="row">
                <div class="col-xs-12 col-md-4">
                    <div class="text01">Giáo viên Việt Nam</div>
					<a href="<?php echo yii::$app->urlManager->createUrl(['teacher/detail', 'id' => 18,'name' =>  str_replace(' ','-',trim('bich pham'))]); ?>">	
						<img class="avatar" src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/bich-pham.jpg"/>
                    </a>
					<div class="text02">Cô BICH PHAM</div>
                    <div class="star">
                        <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/star.png"/>
                        <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/star.png"/>
                        <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/star.png"/>
                        <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/star.png"/>
                        <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/star.png"/>
                    </div>
                    <div class="text03">
                        <span style="font-weight: 700;"><?php echo $comment_teacher_bichpham;?></span> lượt đánh giá<br/>
                        <span style="font-weight: 700;"><?php echo $bichpham_year;?></span> năm giảng dạy tại E-SPACE<br/>
                        <span style="font-weight: 700;"><?php echo number_format($count_bichpham_class,0,',','.');?></span> lớp đã dạy<br/>
                    </div>
                    <div class="text04">
                        +5 GV Việt Nam
                    </div>
					
                </div>

                <div class="col-xs-12 col-md-4">
                    <div class="text01">Giáo viên Châu Á</div>
					<a href="<?php echo yii::$app->urlManager->createUrl(['teacher/detail', 'id' => 47,'name' =>  str_replace(' ','-',trim('MAVIC'))]); ?>">	
					<img class="avatar" src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/mavic.jpg"/>
						</a>
					<div class="text02">Cô MAVIC</div>
                    <div class="star">
                        <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/star.png"/>
                        <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/star.png"/>
                        <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/star.png"/>
                        <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/star.png"/>
                        <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/star.png"/>
                    </div>
                    <div class="text03">
                        <span style="font-weight: 700;"><?php echo $comment_teacher_mavic;?></span> lượt đánh giá<br/>
                        <span style="font-weight: 700;"><?php echo $mavic_year;?></span> năm giảng dạy tại E-SPACE<br/>
                        <span style="font-weight: 700;"><?php echo number_format($count_mavic_class,0,',','.');?></span> lớp đã dạy<br/>
                    </div>
                    <div class="text04">
                        +25 GV Châu Á
                    </div>
					
                </div>

                <div class="col-xs-12 col-md-4">
                    <div class="text01">Giáo viên Bản ngữ</div>
					<a href="<?php echo yii::$app->urlManager->createUrl(['teacher/detail', 'id' => 77,'name' =>  str_replace(' ','-',trim('ana'))]); ?>">	
                    <img class="avatar" src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/ana.jpg"/>
                    </a>
					<div class="text02">Cô ANA</div>
                    <div class="star">
                        <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/star.png"/>
                        <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/star.png"/>
                        <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/star.png"/>
                        <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/star.png"/>
                        <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/star.png"/>
                    </div>
                    <div class="text03">
                        <span style="font-weight: 700;"><?php echo $comment_teacher_ana;?></span> lượt đánh giá<br/>
                        <span style="font-weight: 700;"><?php echo $ana_year;?></span> năm giảng dạy tại E-SPACE<br/>
                        <span style="font-weight: 700;"><?php echo number_format($count_ana_class,0,',','.');?></span> lớp đã dạy<br/>
                    </div>
                    <div class="text04 last">
                        +12 GV Anh-Mỹ-Canada
                    </div>
					
                </div>
            </div>
			<div  style="text-align: center; margin-top: 40px;">
                <a class="btn btn-default" style=" background: #ffffff; border-radius: 7px; color: #4AA34E; text-transform: uppercase;  font-weight: 700; text-align: center; padding: 15px 20px;  text-decoration: none;" href="https://e-space.vn/giao-vien">Tất cả giáo viên</a>
            </div>
			 
        </div>
    </div>

    <!--STEP SECTION-->
    <div class="step-section">
        <div class="container">
            <div class="title">
                <span>Quy trình</span>
            </div>
            <div class="title-line"></div>

            <div class="row">
                <div class="col-xs-12 col-md-3 item">
                    <div class="text01">
                        Bước 1
                    </div>
                    <div class="text02">
                        Đăng ký thông tin liên lạc để E-SPACE tư vấn cho bạn
                    </div>
                    <a class="link" href="#">
                        Đăng ký tư vấn miễn phí
                    </a>
                </div>

                <div class="col-xs-12 col-md-3 item">
                    <div class="text01">
                        Bước 2
                    </div>
                    <div class="text02">
                        Học thử miễn phí với giáo viên để kiểm tra trình độ tiếng anh
                    </div>
                    <a class="link" href="#">
                        Đặt lịch học thử miễn phí
                    </a>
                </div>

                <div class="col-xs-12 col-md-3 item">
                    <div class="text01">
                        Bước 3
                    </div>
                    <div class="text02">
                        Nhận lộ trình & giáo trình sau buổi test, tư vấn học phí phù hợp
                    </div>
                    <a class="link" href="#">
                        Lộ trình học tham khảo
                    </a>
                </div>

                <div class="col-xs-12 col-md-3 item">
                    <div class="text01">
                        Bước 4
                    </div>
                    <div class="text02">
                        Hoàn thành thủ tục nhập học và bắt đầu học với giáo viên
                    </div>
                    <a class="link" href="#">
                        Đăng nhập và quản lý học tập
                    </a>
                </div>
            </div>

            <div class="main-button">
                <a href="#">Nhận ngay buổi học miễn phí</a>
            </div>
        </div>
    </div>

    <!--COMMENT SECTION-->
    <div class="comment-section">
        <div class="container">
            <div class="title">
                <span>Bình luận</span>
            </div>
            <div class="title-line"></div>


            <div class="row">
                <div class="col-xs-12 col-md-11 col-md-offset-1">
				  
<div class="fb-comments" data-href="https://www.facebook.com/tienganh1thay1tro/" data-width="100%" data-numposts="10"></div>
				  
                     </div>
            </div>
        </div>
    </div>
</div>
<style type="text/css">
.fb_iframe_widget_fluid_desktop iframe {
    min-width: 220px;
    position: relative;
    width: 100% !important;
}
</style>
<!--FOOTER-->
<div class="footer">

    <!--methods-->
    <div class="methods">
        <div class="container">
            <div class="security">
                <div>Các chứng nhận<br/>bảo mật</div>
                <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/norton.png"/>
                <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/ssl.png"/>
            </div>

            <div class="pay">
                <div>Các hình thức<br/>thanh toán</div>
                <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/visa.png"/>
                <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/master.png"/>
                <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/cash.png"/>
                <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/banking.png"/>
                <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/vtc.png"/>
            </div>
        </div>
    </div>

    <!--last line-->
    <div class="last-line">
        <div class="container">
            <div class="copyright">Bản quyền website thuộc <b>Công Ty TNHH E-SPACE VIỆT NAM</b> - MST: 0313032507</div>
            <div class="rule"><a href="#">Các điều khoản & quy định</a></div>
        </div>
    </div>
</div>
</div>
 
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v3.1';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<script>
    $(document).ready(function(){
		 $('#myModal').modal('show');
     $(document).on('click','#save-email',function(){
          
            var email = $("#email").val();
          
            if(email.length < 1){
				  bootbox.alert({
    message: "Xin hãy nhập Email!",
    size: 'small'
});
            }else{
				  $('#gif').css('display', 'block');
				//  $('#myModalLoading').modal('show');
                $.ajax({
                    url : '<?php echo Yii::$app->urlManager->createUrl(["landing/save-email"]) ?>',
                    type : 'post',
                    data :{
                        'email':email
                    },
                    dataType: 'json',
                    success : function(data){
                        //  $('#myModalLoading').modal('hide');
                        if(data.error){
                             bootbox.alert({
    message: data.message,
    size: 'small'
});
      
                        }else{
                            bootbox.alert({
    message: data.message,
    size: 'small'
});
							
							$('#myModal').modal('hide');
                        }
                    }
                }).done(function( data ) {
					  $('#gif').css('display', 'none');
                    $('#myModal').modal('hide');
                    
                });
            }

        });
     });
	 </script>
