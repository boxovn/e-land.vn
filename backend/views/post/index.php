<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SettingCronjobGetUserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Setting Cronjob Get Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="setting-cronjob-get-user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Setting Cronjob Get User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'url:url',
            'page_total',
            'page_count',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
