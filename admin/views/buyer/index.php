<?php
use backend\widgets\Alert;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use common\models\Buyer;
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
				        <div class="box box-danger">
				            <div class="box-header with-border">
				                <h3 class="box-title">Danh sách người mua</h3>
							</div>
				            <!-- /.box-header -->
				            
				            <div class="box-body" style="overflow: auto;">
				        
                    <?php
                    echo GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $buyerSearch,
						'layout' => "{summary}\n{pager}\n{items}\n{pager}",
						'showFooter' => true,
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
                                'attribute' => 'phone',
                                'class' => 'yii\grid\DataColumn',
                                'contentOptions' => ['style' => 'text-align:center;vertical-align: middle;'],
                               'headerOptions' => ['style' => 'width: 40%;text-align:center; '],
                            ],
							 [
                                'attribute' => 'address',
                                'class' => 'yii\grid\DataColumn',
                                'contentOptions' => ['style' => 'vertical-align: middle;'],
                                'headerOptions' => ['style' => 'width: 15%;text-align:center; '],
                            ],
							[
                                'attribute' => 'finance',
                                'class' => 'yii\grid\DataColumn',
                                'contentOptions' => ['style' => 'text-align:center;vertical-align: middle;'],
                               'headerOptions' => ['style' => 'width: 40%;text-align:center; '],
                            ],
							[
                                'attribute' => 'region',
                                'class' => 'yii\grid\DataColumn',
                                'contentOptions' => ['style' => 'text-align:center;vertical-align: middle;'],
                               'headerOptions' => ['style' => 'width: 40%;text-align:center; '],
                            ],
							[
                                'attribute' => 'area',
                                'class' => 'yii\grid\DataColumn',
                                'contentOptions' => ['style' => 'text-align:center;vertical-align: middle;'],
                               'headerOptions' => ['style' => 'width: 40%;text-align:center; '],
                            ],
							[
                                'attribute' => 'home',
                                'class' => 'yii\grid\DataColumn',
                                'contentOptions' => ['style' => 'text-align:center;vertical-align: middle;'],
                               'headerOptions' => ['style' => 'width: 40%;text-align:center; '],
                            ],
							[
                                'attribute' => 'direction',
                                'class' => 'yii\grid\DataColumn',
                                'contentOptions' => ['style' => 'text-align:center;vertical-align: middle;'],
                               'headerOptions' => ['style' => 'width: 40%;text-align:center; '],
                            ],
							[
                                'attribute' => 'alley',
                                'class' => 'yii\grid\DataColumn',
                                'contentOptions' => ['style' => 'text-align:center;vertical-align: middle;'],
                               'headerOptions' => ['style' => 'width: 40%;text-align:center; '],
                            ],
							[
                                'attribute' => 'ask_date',
                                'class' => 'yii\grid\DataColumn',
                                'contentOptions' => ['style' => 'text-align:center;vertical-align: middle;'],
                               'headerOptions' => ['style' => 'width: 40%;text-align:center; '],
                            ],
							[
                                'attribute' => 'purpose_of_purchase',
                                'class' => 'yii\grid\DataColumn',
                                'contentOptions' => ['style' => 'text-align:center;vertical-align: middle;'],
                               'headerOptions' => ['style' => 'width: 40%;text-align:center; '],
                            ],
							[
                                'attribute' => 'note',
                                'class' => 'yii\grid\DataColumn',
                                'contentOptions' => ['style' => 'text-align:center;vertical-align: middle;'],
                               'headerOptions' => ['style' => 'width: 40%;text-align:center; '],
                            ],
							[
                                'attribute' => 'status',
                                'class' => 'yii\grid\DataColumn',
                                'contentOptions' => ['style' => 'text-align:center;vertical-align: middle;'],
                               'headerOptions' => ['style' => 'width: 40%;text-align:center; '],
                            ],
							
							
                            [
                                'class' => 'yii\grid\DataColumn',
                                'format' => 'raw',
									'filter' => '<button class="btn btn-default btn-xs" style="width:85px"><i class="glyphicon glyphicon-search"></i><span class="action-text">Tìm kiếm<span class="action-text"></button>',
								'header' => '<a class="btn btn-primary btn-xs" style="width:85px" href="'.yii::$app->urlManager->createUrl(["buyer/edit"]).'"><i class="fa fa-plus-square"></i> Thêm</a>',
								'value' => function ($data) {
                                    return Html::a('<i class="fa fa-edit"></i> Sửa', Url::to(['buyer/edit', 'id' => $data->id]), ['class' => 'btn btn-xs btn-warning']) . '&nbsp' .
                                    Html::a('<i class="fa fa-remove"></i> Xóa', Url::to(['buyer/delete', 'id' => $data->id]), ['data-method' => 'post', 'class' => 'btn btn-xs btn-danger', 'data-placement' => 'top', 'data-original-title' => 'Delete']);
                           
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
        
   