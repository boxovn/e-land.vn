<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Question */

$this->title = $model->question_text;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Questions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
use yii\widgets\ListView;
?>
<div class="container">
    <div class="question-view page-view">
        <div class="html-content">
            <?php
              /*  echo ListView::widget([
                    'dataProvider' => $dataProvider,
                    'itemView' => '_brief',
                    'options' => [
                        'class' => 'blog-list-view'
                    ],
                    'layout' => '{items}{pager}{summary}'
                ]);
                */
                ?>
            <h1><?= Html::encode($this->title) ?></h1>
            <?php echo $model->answer_text;?>
        </div>
    </div>
</div>