<?php

use backend\widgets\Alert;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use common\models\Meta;

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
                        'filterModel' => $metaSearch,
						'layout' => "{summary}\n{pager}\n{items}\n{pager}",
						'showFooter' => true,
						'pager' => [
									'firstPageLabel' => 'First',
									'lastPageLabel' => 'Last',
								],
                        'columns' => [
                            [
                                'attribute' => 'meta_id',
                                'class' => 'yii\grid\DataColumn',
                                'contentOptions' => ['style' => 'text-align:center;vertical-align: middle;'],
                                'headerOptions' => ['style' => 'width: 8%;text-align:center; text-transform: uppercase;'],
                            ],
                             [
                                'attribute' => 'title',
                                'class' => 'yii\grid\DataColumn',
                                'contentOptions' => ['style' => 'text-align:center;vertical-align: middle;'],
                               'headerOptions' => ['style' => 'width: 25%;text-align:center; text-transform: uppercase;'],
                            ],
                            [
                                'attribute' => 'page',
                                'class' => 'yii\grid\DataColumn',
                                'contentOptions' => ['style' => 'vertical-align: middle;'],
                                'headerOptions' => ['style' => 'width: 15%;text-align:center; text-transform: uppercase;'],
                            ],
                            [
                                'attribute' => 'content',
                                'class' => 'yii\grid\DataColumn',
                                'contentOptions' => ['style' => 'text-align:center;vertical-align: middle;'],
                               'headerOptions' => ['style' => 'width: 40%;text-align:center; text-transform: uppercase;'],
                            ],
                            [
                                'class' => 'yii\grid\DataColumn',
                                'format' => 'raw',
									'filter' => '<button class="btn btn-default btn-sm" style="width:85px"><i class="glyphicon glyphicon-search"></i><span class="action-text">Filter<span class="action-text"></button>',
								'footer' => '<a class="btn btn-primary btn-sm" style="width:85px" href="'.yii::$app->urlManager->createUrl(["meta/add"]).'"><i class="fa fa-plus-square"></i> Add</a>',
								'header' => '<a class="btn btn-primary btn-sm" style="width:85px" href="'.yii::$app->urlManager->createUrl(["meta/add"]).'"><i class="fa fa-plus-square"></i> Add</a>',
                               
                                'value' => function ($data) {
                                    return Html::a('<i class="fa fa-edit"></i> Sửa', Url::to(['meta/add', 'id' => $data->meta_id]), ['class' => 'btn btn-sm btn-warning']) . '&nbsp' .
                                    Html::a('<i class="fa fa-remove"></i> Xóa', Url::to(['meta/delete', 'id' => $data->meta_id]), ['data-method' => 'post', 'class' => 'btn btn-sm btn-danger', 'data-placement' => 'top', 'data-original-title' => 'Delete']);
                           
                        },
                                'contentOptions' => ['style' => 'text-align:center;vertical-align: middle;'],
                               'headerOptions' => ['style' => 'width: 12%;text-align:center; text-transform: uppercase;'],
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
        
   