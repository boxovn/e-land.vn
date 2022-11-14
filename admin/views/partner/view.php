<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Partner */

$this->title = $model->user_id;
$this->params['breadcrumbs'][] = ['label' => 'Partners', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="content-wrapper">
 <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                   <?=$this->title;?>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-home"></i> Trang chủ</a></li>
                    <li class="active"> <?=$this->title;?></li>
                </ol>
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
        <?= Html::a('Sửa', ['update', 'user_id' => $model->user_id, 'partner_id' => $model->partner_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Xóa', ['delete', 'user_id' => $model->user_id, 'partner_id' => $model->partner_id], [
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
            'partner.name',
            'partner.phone',
            'partner.email',
            'status',
            'created',
        ],
    ]) ?>
</div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

