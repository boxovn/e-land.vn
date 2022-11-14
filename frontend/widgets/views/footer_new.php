<?php
	use common\libraries\EncodeUrl;
?>
<!--FOOTER-->
 <style type="text/css">
	.lwc-chat-button{
		z-index:1;
	}
	.skype-button + .tooltip > .tooltip-inner {
		background-color: #00AFF0;
	} 
</style>
<div class="footer">
    <!--link list-->
    <div class="link-list">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-md-3">
                    <h3 class="title">VỀ E-SPACE VIET NAM</h3>
                    <ul>
                        <li><a title="Giới thiệu" href="<?php echo yii::$app->urlManager->createUrl(['about/index']) ?>">Giới thiệu</a></li>
                        <li><a title="Hướng dẫn học" href="<?php echo yii::$app->urlManager->createUrl(['guide/index']) ?>">Hướng dẫn học</a></li>
                        <li><a title="Học phí & Thanh toán" href="<?php echo yii::$app->urlManager->createUrl(['student/index']) ?>">Học phí & Thanh toán</a></li>
						<li><a title="Chính sách chăm sóc khách hàng" href="https://e-space.vn/tich-diem">Chính sách chăm sóc khách hàng</a></li>
                        <li><a title="Tuyển dụng giáo viên" href="<?php echo yii::$app->urlManager->createUrl(['teacher-page']) ?>">Tuyển dụng</a></li>
                        <li><a title="Học bổng" href="<?php echo yii::$app->urlManager->createUrl(['scholarship/index']) ?>">Học bổng</a></li>
                        <li><a title="CHÍNH SÁCH VÀ QUY ĐỊNH DÀNH CHO HỌC VIÊN VÀ GIÁO VIÊN TẠI E-SPACE.VN" href="<?php echo yii::$app->urlManager->createUrl(['blog/post','id'=>156,'title'=> strtolower(str_replace(' ','-',trim(EncodeUrl::stripVNUrl('CHÍNH SÁCH VÀ QUY ĐỊNH DÀNH CHO HỌC VIÊN VÀ GIÁO VIÊN TẠI E-SPACE.VN'))))]) ?>">Chính sách bảo mật</a></li>
						<li>Tổng đài CSKH <a class="tel"  href="tel:19009485">19009485</a></li>
					</ul>
                </div>

                <div class="col-xs-12 col-md-3">
                    <h3 class="title">TIN TỪ E-SPACE</h3>
                    <ul>
                        <?php foreach ($posts as $key => $value) { ?>
                         <li><a title="<?php echo $value->title;?>" href="<?php echo Yii::$app->getUrlManager()->createUrl(['blog/post','id' => $value->post_id,'title' =>strtolower(str_replace(' ','-',trim(EncodeUrl::stripVNUrl($value->title))))]) ?>"><?php echo $value->title;?></a></li>
                       <?php }?>
                    </ul>
                </div>

                <div class="col-xs-12 col-md-3">
                    <h3 class="title">THƯ VIỆN E-SPACE</h3>
                    <ul>
                       <?php foreach ($documents as $key => $value) { ?>
                        <li><a title="<?php echo $value->title;?>" href="<?php echo Yii::$app->getUrlManager()->createUrl(['library/index']);?>"><?php echo $value->title;?></a></li>
                       <?php }?>
                    </ul>
                </div>

                <div class="col-xs-12 col-md-3 app">
                    <h3 class="title">TẢI APP DI ĐỘNG<img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/new_system/images/new.png" /></h3>
                    <div>Đặt lịch học dễ dàng hơn ngay trên điện thoại với APP E-SPACE dành cho Android và iPhone/iPad!</div>
                    <b>Download App trên Adnroid</b>
                    <a title="Download App trên Adnroid" href="https://play.google.com/store/apps/details?id=tienganh.online.e_space#details-reviews"><img alt="App E-space trên Android" src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/new_system/images/google-play.png"/></a>
                    <b>Download App trên iPhone/iPad</b>
                    <a title="Download App trên iPhone/iPad" href="https://apps.apple.com/us/app/ti%E1%BA%BFng-anh-online-e-space/id1202126893"><img alt="App E-space trên Iphone" src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/new_system/images/app-store.png"/></a>
                    <b>Download App trên Windows</b>
                    <a title="Download App trên Windows" href="https://call.e-space.vn/upload/files/espace_student/Espace_Student.zip"><img alt="App E-space trên Windows" src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/new_system/images/windows.png"/></a>
                </div>
            </div>
        </div>
    </div>

    <!--methods-->
    <div class="methods">
        <div class="container">
            <div class="security">
                <div>Các chứng nhận<br/>bảo mật</div>
                <img alt="Norton" src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/new_system/images/norton.png"/>
                <img alt="Ssl" src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/new_system/images/ssl.png"/>
            </div>

            <div class="pay">
                <div>Các hình thức<br/>thanh toán</div>
                <img alt="Visa" src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/new_system/images/visa.png"/>
                <img alt="Master" src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/new_system/images/master.png"/>
                <img alt="Cash" src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/new_system/images/cash.png"/>
                <img alt="Banking" src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/new_system/images/banking.png"/>
                <img alt="Vtc" src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/new_system/images/vtc.png"/>
            </div>
        </div>
    </div>

    <!--last line-->
    <div class="last-line">
        <div class="container">
            <div class="copyright">Bản quyền website thuộc <b>Công Ty TNHH E-SPACE VIỆT NAM</b> - MST: 0313032507</div>
            <div class="rule"><a title="Các điều khoản & quy định" href="#">Các điều khoản & quy định</a></div>
        </div>
    </div>
</div>
