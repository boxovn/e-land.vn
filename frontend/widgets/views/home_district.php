<?php
use yii\helpers\Url;
?>
<?php if($province){?>
<?php $this->registerCSSFile(Yii::$app->request->baseUrl . '/css/widget-home-district.css'); ?>
<div class="section district">
    <div class="container">
        <div class="row row-head">
            <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                <h2 class="title">CÁC QUẬN HUYỆN NỔI BẬT
                </h2>
            </div>
            <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                <a class="btn btn-view" href="<?php echo Url::to(['province/index'], true)?>">XEM TẤT CẢ</a>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="row  row-mn">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        
                        <div class="grid-item">
                            
                            <a  href="<?php echo Url::to(['home/province', 'province' => $province->slug],true);?>">
                                <img  class="img"   src="<?php echo Url::to('@web/provinces/' . $province->image, true)?>"
                                alt="<?php echo $province->type;?> <?php echo $province->name;?>">
                                <div   class="backdrop-overlay">
                                    <div  class="place-name">
                                        <h4 ><?php echo $province->type;?> <?php echo $province->name;?></h4>
                                    </div>
                                    <div   class="place-info"> Bất động sản </div>
                                </div>
                            </a>
                            <a href="<?php echo Url::to(['home/province', 'province' => $province->slug],true);?>">
                                <div class="label-district">
                                    <img class="icon-district" src="<?php echo Yii::$app->getUrlManager()->baseUrl?>/e-land/img/icon-district.png"/>
                                    <div class="text-district ">
                                        <span class="dis"><?php echo $province->type;?> <?php echo $province->name;?></span>
                                        <span class="lab"> Khám phá <i class="home-icon home-icon-arrow"></i><span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="row row-mn">
                                <?php foreach($province->getDistricts()->orderBy('type desc, name asc')->offset(0)->limit(2)->all() as $key => $value){?>
                                <div  class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="grid-item">
                                        <a  href="<?php echo Url::to(['home/district', 'district' => $value->slug,'province' => $province->slug],true);?>">
                                            <img class="img"   src="<?php echo Url::to('@web/provinces/'. $province->slug  . '/' . $value->image, true)?>" alt="<?php echo $value->type;?> <?php echo $value->name;?>">
                                            <div   class="backdrop-overlay">
                                                <div  class="place-name">
                                                    <h4  ><?php echo $value->type;?> <?php echo $value->name;?></h4>
                                                </div>
                                                <div   class="place-info">
                                                    Bất động sản
                                                </div>
                                            </div>
                                        </a>
                                        <a href="<?php echo Url::to(['home/district', 'district' => $value->slug,'province' => $province->slug],true);?>">
                                            <div class="label-district">
                                                <img class="icon-district" src="<?php echo Yii::$app->getUrlManager()->baseUrl?>/e-land/img/icon-district.png"/>
                                                <div class="text-district">
                                                    <span class="dis"><?php echo $value->type;?> <?php echo $value->name;?></span>
                                                    <span class="lab"> Khám phá <i class="home-icon home-icon-arrow"></i></span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                        
                        
                    </div>
                    <div class="row row-mn">
                        
                        <?php foreach($province->getDistricts()->orderBy('type desc, name asc')->offset(2)->limit(6)->all() as $key => $value){?>
                        <div  class="col-lg-2 col-md-6 col-sm-12">
                            <div class="grid-item">
                                <a  href="<?php echo Url::to(['home/district', 'district' => $value->slug,'province' => $province->slug],true);?>">
                                    <img  class="img"   src="<?php echo Url::to('@web/provinces/'. $province->slug  . '/' . $value->image, true)?>" alt="<?php echo $value->type;?> <?php echo $value->name;?>">
                                    <div   class="backdrop-overlay">
                                        <div  class="place-name">
                                            <h4  ><?php echo $value->type;?> <?php echo $value->name;?></h4>
                                        </div>
                                        <div   class="place-info"> Bất động sản </div>
                                    </div>
                                </a>
                                <a href="<?php echo Url::to(['home/district', 'district' => $value->slug,'province' => $province->slug],true);?>">
                                    <div class="label-district small">
                                        <img class="icon-district" src="<?php echo Yii::$app->getUrlManager()->baseUrl?>/e-land/img/icon-district.png"/>
                                        <div class="text-district ">
                                            <span class="dis"><?php echo $value->type;?> <?php echo $value->name;?></span>
                                            <span class="lab"> Khám phá <i class="home-icon home-icon-arrow"></i></span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <?php } ?>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php }?>