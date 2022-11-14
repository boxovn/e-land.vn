<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>

<style>

.modal-login {		
	color: #636363;
	width: 350px;
}
.modal-login .modal-content {
	padding: 20px;
	border-radius: 5px;
	border: none;
}
.modal-login .modal-header {
	border-bottom: none;   
	position: relative;
	justify-content: center;
}
.modal-login h4 {
	text-align: center;
	font-size: 26px;
	margin: 30px 0 -15px;
}
.modal-login .form-control:focus {
	border-color: #70c5c0;
}
.modal-login .form-control, .modal-login .btn {
	min-height: 40px;
	border-radius: 3px; 
}
.modal-login .close {
	position: absolute;
	top: -5px;
	right: -5px;
}	
.modal-login .modal-footer {
	
	text-align: center;
	justify-content: center;
	margin: 0;
	border-radius: 5px;
	font-size: 14px;
    border-top:0px;
    padding : 0px;
}
.modal-login .modal-footer a {
	color: #7777;
}		
.modal-login .avatar {
	position: absolute;
	margin: 0 auto;
	left: 0;
	right: 0;
	top: -70px;
	width: 95px;
	height: 95px;
	border-radius: 50%;
	z-index: 9;
	background: #fff;
	padding: 15px;
	box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
}
.modal-login .avatar img {
	width: 100%;
}
.modal-login.modal-dialog {
	margin-top: 80px;
}
.modal-login .btn, .modal-login .btn:active {
	color: #fff;
	border-radius: 4px;
	background: #c00 !important;
	text-decoration: none;
	transition: all 0.4s;
	line-height: normal;
	border: none;
    text-transform: uppercase;
    font-size: 14px;
}
.modal-login .btn:hover, .modal-login .btn:focus {
	background: #c11 !important;
	outline: none;
}
.modal-login .form-group{
    float: none;
    width: auto;
}
.modal-login .text-forget {
     font-size: 13px; 
    font-weight: bold;
    margin: 10px 0px;
    float: right;
}
.modal-login .message{
    padding: 10px 0px 0px;
    color: #c00;
}
.trigger-btn {
	display: inline-block;
	margin: 100px auto;
}

.modal-confirm {		
	color: #636363;
	width: 425px;
	font-size: 14px;
}
.modal-confirm .modal-content {
	padding: 20px;
	border-radius: 5px;
	border: none;
}
.modal-confirm .modal-header {
	border-bottom: none;   
	position: relative;
}
.modal-confirm h4 {
	text-align: center;
	font-size: 26px;
	margin: 30px 0 -15px;
}
.modal-confirm .form-control, .modal-confirm .btn {
	min-height: 40px;
	border-radius: 3px; 
}
.modal-confirm .close {
	position: absolute;
	top: -5px;
	right: -5px;
}	
.modal-confirm .modal-footer {
	border: none;
	text-align: center;
	border-radius: 5px;
	font-size: 13px;
}	
.modal-confirm .icon-box {
	color: #fff;		
	position: absolute;
	margin: 0 auto;
	left: 0;
	right: 0;
	top: -70px;
	width: 95px;
	height: 95px;
	border-radius: 50%;
	z-index: 9;
	background: #fff;
	padding: 15px;
	text-align: center;
	box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
}
.modal-confirm .icon-box i {
	font-size: 58px;
	position: relative;
	top: 3px;
}
.modal-confirm.modal-dialog {
	margin-top: 80px;
}
.modal-confirm .btn {
	color: #fff;
	border-radius: 4px;
	background: #c00;
	text-decoration: none;
	transition: all 0.4s;
	line-height: normal;
	border: none;
}
.modal-confirm .btn:hover, .modal-confirm .btn:focus {
	background: #6fb32b;
	outline: none;
}
.trigger-btn {
	display: inline-block;
	margin: 100px auto;
}
</style>
<!-- Modal HTML -->
<div id="myModalLoginDialog" class="modal fade">
	<div class="modal-dialog modal-login">
		<div class="modal-content">
                <div class="modal-header">
                    <div class="avatar">
                        <img src="https://e-land.vn/images/logo.png" alt="Avatar">
                    </div>				
                    <h4 class="modal-title">Đăng nhập</h4>	
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
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
                        echo $form->field($loginForm, 'email', ['options' => ['class' => 'form-group row'],
                            'template' => "<div>{label}\n{input}\n{error}</div>",
                        ])->textInput(array('placeholder' => 'Email'))->label(false);
                        ?>
                        <?php
                        echo $form->field($loginForm, 'password', ['options' => ['class' => 'form-group row'],
                            'template' => "<div>{label}\n{input}\n{error}</div>",
                        ])->passwordInput(array('placeholder' => 'Mật khẩu'))->label(false);
                        ?> 
                    <div class='message'>

                    </div>
                        <div class="form-group row">
                            <button class="btn btn-sm btn-danger btn-block btn-login"  id="btn-login" 
                            type="submit"> Đăng nhập</button>
                            <a class='text-forget' href="<?php echo Yii::$app->getUrlManager()->createUrl(['index/forget-password']) ?>">Bạn quên mật khẩu?</a>
                        </div>
                  
                    <?php ActiveForm::end(); ?>
                </div>
                <div class="modal-footer">
                    <a href="#">Đăng ký tài khoản</a>
                </div>
<!-- Modal -->
		</div>
	</div>
</div>

<div id="myModalLoginDialogSuccess" class="modal fade">
	<div class="modal-dialog modal-confirm modal-success">
		<div class="modal-content">
			<div class="modal-header">
				<div class="icon-box">
					 <img src="https://e-land.vn/images/logo.png" alt="Avatar">
				</div>				
				<h4 class="modal-title w-100">Đăng nhập thành công!</h4>	
			</div>
			<div class="modal-body">
				<p class="text-center">Bây giờ anh/chị có thể đăng tin, bình luận và trao đổi với người đăng tin rao bán bất động sản.</p>
			</div>
			<div class="modal-footer">
				<button class="btn btn-success btn-block" data-dismiss="modal">OK</button>
			</div>
		</div>
	</div>
</div>          

<script>
$('.btn-chat-login').on('click',function(event){
    $('#myModalLoginDialog').modal('show');
});

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
            $('#myModalLoginDialog').modal('hide');
            $('#myModalLoginDialogSuccess').modal('show');
          //    location.reload();  
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