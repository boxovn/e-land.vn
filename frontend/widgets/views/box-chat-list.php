<script>
            //this function can remove a array element.
            Array.remove = function(array, from, to) {
                var rest = array.slice((to || from) + 1 || array.length);
                array.length = from < 0 ? array.length + from : from;
                return array.push.apply(array, rest);
            };
        
            //this variable represents the total number of popups can be displayed according to the viewport width
            var total_popups = 0;
            
            //arrays of popups ids
            var popups = [];
        
            //this is used to close a popup
            function close_popup(id)
            {
                for(var iii = 0; iii < popups.length; iii++)
                {
                    if(id == popups[iii])
                    {
                        Array.remove(popups, iii);
                        
                        document.getElementById(id).style.display = "none";
                         $('#'+ id).remove();
                        calculate_popups();
                        
                        return;
                    }
                }   
            }
        
            //displays the popups. Displays based on the maximum number of popups that can be displayed on the current viewport width
            function display_popups()
            {
                var right = 220;
                
                var iii = 0;
                for(iii; iii < total_popups; iii++)
                {
                    if(popups[iii] != undefined)
                    {
                        var element = document.getElementById(popups[iii]);
                        element.style.right = right + "px";
                        right = right + 320;
                        element.style.display = "block";
                    }
                }
                
                for(var jjj = iii; jjj < popups.length; jjj++)
                {
                    var element = document.getElementById(popups[jjj]);
                    element.style.display = "none";
                }
            }
            
            //creates markup for a new popup. Adds the id to popups array.
            function register_popup(teacher_id,student_id, name,room)
            {
                
                for(var iii = 0; iii < popups.length; iii++)
                {   
                    //already registered. Bring it to front.
                    if(room == popups[iii])
                    {
                        Array.remove(popups, iii);
                    
                        popups.unshift(room);
                        
                        calculate_popups();
                        
                        
                        return;
                    }
                } 
                var element = '<div class="popup-box chat-popup" id="'+ room +'">';
                element = element + '<div class="popup-head">';
                element = element + '<div class="popup-head-left">'+ name +'</div>';
                element = element + '<div class="popup-head-right"><a href="javascript:close_popup(\''+ room +'\');">&#10005;</a></div>';
                element = element + '<div style="clear: both"></div></div><div class="popup-messages">';
                element = element + '<div class="loader" id="wait_' + room + '" style="display:block;"></div>';
                element = element + '<iframe id="iframe_' + room + '" width="300" height="300"  frameBorder="0" src="https://e-space.vn:90/block/student/'+ student_id +'/teacher_id/' + teacher_id + '">';
                element = element +'</iframe>';
                element = element + '</div></div>';
                    document.getElementsByTagName("body")[0].innerHTML = document.getElementsByTagName("body")[0].innerHTML + element;  
                    beforeload = (new Date()).getTime();
                    document.getElementById('iframe_' + room).onload = function() {
                    document.getElementById("wait_" + room).style.display = "none";
                    pageloadingtime(beforeload);
                };
                    document.getElementById('iframe_' + room).contentWindow.onerror=function() {
                        document.getElementById('iframe_' + room).src="https://batdongsaneland.com/empty.html";
                             document.getElementById("wait_" + room).style.display = 'block';
                            return false;
                    };
                 popups.unshift(room);
                   
                calculate_popups();
                
            }
            
           
            function pageloadingtime(beforeload){
                //calculate the current time in afterload
                afterload = (new Date()).getTime();
                // now use the beforeload and afterload to calculate the seconds
                secondes = (afterload-beforeload)/1000;
                console.log("You Page Load took " + secondes );

            }
            
            //calculate the total number of popups suitable and then populate the toatal_popups variable.
            function calculate_popups()
            {
                var width = window.innerWidth;
                if(width < 540)
                {
                    total_popups = 0;
                }
                else
                {
                    width = width - 200;
                    //320 is width of a single popup box
                    total_popups = parseInt(width/320);
                }
                
                display_popups();
                
            }
        //recalculate when window is loaded and also when window is resized.
            window.addEventListener("resize", calculate_popups);
            window.addEventListener("load", calculate_popups);
            
        </script>

        <div id="sidepanel" class="minimize" style="height: 155px; display: block; right: 0px; bottom: 0px;">
            <div id="profile">
			  <div onclick="zoom();" data-zoom="false" class="spin-icon">
                    <i class="fa fa-arrow-circle-left" aria-hidden="true"></i>
               </div>
                
			<div class="wrap">
				<img id="profile-img_19108" src="../../avatar/student/19108.jpg" alt="" class="online">
				<p>Dương Trần Hà</p>
				<div id="status-options">
					<ul>
						<li id="status-online" class="active"><span class="status-circle"></span> <p>Online</p></li>
						<li id="status-away"><span class="status-circle"></span> <p>Away</p></li>
						<li id="status-busy"><span class="status-circle"></span> <p>Busy</p></li>
						<li id="status-offline"><span class="status-circle"></span> <p>Offline</p></li>
					</ul>
                                    <input id="id" class="text" type="hidden" value="19108">
                                    <input id="name" class="text" type="hidden" value="Dương Trần Hà">
                                    <input id="status_19108" class="text" type="hidden" value="online">
                                    <input id="user" class="text" type="hidden" value="student">
                                </div>
			</div>
		</div>
                               
               <div id="contacts">
			<ul>
                                                                                                <li onclick="register_popup(18,19108,'BICHPHAM','18_19108');" class="contact" data-teacher_id="18">
					<div class="wrap">
						<span id="status_18" class="contact-status offline"></span>
                                                <span id="notification_minimize_18_19108"></span>
                                                <input class="teacher text" type="hidden" name="teacher[]" value="18">
						<img src="https://e-space.vn/avatar/teacher/18.jpg" alt="">
						<div class="meta">
							<p class="name">BICHPHAM</p>
                                                        <p class="preview" id="notification_18_19108">...</p>
						</div>
					</div>
				</li>
                    <li onclick="register_popup(21,19108,'HOAIAN','21_19108');" class="contact" data-teacher_id="21">
					<div class="wrap">
						<span id="status_21" class="contact-status offline"></span>
                                                <span id="notification_minimize_21_19108"></span>
                                                <input class="teacher text" type="hidden" name="teacher[]" value="21">
						<img src="https://e-space.vn/avatar/teacher/21.jpg" alt="">
						<div class="meta">
							<p class="name">HOAIAN</p>
                                                        <p class="preview" id="notification_21_19108">...</p>
						</div>
					</div>
				</li>
                    <li onclick="register_popup(27,19108,'EMMA','27_19108');" class="contact" data-teacher_id="27">
					<div class="wrap">
						<span id="status_27" class="contact-status offline"></span>
                                                <span id="notification_minimize_27_19108"></span>
                                                <input class="teacher text" type="hidden" name="teacher[]" value="27">
						<img src="https://e-space.vn/avatar/teacher/27.jpg" alt="">
						<div class="meta">
							<p class="name">EMMA</p>
                                                        <p class="preview" id="notification_27_19108">...</p>
						</div>
					</div>
				</li>
                 <li onclick="register_popup(73,19108,'JOHAN','73_19108');" class="contact" data-teacher_id="73">
					<div class="wrap">
						<span id="status_73" class="contact-status online"></span>
                                                <span id="notification_minimize_73_19108"></span>
                                                <input class="teacher text" type="hidden" name="teacher[]" value="73">
						<img src="https://e-space.vn/avatar/teacher/73.jpg" alt="">
						<div class="meta">
							<p class="name">JOHAN</p>
                                                        <p class="preview" id="notification_73_19108">...</p>
						</div>
					</div>
				</li>
                        <li onclick="register_popup(84,19108,'KIMNGUYEN','84_19108');" class="contact" data-teacher_id="84">
					<div class="wrap">
						<span id="status_84" class="contact-status"></span>
                                                <span id="notification_minimize_84_19108"></span>
                                                <input class="teacher text" type="hidden" name="teacher[]" value="84">
						<img src="https://e-space.vn/avatar/teacher/84.jpg" alt="">
						<div class="meta">
							<p class="name">KIMNGUYEN</p>
                                                        <p class="preview" id="notification_84_19108">...</p>
						</div>
					</div>
				</li>
                 <li onclick="register_popup(87,19108,'CAROL','87_19108');" class="contact" data-teacher_id="87">
					<div class="wrap">
						<span id="status_87" class="contact-status"></span>
                                                <span id="notification_minimize_87_19108"></span>
                                                <input class="teacher text" type="hidden" name="teacher[]" value="87">
						<img src="https://e-space.vn/avatar/teacher/87.jpg" alt="">
						<div class="meta">
							<p class="name">CAROL</p>
                                                        <p class="preview" id="notification_87_19108">...</p>
						</div>
					</div>
				</li>
                                 <li onclick="register_popup(102,19108,'PEARL','102_19108');" class="contact" data-teacher_id="102">
					<div class="wrap">
						<span id="status_102" class="contact-status offline"></span>
                                                <span id="notification_minimize_102_19108"></span>
                                                <input class="teacher text" type="hidden" name="teacher[]" value="102">
						<img src="https://e-space.vn/avatar/teacher/102.jpg" alt="">
						<div class="meta">
							<p class="name">PEARL</p>
                                                        <p class="preview" id="notification_102_19108">...</p>
						</div>
					</div>
				</li>
                     <li onclick="register_popup(108,19108,'BEN','108_19108');" class="contact" data-teacher_id="108">
					<div class="wrap">
						<span id="status_108" class="contact-status offline"></span>
                                                <span id="notification_minimize_108_19108"></span>
                                                <input class="teacher text" type="hidden" name="teacher[]" value="108">
						<img src="https://e-space.vn/avatar/teacher/108.jpg" alt="">
						<div class="meta">
							<p class="name">BEN</p>
                                                        <p class="preview" id="notification_108_19108">...</p>
						</div>
					</div>
				</li>
                     <li onclick="register_popup(114,19108,'NHUNGUYEN','114_19108');" class="contact" data-teacher_id="114">
					<div class="wrap">
						<span id="status_114" class="contact-status offline"></span>
                                                <span id="notification_minimize_114_19108"></span>
                                                <input class="teacher text" type="hidden" name="teacher[]" value="114">
						<img src="https://e-space.vn/avatar/teacher/114.jpg" alt="">
						<div class="meta">
							<p class="name">NHUNGUYEN</p>
                                                        <p class="preview" id="notification_114_19108">...</p>
						</div>
					</div>
				</li>
                <li onclick="register_popup(127,19108,'JANE','127_19108');" class="contact" data-teacher_id="127">
					<div class="wrap">
						<span id="status_127" class="contact-status offline"></span>
                                                <span id="notification_minimize_127_19108"></span>
                                                <input class="teacher text" type="hidden" name="teacher[]" value="127">
						<img src="https://e-space.vn/avatar/teacher/127.jpg" alt="">
						<div class="meta">
							<p class="name">JANE</p>
                                                        <p class="preview" id="notification_127_19108">...</p>
						</div>
					</div>
				</li>
                <li onclick="register_popup(128,19108,'EVELYN','128_19108');" class="contact" data-teacher_id="128">
					<div class="wrap">
						<span id="status_128" class="contact-status offline"></span>
                                                <span id="notification_minimize_128_19108"></span>
                                                <input class="teacher text" type="hidden" name="teacher[]" value="128">
						<img src="https://e-space.vn/avatar/teacher/128.jpg" alt="">
						<div class="meta">
							<p class="name">EVELYN</p>
                                                        <p class="preview" id="notification_128_19108">...</p>
						</div>
					</div>
				</li>
                <li onclick="register_popup(136,19108,'RAF','136_19108');" class="contact" data-teacher_id="136">
					<div class="wrap">
						<span id="status_136" class="contact-status online"></span>
                                                <span id="notification_minimize_136_19108"></span>
                                                <input class="teacher text" type="hidden" name="teacher[]" value="136">
						<img src="https://e-space.vn/avatar/teacher/136.jpg" alt="">
						<div class="meta">
							<p class="name">RAF</p>
                                                        <p class="preview" id="notification_136_19108">...</p>
						</div>
					</div>
				</li>
                         <li onclick="register_popup(147,19108,'IVY','147_19108');" class="contact" data-teacher_id="147">
					<div class="wrap">
						<span id="status_147" class="contact-status offline"></span>
                                                <span id="notification_minimize_147_19108"></span>
                                                <input class="teacher text" type="hidden" name="teacher[]" value="147">
						<img src="https://e-space.vn/avatar/teacher/147.jpg" alt="">
						<div class="meta">
							<p class="name">IVY</p>
                                                        <p class="preview" id="notification_147_19108">...</p>
						</div>
					</div>
				</li>
                <li onclick="register_popup(161,19108,'PHUONGHOANG','161_19108');" class="contact" data-teacher_id="161">
					<div class="wrap">
						<span id="status_161" class="contact-status offline"></span>
                                                <span id="notification_minimize_161_19108"></span>
                                                <input class="teacher text" type="hidden" name="teacher[]" value="161">
						<img src="https://e-space.vn/avatar/teacher/161.jpg" alt="">
						<div class="meta">
							<p class="name">PHUONGHOANG</p>
                                                        <p class="preview" id="notification_161_19108">...</p>
						</div>
					</div>
				</li>
                    <li onclick="register_popup(167,19108,'VANVU','167_19108');" class="contact" data-teacher_id="167">
					<div class="wrap">
						<span id="status_167" class="contact-status offline"></span>
                                                <span id="notification_minimize_167_19108"></span>
                                                <input class="teacher text" type="hidden" name="teacher[]" value="167">
						<img src="https://e-space.vn/avatar/teacher/167.jpg" alt="">
						<div class="meta">
							<p class="name">VANVU</p>
                                                        <p class="preview" id="notification_167_19108">...</p>
						</div>
					</div>
				</li>
                <li onclick="register_popup(180,19108,'JULIE','180_19108');" class="contact" data-teacher_id="180">
					<div class="wrap">
						<span id="status_180" class="contact-status offline"></span>
                                                <span id="notification_minimize_180_19108"></span>
                                                <input class="teacher text" type="hidden" name="teacher[]" value="180">
						<img src="https://e-space.vn/avatar/teacher/180.jpeg" alt="">
						<div class="meta">
							<p class="name">JULIE</p>
                                                        <p class="preview" id="notification_180_19108">...</p>
						</div>
					</div>
				</li>
                                    							</ul>
		</div>
		<div id="bottom-bar">
                    <button onclick="w3_close();" title="Đóng" id="idClose" style="float: left; width: 100%; padding: 10px 0px; display: none;"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
                    <button onclick="w3_open();" title="Mở" style="float: left; width: 100%; padding: 10px 0px;" id="idOpen"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></button>
                  
		</div>
	</div>
        
