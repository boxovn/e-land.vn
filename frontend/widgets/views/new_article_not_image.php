<?php
use  yii\helpers\Url;
use yii\helpers\Html;
?>
<?php if($articles){?>
<div class="list-box">
    <div class="list-head">
        <h2 class="list-title"><?=$title;?></h2>
        <div class="btn-view-more">
            <a class="btn btn-danger btn-sm"
                href="<?php echo Url::to(['article/slug_province-or_slug_category-or_slug_type','slug' => $slug],true);?>">
                Xem thêm</a>
        </div>

    </div>
    <?php foreach ($articles as $key => $value) { 
					if( isset($value->province) &&  isset($value->district)){	
					$image = $value->image;?>
    <div class="column column-customize">
        <div class="wap-article">
            <div class="box-image">
                <div class="wap-title"><a title="<?php echo $value->title; ?>" class="title"
                        href="<?php echo Url::to(['article/detail', 'province' => isset($value->province)?$value->province->slug:'', 'district' => isset($value->district)?$value->district->slug:'', 'type' => isset($value->articleType)?$value->articleType->slug:'', 'slug' => $value->slug],true);?>"><?php echo $value->title; ?></a>
                </div>
                <div class="box-label">
                    <a title="<?php echo $value->user->name;?>"
                        href="<?php echo Yii::$app->params['elandUrl'];?>kenh/<?php echo $value->user->id; ?>">
                        <img alt="<?php echo $value->user->name;?>" class="user_avatar"
                            onerror="if (this.src != 'error.jpg') this.src = '<?php echo Url::to('@web/images/no-image200x200.png', true)?>';"
                            src="<?php echo Url::to('@web/channels/avatar/' .  $value->user->image, true)?>" />
                    </a>
                    <div class="info">
                        <span>Giá: <?php echo $value->price_text; ?></span>
                        <span>Diện tích : <?php echo $value->area_text; ?></span>
                        <p class="address"><?php echo $value->address; ?></p>
                    </div>
                </div>
            </div>
            <div class="box-description">

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
    </div>
    <?php } ?>
    <?php } ?>
    <div class="list-food">
        <div class="view-more">
            <a class="btn btn-sm btn-block" href="https://batdongsaneland.com/"><i class="fa fa-caret-down"
                    aria-hidden="true"></i>
                Xem thêm</a>
        </div>
    </div>
</div>
<?php }?>