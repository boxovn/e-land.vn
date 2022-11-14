<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Breadcrumbs;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\NoteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Khảo sát';
$this->params['breadcrumbs'][] = ['label' => 'Nguồn nhà', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    <?= Html::encode($this->title) ?>
                </h1>
                 <?php 

                        // $this is the view object currently being used
echo Breadcrumbs::widget([
    'itemTemplate' => "<li><i>{link}</i></li>\n", // template for all links
    'links' =>isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]);
      ?>
            </section>
			<!-- Main content -->
            <section class="content">
                <div class="row">
				    <div class="col-xs-12">
							<div class="box">
				            <div class="box-header with-border">
				              <h3 class="box-title">Nguồn nhà</h3>
				              <div class="box-tools pull-right">
				                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
				                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
				              </div>
				            </div>
            <div class="box-body">
            	<blockquote>
                    <p><?php echo $house->description;?></p>
				    <small>Đầu chủ <span class="label label-warning"><?php echo isset($house->user)?$house->user->name:'';?></span> <cite title="Source Title"><?php echo date('d/m/Y',strtotime($house->created));?></cite></small>
                  </blockquote>
             <div class="box collapsed-box">
            <div class="box-header with-border">
              <h3 class="box-title">Mô tả</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
            	<blockquote>
                    
				     <small><?php echo $house->content;?> <cite title="Source Title"><?php echo date('d/m/Y',strtotime($house->created));?></cite></small>
				  </blockquote>
            
            </div><!-- /.box-body -->
            
          </div><!-- /.box -->
            </div><!-- /.box-body -->
            
          </div><!-- /.box -->
         

				        <div class="box">
				            <div class="box-header">
				                <h3 class="box-title">Danh sách chuyên viên khảo sát
				                	</h3>
							</div>
				            <!-- /.box-header -->
				            
				            <div class="box-body table-responsive">

								<?= GridView::widget([
							        'dataProvider' => $dataProvider,
							        'filterModel' => $searchModel,
							        'columns' => [
				            			['class' => 'yii\grid\SerialColumn'],
				            			[
				            				'label' => 'Chuyên viên khao sát',
											'attribute' => 'user_name',
											'class' => 'yii\grid\DataColumn',
											'value' => function ($data) {
											return $data->user->name;
										},
									
										],
				  							'content:raw',
									   [
														'attribute' => 'status',
														'class' => 'yii\grid\DataColumn',
														'format' => 'raw',
														'label' => 'Trạng thái',
														'value' => function ($data) {
															$arr = [0 => '<span class="label label-default">Đã khảo sát</span>', 1 =>'<span class="label label-warning">Đang rao bán</span>', 2  => '<span class="label label-danger">Đã bán</span>'];
														return $arr[$data->status] ;
														},

														'filter' =>[0 => 'Đã khảo sát', 1 =>'Đang rao bán', 2  => 'Đã bán'],
									],
            	
									[ 
											'attribute' => 'created',
											'format' => 'date',
											'label' => 'Ngày khảo sát',
											'filter' => \yii\jui\DatePicker::widget([
													'language' => 'vi',
													 'dateFormat' => 'php:d/m/Y',
													 'options' => ['class' => 'form-control']
											]),
									],
				
				[	
					'class' => 'yii\grid\ActionColumn',
					 'template'=>'{view} {update} {delete}',
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
					'header' => Html::a('Thêm', ['house/survey-create','house_id' => Yii::$app->request->queryParams['id'],'menu' => 'house'], ['class' => 'btn btn-primary','style' => "width:100px"]),
					
					'buttons'=>[
					'view'=>function ($url, $model) {
						
						return Html::a('<span class="glyphicon glyphicon-eye-open"></span> Xem', ['house/survey-view', 'id'=> $model->id, 'menu' => 'house'], ['class' => 'btn btn-primary']);
					},
					
					'update'=>function ($url, $model) {
						
						return Html::a('<span class="glyphicon glyphicon-edit"></span> Sửa', ['house/survey-update', 'id'=> $model->id,'menu' => 'house']);
					},
					'delete'=>function ($url, $model) {
						//$t = 'index.php?r=social/delete&id='. $model->id;
						return Html::a('<span class="glyphicon glyphicon-trash"></span> Xóa', ['survey/house-delete', 'id'=> $model->id,'menu' => 'house'], [
							
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

