<?php
use yii\widgets\ActiveForm;
use  yii\helpers\Url;
use yii\helpers\Html;
use admin\assets\RedactorAsset;
RedactorAsset::register($this);
 //var_dump(RedactorAsset::register($this));
?>

<?php $form = ActiveForm::begin(['action' =>['project/project-section','id' => $project->id,'menu' => 'project'],'options' => ['id' => 'w' . ($index+1),'class' => 'form-section','enctype' => 'multipart/form-data']]) ?>
<div class="box box-success box-section">
    <div class="box-header with-border">
        <h3 class="box-title">Đoạn <?php echo ($index + 1);?>: <?php echo $title;?>
        </h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-md-2">
                <label for="projectsection-<?php echo $index;?>-imagefile" style="width:200px">
                    <div class="dropzone" style="position: relative; cursor:pointer">
                        <img style="border-radius: 20px;
                                                    width: 120px;
                                                    height: 120px;
                                                    border: 1px solid #ddd;
                                                    position: absolute;
                                                    top: 50%;
                                                    left: 50%;
                                                    transform: translate(-50%,-50%);
                                                " id="projectsection-<?php echo $index;?>-img"
                            src="<?php echo $model->image?Yii::$app->params['url-channels']. 'projects/section/' . $model->image:Yii::$app->params['url-channels']. 'projects/no-image.png'?>"
                            alt="Your image" />
                    </div>
                </label>

                <?= $form->field($model, "[$index]imageFile")->fileInput(['data-id' => $index,'style' => 'display:none'])->label(false); ?>
            </div>
            <div class="col-md-10">
                <?= $form->field($model, "[$index]title")->textInput()->label('Tiêu đề') ?>
                <?= $form->field($model, "[$index]sort")->textInput(['autocomplete' => 'off', 'placeholder'=> 'Sắp xếp'])->label('Sắp xếp') ?>
                <?= $form->field($model, "[$index]description")->widget(\yii\redactor\widgets\Redactor::className())?>
            </div>

        </div>

    </div>
    <div style="text-align: right; margin-bottom:10px; padding:10px;">
        <div class="row">
            <div class="col-md-12">
                <button type="submit" class="btn btn-danger">Lưu lại</button>
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>

<script>
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#projectsection-' + $(input).data('id') + '-img').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
}
$("input[type='file']").change(function() {
    readURL(this);
});
</script>