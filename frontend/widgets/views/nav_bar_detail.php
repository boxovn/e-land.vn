<div id="nav-bar-detail" class="w3-bar">
    <div class="nav-left">
        <button id="closeNav" style="display: none;" class="w3-bar-item w3-button w3-padding-16" onclick="w3_close()">&#9776;</button>
         <button  id="openNav"   class="w3-bar-item w3-button w3-padding-16"  onclick="w3_open()">&#9776;</button>
        <a title="E-land.vn" href="<?php echo Yii::$app->params['elandUrl']; ?>" ><img alt="E-land" class="logo" src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/e-land/img/logo.png"/></a>
   </div>
    <div class="nav-middle">
        <div class="block-item">
            <form id="w0" action="/result" method="get">
				<input type="text" id="search-text" class="w3-bar-item w3-input nav-input" name="search_text" value="<?php echo $search_text;?>" placeholder="Tìm kiếm..">
				<button type="submit" class="w3-bar-item w3-button land-button-search"><i class="fa fa-search"></i></button>
			</form>
        </div>
    </div>
    <div class="nav-right">
        <?php if (Yii::$app->user->isGuest) { ?>
            <a class="login w3-bar-item w3-button w3-right" href="<?php echo yii::$app->urlManager->createUrl(['index/login']) ?>" ><i class="fa fa-sign-in" aria-hidden="true"></i></a>
        <?php } else { ?>
            <div class="dropdown">
                <button class="dropbtn">
                    <i class="fa fa-user-circle"></i>
                </button>
                <div class="dropdown-content">
                    <div class="user-info">
                            <?php $user = Yii::$app->user->identity;?>
                            <img class="img" src="<?php echo Yii::$app->params['url-image'];?><?php echo $user->image?$user->image:'no-image.png';?>"/>
                            <div class="content-user">
                                <div class="name"><?php echo $user->name;?></div>
                                <div class="email"><?php echo $user->email;?></div>
                                <div class="email"><?php echo $user->phone;?></div>
                            </div>
                        </div>
                    <div class="item"><a href="<?php echo yii::$app->urlManager->createUrl(['user/index']) ?>" class="w3-bar-item w3-button w3-padding-16 w3-right"><i class="fa fa-user-circle" aria-hidden="true"></i> Kênh của tôi</a></div>
                    <div class="item"><a href="<?php echo yii::$app->urlManager->createUrl(['user/logout']) ?>" class="w3-bar-item w3-button w3-padding-16 w3-right"><i class="fa fa-sign-out" aria-hidden="true"></i> Đăng xuất</a></div>
                    <div class="item"><a href="javascript:void(0)" data-toggle="modal" data-target="#myModal" class="w3-bar-item w3-button w3-padding-16 w3-right"><i class="fa fa-upload"></i> Đăng bài</a></div>
                </div>
            </div> 
        <?php } ?>


    </div>

</div>