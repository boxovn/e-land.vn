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
                    <div class="hot-line">Hotline:0909.888.888</div>
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
                <div class="col-md-2">
                </div>
                <div class="col-md-8">

                    <nav class="navbar">
                        <ul id="nav" class="navbar-nav ml-auto">
                            <li class="nav-item active">
                                <a data-scroll-nav="0" href="#about">Giới thiệu</a>
                            </li>
                            <li class="nav-item">
                                <a data-scroll-nav="0" href="#feature">Tính năng</a>
                            </li>
                            <li class="nav-item">
                                <a data-scroll-nav="0" href="#service">Tông quan</a>
                            </li>
                            <li class="nav-item">
                                <a data-scroll-nav="0" href="#algorithm">Thuật toán & Kênh</a>
                            </li>
                            <li class="nav-item">
                                <a data-scroll-nav="0" href="#contact">Liên hệ</a>
                            </li>


                        </ul>
                    </nav>
                </div>
                <div class="col-md-2">

                </div>

            </div>
            <div class="row">
                <div class="col-md-6 about-content-left">
                    <div class="name"> E-LAND </div>
                    <div class="title">Nền tảng rao bán & cho thuê bât động sản đa kênh Công nghệ 4.0</div>
                    <div class="description">
                        <ul>
                            <li> Đăng tin rao bán miễn phí</li>
                            <li> Tìm kiếm bất động sản thông minh</li>
                            <li> Hệ thống chắm sóc và tương tác khách hàng chuyên nghiệp</li>
                            <li> Thuật toán phân loại thông minh tiếp cận đúng khách hàng tiềm năng</li>
                            <li> Tin rao được tiếp cận khách hàng qua các kênh Web, Zalo, Facebook, Youtube, Email
                                Marketing, App Eland...</li>
                        </ul>
                    </div>
                    <div>
                        <a class="btn-register" href="#"></a>
                    </div>
                </div>
                <div class="col-md-6">
                    <img class="img-hero" src="<?php echo Url::home(true);?>/abouts/img/illus-hero.png" />
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
                            Đăng tin hoàn toàn miễn phí, tiếp cận lượng khách hàng lớn qua nền tàng E-land
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
                            Cung cụ tìm kiếm tối ưu, giúp khách hàng tìm kiếm sản phẩm theo ý muốn.
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
                            Công cụ tương tác khách hàng chuyên nghiệp. Giúp hỗ trợ tư vấn khách hàng trực tuyến.
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
                            Tìm kiếm sản phẩm bất động sản trên bản đồ một cách chuyên nghiệp
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section body">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="description">
                        E-land là nền tảng bán bất động sản đa kênh tại Việt Nam. Giúp khách hàng truyền thông tiếp cận
                        khách hàng tiềm năm một cách hiệu quả.
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="video">
                        <iframe width="100%" height="315" src="https://www.youtube.com/embed/YsdG4sfaDRg"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                    </div>
                    <div>
                        <a class="btn-register" href="#"></a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="title">THUẬT TOÁN THÔNG MINH <br />TIẾP CẬN KHÁCH HÀNG QUA CÁC KÊNH</div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="box">
                        <img class="img" src="<?php echo Url::home(true);?>/abouts/img/service01.png" />
                        <div class="description">
                            Tin ra tiếp cận qua FaceBook group
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="box">
                        <img class="img" src="<?php echo Url::home(true);?>/abouts/img/service02.png" />
                        <div class="description">
                            Tiến cận tin rao qua Zalo group
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="box">
                        <img class="img" src="<?php echo Url::home(true);?>/abouts/img/service03.png" />
                        <div class="description">
                            Tiếp cận qua Gmail marketing
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="box">
                        <img class="img" src="<?php echo Url::home(true);?>/abouts/img/service04.png" />
                        <div class="description">
                            Tiếp cận qua Google Search
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>