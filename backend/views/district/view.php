<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Breadcrumbs;
/* @var $this yii\web\View */
/* @var $model common\models\Province */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('province', 'Provinces'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?=$this->title;?>
        </h1>
        <?php 

                        // $this is the view object currently being used
echo Breadcrumbs::widget([
    'itemTemplate' => "<li><i>{link}</i></li>\n", // template for all links
    'links' =>isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]);
      ?>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Xem</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <p>
                            <?= Html::a(Yii::t('province', 'Danh mục'), ['index', 'id' => $model->province_id], ['class' => 'btn btn-primary']) ?>
                            <?= Html::a(Yii::t('province', 'Sửa'), ['update', 'id' => $model->province_id], ['class' => 'btn btn-warning']) ?>
                            <?= Html::a(Yii::t('province', 'Xoá'), ['delete', 'id' => $model->province_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('province', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
                        </p>

                        <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'province_id',
            'name',
            'type',
            'slug',
            'keyword',
            'description',
            'image',
        ],
    ]) ?>

                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>

    </section>
    <!-- /.content -->
</div>