<?php
use  yii\helpers\Url;
use yii\helpers\Html;
use common\models\Project;
use common\models\Article;
//$this->registerJsFile('https://code.jquery.com/jquery-2.2.0.min.js');
?>
<?php if($projects){?>
<div class="section project">
    <div class="container">
        <div class="row row-head">
            
            <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                <h2 class="title">DỰ ÁN BẤT ĐỘNG SẢN</h2>
            </div>
            <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                <a href="<?php echo Url::to(['project/index'],true);?>" class="btn btn-view">XEM TẤT CẢ</a>
            </div>
        </div>
        
    </div>
    <?php foreach($projects as $key => $value){?>
    <div class="container">
        <div class="row row-border">
            
            <div class="col-pro col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                <div class="thumb">
                    <a  title="<?php echo $value->name;?>"  href="<?php echo Url::to(['project/detail','slug' => $value->slug,'province' => isset($value->province)?$value->province->slug:'','district' => isset($value->district)? $value->district->slug:''],true);?>">
                        <img class="img"  alt="<?php echo isset($value->projectBanners[0])?$value->projectBanners[0]->file_name:'';?>"
                        onerror="if (this.src != 'error.jpg') this.src = '<?php echo Url::to('@web/images/no-image200x200.png', true)?>';"
                        src="<?php echo Url::to('@web/channels/projects/banner/' . (isset($value->projectBanners[0])?$value->projectBanners[0]->file_name:''), true);?>"/>
                    </a>
                    
                    <div class="label label-project"><h2><?php echo $value->name;?></h2></div>
                </div>
                <div class="description">
                    <?php
                    $dec=$value->getProjectSections()->andWhere(['like','slug','gioi-thieu%',false])->one();
                    echo  '<h3 style="text-align: center;">' . $dec['title'] . '</h3>';
                    
                    echo   \yii\helpers\StringHelper::truncateWords($dec['description'], 45, '...', false);?>
                </div>
                <div class="price">
                    <div class="price-left">
                        
                        Giá bán:  <?php echo $value->market_price_from?Yii::$app->formatter->asCurrency($value->market_price_from, ''):'<span title="Chưa cập nhập">Chờ cập nhập</span>';?>  ~  <?php echo $value->market_price_to?Yii::$app->formatter->asCurrency($value->market_price_to, ''):'<span title="Chờ cập nhập">Chờ cập nhập</span>';?><br/>
                        Giá thuê:  <?php echo $value->hire_price_from?Yii::$app->formatter->asCurrency($value->hire_price_from, ''):'<span title="Chờ cập nhập">Chờ cập nhập</span>';?> ~ <?php echo $value->hire_price_to?Yii::$app->formatter->asCurrency($value->hire_price_to, ''):'<span title="Chưa cập nhập">Chờ cập nhập</span>';?><br/>
                    </div>
                </div>
                    <div class="icon-dec">
                         <span class="price-right">
                        
                        <?php echo $value->price_square_metre?$value->price_square_metre. ' triệu/m2':'<span title="Chờ cập nhập">Chờ cập nhập</span> (triệu/m2)';?><br/>
                        <?php echo $value->rent_square_metre?$value->rent_square_metre. ' triệu/m2':'<span title="Chưa cập nhập">Chờ cập nhập</span> (triệu/m2)';?><br/>
                        </span>
                        <div>Tiến độ: <?php echo $value->progress?Project::getListProgress($value->progress):'<span title="Chưa cập nhập">Chờ cập nhập</span>';?></div>
                        <div>Quy mô:  <?php echo $value->scale?$value->scale:'<span title="Chưa cập nhập">Chờ cập nhập</span>';?> </div>
                        <div>Chủ đầu tư:
                            <?php if(isset($value->projectInvestors) && $value->projectInvestors){?>
                                    <?php foreach ($value->projectInvestors as $key => $investor) {?>
                                        <?php echo $investor->name? $investor->name:'<span title="Chờ cập nhập">Chờ cập nhập</span>';?> 
                                    <?php } ?>

                            <?php }else{ ?>
                                <span title="Chờ cập nhập">Chờ cập nhập</span>
                            <?php  } ?>
                        </div>
                    </div>
                <div class="address"><img src="<?php echo Yii::$app->getUrlManager()->baseUrl?>/e-land/img/infoicon (4).png"/>
                    <?php  echo (isset($value->district)?$value->district->type:'') . ' ' . (isset($value->district)?$value->district->name:'');?>, <?php echo isset($value->province)?$value->province->name:'';?>
                </div>
            </div>
            <?php foreach($value->getArticles()->limit(2)->orderBy('articles.created desc')->all() as $key => $value){?>
            <?php if($value->categoryType->category->slug=="mua-ban"){?>
            <div class="col-pro col-6 col-xs-6 col-sm-6 col-md-3 col-lg-3 col-xl-3 col-xxl-3">
                <div class="thumb">
                    <a title="<?php echo $value->title;?>" href="<?php echo Url::to(['article/detail', 'province' => isset($value->province)?$value->province->slug:'', 'district' => isset($value->district)?$value->district->slug:'','slug' => $value->slug],true);?>">
                        <img  onerror="if (this.src != 'error.jpg') this.src = '<?php echo Url::to('@web/images/no-image210x118.png', true)?>';" class="img" src="<?php echo Url::to('@web/channels/article/745x510/' . $value->image, true);?>"/>
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
                </div>
                <div class="label"><?php echo $value->categoryType->title;?></div>
                <div class="price">
                    <span class="price-left">
                        
                        <?php echo $value->price? Yii::$app->formatter->asCurrency($value->price) . '|' . $value->area . ' m2': $value->price_text . '|' . $value->area_text;?>
                    </span>
                    <span class="price-right"> <?php echo$value->area?Yii::$app->formatter->asCurrency(($value->price/$value->area)).'/m2':'(<span title="Chưa cập nhập">... </span>triệu/m2)';?></span>
                </div>
                <h3 class="wap-title">
                <a  class="title" title="<?php echo $value->title;?>" href="<?php echo Url::to(['article/detail', 'province' => isset($value->province)?$value->province->slug:'', 'district' => isset($value->district)?$value->district->slug:'', 'slug' => $value->slug],true);?>"><?php echo $value->title;?></a>
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
                        href="<?php echo Url::to(['/article/district','district' => $value->district->slug,'province' => $value->province->slug],true);?>">
                        <?php echo isset($value->district)?($value->district->type . ' '. $value->district->name):'';?>
                    </a>
                    <a title="<?php echo isset($value->province)?$value->province->name:'';?>"
                        href="<?php echo Url::to(['/article/province','province' => $value->province->slug],true);?>">
                        , <?php echo isset($value->province)?$value->province->name:'';?>
                    </a>
                    <?php }?>
                </div>
            </div>
            <?php } elseif($value->categoryType->category->slug=="cho-thue"){?>
            
            <div class="col-pro col-6 col-xs-6 col-sm-6 col-md-3 col-lg-3 col-xl-3 col-xxl-3">
                <div class="thumb">
                    <a title="<?php echo $value->title;?>" href="<?php echo Url::to(['rent/detail', 'province' => isset($value->province)?$value->province->slug:'', 'district' => isset($value->district)?$value->district->slug:'', 'slug' => $value->slug],true);?>">
                        <img  onerror="if (this.src != 'error.jpg') this.src = '<?php echo Url::to('@web/images/no-image210x118.png', true)?>';" class="img" src="<?php echo Url::to('@web/channels/article/745x510/' . $value->image, true);?>"/>
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
                </div>
                <div class="label"><?php echo $value->categoryType->title;?></div>
                <div class="price">
                    <span class="price-left">
                        <?php echo $value->price_rent? Yii::$app->formatter->asCurrency($value->price_rent) . '|' . $value->area . ' m2': $value->price_text . '|' . $value->area_text;?>
                    </span>
                    <span class="price-right">  <?php echo $value->area?Yii::$app->formatter->asCurrency(($value->price_rent/$value->area)).'/m2':'(<span title="Chưa cập nhập">... </span>triệu/m2)';?></span>
                </div>
                <h3 class="wap-title">
                <a  class="title" title="<?php echo $value->title;?>" href="<?php echo Url::to(['reny/detail', 'province' => isset($value->province)?$value->province->slug:'', 'district' => isset($value->district)?$value->district->slug:'', 'slug' => $value->slug],true);?>"><?php echo $value->title;?></a>
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
                        href="<?php echo Url::to(['/article/district','district' => $value->district->slug,'province' => $value->province->slug],true);?>">
                        <?php echo isset($value->district)?($value->district->type . ' '. $value->district->name):'';?>
                    </a>
                    <a title="<?php echo isset($value->province)?$value->province->name:'';?>"
                        href="<?php echo Url::to(['/article/province','province' => $value->province->slug],true);?>">
                        , <?php echo isset($value->province)?$value->province->name:'';?>
                    </a>
                    <?php }?>
                </div>
            </div>
            <?php }?>
            
            <?php }?>
        </div>
        
    </div>
    
    <?php }?>
</div>
<?php }?>