<script>
	
	function openCallTeacher(urlKey) {
		//var url = "https://call.e-space.vn:8443/#/auto/" + key;
		var size = '"width=' + window.innerWidth + 'px, ' + 'height=' + window.innerHeight + 'px"';
		window.open(urlKey, "", size);
	
	}
</script>
<script
        src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
        crossorigin="anonymous"></script>
	
        <script src="https://e-space.vn:90/socket.io/socket.io.js"></script>
		
        <script src="https://e-space.vn:90/student.js"></script> 
 
 <script>
 function zoom(){
   var is= $('.spin-icon').data('zoom');
      if(is==true){
         w3_close();
        $('.spin-icon').data('zoom',false);
        console.log(false);
     }else{
           w3_open();
        $('.spin-icon').data('zoom',true);
          console.log(true);
     }
 }
function w3_open() {
    
    $("#idClose").show();
    $("#idOpen").hide();
    $("#sidepanel").removeClass('minimize');
	 $(".spin-icon i").removeClass('fa-arrow-circle-left').addClass('fa-arrow-circle-right');
     $("#sidepanel #bottom-bar button" ).css( {"float": "left", "width":"100%", "padding":"10px 0"});
   /* $("#sidepanel #search").css({ "display": "block"});
    $("#sidepanel #bottom-bar button" ).css( {"float": "left", "width":"50%", "padding":"10px 0"});
    $("#page-wrapper").css({"margin":"0 200px 0 220px"});
    $("#contacts").css({"overflow-y":"auto"});
    $("#sidepanel #contacts ul li.contact").css({'padding':'10px 0 15px 0'});
    $("#sidepanel #contacts ul li.contact .wrap .meta").css({'display':'block'});
    $("#sidepanel").css({"width":"200px"});*/
}
function w3_close() {
    $("#idClose").hide();
    $("#idOpen").show();
    $("#sidepanel").addClass('minimize');
	$(".spin-icon i").removeClass('fa-arrow-circle-right').addClass('fa-arrow-circle-left');
     $("#sidepanel #bottom-bar button" ).css( {"float": "left", "width":"100%", "padding":"10px 0"});
   
}
</script>
<script >
$(".messages").animate({ scrollTop: $(document).height() }, "fast");

