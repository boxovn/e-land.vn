// Example starter JavaScript for disabling form submissions if there are invalid fields

(function () {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('#register-view-form')

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        event.preventDefault()
        event.stopPropagation()
        if (!form.checkValidity()) {
             form.classList.add('was-validated');
           modalRegisterError.show();
        }else{
                        var data = $(this).serialize();
                        var url = $(this).attr('data-action');
                        $.ajax({
                            url: url,
                            type: 'POST',
                            data: data,
                            beforeSend: function(xhr) {
                              xhr.setRequestHeader('Csrf-Token', $('meta[name="csrf-token"]').attr('content'));
                          },
                            success: function (data) {
                              data = JSON.parse(data);
                              
                              console.log(data);
                                if(data && data.errors){
                                  
                                  /*data.errors.forEach(element => {
                                      console.log(element);
                                  });*/
                               //   modalRegisterError.show();
                            //   modalRegisterError.show();
                           //    $('#modalRegisterError').find('.modal-body').html(data.errors);
                           
                             
                             //    $("#modalRegisterError").modal('show').find('.modal-content p').html(data.errors);
                                }else{
                                  //    $('#active-form')[0].reset();
                                modalRegisterSuccess.show();
                              
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
