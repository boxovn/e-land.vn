<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Note */
/* @var $form yii\widgets\ActiveForm */

use yii\jui\DatePicker;
?>
<script>
	window.deleteImageUrl = '<?php echo Url::to(['note/delete-image',true]);?>';
     window.dropzoneImage = JSON.parse('<?php echo json_encode($dropzoneImage);?>');
</script>
<div class="note-form">

    <?php $form = ActiveForm::begin(); ?>
    <?=$form->field($model, 'user_id')->dropDownList(
                                    $users,
                                    [
                                                    'prompt'=>'Đầu chủ',
                                                    
                                    ]           // Flat array ('id'=>'label')
                                )->label('Đầu chủ'); ?>
    <?= $form->field($model, 'description')->textInput(['autocomplete' => 'off']) ?>
     <?php 
     $model->province_id =  79;
     echo $form->field($model, 'province_id')
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
                                                    'disabled' => false,// ($model->district_id>0)?false:true,
                                                    
                                                ]    // options
                                            )?> 
                                            
                                            <?php echo $form->field($model, 'street')
                                                ->textInput(['autocomplete' => 'off', 'placeholder'=> 'Đường'])->label('Đường')?>
	
	<?=$form->field($model, 'exclusive')->dropDownList(
									[0 => 'Độc quyền bán', 1 => 'Độc quyền hoa hồng']
								); ?>
	<?= $form->field($model, 'contract_date')->widget(DatePicker::className(),[
		'options' => ['class' => 'form-control', 'autocomplete' => 'off'],
	 	'dateFormat' => 'php:d/m/Y',
	 	'value'  => $model->contract_date

		 
	]) ?>
	<?= $form->field($model, 'contract_end_date')->widget(DatePicker::className(),[ 
    				 
           		
           			 'dateFormat' => 'php:d/m/Y',
    				'options' => ['class' => 'form-control' , 'autocomplete' => 'off'],
						'value'  => $model->contract_end_date
				]
	) ?>
	<?php 
             $checked = strtotime($model->contract_end_date)? false :true;
    echo $form->field($model, 'contract_end_date')->checkBox(['label' => 'Không thời hạn', 'uncheck' => null,  'checked' => $checked]); ?>
								
	<div action="<?php echo Url::to(["note/multiple-upload"],true);?>" enctype="multipart/form-data" class="dropzone" id="image-upload">
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
<script type="text/javascript">
    $('input:checkbox[name="House[contract_end_date]"]').change(function() {
                    var ischecked= $(this).is(':checked');
                    var date= '<?php echo $model->contract_end_date;?>';
                    if(!ischecked){
                     $('input[name="House[contract_end_date]"]').val(date);
                    }else{
                         $('input[name="House[contract_end_date]"]').val('');
                    }

                }); 

  

</script>
<script type="text/javascript">
        
        
$('select[name="House[province_id]"]').on('change', function() {
    var provinceId = $(this).val();
    console.log(provinceId);
    if(provinceId > 0){
    $.ajax({
        type: 'get',
        url: '<?php echo Url::to(["house/districts"]);?>',
        data: {province_id : provinceId },
        dataType: 'json',
        success: function (data) {
            $('#house-district_id').find('option')
                    .remove()
                    .end();
            $('#house-district_id')
                    .append($("<option></option>")
                    .attr("value",'')
                    .text('* Quận/Huyện'));         
            $.each(data.districts, function (i, item) {
                    $('#house-district_id')
                    .append($("<option></option>")
                    .attr("value",item.district_id)
                    .text(item.name)); 
            });
            $('select[name="House[district_id]"]').attr('disabled',false);
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
        $('select[name="House[district_id]"]').attr('disabled',true);
    }
});

</script>