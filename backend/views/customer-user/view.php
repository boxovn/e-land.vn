<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\CustomerUser */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('customer', 'Customer Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
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
                        <div class="customer-user-view">

                            <h1><?= Html::encode($this->title) ?></h1>

                            <p>
                                <?= Html::a(Yii::t('customer', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                                <?= Html::a(Yii::t('customer', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('customer', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
                            </p>

                            <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user_id',
            'customer_id',
            'created',
        ],
    ]) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>