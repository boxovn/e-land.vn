<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Rule */

$this->title = Yii::t('rule', 'Create Rule');
$this->params['breadcrumbs'][] = ['label' => Yii::t('rule', 'Rules'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rule-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
