<?php
/**
 * Project: yii2-blog for internal using
 * Author: akiraz2
 * Copyright (c) 2018.
 */
use yii\helpers\Html;

?>
<div class="blog-brief">
<div class="blog-brief__header">
<div class="blog-brief__cat">
<a title="E-land trading" href="https://e-land.vn/kenh/37876">
                    <img alt="E-land trading" class="user_avatar" onerror="if (this.src != 'error.jpg') this.src = 'https://e-land.vn/images/no-image200x200.png';" src="https://e-land.vn/channels/avatar/1610899244_5pW-fhCBk1HJcqDkqpPdA2PecFuW1Cak.jpg"/>
                     
                    </a>         
                    <?= $model->category->title; ?> 
                <div class="blog-brief__nav">
            <span>
                <i class="fa fa-calendar"></i> <?= Yii::$app->formatter->asDate($model->created_at); ?>
            </span>
            <span>
                <i class="fa fa-eye"></i> <?= $model->click; ?>
            </span>
        </div>
        </div>
       
        
        <h4 class="blog-brief__title  title--4">
            <?= Html::a(Html::encode($model->title), $model->url); ?>
        </h4>
</div>

    <div class="blog-brief__wrap">
    
        <div class="blog-brief__content">

            <?= \yii\helpers\StringHelper::truncate($model->brief, 145); ?>
        </div>
        <div class="blog-brief__img">
        <?= Html::img($model->getImageFileUrl('banner')); ?>
    </div>

        
    </div>
</div>