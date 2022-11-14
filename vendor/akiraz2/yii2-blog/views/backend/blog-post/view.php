<?php
/**
 * Project: yii2-blog for internal using
 * Author: akiraz2
 * Copyright (c) 2018.
 */

use akiraz2\blog\Module;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\blog\models\BlogPost */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Module::t('blog', 'Blog Posts'), 'url' => ['index']];
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
<div class="blog-post-view">
    
    <p>
        <?= Html::a(Module::t('blog', 'Danh sách'), ['index', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Module::t('blog', 'Sửa'), ['update', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
        <?= Html::a(Module::t('blog', 'Xoá'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Module::t('blog', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'category_id',
                'value' => $model->category->title,
            ],
            'title',
            'brief:ntext',
            'content:raw',
            'tags',
            'slug',
            [
                'attribute' => 'banner',
                'value' => $model->getThumbFileUrl('banner', 'thumb'),
            ],
            'click',
            [
                'attribute' => 'user',
                'value' => ($model->user) ? $model->user->{Module::getInstance()->userName} : 'Отсутствует',
            ],
            [
                'attribute' => 'status',
                'value' => $model->getStatus(),
            ],
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>
 </div>
        </div>
        </div>
    </div>
</div> 
</div>  
