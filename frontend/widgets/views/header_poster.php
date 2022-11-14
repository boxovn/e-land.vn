<?php 
use  yii\helpers\Url;
?>
<div class="header" id="man-topnav">
    <div class="box">
        <div class="col-md-4 col-xs-10 no-padding">
            <div class="box-body box-profile">
                <div class="user_avatar">
                    <?php if($poster->image_manager_id){ ?>
                    <img id="notifi_<?php echo $poster->id;?>" class="img-avatar"
                        src="<?=\Yii::$app->imagemanager->getImagePath($poster->image_manager_id, 300, 300)?>"
                        alt="<?=$poster->name?>">
                    <?php }else{ ?>
                    <img class="img-avatar" id="notifi_<?php echo $poster->id;?>"
                        src="<?php echo Url::to('@web/images/no-image100x100.png', true); ?>"
                        alt="<?php echo $poster->name; ?>" />

                    <?php }?>
                    <label for="headAvatar" class="avatar-overlay">
                        <i class="fa fa-camera" aria-hidden="true"></i>
                    </label>
                    <input type="hidden" name="receiver[]" value="<?php echo $poster->id; ?>">
                </div>
                <div class="box-right">
                    <div>
                        <a class="name" title="<?php echo $poster->name;?>"
                            href="<?php echo Yii::$app->getUrlManager()->createUrl(['user/about','id' => $poster->id]);?>">
                            <?php echo substr($poster->name, 0, 30);?>
                        </a>
                        <!-- <span class="follow">(10 người) Theo dõi</span> -->
                        <br>
                        <div class="star" style="float:left; margin-right: 10px; height:28px;">
                            <img src="/images/star-on.png" alt="1">
                            <img src="/images/star-on.png" alt="2">
                            <img src="/images/star-on.png" alt="3">
                            <img src="/images/star-on.png" alt="4">
                            <img src="/images/star-off.png" alt="5">
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-8 col-xs-2 no-padding">
            <div class="index_nav desktop-topnav">
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
           
        </div>
    </div>
</div>
