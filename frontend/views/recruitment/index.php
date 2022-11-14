<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\RecruitmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('recruitment', 'text_recruitment');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="recruitment-index">
        <div class="html-content">
            <?php if($models){?>
            <?php foreach($models as $key => $model){?>
            <p>
                <a href=""><?= Html::encode($model->title) ?></a>
                <?php echo $model->content;?>
            </p>
            <?php }?>
            <?php }else {?>

            <p> Nội dung không tồn tại</p>
            <?php }?>
        </div>
    </div>
</div>