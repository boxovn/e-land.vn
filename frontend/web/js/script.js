/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {
  $({ property: 0 }).animate(
    { property: 105 },
    {
      duration: 4000,
      step: function () {
        var _percent = Math.round(this.property);
        $("#progress").css("width", _percent + "%");
        if (_percent == 105) {
          $("#progress").addClass("done");
        }
      },
      complete: function () {
        console.log("complete");
      },
    }
  );
});

$(document).ready(function () {
  /* var isMobile = false; //initiate as false
// device detection
if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent) 
    || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) { 
    isMobile = true;
}
if( isMobile){
	$('.w3-sidebar').hide();
	$('.openNav').hide();
}*/
  var theHeight = $(window).height() - $("#nav-bar").height();
  $("#mySidebar").height(theHeight);
  w3_close();
  /*if ($(window).width() < 1200) {
    w3_close();
  } else {
    w3_open();
  }*/
});
$(window).resize(function () {
  var theHeight = $(window).height() - $("#nav-bar").height();
  $("#mySidebar").height(theHeight);
   w3_close();
  /*if ($(window).width() < 218 * 5) {
    w3_close();
  } else {
    w3_open();
  }*/
});
$(document).on("click", ".openNav, .closeNav", function () {
  // var dis = $(this).css("display");
  if ($(this).hasClass("openNav")) {
    w3_open();
    $("#list-user-info").hide();
    $("#list-search").hide();
    $(".openNav").css("display", "none");
    $(".closeNav").css("display", "inline-block");
  }
  if ($(this).hasClass("closeNav")) {
    w3_close();
    $(".openNav").css("display", "inline-block");
    $(".closeNav").css("display", "none");
  }
});

$(document).on("click", ".search, .info", function () {
  var myClass = $(this).hasClass("info");
  var active = $(this).hasClass("active");
  if (active) {
    $(this).removeClass("active");
  } else {
    $(this).addClass("active");
  }

  if (myClass) {
    $(".search").removeClass("active");
    if ($("#list-user-info").css("display") == "none") {
      $("#list-user-info").show();
      $("#list-search").hide();
    } else {
      $("#list-user-info").hide();
    }
  }
  var myClass = $(this).hasClass("search");
  if (myClass) {
    $(".info").removeClass("active");
    if ($("#list-search").css("display") == "none") {
      $("#list-search").show();
      $(".list .item-info .search").focus();
      $("#list-user-info").hide();
    } else {
      $("#list-search").hide();
    }
  }
});

/*
$( window ).resize(function() {
	var theHeight = $(window).height() - 54;
	$("#mySidebar").height(theHeight);
          var main = $(window).width();
         
        if(main>=992){
			if($(window).width()< 238 *5){
				w3_close();
				
		}else{
		
			w3_open();
		}
        }else{
              $('.column').removeClass( "column238" );
                $('#container').removeClass("screenX4").removeClass('screenX5');
        }
   
});
*/
function w3_open() {
  document.getElementById("mySidebar").style.width = "240px";
  document.getElementById("mySidebar").style.display = "block";
  document.getElementById("openNav").style.display = "none";
  document.getElementById("closeNav").style.display = "inline-block";
  //$("#man-topnav").removeClass("scroll-close").addClass('scroll-open');
  // document.getElementById("man-topnav").style.width = "calc(100% - 240px)"; 
   // document.getElementById("man-topnav").style.marginLeft = "240px";
  //document.getElementById("footer").style.marginLeft = "240px";
  var main = $(window).width();
  if (~~(main / 218) == 1) {
    $(".list-box").width("100%");
    document.getElementById("main").style.marginLeft = "0px";
  } else {
    $(".list-box").width(~~((main - 240) / 218) * 218);
    document.getElementById("main").style.marginLeft = "240px";
  }
  //$('.list-box').width((~~((main-240)/218))*218);
  $(".loader").css({ left: (main + 240) / 2 - 15 });
}
function w3_close() {
  document.getElementById("main").style.marginLeft = "0px";
  // document.getElementById("footer").style.marginLeft = "0px";
  document.getElementById("mySidebar").style.display = "none";
  document.getElementById("openNav").style.display = "inline-block";
  document.getElementById("closeNav").style.display = "none";
  document.getElementById("closeNav").style.display = "none";
 // $("#man-topnav").addClass("scroll-close").removeClass('scroll-open');
  //document.getElementById("man-topnav").style.width = "100%"; 
   //document.getElementById("man-topnav").style.marginLeft = "0px";
  
  var main = $(window).width();
  if (~~(main / 218) == 1) {
    $(".list-box").width("100%");
  } else {
    $(".list-box").width(~~(main / 218) * 218);
  }

  $(".loader").css({ left: main / 2 - 15 });
}

// A $( document ).ready() block.
$(document).ready(function () {
  var theHeight = $(window).height() - $("#nav-bar").height();
  $("#mySidebar").height(theHeight);
  $("#q_showr").show();
  $("#q_hidr").hide();
  $("#ct_showr").show();
  $("#ct_hidr").hide();

  $("#qn_showr").show();
  $("#qn_hidr").hide();
  $("#h_showr").show();
  $("#h_hidr").hide();
});

$("#qn_showr").click(function () {
  $("#qn_hidr").show();
  $("#qn_showr").hide();
  $("div.land-item.item1")
    .first()
    .show("fast", function showNext() {
      $(this).next("div").show("fast", showNext);
    });
});

$("#q_showr").click(function () {
  $("#q_hidr").show();
  $("#q_showr").hide();
  $("div.land-item.item2")
    .first()
    .show("fast", function showNext() {
      $(this).next("div").show("fast", showNext);
    });
});

$("#q_hidr").click(function () {
  $("div.land-item.item2").hide(1000);
  $("#q_hidr").hide();
  $("#q_showr").show();
});

$("#qn_hidr").click(function () {
  $("div.land-item.item1").hide(1000);
  $("#qn_hidr").hide();
  $("#qn_showr").show();
});

$("#h_showr").click(function () {
  $("#h_hidr").show();
  $("#h_showr").hide();
  $("div.land-item.item3")
    .first()
    .show("fast", function showNext() {
      $(this).next("div").show("fast", showNext);
    });
});

$("#h_hidr").click(function () {
  $("div.land-item.item3").hide(1000);
  $("#h_hidr").hide();
  $("#h_showr").show();
});

$("#ct_showr").click(function () {
  $("#ct_hidr").show();
  $("#ct_showr").hide();
  $("div.land-item.item")
    .first()
    .show("fast", function showNext() {
      $(this).next("div").show("fast", showNext);
    });
});

$("#ct_hidr").click(function () {
  $("div.land-item.item").hide(1000);
  $("#ct_hidr").hide();
  $("#ct_showr").show();
});
