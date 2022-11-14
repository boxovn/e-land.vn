<?php
use yii\helpers\Html;
use frontend\assets\AppAssetIndex;
use frontend\widgets\Alert;
use frontend\widgets\Header;
use frontend\widgets\Footer;
use frontend\widgets\NavBar;
use frontend\widgets\SideBar;
/* @var $this \yii\web\View */
/* @var $content string */
AppAssetIndex::register($this);
$user = \Yii::$app->user->identity;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?php echo Yii::$app->language;?>">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
         <?php
			if(isset(Yii::$app->controller->page)){
				$meta =Yii::$app->controller->getMetaPage(Yii::$app->controller->page?Yii::$app->controller->page:0);
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
		<?php } ?>
        <!--Font-->
        <?php $this->head() ?>
        <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-87907412-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-87907412-1');
</script>

    </head>
	<body>
        <div id="progress" class="waiting">
            <dt></dt>
            <dd></dd>
        </div>
	<input type="hidden" id="id" value="<?php echo isset($user)?$user->id:0;?>"/>
	<input type="hidden" id="name" value="<?php echo preg_replace( "/\r|\n/", "", isset($user)?$user->name:'guest');?>"/>
        <?php $this->beginBody() ?>
        <?php echo NavBar::widget();?>
        <div class="wrapper">
            <?php echo SideBar::widget(); ?>
            <?php echo $content ?>
        </div>   
		
		<?php $this->endBody() ?>
           <span id="top-link-block" class="hidden-xs">
				<a href="#top" onclick="$('html,body').animate({scrollTop:0},'slow');return false;">
					<img src="<?php echo Yii::$app->getUrlManager()->baseUrl; ?>/images/up.png"/>
				</a>
			</span><!-- /top-link-block -->
  
    </body> 
</html>
<?php $this->endPage(); ?>

