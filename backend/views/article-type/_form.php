<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ArticleType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-type-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'image')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'keyword')->textInput() ?>
    <?= $form->field($model, 'status')->dropDownList([0 =>'Ẩn', 1 => 'Hiện'])?>
    <?= $form->field($model, 'sort')->textInput() ?>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('customer', 'Lưu'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>