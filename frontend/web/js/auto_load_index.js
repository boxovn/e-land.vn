	var limit=0;	
	var offset =0;
	var total=0;
	var columnHeight = 0;
	var listboxHeight = 0;
$(document).ready(function() {
		listboxWidth=	$('#list-box').width(); // listbox width
		listboxHeight=	$('#list-box').height(); //
		offset = total =	$('.column').length; // number column after get page
		columnHeight =	$('.column').height(); // column height
		limit =  listboxWidth/214; // get number block to limit. every a block is width 214px
});
$(window).scroll(function() {
   if($(window).scrollTop() + window.innerHeight >= $(document).height()) {
    if(offset <= total){
		  loadArticle();
	}
   }
});
function loadArticle(url) {
	$.ajax({
        url: $(location).attr("origin") + '/article-loading',
        type: 'GET',
		dataType: 'json',
		async: false,  //this turns it into synchronous
        data:{offset:offset, limit:limit},
         beforeSend: function(){
            $(".loader").show();
        },
        success: function (data) {
            html = '';
          $(".loader").hide();
            $.each(data.info.building , function(index, val) { 
				
				html += '<div class="column" >';
                html += '<a class="box-image" title="' + val.title + '" href="' + val.href + '">';
                html += '<img class="image" alt="' + val.title + '" src="' + val.image + '"/>';
                html += '</a>';
				html += '<div class="box-description">';
                html += '<a title="' + val.title + '" class="title" href="' + val.href + '">' + val.title + '</a>';
				html += '<div class="province">';
				if( val.district_name.length >0 && val.province_name.length >0){
					html += '<a title="' + val.address + '" href="' + val.district_link + '">' + val.district_name +'</a>';
					html += '<a title="' + val.address + '" href="' + val.province_link + '">, '+  val.province_name + '</a>';
				}else if( val.province_name.length >0){
					html += '<a title="' + val.address + '" href="' + val.province_link + '">'+  val.province_name + '</a>';
				}else if( val.district_name.length >0){
					html += '<a title="' + val.address + '" href="' + val.district_link + '">' + val.district_name +'</a>';
				}
				html += '</div>';
                html += '</div>';
				html += '</div>';
        });
		offset = data.info.offset;
		total = data.info.total;
		$( html ).appendTo( $( "#list-box" ) );
		// scrollTop after add column into list-box
			
		$('html,body').animate({scrollTop:listboxHeight},'slow');
			listboxHeight += columnHeight; 
			
        },
		
    });
}
/*
function loadArticle(url) {
  var listbox=	$('#list-box').width();
	var offset = listbox/214;
	$.ajax({
        url: url + 'load-article',
        type: 'GET',
		dataType: 'json',
        data:{offset:offset},
         beforeSend: function(){
            $(".loader").show();
         
        },
        success: function (data) {
				$('#loadArticle').val(data.info.offset);
				html = '';
				$(".loader").hide();
			$.each(data.info.building , function(index, val) {
				html += '<div class="list">';
				html += '<div class="item">';
				html += '	<a  title="' + val.poster_name + '" href="' + val.href + '">';
				html += '		<span class="status" id="status_' + val.poster_id + '"></span>';
				html += '		<img  id="notifi_' + val.poster_id + '" class="img" src="' + val.user_image + '" alt="' + val.poster_name + '"/>';
				html += '		<input type="hidden" name="poster[]" value="' + val.poster_id + '">';
				html += '	</a>';
				html += '	<div class="description">';
				html += '<div class="col-sm-12">';
				html += '<div class="col-sm-4">';
				html += '		<a style="font-weight:bold;" title="' + val.poster_name + '" href="'+ val.href + '">'+ val.poster_name + '</a>';
				html += '	</div>';
				html += '		<div class="col-sm-8">';
				html += '		<span class="button" ><i class="fa fa-phone" aria-hidden="true"></i> <small>'+ val.poster_phone +'</small></span>';
				html += '		<span class="button" onclick="register_popup(\'' + val.room + '\',' + val.user_id + ',\''+ val.user_name +'\','+ val.poster_id + ',\''+ val.poster_name +'\')">'; 
				html += '			<i  class="fa fa-comments-o fa-lg" aria-hidden="true"></i> <small>Nhắn tin</small>';
				html += '		</span>';
				html += '</div>	';
				html += '		</div>	';
				html += '			<div class="col-sm-12"><p>' + val.title + '</p></div>';
				html += '			<div  class="col-sm-12">';
				html += '				<div class="col-sm-2"><label>Giá</label></div> ';
				html += '				<div class="col-sm-10">';
				html += '					: ' + val.price_text;
				html += '				</div>';
				html += '			</div>';
				html += '			<div  class="col-sm-12">';
				html += '				<div class="col-sm-2"><label>Diện tích<label></div>';
				html += '				<div class="col-sm-10">';				
				html += '					: ' + val.area_text;
				html += '				</div>';
				html += '			</div>';
				html += '			<div  class="col-sm-12">';
								
				html += '					<div class="col-sm-2"><label>Quận/Huyện</label></div>';
				html += '					<div class="col-sm-6">:';
				html += '					<a href="'+ val.district +'">' + val.district_name + '</a>,';
				html += '					<a href="'+ val.province +'">' + val.province_name + '</a>';
				html += '					</div>';
								
				html += '				<div  class="col-sm-4">';
				html += '				<small style="margin-right:15px; float:right">';
				html += 					val.article_type + ' |';
				html += 					 val.post_date + '</small>';
				html += '				</div>';
				html += '			</div>';
					html += '			</div>';
						html += '			</div>';
						html += '			</div>';
							
					


			
		});
        $( html ).appendTo( $( "#list-box" ) );
       }
    });
}
*/