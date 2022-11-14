<?php 
    use yii\helpers\Html;
?>
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
                        <img style="            border-radius: 20px;
                                                    width: 120px;
                                                    height: 120px;
                                                    border: 1px solid #ddd;
                                                    position: absolute;
                                                    top: 50%;
                                                    left: 50%;
                                                    transform: translate(-50%,-50%);
                                                " id="projectsection-<?php echo $index;?>-img"
                            src="<?php echo Yii::$app->params['url-channels']. 'projects/section/' . ($model->image?$model->image:'upload.png')?>"
                            alt="Your image" />
                    </div>
                </label>
                <?= Html::activeInput('text', $model, "[$index]imageFile", ['data-id' => $index,'style' => 'display:none']); ?>
            </div>
            <div class="col-md-10">
                <?= Html::activeInput('text', $model, "[$index]title", ['class' => 'form-control', 'data-id' => $index, 'placeholder'=> 'Tiêu đề']); ?>
                <?= Html::activeInput('text', $model, "[$index]sort", ['class' => 'form-control', 'data-id' => $index, 'placeholder'=> 'Sắp xếp']); ?>
                <?= \yii\redactor\widgets\Redactor::widget([
                    'model' => $model,
                    'attribute' => "[$index]description"
                ]) ?>

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