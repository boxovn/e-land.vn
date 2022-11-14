<?php
use  yii\helpers\Url;
use yii\widgets\LinkPager;
use common\models\BuildingProjectInfo;
use frontend\widgets\ListApartment;
?>
<style>
    .loader {
      border: 5px solid #f3f3f3;
    border-radius: 50%;
    border-top: 5px solid #999;
    width: 30px;
    height: 30px;
    -webkit-animation: spin 2s linear infinite;
    animation: spin 2s linear infinite;
    position: fixed;
    bottom: 0px;
    left:-webkit-calc((100% + 240px)/2 - 15px);
    left:-moz-calc((100% + 240px)/2 - 15px);
    left:calc((100% + 240px)/2 - 15px);
  
    display: none;
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
</style>
<div id="main">
    <div id="container" class="container"> 
        
        <?php if (isset($category_name)) { ?>
            <h1 class="title"><?php echo $category_name;?></h1>
        <?php } elseif (isset($district)) { ?>
            <h1 style="font-weight: bold; font-size: 20px; " class="title"><?php echo $district->type; ?> <?php echo $district->name; ?></h1>
		<?php } else { ?>
		<h1>Kết quả tìm kiếm</h1>
        <?php } ?>
			<?php foreach ($models as $key => $value) {
                    $image = $value->image;
            ?>
            <div class="list" style="width:100%; float:left; margin-bottom:10px;">
                <a style="float:left; margin: 10px 0;" title="<?php echo $value->name; ?>" href="<?php echo Yii::$app->params['elandUrl'];?><?php echo $category_slug?($category_slug .'-'): ($value->district->slug.'-'); ?><?php echo $value->slug; ?>-<?php echo $detail;?><?php echo $value->id; ?>">
                    <img class="image" alt="<?php echo $value->name; ?>" src="<?php echo $image ? (Yii::$app->params['url-building-project-medium-rectangle-image']. $image) : (Yii::$app->params['url-building-project-image']. "no-image.png"); ?>"/>

                </a>
				<div style="width: calc(100% - 210px); float:left; padding: 0px 20px;">
					<a title="<?php echo $value->name; ?>" class="title" href="<?php echo Yii::$app->params['elandUrl'];?><?php echo $category_slug?($category_slug .'-'): ($value->district->slug.'-'); ?><?php echo $value->slug; ?>-<?php echo $detail;?><?php echo $value->id; ?>"><?php echo $value->name; ?></a>
					<a title="<?php echo $value->address; ?>" class="province" href="<?php echo Yii::$app->params['elandUrl'];?><?php echo $category_slug?($category_slug .'-'): ($value->district->slug.'-'); ?><?php echo $value->slug; ?>-<?php echo $detail;?><?php echo $value->id; ?>"><?php echo $value->address; ?></a>
					<p><?php echo substr(strip_tags($value->overview), 0,350);?>
				</div>
			 <!--   <p class="view"><?php echo $value->view ? 'Lượt xem: ' . $value->view : "100 lượt xem" ?> • <?php echo BuildingProjectInfo::humanTiming(strtotime($value->created)); ?></p>-->
            </div>
        <?php } ?>
          <div class="loader"></div>
    </div >
  <div style="text-align:center;">
			<button class="btn btn-sm btn-default" style="text-align:center; width:200px; margin:10px;" onclick="viewMore()">Xem thêm</button>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Modal Header</h4>
            </div>
            <div class="modal-body">
                <p>Some text in the modal.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
