<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="content-wrapper">
 <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                   <?=$this->title;?>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-home"></i> Trang chủ</a></li>
                    <li class="active"> <?=$this->title;?></li>
                </ol>
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-md-12 col-xs-12 col-sm-12">
                    
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">Xem</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body table-responsive">

    <h1><?= Html::encode($this->title) ?></h1>

    <p> <?= Html::a('Danh sách', ['index', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Sửa', ['update', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
        <?= Html::a('Xóa', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
           
            'code',
            'name',
            'first_name',
            'last_name',
            'phone',
            'email:email',
            'address',
            'image',
            'image_link',
            'birthday',
            'last_login_token',
            'status',
            'active',
            'created_at',
            'updated_at',
            'password_reset_token',
            'page_name',
            'page_url:url',
            'sex',
            'zalo',
            'facebook',
            'skype',
            'eland',
            'company_name',
            'province_id',
            'district_id',
            'street',
            'mobile',
            'about:ntext',
        ],
    ]) ?>
</div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>