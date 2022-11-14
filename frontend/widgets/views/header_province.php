<?php
use  yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
$session = Yii::$app->session;
?>

<div class="row row_nav desktop-topnav" id="man-topnav">
    <div class="col-md-4">

        <div class="box">
            <div class="box-body" style="padding:10px">
                <?php if(isset($model->image) && $model->image){?>
                <img style="width: 100px;height: 50px;border-radius: 5px;float: left;margin-right: 10px;"
                    src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/provinces/<?php echo $model->image;?>" />
                <?php }else{ ?>
                <img style="width: 100px;height: 50px;border-radius: 5px;float: left;margin-right: 10px; border:1px solid #ddd"
                    src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/images/no-image210x118.png" />
                <?php }?>
                <div class="left">
                    <div class="title">
                        <h1><?= Html::encode($this->title) ?></h1>
                        <?php
				
				 if($slug){
                // $this is the view object currently being used
                echo Breadcrumbs::widget([
                    // 'itemTemplate' => "<li><i>{link}</i></li>\n", // template for all links
                    'homeLink' => [
                        'label' => 'Trang chủ',
                        'url' =>  ['article/index'],
                    ],
					'links' => [
                        [
                            'label' => Html::encode($this->title),
                            'url' => ['article/category','category' => $slug],
                            'template' => "<li><b>{link}</b></li>\n", // template for this link only
                        ],
                    ]
                ]);
				 }else{
					  echo Breadcrumbs::widget([
                     'homeLink' => [
                        'label' => 'Trang chủ',
                        'url' =>  ['article/index'],
                    ],
					'links' => [
                        [
                            'label' => Html::encode($this->title),
                          
                            'template' => "<li><b>{link}</b></li>", // template for this link only
                        ],
                    ]
					
                ]);
				 }
                ?>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="index_nav">
            <ul class="ul_nav" style="list-style: none;">
                <?php 
                 
                foreach($articelCategories as $value){?>

                <?php if($value->slug=="du-an"){?>

                <li>
                    <a title="<?php echo $value->title;?>" href="<?php echo Url::to(['/project/index'],true);?>"><i
                            style="color:#c00" class="fa fa-caret-right" aria-hidden="true"></i>
                        <?php echo $value->title;?></a>
                </li>
				 <?php }else if($value->slug=="sach-doanh-nhan"){?>
                <li>
                    <a title="<?php echo $value->title;?>"
                    href="<?php echo Url::to(['/business-book/index'],true);?>"><i style="color:#c00"
                        class="fa fa-caret-right" aria-hidden="true"></i> <?php echo $value->title;?></a>
                </li>
                <?php }else{?>
                <li>
                    <a <?php echo (Yii::$app->request->get('slug') == $value->slug)? 'class="active"':'';?>
                        title="<?php echo $value->title;?>"
                        href="<?php echo Url::to(['/article/province-slug_category-or_slug_type-or_slug_district', 'province' => $slug,'slug' =>  $value->slug],true);?>"><?php echo $value->title;?></a>

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
             <?php 
                 
                foreach($articelCategories as $value){?>

                <?php if($value->slug=="du-an"){?>

                <li>
                    <a title="<?php echo $value->title;?>" href="<?php echo Url::to(['/project/index'],true);?>"><i
                            style="color:#c00" class="fa fa-caret-right" aria-hidden="true"></i>
                        <?php echo $value->title;?></a>
                </li>
				 <?php }else if($value->slug=="sach-doanh-nhan"){?>
                <li>
                    <a title="<?php echo $value->title;?>"
                    href="<?php echo Url::to(['/business-book/index'],true);?>"><i style="color:#c00"
                        class="fa fa-caret-right" aria-hidden="true"></i> <?php echo $value->title;?></a>
                </li>
                <?php }else{?>
                <li>
                    <a <?php echo (Yii::$app->request->get('slug') == $value->slug)? 'class="active"':'';?>
                        title="<?php echo $value->title;?>"
                        href="<?php echo Url::to(['/article/province-slug_category-or_slug_type-or_slug_district', 'province' => $slug,'slug' =>  $value->slug],true);?>"><?php echo $value->title;?></a>

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