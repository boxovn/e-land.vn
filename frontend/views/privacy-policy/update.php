<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\PrivacyPolicy */

$this->title = Yii::t('privacy_policy', 'Update Privacy Policy: {name}', [
    'name' => $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('privacy_policy', 'Privacy Policies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('privacy_policy', 'Update');
?>
<div class="privacy-policy-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
