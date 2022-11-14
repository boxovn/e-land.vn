<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\HouseSurveySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Danh sách thành viên khảo sát';
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

    <p>
        <?= Html::a('Thêm', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                    'attribute' => 'user_id',
                    'class' => 'yii\grid\DataColumn',
                    'value' => function ($data) {
                                            return $data->partner->name;
                                    },
                    'filter' => $employees,
                   
            ],
            [
                    'attribute' => 'house_id',
                    'class' => 'yii\grid\DataColumn',
                                        'value' => function ($data) {
                                            return $data->house->description;
                                    },
                    'filter' => $houses
            ],
            'content:raw',
            [
                'label' => 'Ngày khảo sát',
                'attribute' => 'created',
                 'format' => ['date']
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
