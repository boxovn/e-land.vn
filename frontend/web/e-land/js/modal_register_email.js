
$(document).ready(function(){
  var modalRegisterEmail = document.getElementById('modalRegisterEmail');
  modalRegisterEmail.addEventListener('show.bs.modal', function (event) {
  // Button that triggered the modal
  var button = event.relatedTarget
  // Extract info from data-bs-* attributes
  var dataUrl = button.getAttribute('data-url');
  // If necessary, you could initiate an AJAX request here
  // and then do the updating in a callback.
  $('#modalRegisterEmail').find('.modal-content').load(dataUrl);
});

   
modalRegisterEmail.addEventListener('hidden.bs.modal', function (event) {
    $('#modalRegisterEmail').find('.modal-content').html('<div id="modalContent"> <div style="text-align:center"><div class="spinner-border" style="width: 3rem; height: 3rem;" role="status"><span class="visually-hidden">Loading...</span></div></div></div>');
})
  
});




      