<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PrivacyPolicySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = isset($model->title)? $model->title: Yii::t('privacy_policy', 'Privacy Policies');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contanner">
    <div class="privacy-policy-index">
        <div class="html-content">
            <?php if($model){?>
            <h1><?= Html::encode($model->title) ?></h1>
            <p><?=$model->content;?></p>
            <?php }else{?>
            Dữ liệu không tồn tại
            <?php }?>
        </div>
    </div>
</div>