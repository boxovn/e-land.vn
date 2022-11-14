<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use  yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\HouseSurvey */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="house-survey-form">
	
         
    <?php $form = ActiveForm::begin(); ?>

 
   

   <div action="<?php echo Url::to(["house/multiple-upload"],true);?>" enctype="multipart/form-data" class="dropzone" id="image-upload">
				<input type="hidden" id="UploadImageID" name="upload_image_id" value="" />
	</div>
    <?= $form->field($model, 'content')->widget(\yii\redactor\widgets\Redactor::className())?>
	<div class="form-group">
        <?= Html::submitButton('Lưu lại', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script src="plugins/dropzone/dropzone.js"></script>
<script src="plugins/dropzone/script.js"></script>
