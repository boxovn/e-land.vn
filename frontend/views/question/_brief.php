<?php
/**
 * Project: yii2-question for internal using
 * Author: akiraz2
 * Copyright (c) 2018.
 */

use yii\helpers\Html;
?>

<div class="question-brief">

    <div class="question-brief__wrap">
        <h4 class="question-brief__title title--4">
            <?= Html::a(Html::encode($model->question_text),['view', 'slug' => $model->slug]); ?>
        </h4>
        <div class="question-brief__content">
            <?= \yii\helpers\StringHelper::truncate($model->answer_text, 1000); ?>
        </div>

    </div>
</div>