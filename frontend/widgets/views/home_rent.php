<?php
use  yii\helpers\Url;
use yii\helpers\Html;
use common\models\Article;
//$this->registerJsFile('https://code.jquery.com/jquery-2.2.0.min.js');
?>
<?php if($articles){?>
<div class="section purchase">
    <div class="container">
         <div class="row row-head">
            <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                <h2 class="title">CHO THUÊ BẤT ĐỘNG SẢN</h2> 
            </div>
            <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
            <?php if($districts){?>
                <a href="<?php echo Url::to(['home/province','province' => $districts[0]->province->slug],true);?>" class="btn btn-view"><?php echo (($districts && $districts[0]->province)?$districts[0]->province->name:'Toàn quốc');?></a>
            <?php } else {?>
                <a href="<?php echo Url::to(['province/index'],true);?>" class="btn btn-view"><?php echo (($districts && $districts[0]->province)?$districts[0]->province->name:'Toàn quốc');?></a>
            <?php } ?>
            </div>
        </div>
        <div class="row row-slider">
            <div class="col">
                <?php if($districts){ ?>
                <section class="center slider">
                    <div>

                        <div class="img all"><a href="<?php echo Url::to(['home/province','province' => $districts[0]->province->slug],true);?>">Tất cả</a></div>
                    </div>
                    <?php  foreach($districts as $key => $value){ ?>
                    <div>
                        <div class="img"><a href="<?php echo Url::to(['home/district','district' => $value->slug, 'province' => $value->province->slug],true);?>"><?php echo $value->type ;?> <?php echo $value->name;?></a></div>
                    </div>
                    <?php }?>
                    
                </section>
                <?php }else { ?>

                    <section class="center slider">
                    <div>
                        <div class="img all"><a href="<?php echo Url::to(['province/index'],true);?>">Tất cả</a></div>
                    </div>
                    <?php  foreach($provinces as $key => $value){ ?>
                    <div>
                        <div class="img"><a href="<?php echo Url::to(['home/province','province' => $value->slug],true);?>"><?php echo $value->type ;?> <?php echo $value->name;?></a></div>
                    </div>
                    <?php }?>
                    
                </section>

                <?php }?>
            </div>
        </div>
        <div class="row">
            <?php foreach($articles as $key => $value){?>
            <div class="col-sm-6 col-md-3 col-lg-3 col-xl-3 col-xxl-3">
                <div class="box">
                    <div class="thumb">
                        <a title="<?php echo $value->title;?>" href="<?php echo Url::to(['/rent/detail', 'province' => isset($value->province)?$value->province->slug:'', 'district' => isset($value->district)?$value->district->slug:'', 'slug' => $value->slug],true);?>">
                            <img  onerror="if (this.src != 'error.jpg') this.src = '<?php echo Url::to('@web/images/no-image200x200.png', true)?>';" class="img" src="<?php echo Url::to('@web/channels/article/745x510/' . $value->image, true);?>"/>
                        </a>
                        <div
                            data-bs-backdrop="false"
                            data-bs-toggle="modal" data-bs-target="#modalLanding"
                            data-slug="<?php echo $value->slug;?>"
                            data-id="<?php echo $value->id;?>"
                            data-url="<?php echo Url::to(['/home/modal-article-detail', 'slug' => $value->slug],true);?>"
                            data-href="<?php echo Url::to(['/rent/detail', 'province' => isset($value->province)?$value->province->slug:'', 'district' => isset($value->district)?$value->district->slug:'','slug' => $value->slug],true);?>"
                            class="video">
                            <img class="icon-video" src="<?php echo Yii::$app->getUrlManager()->baseUrl?>/e-land/img/thumbicon-video.png"/>
                        </div>
                        <div
                            data-bs-backdrop="false"
                            data-bs-toggle="modal" data-bs-target="#modalLanding"
                            data-slug="<?php echo $value->slug;?>"
                            data-id="<?php echo $value->id;?>"
                            data-url="<?php echo Url::to(['/home/modal-article-detail', 'slug' => $value->slug],true);?>"
                            data-href="<?php echo Url::to(['/rent/detail', 'province' => isset($value->province)?$value->province->slug:'', 'district' => isset($value->district)?$value->district->slug:'','slug' => $value->slug],true);?>"
                            class="photo">
                            <img class="icon-photo" src="<?php echo Yii::$app->getUrlManager()->baseUrl?>/e-land/img/thumbicon-photo.png"/>
                        </div>
                        <span class="label"><?php echo $value->categoryType->title;?></span>
                    </div>
                    <div class="box-body">
                        <div class="price">
                            <span class="price-left">
                                
                                <?php echo $value->price_rent? Yii::$app->formatter->asCurrency($value->price_rent) . '|' . $value->area . ' m2': $value->price_text . '|' . $value->area_text;?>
                            </span>
                            <span class="price-right"> <?php echo $value->area?Yii::$app->formatter->asCurrency(($value->price_rent/$value->area)).'/m2':'(<span title="Chưa cập nhập">... </span>triệu/m2)';?></span>
                            
                        </div>
                        <h3 class="wap-title">
                        <a  class="title" title="<?php echo $value->title;?>" href="<?php echo Url::to(['/rent/detail', 'province' => isset($value->province)?$value->province->slug:'', 'district' => isset($value->district)?$value->district->slug:'', 'slug' => $value->slug],true);?>"><?php echo $value->title;?></a>
                        </h3>
                         <div class="icon-dec">
                     <span><img src="<?php echo Yii::$app->getUrlManager()->baseUrl?>/e-land/img/infoicon (1).png"/><?php echo Article::getListDirection(isset($value->articleDetail)?$value->articleDetail->direction:0);?></span>
                    <span><img src="<?php echo Yii::$app->getUrlManager()->baseUrl?>/e-land/img/infoicon (2).png"/> <?php echo isset($value->articleDetail)?$value->articleDetail->toilet:'';?></span>
                    <span><img src="<?php echo Yii::$app->getUrlManager()->baseUrl?>/e-land/img/infoicon (3).png"/> <?php echo isset($value->articleDetail)?$value->articleDetail->bedroom:'';?></span>
                </div>
                        <div class="address">
                            <img src="<?php echo Yii::$app->getUrlManager()->baseUrl?>/e-land/img/infoicon (4).png"/>
                            <?php if(isset($value->district) && isset($value->province)){?>
                            <a title="<?php echo isset($value->district)?($value->district->type . ' ' . $value->district->name):'';?>"
                                href="<?php echo Url::to(['/rent/district','district' => $value->district->slug,'province' => $value->province->slug],true);?>">
                                <?php echo isset($value->district)?($value->district->type . ' '. $value->district->name):'';?>
                            </a>
                            <a title="<?php echo isset($value->province)?$value->province->name:'';?>"
                                href="<?php echo Url::to(['/rent/province','province' => $value->province->slug],true);?>">
                                , <?php echo isset($value->province)?$value->province->name:'';?>
                            </a>
                            <?php }?>
                        </div>
                    </div>
                </div>
            </div>
            <?php }?>
        </div>
    </div>
</div>
<?php }?>