<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CustomerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('customer', 'Customers');
$this->params['breadcrumbs'][] = $this->title;
?>
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
                        <h3 class="box-title">Danh mục</h3>
                    </div>
                    <!-- /.box-header -->

                    <div class="box-body table-responsive" style="padding-top: 30px;">
                        <div class="customer-index">

                            <h1><?= Html::encode($this->title) ?></h1>

                            <p>
                                <?= Html::a(Yii::t('customer', 'Tạo khách hàng'), ['create'], ['class' => 'btn btn-success']) ?>
                            </p>

                            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                            <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'email:email',
            'address',
            'created',
            'client_id',

           [	
                'class' => 'yii\grid\ActionColumn',
                	 'template'=>'{customer}{view}{update}{delete}',
				'contentOptions' => ['style' => 'width: 8.7%'],
				'header' => Html::a('Thêm', ['create','menu_level' => 'field'], ['class' => 'btn btn-primary btn-xs','style' => "width:85px" ]),
				'buttons'=>[
                    'customer'=>function ($url, $model) {
						
						 return Html::tag('div',Html::a('<span class="glyphicon glyphicon-eye-open"></span> Thành viên', ['customer-user/index', 'id'=> $model->id,'menu_level' => 'field'], ['class' => 'btn btn-info btn-xs custom_button','style' => "width:85px"]));
					},
					'view'=>function ($url, $model) {
						
						 return Html::tag('div',Html::a('<span class="glyphicon glyphicon-eye-open"></span> Xem', ['view', 'id'=> $model->id,'menu_level' => 'field'], ['class' => 'btn btn-primary btn-xs custom_button','style' => "width:85px"]));
					},
					'update'=>function ($url, $model) {
						
						 return Html::tag('div',Html::a('<span class="glyphicon glyphicon-edit"></span> Sửa', ['update', 'id'=> $model->id,'menu_level' => 'field'], ['class' => 'btn btn-warning btn-xs custom_button','style' => "width:85px"]));
					},
					'delete'=>function ($url, $model) {
						//$t = 'index.php?r=social/delete&id='. $model->id;
						return Html::tag('div',Html::a('<span class="glyphicon glyphicon-trash"></span> Xóa', ['delete', 'id'=> $model->id,'menu_level' => 'field'], [
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
                </div>
            </div>
        </div>
</div>