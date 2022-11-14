<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Contact */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contact-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name', ['options' => ['class' => 'form-group row']])->textInput(array('placeholder' => 'Họ Tên')); ?>

    <?= $form->field($model, 'email', ['options' => ['class' => 'form-group row']])->textInput(array('placeholder' => 'Email')); ?>

    <?= $form->field($model, 'phone', ['options' => ['class' => 'form-group row']])->textInput(array('placeholder' => 'Điện thoại')); ?>

    <?= $form->field($model, 'title', ['options' => ['class' => 'form-group row']])->textInput(array('placeholder' => 'Tiêu đề')); ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('contact', 'Send'), ['class' => 'btn-block btn btn-sm btn-danger registerbtn']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
