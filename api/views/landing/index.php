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
				
                <p style="font-size:18px; padding: 5px 0; margin-bottom:10px;">  <img style="position:relative; top:-10px; left:-5px;" src="/images/hot.gif">Nh???n phi???u gi???m gi??</p>
                <p style="font-size:44px; padding: 10px 0;  margin-bottom:10px; font-weight: bold">T???ng 150.000VND </p>
                <div style="color:#333; padding: 10px 40px; height:160px; float:left; width:100%; opacity: 0.9; border-radius:10px; background-color: #fff; font-weight:bold; font-size: 12px; text-align:center">
					 <p style="color:red; margin-bottom: 0px; padding: 5px 0; background-color: #fff; font-weight:bold; font-size: 12px; text-align:center">  
                        S??? l?????ng Voucher c??n l???i: <?php echo rand(10,100);?> phi???u
                    </p> 
                       <div class="timer_title"> Th???i gian k???t th??c sau</div>
                        <div class="timer deal1"></div>
                    
                    <div class="progressWrap">
                        <div class="fullbar"></div>
                        <div class="progress deal1" style="width:0%"></div>
                    </div>
                     
                            <input type="email" autofocus class="form-control " placeholder="Nh???p Email" style="margin: 0px auto" name="email" id="email"/>
                            <button class="btn btn-danger" id="save-email" style="margin-top:10px">Nh???n Voucher</button>
                       
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
                $('.timer.deal1').replaceWith("<div class=\"timer ended\">K???t th??c</div>");
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
					 <li><a href="\">Trang ch???</a></li>
                    <li><a href="#number-section">V??? E-SPACE</a></li>
                    <li><a href="#diff-section">T???i sao ch???n E-SPACE</a></li>
                    <li><a href="#path-section">Ch????ng tr??nh h???c</a></li>
                    <li><a href="#price-section">H???c ph??</a></li>
                    <li class="apply"><a>T???ng ????i CSKH 24/7:  1900-9485</a></li>
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
                        Trung t??m Anh ng???<br/>
                        tr???c tuy???n 1 th???y 1 tr??<br/>
                        ?????u ti??n t???i Vi???t Nam
                    </div>
                    <div class="list">
                        <div><img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/icon-check-white.png" />?????m b???o ch???t l?????ng tr??n t???ng bu???i h???c</div>
                        <div><img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/icon-check-white.png" />L??? tr??nh h???c chuy??n bi???t</div>
                        <div><img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/icon-check-white.png" />Gi??o vi??n ???n ?????nh, nhi???u n??m kinh nghi???m</div>
                    </div>
                </div>

                <div class="col-xs-12 col-md-6">
                     
  <?php  $form = ActiveForm::begin() ?>
                     <div class="text01">
                          ????ng k?? ngay </div>
		 <?php
        foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
            echo '<div style="font-size: 12px; padding:5px;" class="alert alert-' . $key . '"><small>' . $message . '</small></div>';
        }
        ?>
    <?= $form->field($model, 'name', ['template' => '{label}{input}'])->textInput(['placeholder'=>'H??? v?? t??n'])->label(false) ?>
    <?= $form->field($model, 'email', ['template' => '{label}{input}'])->textInput(['placeholder'=>'Email'])->label(false) ?>
     <?= $form->field($model, 'phone', ['template' => '{label}{input}'])->textInput(['placeholder'=>'S??? ??i???n tho???i'])->label(false)->label(false) ?>
	                <?php echo $form->field($model, 'age_group', ['template' => '{label}{input}'])->dropDownList(array(1 =>'Ti???ng anh cho ng?????i l???n',2=>'Ti???ng anh cho tr??? em', 3 => 'Ti???ng anh cho doanh nghi???p'))->label(false); ?>
              
   <?php $model->region = 1;
echo $form->field($model, 'region', [
         'options' => [
                    'tag' => false, // Don't wrap with "form-group" div
                ],
        'template' => '{input}{label}'])->radio(['label' => 'Mi???n B???c', 'value' => 1, 'uncheck' => null]) ?>
<?= $form->field($model, 'region', [
     'options' => [
                    'tag' => false, // Don't wrap with "form-group" div
                ],
    'template' => '{input}{label}'])->radio(['label' => 'Mi???n Trung', 'value' => 2, 'uncheck' => null]) ?>
