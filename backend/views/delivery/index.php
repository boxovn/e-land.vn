<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Breadcrumbs;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\DeliverySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Giao hàng';
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
                <div class="block">
                    <div class="well text-center">
                        <div class="action-toolbar btn-toolbar">
                            <div class="btn-group">
                                <?= Html::a('Tạo sản phẩm <i class="fa fa-plus"></i>', ['create'], ['class' => 'btn btn-default']) ?>

                            </div>

                        </div>
                    </div>

                </div>
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

            'id',
            'name',
            'price',
            'status',
           [
									'attribute' => 'updated',
									'class' => 'yii\grid\DataColumn',
									'format' => 'raw',
									'value' => function ($data) {
									        return date('d/m/Y',$data->updated);
									},
									
                ],
                [
									'attribute' => 'created',
									'class' => 'yii\grid\DataColumn',
									'format' => 'raw',
									'value' => function ($data) {
									        return date('d/m/Y',$data->created);
									},
									
				],

            ['class' => 'yii\grid\ActionColumn'],
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