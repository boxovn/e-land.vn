<?php
use yii\widgets\ActiveForm;
?>
<div class="body">
    <div id="list-box" class="list-box list-box-border-none">
        <div class="row">
            <br>
            <br>
            <div id="loginform">
               
                <div id="mainlogin">
                    
                    <center><h1 class="title">Bạn hãy nhập mật khẩu mới</h1></center>
				<?php
				foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
					echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
				}
				?>
			
				<?php
                    $form = ActiveForm::begin([
                                'options' => ['class' => 'form-login'],
                                'fieldConfig' => [
                                    'options' => ['class' => 'form-group row'],
                                ],
                               
                    ]);
                ?>
                <?php echo $form->field($model, 'password', ['template' => '{label}{input}'])->passwordInput(array('placeholder' => 'Mật khẩu mới'))->label('Mật khẩu mới'); ?>
				<?php echo $form->field($model, 'repeat_password', ['template' => '{label}{input}'])->passwordInput(array('placeholder' => 'Mật khẩu xác nhận'))->label('Mật khẩu xác nhận'); ?> 
                <div class="form-group row">
                <button type="submit" class="btn btn-login">Xác nhận</button>
                    </div>
                
				<?php echo $form->errorSummary($model, ['header' => '']) ?>
				
				<?php ActiveForm::end(); ?>
				<div style="margin-bottom: 90px"></div>
			</div>
		</div>
</div>
</div>
</div>
    <script>
        function checkForget(){
            if($('.form-inlines').hasClass('active-forget')){
                $('.form-inlines').removeClass('active-forget');
            }else{
                $('.form-inlines').addClass('active-forget');
            }
            return false;
        }
    </script>


