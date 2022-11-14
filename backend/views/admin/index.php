<?php
use yii\grid\GridView;
use backend\widgets\Alert;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Admin;

$this->title = 'Danh sách user';
?>

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
				            <?php
                    		echo GridView::widget([
		                        'dataProvider' => $dataProvider,
		                        'filterModel' => $searchModel,
		                        'tableOptions' => ['class' => 'table table-bordered'],
		                    	'summaryOptions' => ['class' => 'dataTables_info'],	
				                'summary' => 'Dòng <b>{begin} - {end}</b> của <b>{totalCount}</b> <div style="float: right;">Trang <b>{page}/{pageCount}</b></div>',
				                'columns' => [
		                            [
		                                'attribute' => 'id',
		                                'format' => 'text',
		                                'label' => '#',
		                                'contentOptions' => ['style' => 'width: 30px;text-align:center;vertical-align: middle;'],
		                                'headerOptions' => ['style'=>'width: 30px;text-align:center'],
		                            ],
		                            [
		                                'class' => 'yii\grid\DataColumn',
		                                'attribute' => 'username',
		                                'value' => function ($data) {
		                                    return $data->username;
		                                },
		                                'format' => 'text',
		                                'contentOptions' => ['style' => 'width: 20%;vertical-align: middle;']
		                            ],
		                            [
		                                'class' => 'yii\grid\DataColumn',
		                                'attribute' => 'email',
		                                'format' => 'html',
		                               	'contentOptions' => ['style' => 'width: 25%;vertical-align: middle;']
		                            ],
		                            [
		                                'class' => 'yii\grid\DataColumn',
		                                'attribute' => 'created',
		                                'label' => 'Ngày tạo',
		                                'format' => 'html',
		                                'value' => function ($data) {
		                                    return date('Y-m-d',strtotime($data->created));
		                                },
		                                'contentOptions' => ['style' => 'width: 10%;vertical-align: middle;']
		                            ],
									[
		                                'class' => 'yii\grid\DataColumn',
		                                //'attribute' => 'is_admin',
		                                'label' => 'Loại',
		                                'format' => 'text',
		                                'value' => function ($data) {
		                                    return $data->is_admin == 1 ? 'Admin' : '';
		                                },
		                                'contentOptions' => ['style' => 'width: 5%;vertical-align: middle;']
		                            ],
									[
		                                'class' => 'yii\grid\DataColumn',
		                                'label' => 'Chức năng',
		                                'format' => 'html',
		                                'value' => function ($data) {
		                                    return "<a class='btn btn-sm btn-info' href='" . yii::$app->urlManager->createUrl(['admin/view', 'id' => $data->id]) . "'><i class='fa fa-eye'></i> Xem </a>&nbsp;" ."<a class='btn btn-sm btn-success' href='" . yii::$app->urlManager->createUrl(['admin/edit', 'id' => $data->id]) . "'><i class='fa fa-edit'></i> Sửa</a>" ."&nbsp;<a class='btn btn-sm btn-danger class_delete' href='" . yii::$app->urlManager->createUrl(['admin/delete', 'id' => $data->id]) . "'><i class='fa fa-remove'></i> Xóa</a>" ."&nbsp;<a class='btn btn-sm btn-warning' href='" . yii::$app->urlManager->createUrl(['admin/change', 'id' => $data->id]) . "'><i class='fa fa-user'></i> Đổi mật khẩu</a>";
		                                },
		                                'contentOptions' => ['style' => 'width: 200px;vertical-align: middle;']
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
        
        <script src="<?php echo yii::$app->urlManager->baseUrl?>/theme/yii2/yii.js"></script>
        <script src="<?php echo yii::$app->urlManager->baseUrl?>/theme/yii2/yii.gridView.js"></script>
        <script type="text/javascript">
		    $(document).ready(function() {
		    	var uriParam = "<?php echo $uriParam;?>";
		    	$('#w1').yiiGridView({
		            "filterUrl": "<?php echo yii::$app->urlManager->baseUrl?>/index.php?r=admin%2Findex"+uriParam,
		            "filterSelector": "#w1-filters input"
		        });

		    });
		</script>
        