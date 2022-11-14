<?php
use yii\widgets\ActiveForm;
use frontend\widgets\AuthChoiceCustom;
?>

<!------ Include the above in your HEAD tag ---------->
<div class="body">
    <div id="list-box" class="list-box list-box-border-none">
        <div class="row">
            
            <div id="loginform">
               
                <div id="mainlogin">
                    
                    <center><h1 class="title">Đăng nhập</h1></center>

        	 		<div class="col-sm-12 col-md-12 col-lg-12 no-padding">
                    		<label class="text-label">
							 Hãy đăng nhập ngay bây giờ để đăng tin rao và tiếp cận danh mục thông tin bài đăng bạn quan tâm!
                            </label>
						</div>
                    <?php
                    $form = ActiveForm::begin([
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
                        <button class="btn btn-sm btn-danger btn-block" type="submit"> Đăng nhập</button>
                        <a class="text-forget" href="<?php echo Yii::$app->getUrlManager()->createUrl(['index/forget-password']) ?>">Bạn quên mật khẩu?</a>
                    </div>
                   <?= $form->errorSummary($model,['header' => '']) ?>
                    <?php ActiveForm::end(); ?>
                    
                </div>
            </div>
        </div>

        <div class="register">Bạn chưa có tài khoản tại Eland?
            <br/>
            <br/>
            <a class="btn btn-sm btn-danger"  href="<?php echo Yii::$app->getUrlManager()->createUrl(['index/register']) ?>" >Đăng ký</a></div>
    </div>
   </div> 
<!-- Modal -->
