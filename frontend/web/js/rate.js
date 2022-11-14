$( document ).ready(function() {
		// Initializes and creates emoji set from sprite sheet
        window.emojiPicker = new EmojiPicker({
			emojiable_selector: '[data-emojiable=true]',
			assetsPath: baseURL + 'emoji/img',
			popupButtonClasses: 'fa fa-smile-o'
        });
        // Finds all elements with `emojiable_selector` and converts them to rich emoji input fields
        // You may want to delay this step if you have dynamically created input fields that appear later in the loading process
        // It can be called as many times as necessary; previously converted input fields will not be converted again
        window.emojiPicker.discover();
      }); 
$( document ).on('click', '.comment_user_feedbacks', function(){
			var id = $(this).data('id');
			if($("#feedback_" + id).hasClass("hidden")){
				$("#feedback_" + id).removeClass("hidden");
				$("#feedback_" + id + ' .emoji-wysiwyg-editor').focus();
			}else{
				$("#feedback_" + id).addClass("hidden");
				$("#feedback_" + id + ' .emoji-wysiwyg-editor').blur();
			}
});
 var rating = 5;
 $('#rating img').on('mouseover', function() {
        $('#rating img').attr('src', baseURL + 'images/star-off.png');
        for (i = 0; i <= $(this).attr('alt'); i++) {
                          $('#rating img[alt=\'' + i + '\']').attr('src', baseURL +  'images/star-on.png');
                          $('#send_comment').attr('data', i);
        }
 });
 $(document).on('click','.comment_like', function(){
		var	id = $(this).data('id');
		//console.log(id);
		$.ajax({
                        type: 'GET',
                        url:  baseURL + 'comment-like',
                        data: {id:id},
                        contentType: "application/json; charset=utf-8",
                        dataType: "json",
                        success: function(data) {
							
							var	html ="";
							if(data.voted==true){
								$('#like_' + id).addClass('like').removeClass('unlike');
							}else{
								$('#like_' + id).addClass('unlike').removeClass('like');
							}
							if(data.like > 0){
								$('#count_'+id).html('(' + data.like + ')').removeClass('hidden');
							}else{
								$('#count_'+id).html('(' + data.like + ')').addClass('hidden');
							}
							if(data.list.length > 0) {
								html+= '<span class="dropdown">';
									html+= '<a class="dropdown-toggle"  data-toggle="dropdown" id="' + data.id + '">';
									html+= data.text;
									html+= '<span class="caret"></span>';
									html+= '</a>';
									html+= '<ul class="dropdown-menu" role="menu" id="list' + data.id + '" aria-labelledby="dropdownMenu' + data.id + '">';
										$.each( data.list, function( key, value ) {
												html+= '<li role="presentation">';
												html+= '<a href="' + baseURL + 'kenh/">' + value.name +'</a>';
												html+= '</li>';
										});
									html+= '</ul>';
									html+= '</span>';
							}
						$('#user_'+id).html(html);	
                    }
                });
 });
 /*
 function like(id,user_id){
                $.ajax({
                        type: 'GET',
                        url:  baseURL + 'comment-like',
                        data: {id:id},
                        contentType: "application/json; charset=utf-8",
                        dataType: "json",
                        success: function(data) {
							
							var	html ="";
							if(data.voted==true){
								$('#like_' + id).addClass('like').removeClass('unlike');
							}else{
								$('#like_' + id).addClass('unlike').removeClass('like');
							}
							if(data.like > 0){
								$('#count_'+id).html('(' + data.like + ')').removeClass('hidden');
							}else{
								$('#count_'+id).html('(' + data.like + ')').addClass('hidden');
							}
							if(data.list.length > 0) {
								html+= '<span class="dropdown">';
									html+= '<a class="dropdown-toggle"  data-toggle="dropdown" id="' + data.id + '">';
									html+= data.text;
									html+= '<span class="caret"></span>';
									html+= '</a>';
									html+= '<ul class="dropdown-menu" role="menu" id="list' + data.id + '" aria-labelledby="dropdownMenu' + data.id + '">';
										$.each( data.list, function( key, value ) {
												html+= '<li role="presentation">';
												html+= '<a href="' + baseURL + 'kenh/">' + value.name +'</a>';
												html+= '</li>';
										});
									html+= '</ul>';
									html+= '</span>';
							}
						$('#user_'+id).html(html);	
                    }
                });
                };
	*/			
