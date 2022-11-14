<?php
use  yii\helpers\Url;
use yii\widgets\LinkPager;
use common\models\BuildingProjectInfo;
use frontend\widgets\ListApartment;
use frontend\widgets\DistrictTag;
use common\libraries\PseudoCrypt;
?>

<div class="body">
    <div id="main">
        <h1>Tin rao</h1>
        <div id="list-box" class="list-box">
            <?php foreach ($models as $key => $value) { 
					$image = $value->image;?>
            <div class="column">
                <a class="box-image" href="<?php echo Url::to(['article/index','slug' => $value->slug],true);?>">
                    <?php if(@getimagesize(Url::to('@web/channels/'. $value->user_id .'/article/210x118/' . $image, true))){ ?>
                    <img class="image" alt="<?php echo $value->title; ?>"
                        src="<?php echo Url::to('@web/channels/'. $value->user_id .'/article/210x118/' . $image, true)?>" />
                    <?php }else{ ?>
                    <img class="no-image" alt="<?php echo $value->title; ?>"
                        src="<?php echo Url::to('@web/images/no-image210x118.png',true);?>" />
                    <?php }?>
                </a>
                <div class="box-description">
                    <a class="title" href="<?php echo Url::to(['article/index','slug' => $value->slug],true);?>">
                        <?php echo $value->title; ?>
                    </a>
                    <div class="province">
                        <?php if(isset($value->district) && isset($value->province)){?>
                        <a title="<?php echo isset($value->district)?($value->district->type . ' ' . $value->district->name):'';?>"
                            href="<?php echo Url::to(['index/district','district' => $value->district->slug,'province' => $value->province->slug,'district_id' => $value->district->district_id,'province_id' => $value->province->province_id],true);?>">
                            <?php echo isset($value->district)?($value->district->type . ' '. $value->district->name):'';?>
                        </a>
                        <a title="<?php echo isset($value->province)?$value->province->name:'';?>"
                            href="<?php echo Url::to(['index/province','province' => $value->province->slug,'province_id' => $value->province->province_id],true);?>">
                            , <?php echo isset($value->province)?$value->province->name:'';?>
                        </a>
                        <?php }?>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
        <div class="loader"></div>
        <!-- <div style="text-align:center;">
			<button class="btn btn-sm btn-default" style="text-align:center; width:200px; margin:10px;" onclick="loadArticle('<?php echo Yii::$app->params['elandUrl'];?>')">Xem thêm</button>
  </div>
  -->
    </div>
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
<?php echo $this->registerJsFile('@web/js/auto_load_index.js');?>