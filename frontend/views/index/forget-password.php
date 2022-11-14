<?php

use yii\widgets\ActiveForm;
?>
<div class="body">
    <div id="list-box" class="list-box list-box-border-none">
        <div class="row">
            <br>
            <br>
            <div id="loginform">
                    
                    <center><h1 class="title">Lấy lại mật khẩu </h1></center>
                     <?php
        foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
            echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
        }
        ?>
                <?php $errorClass = $reset->hasErrors() ? "active-forget" : "" ?>
                <?php $form = ActiveForm::begin(['options' => ['class' => 'form-login form-inlines ' . $errorClass]]); ?>
                <?php echo $form->field($reset, 'email', ['template' => '{label}{input}{error}'])->textInput(array('placeholder' => 'Nhâp Email'))->label('Địa chỉ E-mail của bạn'); ?>
                <div class="form-group row">
                    <button type="submit" class="btn btn-danger btn-block">Lấy lại mật khẩu</button>
                </div>
                <br/>
				<?= $form->errorSummary($reset,['header' => '']); ?>
<?php ActiveForm::end(); ?>
            </div>
        </div>  
    </div>
</div>