<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model common\models\NoteInfo */
$this->params['breadcrumbs'][] = ['label' => 'Note Infos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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
				    <div class="col-md-6 col-xs-12 col-sm-12">
				    
				        <div class="box">
				            <div class="box-header with-border">
				                <h3 class="box-title">Xem</h3>
							</div>
				            <!-- /.box-header -->
				            <div class="box-body table-responsive">

    

    <p>
    	 <?= Html::a('Danh sách', ['index'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Sửa', ['update', 'id' => $noteInfo->id], ['class' => 'btn btn-warning']) ?>
        <?= Html::a('Xóa', ['delete', 'id' => $noteInfo->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $noteInfo,
        'attributes' => [
            'id',
            [
                 'attribute' => 'type_id',
				 'format' => 'raw',
				 'value' => function ($data) {
				 	 return $data->type->title;
				 }
			],
            'title',
            'name',
            'phone',
            'street',
            'area',
            'home',
            'width',
            'lenth',
            'price',
            'direction',
            'alley',
            'district.name',
            'province.name',
            [
                 'attribute' => 'status',
				 'format' => 'raw',
				 'value' => function ($data) {
				 	  $arr= [ 
                                                
                                                0 =>'<span  class="label label-primary">Chưa bán</span>',
                                                1 => '<span class="label label-warning">Đang rao bán</span>',
                                                2 => '<span  class="label label-success">Đã chốt</span>'
                                            ];
                                            return $arr[$data->status];
				 }
				],
            'content:raw',
            'created',
           	[
                 'attribute' => 'images',
				 'format' => 'raw',
				 'value' => function ($data) {
						  $texts = [];
								foreach($data->images as $value){
									  $texts[]=  Html::tag('div',Html::img(Yii::$app->params['url-page'] . 'channels/article/210x118/' . $value->image, ['alt' => $value->image,'style' => array('height'=>'100px', 'width'=>'auto')]));
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
					<div class="col-md-6 col-xs-12 col-sm-12">
				    
				        <div class="box">
				            <div class="box-header with-border">
				                <h3 class="box-title">Xem</h3>
							</div>
				            <!-- /.box-header -->
				            <div class="box-body table-responsive">
								<p>
								 <?= Html::a('Danh sách', ['note-info/index'], ['class' => 'btn btn-primary btn-sm']) ?>
								<?= Html::a('Xóa', ['note-info/delete', 'id' => $article->id], [
									'class' => 'btn btn-danger btn-sm',
									'data' => [
										'confirm' => 'Are you sure you want to delete this item?',
										'method' => 'post',
									],
								]) ?>
						</p>
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

                                <?php $article->user_id = '28113';  echo $form->field($article, 'user_id')
											->dropDownList($users)->label('Người đăng')?>
											<?php echo $form->field($article, 'status')
											->dropDownList(
												[
													0 => 'Ẩn tin đăng',
													1 => 'Hiện tin đăng'
													
												]    // options
											)->label('Trạng thái')?>
									<?php echo $form->field($article, 'title')->textInput(); ?>
										<?php echo $form->field($article, 'area_text')->textInput(); ?>
											<?php echo $form->field($article, 'price_text')->textInput(); ?>
									<?php echo $form->field($article, 'province_id')
											->dropDownList(
												$provinces,           // Flat array ('id'=>'label')
												[
													'prompt'=>'* Tỉnh/Thành phố',
													
												]    // options
											)?>
											
												<?php echo $form->field($article, 'district_id')
											->dropDownList(
												$districts,           // Flat array ('id'=>'label')
												[
													'prompt'=>'* Quận/Huyện',
													'disabled' => ($article->district_id > 0)? false:true,
													
												]    // options
											)?>	
												
											<?php echo $form->field($article, 'street')
												->textInput(['autocomplete' => 'off', 'placeholder'=> 'Số nhà, Thôn/Xóm, Ấp/Xã, Phường, Đường'])?>
												<?php echo $form->field($article, 'type_id')
													->dropDownList(
														$articleTypes,           // Flat array ('id'=>'label')
														[
															'prompt'=>'* Tin rao ?',
														]    // options
													)->label(false) ?> 
											<?php echo $form->field($article, 'content')->widget(\yii\redactor\widgets\Redactor::className())?>
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
        <!-- /.content-wrapper -->


<script type="text/javascript">
		
        <!-- /.content-wrapper -->
$('select[name="Article[province_id]"]').on('change', function() {
    var provinceId = $(this).val();
	console.log(provinceId);
	if(provinceId > 0){
    $.ajax({
        type: 'get',
        url: "<?php echo  Url::to(['note/districts']);?>",
        data: {province_id : provinceId },
		dataType: 'json',
        success: function (data) {
			$('#article-district_id').find('option')
					.remove()
					.end();
			$('#article-district_id')
					.append($("<option></option>")
                    .attr("value",'')
                    .text('* Quận/Huyện')); 		
			$.each(data.districts, function (i, item) {
					$('#article-district_id')
					.append($("<option></option>")
                    .attr("value",item.district_id)
                    .text(item.name)); 
			});
			$('select[name="Article[district_id]"]').attr('disabled',false);
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