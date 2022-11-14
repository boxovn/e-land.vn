<?php
use  yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\LinkPager;
use common\models\BuildingProjectInfo;
use frontend\widgets\DistrictTag;
use common\libraries\PseudoCrypt;
use yii\widgets\Breadcrumbs;
use frontend\widgets\Header;
use frontend\widgets\NewArticleType;
?>
<div class="body">
    <?php echo NewArticleType::widget(['title' => 'Tin rao mới nhất', 'type' => 'block','type_id' => $articleType->id]);?>
    <?php if($models){?>
    <div id="list-box" class="list-box">
        <div class="list-head">
            <h2 class="list-title">Tin rao gần đây</h2>
        </div>
        <?php foreach ($models as $key => $value) { 
					$image = $value->image?$value->image: 'no-image.png';?>
                            <div class="column">
                                <div class="box-image">
                                    <a
                                        href="<?php echo Url::to(['article/detail', 'province' => isset($value->province)?$value->province->slug:'', 'district' => isset($value->district)?$value->district->slug:'', 'type' => isset($value->articleType)?$value->articleType->slug:'', 'slug' => $value->slug],true);?>">
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
                                            <span><?php echo $value->articleType->title; ?></span>
                                            <span>Giá: <?php echo $value->price_text; ?></span>
                                            <span>Diện tích : <?php echo $value->area_text; ?></span>
                                        
                                        </div>
                                    </div>

                                    <div 
                                        data-slug="<?php echo $value->slug;?>"
                                        data-id="<?php echo $value->id;?>" 
                                        data-url="<?php echo Url::to(['article/detail', 'province' => isset($value->province)?$value->province->slug:'', 'district' => isset($value->district)?$value->district->slug:'', 'type' => isset($value->articleType)?$value->articleType->slug:'', 'slug' => $value->slug],true);?>"
                                        class="box-time showLanding"><i class="far fa-eye"></i>
                                    </div>

                                </div>
                                <div class="box-description">
                                    <div class="wap-title"><a title="<?php echo $value->title; ?>" class="title"
                                            href="<?php echo Url::to(['/article/detail', 'province' => isset($value->province)?$value->province->slug:'', 'district' => isset($value->district)?$value->district->slug:'', 'type' => isset($value->articleType)?$value->articleType->slug:'', 'slug' => $value->slug],true);?>"><?php echo $value->title; ?></a>
                                    </div>
                                    <div class="province">
                                        <?php if(isset($value->district) && isset($value->province)){?>
                                        <a title="<?php echo isset($value->district)?($value->district->type . ' ' . $value->district->name):'';?>"
                                            href="<?php echo Url::to(['/article/province-slug_category-or_slug_type-or_slug_district','slug' => $value->district->slug,'province' => $value->province->slug],true);?>">
                                            <?php echo isset($value->district)?($value->district->type . ' '. $value->district->name):'';?>
                                        </a>
                                        <a title="<?php echo isset($value->province)?$value->province->name:'';?>"
                                            href="<?php echo Url::to(['/article/slug_province-or_slug_category-or_slug_type','slug' => $value->province->slug],true);?>">
                                            , <?php echo isset($value->province)?$value->province->name:'';?>
                                        </a>
                                        <?php }?>
                                    </div>
                                </div>
                            </div>
        <?php } ?>
    </div>
    <?php }?>
</div>
<div style="text-align: center; margin-bottom: 20px"><a onClick="loadArticle('<?php echo isset($slug)? $slug:''?>','<?php echo isset($page)? $page:''?>')"
        class="button_post" style="color: #fff; background-color: #c00; padding: 5px 15px;text-decoration: none; cursor: pointer;;display: inline-block; border-radius: 2px; border-color: #c00;" title="Đăng tin">Xem
        thêm</a>
</div>
<script>
$(document).ready(function() {
    console.log('ok');
    //$('.pageDetail').load( "feeds.html" );

    function revertToOriginalURL() {
        window.history.go(-1);
    }

    $('.modal').on('hidden.bs.modal', function() {
        revertToOriginalURL();
    });

    $('.pageDetail').on('click', function() {
        var id = $(this).data('id');
        var slug = $(this).data('slug');
        $('#landdingPage').find('.modal-content').empty();
        $.ajax({
            url: 'chi-tiet/' + id,
            type: 'get',
            success: function(data) {
                $('#landdingPage').find('.modal-content').html(data);
            }
        }).done(function(data) {

            //  window.location.hash = 'chi-tiet/' +  id;
            window.history.pushState({
                urlPath: slug
            }, "", slug);
            $('#landdingPage').modal('show');

        });

    });
});
</script>

<?php echo $this->registerJsFile('@web/js/auto_load_article.js');?>