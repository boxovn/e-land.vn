<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model common\models\NoteInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="note-info-form">

    <?php $form = ActiveForm::begin(); ?>
    <?=$form->field($model, 'category_type_id')->dropDownList(
                                    $types,
                                    [
                                                    'prompt'=>'Loại tin rao?',
                                                    
                                    ]           // Flat array ('id'=>'label')
                                ); ?>
    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

   <?= $form->field($model, 'area')->textInput() ?>

    <?= $form->field($model, 'home')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'width')->textInput() ?>

    <?= $form->field($model, 'lenth')->textInput() ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'direction')->textInput() ?>

    <?= $form->field($model, 'alley')->textInput() ?>

     <?php echo $form->field($model, 'province_id')
                                            ->dropDownList(
                                                $provinces,           // Flat array ('id'=>'label')
                                                [
                                                    'prompt'=>'* Tỉnh/Thành phố',
                                                    
                                                ]    // options
                                            )?>
                                            
                                                <?php echo $form->field($model, 'district_id')
                                            ->dropDownList(
                                                $districts,           // Flat array ('id'=>'label')
                                                [
                                                    'prompt'=>'* Quận/Huyện',
                                                    'disabled' => ($model->district_id>0)?false:true,
                                                    
                                                ]    // options
                                            )?> 
                                                
                                            <?php echo $form->field($model, 'street')
                                                ->textInput(['autocomplete' => 'off', 'placeholder'=> 'Số nhà, Thôn/Xóm, Ấp/Xã, Phường, Đường'])?>

   <?php echo $form->field($model, 'content')->widget(\yii\redactor\widgets\Redactor::className())?>
	<div class="form-group">
        <?= Html::submitButton('Luu lại', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script type="text/javascript">
        
        <!-- /.content-wrapper -->
$('select[name="NoteInfo[province_id]"]').on('change', function() {
    var provinceId = $(this).val();
    console.log(provinceId);
    if(provinceId > 0){
    $.ajax({
        type: 'get',
        url: "<?php echo  Url::to(['note/districts']);?>",
        data: {province_id : provinceId },
        dataType: 'json',
        success: function (data) {
            $('#noteinfo-district_id').find('option')
                    .remove()
                    .end();
            $('#noteinfo-district_id')
                    .append($("<option></option>")
                    .attr("value",'')
                    .text('* Quận/Huyện'));         
            $.each(data.districts, function (i, item) {
                    $('#noteinfo-district_id')
                    .append($("<option></option>")
                    .attr("value",item.district_id)
                    .text(item.name)); 
            });
            $('select[name="NoteInfo[district_id]"]').attr('disabled',false);
        }
    });
    }else{
            $('#article-district_id').find('option')
                    .remove()
                    .end();
            $('#article-district_id')
                    .append($("<option></option>")
                    .attr("value",'')
                    .text('* Quận/Huyện')); 
        $('select[name="NoteInfo[district_id]"]').attr('disabled',true);
    }
});
$('select[name="User[province_id]"]').on('change', function() {
    var provinceId = $(this).val();
    console.log(provinceId);
    if(provinceId > 0){
    $.ajax({
        type: 'get',
        url: $(location).attr("origin") + '/user/districts',
        data: {province_id : provinceId },
        dataType: 'json',
        success: function (data) {
            $('#user-district_id').find('option')
                    .remove()
                    .end();
            $('#user-district_id')
                    .append($("<option></option>")
                    .attr("value",'')
                    .text('* Quận/Huyện'));         
            $.each(data.districts, function (i, item) {
                    $('#user-district_id')
                    .append($("<option></option>")
                    .attr("value",item.district_id)
                    .text(item.name)); 
            });
                $('select[name="User[district_id]"]').attr('disabled',false);   
        }
    });
    }else{
            $('#user-district_id').find('option')
                    .remove()
                    .end();
            $('#user-district_id')
                    .append($("<option></option>")
                    .attr("value",'')
                    .text('* Quận/Huyện')); 
        $('select[name="User[district_id]"]').attr('disabled',true);
    }
});
</script>
