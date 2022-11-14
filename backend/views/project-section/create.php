<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectSection */

$this->title = 'Create Project Section';
$this->params['breadcrumbs'][] = ['label' => 'Project Sections', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-section-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
