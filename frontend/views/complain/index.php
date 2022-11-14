<?php

use yii\helpers\Html;
use yii\widgets\ListView;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ComplainSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title =isset($model->title)?$model->title: Yii::t('complain', 'Complains');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="complain-index">
        <div class="html-content">
            <?php if($model){?>
            <center>
                <h1> <?php echo $this->title?></h1>
            </center>
            <?php echo $model->content;?>
            <?php }else{?> <p>Nội dung không tồn tại
            </p>
            <?php } ?>
        </div>
    </div>
</div>