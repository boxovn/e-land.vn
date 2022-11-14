<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Partner */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="partner-form">
 <?php
            $form = ActiveForm::begin();
            ?>
            <?php echo $form->field($model, 'name')->textInput(array('placeholder' => 'Họ Tên')); ?>
            <?php echo $form->field($model, 'phone')->textInput(array('placeholder' => 'Số điện thoại ')); ?>
			<?php echo $form->field($model, 'email')->textInput(array('placeholder' => 'Nhập email')); ?>
            <?php echo $form->field($model, 'password')->passwordInput(array('placeholder' => 'Nhập mật khẩu')); ?>
            <?php echo $form->field($model, 'password_repeat')->passwordInput(array('placeholder' => 'Nhập lại mật khẩu')); ?>
		   	<?= Html::submitButton('Tạo tài khoản', ['class' => 'btn btn-success']) ?>
            <?php ActiveForm::end(); ?>  
</div>
