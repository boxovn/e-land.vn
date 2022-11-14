<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
yii\bootstrap\BootstrapPluginAsset::register($this);
?>
<?php //$this->registerCSSFile(Yii::$app->request->baseUrl . '/css/model-login.css'); ?>

<!-- Modal HTML -->

                <div class="modal-header">
                    <div class="avatar">
                    <img class="img-logo" src="<?php echo Yii::$app->getUrlManager()->baseUrl?>/e-land/img/logo.png"/>
                    </div>				
                    <h5 class="modal-title">Đăng ký</h5>	
                    <button type="button" class="close btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                <?php
            $form = ActiveForm::begin([
                        'options' => ['class' => 'form-register'],
                        'fieldConfig' => [
                            'options' => ['class' => 'mb-3 row'],
                        ],
            ]);
            ?>
                    <?php echo $form->field($model, 'name', ['options' => ['class' => 'mb-3 row'],
                        'template' => "<div>{label}\n{input}\n{error}</div>",
                    ])->textInput(array('placeholder' => 'Họ Tên')); ?>
                    <?php echo $form->field($model, 'phone', ['options' => ['class' => 'mb-3 row'],
                        'template' => "<div>{label}\n{input}\n{error}</div>",
                    ])->textInput(array('placeholder' => 'Số điện thoại ')); ?>
                    <?php echo $form->field($model, 'email', ['options' => ['class' => 'mb-3 row'],
                        'template' => "<div>{label}\n{input}\n{error}</div>",
                    ])->textInput(array('placeholder' => 'Nhập email')); ?>
                    <?php echo $form->field($model, 'password', ['options' => ['class' => 'mb-3 row'],
                        'template' => "<div>{label}\n{input}\n{error}</div>",
                    ])->passwordInput(array('placeholder' => 'Nhập mật khẩu')); ?>
                    <?php echo $form->field($model, 'password_repeat',['options' => ['class' => 'mb-3 row'],
                        'template' => "<div>{label}\n{input}\n{error}</div>",
                    ])->passwordInput(array('placeholder' => 'Nhập lại mật khẩu')); ?>
                    <div class="mb-3 row">
                        <button type="submit" class="btn-block btn btn-sm btn-danger registerbtn">Đăng ký</button>
                    </div>
                    <div class="mb-3 row">Khi bạn đăng ký tài khoản, bạn đồng ý với các <span style="color:#c00"> Điều khoản, Quy chế, Chính
                        sách</span> ... hoạt động của E-land.VN

                        <a style="color: #337ab7;" target="_blank"
                            href="<?php echo Yii::$app->getUrlManager()->createUrl(['rule/index']) ?>">Xem tại đây
                        </a>
                    </div>
                    <?= $form->errorSummary($model,['header' => '', 'class' =>"invalid-feedback"]) ?>
                    <?php ActiveForm::end(); ?>
                </div>
                <div class="modal-footer">
                  
                </div>
<!-- Modal -->
     

<script>
$form = $('.form-login'); 
$form.on('beforeSubmit', function(e) {
//$(document).on('click','#btn-login', function(e) {
//$form.submit(function (e){
   e.preventDefault();
    var data = $(this).serialize();
    
    $.ajax({
        url:  '<?php echo Url::to(['index-api/login', true]);?>',
        type: 'POST',
        data: data,
        dataType: 'json',
       // headers: {
        //     "Authorization": "Basic " + btoa(USERNAME + ":" + PASSWORD)
       // },
        success: function (data) {
           if(data.error==false){
            $('#modalLogin').modal('hide');
            $('#modalLoginSuccess').modal('show');
            //  location.reload();  
           }else{
          //  $('#myModal').modal('s');
           
            $('.message').html(data.message);
           // $("#modal-register-success").modal('show');//you've got empty values
           }
            //$form.yiiActiveForm('resetForm');
            //$form[0].reset();
          
            // Implement successful
        },
        error: function(jqXHR, errMsg) {
            alert(jqXHR);
            alert(errMsg);
        }
     });
     return false; // prevent default submit
});
</script>