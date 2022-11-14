<?php
use  yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\LinkPager;
use common\models\BuildingProjectInfo;
use frontend\widgets\ListArticle;
use frontend\widgets\ListCategory;
use frontend\widgets\DistrictTag;
use common\libraries\PseudoCrypt;
use frontend\widgets\OfferArticle;
use frontend\widgets\PopularArticle;
use frontend\widgets\NewArticle;
use frontend\widgets\HighlightArticle;
use frontend\widgets\ListProvince;
use frontend\widgets\Header;
use frontend\widgets\DialogLanding;
use frontend\widgets\NewArticleNotImage;
use yii\widgets\ActiveForm;
use frontend\widgets\LoginDialog;
?>
<div class="article">


    <?php
		//echo NewArticle::widget(['title' => 'Tin rao mới nhất trên E-land']);
		//echo ListCategory::widget(['title' => 'Tin rao cần bán', 'slug' => 'tin-rao-ban',  'offset' => 0, 'limit' => 6, 'type' => 'block']);
		
	//	echo NewArticle::widget(['title' => 'Tin rao mới nhất', 'type' => 'block']);
		//echo NewArticleNotImage::widget(['title' => 'Tin rao mới không kèm hình ảnh sản phẩm', 'type' => 'block']);
		//echo ListProvince::widget(['title' => 'Tỉnh thành', 'slug' => 'province',  'offset' => 0, 'limit' => 24, 'type' => 'slide']);
		//echo ListProvince::widget(['title' => 'Tỉnh thành', 'slug' => 'province',  'offset' => 0, 'limit' => 24, 'type' => 'slide']);
		//echo ListCategory::widget(['title' => 'Tin rao cần bán','slug' => $slug, 'offset' => 0, 'limit' => 6, 'type' => 'slide']);
		//echo OfferArticle::widget(['title' => 'Đề xuất bởi E-land', 'offset' => 0, 'limit' => 6, 'type' => 'block']);
		//echo HighlightArticle::widget(['title' => 'Tin ra nổi bật trên E-land', 'offset' => 0, 'limit' => 6,'type' => 'slide']);
		//echo OfferArticle::widget(['title' => 'Đề xuất bởi E-land','offset' => 0, 'limit' => 6]);
		//echo HighlightArticle::widget(['title' => 'Tin ra nổi bật trên E-land']);
		?>
   

    <?php if($models){ ?>
       
                                                    
                 
        <div id="list-box" class="section list-box">
      
                            <div class="row">
                                    <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
                                               <h2 class="title">Mua bán</h2>
                                       </div>
                            </div>
                          
                            <?php foreach ($models as $key => $value) { 
                                                            $image = $value->image?$value->image: 'no-image.png';?>
                                                                    <div class="column">
                                                                        <div class="box-image">
                                                                            <a
                                                                                href="<?php echo Url::to(['article/detail', 'province' => isset($value->province)?$value->province->slug:'', 'district' => isset($value->district)?$value->district->slug:'','slug' => $value->slug],true);?>">
                                                                                <img onerror="if (this.src != 'error.jpg') this.src = '<?php echo Url::to('@web/images/no-image210x118.png', true)?>';"
                                                                                    width="210px" height="118px" class="image" alt="<?php echo $value->title; ?>"
                                                                                    src="<?php echo Url::to('@web/channels/article/210x118/' . $image, true)?>" />
                                                                            </a>
                                                                            <div class="box-label">
                                                                                <a title="<?php echo $value->user->name;?>"
                                                                                    href="<?php echo Yii::$app->params['elandUrl'];?>kenh/<?php echo $value->user->id; ?>">
                                                                                    <img alt="<?php echo $value->user->name;?>" class="user_avatar"
                                                                                        onerror="if (this.src != 'error.jpg') this.src = '<?php echo Url::to('@web/images/no-image200x200.png', true)?>';"
                                                                                        src="<?php echo Url::to('@web/channels/avatar/' .  $value->user->image, true)?>" />
                                                                                </a>
                                                                                <div class="info">
                                                                                    <?php echo isset($value->categoryType)?'<span>' . $value->categoryType->title . '</span>':''; ?>
                                                                                    <span>Giá: <?php echo $value->price_text; ?></span>
                                                                                    <span>Diện tích : <?php echo $value->area_text; ?></span>

                                                                                </div>
                                                                            </div>
                                                                         </div>
                                                                        <div class="box-description">
                                                                            <div class="wap-title"><a title="<?php echo $value->title; ?>" class="title"
                                                                                    href="<?php echo Url::to(['/article/detail', 'province' => isset($value->province)?$value->province->slug:'', 'district' => isset($value->district)?$value->district->slug:'','slug' => $value->slug],true);?>"><?php echo $value->title; ?></a>
                                                                            </div>
                                                                            <div class="province">
                                                                                <?php if(isset($value->district) && isset($value->province)){?>
                                                                                    <?php echo isset($value->district)?($value->district->type . ' '. $value->district->name):'';?>
                                                                                     , <?php echo isset($value->province)?$value->province->name:'';?>
                                                                                 
                                                                                <?php }?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                <?php } ?>
                                                                                </div>
    <?php   } ?>

<div class="row">
        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 m-3 text-center p-0">
            <button onClick="loadArticle('<?php echo isset($slug)? $slug:''?>','<?php echo isset($page)? $page:''?>')"  class="btn btn-view"  title="Đăng tin">
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                <span class="visually-hidden">Loading...</span>
                Xem  thêm
            </button>
            </div>    
</div>
<?php //echo LoginDialog::widget(); ?>
<?php //echo DialogLanding::widget(['article_id' => $value->id]);?>
<?php //echo $this->registerJsFile('@web/js/article_detail.js', ['depends' => [yii\bootstrap\BootstrapPluginAsset::className()]]);?>
<?php echo $this->registerJsFile('@web/js/auto_load_article.js', ['depends' => [yii\bootstrap\BootstrapPluginAsset::className()]]);?>
