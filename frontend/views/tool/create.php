<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Tool */

$this->title = Yii::t('tool', 'Create Tool');
$this->params['breadcrumbs'][] = ['label' => Yii::t('tool', 'Tools'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tool-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
