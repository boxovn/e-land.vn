<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model common\models\About */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="about-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'title')->textInput() ?>
    <?= $form->field($model, 'address')->textInput() ?>
    <?= $form->field($model, 'email')->textInput() ?>
    <?= $form->field($model, 'phone')->textInput() ?>
    <?= $form->field($model, 'facebook')->textInput() ?>
    <?= $form->field($model, 'zalo')->textInput() ?>
    <?= $form->field($model, 'youtube')->textInput() ?>
    <?= $form->field($model, 'description')->textArea() ?>
    <?= $form->field($model, 'content')->widget(\yii\redactor\widgets\Redactor::className())?>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('about', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>