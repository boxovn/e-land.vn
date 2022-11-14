<?php
use yii\helpers\Url;
?>
<div id="sidebar" class="sidebar mobile flex-column flex-shrink-0 p-3 bg-light">
                                    <a href="/" class="align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                                        <img class="sidebar-logo" src="<?php echo Yii::$app->getUrlManager()->baseUrl?>/e-land/img/logo.png"/>
                                    </a>
                                    <div id="dismiss">
                                        <span class="icon-close"></span>
                                    </div>
                                    <hr>
                                    <ul class="nav nav-pills flex-column mb-auto"> 
                                         <?php foreach($categories as $key => $value){?>
                                            <li class="nav-item">
                                                <a class="nav-link  link-dark   <?php echo ($value->slug=='mua-ban')?'item-buy': (($value->slug=='cho-thue')?'item-rent':'item-project');?>"  href="<?php echo $value->slug;?>">
                                                    <?php echo $value->title;?>
                                                </a>
                                            </li>
                                            <?php }?>
                                        </ul>  
                                       <?php if (Yii::$app->user->isGuest) { ?>
                                        <hr>
                                    <div class="block">

                                        <div lass="land-item-show">
                                            <p>
                                                <i class="fa fa-bullhorn" aria-hidden="true"></i> Hãy đăng nhập để đăng tin, bình luận và trao đổi
                                                với người đăng tin rao bán.
                                            </p>
                                            <a class="btn btn-login" title="Đăng nhập" href="<?php echo yii::$app->urlManager->createUrl(['index/login']) ?>"> Đăng nhập</a> 
                                            <a class="btn btn-register" title="Đăng ký"  href="<?php echo yii::$app->urlManager->createUrl(['index/register']) ?>"> Đăng ký</a>
                                        </div>
                                    </div>
                                    <?php }else {?>
                                    <?php $user = Yii::$app->user->identity;?>
                                    <hr>
                                    <ul class="nav nav-pills flex-column mb-auto"> 
                                        <li>
                                                              <p>
                                                                    <i class="fa fa-bullhorn" aria-hidden="true"></i> Đăng tin để tiếp cận khách hàng
                                                                </p>
                                                                <a class="btn btn-sm btn-post" role="button" title="Đăng tin rao"
                                                                    href="<?php echo yii::$app->urlManager->createUrl(['user/post']) ?>">
                                                                    <img src="/e-land/img/icon-send.png"> Đăng tin</a>
                                                         
                                        </li>
                                    </ul>
                                    <?php }?>
                                    <hr>
                                    <ul class="nav nav-pills flex-column mb-auto"> 
                                        <li>
                                        <a href="<?php echo yii::$app->urlManager->createUrl(['blog/default/index']) ?>" class="item-news nav-link link-dark">
                                            Tin tức
                                        </a>
                                        
                                        </li>
                                        <?php if($cards){?>
                                        <li>
                                            <a href="#" 
                                            data-bs-toggle="collapse" 
                                            aria-expanded="false"
                                            data-bs-target="#collapse-service" 
                                            class=" dropdown-toggle item-service nav-link link-dark"> Dịch vụ </a>
                                            <div class="collapse" id="collapse-service">
                                                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                                            <?php foreach ($cards as $key => $value){?>
                                                                <li><a class="dropdown-item" href="<?php echo $value->link;?>"><?php echo $value->title;?></a></li>
                                                            <?php }?>
                                                    </ul>
                                            </div>
                                        </li>
                                        <?php }?>

                                        <li><a href="<?php echo yii::$app->urlManager->createUrl(['about/index']) ?>" class="item-location nav-link link-dark"> Điểm giao dịch</a></li>
                                        <li> <a href="<?php echo yii::$app->urlManager->createUrl(['recruitment/index']) ?>" class="item-recruitment nav-link link-dark">Tuyển dụng </a></li>
                                        <li><a href="<?php echo yii::$app->urlManager->createUrl(['cooperation/index']) ?>" class="item-cooperation nav-link link-dark"> Hợp tác môi giới</a></li>
                                        <li>
                                        <a href="<?php echo yii::$app->urlManager->createUrl(['about/index']) ?>" class="item-about nav-link link-dark">
                                            Về E-land
                                        </a>
                                        </li>
                                        <li>
                                        <a href="<?php echo yii::$app->urlManager->createUrl(['contact/index']) ?>" class="item-hotline nav-link link-dark">
                                                 Liên hệ <br/>
                                                 Hotline: <?php echo $about->phone;?><br/>
                                                Mail:   <?php echo $about->email;?>
                                        </a>
                                        </li>
                                        <li>
                                        <a href="#" class="item-download nav-link link-dark">
                                            Tải ứng dụng
                                        </a>
                                        <div class="download-app">
                                            <a class="link-app" href="<?php echo $about->app_ios;?>"><img class="img-app" src="<?php echo Yii::$app->getUrlManager()->baseUrl?>/e-land/img/download-appstore.png"/></a>
                                            <a class="link-app" href="<?php echo $about->app_android;?>"><img  class="img-app" src="<?php echo Yii::$app->getUrlManager()->baseUrl?>/e-land/img/download-googleplay.png"/></a>
                                        </div>
                                        </li>
                                    </ul>  
                                    <?php if (!Yii::$app->user->isGuest) { ?>
                                    <hr>
                                        <div class="dropdown">
                                                        <a href="#" class="align-items-center link-dark text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                                                            
                                                            <img id="notifi_<?php echo $user->id;?>"width="32" height="32" class="rounded-circle me-2"  src="<?=\Yii::$app->imagemanager->getImagePath($user->image_manager_id, 300, 300)?>" alt="<?=$user->name?>">
                                                            <strong><?php echo $user->name;?></strong>
                                                        </a>
                                                        <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
                                                            <li><a class="dropdown-item" href=" <?php echo yii::$app->urlManager->createUrl(['user/about']) ?>">Kênh của tôi</a></li>
                                                            <li><a class="dropdown-item" href="<?php echo yii::$app->urlManager->createUrl(['user/post']) ?>">Đăng tin</a></li>
                                                            <li><a class="dropdown-item" href="<?php echo yii::$app->urlManager->createUrl(['user/index']) ?>">Tin đã đăng</a></li>
                                                            <li><a class="dropdown-item" href="<?php echo yii::$app->urlManager->createUrl(['user/article']) ?>">Chỉnh sửa bài viết</a></li>
                                                            <li><hr class="dropdown-divider"></li>
                                                            <li><a class="dropdown-item" href="<?php echo yii::$app->urlManager->createUrl(['user/logout']) ?>">Đăng xuất</a></li>
                                                        </ul>
                                        </div>
                                    <?php }  ?>
                                    
                                    <ul class="nav nav-pills flex-column mb-auto"> 
                                       
                                        <li>
                                        <a  class="nav-link link-dark"  
                                                <?php  echo (Yii::$app->request->url==Yii::$app->getUrlManager()->createUrl(['question/index']))? 'class="active"':'';?>
                                                title="Công cụ hỗ trợ mô giới"
                                                href="<?php echo yii::$app->urlManager->createUrl(['question/index']) ?>">Hỏi đáp</a>
                                        </li>
                                    </ul>
                                    
</div>

             