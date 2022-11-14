<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Breadcrumbs;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sản phẩm';
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
                         <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                         <?= GridView::widget([
                                'dataProvider' => $dataProvider,
                                'filterModel' => $searchModel,
                                'columns' => [
                                    [
                                        'class' => 'yii\grid\SerialColumn',
                                        'contentOptions' => ['class' => 'text-content','style' => 'width: 5%; text-align:center'],
                                        'headerOptions' => ['class' => 'text-header','style' => 'width: 5%; text-align:center']
                                    ],
                                     [
                                        'attribute' => 'code',
                                        'format' => 'raw',   
                                        'value' => function ($data) {
                                            return $data->code .'<br/>'. Html::img(Yii::$app->params['url-products'] .'images/thumb_'. $data->image,
                                                [
                                                    'onerror'=> "if (this.src != 'error.jpg') this.src = '" .  Yii::$app->params['elandUrl'] . "images/no-no-product.png';",
                                                    'width' => '50px',
                                                    'height' => '50px']);
                                        },
                                        'contentOptions' => ['class' => 'text-content','style' => 'width: 5%; text-align:center'],
                                        'headerOptions' => ['class' => 'text-header']
                                    ],
                                    [
                                    'attribute' => 'name',
                                    'format' => 'raw',   
                                    'contentOptions' => ['class' => 'text-content'],
                                    'headerOptions' => ['class' => 'text-header']
                                    ],
                                     [
                                        'attribute' => 'price',
                                        'format' => 'raw',   
                                        'value' => function ($data) {
                                            return  '<p><del>' . number_format($data->price, 0, '', ',') . 'đ' .  '<del></p>' .
                                                        '<p><span class="label label-danger">' . $data->discount . '%' . '</span></p>' .
                                                        '<p><strong>' . number_format(($data->price + ($data->price*($data->discount/100))), 0, '', ',') . 'đ </strong></p>';
                                         },
                                        'contentOptions' => ['class' => 'text-content'],
                                        'headerOptions' => ['class' => 'text-header']
                                    ],
                                    [
                                        'attribute' => 'created',
                                        'format' => 'raw',   
                                        'value' => function ($data) {
                                            return date('H:i d/m/Y', strtotime($data->created));
                                         },
                                        'contentOptions' => ['class' => 'text-content'],
                                        'headerOptions' => ['class' => 'text-header']
                                    ],
                                    [
                                        'attribute' => 'updated',
                                        'format' => 'raw',   
                                        'value' => function ($data) {
                                            return date('H:i d/m/Y', strtotime($data->updated));
                                         },
                                        'contentOptions' => ['class' => 'text-content'],
                                        'headerOptions' => ['class' => 'text-header']
                                    ],
                                    [	
                                        'class' => 'yii\grid\ActionColumn',
                                        'contentOptions' => ['style' => 'width: 8.7%'],
                                        'template' =>'
                                            <div class="btn-group">
                                                  {view}
                                                  <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                                                    <span class="caret"></span>
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                  </button>
                                                  <ul class="dropdown-menu" role="menu">
                                                    
                                                    <li>{update}</li>
                                                    <li>{delete}</li>
                                                  </ul>
                                            </div>',
                                        'header' => Html::a('Thêm', ['create','menu' => 'house'], ['class' => 'btn btn-primary','style' => "width:100px" ]),
                                        'buttons'=>[
                                          
                                        'view'=>function ($url, $model) {
                                            
                                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span> Xem', ['view', 'id'=> $model->id,'menu' => 'house'], ['class' => 'btn btn-primary']);
                                        },
                                        'update'=>function ($url, $model) {
                                            
                                            return Html::a('<span class="glyphicon glyphicon-edit"></span> Sửa', ['update', 'id'=> $model->id,'menu' => 'house']);
                                        },
                                        'delete'=>function ($url, $model) {
                                            //$t = 'index.php?r=social/delete&id='. $model->id;
                                            return Html::a('<span class="glyphicon glyphicon-trash"></span> Xóa', ['delete', 'id'=> $model->id,'menu' => 'house'], [
                                                
                                                'data' => [
                                                    'confirm' => 'Bạn có muốn xóa mục này?',
                                                    'method' => 'post',
                                                ],
                                                ]);
                                            
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