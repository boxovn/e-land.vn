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
				            
				            <div class="box-body table-responsive" style="padding-top: 30px;">
				        

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
				
				[
									'attribute' => 'employee_id',
									'class' => 'yii\grid\DataColumn',
										'value' => function ($data) {
											return $data->employee->name;
									},
									'filter' => $employees,

				],
				 [
									'attribute' => 'status',
									'class' => 'yii\grid\DataColumn',
									'format' => 'raw',
									'value' => function ($data) {
									return $data->status?'<span style="color:red">Đã chuyển</span>' : '<span style="color:blue">Chưa chuyển</span>';
									},
									'filter' => [1 => 'Đã chuyển', 0 => 'Chưa chuyển'],
				],
				'created',
				[	
					'class' => 'yii\grid\ActionColumn',
					'contentOptions' => ['style' => 'width: 8.7%'],
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

