$(function(){

    $(".dropdown-toggle").dropdown();
    

    //get the click of modal button to create / update item
    //we get the button by class not by ID because you can only have one id on a page and you can
    //have multiple classes therefore you can have multiple open modal buttons on a page all with or without
    //the same link.
//we use on so the dom element can be called again if they are nested, otherwise when we load the content once it kills the dom element and wont let you load anther modal on click without a page refresh
                $(document).on('click', '.showLanding', function(){
                    //check if the modal is open. if it's open just reload content not whole modal
                    //also this allows you to nest buttons inside of modals to reload the content it is in
                    //the if else are intentionally separated instead of put into a function to get the 
                    //button since it is using a class not an #id so there are many of them and we need
                    //to ensure we get the right button and content. 
                    if ($('#modalLanding').hasClass('in')) {
                        $('#modalLanding').find('.modal-content').load($(this).attr('data-url'));
                        //dynamiclly set the header for the modal
                    // document.getElementById('modalHeader').innerHTML = '<h4>' + $(this).attr('title') + '</h4>';
                    } else {
                        
                  
                        //if modal isn't open; open it and load content
                        $('#modalLanding').modal('show').find('.modal-content').load($(this).attr('data-url'));
                        window.history.pushState({urlPath: $(this).attr('data-url')}, "", $(this).attr('data-url'));
                        //dynamiclly set the header for the modal
                    //  document.getElementById('modalHeader').innerHTML = '<h4>' + $(this).attr('title') + '</h4>';
                    }
                });
                    
                    $(document).on('click', '.showLogin', function(){
                        //check if the modal is open. if it's open just reload content not whole modal
                    //also this allows you to nest buttons inside of modals to reload the content it is in
                    //the if else are intentionally separated instead of put into a function to get the 
                    //button since it is using a class not an #id so there are many of them and we need
                    //to ensure we get the right button and content. 
                    if ($('#modalLogin').hasClass('in')) {
                        $('#modalLogin').find('.modal-content')
                                .load($(this).attr('data-href'));
                        //dynamiclly set the header for the modal
                        // document.getElementById('modalHeader').innerHTML = '<h4>' + $(this).attr('title') + '</h4>';
                    } else {
                        //if modal isn't open; open it and load content
                        $('#modalLogin').modal('show').find('.modal-content').load($(this).attr('data-href'));
                            //dynamiclly set the header for the modal
                        //  document.getElementById('modalHeader').innerHTML = '<h4>' + $(this).attr('title') + '</h4>';
                    }
                });
                // Add the modal-open class into body element
                $(document).on("hidden.bs.modal","#modalLogin,#modalRegisterError,#modalRegisterSuccess,#modalLoginSuccess", function (e) {
                    $("body").addClass("modal-open");
                });
                function revertToOriginalURL() {
                    window.history.go(-1);
                }
                $(document).on('hidden.bs.modal','#modalLanding', function() {
                    revertToOriginalURL();
                   // location.reload();
                });
                 // Add the modal-open class into body element
                 $(document).on("hidden.bs.modal","#modalLoginSuccess", function (e) {
                     console.log($(location).attr("href"));
                    $('#modalLanding').modal('show').find('.modal-content').load($(location).attr("href"));
                   
                });
                
                // Show the first tab and hide the rest
                $(document).on("click","#register-view-house",function (){
                    $('#modalLanding').animate({
                        scrollTop: $("#form-register-view-house").offset().top
                    }, 2000);
                });
               
              
                var $form = $('#active-form');
                $(document).on('afterValidate','#active-form', function (event, messages, errorAttributes) {
    let data = $(this).data('yiiActiveForm');
    //check if we are in submission process and if there are any errors
   
    if (data.submitting && errorAttributes.length > 0) {
     
      $("#modalRegisterError").modal('show');//you've got empty values
    }
});
$(document).on('beforeSubmit','#active-form',function(e) {
          e.preventDefault();
          var data = $(this).serialize();
          var url = $(this).attr('action');
             $.ajax({
              url: url,
              type: 'POST',
              data: data,
              success: function (data) {
                $(this).reset();
                  $("#modalRegisterSuccess").modal('show');//you've got empty values
              },
              error: function(jqXHR, errMsg) {
                  alert(jqXHR);
                  alert(errMsg);
              }
          });
          return false; // prevent default submit
});

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
  
  
  