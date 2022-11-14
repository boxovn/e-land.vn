<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Recruitment */

$this->title = Yii::t('recruitment', 'Create Recruitment');
$this->params['breadcrumbs'][] = ['label' => Yii::t('recruitment', 'Recruitments'), 'url' => ['index']];
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
                        <div class="recruitment-create">
                            <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>