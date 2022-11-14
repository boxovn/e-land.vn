<?php 
use  yii\helpers\Url;
use common\libraries\PseudoCrypt;
use frontend\widgets\Rate;
use frontend\widgets\DistrictApartment;
use yii\widgets\Breadcrumbs;
use yii\helpers\Html;
use frontend\widgets\RegisterViewProject;
use frontend\widgets\LoginDialog;
$user = \Yii::$app->user->identity;?>

<div class="row project project-section section">
    <div class="col-md-12 project-head">
        <ul>
                    <?php if($model->projectSections){?>
                    <?php foreach($model->projectSections as $key => $value){ ?>
                    <?php if($value->title){?>
                    <li>
                        <a href="#<?php echo $value->slug; ?>"> <?php echo $value->title; ?></a>
                    </li>
                    <?php } ?>
                    <?php } ?>
                    <?php } ?>
                    <li>
                        <?php if($model->projectPriceLists){?>
                        <?php foreach($model->projectPriceLists as $key => $value){?>
                        <a class="btn btn-sm btn-danger" download="<?php echo $value->name;?>" title="Tải xuống"
                            href="<?php echo Url::to('@web/channels/projects/price_list/' . $value->file_name, true);?>">
                            <i class="fa fa-download" aria-hidden="true"></i>
                            Tải bảng báo giá
                        </a>
                        <?php } ?>
                        <?php } ?>
                    </li>

            </ul>
    </div>
<!-- bengin -->

<?php if(isset($model->projectBanners) && $model->projectBanners){?>
<div id="carouselExampleDark" class="carousel carousel-dark slide p-0" data-bs-ride="carousel">
  <div class="carousel-indicators">
  <?php foreach($model->projectBanners as $key => $value){?>
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="<?php echo $key;?>"    <?php echo ($key==0)?'class="active"  aria-current="true"':'';?> aria-label="Slide <?php echo $key;?>"></button>
    <?php }?>
    
  </div>
  <div class="carousel-inner">
  <?php foreach($model->projectBanners as $key => $value){?>
                    
                    
    <div class="carousel-item <?php echo ($key==0)? 'active':'';?>" data-bs-interval="10000">
    
      <img  class="d-block w-100"  src="<?php echo Url::to('@web/channels/projects/banner/' . $value->file_name, true);?>" />
      <div class="carousel-caption d-none d-md-block">
        <h5>Hình <?php echo $key+1;?></h5>
        
      </div>
    </div>
  <?php } ?>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
<?php }?>
<!-- end -->
</div>

<!-- detail project -->

<?php if($model->projectSections){?>
<?php foreach($model->projectSections as $key => $value){ ?>
    <div class="container">
    <div class="row">
    <div class="col-12">
    
    <?php if($value->description && $value->image){?>

                                                        <div class="project-detail article-detail">

                                                                <div id="<?php echo $value->slug; ?>" class="article-content">
                                                                        <div class="row">    
                                                                                <div class="col-md-12 section-title">
                                                                                <h2 class="title"><?php echo $value->title;?></h2>
                                                                                </div>
                                                                        </div>
                                                                        <div class="row">    
                                                                                <div class="col-md-6">
                                                                                    <?php echo $value->description;?>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <div style="padding: 30px 0">
                                                                                        <img onerror="if (this.src != 'error.jpg') this.src = 'http://www.elanddev.com/images/no-image200x200.png';" src="<?php echo Url::to('@web/channels/projects/section/' . $value->image, true);?>" />
                                                                                    </div>
                                                                                </div>
                                                                        </div>

                                                                </div>
                                                        </div>
                                                <?php }elseif($value->description){ ?>
                                                        <div class="project-detail article-detail">
                                                            <div id="<?php echo $value->slug; ?>" class="article-content">
                                                                <div class="col-md-12 section-title">
                                                                    <h2 class="title"><?php echo $value->title;?></h2>
                                                                </div>
                                                                <div>
                                                                    <?php echo $value->description;?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                <?php } ?>
                                                  </div>
    </div>
</div>
       
    <?php } ?>
   
<?php } ?>


<?php if($model->projectInvestors){?>
    <div class="container">
    <div class="row">
    <div class="col-12">
        <div class="article-detail">
            <?php foreach($model->projectInvestors as $key => $value){ ?>
                        <?php if($value->description){?>
                        <div id="<?php echo $value->slug; ?>" class="article-content">
                            <div>
                                <?php echo $value->description;?>
                            </div>
                        </div>
                        <?php } ?>
        
            <?php } ?>
    </div>
</div>
</div>
</div>
<?php } ?>
<?php if($model->lat &&  $model->lng){?>
	<iframe  style="border: 0px; width:100%; height: 535px; float:left;" src="https://e-land.vn/article/map?lat=<?php echo $model->lat;?>&lng=<?php echo $model->lng;?>&category=project&id=<?php echo $model->id;?>"></iframe>
<?php }?>
<div class="container">
<?php echo Rate::widget(['article_id' => $model->id]); ?>
</div>
<script type="text/javascript">
/*tab*/

$(function() {
    $(".project-head ul li a, #ctsElsWrapper a").click(function(e) {
        e.preventDefault();
        $('.cts-dot').removeClass("cts-dot-white");
        $(this).addClass('cts-dot-white');
        var aid = $(this).attr("href");
        $('html,body').animate({
            scrollTop: $(aid).offset().top - 150
        }, 'slow');
    });

});
/*end tab
 cts-ar-white
*/
</script>
<?php if($model->projectSections){?>
<div id="ctsElsWrapper" class="hidden-xs affix-top">
    <a target="_self" title="" class="cts-arrow cts-up cts-smsc" href="#carousel-project"></a>
    <div>
    </div>

    <?php foreach($model->projectSections as $key => $value){ ?>
    <?php if($value->title){?>
    <a href="#<?php echo $value->slug; ?>" target="_self" title="<?php echo $value->title; ?>"
        class="cts-dot cts-smsc"></a>
    <?php } ?>
    <?php } ?>
    <a target="_self" title="" class="cts-arrow cts-down cts-smsc"
        href="#<?php echo $model->projectSections[(count($model->projectSections)-1)]->slug;?>"></a>

    <!-- <a href="#ctsAddedId0" target="_self" title="" class="cts-dot cts-smsc"></a>
    <a href="#ctsAddedId1" target="_self" title="" class="cts-dot cts-smsc cts-dot-white"></a>
    <a href="#ctsAddedId2" target="_self" title="" class="cts-dot cts-smsc"></a>-->
</div>
<?php } ?>
<?php echo LoginDialog::widget(); ?>