<?php

use yii\helpers\Html;
use yii\widgets\ListView;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\QuestionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = Yii::t('question', 'title');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="question-index">
        <div class="html-content">
            <h1><?= Html::encode($this->title) ?></h1>
            <?php
                echo ListView::widget([
                    'dataProvider' => $dataProvider,
                    'itemView' => '_brief',
                    'options' => [
                        'class' => 'question-list-view'
                    ],
                    'layout' => '<ul class="question-list row clearfix">{items}</ul>{pager}{summary}',
                    'itemOptions' => ['tag'=>'li', 'class'=>'question-container'],
                ]);
                ?>
        </div>
    </div>
</div>