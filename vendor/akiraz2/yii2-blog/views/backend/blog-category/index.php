<?php
/**
 * Project: yii2-blog for internal using
 * Author: akiraz2
 * Copyright (c) 2018.
 */

use akiraz2\blog\models\BlogCategory;
use akiraz2\blog\Module;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel akiraz2\blog\models\BlogCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('blog', 'Danh mục tin tức');
$this->params['breadcrumbs'][] = $this->title;
?>
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
                'links' => isset($this->params['breadcrumbs'])? $this->params['breadcrumbs']: '',
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

                           <div class="blog-category-index">
                            <p>
                                <?= Html::a(Module::t('blog', 'Create '), ['create'], ['class' => 'btn btn-sm btn-primary']) ?>
                            </p>
                            <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                    		'layout' => "{summary}\n{pager}\n{items}\n{pager}",
											'showFooter' => true,
											 'rowOptions' => function ($model, $key, $index, $grid) {
												return ['id' => $model->id];
											},
											'pager' => [
														'firstPageLabel' => 'First',
														'lastPageLabel' => 'Last',
													],
                                            'columns' => [
                                                ['class' => 'yii\grid\SerialColumn'],

												 [
													 'attribute' => 'banner',
													  'contentOptions' => ['class' => 'text-content'],
                           							 'headerOptions' => ['class' => 'text-header']
												],
                                    			[
													'attribute' => 'title',
													'class' => 'yii\grid\DataColumn',
													
													 'headerOptions' => ['class' => 'text-header'],
                           							 'filter' => [1 => 'Đang rao bán', 0 => 'Ẩn tin']
												],
												[
													'attribute' => 'sort_order',
													'class' => 'yii\grid\DataColumn',
													
													 'headerOptions' => ['class' => 'text-header']
												],
												
                                                [
													'attribute' => 'template',
													'class' => 'yii\grid\DataColumn',
													
													'headerOptions' => ['class' => 'text-header']
												],
                                                [
													'attribute' => 'is_nav',
													'class' => 'yii\grid\DataColumn',
													
													'headerOptions' => ['class' => 'text-header']
												],
                                                [
													'attribute' => 'status',
													'class' => 'yii\grid\DataColumn',
													
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
</div>
        </div>
        </div>
    </div>
</div>  