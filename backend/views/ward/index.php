<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Thành viên';
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

                                                                                                                                                                            <?= GridView::widget([
                                                                                                                                                                                'dataProvider' => $dataProvider,
                                                                                                                                                                                'filterModel' => $searchModel,
                                                                                                                                                                                'columns' => [
                                                                                                                                                                                    ['class' => 'yii\grid\SerialColumn'],

                                                                                                                                                                                    'ward_id',
                                                                                                                                                                                    'name',
                                                                                                                                                                                    'type',
                                                                                                                                                                                    'slug',
                                                                                                                                                                                    'location',
                                                                                                                                                                                    //'district_id',

                                                                                                                                                                                    [   
                                                                                                                                                                                        'class' => 'yii\grid\ActionColumn',
                                                                                                                                                                                        //'contentOptions' => ['style' => 'width: 8.7%'],
                                                                                                                                                                                        'header' => Html::a('Thêm', ['create','menu_level' => 'field'], ['class' => 'btn btn-primary btn-xs','style' => "width:85px" ]),
                                                                                                                                                                                        'buttons'=>[
                                                                                                                                                                                            'view'=>function ($url, $model) {
                                                                                                                                                                                                
                                                                                                                                                                                                return Html::tag('div',Html::a('<span class="glyphicon glyphicon-eye-open"></span> Xem', ['view', 'id'=> $model->ward_id,'menu_level' => 'field'], ['class' => 'btn btn-primary btn-xs custom_button','style' => "width:85px"]));
                                                                                                                                                                                            },
                                                                                                                                                                                            'update'=>function ($url, $model) {
                                                                                                                                                                                                
                                                                                                                                                                                                 return Html::tag('div',Html::a('<span class="glyphicon glyphicon-edit"></span> Sửa', ['update', 'id'=> $model->ward_id,'menu_level' => 'field'], ['class' => 'btn btn-warning btn-xs custom_button','style' => "width:85px"]));
                                                                                                                                                                                            },
                                                                                                                                                                                            'delete'=>function ($url, $model) {
                                                                                                                                                                                                //$t = 'index.php?r=social/delete&id='. $model->id;
                                                                                                                                                                                                 return Html::tag('div',Html::a('<span class="glyphicon glyphicon-trash"></span> Xóa', ['delete', 'id'=> $model->ward_id,'menu_level' => 'field'], [
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
