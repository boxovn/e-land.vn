<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
$this->title = 'Tin rao';
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
                        <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                    		'layout' => "{summary}\n{pager}\n{items}\n{pager}",
											'showFooter' => true,
											 'rowOptions' => function ($model, $key, $index, $grid) {
												return ['id' => $model->id];
											},
											'pager' => [
														'firstPageLabel' => 'First',
														'lastPageLabel' => 'Last',
													],
                                            'columns' => [
                                                ['class' => 'yii\grid\SerialColumn'],
                                                [
                                                    'attribute' => 'image',
                                                    'format' => 'html',    
                                                    'value' => function ($data) {
                                                         return "<img onerror='if (this.src != 'error.jpg') this.src =" . Url::to('@web/images/no-image210x118.png', true) . "; width='80px' height='40px' class='image'  src=" . Yii::$app->params['url-channels'] .'/article/210x118/' . $data->image . " />";
                                                    }
                                                    
                                                    ],
                                                    'title',
                                    			[
													'attribute' => 'status',
													'class' => 'yii\grid\DataColumn',
													'label' => 'Trạng thái',
													'format' => 'raw',
													'value' => function($data){
														return $data->status?'<span class="label label-warning">Đang rao bán</span>': '<span class="label label-default">Ẩn tin</span>';
													},
													'contentOptions' => ['class' => 'text-content'],
                           							 'headerOptions' => ['class' => 'text-header'],
                           							 'filter' => [1 => 'Đang rao bán', 0 => 'Ẩn tin']
												],
												[
													'attribute' => 'type_id',
													'class' => 'yii\grid\DataColumn',
													'label' => 'Tin rao',
													'value' => function($data){
														return isset($data->articleType)?$data->articleType->title:''; 
													},
													'contentOptions' => ['class' => 'text-content'],
                           							 'headerOptions' => ['class' => 'text-header']
												],
                                                [
													'attribute' => 'updated',
													'class' => 'yii\grid\DataColumn',
													'label' => 'Ngày đăng',
													'value' => function($data){
														return date('d/m/Y',strtotime($data->updated)); 
													},
													'contentOptions' => ['class' => 'text-content'],
                           							 'headerOptions' => ['class' => 'text-header']
												],
												[
													'attribute' => 'created',
													'class' => 'yii\grid\DataColumn',
													'label' => 'Ngày đăng',
													'value' => function($data){
														return date('d/m/Y',strtotime($data->created)); 
													},
													'contentOptions' => ['class' => 'text-content'],
                           							 'headerOptions' => ['class' => 'text-header']
												],
												
			

            
            [	
					'class' => 'yii\grid\ActionColumn',
					'template' =>'
						<div class="btn-group">
                  			{view}
			                  <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
			                    <span class="caret"></span>
			                    <span class="sr-only">Toggle Dropdown</span>
			                  </button>
			                  <ul class="dropdown-menu" role="menu">
								  <li>{house}</li>
								  <li>{convert}</li>
			                  	<li>{update}</li>
			                    <li>{delete}</li>
			                  </ul>
                		</div>',
					//'contentOptions' => ['style' => 'width: 8.7%'],
					'filterOptions' => ['style' => 'display: none;'],
                    'header' => Html::a('Thêm', ['create','menu' => 'house'], ['class' => 'btn btn-primary btn-sm','style' => "width:100px" ]),
					'buttons'=>[
					'house'=>function ($url, $model) {
						return Html::a('<span class="glyphicon glyphicon-eye-open"></span>Nguồn nhà', ['house/view', 'id'=> isset($model->house)?$model->house->id:'','menu' => 'house']);
					},	
					'view'=>function ($url, $model) {
						
						return Html::a('<span class="glyphicon glyphicon-eye-open"></span> Xem', ['view', 'id'=> $model->id,'menu' => 'house'], ['class' => 'btn btn-primary btn-sm']);
					},
					'update'=>function ($url, $model) {
						
						return  Html::a('<span class="glyphicon glyphicon-edit"></span> Sửa', ['update', 'id'=> $model->id,'menu' => 'house']);
					},
					'delete'=>function ($url, $model) {
						//$t = 'index.php?r=social/delete&id='. $model->id;
						return  Html::a('<span class="glyphicon glyphicon-trash"></span> Xóa', ['delete', 'id'=> $model->id,'menu' => 'house'], [
						
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
        window.location.href = "<?php echo yii::$app->urlManager->createUrl(["
        article / delete "]);?>&id=" + id;
    } else {
        console.log("Bạn đã hủy!");
    }

}
</script>