<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Breadcrumbs;
/* @var $this yii\web\View */
/* @var $model common\models\Payment */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Payments', 'url' => ['index']];
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
                <div class="block">
                    <div class="well text-center">
                        <div class="action-toolbar btn-toolbar">
                            <div class="btn-group">
                                <?= Html::a('Sao chép sản phẩm <i class="fa fa-plus"></i>', ['create'], ['class' => 'btn btn-default']) ?>


                                <?= Html::a('Danh sách <i class="fa fa-list"></i>', ['index'], ['class' => 'btn btn-primary btn-sm']) ?>
                                <?= Html::a('Sửa <i class="fa fa-edit"></i>', ['update', 'id' => $model->id], ['class' => 'btn btn-warning btn-sm']) ?>
                                <?= Html::a('Xóa <i class="fa fa-trash"></i>', ['delete', 'id' => $model->id], [
					            'class' => 'btn btn-danger btn-sm',
					            'data' => [
					                'confirm' => 'Are you sure you want to delete this item?',
					                'method' => 'post',
					            ],
                            ]) ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Xem</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'status',
            'updated:date',
            'created:date',
        ],
    ]) ?>

                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>

    </section>
    <!-- /.content -->
</div>