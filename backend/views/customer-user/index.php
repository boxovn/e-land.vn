<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CustomerUserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('customer', 'Customer Users');
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
                        <div class="customer-user-index">

                            <h1><?= Html::encode($this->title) ?></h1>

                            <p>
                                <?= Html::a(Yii::t('customer', 'Create Customer User'), ['create'], ['class' => 'btn btn-success']) ?>
                            </p>

                            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                            <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user.name',
            'customer.name',
            'created',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>