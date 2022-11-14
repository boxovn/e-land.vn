<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
/* @var $this yii\web\View */
/* @var $model common\models\OrderDetail */

$this->title = 'Update Order Detail: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Order Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
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
        <div class="col-xs-12">

            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Thêm</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
<div class="order-detail-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
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
