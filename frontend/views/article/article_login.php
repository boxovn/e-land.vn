<?php
use yii\helpers\Html;
use  yii\bootstrap\ActiveForm;
use yii\helpers\Url;
yii\bootstrap\BootstrapPluginAsset::register($this);
?>
<?php //$this->registerCSSFile(Yii::$app->request->baseUrl . '/css/model-login.css'); ?>

<!-- Modal HTML -->

                <div class="modal-header">
                    <div class="avatar">
                        <img src="https://e-land.vn/images/logo.png" alt="Avatar">
                    </div>				
                    <h4 class="modal-title">Đăng nhập</h4>	
                    <button type="button" class="close btn-close" data-bs-dismiss="modal" aria-hidden="true" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php $form = ActiveForm::begin([
                                    'id' => 'loginForm',
                                    'action' => false,
                                    'options' => ['class' => 'form-login'],
                                    'fieldConfig' => [
                                        'options' => ['class' => 'form-group row'],
                                    ],
                                
                        ]);
                        ?>
                        <?php
                        echo $form->field($loginForm, 'email', ['options' => ['class' => 'mb-3 row'],
                            'template' => "<div>{label}\n{input}\n{error}</div>",
                        ])->textInput(array('placeholder' => 'Email'))->label(false);
                        ?>
                        <?php
                        echo $form->field($loginForm, 'password', ['options' => ['class' => 'mb-3 row'],
                            'template' => "<div>{label}\n{input}\n<div class='invalid-feedback'>{error}</div></div>",
                        ])->passwordInput(array('placeholder' => 'Mật khẩu'))->label(false);
                        ?> 
                    <div class='message'>

                    </div>
                        <div class="form-group row">
                            <button class="btn btn-sm btn-danger btn-block btn-login"  id="btn-login" 
                            type="submit"> Đăng nhập</button>
                            <a class='text-forget'  href="<?php echo Yii::$app->getUrlManager()->createUrl(['index/forget-password']) ?>">Bạn quên mật khẩu?</a>
                        </div>
                  
                    <?php ActiveForm::end(); ?>
                </div>
                <div class="modal-footer">
                    <a  class='text-forget showRegister' data-url="<?php echo Url::to(['article/article-register'],true);?>" id="btn-register">Đăng ký tài khoản</a>
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