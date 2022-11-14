<?php

namespace frontend\controllers;

use Yii;
use common\models\Post;
use frontend\widgets\PostRand;
use yii\web\View;
use yii\helpers\Url;
use frontend\widgets\SocialButtons;

?>
<!-- content -->   
<div class="content-wrapper">
    <!-- top-content -->
    <div id="top-content">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <h1 class="h1-title" title="" >TIN TỨC</h1>
                </div>
                <div class="col-sm-8 text-right">
                    <span class="link-top"><a href="<?php echo Yii::$app->getUrlManager()->createUrl(['index']); ?>" >Trang chủ</a></span>/<span class="link-top"><a href="<?php echo Yii::$app->getUrlManager()->createUrl(['post/index']); ?>" >Tin tức</a></span>/<span class="link-top"><?php echo $post->title;?></span>
                </div>
            </div>
            
        </div>
    </div>
    <!-- top-content  -->   
    <!-- part1 -->
    <div class="container">
        <h2 class="h2-tietle3"><b><?php echo $post->title; ?></b></h2>
        
        <div class="content">
         <?php echo $post->content; ?>
		 <?php echo SocialButtons::widget(); ?>
        </div>  
      
        <div class="fb-comments" data-href="<?php echo Url::to('','http'); ?>" data-width="100%" data-numposts="5"></div>
    </div>
    <!-- part1 -
    <!-- part2 -->
   <?php echo PostRand::widget(); ?>
    
    <!-- part6 -->
</div>

<div id="fb-root"></div>

 <?php
    
 
    $js = '(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.5&appId=873639549356055";
  fjs.parentNode.insertBefore(js, fjs);
}(document, "script", "facebook-jssdk"));';
 
    View::registerJs($js);
 ?>