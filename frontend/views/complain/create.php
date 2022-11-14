<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\complain */

$this->title = Yii::t('complain', 'Create Complain');
$this->params['breadcrumbs'][] = ['label' => Yii::t('complain', 'Complains'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="complain-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
