
$(document).ready(function(){

  var modalLanding = document.getElementById('modalLogin');
  modalLanding.addEventListener('show.bs.modal', function (event) {
  // Button that triggered the modal
  var button = event.relatedTarget
  // Extract info from data-bs-* attributes
  var dataUrl = button.getAttribute('data-url');
  // If necessary, you could initiate an AJAX request here
  // and then do the updating in a callback.
  //
  $('#modalLogin').find('.modal-content').load(dataUrl);
})

   
modalLanding.addEventListener('hidden.bs.modal', function (event) {
    $('#modalLogin').find('.modal-content').html('<div id="modalContent"> <div style="text-align:center"> <img src=" https://icon-library.com/images/ajax-loading-icon/ajax-loading-icon-16.jpg"></div></div>');
})
  
});




      