
<?php if($cards){?>
<div class="section special">
                                    <div class="container">
                                    <!-- Three columns of text below the carousel -->
                                    <div class="row row-head">
                                        <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                                            <h2 class="title">Dịch vụ môi giới</h2>
                                        </div>
                                        <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                                            <a href="<?php echo yii::$app->urlManager->createUrl(['service/index']) ?>" class="btn btn-view">XEM TÂT CẢ</a> 
                                        </div>
                                    </div>
                                 
                                        <div class="row">
                                        <?php foreach ($cards as $key => $value){?>
                                        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 col-xl-3 col-xxl-3">
                                                        <div class="thumb">
                                                                    <a href="<?php echo $value->link;?>">
                                                                                <img class="img" src="<?php echo Yii::$app->getUrlManager()->baseUrl?>/cards/<?php echo $value->image;?>"/>
                                                                    </a>
                                                        </div>
                                        </div>
                                        <?php }?>
                                     
                                            </div><!-- /.row -->
                                    </div>
</div>
<?php }?>