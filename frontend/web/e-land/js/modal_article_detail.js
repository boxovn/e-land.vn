
$(document).ready(function(){

  var modalLanding = document.getElementById('modalLanding');
  modalLanding.addEventListener('show.bs.modal', function (event) {
  // Button that triggered the modal
  var button = event.relatedTarget
  // Extract info from data-bs-* attributes
  var dataUrl = button.getAttribute('data-url');
  // If necessary, you could initiate an AJAX request here
  // and then do the updating in a callback.
  //
 
  $('#modalLanding').find('.modal-content').load(dataUrl);
})

   
modalLanding.addEventListener('hidden.bs.modal', function (event) {
    $('#modalLanding').find('.modal-content').html('<div id="modalContent"> <div style="text-align:center"> <img src=" https://icon-library.com/images/ajax-loading-icon/ajax-loading-icon-16.jpg"></div></div>');
})
  
});

            // Show the first tab and hide the rest
$(document).on("click","#register-view-house",function (){
              $('#modalLanding').animate({
                  scrollTop: $("#form-register-view-house").offset().top
              }, 2000);
          });
         
function changeModalContent(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
