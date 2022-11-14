<?php
use yii\widgets\ActiveForm;
use frontend\widgets\AuthChoiceCustom;
?>
<!------ Include the above in your HEAD tag ---------->
<div id="main">
    <div id="container" class="container">
        <div class="row">
            <br>
            <br>
            <div id="loginform">
               
                <div id="mainlogin">
                    
                    <h1>Đăng nhập</h1>
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
                        'template' => "<div class=\"col-sm-12 col-md-12 col-lg-12 no-padding\">{input}\n{error}</div>",
                    ])->textInput(array('placeholder' => 'Email'))->label('');
                    ?>
                    <?php
                    echo $form->field($model, 'password', ['options' => ['class' => 'form-group row'],
                        'template' => "<div class=\"col-sm-12 col-md-12 col-lg-12 no-padding\">{input}\n{error}</div>",
                    ])->passwordInput(array('placeholder' => 'Password'))->label('');
                    ?> 
                    <div class="col-sm-12 col-md-12 col-lg-12 no-padding">
                        <button class="btn btn-sm btn-default" type="submit"> Đăng nhập</button>
                    </div>
                    <?php ActiveForm::end(); ?>
                    <div class="col-sm-12 col-md-12 col-lg-12 no-padding">
                        <div id="note"><a href="<?php echo Yii::$app->getUrlManager()->createUrl(['index/forget-password']) ?>">Bạn quên mật khẩu?</a></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="register">
            Bạn chưa có tài khoản tại E-land.vn?
            <br/>
            <br/>
            <a class="btn btn-sm btn-primary"  href="<?php echo Yii::$app->getUrlManager()->createUrl(['index/register']) ?>" >Tạo tài khoản</a></div>
    </div>
</div>
<!-- Modal -->
