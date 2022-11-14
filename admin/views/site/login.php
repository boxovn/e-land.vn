<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="login-box">

    <div class="login-box-body">
        <p class="login-box-msg">Thông tin đăng nhập</p>

        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
            <div class="form-group has-feedback">
                <?= $form->field($model, 'email')->textInput(['autofocus' => true, 'class' => 'form-control'])->label("Email"); ?>
                <span class="glyphicon glyphicon-user form-control-feedback" style="top: 25px;"></span>
            </div>
            <div class="form-group has-feedback">
                <?= $form->field($model, 'password')->passwordInput(['class' => 'form-control'])->label("Mật khẩu"); ?>
                <span class="glyphicon glyphicon-lock form-control-feedback" style="top: 25px;"></span>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Đăng nhập</button>
                </div>
                <!-- /.col -->
            </div>
            <br/>
            <br/>
        <?php ActiveForm::end(); ?>

    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
