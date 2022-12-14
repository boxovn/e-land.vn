<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\SettingCronjobGetUser */

$this->title = 'Update Setting Cronjob Get User: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Setting Cronjob Get Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="setting-cronjob-get-user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
