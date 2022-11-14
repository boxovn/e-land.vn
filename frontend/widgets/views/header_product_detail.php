<?php
use  yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
$session = Yii::$app->session;
?>

<div class="row row_nav desktop-topnav" id="man-topnav">

    <div class="col-md-12">
        <div class="index_nav">
            <ul class="ul_nav" style="list-style: none;">
                <?php foreach($articelCategories as $value){?>
                     <?php if($value->slug=="du-an"){?>
                <li>
                    <a title="<?php echo $value->title;?>"
                    href="<?php echo Url::to(['/project/index'],true);?>"><i style="color:#c00"
                        class="fa fa-caret-right" aria-hidden="true"></i> <?php echo $value->title;?></a>
                </li>
            <?php }else{?>
                <li>
                <a title="<?php echo $value->title;?>"
                        href="<?php echo Url::to(['/article/slug_province-or_slug_category-or_slug_type','slug' => $value->slug],true);?>"><?php echo $value->title;?></a>
                </li>
            <?php }?>
                <?php }?>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"> Xem thêm
                        <i class="fa fa-caret-down fa-lg" aria-hidden="true"></i></a>
                    <ul class="dropdown-menu">
                        <?php foreach($blogCategories as $item){?>
                    <li>
                    <a <?php  echo (Yii::$app->request->url==yii::$app->urlManager->createUrl(['blog/default/index', 'slug' => $item->slug]))? 'class="active"':'';?>
                        title="<?php echo  $item->title;?>"
                        href="<?php echo yii::$app->urlManager->createUrl(['blog/default/index', 'slug' => $item->slug]) ?>"><i
                            class="fa fa-caret-right" aria-hidden="true"></i> <?php echo  $item->title;?></a>
                        </li>
                <?php }?>     

                    </ul>
                </li>
                <?php if (Yii::$app->user->isGuest) { ?>
                <li>
                    <a class="btn-post" title="Đăng tin"
                        href="<?php echo yii::$app->urlManager->createUrl(['index/login']) ?>"><i
                            class="fa fa-address-card" aria-hidden="true"></i> Đăng tin</a>
                    <?php } else { ?>
                    <?php $user = Yii::$app->user->identity;?>
                <li>
                    <a class="btn-post" title="Đăng tin"
                        href="<?php echo yii::$app->urlManager->createUrl(['user/post']) ?>"><i
                            class="fa fa-address-card" aria-hidden="true"></i> Đăng tin</a>
                </li>
                <?php } ?>

            </ul>
        </div>
        <!-- Simulate a smartphone / tablet -->
        <!-- Top Navigation Menu -->

    </div>
</div>
<div class="mobile-topnav">
    <div class="mobi-nav">
        <?php if (Yii::$app->user->isGuest) { ?>

        <a class="btn btn-default btn-md" title="Đăng tin"
            href="<?php echo yii::$app->urlManager->createUrl(['index/login']) ?>"><i class="fa fa-address-card"
                aria-hidden="true"></i> Đăng tin</a>

        <?php } else { ?>
        <?php $user = Yii::$app->user->identity;?>

        <a class="btn btn-default btn-md" title="Đăng tin"
            href="<?php echo yii::$app->urlManager->createUrl(['user/post']) ?>"><i
                class="fa fa-address-card" aria-hidden="true"></i> Đăng tin</a>
        <?php } ?>
        <a href="javascript:void(0);" class="btn btn-default btn-md" onclick="linkFunction()">
            <i class="fa fa-bars"></i> Danh mục
        </a>
    </div>
    <div class="mobi-nav-menu" id="myLinks">
        <ul>
            <?php foreach($articelCategories as $value){?>
                     <?php if($value->slug=="du-an"){?>
                <li>
                    <a title="<?php echo $value->title;?>"
                    href="<?php echo Url::to(['/project/index'],true);?>"><i style="color:#c00"
                        class="fa fa-caret-right" aria-hidden="true"></i> <?php echo $value->title;?></a>
                </li>
            <?php }else{?>
                <li>
                <a title="<?php echo $value->title;?>"
                        href="<?php echo Url::to(['/article/slug_province-or_slug_category-or_slug_type','slug' => $value->slug],true);?>"><?php echo $value->title;?></a>
                </li>
            <?php }?>
                <?php }?>
            <?php foreach($blogCategories as $item){?>
                    <li>
                    <a <?php  echo (Yii::$app->request->url==yii::$app->urlManager->createUrl(['blog/default/index', 'slug' => $item->slug]))? 'class="active"':'';?>
                        title="<?php echo  $item->title;?>"
                        href="<?php echo yii::$app->urlManager->createUrl(['blog/default/index', 'slug' => $item->slug]) ?>"><i
                            class="fa fa-caret-right" aria-hidden="true"></i> <?php echo  $item->title;?></a>
                        </li>
                <?php }?>     

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