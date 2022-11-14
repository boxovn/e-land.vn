<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Breadcrumbs;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\NoteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
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
            'label' => 'Nguồn nhà',
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

				  [   		'attribute' => 'user.house.description',
				  			'format' => 'raw',
				    		'contentOptions' => ['class' => 'text-content'],
                            'headerOptions' => ['class' => 'text-header']
                   ],
                  /*  [
                    	'label' => 'Hình ảnh',
                 'attribute' => 'images',
				 'format' => 'raw',
				 'value' => function ($data) {
				 	if(isset($data->images) && count($data->images) > 0){
					return  Html::img(Yii::$app->params['url-page'] . 'channels/article/210x118/' . $data->images[0]->image, ['alt' => $data->images[0]->image,'style' => array('height'=>'80px', 'width'=>'auto')]);
					}else{
						return  Html::img(Yii::$app->params['url-page'] . 'images/no-image210x118.png', ['style' => array('height'=>'80px', 'width'=>'auto')]);
					}
					},
				
					
					
            ],
				  */
            	[
									'attribute' => 'exclusive',
									'class' => 'yii\grid\DataColumn',
									'format' => 'raw',
									'label' => 'Hợp đồng',
									'value' => function ($data) {
										$arr = [0 => '<span class="label label-primary">Độc quyền bán</span>', 1 =>'<span class="label label-success">Độc quyền hoa hồng</span>'];
									return $arr[$data->exclusive] ;
									},
									'filter' =>[0 => 'Độc quyền bán', 1 =>'Độc quyền hoa hồng'],
				],
				[
									'attribute' => 'contract_date',
									'class' => 'yii\grid\DataColumn',
									'format' => 'raw',
									'label' => 'Ngày ký',
									'value' => function ($data) {
										return date('d/m/Y',strtotime($data->contract_date));
									},
									'filter' =>[0 => 'Độc quyền bán', 1 =>'Độc quyền hoa hồng'],
				],
				[
									'attribute' => 'contract_end_date',
									'class' => 'yii\grid\DataColumn',
									'format' => 'raw',
									'label' => 'Ngày hết hợp đồng',
									'value' => function ($data) {
										
										return  strtotime($data->contract_end_date)?date('d/m/Y',strtotime($data->contract_end_date)) :'Không thời hạn';
									},
									'filter' =>[0 => 'Độc quyền bán', 1 =>'Độc quyền hoa hồng'],
				],
				 [
									'attribute' => 'status',
									'class' => 'yii\grid\DataColumn',
									'format' => 'raw',
									'value' => function ($data) {
										$arr = [0 => '<span class="label label-success">Chưa bán</span>', 1 => '<span class="label label-danger">	</span>'];
									return $arr[$data->status] ;
									},
									'filter' =>[0 => 'Chưa bán', 1 =>'Đã bán'],
				],
				 [
									'attribute' => 'permission',
									'class' => 'yii\grid\DataColumn',
									'format' => 'raw',
									'value' => function ($data) {
										$arr = [0 => '<span class="label label-default">Mình tôi</span>', 1  => '<span class="label label-danger">Tất cả mọi người</span>'];
									return $arr[$data->status] ;
									},
									'filter' =>[0 => 'Chưa bán', 1 =>'Tất cả mọi người'],
				],
			
				[	
					'class' => 'yii\grid\ActionColumn',
					 'template'=>'{survey}{update} {delete}',
					'contentOptions' => ['style' => 'width: 8.7%'],
					'header' => Html::a('Thêm', ['create','menu' => 'house'], ['class' => 'btn btn-primary btn-xs','style' => "width:85px" ]),
					'buttons'=>[
					'survey'=>function ($url, $model) {
						return Html::tag('div',Html::a('<span class="glyphicon glyphicon-eye-open"></span> Khảo sát', ['survey', 'id'=> $model->id,'menu' => 'house'], ['class' => 'btn btn-info btn-xs custom_button','style' => "width:85px"]));
					},	
				/*	'convert'=>function ($url, $model) {
						
						return Html::tag('div',Html::a('<span class="glyphicon glyphicon-file"></span> Đăng bài', ['convert', 'id'=> $model->id,'menu' => 'house'], ['class' => 'btn btn-success btn-xs custom_button','style' => "width:85px"]));
					},*/
					'view'=>function ($url, $model) {
						
						return Html::tag('div',Html::a('<span class="glyphicon glyphicon-eye-open"></span> Xem', ['view', 'id'=> $model->id,'menu' => 'house'], ['class' => 'btn btn-primary btn-xs custom_button','style' => "width:85px"]));
					},
					'update'=>function ($url, $model) {
						
						return Html::tag('div',Html::a('<span class="glyphicon glyphicon-edit"></span> Sửa', ['update', 'id'=> $model->id,'menu' => 'house'], ['class' => 'btn btn-warning btn-xs custom_button','style' => "width:85px"]));
					},
					'delete'=>function ($url, $model) {
						//$t = 'index.php?r=social/delete&id='. $model->id;
						return Html::tag('div',Html::a('<span class="glyphicon glyphicon-trash"></span> Xóa', ['delete', 'id'=> $model->id,'menu' => 'house'], [
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

