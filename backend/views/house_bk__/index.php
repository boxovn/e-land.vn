<?php
use yii\helpers\Html;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\NoteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Ghi chú';
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
				            
				            <div class="box-body table-responsive">
				        

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
				  	[
				  			'class' => 'yii\grid\DataColumn',
				  			'attribute' => 'description',
				  			'headerOptions' => ['class' => 'text-header'],
				  			'contentOptions' => ['class' => 'text-content'],
				  	],
				   [
									'attribute' => 'status',
									'class' => 'yii\grid\DataColumn',
									'format' => 'raw',
									'value' => function ($data) {
										$arr = [0 => '<span class="label label-default">Chưa bán</span>', 1 =>'<span class="label label-warning">Đang rao bán</span>', 2  => '<span class="label label-danger">Đã bán</span>'];
									return $arr[$data->status] ;
									},
									'filter' =>[0 => 'Chưa bán', 1 =>'Đang rao bán', 2  => 'Đã bán'],
				],
            	[
									'attribute' => 'employee_id',
									'class' => 'yii\grid\DataColumn',
										'value' => function ($data) {
											return $data->employee->name;
									},
									'filter' => $employees,

				],
				  
				
				'created:date',
				
				[	
					'class' => 'yii\grid\ActionColumn',
					'contentOptions' => ['style' => 'width: 8.7%'],
					'template' =>'
						<div class="btn-group">
                  			{view}
			                  <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
			                    <span class="caret"></span>
			                    <span class="sr-only">Toggle Dropdown</span>
			                  </button>
			                  <ul class="dropdown-menu" role="menu">
			                    <li>{update}</li>
			                    <li>{delete}</li>
			                  </ul>
                		</div>',
					'header' => Html::a('Thêm', ['create','menu_level' => 'field'], ['class' => 'btn btn-primary','style' => "width:120px" ]),
					'buttons'=>[
						
					'view'=>function ($url, $model) {
						
						return Html::a('<span class="glyphicon glyphicon-eye-open"></span> Xem', ['view', 'id'=> $model->id,'menu_level' => 'field'], ['class' => 'btn btn-primary']);
					},
					'update'=>function ($url, $model) {
						
						return Html::a('<span class="glyphicon glyphicon-edit"></span> Sửa', ['update', 'id'=> $model->id,'menu_level' => 'field']);
					},
					'delete'=>function ($url, $model) {
						//$t = 'index.php?r=social/delete&id='. $model->id;
						return Html::a('<span class="glyphicon glyphicon-trash"></span> Xóa', ['delete', 'id'=> $model->id,'menu_level' => 'field'], [
							
							'data' => [
								'confirm' => 'Bạn có muốn xóa mục này?',
								'method' => 'post',
							],
							]);
						
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
