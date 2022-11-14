
<?php
use  yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
$session = Yii::$app->session;
?>

<div class="header row row_nav" id="man-topnav">

<nav class="navbar navbar-expand-lg navbar-light bg-white">
<div class="container-fluid">
                                            <div class="box-body box-profile">
                                                <div class="user_avatar">
                                                    <?php if($user->image_manager_id){ ?>
                                                    <img id="notifi_<?php echo $user->id;?>" class="img-avatar"
                                                        src="<?=\Yii::$app->imagemanager->getImagePath($user->image_manager_id, 300, 300)?>"
                                                        alt="<?=$user->name?>">
                                                    <?php }else{ ?>
                                                    <img class="img-avatar" id="notifi_<?php echo $user->id;?>"
                                                        src="<?php echo Url::to('@web/images/no-image100x100.png', true); ?>"
                                                        alt="<?php echo $user->name; ?>" />

                                                    <?php }?>
                                                    <label for="headAvatar" class="avatar-overlay">
                                                        <i class="fa fa-camera" aria-hidden="true"></i>
                                                    </label>
                                                    <input type="hidden" name="receiver[]" value="<?php echo $user->id; ?>">
                                                </div>
                                                <div class="box-right">
                                                    <div>
                                                        <a class="name" title="<?php echo $user->name;?>"
                                                            href="<?php echo Yii::$app->getUrlManager()->createUrl(['/user/about']);?>">
                                                            <?php echo substr($user->name, 0, 30);?>
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
                                                         
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <?php foreach($categories as $key => $value){?>
                                                    
                                                    <li class="nav-item">
                                                    <a
                                                        class="nav-link <?php echo (Yii::$app->request->url==$value->slug)? 'class="active"':'';?>" href="/<?php echo $value->slug;?>" 
                                                    >
                                                    <?php echo $value->title;?>
                                                    </a>
                                                
                                                    </li>

                                
                                    <?php }?>
                                    <li class="nav-item dropdown">
                                                            <a class="nav-link dropdown-toggle"  id="navbarDropdownBlog"  data-bs-toggle="dropdown" href="#"> Xem thêm
                                                            </a>

                                                            <ul    class="dropdown-menu" aria-labelledby="navbarDropdownBlog">
                                                                                    <?php foreach($blogCategories as $item){?>
                                                                                <li>
                                                                                <a class="dropdown-item" <?php  echo (Yii::$app->request->url==yii::$app->urlManager->createUrl(['/blog/default/index', 'slug' => $item->slug]))? 'class="active"':'';?>
                                                                                    title="<?php echo  $item->title;?>"
                                                                                    href="<?php echo yii::$app->urlManager->createUrl(['/blog/default/index', 'slug' => $item->slug]) ?>"><?php echo  $item->title;?></a>
                                                                                    </li>
                                                                                    <?php }?>     

                                                            </ul>
                                    </li>
                                    <li class="nav-item d-none  d-lg-block d-xl-block ">
                                                    <?php if (Yii::$app->user->isGuest) { ?>
                                                            
                                                                    <a class="nav-link btn-post" title="Đăng tin"   href="<?php echo yii::$app->urlManager->createUrl(['/index/login']) ?>"><i class="fa fa-address-card" aria-hidden="true"></i> Đăng tin</a>
                                                         
                                                    <?php } else { ?>
                                                                <?php $user = Yii::$app->user->identity;?>
                                                               <a class=" nav-link  btn-post" title="Đăng tin"  href="<?php echo yii::$app->urlManager->createUrl(['/user/post']) ?>"><i class="fa fa-address-card" aria-hidden="true"></i> Đăng tin</a>
                                                      <?php } ?>
                                    </li>
                    
                </ul>
    </div>


      
        
        <!-- Simulate a smartphone / tablet -->
        <!-- Top Navigation Menu -->

    </div>
    </nav>
                                                    </div>
