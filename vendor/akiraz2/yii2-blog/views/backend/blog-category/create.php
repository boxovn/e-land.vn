<?php
/**
 * Project: yii2-blog for internal using
 * Author: akiraz2
 * Copyright (c) 2018.
 */

use akiraz2\blog\Module;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
/* @var $this yii\web\View */
/* @var $model akiraz2\blog\models\BlogCategory */

$this->title = Module::t('blog', 'Tạo danh mục');
$this->params['breadcrumbs'][] = ['label' => Module::t('blog', 'Danh mục'), 'url' => ['index']];
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
				                <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
							</div>
				            <!-- /.box-header -->
				            <div class="box-body table-responsive">
                            <div class="blog-category-create">

                                <?= $this->render('_form', [
                                    'model' => $model,
                                ]) ?>
                            </div>
                            </section>
</div>

