<?php
use yii\helpers\Html;
use  yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use common\modals\province;
yii\bootstrap\BootstrapPluginAsset::register($this);
$session = Yii::$app->session;
?>
<!-- Modal HTML -->
<div class="modal-header">
    <div class="block-logo">
        <img class="img-logo" src="https://e-land.vn/e-land/img/logo.png">
    </div>
    <button type="button" class="close btn-close" data-bs-dismiss="modal" aria-hidden="true" aria-label="Close"></button>
</div>
<div class="modal-body">
    <div class="container">
        <p class="text-center">Hãy để chúng tôi liên hệ với bạn! <br/>Giúp bạn tìm kiếm BĐS theo tiêu chí. Nhận thông tin sản phẩm qua email mỗi ngày</p>
        
        <form   action = '<?php echo Url::to(['home/modal-register-email'], true);?>' method = 'post'  id = 'register-email-form'  enctype = 'multipart/form-data'  class="row g-3" novalidate>
            <div style="display:none">
                <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>">
            </div>
            <div class="col-12 text-center">
                    <?php foreach($categories as $key => $value){?>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" <?php echo $key==0?"checked=true":"";?>  name="UserRegisterEmail[category_id][]" type="checkbox" id="inlineRadio<?php echo $key;?>" value="<?php echo $value->id;?>">
                    <label class="form-check-label" for="inlineRadio<?php echo $key;?>"><?php echo $value->title;?></label>
                </div>
            <?php }?>
               

            </div>
            <div class="col-6">
                <label for="article-name" class="form-label">Họ tên</label>
                <div class="input-group has-validation">
                    <span class="input-group-text" id="inputGroupPrepend"> <i class="fas fa-user"></i></span>
                    <input  type="text" class="form-control" name="UserRegisterEmail[name]" placeHolder="Nhập tên" id="article-name" value="<?php echo $userRegisterEmail->name;?>" aria-describedby="inputGroupPrepend">
                    <div id="validationServer-name" class="invalid-feedback">
                        Nhập họ tên
                    </div>
                </div>
            </div>
            <div class="col-6">
                <label for="article-phone" class="form-label">Số điện thoại</label>
                <div class="input-group has-validation">
                    <span class="input-group-text" id="inputGroupPrepend"> <i class="fas fa-phone"></i></span>
                    <input  type="text" class="form-control" value="<?php echo $userRegisterEmail->phone;?>" name="UserRegisterEmail[phone]" placeHolder="Nhập số điên thoại" id="article-phone" aria-describedby="inputGroupPrepend">
                    <div id="validationServer-phone" class="invalid-feedback">
                        Nhập số điện thoại
                    </div>
                </div>
            </div>
            <div class="col-6">
                <label for="article-email" class="form-label">Email</label>
                <div class="input-group has-validation">
                    <span class="input-group-text" id="inputGroupPrepend"> <i class="far fa-envelope"></i></span>
                    <input  type="email" class="form-control" value="<?php echo $userRegisterEmail->email;?>" name="UserRegisterEmail[email]" placeHolder="Nhập email" id="article-email" aria-describedby="inputGroupPrepend">
                    <div id="validationServer-email" class="invalid-feedback">
                        Nhập email
                    </div>
                </div>
            </div>
            <div class="col-6">
                <label for="article-category_type" class="form-label">Loại hình </label>
                <div class="input-group has-validation">
                    <span class="input-group-text" id="inputGroupPrepend"> <i class="fas fa-home"></i></span>
                    <select name="UserRegisterEmail[category_type_id]" class="form-select" id="article-category_type_id">
                        <option selected disabled value="">Loại hình</option>
                        <?php
                        foreach($categoryTypes as $key => $value){?>
                        <option   value="<?php echo $value->id;?>"><?php echo  $value->title;?></option>
                        <?php }?>
                    </select>
                    <div  id="validationServer-cateogry_type_id" class="invalid-feedback">
                        Chọn loại hình
                    </div>
                </div>
            </div>
            <div class="col-6">
                <label for="article-province_id" class="form-label">Tỉnh/Thành</label>
                <select name="UserRegisterEmail[province_id]" class="form-select" id="article-province_id">
                    <option selected disabled value="">Tỉnh/Thành phố</option>
                    <?php
                    foreach($provinces as $key => $value){?>
                    <option  <?php echo ($value->province_id==$session->get('province_id') && $session->get('province_id')!=0)? 'selected':'';?>  value="<?php echo $value->province_id;?>"><?php echo  $value->name;?></option>
                    <?php }?>
                </select>
                <div id="validationServer-province_id" class="invalid-feedback">
                    Chọn tỉnh thành
                </div>
            </div>
            <div class="col-6">
                <label for="article-district_id" class="form-label">Quận/Huyện</label>
                <select name="UserRegisterEmail[district_id]" class="form-select" id="article-district_id">
                    <option selected disabled value="">Quận/Huyện</option>
                    <?php foreach($districts as $key => $value){?>
                    <option value="<?php echo $value->district_id;?>"><?php echo  $value->type;?> <?php echo  $value->name;?></option>
                    <?php }?>
                </select>
                <div id="validationServer-district_id" class="invalid-feedback">
                    Chọn Quận/Huyện
                </div>
            </div>
            <div class="col-12">
                <div class="form-group row">
                    <button class="btn btn-success mb-3 btn-login"
                    id="btn-login"
                    type="submit">Nhận qua email</button>
                    
                </div>
                
            </div>
            
        </form>
    </div>
