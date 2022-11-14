<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Breadcrumbs;
/* @var $this yii\web\View */
/* @var $model common\models\HouseSurvey */

$this->title = 'Đầu khách: ' . $model->partner->name;

\yii\web\YiiAsset::register($this);
?>
<div class="content-wrapper">
 <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                   <?=$this->title;?>
                </h1>
                <?php 
                        // $this is the view object currently being used
echo Breadcrumbs::widget([
    'itemTemplate' => "<li><i>{link}</i></li>\n", // template for all links
    'links' => [
        [
            'label' => 'Nguồn nhà',
            'url' => ['house/index'],
        ],
        ['label' => 'Danh sách khảo sát', 'url' => ['house/survey', 'id' => $model->house_id,'menu' => 'house']],
        [
            'label' => 'Đầu khách' . $model->partner->name,
            'url' => ['house/survey-view', 'id' => $model->id],
            'template' => "<li><b>{link}</b></li>\n", // template for this link only],
        ],
    ],
]);
                ?>
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                    
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Xem</h3>
                                <div class="pull-right">
        <?= Html::a('<i class="glyphicon glyphicon-chevron-left"></i>Danh sách khảo sát', ['house/survey', 'id' =>  $model->house_id,'menu' => 'house'], ['class' => 'btn btn-primary btn-sm ']) ?>
      
    </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body table-responsive">
    

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           
           [
                 'attribute' =>  'partner.name',
                 'label'  => 'Đầu khách',
        ],
          'house.description:raw',
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
                'label' => 'Ngày khảo sát',
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
