<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\HouseSurvey */

$this->title = 'Update House Survey: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'House Surveys', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="house-survey-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
