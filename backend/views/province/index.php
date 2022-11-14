<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Breadcrumbs;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProvinceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('province', 'Provinces');
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

            'province_id',
            'name',
            'type',
            'slug',
            'keyword',
            'lat',
            'lng',
            'description',
            [
                'label' => 'Hình ảnh 350x180',
                'attribute' => 'image',
                'format' => 'raw',   
                'value' => function ($data) {
                    return Html::img(Yii::$app->params['elandUrl'] .'/provinces/'. $data->image,
                        [
                            'onerror'=> "if (this.src != 'error.jpg') this.src = '" .  Yii::$app->params['elandUrl'] . "images/no-image200x200.png';",
                           
                            'style' => 'border-radius: 8px'
                            ]);
                },
                'contentOptions' => ['class' => 'text-content'],
                'headerOptions' => ['class' => 'text-header']
            ],

            [   
                    'class' => 'yii\grid\ActionColumn',
                    //'contentOptions' => ['style' => 'width: 8.7%'],
                    'header' => Html::a('Thêm', ['create','menu_level' => 'field'], ['class' => 'btn btn-primary btn-xs','style' => "width:85px" ]),
                    'buttons'=>[
                        'view'=>function ($url, $model) {
                            
                            return Html::tag('div',Html::a('<span class="glyphicon glyphicon-eye-open"></span> Xem', ['view', 'id'=> $model->province_id,'menu_level' => 'field'], ['class' => 'btn btn-primary btn-xs custom_button','style' => "width:85px"]));
                        },
                        'update'=>function ($url, $model) {
                            
                             return Html::tag('div',Html::a('<span class="glyphicon glyphicon-edit"></span> Sửa', ['update', 'id'=> $model->province_id,'menu_level' => 'field'], ['class' => 'btn btn-warning btn-xs custom_button','style' => "width:85px"]));
                        },
                        'delete'=>function ($url, $model) {
                            //$t = 'index.php?r=social/delete&id='. $model->id;
                             return Html::tag('div',Html::a('<span class="glyphicon glyphicon-trash"></span> Xóa', ['delete', 'id'=> $model->province_id,'menu_level' => 'field'], [
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