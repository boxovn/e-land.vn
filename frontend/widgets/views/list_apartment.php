<?php 
use common\models\BuildingProjectInfo;
use  yii\helpers\Url;
use yii\helpers\Html;
?>

<?php if($models){ ?>
<div class="list-box">
    <div class="list-head">
        <h2 class="list-title"><?php echo $category_name; ?></h2>
    </div>
<?php
foreach ($models as $key => $value) {
    $image = $value->image;
    ?>
    <div class="column project" >
         <div class="box-image">
        <a  title="<?php echo $value->name; ?>" href="<?php echo Url::to(['project/detail','slug' => $value->slug, 'project_id' => $value->id],true);?>">
                    <?php if(@getimagesize(Url::to('@web/images/building_project/medium_rectangle_image/' . $image, true))){ ?>
                        <img  class="image" alt="<?php echo $value->name; ?>"  src="<?php echo Url::to('@web/images/building_project/medium_rectangle_image/' . $image, true)?>"/>
                    <?php }else{ ?>
                        <img  class="no-image" alt="<?php echo $value->name; ?>" src="<?php echo Url::to('@web/images/no-image210x118.png', true);?>"/>
                    <?php }?>
                </a>
               </div> 
        <div class="box-description">
             <div class="wap-title">
                    <a class="title" title="<?php echo $value->name; ?>"  href="<?php echo Url::to(['project/detail','slug' => $value->slug, 'project_id' => $value->id],true);?>"><?php echo $value->name; ?></a>
                </div>
                        <div  class="province" >
                            <a title="<?php echo $value->address;?>" href="<?php echo Url::to(['project/district','district' => $value->district->slug,'province' => $value->province->slug,'district_id' => $value->district->district_id,'province_id' => $value->province->province_id],true);?>"><?php echo isset($value->district)?($value->district->type . ' '. $value->district->name):'';?></a>
                            <a title="<?php echo $value->address;?>" href="<?php echo Url::to(['project/province','province' => $value->province->slug,'province_id' => $value->province->province_id,'project_id' => $value->id],true);?>">, <?php echo isset($value->province)?$value->province->name:'';?></a>
                        </div>
                </div>
       
    </div>
<?php } ?>
</div>
<?php } ?>