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
	<link rel="shortcut icon" href="<?php echo Yii::$app->request->baseUrl; ?>/favicon.ico" type="image/x-icon" />
      
        <?php $meta = Yii::$app->controller->getMetaPage(Yii::$app->controller->page);
        if ($meta): echo $meta->content;
        endif;?>
        <?php echo Html::csrfMetaTags() ?>
        
        <title>
            <?php 
                if($meta && $meta->title):
                    echo $meta->title;
                else:
                    echo Yii::$app->controller->title;
                endif;
            ?>
        </title>
        
    <!--Fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,500,500i,600,600i,700,700i&amp;subset=vietnamese" rel="stylesheet">
   <link rel="stylesheet" href="https://e-space.vn/css/font-awesome.min.css">
	<?php $this->head() ?>

<!-- Global site tag (gtag.js) - AdWords: 942354348 -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-942354348"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'AW-942354348');
</script>
<script type="text/javascript">(function(){var a=window._eclickq||(window._eclickq=[]);if(!a.loaded){var b=document.createElement("script");b.async=!0;b.src=("https:"==document.location.protocol?"https:":"http:")+"//s.eclick.vn/delivery/retargeting.js"; var c=document.getElementsByTagName("script")[0];c.parentNode.insertBefore(b,c);a.loaded=!0}a.push(["addPixelId",15738])})();window._eclickq=window._eclickq||[];window._eclickq.push(["track","PixelInitialized",{}]);</script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-45092260-2"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-45092260-2');
</script>


   </head>
<body class="index-page">
<div id="fb-root"></div>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      xfbml            : true,
      version          : 'v3.2'
    });
  };

  (function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<!-- Your customer chat code -->
<div class="fb-customerchat"
  attribution=setup_tool
  page_id="234515393624263">
</div>
<style>
#iframe {
    position: fixed;
	top: 75px;
	right: 0px;
	z-index: 3000;
	border-top: 1px solid #4aa34e; 
	border-right: 0px solid #4aa34e; 
	border-bottom: 1px solid #4aa34e; 
	border-left: 1px solid #4aa34e; 
	
}
#btnClose{
	cursor: pointer; 
	background: #4aa34e;
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
	
		<div onClick="changeView();" id="btnClose"><i class="fa fa-step-forward" aria-hidden="true"></i></div>
		<iframe id="iframe" width="260" height="150" src="https://www.youtube-nocookie.com/embed/7rURz1kf4P4?rel=0&autoplay=1" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
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
	<!-- Load Facebook SDK for JavaScript -->

</body>
<link href="<?php echo Yii::$app->getUrlManager()->baseUrl?>/css/phone.css" type="text/css" rel="stylesheet"/>
	<a href="tel:1900-9485"> 
	<div class="alo-phone alo-green alo-show" id="alo-phoneIcon">
         <div class="alo-ph-circle"></div>
         <div class="alo-ph-circle-fill"></div>
         <div class="alo-ph-img-circle"></div>
		
	</div>
	 </a>
</html>
<?php $this->endPage(); ?>