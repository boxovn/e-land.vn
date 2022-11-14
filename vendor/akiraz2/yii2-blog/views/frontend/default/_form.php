<?php
/**
 * Project: yii2-blog for internal using
 * Author: akiraz2
 * Copyright (c) 2018.
 */

use akiraz2\blog\Module;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<div class="blog-comment-form">
    <?php $form = ActiveForm::begin([
        'id' => 'comment-form',
    ]); ?>

    
    <?= $form->field($model, 'content')->textarea(['rows' => 3])->label(false); ?>

    <?= Html::submitButton(Module::t('blog', 'Add comments'), ['class' => 'btn btn-danger', 'style'=> 'float:right; margin-top:10px;']) ?>

    <?php ActiveForm::end(); ?>
</div>
