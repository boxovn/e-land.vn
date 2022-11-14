<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\HouseSurvey */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'House Surveys', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="content-wrapper">
 <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                   <?=$this->title;?>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-home"></i> Trang chủ</a></li>
                    <li class="active"> <?=$this->title;?></li>
                </ol>
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                    
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Xem</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body table-responsive">
    <p>
        <?= Html::a('Danh sách', ['index', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm']) ?>
        <?= Html::a('Sửa', ['update', 'id' => $model->id], ['class' => 'btn btn-warning btn-sm']) ?>
        <?= Html::a('Xóa', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger btn-sm',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'employee.name',
            'house.description',
            [
                 'attribute' => 'images',
                 'format' => 'raw',
                 'value' => function ($data) {
                          $texts = [];
                                foreach($data->images as $value){
                                      $texts[]=  Html::img(Yii::$app->params['url-page'] . 'channels/article/210x118/' . $value->image, ['alt' => $value->image,'style' => array('height'=>'100px', 'width'=>'auto')]);
                                }
                        return implode("\n", $texts);
                    },
                    
                    
            ],
            'content:raw',
            [
                'attribute' => 'created',
                'format' => ['date', 'php:d/m/Y  H:i']
            ]
        ],
    ]) ?>
    </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
