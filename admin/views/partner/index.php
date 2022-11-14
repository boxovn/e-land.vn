<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Breadcrumbs;
use backend\widgets\Alert;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\PartnerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Đối tác';
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
            'label' => 'Đối tác',
            'url' => ['partner/index'],
        ],
        
    ],
]);
                ?>
    </section>
    <!-- Main content -->

    <!-- Main content -->
    <section class="content">
        <?php echo Alert::widget() ?>
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Danh sách</h3>
                    </div>
                    <!-- /.box-header -->

                    <div class="box-body table-responsive">

                        <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

                        <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
					[
                        'label' => 'Người mời',
                        'attribute' => 'user_id',
                        'value'=> function($data){
                            return isset($data->user)?$data->user->name:'';
                        }
                    ],
					[
                      
                        'attribute' => 'status',
						'value'=> function($data){
                            return $data->status?'Xác nhận':'Chưa xác nhận';
                        }
                       
                    ],
					[
                      'label' => 'Mã xác thực',
                        'attribute' => 'comfirm_token',
                       
                    ],
                    [
                        'label' => 'Đối tác',
                        'attribute' => 'partner_name',
                        'value'=> function($data){
                            return isset($data->partner)?$data->partner->name:'';
                        }
                    ],
                    [
                        'label' => 'Điện thoại',
                        'attribute' => 'partner_phone',
                        'value'=> function($data){
                            return isset($data->partner)?$data->partner->phone:'';
                        }
                    ],
                    [
                        'label' => 'Email',
                        'attribute' => 'partner_email',
                        'value'=> function($data){
                            return isset($data->partner)?$data->partner->email:'';
                        }
                    ],
                    'created:date',
                [    
                            'class' => 'yii\grid\ActionColumn',
                            'template'=>'{house}',//' {view} {update} {delete}',
                            //'contentOptions' => ['style' => 'width: 8.7%'],
                            'header' => Html::a('Mời tham gia', ['add','menu' => 'house'], ['class' => 'btn btn-primary btn-sm','style' => "width:100px" ]),
                            'buttons'=>[
                            'house'=>function ($url, $data) {
                                return Html::tag('div',Html::a('<span class="glyphicon glyphicon-eye-open"></span> Nguồn nhà', ['house', 'partner_id'=> isset($data->partner)?$data->partner->id:0,'menu' => 'partner'], ['class' => 'btn btn-info btn-sm custom_button','style' => "width:100px"]));
                            },  
                ],
                ],
                ],
    ]); ?>
    </section>
</div>
<!-- /.box-body -->