</div>
<?php //$this->registerJsFile(Yii::$app->request->baseUrl.'/e-land/js/modal_login.js',['depends' => [yii\bootstrap\BootstrapAsset::className()]]); ?>
<script>
(function () {
'use strict'

/*var modalRegisterEmailEL = document.getElementById('modalRegisterEmail');
var modalRegisterEmail = new bootstrap.Modal(modalRegisterEmailEL, {
keyboard: false
})
modalRegisterEmailEL.addEventListener('hidden.bs.modal', function (event) {
    
// Button that triggered the modal
});*/
// Fetch all the forms we want to apply custom Bootstrap validation styles to
var registerEmailForm= document.querySelectorAll('#register-email-form')
// Loop over them and prevent submission
            Array.prototype.slice.call(registerEmailForm)
            .forEach(function (form) {
            form.addEventListener('submit', function (event) {
            event.preventDefault()
                //   event.stopPropagation()
            if (!form.checkValidity()) {
                        form.classList.add('was-validated');
            }else{
            var data = $(this).serialize();
            var url = $(this).attr('action');

            $.ajax({
                        url: url,
                        type: 'POST',
                        data: data,
                        beforeSend: function(xhr) {
                        xhr.setRequestHeader('Csrf-Token', $('meta[name="csrf-token"]').attr('content'));
                        },
                        success: function (data) {
                          // data = JSON.parse(data);

                            

                               // modalRegisterEmail.hide();
                                    if(data && data.errors.length > 0){
                                           data.errors.forEach(function(value,key){
                                                 console.log(value,key);
                                             document.getElementById("article-" + value.field).classList.add("is-invalid");
                                              document.getElementById("article-" + value.field).setAttribute("required", '');
                                             document.getElementById("validationServer-" + value.field).innerHTML=value.message;
                                          
                                          });
                                      }else{
                                            modalRegisterEmail.hide();
                                            alert('Đăng ký nhận tin thành công!');
                                             // modalRegisterSuccess.show();
                                             // $('#modalRegisterSuccess').find('.modal-body').html('Đăng tin rao bán Bđs thành công!');
                                                document.getElementById("register-email-form").reset();
                                        
                                    }
                        },
                        error: function(jqXHR, errMsg) {
                        }
            });
            }
            }, false)
        })

$('select[name="UserRegisterEmail[province_id]"]').on('change', function() {
    var provinceId = $(this).val();
   if(provinceId > 0){
    $.ajax({
        type: 'get',
        url: $(location).attr("origin") + '/home-api/districts',
        data: {province_id : provinceId },
        dataType: 'json',
        success: function (data) {
            $('#article-district_id').find('option')
                    .remove()
                    .end();
            $('#article-district_id')
                    .append($("<option></option>")
                    .attr("value",'')
                    .text('* Quận/Huyện'));         
            $.each(data.districts, function (i, item) {
                    $('#article-district_id')
                    .append($("<option></option>")
                    .attr("value",item.district_id)
                    .text(item.name)); 
            });
            $('select[name="Article[district_id]"]').attr('disabled',false);
        }
    });
    }else{
            $('#article-district_id').find('option')
                    .remove()
                    .end();
            $('#article-district_id')
                    .append($("<option></option>")
                    .attr("value",'')
                    .text('* Quận/Huyện')); 
        $('select[name="UserRegisterEmail[district_id]"]').attr('disabled',true);
    }
});
})()
</script>