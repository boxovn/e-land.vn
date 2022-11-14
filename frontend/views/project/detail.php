<?php 
use  yii\helpers\Url;
use common\libraries\PseudoCrypt;
use frontend\widgets\Rate;
use frontend\widgets\DistrictApartment;
use yii\widgets\Breadcrumbs;
use yii\helpers\Html;
$user = \Yii::$app->user->identity;?>
<div class="section article-detail">
                        <?php if($model->projectSections){?>
                                                        <div class="row">
                                                                                            <div class="col-md-12">
                                                                                            
                                                                                                <?php foreach($model->projectSections as $key => $value){ ?>
                                                                                                        <a href="#<?php echo $value->slug; ?>"> <?php echo $value->title; ?></a>
                                                                                                    <?php } ?>
                                                                                            
                                                                                            </div>
                                                            </div>
                                <?php } ?>
                                <div class="row">
                                                            <div class="col-md-8">
                                                                        <?php if($images){?>
                                                                                                <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
                                                                                                        <div class="carousel-indicators">
                                                                                                            <?php foreach($images as $key => $value){?>
                                                                                                            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="<?php echo $key;?>" <?php echo ($key==0)? 'class="active"':'';?> aria-current="true" aria-label="Slide <?php echo $key;?>">
                                                                                                            </button>
                                                                                                            <?php }?>
                                                                                                        </div>
                                                                                                        <div class="carousel-inner">
                                                                                                                    <?php foreach($images as $key => $value){?>
                                                                                                                        <div class="carousel-item <?php echo ($key==0)? 'active':'';?>" data-bs-interval="10000">
                                                                                                                        <div class="item <?php echo ($key==0)? 'active':'';?>"> <img  class="d-block w-100" src="<?php echo Url::to('@web/images/building_project/large_rectangle_image/' . $value->large_rectangle_image, true);?>"></div>
                                                                                                                            
                                                                                                                        </div>
                                                                                                                    <?php }?>
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
                                                            </div>
                                                            <div class="col-md-4 nopadding">
                                                                <div class="box">
                                                                    <div class="project-name">
                                                                        <h1><?php echo $model->name;?></h1>
                                                                    </div>
                                                                    <div class="prject-adress">
                                                                        <span style="font-style:italic"><?php echo $model->address;?></span>
                                                                    </div>
                                                                    <?php if(isset($model->user)){?>
                                                                    <div style="border-top:1px solid #ddd; margin: 10px; width:100%; float:left"></div>
                                                                    <div class="box-body box-investor" style="float:left; width:100%;">
                                                                        <div style="float:left; width:100%; margin-bottom:10px;"> Chủ đầu tư: </div>
                                                                        <div class="info-investor-header" style="float:left; width:100%;">
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
                                                                            <div class="box-right">
                                                                                <a title="<?php echo $model->user->name; ?>"
                                                                                    href="<?php echo Yii::$app->params['elandUrl'];?>kenh/<?php echo $model->user->id; ?>"><?php echo $model->investor; ?></a>
                                                                            </div>
                                                                        </div>
                                                                        <div class="info-investor-detail" style="float:left;width:100%;padding-left: 80px;">

                                                                            <div style="width:100%;float:left; margin-bottom:5px; font-size:small">
                                                                                Dự án: <span class="label label-info"><?php echo $model->name;?></span>
                                                                            </div>
                                                                            <div style="width:100%;float:left; margin-bottom:5px; font-size:small">
                                                                                Email: <?php echo $model->email;?>
                                                                            </div>
                                                                            <div style="width:100%;float:left; margin-bottom:5px; font-size:small">
                                                                                Website: <a href="<?php echo $model->website;?>"><?php echo $model->website;?></a><span>
                                                                            </div>
                                                                            <div style="width:100%;float:left; margin-bottom:5px; font-size:small">
                                                                                Ngày: <?php echo $model->release_date;?>
                                                                            </div>


                                                                            <!-- <div style="width:100%;float:left; margin-bottom:5px; font-size:small"> Mật độ xây dựng:38 % </div>
                                                                            <div style="width:100%;float:left; margin-bottom:5px; font-size:small"> Diện tích khu đất:11,882 m2</div>
                                                                            <div style="width:100%;float:left; margin-bottom:5px; font-size:small"> Thời gian khởi công:12/2020</div>
                                                                            <div style="width:100%;float:left; margin-bottom:5px; font-size:small"> Thời gian hoàn thành:06/2023</div>
                                                                            <div style="width:100%;float:left; margin-bottom:5px; font-size:small"> Trạng thái: <span class="label label-danger">Sắp mở bán</span></div>-->
                                                                        </div>

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
                                                                                <div class="user-info-head">
                                                                                    <a title="<?php echo $model->user->name; ?>"
                                                                                        href="<?php echo Yii::$app->params['elandUrl'];?>kenh/<?php echo $model->user->id; ?>">
                                                                                        <?php echo $model->user->name; ?>

                                                                                    </a>
                                                                                </div>
                                                                                <div class="user-info-detail" style="float:left; width:100%; padding-left: 80px;">
                                                                                    <div class="item-info-detail">
                                                                                        <?php if($model->user->phone){?>
                                                                                        <div style="width:100%;float:left; margin-bottom:5px; font-size:small">
                                                                                            <label> Điện thoại:</label>
                                                                                            <?php echo $model->user->phone;?>

                                                                                        </div>

                                                                                        <?php }?>
                                                                                        <?php if($model->user->mobile){?>
                                                                                        <div style="width:100%;float:left; margin-bottom:5px; font-size:small">
                                                                                            <label>Điện thoại:</label>
                                                                                            <?php echo $model->user->mobile;?>

                                                                                        </div>

                                                                                        <?php }?>
                                                                                        <?php if($model->user->email){?>
                                                                                        <div style="width:100%;float:left; margin-bottom:5px; font-size:small">
                                                                                            <label> Email:</label>
                                                                                            <?php echo $model->user->email;?>

                                                                                        </div>
                                                                                        <?php }?>
                                                                                        <?php if($model->user->address){?>
                                                                                        <div style="width:100%;float:left; margin-bottom:5px; font-size:small">
                                                                                            <label>Địa chỉ:</label> <?php echo $model->user->address;?>

                                                                                        </div>

                                                                                        <?php }?>
                                                                                    </div>

                                                                                </div>
                                                                            </div>
                                                                            <div class="box-chat">
                                                                                <?php 
                                                                                        $user = \Yii::$app->user->identity;
                                                                                        if($model->user->id!=Yii::$app->user->id){ ?>
                                                                                <button class="btn btn-block btn-chat"
                                                                                    onclick="register_popup(<?php echo ((isset($user)?$user->id:0) + $model->user->id);?>,<?php echo isset($user)?$user->id:0;?>,'<?php echo preg_replace( "/\r|\n/", "", isset($user)?$user->name:'');?>',<?php echo $model->user->id; ?>,'<?php echo preg_replace( "/\r|\n/", "", $model->user->name);?>')">
                                                                                    <i class="fa fa-comments-o fa-lg" aria-hidden="true"></i> <small>Nhắn tin cho tôi</small>
                                                                                </button>
                                                                                <?php }?>
                                                                            </div>


                                                                        </div>



                                                                    </div><!-- /.box-body -->
                                                                    <?php }?>
                                                                </div>
                                                            </div>
                                </div>
    <!-- detail project -->
</div>
<div class="section article-detail">
    <div class="row">

    <div class="col-12 article-head">
        <div class="user">
            <a title="<?php echo $model->investor;?>" href="#">
                <img class="img" style="width:80px;height:80px" src="https://e-land.vn/images/no-image.png"
                    alt="<?php echo $model->investor;?>">
                <input type="hidden" name="receiver[]" value="38110">
            </a>
        </div>
        <div>
            <div class="title">
                <h1><?php echo $model->investor;?></h1>
            </div>

            <div>
                <?php
                  $links=[];
                        if($model->province){
                                $links []= [
                                  'label' => Html::encode($model->province->name),
                                  'url' => ['project/province','slug' => $model->province->slug],
                                  'template' => "<li><b>{link}</b></li>", // template for this link only
                              ];
                        }
                        if($model->district){
                                $links []= [
                                  'label' => Html::encode($model->district->type . ' ' . $model->district->name),
                                  'url' => ['project/district','province' => $model->province->slug,'slug' => $model->district->slug],
                                  'template' => "<li><b>{link}</b></li>", // template for this link only
                              ];
                        }
                       
                        if($model){
                                        $links []=  [
                                          'label' => Html::encode($model->name),
                                        
                                      ];
                            }
                      
                  // $this is the view object currently being used
                  echo Breadcrumbs::widget([
                      // 'itemTemplate' => "<li><i>{link}</i></li>\n", // template for all links
                      'homeLink' => [
                          'label' => 'Trang chủ',
                          'url' =>  ['article/index'],
                           'template' => "<li><b>{link}</b></li>", // template for this link only
                      ],
                      'links' => $links,

                  ]);
                  ?>
            </div>

            <div class="item-info">

                <div class="col-price col text-left">
                    <label>Giá</label> : <?php echo $model->market_price_from;?> tỷ
                </div>

                <div class="col-area col text-left">
                    <label>Diện tích</label>:
                    <?php echo $model->market_price_from;?> m2
                </div>
                <div class="col-address col text-left">
                    <label>Quận/Huyện</label>
                    :
                    <a href="https://e-land.vn/da-nang/quan-hai-chau">
                        <?php  echo $model->district->type . '' . $model->district->name;?>
                    </a>,
                    <a href="https://e-land.vn/da-nang">
                        <?php echo $model->province->name;?></a>

                </div>
                <div class="col-social col text-left right">
                    <label>Chia sẻ</label>:
                    <a class="btn btn-social-icon btn-facebook"><i class="fa fa-facebook"></i></a>
                    <a class="btn btn-social-icon btn-google"><i class="fa fa-google"></i></a>
                    <label>Ghim lại</label>:
                    <a class="btn btn-social-icon btn-google"><i class="fa fa-thumb-tack" aria-hidden="true"></i></a>
                </div>
            </div>



        </div>
    </div>
                    </div>
    <div class="row">
    <div class="col-12 article-content">
     
            <h1 class="title">
                TỔNG QUAN DỰ ÁN <?php echo $model->name;?>
            </h1>
      
    </div>
                    </div>
                    <div class="row">
    <!-- /.featured-article -->
    <div class="col-12  article-content">
        <?php echo $model->overview; ?>
    </div>
    <div class=" col-12 article-content">
        <?php echo $model->internal_service; ?>
    </div>
                    </div>
</div>
<?php echo Rate::widget(['article_id' => $model->id]); ?>
<script type="text/javascript">
/*tab*/
$(function() {
    var hash = window.location.hash;
    hash && $('ul.nav a[href="' + hash + '"]').tab('show');

    $('.nav-tabs a').click(function(e) {
        $(this).tab('show');
        var scrollmem = $('body').scrollTop() || $('html').scrollTop();
        window.location.hash = this.hash;
        $('html,body').scrollTop(scrollmem);
    });
});
/*end tab*/
</script>