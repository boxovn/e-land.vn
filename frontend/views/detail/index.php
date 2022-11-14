<?php

use yii\helpers\Url;
use yii\widgets\LinkPager;
?>
<div class="container">
    <div class="content">
        <div class="content-left">
           
                <!-- artigo em destaque -->
                <div class="w3-content">
                    <?php
                    if ($images) {
                        foreach ($images as $key => $value) {
                            ?>
                            <?php $image = $value->large_rectangle_image; ?>
                            <img class="mySlides image" src="<?php echo  isset($image) ?(Yii::$app->params['url-building-project-large-rectangle-image'].$image)  : (Yii::$app->params['url-building-project-image'] . "no-image.png"); ?>" style="width:100%; height:350px;">
                            <div class="w3-display-topright w3-text-white w3-container w3-padding-32 w3-hide-small">
                                Mặt trước
                            </div>
                        <?php } ?>
                    <?php } else { ?>
                        <img class="mySlides" src="<?php echo Yii::$app->params['url-building-project-image'] . "no-image.png"; ?>" style="width:100%; height:350px;">
                    <?php } ?>
                    <div class="w3-center w3-container w3-section w3-large w3-text-white w3-display-bottommiddle" style="width:100%">
                        <div class="w3-left" onclick="plusDivs(-1)">&#10094;</div>
                        <div class="w3-right" onclick="plusDivs(1)">&#10095;</div>
                        <span class="w3-badge demo w3-border w3-transparent w3-hover-white w3-white" onclick="currentDiv(1)"></span>
                        <span class="w3-badge demo w3-border w3-transparent w3-hover-white w3-white" onclick="currentDiv(2)"></span>
                        <span class="w3-badge demo w3-border w3-transparent w3-hover-white w3-white" onclick="currentDiv(3)"></span>
                    </div>
                    <div class="w3-section">
                        <?php foreach ($images as $key => $value) { ?>
                            <?php if($key<=2){?>
                            <?php $image = $value->small_rectangle_image; ?>
                            <div class="w3-col s4">
                                <img  style="height:68px; width:100%; padding-right: 5px;" class="demo w3-opacity w3-hover-opacity-off w3-opacity-off" src="<?php echo Yii::$app->params['url-building-project-small-rectangle-image'] . (isset($image) ? $image : "no-image.png"); ?>" style="width:100%" onclick="currentDiv(<?php echo ($key + 1); ?>)">

                            </div>
                        <?php } ?>
                          <?php } ?>

                    </div>
                </div>
            
            <div class="w3-content">
                <!-- /.featured-article -->
                <h3><?php echo $model->name; ?></h3>
                <div>
                    <?php echo $model->overview; ?>
                </div>
            </div>
        </div>
        <div class="content-right">

            <ul class="media-list main-list">
                <?php
                foreach ($listRight as $key => $value) {
                    $image = $value->image;
                    ?>
                    <li class="media">
                        <a class="pull-left" href="du-an/<?php echo $value->slug; ?>">
                            <img class="media-object image"  width="168" height="94" src="<?php echo $image? (Yii::$app->params['url-building-project-medium-rectangle-image'] . $image) : (Yii::$app->params['url-building-project-image'] . "no-image.png"); ?>" alt="...">
                        </a>
                        <div class="media-body">
                            <a href="du-an/<?php echo $value->slug; ?>" class="media-heading"><?php echo $value->name; ?></a>
                            <p class="by-author"><?php echo $value->province->name; ?></p>
                            <p class="by-view"><?php echo $value->view ? 'Lượt xem: ' . $value->view : "100 lượt xem" ?></p>
                        </div>
                    </li>
                <?php } ?>
               
            </ul>
        </div>
    </div>
</div>  
