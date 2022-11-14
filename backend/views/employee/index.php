<?php
use yii\helpers\Html;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\EmployeeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Đầu chủ';
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
                    <li class="active">Danh sách</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
				    <div class="col-xs-12">
				    	<div class="box">
				            <div class="box-header">
				                <h3 class="box-title">Danh sách</h3>
				
				                <div class="box-tools" style="top: 24px;">
				                    <a href="<?php echo yii::$app->urlManager->baseUrl?>/index.php?r=admin%2Fadd" 
				                    	class="btn btn-block btn-default btn-sm"><i class="fa fa-fw fa-plus"></i> Tạo mới</a>
				               	</div>
				               	<br>
				            </div>
				            <!-- /.box-header -->
				            
				            <div class="box-body table-responsive" style="padding-top: 30px;">

    <p>
        <?= Html::a('Nhân viên', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
	            'name',
	            'email:email',
	            'phone',
	            'address',
	       		[	
				'class' => 'yii\grid\ActionColumn',
				'contentOptions' => ['style' => 'width: 8.7%'],
				'header' => Html::a('Thêm', ['create','menu_level' => 'field'], ['class' => 'btn btn-primary btn-xs','style' => "width:85px" ]),
				'buttons'=>[
					'view'=>function ($url, $model) {
						
						return Html::a('<span class="glyphicon glyphicon-eye-open"></span> Xem', ['view', 'id'=> $model->id,'menu_level' => 'field'], ['class' => 'btn btn-primary btn-xs custom_button','style' => "width:85px"]);
					},
					'update'=>function ($url, $model) {
						
						return Html::a('<span class="glyphicon glyphicon-edit"></span> Sửa', ['update', 'id'=> $model->id,'menu_level' => 'field'], ['class' => 'btn btn-warning btn-xs custom_button','style' => "width:85px"]);
					},
					'delete'=>function ($url, $model) {
						//$t = 'index.php?r=social/delete&id='. $model->id;
						return Html::a('<span class="glyphicon glyphicon-trash"></span> Xóa', ['delete', 'id'=> $model->id,'menu_level' => 'field'], [
							'class' => 'btn btn-danger btn-xs custom_button',
							'style' => "width:85px",
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
        
