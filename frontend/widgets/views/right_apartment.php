 <?php 
use  yii\helpers\Url;
?>
 <div class="list-head">
     <h2 class="list-title"><?=$title;?></h2>
 </div>
 <div class="media-list main-list" style="float:left">

     <?php
                foreach ($listRight as $key => $value) {
                   $image = $value->image;
                    ?>
     <div class="media">
         <a class="pull-left" href="<?php echo Url::to(['project/detail','slug' => $value->slug, 'project_id' => $value->id],true);?>">
             <?php if(@getimagesize(Url::to('@web/images/building_project/medium_rectangle_image/' . $value->image, true))){ ?>
             <img
                 src="<?php echo Url::to('@web/images/building_project/medium_rectangle_image/' . $value->image, true);?>">
             <?php }else{ ?>
             <img class="media-object image" src="<?php echo Url::to('@web/images/no-image210x118.png', true);?>"
                 alt="...">
             <?php }?>
         </a>
         <div class="media-body">
             <a href="<?php echo Url::to(['project/detail','slug' => $value->slug,'project_id' => $value->id],true);?>"
                 class="media-heading"><?php echo $value->name; ?></a>
             <p class="by-author">
                 <?php echo $value->district->type . ' ' . $value->district->name; ?>,<?php echo $value->province->name; ?>
             </p>
             
         </div>
     </div>
     <?php } ?>
 </div>