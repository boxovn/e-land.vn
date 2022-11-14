<?php

use yii\widgets\ActiveForm;
?>
<div id="main">
    <div id="container" class="container">
        <div class="row">
            <br>
            <br>
            <div id="loginform">
                <?php $errorClass = $reset->hasErrors() ? "active-forget" : "" ?>
                <?php $form = ActiveForm::begin(['options' => ['class' => 'form-login form-inlines ' . $errorClass]]); ?>
                <?php echo $form->field($reset, 'email', ['template' => '{label}{input}{error}'])->textInput(array('placeholder' => 'Email'))->label('Địa chỉ E-mail của bạn'); ?>
                <button type="submit" class="btn btn-primary">Lấy lại mật khẩu</button>
<?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>