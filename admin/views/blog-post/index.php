<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Breadcrumbs;
/* @var $this yii\web\View */
/* @var $searchModel admin\models\BlogPostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tin tức';
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
                        <div class="blog-post-index">


                            <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'category.title',
            'title',
            //'tags',
            //'slug',
            //'banner',
            //'click',
            'user.name',
            'status',
            //'created_at',
            //'updated_at',

           [
               'class' => 'yii\grid\ActionColumn',
					'template' =>'
						<div class="btn-group">
                  			{view}
			                  <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
			                    <span class="caret"></span>
			                    <span class="sr-only">Toggle Dropdown</span>
			                  </button>
			                  <ul class="dropdown-menu" role="menu">
								  <li>{survey}</li>
								  <li>{convert}</li>
			                  	<li>{update}</li>
			                    <li>{delete}</li>
			                  </ul>
                		</div>',
					//'contentOptions' => ['style' => 'width: 8.7%'],
					'filterOptions' => ['style' => 'display: none;'],
                    'header' => Html::a('Thêm', ['create','menu' => 'house'], ['class' => 'btn btn-primary btn-sm','style' => "width:100px" ]),
					'buttons'=>[
					'survey'=>function ($url, $model) {
						return Html::a('<span class="glyphicon glyphicon-eye-open"></span> CV khảo sát', ['survey', 'id'=> $model->id,'menu' => 'house']);
					},	
					'convert'=>function ($url, $model) {
						
						return Html::a('<span class="glyphicon glyphicon-file"></span> Đăng bài', ['convert', 'id'=> $model->id,'menu' => 'house']);
					},
					'view'=>function ($url, $model) {
						
						return Html::a('<span class="glyphicon glyphicon-eye-open"></span> Xem', ['view', 'id'=> $model->id,'menu' => 'house'], ['class' => 'btn btn-primary btn-sm']);
					},
					'update'=>function ($url, $model) {
						
						return  Html::a('<span class="glyphicon glyphicon-edit"></span> Sửa', ['update', 'id'=> $model->id,'menu' => 'house']);
					},
					'delete'=>function ($url, $model) {
						//$t = 'index.php?r=social/delete&id='. $model->id;
						return  Html::a('<span class="glyphicon glyphicon-trash"></span> Xóa', ['delete', 'id'=> $model->id,'menu' => 'house'], [
						
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
                    </div>
                </div>
            </div>
        </div>
</div>