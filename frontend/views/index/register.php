<?php
use yii\widgets\ActiveForm;
use frontend\widgets\AuthChoiceCustom;
use yii\jui\DatePicker;
use yii\helpers\ArrayHelper;
use common\models\Province;
use frontend\widgets\Header;
?>

    <div id="list-box" class="list-box list-box-border-none">
        <div class="row">
           <div class="col-sm-12 col-lg-12 col-md-12">
            <div id="register-form">

                <div id="mainlogin">

                    <center>
                        <h1 class="title">Đăng ký tại khoản tại Eland</h1>
                    </center>
                    <p>
                            Tạo tài khoản ngay bây giờ để đăng tin và tiếp cận danh mục thông tin bài đăng bạn quan tâm!
                        </p>
                    

                    <?php
            $form = ActiveForm::begin([
                        'options' => ['class' => 'form-register'],
                        'fieldConfig' => [
                            'options' => ['class' => 'form-group row'],
                        ],
            ]);
            ?>
			
                    <?php echo $form->field($model, 'name', ['options' => ['class' => 'form-group row'],
                        'template' => "<div>{label}\n{input}\n{error}</div>",
                    ])->textInput(array('placeholder' => 'Họ Tên')); ?>
                    <?php echo $form->field($model, 'phone', ['options' => ['class' => 'form-group row'],
                        'template' => "<div>{label}\n{input}\n{error}</div>",
                    ])->textInput(array('placeholder' => 'Số điện thoại ')); ?>
                    <?php echo $form->field($model, 'email', ['options' => ['class' => 'form-group row'],
                        'template' => "<div>{label}\n{input}\n{error}</div>",
                    ])->textInput(array('placeholder' => 'Nhập email')); ?>
                    <?php echo $form->field($model, 'password', ['options' => ['class' => 'form-group row'],
                        'template' => "<div>{label}\n{input}\n{error}</div>",
                    ])->passwordInput(array('placeholder' => 'Nhập mật khẩu')); ?>
                    <?php echo $form->field($model, 'password_repeat',['options' => ['class' => 'form-group row'],
                        'template' => "<div>{label}\n{input}\n{error}</div>",
                    ])->passwordInput(array('placeholder' => 'Nhập lại mật khẩu')); ?>
					
                    <div class="form-group row">
                        <button type="submit" class="btn-block btn btn-sm btn-danger registerbtn">Đăng ký</button>
                    </div>
					<div class="form-group row">
					  <?= $form->errorSummary($model,['header' => '']) ?>
					  </div>
                    <div class="form-group row">Khi bạn đăng ký tài khoản, bạn đồng ý với các <span style="color:#c00"> Điều khoản, Quy chế, Chính
                        sách</span> ... hoạt động của E-land.

                        <a style="color: #337ab7;"
                            href="<?php echo Yii::$app->getUrlManager()->createUrl(['rule/index']) ?>">Xem tại đây
                        </a>
                    </div>
                  
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
             </div>
        </div>

    </div>
