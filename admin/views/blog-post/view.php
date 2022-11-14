<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Breadcrumbs;
/* @var $this yii\web\View */
/* @var $model common\models\BlogPost */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Blog Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
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

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Danh sách</h3>
                    </div>
                    <!-- /.box-header -->

                    <div class="box-body table-responsive">
                        <div class="blog-post-view">

                            <h1><?= Html::encode($this->title) ?></h1>

                            <p>
                                <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                                <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
                            </p>

                            <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'category.title',
            'title',
            'brief:ntext',
            'content:raw',
            'tags',
            'slug',
            
            [
    'attribute'=>'banner',
    'value'=>$model->banner,
    'format' => ['image',['width'=>'100','height'=>'100']],
 ],
            'click',
            'user.name',
            'status',
            'created_at',
            'updated_at',
        ],
    ]) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>