<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\NoteInfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sản phẩm';
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                   <?= Html::encode($this->title) ?>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-home"></i> Trang chủ</a></li>
                    <li class="active">Danh mục</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
				    <div class="col-xs-12">
							
				        <div class="box">
				            <div class="box-header">
				                <h3 class="box-title">Danh sách</h3>
							</div>
				            <!-- /.box-header -->
				            
				            <div class="box-body table-responsive" style="padding-top: 30px;">
				        

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>



    <p>
        <?= Html::a('Thêm', ['create'], ['class' => 'btn btn-success btn-sm']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
				['class' => 'yii\grid\SerialColumn'],
                    
				 [
								'class' => 'yii\grid\DataColumn',
								'attribute' => 'name',
								'contentOptions' => ['class' => 'text-content'],
								'headerOptions' => ['class' => 'text-header']
				],
                [
                            'class' => 'yii\grid\DataColumn',
                            'attribute' => 'type_id',
                              'value' => function($data){
                                return isset($data->type)?$data->type->title:'';
                              },
                            'contentOptions' => ['class' => 'text-content'],
                            'headerOptions' => ['class' => 'text-header'],
                            'filter' => $types,
                        ], 
                        [
                            'class' => 'yii\grid\DataColumn',
                            'attribute' => 'status',
                            'format' => 'raw',
                             'value' => function($data){
                                        $arr= [ 
                                                
                                                0 =>'<span  class="label label-primary">Chưa bán</span>',
                                                1 => '<span class="label label-warning">Đang rao bán</span>',
                                                2 => '<span  class="label label-success">Đã chốt</span>'
                                            ];
                                        return $arr[$data->status]; 
                                 },
                            'contentOptions' => ['class' => 'text-content'],
                            'headerOptions' => ['class' => 'text-header'],
                              'filter' => [1 => 'Đang rao bán', 0 => 'Chưa bán', 'Đã chốt']
                        ], 

			[
                            'class' => 'yii\grid\DataColumn',
                            'attribute' => 'title',
                            'contentOptions' => ['class' => 'text-content'],
                            'headerOptions' => ['class' => 'text-header','style' => 'width:25%']
            ],
           
			[
                            'class' => 'yii\grid\DataColumn',
                            'attribute' => 'phone',
                            'contentOptions' => ['class' => 'text-content'],
                            'headerOptions' => ['class' => 'text-header']
            ],	
			[
                            'class' => 'yii\grid\DataColumn',
                            'attribute' => 'phone',
                            'contentOptions' => ['class' => 'text-content'],
                            'headerOptions' => ['class' => 'text-header']
            ],	
			[
                            'class' => 'yii\grid\DataColumn',
                            'attribute' => 'street',
                            'contentOptions' => ['class' => 'text-content'],
                            'headerOptions' => ['class' => 'text-header']
            ],	
			[
                            'class' => 'yii\grid\DataColumn',
                            'attribute' => 'area',
                            'contentOptions' => ['class' => 'text-content'],
                            'headerOptions' => ['class' => 'text-header']
           ],	
			[
                            'class' => 'yii\grid\DataColumn',
                            'attribute' => 'home',
                            'contentOptions' => ['class' => 'text-content'],
                            'headerOptions' => ['class' => 'text-header']
            ],	
			[
                            'class' => 'yii\grid\DataColumn',
                            'attribute' => 'width',
                            'contentOptions' => ['class' => 'text-content'],
                            'headerOptions' => ['class' => 'text-header']
            ],	
			[
                            'class' => 'yii\grid\DataColumn',
                            'attribute' => 'lenth',
                            'contentOptions' => ['class' => 'text-content'],
                            'headerOptions' => ['class' => 'text-header']
           ],	
			[
                            'class' => 'yii\grid\DataColumn',
                            'attribute' => 'price',
                            'contentOptions' => ['class' => 'text-content'],
                            'headerOptions' => ['class' => 'text-header']
            ],	
			[
                            'class' => 'yii\grid\DataColumn',
                            'attribute' => 'direction',
                            'contentOptions' => ['class' => 'text-content'],
                            'headerOptions' => ['class' => 'text-header']
            ],	
			[
                            'class' => 'yii\grid\DataColumn',
                            'attribute' => 'alley',
                            'contentOptions' => ['class' => 'text-content'],
                            'headerOptions' => ['class' => 'text-header']
                        ],	
						[
                            'class' => 'yii\grid\DataColumn',
                            'attribute' => 'district_id',
                             'value' => function($data){
                                return isset($data->district)? $data->district->type . ' ' . $data->district->name:'';
                              },
                            'contentOptions' => ['class' => 'text-content'],
                            'headerOptions' => ['class' => 'text-header'],
                            'filter' => $districts,
                        ],	
[
                            'class' => 'yii\grid\DataColumn',
                            'attribute' => 'province_id',
                              'value' => function($data){
                                return isset($data->province)?$data->province->name:'';
                              },
                            'contentOptions' => ['class' => 'text-content'],
                            'headerOptions' => ['class' => 'text-header'],
                            'filter' => $provinces,
                        ],	
	
                        [
                            'class' => 'yii\grid\DataColumn',
                            'attribute' => 'created',
							'format' => 'html',
								 'value' => function($data){
										return date('d/m/Y',strtotime($data->created));
								 },
                            'contentOptions' => ['class' => 'text-content'],
                            'headerOptions' => ['class' => 'text-header']
                        ],	
						
						[	
					'class' => 'yii\grid\ActionColumn',
					//'contentOptions' => ['style' => 'width: 8.7%'],
					'header' => Html::a('Thêm', ['create','menu_level' => 'field'], ['class' => 'btn btn-primary btn-xs','style' => "width:85px" ]),
					'buttons'=>[
						'view'=>function ($url, $model) {
							
							return Html::tag('div',Html::a('<span class="glyphicon glyphicon-eye-open"></span> Xem', ['view', 'id'=> $model->id,'menu_level' => 'field'], ['class' => 'btn btn-primary btn-xs custom_button','style' => "width:85px"]));
						},
						'update'=>function ($url, $model) {
							
							 return Html::tag('div',Html::a('<span class="glyphicon glyphicon-edit"></span> Sửa', ['update', 'id'=> $model->id,'menu_level' => 'field'], ['class' => 'btn btn-warning btn-xs custom_button','style' => "width:85px"]));
						},
						'delete'=>function ($url, $model) {
							//$t = 'index.php?r=social/delete&id='. $model->id;
							 return Html::tag('div',Html::a('<span class="glyphicon glyphicon-trash"></span> Xóa', ['delete', 'id'=> $model->id,'menu_level' => 'field'], [
								'class' => 'btn btn-danger btn-xs custom_button',
								'style' => "width:85px",
								'data' => [
									'confirm' => 'Bạn có muốn xóa mục này?',
									'method' => 'post',
								],
								]));
							
						},
					],
				],
        ],
    ]); ?>
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
function btnDelete(id) {
  var r = confirm("Bạn muốn xóa bài viết này?");
  if (r == true) {
		window.location.href = "<?php echo yii::$app->urlManager->createUrl(["article/delete"]);?>&id=" + id;
} else {
  console.log("Bạn đã hủy!");
}
 
}
</script>
<script type="text/javascript">
    $(document).ready(function () {
		 var selection = [];
    $(options.grid + ' input:checkbox[name="selection[]"]:checked').each(function() {
        selection.push($(this).val());
    });
        $("input:checkbox").change(function () {
			var id= this.value;
			var status= this.checked;
			console.log(id);
			console.log(status);
			$.ajax({
                url: '<?php echo yii::$app->urlManager->createUrl(['article/checked']) ?>',
                type: 'POST',
                dataType: 'json',
                // contentType: "application/json; charset=utf-8",
                data: {id: id, status: status},
                success: function (data) {
					if (data.status === 1) {
                        $('#label' + data.id).removeClass("text-default").addClass("text-primary").html(data.text);
                    } else {
                        $('#label' + data.id).removeClass("text-primary").addClass("text-default").html(data.text);
                    }
                }
            });
        });
    });

</script>

