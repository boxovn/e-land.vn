<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\house */

use yii\bootstrap\ActiveForm;
use frontend\widgets\Alert;
use yii\helpers\Html;
$this->title = $house->employee->name;
$this->params['breadcrumbs'][] = ['label' => 'houses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
use yii\helpers\Url;
?>
<div class="content-wrapper">
 <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                   <?=$this->title;?>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-home"></i> Trang chủ</a></li>
                    <li class="active"> <?=$this->title;?></li>
                </ol>
            </section>
			<!-- Main content -->
            <section class="content">
                <div class="row">
				    <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
				    
				        <div class="box">
				            <div class="box-header with-border">
				                <h3 class="box-title">Xem</h3>
							</div>
				            <!-- /.box-header -->
				            <div class="box-body table-responsive">
								<div>
							 <?= Html::a('Danh sách', ['index'], ['class' => 'btn btn-primary btn-sm']) ?>
        <?= Html::a('Sửa', ['update', 'id' => $house->id], ['class' => 'btn btn-warning btn-sm']) ?>
        <?= Html::a('Xóa', ['delete', 'id' => $house->id], [
            'class' => 'btn btn-danger btn-sm',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
  	</div>

    <?= DetailView::widget([
		'model' => $house,
        'attributes' => [
            'employee.name',
            'content:raw',
            [                      // the owner name of the model
				 'attribute' => 'created',
				'format' => ['date', 'php:d/m/Y  H:i']
			],
			[
                 'attribute' => 'images',
				 'format' => 'raw',
				 'value' => function ($data) {
						  $texts = [];
								foreach($data->images as $value){
									  $texts[]=  Html::img(Yii::$app->params['url-page'] . 'channels/article/210x118/' . $value->image, ['alt' => $value->image,'style' => array('height'=>'100px', 'width'=>'auto')]);
								}
						return implode("\n", $texts);
					},
					
					
            ],
        ],
    ]) ?>
		</div>
				            <!-- /.box-body -->
				        </div>
				        <!-- /.box -->
				    </div>
					<div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
				    
				        <div class="box">
				            <div class="box-header with-border">
				                <h3 class="box-title">Xem</h3>
							</div>
				            <!-- /.box-header -->
				            <div class="box-body table-responsive">
								<div>
								 <?= Html::a('Danh sách', ['house-info/index'], ['class' => 'btn btn-primary btn-sm']) ?>
								<?= Html::a('Xóa', ['house-info/delete', 'id' => $houseInfo->id], [
									'class' => 'btn btn-danger btn-sm',
									'data' => [
										'confirm' => 'Are you sure you want to delete this item?',
										'method' => 'post',
									],
								]) ?>
						</div>
								  <?php
                                $form = ActiveForm::begin([
                                            'layout' => 'horizontal',
                                            'fieldConfig' => [
                                                'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
                                                'horizontalCssClasses' => [
                                                    'label' => 'col-sm-3',
                                                    //'offset' => 'col-sm-offset-4',
                                                    'wrapper' => 'col-sm-9 col-md-9',
                                                    'error' => '',
                                                    'hint' => '',
                                                ],
                                            ],
                                ]);
                                ?>
									<?php echo $form->field($houseInfo, 'title')->textInput(); ?>
									<?php echo $form->field($houseInfo, 'name')->textInput(); ?>
									<?php echo $form->field($houseInfo, 'phone')->textInput(); ?>
									<?php echo $form->field($houseInfo, 'width')->textInput(); ?>
									<?php echo $form->field($houseInfo, 'lenth')->textInput(); ?>
									<?php echo $form->field($houseInfo, 'area')->textInput(); ?>
									<?php echo $form->field($houseInfo, 'home')->textInput(); ?>
									<?php echo $form->field($houseInfo, 'price')->textInput(); ?>
									<?php echo $form->field($houseInfo, 'direction')->textInput(); ?>
									<?php echo $form->field($houseInfo, 'alley')->textInput(); ?>
									<?php echo $form->field($houseInfo, 'province_id')
											->dropDownList(
												$provinces,           // Flat array ('id'=>'label')
												[
													'prompt'=>'* Tỉnh/Thành phố',
													
												]    // options
											)?>
											
												<?php echo $form->field($houseInfo, 'district_id')
											->dropDownList(
												$districts,           // Flat array ('id'=>'label')
												[
													'prompt'=>'* Quận/Huyện',
													'disabled' => true,
													
												]    // options
											)?>	
												
											<?php echo $form->field($houseInfo, 'street')
												->textInput(['autocomplete' => 'off', 'placeholder'=> 'Số nhà, Thôn/Xóm, Ấp/Xã, Phường, Đường'])?>
											<?php echo $form->field($houseInfo, 'content')->widget(\yii\redactor\widgets\Redactor::className())?>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button class="btn btn-primary" type="submit">Lưu lại</button>
                                    </div>
                                </div>

                                <?php ActiveForm::end(); ?>
							</div>
				            <!-- /.box-body -->
				        </div>
				        <!-- /.box -->
				    </div>
				</div>
            </section>
            <!-- /.content -->
        </div>
		<script type="text/javascript">
		
        <!-- /.content-wrapper -->
$('select[name="houseInfo[province_id]"]').on('change', function() {
    var provinceId = $(this).val();
	console.log(provinceId);
	if(provinceId > 0){
    $.ajax({
        type: 'get',
        url: "<?php echo  Url::to(['house/districts']);?>",
        data: {province_id : provinceId },
		dataType: 'json',
        success: function (data) {
			$('#houseinfo-district_id').find('option')
					.remove()
					.end();
			$('#houseinfo-district_id')
					.append($("<option></option>")
                    .attr("value",'')
                    .text('* Quận/Huyện')); 		
			$.each(data.districts, function (i, item) {
					$('#houseinfo-district_id')
					.append($("<option></option>")
                    .attr("value",item.district_id)
                    .text(item.name)); 
			});
			$('select[name="houseInfo[district_id]"]').attr('disabled',false);
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
		$('select[name="houseInfo[district_id]"]').attr('disabled',true);
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