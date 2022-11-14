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
        <img class="img-logo" src="<?php echo Yii::$app->getUrlManager()->baseUrl?>/e-land/img/logo.png"/>
    </div>
    <h4 class="modal-title">Đăng nhập</h4>
    <button type="button" class="close btn-close" data-bs-dismiss="modal" aria-hidden="true" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form  id="login-form"  action = '<?php echo Url::to(['index-api/login'], true);?>' method = 'post'   enctype = 'multipart/form-data'  class="row g-3 needs-validation" novalidate>
        <div style="display:none">
            <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>">
        </div>
        <div class="col-12">
            <label for="validationEmail" class="form-label">Email</label>
            <div class="input-group has-validation">
                <span class="input-group-text" id="inputGroupPrepend"> <i class="far fa-envelope"></i></span>
                <input  type="email" class="form-control" name="LoginForm[email]" placeHolder="Nhập email" id="validationEmail" aria-describedby="inputGroupPrepend" required>
                <div class="invalid-feedback">
                    Nhập email
                </div>
            </div>
        </div>
        <div class="col-12">
            <label for="validationPassword" class="form-label">Mật khẩu</label>
            <div class="input-group has-validation">
                <span class="input-group-text" id="inputGroupPrepend"> <i class="fas fa-key"></i></span>
                <input  type="password" class="form-control" name="LoginForm[password]" placeHolder="Nhập mật khẩu" id="validationPassword" aria-describedby="inputGroupPrepend" required>
                <div class="invalid-feedback">
                    Nhập mật khẩu
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="gridCheck">
                <label class="form-check-label" for="gridCheck">
                    Check me out
                </label>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group row">
                <button class="btn btn-success mb-3 btn-login"
                
                id="btn-login"
                type="submit"> Đăng nhập</button>
                <a class='text-forget'  href="<?php echo Yii::$app->getUrlManager()->createUrl(['index/forget-password']) ?>">Bạn quên mật khẩu?</a>
            </div>
            
        </div>
        
    </form>
</div>
<div class="modal-footer">
    <a  class='text-forget showRegister'  data-bs-toggle="modal" data-bs-dismiss="modal"  data-bs-target="#modalRegister" data-url="<?php echo Url::to(['home/modal-article-register'],true);?>" id="btn-register">Đăng ký tài khoản</a>
</div>
<?php //$this->registerJsFile(Yii::$app->request->baseUrl.'/e-land/js/modal_login.js',['depends' => [yii\bootstrap\BootstrapAsset::className()]]); ?>
<script>

(function () {
'use strict'
var modalLoginSuccessEl = document.getElementById('modalLoginSuccess');
var modalLoginSuccess = new bootstrap.Modal(modalLoginSuccessEl, {
keyboard: false
})
modalLoginSuccessEl.addEventListener('hidden.bs.modal', function (event) {
modalLogin.hide();
location.reload();
// Button that triggered the modal
});
// Fetch all the forms we want to apply custom Bootstrap validation styles to
var login_forms = document.querySelectorAll('#login-form')
// Loop over them and prevent submission
Array.prototype.slice.call(login_forms)
.forEach(function (form) {
form.addEventListener('submit', function (event) {
event.preventDefault()
//   event.stopPropagation()
if (!form.checkValidity()) {


form.classList.add('was-validated');
}else{

var data = $(this).serialize();
var url = $(this).attr('action');
console.log(data);
console.log(url);

$.ajax({
url: url,
type: 'POST',
data: data,
beforeSend: function(xhr) {
xhr.setRequestHeader('Csrf-Token', $('meta[name="csrf-token"]').attr('content'));
},
success: function (data) {
data = JSON.parse(data);
modalLoginSuccess.show();
$('#modalLoginSuccess').find('.modal-body').html(data.message);


},
error: function(jqXHR, errMsg) {

}
});
}

}, false)
})
})()
</script>