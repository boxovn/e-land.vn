<?php
use  yii\helpers\Url;
use yii\helpers\Html;
?>


<form

  action = '<?php echo Url::to(['shopping-cart/get-address'], true);?>'
  method = 'post'
  id = 'form-receiver'
  enctype = 'multipart/form-data'
  class="row g-3 needs-validation" novalidate
  >
  <div style="display:none">
    <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>">
   </div>
  <div class="modal-header">
    <h5 class="modal-title">Thông tin người nhận hàng</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    
  </div>
  <div class="modal-body">
    <div class="row">
      <div class="col-md-12">
       
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Người nhận:</label>
            <input type="text" name="User[name]" class="form-control" value="<?php echo $user->name;?>" id="recipient-name">
          </div>

          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Điện thoại:</label>
            <input type="text" name="User[phone]" class="form-control" value="<?php echo $user->phone;?>" id="recipient-phone">
          </div>

          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Email:</label>
            <input type="text" name="User[email]" class="form-control" value="<?php echo $user->email;?>" id="recipient-email">
          </div>

           <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Địa chỉ:</label>
            <input type="text" name="User[address]" class="form-control" value="<?php echo $user->address;?>" id="recipient-adress">
          </div>

      </div>
    </div>
  </div>
  <div class="modal-footer">
    
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
    
    <button type="submit" id="modal-btn-save" class="btn btn-danger modal-btn-save">
    <i class="fa fa-trash" aria-hidden="true"></i> Lưu</button>
  </div>
</form>

<script type="text/javascript">
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function () {
        'use strict'
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('#form-receiver')
      
        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
          .forEach(function (form) {
            form.addEventListener('submit', function (event) {
              event.preventDefault()
              event.stopPropagation()
              if (!form.checkValidity()) {
                   form.classList.add('was-validated');
                   $("#modalError").modal('show').find('.modal-body').html('Cần nhập đầy đủ thông tin');
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
                                    data = JSON.parse(data);
                                    if(data && data.errors){
                                        $("#modalError").modal('show').find('.modal-body').html(data.errors);
                                      }else{
                                         modalReceiver.hide()
                                       $("#modalSuccess").modal('show').find('.modal-body').html('Cập nhập thông tin thành công');
                                       
                                       $('.shopping-cart .name').html(data.user.name);
                                       $('.shopping-cart .phone').html(data.user.phone);
                                       $('#cart-address').html(data.user.address);
                                    
                                    }
                                  },
                                  error: function(jqXHR, errMsg) {
                                      alert(jqXHR);
                                      alert(errMsg);
                                  }
                              });
              }
      
          
            }, false)
          })
      })()

  </script>
