<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use  yii\helpers\Url;
use yii\helpers\ArrayHelper;
use common\models\Ward;
/* @var $this yii\web\View */
/* @var $model common\models\Note */
/* @var $form yii\widgets\ActiveForm */

use yii\jui\DatePicker;
?>

<script>
//window.deleteImageUrl = '<?php echo Url::to(['note/delete-image',true]);?>';
//window.dropzoneImage = JSON.parse('<?php echo json_encode($dropzoneImage);?>');
</script>
<div class="note-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php 

                                                echo $form->field($model, 'house_segment_id')
                                            ->dropDownList(
                                                $houseSegments,           // Flat array ('id'=>'label')
                                                array( 
                                                    'id' => 'house_segment_id', 
                                                    'prompt'=>'* Phân khúc giá',
                                                    'disabled' =>  false,
                                                    'class'  => 'form-control',
                                                   
                                                )
									            )?>
    <?= $form->field($model, 'description')->textArea(['rows' => 4])->label(' Nguồn nhà ( Cấu trúc nhà: <span style="color:red">[Điạ chỉ] [Diện tích] [Tầng] [Mặt tiền] [Dài] [Gía]</span> )') ?>
    <?= $form->field($model, 'ask')->textInput(['autocomplete' => 'off', 'placeholder'=> 'Gía chào bán'])->label('Giá chào bán')?>
    <?php 
     $model->province_id =  79;
     echo $form->field($model, 'province_id')
                                            ->dropDownList(
                                                $provinces,           // Flat array ('id'=>'label')
                                                [
                                                    'prompt'=>'* Tỉnh/Thành phố',
                                                    
                                                ]    // options
                                            )?>

    <?php 

                                                echo $form->field($model, 'district_id')
                                            ->dropDownList(
                                                $districts,           // Flat array ('id'=>'label')
                                                [
                                                    'prompt'=>'* Quận/Huyện',
                                                    'disabled' => false,// ($model->district_id>0)?false:true,
                                                    
                                                ]    // options
                                            )?>
    <?php 

                                                echo $form->field($model, 'ward_id')
                                            ->dropDownList(
                                               // $wards,           // Flat array ('id'=>'label')
                                               ArrayHelper::map(Ward::find()->andWhere(['district_id' => $model->district_id])->orderBy('type desc, name asc')->all(), 'ward_id', function ($ward_id) {
                            return $ward_id->type.' '.$ward_id->name;
                }),
                                                [
                                                    'prompt'=>'* Phường',
                                                    'disabled' =>  ($model->district_id>0)?false:true,
                                                    
                                                ]    // options
                                            )?>

    <?php /* echo $form->field($model, 'street')->textInput(['autocomplete' => 'off', 'placeholder'=> 'Đường'])->label('Đường');*/?>
    <?=$form->field($model, 'status')->dropDownList(
									[0  => 'Đang bán', 1=> 'Đã bán']           // Flat array ('id'=>'label')
								); ?>
    <?php 
           $model->permission = 1;
        echo $form->field($model, 'permission')->dropDownList(
									[0  => 'Mình tôi', 1 => 'Mọi người']           // Flat array ('id'=>'label')
								); ?>
    <?php /*$form->field($model, 'exclusive')->dropDownList([0 => 'Độc quyền bán', 1 => 'Độc quyền hoa hồng']);*/ ?>

    <div id="image-upload" action="<?php echo Url::to(["house/multiple-upload"],true);?>" enctype="multipart/form-data"
        class="dropzone">
        <input type="hidden" id="UploadImageID" name="upload_image_id" value="" />
    </div>
    <?= $form->field($model, 'content')->widget(\yii\redactor\widgets\Redactor::className())?>

    <div class="form-group">
        <?= Html::submitButton('Lưu lại', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>

<script type="text/javascript">
window.dropzoneImage = JSON.parse('<?php echo json_encode($dropzoneImage);?>');
console.log(window.dropzoneImage);
</script>
<?php echo $this->registerJsFile('@web/plugins/dropzone/dropzone.js');?>
<?php echo $this->registerJsFile('@web/plugins/dropzone/script.js');?>
<script type="text/javascript">
$('input:checkbox[name="House[contract_end_date]"]').change(function() {
    var ischecked = $(this).is(':checked');
    var date = '<?php echo $model->contract_end_date;?>';
    if (!ischecked) {
        $('input[name="House[contract_end_date]"]').val(date);
    } else {
        $('input[name="House[contract_end_date]"]').val('');
    }

});
</script>
<script type="text/javascript">
$('select[name="House[province_id]"]').on('change', function() {
    var provinceId = $(this).val();
    console.log(provinceId);
    if (provinceId > 0) {
        $.ajax({
            type: 'get',
            url: '<?php echo Url::to(["house/districts"]);?>',
            data: {
                province_id: provinceId
            },
            dataType: 'json',
            success: function(data) {
                $('#house-district_id').find('option')
                    .remove()
                    .end();
                $('#house-district_id')
                    .append($("<option></option>")
                        .attr("value", '')
                        .text('* Quận/Huyện'));
                $.each(data.districts, function(i, item) {
                    $('#house-district_id')
                        .append($("<option></option>")
                            .attr("value", item.district_id)
                            .text(item.name));
                });
                $('select[name="House[district_id]"]').attr('disabled', false);
            }
        });
    } else {
        $('#article-district_id').find('option')
            .remove()
            .end();
        $('#article-district_id')
            .append($("<option></option>")
                .attr("value", '')
                .text('* Quận/Huyện'));
        $('select[name="House[district_id]"]').attr('disabled', true);
    }
});
</script>

<script type="text/javascript">
$('select[name="House[district_id]"]').on('change', function() {
    var districtId = $(this).val();
    if (districtId > 0) {
        $.ajax({
            type: 'get',
            url: '<?php echo Url::to(["house/wards"]);?>',
            data: {
                district_id: districtId
            },
            dataType: 'json',
            success: function(data) {
                $('#house-ward_id').find('option')
                    .remove()
                    .end();
                $('#house-ward_id')
                    .append($("<option></option>")
                        .attr("value", '')
                        .text('* Phường/Xã'));
                $.each(data.wards, function(i, item) {
                    $('#house-ward_id')
                        .append($("<option></option>")
                            .attr("value", item.ward_id)
                            .text(item.name));
                });
                $('select[name="House[ward_id]"]').attr('disabled', false);
            }
        });
    } else {
        $('#house-ward_id').find('option')
            .remove()
            .end();
        $('#house-ward_id')
            .append($("<option></option>")
                .attr("value", '')
                .text('* Phường/Xã'));
        $('select[name="House[ward_id]"]').attr('disabled', true);
    }
});
</script>