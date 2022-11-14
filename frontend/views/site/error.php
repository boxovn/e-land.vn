<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */
$this->title = isset($name)?$name:'Không tìm thấy trang!';
use yii\widgets\Breadcrumbs;
$session = Yii::$app->session;
use frontend\widgets\Header;
?>
<!--
<div class="row row_nav">
    <div class="col-md-4">
        <?php echo Header::widget(['slug' => $slug,'totalCount' => $totalCount]);?>
    </div>
    <div class="col-md-8">
        <div class="index_nav">
            <ul class="ul_nav" style="list-style: none;">
                 <li><a title="Tin tức" href="<?php echo yii::$app->urlManager->createUrl(['blog/default/index']) ?>">Tin
                        tức</a>
                </li>
                <li>
                    <a <?php  echo (Yii::$app->request->url==Yii::$app->getUrlManager()->createUrl(['about/index']))? 'class="active"':'';?>  title="Giới thiệu" href="<?php echo yii::$app->urlManager->createUrl(['about/index']) ?>">
                       
                            Giới thiệu</a>
                </li>
                <li>
                    <a <?php  echo (Yii::$app->request->url==Yii::$app->getUrlManager()->createUrl(['contact/index']))? 'class="active"':'';?> title="Liên hệ" href="<?php echo yii::$app->urlManager->createUrl(['contact/index']) ?>">Liên hệ</a>
                </li>

                <li>
                    <a <?php  echo (Yii::$app->request->url==Yii::$app->getUrlManager()->createUrl(['tool/index']))? 'class="active"':'';?> title="Công cụ hỗ trợ mô giới"
                        href="<?php echo yii::$app->urlManager->createUrl(['tool/index']) ?>">Công cụ</a>
                </li>
                <li>
                    <a <?php  echo (Yii::$app->request->url==Yii::$app->getUrlManager()->createUrl(['setting/index']))? 'class="active"':'';?> title="Cài đặt" href="<?php echo yii::$app->urlManager->createUrl(['setting/index']) ?>"><i
                            class="fa fa-cog" aria-hidden="true"></i> Cài
                        đặt</a>
                </li>
                     <?php if (Yii::$app->user->isGuest) { ?>
         <li>
                        <a class="button_post" title="Đăng tin"
                            href="<?php echo yii::$app->urlManager->createUrl(['index/login']) ?>"><i class="fa fa-address-card" aria-hidden="true"></i> Đăng tin</a>
                        <?php } else { ?>
                             <?php $user = Yii::$app->user->identity;?>
                                    <li>
                                <a class="button_post" title="Đăng tin"
                                    href="<?php echo yii::$app->urlManager->createUrl(['user/post','id' => $user->id]) ?>"><i class="fa fa-address-card" aria-hidden="true"></i> Đăng tin</a>
                            </li>
                     <?php } ?>
            </ul>
            
        </div>
    </div>

</div>
                        -->
<div class="body">
    <div id="main">
        <div id="container" class="container">
            <center>
                <h1><?= Html::encode($this->title) ?></h1>
                <img style="width:250px; height:250px" src="https://e-land.vn/images/e-land.jpg" />
            </center>
        </div>
    </div>
</div>