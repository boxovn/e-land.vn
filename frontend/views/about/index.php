<?php
use  yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\AboutSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = isset($model->title)?$model->title: Yii::t('about', 'title');
$this->params['breadcrumbs'][] = $this->title;
?>
<?php echo $this->registerCssFile("/abouts/css/style.css");?>
<div class="about-body">
    <div class="about-header">
        <div class="container">
            <div class="row top">
                <div class="col-md-4">
                    <div class="hot-line">Hotline:<span style="color:#ff3333">035.9696.234</span></div>
                </div>
                <div class="col-md-4">
                    <div class="center"> E-LAND</div>
                </div>
                <div class="col-md-4">
                    <div class="social">
                        <img src="<?php echo Url::home(true);?>/abouts/img/ico-fb.png" />
                        <img src="<?php echo Url::home(true);?>/abouts/img/ico-insta.png" />
                        <img src="<?php echo Url::home(true);?>/abouts/img/ico-yt.png" />
                    </div>
                </div>

            </div>
           
            <div class="row">
                <div class="col-md-6 about-content-left">
                    <div class="name"> E-LAND </div>
                    <div class="title">NỀN TẢNG BẤT ĐỘNG SẢN SẢN PHẨM THẬT</div>
                    <div class="description">
                        <ul>
                            <li> Thông tin mô tả sản phẩm đúng với sản phẩm rao bán</li>
							<li> Khách hàng có thể chọn đúng sản phẩm mình mong muốn ngay trên hệ thống</li>
                            <li> Tiết kiệm thời gian đi lại cho khách hàng</li>
							<li> Công cụ tìm kiếm thông minh, giúp khách hàng nhanh chóng tiếp cận được sản phẩm mong muốn</li>
                            <li> Hệ thống chăm sóc khách hàng chuyên nghiệp.</li>
                        </ul>
                    </div>
                    <div>
                        <a class="btn-register" href="<?php echo Yii::$app->getUrlManager()->createUrl(['index/register']) ?>"></a>
                    </div>
                </div>
                <div class="col-md-6">
                    <img class="img-hero" src="<?php echo Url::home(true);?>/abouts/img/illus-hero.png" />
                </div>
            </div>
        </div>

    </div>
      <div class="section sec-1">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="description">
                        "E-land là nền tảng bất động sản sản phẩm thật. Giúp khách hàng tìm kiếm ngay sản phẩm đúng nhu cầu."
                    </div>
                </div>
            </div>
          </div>
    </div>
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title">TÍNH NĂNG ƯU VIỆT CỦA E-LAND</div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="box">
                        <img class="img" src="<?php echo Url::home(true);?>/abouts/img/illus-ft01.png" />
                        <div class="box-title">
                            Đăng tin
                        </div>
                        <div class="description">
                            Đăng tin hoàn toàn miễn phí, tiếp cận lượng khách hàng lớn qua nền tàng E-land.
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="box">
                        <img class="img" src="<?php echo Url::home(true);?>/abouts/img/illus-ft02.png" />
                        <div class="box-title">
                            Tìm kiếm
                        </div>
                        <div class="description">
                            Cung cụ tìm kiếm tối ưu, giúp khách hàng tìm kiếm sản phẩm theo nhu cầu mong muốn.
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="box">
                        <img class="img" src="<?php echo Url::home(true);?>/abouts/img/illus-ft03.png" />
                        <div class="box-title">
                            E-chat
                        </div>
                        <div class="description">
                            Công cụ Chat thời gian thực chuyên nghiệp. Giúp hỗ trợ khách hàng 24/7.
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="box">
                        <img class="img" src="<?php echo Url::home(true);?>/abouts/img/illus-ft04.png" />
                        <div class="box-title">
                            Bản đồ
                        </div>
                        <div class="description">
                            Định vị vị trí sản phẩm trên bản đồ Google Map.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section sec-1">
        <div class="container">
            
            <div class="row">
                <div class="col-md-12">
                    <div class="title">THUẬT TOÁN THÔNG MINH <br />TIẾP CẬN KHÁCH HÀNG QUA CÁC KÊNH</div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="box">
                        <img class="img" src="<?php echo Url::home(true);?>abouts/img/service01.png" />
                        <div class="description">
                            Tin ra tiếp cận qua FaceBook
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="box">
                        <img class="img" src="<?php echo Url::home(true);?>abouts/img/service02.png" />
                        <div class="description">
                            Tiến cận tin rao qua Zalo
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="box">
                        <img class="img" src="<?php echo Url::home(true);?>abouts/img/service03.png" />
                        <div class="description">
                            Tiếp cận qua Email
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="box">
                        <img class="img" src="<?php echo Url::home(true);?>abouts/img/service04.png" />
                        <div class="description">
                            Tiếp cận qua Google Seo (Từ khoá)
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>