<?php
use yii\helpers\Url;
use yii\widgets\LinkPager;
?>
<div class="container">
    <div class="content-detail">
        <div class="content-left">
            <div class="wapper-slide">
                    <?php
                    if ($images) {
                        foreach ($images as $key => $value) {
                            ?>
                            <?php $image = $value->large_rectangle_image; ?>
                            <img  class="mySlides image" src="<?php echo  isset($image) ?(Yii::$app->params['url-building-project-large-rectangle-image'].$image)  : (Yii::$app->params['url-building-project-image'] . "no-image.png"); ?>" >
                            <div class="image-label w3-display-topright w3-text-white w3-container w3-hide-small">
                                Mặt trước
                            </div>
                        <?php } ?>
                    <?php } else { ?>
                        <img class="mySlides" src="<?php echo Yii::$app->params['url-building-project-image'] . "no-image.png"; ?>">
                    <?php } ?>
						<div class="w3-section">
                        <?php foreach ($images as $key => $value) { ?>
                            <?php if($key<=2){?>
                            <?php $image = $value->small_rectangle_image; ?>
                            <div class="w3-col s4">
                                <img  class="small-rectangle-image demo w3-opacity w3-hover-opacity-off w3-opacity-off" src="<?php echo Yii::$app->params['url-building-project-small-rectangle-image'] . (isset($image) ? $image : "no-image.png"); ?>" style="width:100%" onclick="currentDiv(<?php echo ($key + 1); ?>)">

                            </div>
                        <?php } ?>
                          <?php } ?>

                    </div>
                </div>
                
                <div class="content-text" >
                    <!-- /.featured-article -->
                    <h1><?php echo $model->name; ?></h1>
                    <div>
                        <?php echo $model->overview; ?>
                    </div>
                </div>
            
                
        </div>
        <div class="content-right">

            <div class="media-list main-list">
                <?php
                foreach ($listRight as $key => $value) {
                    $image = $value->image;
                    ?>
                    <div class="media">
                        <a class="pull-left" href="<?php echo Yii::$app->params['elandUrl'];?>du-an/<?php echo $value->slug; ?>-<?php echo $detail;?><?php echo $value->id; ?>">
                            <img class="media-object image"  src="<?php echo $image? (Yii::$app->params['url-building-project-medium-rectangle-image'] . $image) : (Yii::$app->params['url-building-project-image'] . "no-image.png"); ?>" alt="...">
                        </a>
                        <div class="media-body">
                            <a href="<?php echo Yii::$app->params['elandUrl'];?>du-an/<?php echo $value->slug; ?>-<?php echo $detail;?><?php echo $value->id; ?>" class="media-heading"><?php echo $value->name; ?></a>
                            <p class="by-author"><?php echo $value->province->name; ?></p>
                         </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>  

