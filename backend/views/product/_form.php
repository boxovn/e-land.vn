<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use  yii\helpers\Url;
use yii\helpers\ArrayHelper;
use common\models\Ward;
/* @var $this yii\web\View */
/* @var $model common\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="product-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'author')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>
   
    <?= $form->field($model, 'discount')->textInput(['maxlength' => true]) ?>

    
    <div id="product-image-upload"
        action="<?php echo Url::to(["product/multiple-upload-images", 'id' => $model->id],true);?>"
        enctype="multipart/form-data" class="dropzone">
        <input type="hidden" id="UploadProductImageID" name="upload_product_image_id" value="" />
    </div>
    
    <?= $form->field($model, 'details')->widget(\yii\redactor\widgets\Redactor::className(),['clientOptions' => [
                                                                   'plugins' => [
                                                                                'alignment',
                                                                                'video',
                                                                                'table',
                                                                                'fontfamily',
                                                                                'clips',
                                                                                'fontcolor',
                                                                                'filemanager',
                                                                                'imagemanager',
                                                                                'fontsize'
                                                                            ]
                                                                ]
                                                    ])?>
    <?= $form->field($model, 'description')->widget(\yii\redactor\widgets\Redactor::className(),['clientOptions' => [
                                                                   'plugins' => [
                                                                                'alignment',
                                                                                'video',
                                                                                'table',
                                                                                'fontfamily',
                                                                                'clips',
                                                                                'fontcolor',
                                                                                'filemanager',
                                                                                'imagemanager',
                                                                                'fontsize'
                                                                            ]
                                                                ]
                                                    ])?>

    <div class="form-group">
        <?= Html::submitButton('Lưu', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
<script type="text/javascript">
window.dropzoneImage = JSON.parse('<?php echo json_encode($dropzoneImage);?>');
</script>
<?php echo $this->registerJsFile('@web/plugins/dropzone/dropzone.js');?>
<?php echo $this->registerJsFile('@web/plugins/dropzone/script_product.js');?>