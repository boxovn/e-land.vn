<?php
    use yii\helpers\Url;
?>
<div class="section category">
                                    <div class="container">
                                    <!-- Three columns of text below the carousel -->
                                    <div class="row">
                                        <div class="col-3 col-ct">
                                        <a href="<?php echo Url::to(['article/category', 'category' => 'ban-nha-rieng'],true);?>">
                                        <img  class="img"  src="<?php echo Yii::$app->getUrlManager()->baseUrl?>/e-land/img/service (1).png"/>
                                        <div>Mua nhà</div>
                                        </a>
                                        </div>
                                        <!-- /.col-lg-4 -->
                                        <div class="col-3 col-ct">
                                        <a href="<?php echo Url::to(['rent/category', 'category' =>  'cho-thue-nha-rieng'],true);?>">
                                        <img  class="img"  src="<?php echo Yii::$app->getUrlManager()->baseUrl?>/e-land/img/service (2).png"/>
                                        <div>Thuê nhà</div>
                                        </a>
                                        </div><!-- /.col-lg-4 -->
                                    <div  class="col-3 col-ct">
                                        <a href="<?php echo Url::to(['article/category', 'category' =>  'ban-can-ho-chung-cu'],true);?>">
                                        <img  class="img"  src="<?php echo Yii::$app->getUrlManager()->baseUrl?>/e-land/img/service (3).png"/>
                                        <div>Mua căn hộ</div>
                                        </a>
                                        </div><!-- /.col-lg-4 -->
                                    <div  class="col-3 col-ct">
                                        <a href="<?php echo Url::to(['rent/category', 'category' => 'cho-thue-can-ho-chung-cu'],true);?>">
                                        <img  class="img"  src="<?php echo Yii::$app->getUrlManager()->baseUrl?>/e-land/img/service (4).png"/>
                                        <div>Thuê căn hộ</div>
                                        </a>
                                        </div><!-- /.col-lg-4 -->
                                        <div class="col-3 col-ct">
                                        <a href="<?php echo Url::to(['article/category', 'category' => 'ban-dat'],true);?>">
                                        <img  class="img"  src="<?php echo Yii::$app->getUrlManager()->baseUrl?>/e-land/img/service (5).png"/>
                                        <div>Mua đất nền</div>
                                        </a>
                                        
                                        </div><!-- /.col-lg-4 -->
                                        <div  class="col-3 col-ct">
                                        <a href="<?php echo Url::to(['article/category', 'category' =>'ban-dat-nen-du-an-dat-trong-du-an-quy-hoach'],true);?>">
                                        <img  class="img" src="<?php echo Yii::$app->getUrlManager()->baseUrl?>/e-land/img/service (6).png"/>
                                        <div class="title"> Mua đất nền<br/> dự án</div>
                                        </a>
                                        
                                        </div><!-- /.col-lg-4 -->
                                          <div  class="col-3 col-ct">
                                        <div data-bs-backdrop="false" data-bs-toggle="modal"
                                         data-bs-target="#modalRegisterEmail" data-url="<?php echo Url::to(['/home/modal-register-email'],true);?>">
                                        <img  class="img"  src="<?php echo Yii::$app->getUrlManager()->baseUrl?>/e-land/img/service (7).png"/>
                                        <div>Yêu cầu <br/> gửi BĐS  cho bạn</div>
                                        </div>
                                        
                                        </div><!-- /.col-lg-4 -->
                                        <div  class="col-3 col-ct">
                                        <div data-bs-toggle="modal" data-bs-target="#modalContact" >
                                        <img  class="img" src="<?php echo Yii::$app->getUrlManager()->baseUrl?>/e-land/img/service (8).png"/>
                                        <div> Liên hệ </div>
                                        </div>
                                        </div><!-- /.col-lg-4 -->
                                    </div><!-- /.row -->
                                    </div>
</div>