<?php
use yii\helpers\Url;
use yii\helpers\Html;

?>
<header class="mb-auto">
    <div class="toolbar">
        <div class="row">
            <div class="col-md-12 col-lg-6 col-xl-6 col-xll-6 col d-none d-sm-block d-sm-none d-md-block">
                <a href="#"
                    >E-land.VN nền tảng đăng tin rao bán, cho thuê bất động sản miễn phí</a
                >
            </div>
            <div class="col-12 col-xs-12 col-md-12 col-lg-6 col-xl-6 col-xll-6 hot-line">
                <!--- ben gin -->
                <div class="row">
                    <div class="col">
                        <a href="tel: 035-9696-234">
                            <img src="<?php echo Yii::$app->getUrlManager()->baseUrl?>/e-land/img/icon-phone.png"/>
                            <span class="phone-text">Tổng đài CSKH</span>
                            <span class="phone-number"><?php echo $about->phone;?></span>
                        </a>
                    </div>
                    <div class="col">
                        <div class="nav-right">
                            <div class="province">
                                <?php
                                $session = Yii::$app->session;
                                echo Html::dropDownList('province',
                                $session->get('province_id'),
                                $provinces,
                                ['onchange'=>'setProvince(this.value);', 'prompt'=>'Toàn Quốc', 'class' => 'form-select province', 'id' => 'province_id']
                                );
                                ?>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <!--- end -->
            </div>
        </div>
        
    </div>
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?php echo yii::$app->urlManager->createUrl(['home/index']) ?>">
                <img class="img-logo" src="<?php echo Yii::$app->getUrlManager()->baseUrl?>/e-land/img/logo.png"/>
            </a>

            <button
            id="sidebarCollapse"
            class="navbar-toggler"
            type="button"
            
            >
            <span class="navbar-toggler-icon"></span>
            </button>

            <?php $controllerl = Yii::$app->controller;
            $homecheker = $controllerl->id.'/'.$controllerl->action->id;
            ?>
          <?php if($homecheker=='map/search'){?>
             <button
            id="sidebarMapCollapse"
            class="navbar-toggler"
            type="button"
            
            >
            Tìm kiếm
            </button>
            <?php }else{?>
                <a id="sidebarMapCollapse"
            class="btn btn-sm navbar-toggler"
            href="<?php echo yii::$app->urlManager->createUrl(['/map/search']) ?>">
                           Bản đồ
                        </a>
            <?php }?>
            
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav navbar-nav-left me-auto mb-2 mb-lg-0">
                    <?php foreach($categories as $key => $value){?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo Url::home(true);?><?php echo $value->slug;?>">
                            <?php echo $value->title;?>
                        </a>
                    </li>
                    <?php }?>
                </ul>
                <ul class="navbar-nav navbar-nav-right mb-2 mb-md-0 d-flex">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="<?php echo yii::$app->urlManager->createUrl(['/map/search']) ?>">E-map (bản đồ)</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="<?php echo yii::$app->urlManager->createUrl(['/province/index']) ?>">Tỉnh thành</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="<?php echo yii::$app->urlManager->createUrl(['/blog/default/index']) ?>">Tin tức</a>
                    </li>
					<li class="nav-item">
                        <a class="nav-link" aria-current="page" href="<?php echo yii::$app->urlManager->createUrl(['/landing/index']) ?>">Ký gửi</a>
                    </li>
				
                    <?php if($cards){?>
                    <li class="nav-item dropdown">
                        <a
                            class="nav-link dropdown-toggle"
                            href="#"
                            id="navbarDropdownService"
                            role="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                            >
                            Dịch vụ
                        </a>
                        <ul
                            class="dropdown-menu"
                            aria-labelledby="navbarDropdownService"
                            >
                            <?php foreach ($cards as $key => $value) {?>
                                <li><a class="item dropdown-item" href="<?php echo $value->link;?>"><?php echo $value->title;?></a></li>
                            <?php }?>
                           
                        </ul>
                    </li>
                    <?php }?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo yii::$app->urlManager->createUrl(['/recruitment/index']) ?>">Tuyển dụng</a>
                    </li>

                    <?php if (Yii::$app->user->isGuest) { ?>
                        <li class="nav-item">
                                 <a class="nav-link btn-post showLogin" data-url="https://e-land.vn/home/modal-article-login" data-bs-toggle="modal" data-bs-target="#modalLogin" title="Đăng nhập" href="/dang-nhap"><i class="icon icon-login"></i> Đăng tin</a>
                        </li>
                    <li class="nav-item">
                        <a class="nav-link btn-login showLogin" data-url="https://e-land.vn/home/modal-article-login" data-bs-toggle="modal" data-bs-target="#modalLogin" title="Đăng nhập" href="<?php echo yii::$app->urlManager->createUrl(['/index/login']) ?>"><i class="icon icon-login"></i> Đăng nhập</a>
                    </li>
                    
                    <?php }else{ ?>
                        <li class="nav-item">

                        <a class="nav-link btn-post" href="<?php echo yii::$app->urlManager->createUrl(['/user/post']) ?>"><img src="<?php echo Yii::$app->getUrlManager()->baseUrl?>/e-land/img/icon-send.png"/> Đăng tin</a>
                       
                    </li >
                    <?php } ?>
                    
                    <?php if (!Yii::$app->user->isGuest){?>
                    <li class="nav-item">
                        <div class="nav-right">
                            <?php $user = Yii::$app->user->identity;?>
                            <div class="dropdown chatbox-notification">
                                <button  class="dropbtn"  id="navbarDropdownMessager" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-comments"></i>
                                <span id="total_notifi_<?php echo  $user->id;?>"
                                <?php echo $totalMessage? 'class="notifi_message"':'';?>><?php echo $totalMessage;?></span>
                                </button>
                                <div   class="dropdown-content dropdown-menu dropdown-menu-white" aria-labelledby="navbarDropdownMessager">
                                    <div class="item header-box">
                                        Tin nhắn
                                    </div>
                                    <div class="content-box content-box_<?php echo  $user->id;?>">
                                        <?php foreach($userHistories as $key => $value){?>
                                        <?php  if($value['read']){?>
                                        <div id="<?php echo  $value['sender_id'];?>_<?php echo  $value['receiver_id'];?>" class="item"
                                            onclick="register_popup('<?php echo $value['room'];?>',<?php echo $user->id;?>,'<?php echo preg_replace( "/\r|\n/", "", $user->name);?>',<?php echo $value['sender_id']; ?>,'<?php echo preg_replace( "/\r|\n/", "",  $value['sender_name']);?>')">
                                            <?php if(@getimagesize(Url::to('@web/channels/'. $model->id .'/avatar/' . $value['sender_image'], true))){ ?>
                                            <img class="img"
                                            src="<?php echo Url::to('@web/channels/avatar/' . $value['sender_image'], true)?>" />
                                            <?php } else {?>
                                            <img class="img" src="<?php echo Url::to('@web/images/no-image100x100.png', true)?>" />
                                            <?php }?>
                                            <p class="name"><small><?php echo $value['sender_name'];?></small><span
                                                id="notifi_<?php echo  $value['sender_id'];?>_<?php echo  $value['receiver_id'];?>"
                                            <?php echo $value['unread']?'class="unread"':'';?>><?php echo $value['unread']?$value['unread']:'';?></span>
                                        </p>
                                        <p class="message"><?php echo $value['message'];?></p>
                                    </div>
                                    <?php }else{ ?>
                                    <div id="<?php echo  $value['sender_id'];?>_<?php echo  $value['receiver_id'];?>"
                                        class="item bg-unread alert-info"
                                        onclick="register_popup('<?php echo $value['room'];?>',<?php echo $user->id;?>,'<?php echo preg_replace( "/\r|\n/", "", $user->name);?>',<?php echo $value['sender_id']; ?>,'<?php echo preg_replace( "/\r|\n/", "",  $value['sender_name']);?>')">
                                        <?php if(@getimagesize(Url::to('@web/channels/'. $model->id .'/avatar/' . $value['sender_image'], true))){ ?>
                                        <img class="img"
                                        src="<?php echo Url::to('@web/channels/avatar/' . $value['sender_image'], true)?>" />
                                        <?php } else {?>
                                        <img class="img" src="<?php echo Url::to('@web/images/no-image100x100.png', true)?>" />
                                        <?php }?>
                                        <p class="name"><small><?php echo $value['sender_name'];?> </small><span
                                            id="notifi_<?php echo  $value['sender_id'];?>_<?php echo  $value['receiver_id'];?>"
                                        <?php echo $value['unread']?'class="unread"':'';?>><?php echo $value['unread']?$value['unread']:'';?></span>
                                    </p>
                                    <p class="message"><?php echo $value['message'];?></p>
                                </div>
                                <?php }?>
                                <?php }?>
                            </div>
                            <div class="item footer-box">
                                <a target="_blank"
                                    href="<?php echo Yii::$app->params['url-page-chat'];?>home?sender_id=<?php echo  $user->id; ?>">
                                    Xem tất cả
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown news-notification">
                        <div class="dropdown-content">
                        </div>
                    </div>
                    <div class="dropdown user-info">
                        <button class="dropbtn"  id="navbarDropdownUser" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-user-circle"></i>
                        </button>
                        <div class="dropdown-content dropdown-menu dropdown-menu-white" aria-labelledby="navbarDropdownUser">
                            <div class="item item-info">
                                <img id="notifi_<?php echo $user->id;?>" class="img"
                                src="<?=\Yii::$app->imagemanager->getImagePath($user->image_manager_id, 300, 300)?>"
                                alt="<?=$user->name?>">
                                
                                <div class="content-user">
                                    <div class="name"><?php echo $user->name;?></div>
                                    <div class="email"><?php echo $user->email;?></div>
                                    <div class="phone"><?php echo $user->phone;?></div>
                                </div>
                            </div>
                            <div class="item"><a  class="list-group-item list-group-item-action" href="<?php echo yii::$app->urlManager->createUrl(['user/about']) ?>">Kênh của tôi</a></div>
                            <div class="item"><a  class="list-group-item list-group-item-action" href="<?php echo yii::$app->urlManager->createUrl(['user/post']) ?>">Đăng tin</a></div>
                            <div class="item"><a  class="list-group-item list-group-item-action" href="<?php echo yii::$app->urlManager->createUrl(['user/index']) ?>">Tin đã đăng</a></div>
                            <div class="item"><a  class="list-group-item list-group-item-action" href="<?php echo yii::$app->urlManager->createUrl(['user/article']) ?>">Chỉnh sửa bài viết</a></div>
                            <div class="item"><a class="list-group-item list-group-item-action" href="<?php echo yii::$app->urlManager->createUrl(['user/logout']) ?>">Đăng xuất</a></div>
                        </div>
                    </div>
                    
                </li>
                <?php }else{?>
                <div class="nav-right">
                    <div class="dropdown chatbox-notification">
                        <button type="button" class="dropbtn showLogin"  data-url="<?php echo Url::to(['home/modal-article-login'], true);?>"   data-bs-toggle="modal"   data-bs-target="#modalLogin">
                        <i class="fas fa-comments" aria-hidden="true"></i>
                        <span title="Quý khách đang có tin nhắn" id="total_notifi_37876" class="notifi_message">1</span>
                        </button>
                        
                    </div>
                </div>
                <?php } ?>
                
            </ul>
        </div>
    </div>
</nav>
</header>
<script>

function setProvince(province_id){

       
    $.ajax({
        type: 'get',
        url: "<?php echo yii::$app->urlManager->createUrl(['home/session-set-province']) ?>",
        data: {province_id: province_id},
        dataType: 'json',
         success: function(res) {
        //zconsole.log('123');
         location.reload();

        }
    });
}


</script>