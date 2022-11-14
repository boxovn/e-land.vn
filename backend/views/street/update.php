<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;  
/* @var $this yii\web\View */
/* @var $model common\models\Province */

$this->title = Yii::t('street', 'Đường: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('province', 'Provinces'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->street_id]];
$this->params['breadcrumbs'][] = Yii::t('province', 'Update');
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
<div class="street-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>

</div>
<!-- /.box-body -->
</div>
<!-- /.box -->
</div>
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
