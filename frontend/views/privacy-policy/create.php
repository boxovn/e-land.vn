<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\PrivacyPolicy */

$this->title = Yii::t('privacy_policy', 'Create Privacy Policy');
$this->params['breadcrumbs'][] = ['label' => Yii::t('privacy_policy', 'Privacy Policies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="privacy-policy-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