<?= $form->field($model, 'region', [
     'options' => [
                    'tag' => false, // Don't wrap with "form-group" div
                ],
    'template' => '{input}{label}'])->radio(['label' => 'Mi???n Nam', 'value' => 3, 'uncheck' => null]) ?>
 <div class="sep"></div>
          <?= Html::submitButton('????ng k?? ????? nh???n bu???i h???c mi???n ph??',['class'=>'submit']) ?>
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
                <div class="text02">n??m ph??t tri???n</div>
                <div class="text03">
                    12/2012: Tri???n khai Ch????ng tr??nh ????o t???o Ti???ng Anh 1 th???y 1 tr?? ?????u ti??n t???i Vi???t Nam t??? E-space Nh???t B???n
                </div>
                <div class="text03">
                    11/2014: Th??nh l???p C??ng Ty TNHH E-SPACE Viet Nam
                </div>
                <div class="text03">
                    6/2017: M??? chi nh??nh E-space H?? N???i
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-md-4">
                    <div class="box">
                        <div class="text01">+<?php echo number_format($count_teacher,0,',','.');?></div>
                        <div class="text02">gi??o vi??n th?????ng tr???c</div>
                        <div class="text03"><?php echo $teacherMore10;?>% GV tr??n 10 n??m kinh nghi???m</div>
                        <div class="text03"><?php echo $teacherLess10;?>% GV 5 - 10 n??m kinh nghi???m</div>
                    </div>
                </div>

                <div class="col-xs-12 col-md-4">
                    <div class="box">
                        <div class="text01">+<?php echo number_format($count_student,0,',','.');?></div>
                        <div class="text02">th??nh vi??n </div>
                        <div class="text03"><?php echo number_format($count_student_exchange,0,',','.');?> HV ch??nh th???c</div>
                        <div class="text03"><?php echo number_format($count_student_company,0,',','.');?> HV doanh nghi???p</div>
                    </div>
                </div>

                <div class="col-xs-12 col-md-4">
                    <div class="box">
                        <div class="text01">+<?php echo number_format($count_class,0,',','.');?></div>
                        <div class="text02">l???p h???c ???? di???n ra</div>
                        <div class="text03"><?php echo number_format($count_class_month,0,',','.');?> l???p/th??ng</div>
                        <div class="text03"><?php echo number_format($count_class_day,0,',','.');?> l???p/ng??y</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--MIND SECTION-->
    <div class="mind-section">
        <div class="text">
            Thay ?????i t?? duy<br/>
            <span>h???c ti???ng Anh th???i 4.0!</span>
        </div>
    </div>

    <!--BENEFIT SECTION-->
    <div class="benefit-section">
        <div class="container">
            <div class="item">
                <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/icon-check-circle-green.png"/>
                <div class="text01">Ng???i nh?? v???n h???c t???t</div>
                <div class="text02">B???n c?? th??? h???c m???i l??c m???i n??i, ??? b???t k??? ????u m?? kh??ng c???n ?????n trung t??m.</div>
            </div>

            <div class="item">
                <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/icon-check-circle-green.png"/>
                <div class="text01">L???p h???c ch??? 1 h???c vi??n</div>
                <div class="text02">M???t h???c vi??n ?????i tho???i face to face v???i gi??o vi??n, ???????c gi??o vi??n s???a l???i li??n t???c su???t bu???i h???c.</div>
            </div>

            <div class="item">
                <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/icon-check-circle-green.png"/>
                <div class="text01">L???ch h???c linh ?????ng</div>
                <div class="text02">H???c vi??n c?? th??? h???c v??o b???t c??? th???i gian r???nh r???i n??o trong ng??y t??? 6h s??ng ?????n 24h ????m. </div>
            </div>

            <div class="item">
                <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/icon-check-circle-green.png"/>
                <div class="text01">Gi??o tr??nh c?? nh??n h??a</div>
                <div class="text02">Gi??o tr??nh ???????c bi??n so???n v?? ch???n l???c c???a c??c NXB n???i ti???ng: Oxford, Cambridge, Longman,... Ph?? h???p theo l??? tr??nh h???c c???a t???ng h???c vi??n.</div>
            </div>
        </div>
    </div>

    <!--DIFF SECTION-->
    <div id="diff-section" class="diff-section">
        <div class="container">
            <div class="title">
                <span>E-SPACE c?? g?? kh??c bi???t</span><br/>
                so v???i c??c trung t??m tr???c tuy???n<br/>
                1 th???y 1 tr?? kh??c
            </div>
            <div class="title-line"></div>

            <div class="row">
                <div class="col-xs-12 col-md-4">
                    <div class="item">
                        <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/icon-teacher.png"/>
                        <div>H???c v???i b???t k??? gi??o vi??n n??o trong ph???m vi G??i h???c</div>
                    </div>

                    <div class="item">
                        <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/icon-clock.png"/>
                        <div>Qu???n l?? l???ch h???c v?? nh???c gi??? h???c tr??n Smartphone</div>
                    </div>

                    <div class="item">
                        <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/icon-switch.png"/>
                        <div> Chuy???n ?????i g??i h???c gi???a GV B???n Ng??? - GV Ch??u ?? linh ho???t</div>
                    </div>
                </div>

                <div class="col-xs-12 col-md-4 visible-md visible-lg">
                    <img class="illus" src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/illus-student-boy-smile.jpg" />
                </div>

                <div class="col-xs-12 col-md-4">
                    <div class="item">
                        <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/icon-calendar.png"/>
                        <div>H???y l???ch h???c tr?????c 2h kh??ng m???t ph??</div>
                    </div>

                    <div class="item">
                        <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/icon-app.png"/>
                        <div>H???c tr???c ti???p tr??n App E-Space, kh??ng c???n Skype</div>
                    </div>

                    <div class="item">
                        <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/icon-quality.png"/>
                        <div>Qu???n l?? ch???t l?????ng t???ng bu???i h???c</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<div>
		<img alt="Quy tr??nh qu???n l?? ch???t l?????ng 4.0" src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/images/e-space-chart.jpg" style="width: 100%; height: 100%;">
	</div>
    <!--PATH SECTION-->
    <div id="path-section" class="path-section">
        <div class="container">
            <div class="title">
                L??? tr??nh v?? gi??o tr??nh h???c<br/>
                <span>tinh g???n - logic nh???t</span>
            </div>
            <div class="title-line"></div>

            <div class="row">
                <div class="col-xs-12 col-md-4">
                    <div class="box">
                        <div class="box-title">
                            Ch????ng tr??nh ti???ng Anh
                            cho ng?????i l???n
                        </div>

                        <div class="box-sub-title">
                            TI???NG ANH CHO NG?????I M???T G???C
                        </div>
                        <div class="item">
                            <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/icon-triangle-white.png"/>
                            <div><span>Kho?? h???c ????? xu???t:</span> 30 ti???t / 25 ph??t m???i ti???t.</div>
                        </div>
                        <div class="item">
                            <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/icon-triangle-white.png"/>
                            <div><span>Gi??o tr??nh ????? xu???t:</span> Person to Person starter, Side by Side, Headway,...</div>
                        </div>

                        <div class="box-sub-title">
                            TI???NG ANH GIAO TI???P
                        </div>
                        <div class="item">
                            <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/icon-triangle-white.png"/>
                            <div><span>Kho?? h???c ????? xu???t:</span> 30 ti???t / 50 ph??t m???i ti???t.</div>
                        </div>
                        <div class="item">
                            <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/icon-triangle-white.png"/>
                            <div><span>Gi??o tr??nh ????? xu???t:</span> Person to Person 1, Speak your mind, Communication-2, Business,..</div>
                        </div>

                        <a href="https://e-space.vn/lop-hoc-mau" class="button">Clip h???c m???u</a>
                    </div>
                </div>

                <div class="col-xs-12 col-md-4">
                    <div class="box">
                        <div class="box-title">
                            Ch????ng tr??nh ti???ng Anh
                            cho tr??? em
                        </div>

                        <div class="box-sub-title">
                            TI???NG ANH C??N B???N CHO TR??? EM<br/>
                            <span>(h???c vi??n t??? 5 ?????n 10 tu???i)</span>
                        </div>
                        <div class="item">
                            <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/icon-triangle-white.png"/>
                            <div><span>Kho?? h???c ????? xu???t:</span> 30 ti???t / 25 ph??t m???i ti???t.</div>
                        </div>
                        <div class="item">
                            <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/icon-triangle-white.png"/>
                            <div><span>Gi??o tr??nh ????? xu???t:</span> Cambridge YLE Starters, Movers, Flyers,..</div>
                        </div>

                        <div class="box-sub-title">
                            TI???NG ANH PH???N X??? CHO TR??? EM<br/>
                            <span>(h???c vi??n t??? 5 ?????n 15 tu???i)</span>
                        </div>
                        <div class="item">
                            <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/icon-triangle-white.png"/>
                            <div><span>Kho?? h???c ????? xu???t:</span> 30 ti???t / 25 ph??t m???i ti???t.</div>
                        </div>
                        <div class="item">
                            <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/icon-triangle-white.png"/>
                            <div><span>Gi??o tr??nh ????? xu???t:</span> Let???s go, Family and Friend, Oxford Discover, Side by Side,??? </div>
                        </div>

                        <a href="https://e-space.vn/tieng-anh-thieu-nhi" class="button">Tham Kh???o Th??m</a>
                    </div>
                </div>

                <div class="col-xs-12 col-md-4">
                    <div class="box">
                        <div class="box-title">
                            Ch????ng tr??nh ti???ng Anh
                            cho doanh nghi???p
                        </div>

                        <div class="item">
                            <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/icon-triangle-white.png"/>
                            <div><span>Kho?? h???c ????? xu???t:</span> 30 ti???t / 50 ph??t m???i ti???t.</div>
                        </div>
                        <div class="item">
                            <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/icon-triangle-white.png"/>
                            <div><span>Gi??o tr??nh ????? xu???t:</span> Intelligent Business, Business, Let???s talk business</div>
                        </div>
                        <div class="item">
                            <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/icon-triangle-white.png"/>
                            <div><span>C??c doanh nghi???p ??ang ????o t???o:</span> Nestl??, Frislandcampina, Karcher, Vinagame...</div>
                        </div>

                        <a href="https://e-space.vn/tieng-anh-doanh-nghiep" class="button">Tham Kh???o Th??m</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
	
    <!--INTEL SECTION-->
    <div class="intel-section">
        <div class="text">
			<p style="font-weight: bold; font-size: 40px;"> E-space Platform</p>
            <span style="font-weight: normal;">H??? th???ng th??ng minh h??n!<br/>
            H???c nhanh ti???n b??? h??n!</span>
        </div>
    </div>

    <!--APP SECTION-->
    <div class="app-section">
        <div class="container">
            <div class="title">
                C??ng ngh??? h???c tr???c tuy???n<br/>
                <span>1 th???y 1 tr?? ti??n ti???n</span>
            </div>
            <div class="title-line"></div>

            <div class="row">
                <div class="col-xs-12 col-md-8 col-md-offset-2">
                    
                    <div class="item">
                        <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/icon-check-circle-white.png"/>
                        Kh??ng m???t th???i gian t???o t??i kho???n.
                    </div>
                    <div class="item">
                        <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/icon-check-circle-white.png"/>
                        Ch???t l?????ng g???i video call ???n ?????nh.
                    </div>
                    <div class="item">
                        <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/icon-check-circle-white.png"/>
                        D??? s??? d???ng, d??ng tr??n t???t c??? c??c thi???t b??? nh?? smartphone, tablet, m??y t??nh,..
                    </div>
                    <div class="item">
                        <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/icon-check-circle-white.png"/>
                        T??? ?????ng record l???i clip b??i h???c gi??p h???c vi??n ??n l???i b??i c??, c??ng nh?? ph??? huynh gi??m s??t ???????c n???i dung b??i h???c.
                    </div>
                    <div class="item">
                        <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/icon-check-circle-white.png"/>
                        B??? ph???n Qu???n l?? ch???t l?????ng ki???m tra l???i ch???t l?????ng sau m???i bu???i h???c.
                    </div>

                    <img class="ipad" src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/illus-ipad.png"/>

                    <div class="text02">
                        T???i app E-SPACE cho<br/>
                        di ?????ng!
                    </div>

                    <div class="text03">
                        ?????t ho???c h???y l???ch h???c m???i l??c m???i n??i<br/>
                        Nh???n th??ng b??o kh??ng lo tr??? gi??? h???c<br/>
                        C???p nh???t th??ng tin khuy???n m??i m???i nh???t
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-md-4 download-app">
                            <div>D??nh cho Android</div>
                            <a href="https://play.google.com/store/apps/details?id=tienganh.online.e_space#details-reviews"><img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/google-play.png"/></a>
                        </div>

                        <div class="col-xs-12 col-md-4 download-app">
                            <div>D??nh cho iPhone/iPad</div>
                            <a href="https://itunes.apple.com/us/app/tieng-anh-online-e-space/id1202126893?ls=1&mt=8"><img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/app-store.png"/></a>
                        </div>
                        <div class="col-xs-12 col-md-4 download-app">
                            <div>D??nh cho Windows</div>
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
                <span>H???c ph?? 1 th???y 1 tr??<br/>
                ??u ????i nh???t!</span>
            </div>
            <div class="title-line"></div>

            <div class="row">
                <div class="col-xs-6 col-xs-offset-3 col-md-5 col-md-offset-0 col-lg-3 col-lg-offset-2">
                    <div class="box01">
                        <span style="font-size: 25px; line-height: 1.3;">Trung t??m<br/><span style="font-weight: 700;">E-SPACE</span></span><br/><br/>
                        <span style="font-size: 20px; line-height: 1.3;">H???c ph?? trung b??nh<br/><span style="font-weight: 700; font-size: 25px;">88.000 vnd/bu???i</span></span><br/><br/>
                        <span style="font-size: 14px;">H???c ph?? chung c??? ?????nh cho trong ph???m vi giao vi??n v?? cho t???t c??? c??c kho?? h???c</span>
                    </div>
                </div>

                <div class="col-xs-12 col-md-2">
                    <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/icon-plus.png" class="plus"/>
                </div>

                <div class="col-xs-6 col-xs-offset-3 col-md-5 col-md-offset-0 col-lg-3 col-lg-offset-0">
                    <div class="box01">
						<a title="Th??ng tin chi ti???t t??ch l??y ??i???m" style="color:#fff; text-decoration: underline;" href="https://e-space.vn/tich-diem/">
							<span style="font-size: 25px; line-height: 1.3;">??u ????i l??n ?????n<br/>15% h???c ph?? g???c</span>
						</a>
						<br/><br/>
                        <span>5% h???c ph?? cho h???c vi??n h???ng <span style="font-weight: 700;">?????NG</span></span><br/>
                        <span>8% h???c ph?? cho h???c vi??n h???ng <span style="font-weight: 700;">B???C</span></span><br/>
                        <span>12% h???c ph?? cho h???c vi??n h???ng <span style="font-weight: 700;">V??NG</span></span><br/>
                        <span>15% h???c ph?? cho h???c vi??n h???ng <span style="font-weight: 700;">KIM C????NG</span></span>
                    </div>
                </div>
				
            </div>
        </div>
    </div>

    <!--TEACHER SECTION-->
    <div class="teacher-section">
        <div class="container">
            <div class="title">
                <span>Gi??o vi??n ti??u bi???u t???i E-SPACE</span>
            </div>
            <div class="title-line"></div>

            <div class="row">
                <div class="col-xs-12 col-md-4">
                    <div class="text01">Gi??o vi??n Vi???t Nam</div>
					<a href="<?php echo yii::$app->urlManager->createUrl(['teacher/detail', 'id' => 18,'name' =>  str_replace(' ','-',trim('bich pham'))]); ?>">	
						<img class="avatar" src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/bich-pham.jpg"/>
                    </a>
					<div class="text02">C?? BICH PHAM</div>
                    <div class="star">
                        <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/star.png"/>
                        <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/star.png"/>
                        <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/star.png"/>
                        <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/star.png"/>
                        <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/star.png"/>
                    </div>
                    <div class="text03">
                        <span style="font-weight: 700;"><?php echo $comment_teacher_bichpham;?></span> l?????t ????nh gi??<br/>
                        <span style="font-weight: 700;"><?php echo $bichpham_year;?></span> n??m gi???ng d???y t???i E-SPACE<br/>
                        <span style="font-weight: 700;"><?php echo number_format($count_bichpham_class,0,',','.');?></span> l???p ???? d???y<br/>
                    </div>
                    <div class="text04">
                        +5 GV Vi???t Nam
                    </div>
					
                </div>

                <div class="col-xs-12 col-md-4">
                    <div class="text01">Gi??o vi??n Ch??u ??</div>
					<a href="<?php echo yii::$app->urlManager->createUrl(['teacher/detail', 'id' => 47,'name' =>  str_replace(' ','-',trim('MAVIC'))]); ?>">	
					<img class="avatar" src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/mavic.jpg"/>
						</a>
					<div class="text02">C?? MAVIC</div>
                    <div class="star">
                        <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/star.png"/>
                        <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/star.png"/>
                        <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/star.png"/>
                        <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/star.png"/>
                        <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/star.png"/>
                    </div>
                    <div class="text03">
                        <span style="font-weight: 700;"><?php echo $comment_teacher_mavic;?></span> l?????t ????nh gi??<br/>
                        <span style="font-weight: 700;"><?php echo $mavic_year;?></span> n??m gi???ng d???y t???i E-SPACE<br/>
                        <span style="font-weight: 700;"><?php echo number_format($count_mavic_class,0,',','.');?></span> l???p ???? d???y<br/>
                    </div>
                    <div class="text04">
                        +25 GV Ch??u ??
                    </div>
					
                </div>

                <div class="col-xs-12 col-md-4">
                    <div class="text01">Gi??o vi??n B???n ng???</div>
					<a href="<?php echo yii::$app->urlManager->createUrl(['teacher/detail', 'id' => 77,'name' =>  str_replace(' ','-',trim('ana'))]); ?>">	
                    <img class="avatar" src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/ana.jpg"/>
                    </a>
					<div class="text02">C?? ANA</div>
                    <div class="star">
                        <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/star.png"/>
                        <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/star.png"/>
                        <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/star.png"/>
                        <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/star.png"/>
                        <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/star.png"/>
                    </div>
                    <div class="text03">
                        <span style="font-weight: 700;"><?php echo $comment_teacher_ana;?></span> l?????t ????nh gi??<br/>
                        <span style="font-weight: 700;"><?php echo $ana_year;?></span> n??m gi???ng d???y t???i E-SPACE<br/>
                        <span style="font-weight: 700;"><?php echo number_format($count_ana_class,0,',','.');?></span> l???p ???? d???y<br/>
                    </div>
                    <div class="text04 last">
                        +12 GV Anh-M???-Canada
                    </div>
					
                </div>
            </div>
			<div  style="text-align: center; margin-top: 40px;">
                <a class="btn btn-default" style=" background: #ffffff; border-radius: 7px; color: #4AA34E; text-transform: uppercase;  font-weight: 700; text-align: center; padding: 15px 20px;  text-decoration: none;" href="https://e-space.vn/giao-vien">T???t c??? gi??o vi??n</a>
            </div>
			 
        </div>
    </div>

    <!--STEP SECTION-->
    <div class="step-section">
        <div class="container">
            <div class="title">
                <span>Quy tr??nh</span>
            </div>
            <div class="title-line"></div>

            <div class="row">
                <div class="col-xs-12 col-md-3 item">
                    <div class="text01">
                        B?????c 1
                    </div>
                    <div class="text02">
                        ????ng k?? th??ng tin li??n l???c ????? E-SPACE t?? v???n cho b???n
                    </div>
                    <a class="link" href="#">
                        ????ng k?? t?? v???n mi???n ph??
                    </a>
                </div>

                <div class="col-xs-12 col-md-3 item">
                    <div class="text01">
                        B?????c 2
                    </div>
                    <div class="text02">
                        H???c th??? mi???n ph?? v???i gi??o vi??n ????? ki???m tra tr??nh ????? ti???ng anh
                    </div>
                    <a class="link" href="#">
                        ?????t l???ch h???c th??? mi???n ph??
                    </a>
                </div>

                <div class="col-xs-12 col-md-3 item">
                    <div class="text01">
                        B?????c 3
                    </div>
                    <div class="text02">
                        Nh???n l??? tr??nh & gi??o tr??nh sau bu???i test, t?? v???n h???c ph?? ph?? h???p
                    </div>
                    <a class="link" href="#">
                        L??? tr??nh h???c tham kh???o
                    </a>
                </div>

                <div class="col-xs-12 col-md-3 item">
                    <div class="text01">
                        B?????c 4
                    </div>
                    <div class="text02">
                        Ho??n th??nh th??? t???c nh???p h???c v?? b???t ?????u h???c v???i gi??o vi??n
                    </div>
                    <a class="link" href="#">
                        ????ng nh???p v?? qu???n l?? h???c t???p
                    </a>
                </div>
            </div>

            <div class="main-button">
                <a href="#">Nh???n ngay bu???i h???c mi???n ph??</a>
            </div>
        </div>
    </div>

    <!--COMMENT SECTION-->
    <div class="comment-section">
        <div class="container">
            <div class="title">
                <span>B??nh lu???n</span>
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
                <div>C??c ch???ng nh???n<br/>b???o m???t</div>
                <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/norton.png"/>
                <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/page/landing/images/ssl.png"/>
            </div>

            <div class="pay">
                <div>C??c h??nh th???c<br/>thanh to??n</div>
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
            <div class="copyright">B???n quy???n website thu???c <b>C??ng Ty TNHH E-SPACE VI???T NAM</b> - MST: 0313032507</div>
            <div class="rule"><a href="#">C??c ??i???u kho???n & quy ?????nh</a></div>
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
    message: "Xin h??y nh???p Email!",
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
