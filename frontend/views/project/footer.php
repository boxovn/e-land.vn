<?php
use  yii\helpers\Url; 
?>
<div class="footer">
    <div class="row">
        <div class="col-lg-3 col-md-3  nopadding">
            <h2>Hỗ trợ khách hàng</h2>
            <ul>
                <li>
                    <p class="hotline">Tổng đài CSKH <a href="tel:1900-6035"><?php echo $about->phone;?></a>
                    </p>
                </li>
                <li>
                    <a title="Câu hỏi thường gặp"
                        href="<?php echo yii::$app->urlManager->createUrl(['question/index']) ?>" class="small-text"
                        target="_blank">Các câu hỏi thường gặp</a>
                </li>
                <li>
                    <a title="Đóng góp ý kiến" href="<?php echo yii::$app->urlManager->createUrl(['contact/index']) ?>"
                        class="small-text" target="_blank">Đóng góp ý kiến</a>
                </li>

                <li>
                    <p class="security">Hỗ trợ khách hàng: <a href="mailto:hotro@e-land.vn">hotro@e-land.vn</a></p>
                    <p class="security">Báo lỗi bảo mật: <a href="mailto:security@e-land.vn">security@e-land.vn</a></p>

                </li>
            </ul>
        </div>
        <div class="col-lg-3 col-md-3  nopadding">
            <h2>Về Eland</h2>
            <ul>

                <li><a title="Giới thiệu" href="<?php echo yii::$app->urlManager->createUrl(['about/index']) ?>">Giới
                        thiệu</a></li>

                <li><a title="Tuyển dụng"
                        href="<?php echo yii::$app->urlManager->createUrl(['recruitment/index']) ?>">Tuyển dụng</a></li>

                <li><a title="Chính sách bảo mật"
                        href="<?php echo yii::$app->urlManager->createUrl(['privacy-policy/index']) ?>">Chính sách bảo
                        mật</a></li>
                <li><a title="Chính sách giải quyết khiếu nại"
                        href="<?php echo yii::$app->urlManager->createUrl(['complain/index']) ?>">Chính sách giải quyết
                        khiếu nại</a></li>
                <li><a title="Điều khoản" href="<?php echo yii::$app->urlManager->createUrl(['rule/index']) ?>">Điều
                        khoản</a></li>

            </ul>
        </div>
        <div class="col-lg-3 col-md-3  nopadding">
            <h2>Tin từ Eland</h2>
            <?= \yii\widgets\Menu::widget([
                            'items' => $cat_items,
                            'options' => [
                               // 'class' => 'blog-index__cat'
                            ]
                        ]);
                        ?>
        </div>
        <div class="col-lg-3 col-md-3  nopadding">
            <h2>Kết nối với Eland</h2>
            <ul>
                <div class="block">
                    <h4>Mạng xã hội</h4>
                    <p>
                        <a href="<?php echo $about->facebook;?>" class="icon" target="_blank"
                            title="Facebook"><img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/images/icon/fb.svg" width="32" alt=""></a>
                        <a href="<?php echo $about->youtube;?>" class="icon" target="_blank"
                            title="Youtube"><img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/images/icon/youtube.svg" width="32" alt=""></a>
                    </p>
                    <h4>Ứng dụng</h4>
                    <p>
                        <a href="#" class="icon" target="_blank" aria-label="" admicro-data-event="100127"
                            admicro-data-auto="1" admicro-data-order="false"><img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/images/icon/appstore.png"
                                width="134" alt=""></a>
                        <a href="#" class="icon" target="_blank" aria-label="" admicro-data-event="100128"
                            admicro-data-auto="1" admicro-data-order="false"><img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/images/icon/playstore.png"
                                width="134" alt=""></a></p>
                </div>
            </ul>
        </div>
    </div>

    <div class="row" style="padding: 20px 8px">
        <div class="col-md-12" style="padding: 10px 50px">
            Địa chỉ văn phòng: <?php echo $about->address;?>
        </div>
    </div>
<div class="row">
    <div class="col-md-8 middle">
        <?php echo $about->company;?>
    </div>
    <div class=col-md-4>
        <img src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/images/bo-cong-thuong.svg" />

    </div>
</div>
</div>
