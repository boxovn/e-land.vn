<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use  yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model common\models\Note */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="note-form">

    <?php $form = ActiveForm::begin(); ?>
	<?=$form->field($model, 'employee_id')->dropDownList(
									$employees,
									[
													'prompt'=>'Đầu chủ',
													
									]           // Flat array ('id'=>'label')
								); ?>
								
	<div action="<?php echo Url::to(["note/multiple-upload"],true);?>" enctype="multipart/form-data" class="dropzone" id="image-upload">
				<input type="hidden" id="UploadImageID" name="upload_image_id" value="" />
	</div>
	<?= $form->field($model, 'content')->widget(\yii\redactor\widgets\Redactor::className())?>
    <?=$form->field($model, 'status')->dropDownList(
									[0  => 'Chưa chuyển đổi', 1=> 'Đã chuyển đổi']           // Flat array ('id'=>'label')
								); ?>
	<div class="form-group">
        <?= Html::submitButton('Lưu lại', ['class' => 'btn btn-success']) ?>
    </div>
	<?php ActiveForm::end(); ?>

</div>
<script src="plugins/dropzone/dropzone.js"></script>
<script src="plugins/dropzone/script.js"></script>