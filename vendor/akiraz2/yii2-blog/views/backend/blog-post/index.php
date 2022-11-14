<?php
/**
 * Project: yii2-blog for internal using
 * Author: akiraz2
 * Copyright (c) 2018.
 */

use akiraz2\blog\models\BlogPost;
use akiraz2\blog\models\Status;
use akiraz2\blog\Module;
use akiraz2\blog\traits\IActiveStatus;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\blog\models\BlogPostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('blog', 'Blog Posts');
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
                                                <h3 class="box-title">Danh sách</h3>
                                            </div>
				            <!-- /.box-header -->
                                                <div class="box-body table-responsive">
                                                    <div class="blog-post-index">

                                                                        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                                                                        <p>
                                                                            <?= Html::a(Module::t('blog', 'Tạo'), ['create'], ['class' => 'btn btn-primary']) ?>
                                                                        </p>

                                                                                    <?= GridView::widget([
                                                                                        'dataProvider' => $dataProvider,
                                                                                        'filterModel' => $searchModel,
                                                                                        'columns' => [
                                                                                            ['class' => 'yii\grid\CheckboxColumn'],
                                                                                            [
                                                                                                'attribute' => 'category_id',
                                                                                                'value' => function ($model) {
                                                                                                    return $model->category->title;
                                                                                                },
                                                                                                'filter' => Html::activeDropDownList(
                                                                                                    $searchModel,
                                                                                                    'category_id',
                                                                                                    BlogPost::getArrayCategory(),
                                                                                                    ['class' => 'form-control', 'prompt' => Module::t('blog', 'Please Filter')]
                                                                                                )
                                                                                            ],
                                                                                            [
                                                                                                'attribute' => 'banner',
                                                                                                'value' => function ($model) {
                                                                                                    return Html::img($model->getThumbFileUrl('banner', 'thumb'), ['class' => 'img-responsive', 'width' => 100]);
                                                                                                },
                                                                                                'format' => 'raw',
                                                                                                'filter' => false
                                                                                            ],
                                                                                            'title',
                                                                                            'click',
                                                                                            'commentsCount',
                                                                                            [
                                                                                                'attribute' => 'status',
                                                                                                'format' => 'html',
                                                                                                'value' => function ($model) {
                                                                                                    if ($model->status === IActiveStatus::STATUS_ACTIVE) {
                                                                                                        $class = 'label-success';
                                                                                                    } elseif ($model->status === IActiveStatus::STATUS_INACTIVE) {
                                                                                                        $class = 'label-warning';
                                                                                                    } else {
                                                                                                        $class = 'label-danger';
                                                                                                    }

                                                                                                    return '<span class="label ' . $class . '">' . $model->getStatus() . '</span>';
                                                                                                },
                                                                                                'filter' => Html::activeDropDownList(
                                                                                                    $searchModel,
                                                                                                    'status',
                                                                                                    BlogPost::getStatusList(),
                                                                                                    ['class' => 'form-control', 'prompt' => Module::t('blog', 'PROMPT_STATUS')]
                                                                                                )
                                                                                            ],
                                                                                            'created_at:date',
                                                                                            // 'update_time',
                                                                                            [
                                                                                                'class' => 'yii\grid\ActionColumn',
                                                                                                'header' => Html::a(Module::t('blog', 'Tạo'), ['create'], ['class' => 'btn btn-primary']),
                                                                                            ],
                                                                                        ],
                                                                                    ]); ?>

                                                    </div>
                                                </div>
                                        </div>
                    </div>
                 </div> 
            </section>  
 </div>
