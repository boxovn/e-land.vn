<?php
use  yii\helpers\Url;
use yii\widgets\LinkPager;
use common\models\BuildingProjectInfo;
use yii\widgets\ActiveForm;
use frontend\widgets\AuthChoiceCustom;
use yii\helpers\Html;
use common\libraries\PseudoCrypt;
use frontend\widgets\Footer;
use frontend\widgets\HeaderPosterDetail;
use yii\grid\GridView;

?>
<?php echo HeaderPosterDetail::widget();?>
<div class="body">
    
    <div id="container">
        <div class="tab-content">
            <div id="list-box" class="list-box">
                <h1><?= Html::encode($this->title) ?></h1>
                <?php foreach ($models as $key => $value) { 
										$image = $value->image;?>
                <div class="column">
                    <a class="box-image"
                        href="<?php echo Url::to(['article/detail', 'province' => isset($value->province)?$value->province->slug:'', 'district' => isset($value->district)?$value->district->slug:'', 'type' => isset($value->articleType)?$value->articleType->slug:'', 'slug' => $value->slug],true);?>">
                        <img onerror="this.src = '<?php echo Url::to('@web/images/no-image210x118.png', true)?>';"
                            width="210px" height="118px" class="image" alt="<?php echo $value->title; ?>"
                            src="<?php echo Url::to('@web/channels/article/210x118/' . $image, true)?>" />
                    </a>
                    <div class="box-description">
                        <div class="box-label">
                            <div style="width: calc(100% - 28px); float:left;">
                                <span title="Giá <?php echo $value->price_text; ?>">Giá:
                                    <?php echo $value->price_text; ?></span>
                                <span title="Diện tích <?php echo $value->area_text; ?>">Diện tích :
                                    <?php echo $value->area_text; ?></span>
                            </div>

                        </div>
                        <div class="wap-title"><a title="<?php echo $value->title; ?>" class="title"
                                href="<?php echo Url::to(['article/detail', 'province' => isset($value->province)?$value->province->slug:'', 'district' => isset($value->district)?$value->district->slug:'', 'type' => isset($value->articleType)?$value->articleType->slug:'', 'slug' => $value->slug],true);?>"><?php echo $value->title; ?></a>
                        </div>
                        <div class="province">
                            <?php if(isset($value->district) && isset($value->province)){?>
                            <a title="<?php echo isset($value->district)?($value->district->type . ' ' . $value->district->name):'';?>"
                                href="<?php echo Url::to(['article/province-slug_category-or_slug_type-or_slug_district','slug' => $value->district->slug,'province' => $value->province->slug],true);?>">
                                <?php echo isset($value->district)?($value->district->type . ' '. $value->district->name):'';?>
                            </a>
                            <a title="<?php echo isset($value->province)?$value->province->name:'';?>"
                                href="<?php echo Url::to(['article/slug_province-or_slug_category-or_slug_type','slug' => $value->province->slug],true);?>">
                                , <?php echo isset($value->province)?$value->province->name:'';?>
                            </a>
                            <?php }?>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<div style="text-align: center; margin-bottom: 20px">
    <a onClick="loadArticle('<?php echo isset($slug)? $slug:''?>','<?php echo isset($page)? $page:''?>')"
        class="button_post" style="color: #fff; background-color: #c00; padding: 5px 15px;
   text-decoration: none; cursor: pointer;;
     display: inline-block; border-radius: 2px; border-color: #c00;" title="Đăng tin">Xem
        thêm</a>
</div>
<?php echo $this->registerJsFile('@web/js/auto_load_user_article.js');?>