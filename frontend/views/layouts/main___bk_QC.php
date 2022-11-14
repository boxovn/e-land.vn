<?php
use yii\helpers\Html;
use frontend\assets\AppAsset;
use frontend\widgets\Alert;
use frontend\widgets\Header;
use frontend\widgets\Footer;
use frontend\widgets\NavBar;
use frontend\widgets\SideBar;
use frontend\widgets\HeaderPage;
use frontend\widgets\HeaderIndex;
use frontend\widgets\HeaderCategory; 
use frontend\widgets\HeaderProvince;
use frontend\widgets\HeaderProvinceDistrict;  
use frontend\widgets\HeaderDetail;
AppAsset::register($this);
//AppAssetEnd::register($this);
$user = \Yii::$app->user->identity;

if($user){
  $this->registerJsFile('https://chat.batdongsaneland.com/socket.io/socket.io.js', ['position' => \yii\web\View::POS_END]);
  $this->registerJsFile('https://chat.batdongsaneland.com/user.js', ['position' => \yii\web\View::POS_END]);
 
}
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?php echo Yii::$app->language;?>">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?php echo $this->title; ?> </title>
    <!--Font-->
    <?php $this->head() ?>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-87907412-1"></script>
    <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'UA-87907412-1');
    </script>

</head>

<body>
    <div id="progress" class="waiting">
        <dt></dt>
        <dd></dd>
    </div>
    <input type="hidden" id="id" value="<?php echo isset($user)?$user->id:0;?>" />
    <input type="hidden" id="name"
        value="<?php echo preg_replace( "/\r|\n/", "", isset($user)?$user->name:'guest');?>" />
    <?php $this->beginBody() ?>
    <?php echo NavBar::widget();?>
    <div class="wrapper">
        <?php echo SideBar::widget(); ?>
        <div id="main" class="detail">
            <?php $controllerl = Yii::$app->controller;
                    $homecheker = $controllerl->id.'/'.$controllerl->action->id;
                    if($homecheker=='article/index'){?>
            <?php echo HeaderIndex::widget(); ?>
            <?php }elseif($homecheker=='article/slug_province-or_slug_category-or_slug_type' || $homecheker=='index/result' ){?>
            <?php echo HeaderCategory::widget(['totalCount' => $this->params['totalCount']]); ?>
            <?php }elseif($homecheker=='article/province-slug_category-or_slug_type-or_slug_district'){?>
            <?php echo HeaderProvince::widget(['totalCount' => $this->params['totalCount']]); ?>
            <?php }elseif($homecheker=='article/province-district-slug_category-or_slug_type'){?>
            <?php echo HeaderProvinceDistrict::widget(['totalCount' => $this->params['totalCount']]); ?>
            <?php }elseif($homecheker=='article/detail'){?>
            <?php echo HeaderDetail::widget(); ?>
            <?php }elseif($controllerl->id!='user') {?>
            <?php echo HeaderPage::widget(['title' => $this->title]); ?>
            <?php }?>
                
            <?php  if($homecheker=='article/index'){?>
            <?php echo HeaderIndex::widget(); ?>
            <?php }elseif($homecheker=='article/slug_province-or_slug_category-or_slug_type'){?>
            <?php echo HeaderCategory::widget(['totalCount' => $this->params['totalCount']]); ?>
            <?php }elseif($homecheker=='article/province-slug_category-or_slug_type-or_slug_district'){?>
            <?php echo HeaderProvince::widget(['totalCount' => $this->params['totalCount']]); ?>
            <?php }elseif($homecheker=='article/province-district-slug_category-or_slug_type'){?>
            <?php echo HeaderProvinceDistrict::widget(['totalCount' => $this->params['totalCount']]); ?>
            <?php }elseif($homecheker=='article/detail'){?>
            <?php echo HeaderDetail::widget(); ?>
            <?php }elseif($homecheker=='index/result'){?>
            <?php echo HeaderCategory::widget(['totalCount' => $this->params['totalCount']]); ?>
            <?php }elseif($homecheker=='project/detail') {?>
            <?php  echo HeaderProject::widget(['title' => $this->title,'slug' => Yii::$app->request->get('slug')]); ?>
            <?php }?>
            <div class="wap-body">
                <div style="width: calc( 100% - 360px); float:left">
                    <?php echo $content ?>
                </div>
                <div
                    style="width: 360px; padding:20px; height:899px; border:0px solid #ddd; float: right; right: 0; top: 150px; z-index: 1000; background-color:#fff">
                    <div>
                        <h1>Được tài trợ</h1>
                    </div>
                    <div
                        style="width:100%; float:left; padding:10px; border-radius:8px; border:1px solid #ddd; margin-bottom:10px;">

                        <div style="width:50%; float:left">
                            <img style="border-radius:8px; width:100%"
                                src="<?php echo Yii::$app->getUrlManager()->baseUrl; ?>/images/qc.jpg" />
                        </div>
                        <div style="width:50%; float:left">
                            <h2>Học miễn phí</h2>
                        </div>

                    </div>
                    <div style="width:100%; float:left; padding:10px; border-radius:8px; border:1px solid #ddd;">
                        <div style="width:50%; float:left">
                            <img style="border-radius:8px; width:100%"
                                src="<?php echo Yii::$app->getUrlManager()->baseUrl; ?>/images/qc2.jpg" />
                        </div>
                        <div style="width:50%; float:left">
                            <h2>Học miễn phí</h2>
                        </div>

                    </div>
                </div>
            </div>

            <?php echo Footer::widget();?>

        </div>
    </div>

    <?php $this->endBody() ?>
    <span id="top-link-block" class="hidden-xs">
        <a href="#top" onclick="$('html,body').animate({scrollTop:0},'slow');return false;">
            <img src="<?php echo Yii::$app->getUrlManager()->baseUrl; ?>/images/up.png" />
        </a>
    </span><!-- /top-link-block -->

</body>

</html>
<?php $this->endPage(); ?>