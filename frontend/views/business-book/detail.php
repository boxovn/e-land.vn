<?php
use  yii\helpers\Url;
use common\libraries\PseudoCrypt;
use frontend\widgets\Rate;
use frontend\widgets\DistrictApartment;
use yii\widgets\Breadcrumbs;
use yii\helpers\Html;
$user = \Yii::$app->user->identity;?>
<div class="session product-detail" id="<?php echo $model->id;?>">
    <div class="row">
        <div class="col-md-6 ">
            
            <?php if($images){?>
            <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <?php foreach($images as $key => $value){?>
                    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="<?php echo $key;?>"  <?php echo ($key==0)? 'class="active"':'';?> aria-current="true" aria-label="Hình <?php echo $key;?>"></button>
                    <?php }?>
                    
                </div>
                <div class="carousel-inner">
                    <?php foreach($images as $key => $value){?>
                    <div class="carousel-item  <?php echo ($key==0)? 'active':'';?>">
                        <img width="400" height="400" src="<?php echo Url::to('@web/products/images/' . $value->file_name, true);?>" class="d-block" alt="...">
                        
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
        <div class="col-md-6 ">
            <div class="product-name">
                <h1 class="name"><?php echo $model->name;?></h1>
            </div>
            <div class="box box-1">
                <div class="line product-price">
                    Giá bán: <span class="price"><?php echo number_format( $model->price, 0, '', ',');?> đ</span>
                    <span class="discount"><?php echo number_format( $model->discount, 0, '', ',');?> %</span>
                    <span class="real-money"> <?php echo number_format($model->price + ($model->price*($model->discount/100)), 0, '', ',');?> đ</span>
                </div>
                <div class="line product-quantity">
                    
                    <div class="quantity">
                        Số lương:
                        <button class="product-detail-minus-btn" id="<?php echo $value['id'];?>" type="button" name="button">
                        <img src="<?php echo Url::to('@web/products/icon/minus.svg', true);?>" alt="" />
                        </button>
                        <input type="text" id="number" name="name" value="1">
                        <button class="product-detail-plus-btn" id="<?php echo $value['id'];?>" type="button" name="button">
                        <img src="<?php echo Url::to('@web/products/icon/plus.svg', true);?>" alt="" />
                        </button>
                    </div>
                </div>
                <div class="line product-button">
                    <div class="group-button">
                        <button onClick="addCart(<?php echo $model->id;?>)" class="btn btn-add-to-cart btn-warning"
                        data-view-id="pdp_add_to_cart_button">Chọn mua</button>
                    </div>
                </div>
            </div>
            <div class="box box-2">
               
                <div class="item-info">
                    <div class="col-social col text-left right">
                        <label>Chia sẻ</label>:
                        <a class="btn btn-social-icon btn-facebook"><i class="fa fa-facebook"></i></a>
                        <a class="btn btn-social-icon btn-google"><i class="fa fa-google"></i></a>
                        <label>Ghim lại</label>:
                        <a class="btn btn-social-icon btn-google"><i class="fa fa-thumb-tack" aria-hidden="true"></i></a>
                    </div>
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
                            Dự án: <span class="label label-info"><?php echo $model->apartmentCategory->name;?></span>
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
            <!-- detail project -->
        </div>
    </div>
    
     
    <div class="session article-detail">
        <div class="row mb-5">
            <div class="col">
                <?php
                $links=[];
                
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
        </div> 
        <div class="row mb-5">
                <div class="col">
                         <?php echo $model->details;?>
                </div>
        </div>   
         <div class="row mb-5">
                <div class="col">
        Mô tả: <?php echo $model->description;?>
                </div>
        </div>
        
    </div>
    <!-- /.featured-article -->
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
    $('.product-detail-minus-btn').on('click', function(e) {
    e.preventDefault();
    var $this = $(this);
    var $input = $this.closest('div').find('input');
    var quantity = parseInt($input.val());
    var id = $this.attr('id');
    //console.log(quantity);
    if (quantity > 1) {
    quantity = quantity - 1;
    } else {
    quantity = 1;
    }
    $input.val(quantity);
    });
    $('.product-detail-plus-btn').on('click', function(e) {
    e.preventDefault();
    var $this = $(this);
    var $input = $this.closest('div').find('input');
    var quantity = parseInt($input.val());
    var id = $this.attr('id');
    // console.log(quantity);
    if (quantity < 100) {
    quantity = quantity + 1;
    } else {
    quantity = 100;
    }
    $input.val(quantity);
    
    });
    </script>