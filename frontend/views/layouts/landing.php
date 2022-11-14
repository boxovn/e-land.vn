<?php
use yii\helpers\Html;
use frontend\assets\AppAssetLanding;

/* @var $this \yii\web\View */
/* @var $content string */
AppAssetLanding::register($this);
?>
<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="<?php echo Yii::$app->language ?>">
    <head>
    <!--====== Required meta tags ======-->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--====== Title ======-->
    <title>Kí gửi nhà đất</title>
    <link rel="shortcut icon" href="<?php echo Yii::$app->request->baseUrl; ?>/favicon.ico" type="image/x-icon" />
    <!--====== Favicon Icon ======-->
    <?php $this->head() ?>
</head>
<body>
 
 <?php $this->beginBody() ?>
    <?php echo $content ?>
 <?php $this->endBody(); ?>
</body>
<link href="<?php echo Yii::$app->getUrlManager()->baseUrl?>/css/phone.css" type="text/css" rel="stylesheet"/>
    <a href="tel:0359696234"> 
    <div class="alo-phone alo-green alo-show" id="alo-phoneIcon">
         <div class="alo-ph-circle"></div>
         <div class="alo-ph-circle-fill"></div>
         <div class="alo-ph-img-circle"></div>
        
    </div>
     </a>
</html>
<?php $this->endPage(); ?>