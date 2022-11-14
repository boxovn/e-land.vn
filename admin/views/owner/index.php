<?php
use backend\widgets\Alert;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use common\models\Owner;
use yii\bootstrap\ActiveForm;


?>
<style>
	label {
   cursor: pointer;
	color: #333;
    background-color: #fff;
    border-color: #333;
	width: 100px;
    height: 20px;
    line-height: 15px;
    padding: 1px 5px;
    font-size: 11px;
    font-weight: bold;
	border: 1px solid  #333;
    border-radius: 4px;
	text-align: center;
   /* Style as you please, it will become the visible UI component. */
}

#importform-file {
   opacity: 0;
   position: absolute;
   z-index: -1;
   display:none;
   
}
#form-file{
	border: 1px solid #333;
	padding:20px;
}

#form-file .help-block{
	float:left;
	font-size:small;
}
#updateFile{
	width: 100px;
    height: 20px;
}
</style>
		<!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Danh sách
                    <small></small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-home"></i> Trang chủ</a></li>
                    <li class="active">Danh sách</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
				    <div class="col-xs-12">
				    	<?php echo Alert::widget(); ?> 
				        <div class="box box-danger">
				            <div class="box-header with-border">
				              <div class="col-xs-6" id="form-file" >
								<?php
									$form = ActiveForm::begin(
									[
									
										'id' => 'contact-form',
										'options' => ['enctype' => 'multipart/form-data'],
										'fieldConfig' => [
											'options' => [
												'tag' => false,
											],
										],
									]
									); ?>
										<div class="col-md-6">
											<?= $form->field($model, 'file')->fileInput()->label('Chọn file');?>
											
											<button id="updateFile" class="btn btn-xs btn-primary">Cập nhập</button>
										</div>
									<?php ActiveForm::end(); ?>
									</div>
									
							</div>
							<div class="box-body" style="overflow: auto;">
				     <?php
                    echo GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $ownerSearch,
						'layout' => "{summary}\n{pager}\n{items}\n{pager}",
						'showFooter' => true,
						'pager' => [
									'firstPageLabel' => 'First',
									'lastPageLabel' => 'Last',
								],
                        'columns' => [
                            [
                                'attribute' => 'id',
                                'class' => 'yii\grid\DataColumn',
                                'contentOptions' => ['style' => 'text-align:center;vertical-align: middle;'],
                                'headerOptions' => ['style' => 'width: 8%;text-align:center; '],
                            ],
							
                             [
                                'attribute' => 'name',
                                'class' => 'yii\grid\DataColumn',
                                'contentOptions' => ['style' => 'text-align:center;vertical-align: middle;'],
                               'headerOptions' => ['style' => 'text-align:center; '],
                            ],
                           
                            [
                                'attribute' => 'phone',
                                'class' => 'yii\grid\DataColumn',
                                'contentOptions' => ['style' => 'text-align:center;vertical-align: middle;'],
                               'headerOptions' => ['style' => 'text-align:center; '],
                            ],
							 [
                                'attribute' => 'address',
                                'class' => 'yii\grid\DataColumn',
                                'contentOptions' => ['style' => 'vertical-align: middle;'],
                                'headerOptions' => ['style' => 'text-align:center; '],
                            ],
							[
                                'attribute' => 'price',
                                'class' => 'yii\grid\DataColumn',
                                'contentOptions' => ['style' => 'text-align:center;vertical-align: middle;'],
                               'headerOptions' => ['style' => 'text-align:center; '],
                            ],
							[
                                'attribute' => 'unit',
                                'class' => 'yii\grid\DataColumn',
                                'contentOptions' => ['style' => 'text-align:center;vertical-align: middle;'],
                               'headerOptions' => ['style' => 'text-align:center; '],
                            ],
							[
                                'attribute' => 'area',
                                'class' => 'yii\grid\DataColumn',
                                'contentOptions' => ['style' => 'text-align:center;vertical-align: middle;'],
                               'headerOptions' => ['style' => 'text-align:center; '],
                            ],
							[
                                'attribute' => 'home',
                                'class' => 'yii\grid\DataColumn',
                                'contentOptions' => ['style' => 'text-align:center;vertical-align: middle;'],
                               'headerOptions' => ['style' => 'text-align:center; '],
                            ],
							[
                                'attribute' => 'direction',
                                'class' => 'yii\grid\DataColumn',
                                'contentOptions' => ['style' => 'text-align:center;vertical-align: middle;'],
                               'headerOptions' => ['style' => 'text-align:center; '],
                            ],
							[
                                'attribute' => 'alley',
                                'class' => 'yii\grid\DataColumn',
                                'contentOptions' => ['style' => 'text-align:center;vertical-align: middle;'],
                               'headerOptions' => ['style' => 'text-align:center; '],
                            ],
							[
                                'attribute' => 'deposit_date',
                                'class' => 'yii\grid\DataColumn',
								 'format' => 'html',
								 'value' => function($data){
										return date('d/m/Y',strtotime($data->deposit_date));
								 },
                                'contentOptions' => ['style' => 'text-align:center;vertical-align: middle;'],
                               'headerOptions' => ['style' => 'text-align:center; '],
                            ],
							[
                                'attribute' => 'sub_district',
                                'class' => 'yii\grid\DataColumn',
                                'contentOptions' => ['style' => 'text-align:center;vertical-align: middle;'],
                               'headerOptions' => ['style' => 'text-align:center; '],
                            ],
							[
                                'attribute' => 'note',
                                'class' => 'yii\grid\DataColumn',
                                'contentOptions' => ['style' => 'text-align:center;vertical-align: middle;'],
                               'headerOptions' => ['style' => 'text-align:center; '],
                            ],
							[
                                'attribute' => 'status',
                                'class' => 'yii\grid\DataColumn',
								 'value' => function($data){
										return $data->status? 'Đã bán': 'Chưa bán';
								 },
                                'contentOptions' => ['style' => 'text-align:center;vertical-align: middle;'],
                               'headerOptions' => ['style' => 'text-align:center; '],
							   'filter' => [0 => 'Chưa bán', 1 => 'Đã bán']
                            ],
							[
                                'class' => 'yii\grid\DataColumn',
                                'format' => 'raw',
									'filter' => '<button class="btn btn-default btn-xs" style="width:85px"><i class="glyphicon glyphicon-search"></i><span class="action-text">Tìm kiếm<span class="action-text"></button>',
								'header' => '<a class="btn btn-primary btn-xs" style="width:85px" href="'.yii::$app->urlManager->createUrl(["owner/edit"]).'"><i class="fa fa-plus-square"></i> Thêm</a>',
								'value' => function ($data) {
                                    return Html::a('<i class="fa fa-edit"></i> Sửa', Url::to(['owner/edit', 'id' => $data->id]), ['class' => 'btn btn-xs btn-warning']) . '&nbsp' .
                                    Html::a('<i class="fa fa-remove"></i> Xóa', Url::to(['owner/delete', 'id' => $data->id]), ['data-method' => 'post', 'class' => 'btn btn-xs btn-danger', 'data-placement' => 'top', 'data-original-title' => 'Delete']);
                           
                        },
                                'contentOptions' => ['style' => 'text-align:center;vertical-align: middle;'],
                               'headerOptions' => ['style' => 'width: 12%;text-align:center; '],
                            ],
                        ],
                    ]);
                    ?>
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
<script>

	$('#importform-file').change(function () {
    $('p.help-block').html($(this).val());
})
</script>    
   