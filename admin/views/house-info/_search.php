<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\NoteInfoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="note-info-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'phone') ?>

    <?= $form->field($model, 'street') ?>

    <?php // echo $form->field($model, 'area') ?>

    <?php // echo $form->field($model, 'home') ?>

    <?php // echo $form->field($model, 'width') ?>

    <?php // echo $form->field($model, 'lenth') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'direction') ?>

    <?php // echo $form->field($model, 'alley') ?>

    <?php // echo $form->field($model, 'district_id') ?>

    <?php // echo $form->field($model, 'province_id') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'content') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'deposit_date') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
