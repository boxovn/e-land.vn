<?php
use  yii\helpers\Url;
?>
<div class="nav-menu desktop-topnav">
    <ul class="nav nav-tabs">
       
        <li><a <?php echo (Yii::$app->request->url==Yii::$app->getUrlManager()->createUrl(['poster/index','id' => $poster->id]))? 'class="active"':'';?>
                href="<?php echo Yii::$app->getUrlManager()->createUrl(['poster/index','id' => $poster->id]);?>"><i
                    class="fa fa-address-book-o" aria-hidden="true"></i> Tin đã đăng</a></li>

        <li><a <?php echo (Yii::$app->request->url==Yii::$app->getUrlManager()->createUrl(['poster/about','id' => $poster->id]))? 'class="active"':'';?>
                href="<?php echo Yii::$app->getUrlManager()->createUrl(['poster/about','id' => $poster->id]);?>"><i
                    class="fa fa-file-text-o margin-r-5"></i> Giới thiệu</a></li>

      
    </ul>
</div>
<div class="mobile-topnav">
    <div class="mobi-nav">
        <?php if (Yii::$app->user->isGuest) { ?>

        <a class="btn btn-default btn-sm" title="Đăng tin"
            href="<?php echo yii::$app->urlManager->createUrl(['index/login']) ?>"><i class="fa fa-address-card"
                aria-hidden="true"></i> Đăng tin</a>

        <?php } else { ?>
        <?php $user = Yii::$app->user->identity;?>

        <a class="btn btn-default btn-sm" title="Đăng tin"
            href="<?php echo yii::$app->urlManager->createUrl(['user/post']) ?>"><i
                class="fa fa-address-card" aria-hidden="true"></i> Đăng tin</a>
        <?php } ?>
        <a href="javascript:void(0);" class="btn btn-default btn-sm" onclick="linkFunction()">
            <i class="fa fa-bars"></i>
        </a>
    </div>
    <div class="mobi-nav-menu" id="myLinks">
        <ul>
          
        <li><a <?php echo (Yii::$app->request->url==Yii::$app->getUrlManager()->createUrl(['poster/index','id' => $poster->id]))? 'class="active"':'';?>
                href="<?php echo Yii::$app->getUrlManager()->createUrl(['poster/index','id' => $poster->id]);?>"><i
                    class="fa fa-address-book-o" aria-hidden="true"></i> Tin đã đăng</a></li>

        <li><a <?php echo (Yii::$app->request->url==Yii::$app->getUrlManager()->createUrl(['poster/about','id' => $poster->id]))? 'class="active"':'';?>
                href="<?php echo Yii::$app->getUrlManager()->createUrl(['poster/about','id' => $poster->id]);?>"><i
                    class="fa fa-file-text-o margin-r-5"></i> Giới thiệu</a></li>

       

        </ul>
    </div>

</div>
<script>
function linkFunction() {
    var x = document.getElementById("myLinks");
    if (x.style.display === "block") {
        x.style.display = "none";
    } else {
        x.style.display = "block";
    }
}
</script>