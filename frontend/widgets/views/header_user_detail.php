<?php
use  yii\helpers\Url;
?>
<div class="d-flex justify-content-center py-3">
    <ul class="nav nav-pills">
        
        <li class="nav-item">
            <a class="nav-link px-2 link-secondary active" <?php echo (Yii::$app->request->url==Yii::$app->getUrlManager()->createUrl(['/user/post']))? 'class="active"':'';?>
                href="<?php echo Yii::$app->getUrlManager()->createUrl(['/user/post']);?>">
                   Đăng tin</a>
        </li>
        <li class="nav-item"><a class="nav-link px-2 link-secondary" <?php echo (Yii::$app->request->url==Yii::$app->getUrlManager()->createUrl(['/user/index']))? 'class="active"':'';?>
                href="<?php echo Yii::$app->getUrlManager()->createUrl(['/user/index']);?>">Tin đã đăng</a></li>
        <li class="nav-item"><a class="nav-link px-2 link-secondary" <?php echo (Yii::$app->request->url==Yii::$app->getUrlManager()->createUrl(['/user/article']))? 'class="active"':'';?>
                href="<?php echo Yii::$app->getUrlManager()->createUrl(['/user/article']);?>"> Chỉnh sửa bài viết</a></li>

        <li class="nav-item"><a class="nav-link px-2 link-secondary" <?php echo (Yii::$app->request->url==Yii::$app->getUrlManager()->createUrl(['/user/about']))? 'class="active"':'';?>
                href="<?php echo Yii::$app->getUrlManager()->createUrl(['/user/about']);?>">Giới thiệu</a></li>
        <li class="nav-item"><a  class="nav-link px-2 link-secondary" target="_blank"
                href="<?php echo Yii::$app->params['url-page-chat'];?>/home?sender_id=<?php echo  $user->id; ?>">
                Hệ thống chắm sóc
            </a></li>

    </ul>
</div>
