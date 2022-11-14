<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;  
/* @var $this yii\web\View */
/* @var $model common\models\district */

$this->title = Yii::t('district', 'Cập nhập: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('district', 'Quận/Huyện'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->district_id]];
$this->params['breadcrumbs'][] = Yii::t('district', 'Update');
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
                         <?= $this->render('_form', [
                            'model' => $model,
                        ]) ?>

                    </div>

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