$("#profile-img").click(function() {
	$("#status-options").toggleClass("active");
});

$(".expand-button").click(function() {
  $("#profile").toggleClass("expanded");
	$("#contacts").toggleClass("expanded");
});

$("#status-options ul li").click(function() {
	$("#profile-img").removeClass();
	$("#status-online").removeClass("active");
	$("#status-away").removeClass("active");
	$("#status-busy").removeClass("active");
	$("#status-offline").removeClass("active");
	$(this).addClass("active");
	
	if($("#status-online").hasClass("active")) {
		$("#profile-img").addClass("online");
	} else if ($("#status-away").hasClass("active")) {
		$("#profile-img").addClass("away");
	} else if ($("#status-busy").hasClass("active")) {
		$("#profile-img").addClass("busy");
	} else if ($("#status-offline").hasClass("active")) {
		$("#profile-img").addClass("offline");
	} else {
		$("#profile-img").removeClass();
	};
	
	$("#status-options").removeClass("active");
});

function newMessage() {
	message = $(".message-input input").val();
	if($.trim(message) == '') {
		return false;
	}
	$('<li class="sent"><img src="http://emilcarlsson.se/assets/mikeross.png" alt="" /><p>' + message + '</p></li>').appendTo($('.messages ul'));
	$('.message-input input').val(null);
	$('.contact.active .preview').html('<span>You: </span>' + message);
	$(".messages").animate({ scrollTop: $(document).height() }, "fast");
};

$('.submit').click(function() {
  newMessage();
});

$(window).on('keydown', function(e) {
  if (e.which == 13) {
    newMessage();
    return false;
  }
});

 $( window ).resize(function() {
    var heightTop = $( "#page > .header-wrapper > .header > .top-part" ).height()+13;
    var heightWindow =$( window ).height();
    $("#sidepanel").height(heightWindow - heightTop);
    $("#sidepanel").css({'right':0, 'bottom':0});
    
    
 
});
$(document).ready(function(){
    /*function onGranted() {
       console.log("green");
    }
	function onDenied() {
		 console.log("red");
    }
	 Push.Permission.request(onGranted, onDenied);
	 */
    var heightTop = $( "#page > .header-wrapper > .header > .top-part" ).height()+13;
    var heightWindow =$( window ).height();
    $("#sidepanel").height(heightWindow-heightTop);
   
      w3_close();
     $("#sidepanel").show();
    //setTimeout(function(){  }, 1000);
   
});
</script>