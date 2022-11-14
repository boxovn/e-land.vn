<?php
use yii\widgets\ActiveForm;
use frontend\widgets\AuthChoiceCustom;
?>
<!-- Modal HTML -->
<div class="modal-header">
				<div class="avatar">
					<img src="https://e-land.vn/images/logo.png" alt="Avatar">
				</div>				
				<h4 class="modal-title">Đăng nhập</h4>	
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
                <?php $form = ActiveForm::begin([
                                'id' => 'login-form',
                                'enableAjaxValidation' => true,
                                'action' => false,
                                'options' => ['class' => 'form-login'],
                                'fieldConfig' => [
                                    'options' => ['class' => 'form-group row'],
                                ],
                               
                    ]);
                    ?>
                    <?php
                    echo $form->field($model, 'email', ['options' => ['class' => 'form-group row'],
                        'template' => "<div>{label}\n{input}\n{error}</div>",
                    ])->textInput(array('placeholder' => 'Email'))->label('Email');
                    ?>
                    <?php
                    echo $form->field($model, 'password', ['options' => ['class' => 'form-group row'],
                        'template' => "<div>{label}\n{input}\n{error}</div>",
                    ])->passwordInput(array('placeholder' => 'Password'))->label('Mật khẩu');
                    ?> 
                   
                     <div class="form-group row">
                        <button class="btn btn-sm btn-danger btn-block btn-login"  id="btn-login" 
                        type="button"> Đăng nhập</button>
                        <a class="text-forget" href="<?php echo Yii::$app->getUrlManager()->createUrl(['index/forget-password']) ?>">Bạn quên mật khẩu?</a>
                    </div>
                   <?= $form->errorSummary($model,['header' => '']) ?>
                <?php ActiveForm::end(); ?>
			</div>
			<div class="modal-footer">
				<a href="#">Tạo tài khoản mới</a>
			</div>
<!-- Modal -->
