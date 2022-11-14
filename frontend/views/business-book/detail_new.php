<?php 
use  yii\helpers\Url;
use common\libraries\PseudoCrypt;
use frontend\widgets\Rate;
use frontend\widgets\DistrictApartment;
use yii\widgets\Breadcrumbs;
use yii\helpers\Html;
$user = \Yii::$app->user->identity;?>

<div class="project-section">
    <div class="project-head">
        <div class="row">
            <div class="col-md-12">
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
        </div>
    </div>
    <?php if(isset($model->projectBanners) && $model->projectBanners){?>
    <div class="project-slider">
        <div class="col-md-12 nopadding">
            <div class="product-slider">
                <div id="carousel-project" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <?php foreach($model->projectBanners as $key => $value){?>
                        <li data-target="#carousel-project" data-slide-to="<?php echo $key;?>"
                            <?php echo ($key==0)?'class="active"':'';?>></li>
                        <?php }?>
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <?php foreach($model->projectBanners as $key => $value){?>
                        <?php if(@getimagesize(Url::to('@web/channels/projects/banner/' . $value->file_name, true))){ ?>
                        <div class="item <?php echo ($key==0)? 'active':'';?>">
                            <img
                                src="<?php echo Url::to('@web/channels/projects/banner/' . $value->file_name, true);?>" />
                        </div>
                        <?php }else{ ?>
                        <div class="item <?php echo ($key==0)? 'active':'';?>">
                            <img src="<?php echo Url::to('@web/channels/no-image745x510.png', true);?>">
                        </div>
                        <?php }?>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="project-right-content col-md-4 nopadding">
        <div class="box">
            <div class="box-head">
                <div style="width:calc(100% - 80px); float:left;">
                    <div class="project-name">
                        <h1><?php echo $model->name;?></h1>
                    </div>
                    <div class="prject-adress">
                        <span
                            style="font-style:italic"><?php echo $model->street;?>,<?php echo isset($model->district)? $model->district->name:'';?>,<?php echo isset($model->province)?$model->province->name:'';?></span>
                    </div>
                </div>
                <img style="width: 70px; height:70px; border:1px solid #fff; border-radius:8px; margin-right:10px; float:left"
                    id="notifi_<?php echo $model->id;?>" class="project-logo"
                    onerror="if (this.src != 'error.jpg') this.src = '<?php echo Url::to('@web/images/no-image200x200.png', true)?>';"
                    src="<?php echo Url::to('@web/channels/projects/logo/' . $model->logo, true); ?>"
                    alt="<?php echo $model->name; ?>" />

            </div>
            <?php if(isset($model->projectInvestors) && $model->projectInvestors){?>
            <div style="border-top:1px solid #ddd; margin: 10px; width:100%; float:left"></div>
            <div class="box-body box-investor" style="float:left; width:100%;">
                <?php foreach($model->projectInvestors as $key => $value){?>
                <div style="float:left; width:100%; margin-bottom:10px;"> Chủ đầu tư: </div>
                <div class="info-investor-header" style="float:left;  height: 50px; line-height: 1.5;">
                    <a title="<?php echo $value->name; ?>"
                        href="<?php echo Yii::$app->params['elandUrl'];?>kenh/<?php echo $value->id; ?>">
                        <img id="notifi_<?php echo $value->id;?>" class="img"
                            src="<?php echo Url::to('@web/channels/projects/logo_investor/' . $value->logo, true); ?>"
                            alt="<?php echo $value->name; ?>"
                            onerror="if (this.src != 'error.jpg') this.src = '<?php echo Url::to('@web/images/no-image100x100.png', true)?>';" />
                    </a>
                    <div class="box-right">
                        <a title="<?php echo $value->name; ?>"
                            href="<?php echo Yii::$app->params['elandUrl'];?>kenh/<?php echo $value->id; ?>"><?php echo $value->name; ?></a>
                    </div>
                </div>
                <div class="info-investor-detail" style="float:left;width:100%;padding-left: 80px;">
                    <div style="width:100%;float:left; margin-bottom:5px; font-size:small">
                        <i class="fa fa-building fa-lg" aria-hidden="true"></i> <span
                            class="label label-info "><?php echo $model->apartmentCategory->name;?></span>
                    </div>
                    <div style="width:100%;float:left; margin-bottom:5px; font-size:small">
                        <i class="fa fa-globe fa-lg" aria-hidden="true"></i> <a
                            href="<?php echo $value->website?$value->website:'#';?>"><?php echo $value->website?$value->website:'Đang cập nhập';?></a><span>
                    </div>
                </div>
                <?php }?>

            </div>
            <?php }?>
            <?php if(isset($model->user)){?>
            <!--user -->
            <div style="border-top:1px solid #ddd; margin: 10px; float:left; width:100%; "></div>
            <div class="box-body box-profile" style="float:left; width:100%;">
                <div style="margin-bottom:10px;"> Hỗ trợ tư vấn: </div>
                <a title="<?php echo $model->user->name; ?>"
                    href="<?php echo Yii::$app->params['elandUrl'];?>kenh/<?php echo $model->user->id; ?>">
                    <span class="status status_<?php echo $model->user->id; ?>"
                        id="status_<?php echo $model->user->id; ?>"></span>
                    <?php if(@getimagesize(Url::to('@web/channels/avatar/' . $model->user->image, true))){ ?>
                    <img id="notifi_<?php echo $model->user->id;?>" class="img"
                        src="<?php echo Url::to('@web/channels/avatar/' . $model->user->image, true); ?>"
                        alt="<?php echo $model->user->name; ?>" />
                    <?php }else{ ?>
                    <img id="notifi_<?php echo $model->user->id;?>" class="img"
                        src="<?php echo Url::to('@web/images/no-image100x100.png', true); ?>"
                        alt="<?php echo $model->user->name; ?>" />
                    <?php }?>
                    <input type="hidden" name="receiver[]" value="<?php echo $model->user->id; ?>">
                </a>
                <div class="box-user">
                    <div class="user-info-head" style="height: 50px; line-height: 50px;">
                        <a title="<?php echo $model->user->name; ?>"
                            href="<?php echo Yii::$app->params['elandUrl'];?>kenh/<?php echo $model->user->id; ?>">
                            Chuyên viên <?php echo $model->user->name; ?>

                        </a>
                    </div>
                    <div class="user-info-detail"
                        style="float: left; width:calc(100% - 80px); padding-left: 20px; border-left: 1px solid #999; margin-left: 60px;">
                        <div class="item-info-detail">
                            <?php if($model->user->phone){?>
                            <div style="width:100%;float:left; margin-bottom:5px; font-size:small">
                                <label><i class="fa fa-phone-square fa-lg" aria-hidden="true"></i> </label>
                                <?php echo $model->user->phone;?>
                            </div>
                            <?php } ?>
                            <?php if($model->user->address){?>
                            <div style="width:100%;float:left; margin-bottom:5px; font-size:small">
                                <label><i class="fa fa-map-marker fa-lg" aria-hidden="true"></i> </label>
                                <?php echo $model->user->address;?>
                            </div>
                            <?php } ?>

                            <div class="box-chat" style="width:100%;float:left; margin-bottom:5px;">
                                <?php 
                                                        $user = \Yii::$app->user->identity;
                                                        if($model->user->id!=Yii::$app->user->id){ ?>
                                <div class="btn-chat"
                                    onclick="register_popup(<?php echo ((isset($user)?$user->id:0) + $model->user->id);?>,<?php echo isset($user)?$user->id:0;?>,'<?php echo preg_replace( "/\r|\n/", "", isset($user)?$user->name:'');?>',<?php echo $model->user->id; ?>,'<?php echo preg_replace( "/\r|\n/", "", $model->user->name);?>')">
                                    <i class="fa fa-comments-o fa-lg" aria-hidden="true"></i> <small>Nhắn tin cho
                                        tôi</small>
                                </div>
                                <?php }?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <?php }?>
        </div><!-- /.box-body -->

    </div>
    <?php }else{?>
    <div class="project-slider">
        <div class="col-md-12 nopadding">
            <div class="product-slider">
                <div id="carousel-project" class="carousel slide" data-ride="carousel">
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <div class="item active">
                            <img src="<?php echo Url::to('@web/images/no-image745x510.png', true);?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php }?>
</div>
<!-- detail project -->

<?php if($model->projectSections){?>
<?php foreach($model->projectSections as $key => $value){ ?>
<?php if($value->description && $value->image){?>
<div class="article-detail">
    <div id="<?php echo $value->slug; ?>" class="article-content">
        <div class="col-md-12 section-title">
            <h2 class="title"><?php echo $value->title;?></h2>
        </div>
        <div class="col-md-6">
            <?php echo $value->description;?>
        </div>
        <div class="col-md-6">
            <div style="padding: 30px 0">
                <img src="<?php echo Url::to('@web/channels/projects/section/' . $value->image, true);?>" />
            </div>
        </div>

    </div>
</div>
<?php }elseif($value->description){ ?>
<div class="article-detail">
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
<?php } ?>
<?php } ?>
<?php if($model->projectInvestors){?>
<div class="article-detail">
    <?php foreach($model->projectInvestors as $key => $value){ ?>
    <?php if($value->description){?>
    <div id="<?php echo $value->slug; ?>" class="article-content">
        <div>
            <?php echo $value->description;?>
        </div>
    </div>
    <?php } ?>
</div>
<?php } ?>
<?php } ?>
<?php echo Rate::widget(['article_id' => $model->id]); ?>
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