$(document).on('keydown','.article_user_comment_feedback', function(e) {
					if (e.which == 13) {
						comment_id =  $(e.target).data('comment_id');
						message =  $(e.target).html();
						if(!message || 0 === message.length){
							return;
						}
					//	$('#myModalLoading').modal('show');
						$.ajax({
							type: 'get',
							url: baseURL + 'comment-feedback',
							data: {'message':message.trim() , 'comment_id':comment_id},
							//dataType: "json",
							success: function(data) {
							   // $('#myModalLoading').modal('hide');
								$(e.target).html('');
							    $('#user_feedbacks_' + comment_id).append(data);
							}
					});
						return false;
					  }
});				
$(document).on('click','#send_comment',function() {
                    rating = $(this).attr('data');
					comment =  $(".emoji-wysiwyg-editor").html();
                    //id = $('input[name=id]').val();
					 article_id = $('input[name=article_id]').val();
					if(rating==0){
                          alert('Vui lòng chọn đánh giá về tin rao này');
                          return;
                    }
                    if(!comment || 0 === comment.length){
                          alert('Viết đánh giá chất lượng tin rao tin rao này');
                          return;
                    }
                    if(!article_id){
                          alert('Tin rao này không tồn tại');
                          return;
                    }
                   
                    //$('#myModalLoading').modal('show');
				
                    $.ajax({
                        type: 'get',
                        url: baseURL + 'comment-rating',
                        data: {'rating': rating ,'comment':comment.trim() , 'article_id': article_id},
                     	//dataType: "json",
					   success: function(data) {
							  //  $('#myModalLoading').modal('hide');
									$('.emoji-wysiwyg-editor').html('');
							    $('#user_comment').prepend(data);
								var ms_height = $('#user_comment').height();
									console.log(ms_height);
								$("[class^='list']").each(function(){
										console.log($(this).outerHeight());
									ms_height += $(this).outerHeight();
								});
									console.log(ms_height);
							$('.user_comment').animate({ scrollTop: 0}, "fast");
									/*
								var ms_height = $('#user_comment').height();
								$("[class^='list']").each(function(){
									ms_height += $(this).outerHeight();
								});
							$('.tab-content').animate({ scrollTop: ms_height}, "fast");
				
			
							$('#user_comment').animate({
                            	    'scrollTop':   $('#id'+ data.comment.id).offset().top -  $('#user_comment').offset().top +  $('#user_comment').scrollTop()
                            	}, 1000);
								*/
							
                            
						   }
                      		/* 
					   success: function(data) {
                        	  data=  $.parseJSON(data);
							if(data.error){
								  $('#myModalLoading').modal('hide');
                              alert(data.error.message);
							}else{
								
									html='';
									html+='<div class="list" id="id'+ data.comment.id +'">';
									html+='<div class="left">';
									html+='		<span class="status status_'+ data.comment.id +'" id="status_'+ data.comment.id +'"></span>';
									html+='  	<img class="icon-avatar" src="'+ data.user.image+'"/>';
		   							html+='</div>';
                        			html+='<div class="right">';
									html+='<div class="name">';
                        			html+='<span>'+ data.user.name + '</span>';
									html+='</div>';
									
									html+='<div class="star_date">';
										html+='<div class="star">';
											for($i=1; $i<= 5; $i++){
											   if(data.comment.rating>=$i){
												   html+='<img src="' + baseURL +  'images/star-on.png" alt="' + i +'" />';
												}else{
													html+='<img src="' + baseURL +  'images/star-off.png" alt="' + i +'"/>';
												}
											}
										html+='</div>';
										html+='<span class="date">'+ data.comment.created+'</span>';
									html+='</div>';
									
									html+='<div class="comment">';
										html+='<p>' + data.comment.comment.trim() + '</p>';
									html+='</div>'
									
									html+='<div class="action">';
										html+=' <i id="unlike'+ data.comment.id +'" class="fa fa-heart" style="cursor:pointer; color:#999; display: none;" data="'+data.comment.id+'" onclick="like(' + data.comment.id + ',' + data.comment.user_id + ');"></i>';
										html+=' <i id="like'+ data.comment.id +'" class="fa fa-heart-o"  style="cursor: pointer;" data="'+ data.comment.id +'" onclick="like(' + data.comment.id + ',' + data.comment.user_id + ');"></i>';
										html+=' <span style="color:#337ab7;font-size: small;" > Thích</span> (<span style="color:#337ab7; font-size: small;" id="'+ data.comment.id +'">'+ data.comment.like +'</span>)';
										html+=' <span style="color:#999;font-size: small; cursor:pointer;" data-id="' + data.comment.id + '" class="comment_user_feedbacks"> Phản hồi </span> (<span style="color:#337ab7; font-size: small;" id="' + data.comment.id + '">' + data.comment.like + '</span>)';
									html+='</div>'
									
									
												
									html+='<div class="compose hidden article_user_comment_feedback" id="input_user_feedbacks_' + data.comment.id + '">';
										html+='<input id="message" data-emojiable="converted" placeholder="Type a message" data-id="67d11299-78e3-49bf-9ba6-be26cfed7570" data-type="original-input" style="display: none;"><div class="emoji-wysiwyg-editor" data-id="67d11299-78e3-49bf-9ba6-be26cfed7570" data-type="input" placeholder="Type a message" contenteditable="true"></div><div class="emoji-menu" data-id="67d11299-78e3-49bf-9ba6-be26cfed7570" data-type="menu" style="display: none;"><div class="emoji-items-wrap1"><table class="emoji-menu-tabs"><tbody><tr><td><a class="emoji-menu-tab icon-recent-selected"></a></td><td><a class="emoji-menu-tab icon-smile"></a></td><td><a class="emoji-menu-tab icon-flower"></a></td><td><a class="emoji-menu-tab icon-bell"></a></td><td><a class="emoji-menu-tab icon-car"></a></td><td><a class="emoji-menu-tab icon-grid"></a></td></tr></tbody></table><div class="emoji-items-wrap mobile_scrollable_wrap"><div class="emoji-items"><a href="javascript:void(0)" title=":wink:"><img src="/emoji/img/blank.gif" class="img" style="display:inline-block;width:25px;height:25px;background:url("/emoji/img/emoji_spritesheet_0.png") -125px 0px no-repeat;background-size:675px 175px;" alt=":wink:"><span class="label">:wink:</span></a><a href="javascript:void(0)" title=":relaxed:"><img src="/emoji/img/blank.gif" class="img" style="display:inline-block;width:25px;height:25px;background:url("/emoji/img/emoji_spritesheet_0.png") -100px 0px no-repeat;background-size:675px 175px;" alt=":relaxed:"><span class="label">:relaxed:</span></a><a href="javascript:void(0)" title=":flushed:"><img src="/emoji/img/blank.gif" class="img" style="display:inline-block;width:25px;height:25px;background:url("/emoji/img/emoji_spritesheet_0.png") -350px 0px no-repeat;background-size:675px 175px;" alt=":flushed:"><span class="label">:flushed:</span></a><a href="javascript:void(0)" title=":rage:"><img src="/emoji/img/blank.gif" class="img" style="display:inline-block;width:25px;height:25px;background:url("/emoji/img/emoji_spritesheet_0.png") -175px -25px no-repeat;background-size:675px 175px;" alt=":rage:"><span class="label">:rage:</span></a><a href="javascript:void(0)" title=":kissing_closed_eyes:"><img src="/emoji/img/blank.gif" class="img" style="display:inline-block;width:25px;height:25px;background:url("/emoji/img/emoji_spritesheet_0.png") -200px 0px no-repeat;background-size:675px 175px;" alt=":kissing_closed_eyes:"><span class="label">:kissing_closed_eyes:</span></a><a href="javascript:void(0)" title=":sob:"><img src="/emoji/img/blank.gif" class="img" style="display:inline-block;width:25px;height:25px;background:url("/emoji/img/emoji_spritesheet_0.png") -575px 0px no-repeat;background-size:675px 175px;" alt=":sob:"><span class="label">:sob:</span></a><a href="javascript:void(0)" title=":sweat_smile:"><img src="/emoji/img/blank.gif" class="img" style="display:inline-block;width:25px;height:25px;background:url("/emoji/img/emoji_spritesheet_0.png") 0px -25px no-repeat;background-size:675px 175px;" alt=":sweat_smile:"><span class="label">:sweat_smile:</span></a><a href="javascript:void(0)" title=":grinning:"><img src="/emoji/img/blank.gif" class="img" style="display:inline-block;width:25px;height:25px;background:url("/emoji/img/emoji_spritesheet_0.png") -50px 0px no-repeat;background-size:675px 175px;" alt=":grinning:"><span class="label">:grinning:</span></a><a href="javascript:void(0)" title=":smiley:"><img src="/emoji/img/blank.gif" class="img" style="display:inline-block;width:25px;height:25px;background:url("/emoji/img/emoji_spritesheet_0.png") -25px 0px no-repeat;background-size:675px 175px;" alt=":smiley:"><span class="label">:smiley:</span></a><a href="javascript:void(0)" title=":smirk:"><img src="/emoji/img/blank.gif" class="img" style="display:inline-block;width:25px;height:25px;background:url("/emoji/img/emoji_spritesheet_0.png") -50px -50px no-repeat;background-size:675px 175px;" alt=":smirk:"><span class="label">:smirk:</span></a><a href="javascript:void(0)" title=":scream:"><img src="/emoji/img/blank.gif" class="img" style="display:inline-block;width:25px;height:25px;background:url("/emoji/img/emoji_spritesheet_0.png") -125px -25px no-repeat;background-size:675px 175px;" alt=":scream:"><span class="label">:scream:</span></a><a href="javascript:void(0)" title=":joy:"><img src="/emoji/img/blank.gif" class="img" style="display:inline-block;width:25px;height:25px;background:url("/emoji/img/emoji_spritesheet_0.png") -550px 0px no-repeat;background-size:675px 175px;" alt=":joy:"><span class="label">:joy:</span></a><a href="javascript:void(0)" title=":kissing_heart:"><img src="/emoji/img/blank.gif" class="img" style="display:inline-block;width:25px;height:25px;background:url("/emoji/img/emoji_spritesheet_0.png") -175px 0px no-repeat;background-size:675px 175px;" alt=":kissing_heart:"><span class="label">:kissing_heart:</span></a><a href="javascript:void(0)" title=":heart:"><img src="/emoji/img/blank.gif" class="img" style="display:inline-block;width:25px;height:25px;background:url("/emoji/img/emoji_spritesheet_0.png") -250px -150px no-repeat;background-size:675px 175px;" alt=":heart:"><span class="label">:heart:</span></a><a href="javascript:void(0)" title=":heart_eyes:"><img src="/emoji/img/blank.gif" class="img" style="display:inline-block;width:25px;height:25px;background:url("/emoji/img/emoji_spritesheet_0.png") -150px 0px no-repeat;background-size:675px 175px;" alt=":heart_eyes:"><span class="label">:heart_eyes:</span></a><a href="javascript:void(0)" title=":blush:"><img src="/emoji/img/blank.gif" class="img" style="display:inline-block;width:25px;height:25px;background:url("/emoji/img/emoji_spritesheet_0.png") -75px 0px no-repeat;background-size:675px 175px;" alt=":blush:"><span class="label">:blush:</span></a><a href="javascript:void(0)" title=":grin:"><img src="/emoji/img/blank.gif" class="img" style="display:inline-block;width:25px;height:25px;background:url("/emoji/img/emoji_spritesheet_0.png") -375px 0px no-repeat;background-size:675px 175px;" alt=":grin:"><span class="label">:grin:</span></a><a href="javascript:void(0)" title=":+1:"><img src="/emoji/img/blank.gif" class="img" style="display:inline-block;width:25px;height:25px;background:url("/emoji/img/emoji_spritesheet_0.png") -600px -75px no-repeat;background-size:675px 175px;" alt=":+1:"><span class="label">:+1:</span></a><a href="javascript:void(0)" title=":pensive:"><img src="/emoji/img/blank.gif" class="img" style="display:inline-block;width:25px;height:25px;background:url("/emoji/img/emoji_spritesheet_0.png") -400px 0px no-repeat;background-size:675px 175px;" alt=":pensive:"><span class="label">:pensive:</span></a><a href="javascript:void(0)" title=":smile:"><img src="/emoji/img/blank.gif" class="img" style="display:inline-block;width:25px;height:25px;background:url("/emoji/img/emoji_spritesheet_0.png") 0px 0px no-repeat;background-size:675px 175px;" alt=":smile:"><span class="label">:smile:</span></a><a href="javascript:void(0)" title=":kiss:"><img src="/emoji/img/blank.gif" class="img" style="display:inline-block;width:25px;height:25px;background:url("/emoji/img/emoji_spritesheet_0.png") -475px -150px no-repeat;background-size:675px 175px;" alt=":kiss:"><span class="label">:kiss:</span></a><a href="javascript:void(0)" title=":unamused:"><img src="/emoji/img/blank.gif" class="img" style="display:inline-block;width:25px;height:25px;background:url("/emoji/img/emoji_spritesheet_0.png") -450px 0px no-repeat;background-size:675px 175px;" alt=":unamused:"><span class="label">:unamused:</span></a><a href="javascript:void(0)" title=":stuck_out_tongue_winking_eye:"><img src="/emoji/img/blank.gif" class="img" style="display:inline-block;width:25px;height:25px;background:url("/emoji/img/emoji_spritesheet_0.png") -275px 0px no-repeat;background-size:675px 175px;" alt=":stuck_out_tongue_winking_eye:"><span class="label">:stuck_out_tongue_winking_eye:</span></a><a href="javascript:void(0)" title=":see_no_evil:"><img src="/emoji/img/blank.gif" class="img" style="display:inline-block;width:25px;height:25px;background:url("/emoji/img/emoji_spritesheet_0.png") -75px -75px no-repeat;background-size:675px 175px;" alt=":see_no_evil:"><span class="label">:see_no_evil:</span></a><a href="javascript:void(0)" title=":cry:"><img src="/emoji/img/blank.gif" class="img" style="display:inline-block;width:25px;height:25px;background:url("/emoji/img/emoji_spritesheet_0.png") -525px 0px no-repeat;background-size:675px 175px;" alt=":cry:"><span class="label">:cry:</span></a><a href="javascript:void(0)" title=":stuck_out_tongue_closed_eyes:"><img src="/emoji/img/blank.gif" class="img" style="display:inline-block;width:25px;height:25px;background:url("/emoji/img/emoji_spritesheet_0.png") -300px 0px no-repeat;background-size:675px 175px;" alt=":stuck_out_tongue_closed_eyes:"><span class="label">:stuck_out_tongue_closed_eyes:</span></a><a href="javascript:void(0)" title=":disappointed:"><img src="/emoji/img/blank.gif" class="img" style="display:inline-block;width:25px;height:25px;background:url("/emoji/img/emoji_spritesheet_0.png") -475px 0px no-repeat;background-size:675px 175px;" alt=":disappointed:"><span class="label">:disappointed:</span></a><a href="javascript:void(0)" title=":speak_no_evil:"><img src="/emoji/img/blank.gif" class="img" style="display:inline-block;width:25px;height:25px;background:url("/emoji/img/emoji_spritesheet_0.png") -125px -75px no-repeat;background-size:675px 175px;" alt=":speak_no_evil:"><span class="label">:speak_no_evil:</span></a><a href="javascript:void(0)" title=":relieved:"><img src="/emoji/img/blank.gif" class="img" style="display:inline-block;width:25px;height:25px;background:url("/emoji/img/emoji_spritesheet_0.png") -425px 0px no-repeat;background-size:675px 175px;" alt=":relieved:"><span class="label">:relieved:</span></a><a href="javascript:void(0)" title=":yum:"><img src="/emoji/img/blank.gif" class="img" style="display:inline-block;width:25px;height:25px;background:url("/emoji/img/emoji_spritesheet_0.png") -275px -25px no-repeat;background-size:675px 175px;" alt=":yum:"><span class="label">:yum:</span></a><a href="javascript:void(0)" title=":ok_hand:"><img src="/emoji/img/blank.gif" class="img" style="display:inline-block;width:25px;height:25px;background:url("/emoji/img/emoji_spritesheet_0.png") -650px -75px no-repeat;background-size:675px 175px;" alt=":ok_hand:"><span class="label">:ok_hand:</span></a><a href="javascript:void(0)" title=":neutral_face:"><img src="/emoji/img/blank.gif" class="img" style="display:inline-block;width:25px;height:25px;background:url("/emoji/img/emoji_spritesheet_0.png") -600px -25px no-repeat;background-size:675px 175px;" alt=":neutral_face:"><span class="label">:neutral_face:</span></a><a href="javascript:void(0)" title=":confused:"><img src="/emoji/img/blank.gif" class="img" style="display:inline-block;width:25px;height:25px;background:url("/emoji/img/emoji_spritesheet_0.png") -625px -25px no-repeat;background-size:675px 175px;" alt=":confused:"><span class="label">:confused:</span></a></div></div></div></div><i class="emoji-picker-icon emoji-picker fa fa-smile-o" data-id="67d11299-78e3-49bf-9ba6-be26cfed7570" data-type="picker"></i>';
														
										html+='<div class="compose-dock">';
										html+='<div class="dock">';
										html+='<form id="uploadForm"  action="' + baseURL +  'files" method="post" enctype="multipart/form-data">';
											html+='<label for="idImage">';
											html+='<i class="fa fa-camera" aria-hidden="true"></i>';
											html+='</label>';
										html+='<input style="display:none;"  id="idImage" type="file" accept="image/*" name="photo" />';
										html+='</form>';
									html+='</div>';
									html+='</div>';
									html+='</div>';
									
									
									html+='</div>';
									html+='</div>';
									 $('#user_comment').prepend(html);
									 
									 
									 
									 $('textarea[name=comment]').val('');
									 for (i = 0; i <= 5; i++) {
										 $('#rating img').attr('src',  baseURL +  'images/star-off.png');
									 }
									 $('#send').attr('data', 0);
                             
                             
									// Total rating
									 total='';
									 total+='<span style="font-weight:bold; font-size: 18px;">Đánh giá trung bình</span><br/><span>Có (' + data.total + ') lượt đánh giá</span><br/>';
									 total+=' <div>';
									 for(i=1; i<= 5; i++){
										 if(data.percent>=i){
											 total+='<img src="' + baseURL + 'images/star-on.png" alt="' + i + '" />';
									}else{
												total+='<img src="' + baseURL + 'images/star-off.png" alt="' + i + '" />';
										}
										}
                             total+='</div><br/>';
                             total+='  <span style="font-size:60px; text-align:left;">' + data.percent + '</span>';
                             $('#block_star').html(total);
                             $('#user_comment').animate({
                            	    'scrollTop':   $('#id'+ data.comment.id).offset().top -  $('#user_comment').offset().top +  $('#user_comment').scrollTop()
                            	}, 1000);
								$('.emoji-wysiwyg-editor').html('');
                             $('#myModalLoading').modal('hide');
                            
                        }
                        }
					*/
                        });
                    });
			$(document).on('click','#showMore',function(){
						var offset= $(this).data('offset');
						var id= $(this).data('article_id');
						console.log(offset);
						$.ajax({
                               type: 'get',
                               url: baseURL + 'comment-show-more',
                               data: {'offset': (offset+5), 'id': id},
								success: function(data) {
									$('#showMore').data('offset',(offset+ 5)); 
									$('#user_comment').append(data);
									var ms_height = $('#user_comment').height();
									
								$("[class^='list']").each(function(){
									
									ms_height += $(this).outerHeight();
								});
									
							$('.user_comment').animate({ scrollTop: ms_height}, "fast");
									//$('#button').html('<span id="showMore" onclick="showMore(' + data.article_id + ',' + data.offset + ');" style="width:100%; color: rgb(32, 120, 244); cursor:pointer">Xem thêm bình luận</span>');
   								//	$('#myModalLoading').modal('hide');
								}
                            });
			});
           
  	