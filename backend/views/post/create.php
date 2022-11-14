<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\SettingCronjobGetUser */

$this->title = 'Create Setting Cronjob Get User';
$this->params['breadcrumbs'][] = ['label' => 'Setting Cronjob Get Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="setting-cronjob-get-user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
