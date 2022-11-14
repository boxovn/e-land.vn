
  		// A $( document ).ready() block.
$( document ).ready(function() {
	//var theHeight = $(window).height() - 52;
	//$("#mySidebar").height(theHeight);
   $( "#q_showr" ).show();
   $( "#q_hidr" ).hide();
   $( "#ct_showr" ).show();
   $( "#ct_hidr" ).hide();

    $( "#qn_showr" ).show();
   $( "#qn_hidr" ).hide();
    $( "#h_showr" ).show();
   $( "#h_hidr" ).hide();
   
});



$( "#qn_showr" ).click(function() {
$( "#qn_hidr" ).show();
$( "#qn_showr" ).hide();
  $( "div.land-item.item1" ).first().show( "fast", function showNext() {
    $( this ).next( "div" ).show( "fast", showNext );
  });
  
});



$( "#q_showr" ).click(function() {
$( "#q_hidr" ).show();
$( "#q_showr" ).hide();
  $( "div.land-item.item2" ).first().show( "fast", function showNext() {
    $( this ).next( "div" ).show( "fast", showNext );
  });
  
});



$( "#q_hidr" ).click(function() {
  $( "div.land-item.item2" ).hide( 1000 );
   $( "#q_hidr" ).hide();
$( "#q_showr" ).show();
});


$( "#qn_hidr" ).click(function() {
  $( "div.land-item.item1" ).hide( 1000 );
   $( "#qn_hidr" ).hide();
$( "#qn_showr" ).show();
});



$( "#h_showr" ).click(function() {
$( "#h_hidr" ).show();
$( "#h_showr" ).hide();
  $( "div.land-item.item3" ).first().show( "fast", function showNext() {
    $( this ).next( "div" ).show( "fast", showNext );
  });
  
});

$( "#h_hidr" ).click(function() {
  $( "div.land-item.item3" ).hide( 1000 );
   $( "#h_hidr" ).hide();
$( "#h_showr" ).show();
});


$( "#ct_showr" ).click(function() {
$( "#ct_hidr" ).show();
$( "#ct_showr" ).hide();
  $( "div.land-item.item" ).first().show( "fast", function showNext() {
    $( this ).next( "div" ).show( "fast", showNext );
  });
  
});

$( "#ct_hidr" ).click(function() {
  $( "div.land-item.item" ).hide( 1000 );
   $( "#ct_hidr" ).hide();
$( "#ct_showr" ).show();
});

 

    function w3_open() {
        document.getElementById("mySidebar").style.display = "block";
        document.getElementById("myOverlay").style.display = "block";
        document.getElementById("mySidebar").style.width = "240px";
        document.getElementById("closeNav").style.display = "block";
        document.getElementById("openNav").style.display = "none";
    }
    function w3_close() {
        document.getElementById("mySidebar").style.display = "none";
        document.getElementById("myOverlay").style.display = "none";
        document.getElementById("closeNav").style.display = "none";
        document.getElementById("openNav").style.display = "block";
        
    }

    var slideIndex = 1;
    showDivs(slideIndex);

    function plusDivs(n) {
        showDivs(slideIndex += n);
    }

    function currentDiv(n) {
        showDivs(slideIndex = n);
    }

    function showDivs(n) {
        var i;
        var x = document.getElementsByClassName("mySlides");
        var dots = document.getElementsByClassName("demo");
        if (n > x.length) {
            slideIndex = 1
        }
        if (n < 1) {
            slideIndex = x.length}
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" w3-opacity-off", "");
        }
        x[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].className += " w3-opacity-off";
    }
    var slideIndex = 1;
    showDivs(slideIndex);

    function plusDivs(n) {
        showDivs(slideIndex += n);
    }

    function currentDiv(n) {
        showDivs(slideIndex = n);
    }

    function showDivs(n) {
        var i;
        var x = document.getElementsByClassName("mySlides");
        var dots = document.getElementsByClassName("demo");
        if (n > x.length) {
            slideIndex = 1
        }
        if (n < 1) {
            slideIndex = x.length;
        }
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" w3-white", "");
        }
        x[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].className += " w3-white";
    }    