<?php
use yii\helpers\Html;
use frontend\assets\AppAssetGoogleAds;

/* @var $this \yii\web\View */
/* @var $content string */
AppAssetGoogleAds::register($this);
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
    <title><?php echo $this->title;?></title>
    <link rel="shortcut icon" href="<?php echo Yii::$app->request->baseUrl; ?>/favicon.ico" type="image/x-icon" />
    <!--====== Favicon Icon ======-->
    <?php $this->head() ?>
</head>
<body>
 <!-- Load Facebook SDK for JavaScript -->
      <div id="fb-root"></div>
      <script>
        window.fbAsyncInit = function() {
          FB.init({
            xfbml            : true,
            version          : 'v7.0'
          });
        };

        (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));</script>

      <!-- Your Chat Plugin code -->
      <div class="fb-customerchat"
        attribution=setup_tool
        page_id="104375817842224"
  theme_color="#fa3c4c"
  logged_in_greeting="Hi! How can we help you?"
  logged_out_greeting="Hi! How can we help you?">
      </div>
    <style>
#iframe {
    position: fixed;
    top: 75px;
    right: 0px;
    z-index: 3000;
    border-top: 1px solid #d4262b; 
    border-right: 0px solid #d4262b; 
    border-bottom: 1px solid #d4262b; 
    border-left: 1px solid #d4262b; 
    
}
#btnClose{
    cursor: pointer; 
    background: #d4262b;
    color:#fff;
    position: fixed;
    top: 75px;
    right: 260px;
    z-index: 3100; 
    border: none;
    width: 20px;
    height: 150px;
    text-align:center;
    line-height: 150px;
}
</style>
    
    <script type="text/javascript">
        function changeView() {
            var iframe = document.getElementById("iframe");
            var close = document.getElementById("btnClose");
                if (iframe.style.display === "none") {
                    iframe.style.display = "block";
                     close.style.right="260px";
                      $('#btnClose').html('<i class="fa fa-step-forward" aria-hidden="true"></i>');
                } else {
                    iframe.style.display = "none";
                     close.style.right="0px";
                     close.style.width="25px";
                    $('#btnClose').html('<i class="fa fa-step-backward" aria-hidden="true"></i>');
                }
        }
    </script>
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