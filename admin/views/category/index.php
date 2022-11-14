<?php
use backend\widgets\Alert;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use common\models\Category;
?>
<!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Danh mục
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
				    	<?php echo Alert::widget(); ?> 
				        <div class="box">
				            <div class="box-header">
				                <h3 class="box-title">Danh sách</h3>
							</div>
				            <!-- /.box-header -->
				            
				            <div class="box-body table-responsive" style="padding-top: 30px;">
				        
                    <?php
                    echo GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $categorySearch,
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
                               'headerOptions' => ['style' => 'width: 25%;text-align:center; '],
                            ],
                            [
                                'attribute' => 'slug',
                                'class' => 'yii\grid\DataColumn',
                                'contentOptions' => ['style' => 'vertical-align: middle;'],
                                'headerOptions' => ['style' => 'width: 15%;text-align:center; '],
                            ],
							[
                                'attribute' => 'sort',
                                'class' => 'yii\grid\DataColumn',
                                'contentOptions' => ['style' => 'text-align:center;vertical-align: middle;'],
                               'headerOptions' => ['style' => 'width: 40%;text-align:center;'],
                            ],
							 [
                                'attribute' => 'status',
                                'class' => 'yii\grid\DataColumn',
								'format' => 'raw',
								 'value' => function ($model) {                      
                                    return '<input '. ($model->status ? 'checked="checked"': '') . ' id="' . $model->id .'" value="'. $model->status .'" type="checkbox" name="selection[]"/><lablel '. ($model->status ? 'class="text-primary"': 'class="text-default"') . ' id="label'. $model->id .'">'. Category::getStatus()[$model->status] . '</label>';
                            },
                                'contentOptions' => ['style' => 'text-align:center;vertical-align: middle;'],
                               'headerOptions' => ['style' => 'width: 40%;text-align:center;'],
                            ],
                            [
                                'class' => 'yii\grid\DataColumn',
                                'format' => 'raw',
								'filter' => '<button class="btn btn-default btn-sm" style="width:85px"><i class="glyphicon glyphicon-search"></i><span class="action-text">Filter<span class="action-text"></button>',
								'footer' => '<a class="btn btn-primary btn-sm" style="width:85px" href="'.yii::$app->urlManager->createUrl(["category/add"]).'"><i class="fa fa-plus-square"></i> Thêm</a>',
								'header' => '<a class="btn btn-primary btn-sm" style="width:85px" href="'.yii::$app->urlManager->createUrl(["category/add"]).'"><i class="fa fa-plus-square"></i> Thêm</a>',
                               
                                'value' => function ($data) {
                                    return Html::a('<i class="fa fa-edit"></i> Sửa', Url::to(['category/add', 'id' => $data->id]), ['class' => 'btn btn-sm btn-warning']) . '&nbsp' .
                                    Html::a('<i class="fa fa-remove"></i> Xóa', Url::to(['category/delete', 'id' => $data->id]), ['data-method' => 'post', 'class' => 'btn btn-sm btn-danger', 'data-placement' => 'top', 'data-original-title' => 'Delete']);
                           
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
        
   
<script type="text/javascript">
    $(document).ready(function () {
        $("input:checkbox").change(function () {
			
            var isChecked = $(this).is(":checked") ? 1 : 0;
            var id = $(this).attr("id");
			console.log(id, isChecked);
            $.ajax({
                url: '<?php echo yii::$app->urlManager->createUrl(['category/checked']) ?>',
                type: 'POST',
                dataType: 'json',
                // contentType: "application/json; charset=utf-8",
                data: {id: id, status: isChecked},
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
