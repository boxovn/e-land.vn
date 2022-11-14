<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Question */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="question-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'question_text')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'answer_text')->widget(\yii\redactor\widgets\Redactor::className())?>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('question', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>