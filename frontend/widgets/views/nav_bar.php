<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use  yii\helpers\Url;
?>
<div class="box-search-result">
</div>
<!-- Simulate a smartphone / tablet -->
<!-- Top Navigation Menu -->
<div class="topnav">
    <div class="nav navbar  navbar-light ">
        <button id="openNav" class="openNav nav-height w3-bar-item w3-button w3-padding-16"><span class="navbar-toggler-icon"></span></button>
        <button id="closeNav" class="closeNav nav-height w3-bar-item w3-button w3-padding-16"><span class="navbar-toggler-icon"></span></button>
        <a href="<?php echo Yii::$app->params['elandUrl']; ?>" class="active"> <img alt="Eland" class="img-logo"
                src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/e-land/img/logo.png" /></a>
    </div>
    <?php if (Yii::$app->user->isGuest) { ?>
    <a href="javascript:void(0);" class="icon search icon-2">
        <i class="fa fa-search"></i>
    </a>
    <a class="icon info icon-1" title="Đăng nhập"
        href="<?php echo yii::$app->urlManager->createUrl(['/index/login']) ?>"><i class="fas fa-sign-in-alt"></i></a>
    <?php } else { 
				$user = Yii::$app->user->identity;
        	?>
    <a href="javascript:void(0);" class="icon search icon-3">
        <i class="fa fa-search"></i>
    </a>
    <a target="_blank" href="<?php echo Yii::$app->params['url-page-chat'];?>home?sender_id=<?php echo  $user->id; ?>"
        class="icon chat icon-2">
          <i class="fas fa-comments"></i>
        <span id="total_notifi_<?php echo  $user->id;?>"
            <?php echo $totalMessage? 'class="notifi_message"':'';?>><?php echo $totalMessage;?></span>
    </a>
    <a href="javascript:void(0);" class="icon info icon-1">
        <i class="fa fa-user-circle"></i>
    </a>
    <div id="list-user-info">
        <div class="list">
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
              <div class="item"><a
                        href="<?php echo yii::$app->urlManager->createUrl(['/user/about']) ?>"
                        class="w3-bar-item w3-button w3-padding-16 w3-right">Kênh của tôi</a></div>

                <div class="item"><a
                        href="<?php echo yii::$app->urlManager->createUrl(['/user/post']) ?>"
                        class="w3-bar-item w3-button w3-padding-16 w3-right">Đăng tin</a></div>
                <div class="item"><a
                        href="<?php echo yii::$app->urlManager->createUrl(['/user/index']) ?>"
                        class="w3-bar-item w3-button w3-padding-16 w3-right">Tin đã đăng</a></div>
                <div class="item"><a
                        href="<?php echo yii::$app->urlManager->createUrl(['/user/article']) ?>"
                        class="w3-bar-item w3-button w3-padding-16 w3-right">Chỉnh sửa bài viết</a></div>
                <div class="item"><a href="<?php echo yii::$app->urlManager->createUrl(['/user/logout']) ?>"
                        class="w3-bar-item w3-button w3-padding-16 w3-right"> Đăng xuất</a></div>
        </div>

    </div>
    <?php }?>
    <div id="list-search">
        <div class="list">
            <div class="item item-info">
                <input class="form-control input-sm search" type="search" name="search" placeholder="Tìm kiếm"
                    autocomplete="off">
            </div>
        </div>
    </div>
</div>

<div id="nav-bar" class="navbar  navbar-light nav-bar nav-large w3-bar">
<div class="container-fluid">
    <div class="nav-left">
        <button id="openNav" class="openNav  w3-bar-item w3-button w3-padding-16"
            style="display: none;"><span class="navbar-toggler-icon"></span></button>
        <button id="closeNav" class="closeNav  w3-bar-item w3-button w3-padding-16"><span class="navbar-toggler-icon"></span></button>
        <a title="Eland" class="navbar-brand" href="<?php echo Yii::$app->params['elandUrl']; ?>">
            <img alt="Eland" class="img-logo"
                src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/e-land/img/logo.png" /></a>
    </div>
    <div class="middle">
        <div class="box-search">
            <input class="form-control input-sm search" type="search" name="search" placeholder="Tìm kiếm"
                autocomplete="off">
        </div>
    </div>
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
        <?php if (Yii::$app->user->isGuest) { ?>
        <a class="btn btn-login" title="Đăng nhập" href="<?php echo yii::$app->urlManager->createUrl(['/index/login']) ?>">Đăng
            nhập <i class="fas fa-sign-in-alt"></i></a>
        <?php } else { ?>
        <?php $user = Yii::$app->user->identity;?>
        <div class="dropdown chatbox-notification">
            <button class="dropbtn">
            <i class="fas fa-comments"></i>
                <span id="total_notifi_<?php echo  $user->id;?>"
                    <?php echo $totalMessage? 'class="notifi_message"':'';?>><?php echo $totalMessage;?></span>

            </button>
            <div class="dropdown-content">
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
            <button class="dropbtn">
                <i class="fa fa-user-circle"></i>
            </button>
            <div class="dropdown-content">
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
                <div class="item"><a
                        href="<?php echo yii::$app->urlManager->createUrl(['/user/about']) ?>"
                        class="w3-bar-item w3-button w3-padding-16 w3-right">Kênh của tôi</a></div>

                <div class="item"><a
                        href="<?php echo yii::$app->urlManager->createUrl(['/user/post']) ?>"
                        class="w3-bar-item w3-button w3-padding-16 w3-right">Đăng tin</a></div>
                <div class="item"><a
                        href="<?php echo yii::$app->urlManager->createUrl(['/user/index']) ?>"
                        class="w3-bar-item w3-button w3-padding-16 w3-right">Tin đã đăng</a></div>
                <div class="item"><a
                        href="<?php echo yii::$app->urlManager->createUrl(['/user/article']) ?>"
                        class="w3-bar-item w3-button w3-padding-16 w3-right">Chỉnh sửa bài viết</a></div>
                <div class="item"><a href="<?php echo yii::$app->urlManager->createUrl(['/user/logout']) ?>"
                        class="w3-bar-item w3-button w3-padding-16 w3-right"> Đăng xuất</a></div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
</div>
<script>

                             
function setProvince(province_id){
                console.log(province_id);
                $.ajax({
                        type: 'get',
                        url: "<?php echo yii::$app->urlManager->createUrl(['home/session-set-province']) ?>",
                        data: {province_id: province_id},
                        dataType: 'json',
                        success: function(res) {
                               location.reload();
                              
                            }
                    });
 }


</script>