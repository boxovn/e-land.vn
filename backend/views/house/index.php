<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Breadcrumbs;
$this->title ='Nguồn nhà';
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
    'links' => [
        [
            'label' => $this->title,
            'url' => ['house/index'],
        ],
    ],
]);
?>
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
					        'columns' => [
					            ['class' => 'yii\grid\SerialColumn'],
									   [   		'attribute' => 'description',
									  			'format' => 'raw',
									    		'contentOptions' => ['class' => 'text-content','style' => 'width:30%'],
					                            'headerOptions' => ['class' => 'text-header']
					                   ],
					                   [
					                   	 'class' => 'yii\grid\DataColumn',
                    						'attribute' => 'user_name',
                    						'label' => 'Đầu chủ',
                   
                                        'value' => function ($data) {
                                            return isset($data->user)?$data->user->name:'';
                                    },
                  
                   
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
                            'attribute' => 'street',
                            'label' => 'Đường',
                            'contentOptions' => ['class' => 'text-content'],
                            'headerOptions' => ['class' => 'text-header'],
                            
                        ],	
                        [
									'attribute' => 'status',
									'class' => 'yii\grid\DataColumn',
									'format' => 'raw',
									'value' => function ($data) {
										$arr = [0 => '<span class="label label-default">Đang rao bán</span>', 1 =>'<span class="label label-warning">Đã bán</span>'];
									return $arr[$data->status] ;
									},
									'filter' =>[0 => 'Đang rao bán', 1 =>'Đã bán'],
									 'contentOptions' => ['class' => 'text-content'],
                            		'headerOptions' => ['class' => 'text-header'],
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
			                  	<li>{survey}</li>
			                    <li>{convert}</li>
			                  	<li class="divider"></li>
			                    <li>{update}</li>
			                    <li>{delete}</li>
			                  </ul>
                		</div>',
					'header' => Html::a('Thêm', ['create','menu' => 'house'], ['class' => 'btn btn-primary','style' => "width:100px" ]),
					'buttons'=>[
						'survey'=>function ($url, $model) {
						return Html::a('<span class="glyphicon glyphicon-eye-open"></span> Khảo sát', ['survey', 'id'=> $model->id,'menu' => 'house']);
					},	
					'convert'=>function ($url, $model) {
						
						return Html::a('<span class="glyphicon glyphicon-eye-open"></span> Viết bài', ['convert', 'id'=> $model->id,'menu' => 'house']);
					},
					'view'=>function ($url, $model) {
						
						return Html::a('<span class="glyphicon glyphicon-eye-open"></span> Xem', ['view', 'id'=> $model->id,'menu' => 'house'], ['class' => 'btn btn-primary']);
					},
					'update'=>function ($url, $model) {
						
						return Html::a('<span class="glyphicon glyphicon-edit"></span> Sửa', ['update', 'id'=> $model->id,'menu' => 'house']);
					},
					'delete'=>function ($url, $model) {
						//$t = 'index.php?r=social/delete&id='. $model->id;
						return Html::a('<span class="glyphicon glyphicon-trash"></span> Xóa', ['delete', 'id'=> $model->id,'menu' => 'house'], [
							
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

