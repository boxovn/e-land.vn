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

$this->title =  $model->title;
$this->params['breadcrumbs'][] = ['label' => Module::t('blog', 'Blog Categorys'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Module::t('blog', 'Update');
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
				                <h3 class="box-title"><?php echo  Module::t('blog', 'Update');?></h3>
							</div>
				            <!-- /.box-header -->
				            <div class="box-body table-responsive">
<div class="blog-category-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>
</div>
</div>
</div>
</div>
