<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Article */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'category_type_id')->textInput() ?>
    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'area_text')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'price_text')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'price_number')->textInput() ?>
    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'content')->widget(\yii\redactor\widgets\Redactor::className())?>
    <?= $form->field($model, 'page_name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'page_url')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'project_id')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'detail')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'district_id')->textInput() ?>
    <?= $form->field($model, 'province_id')->textInput() ?>
    <?= $form->field($model, 'street')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'updated')->textInput() ?>
    <?= $form->field($model, 'expiry_date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>