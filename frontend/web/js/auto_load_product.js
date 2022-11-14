	var limit=0;	
	var offset =0;
	var total=0;
	var columnHeight = 0;
	var listboxHeight = 0;
	/*
$(document).ready(function() {
		listboxWidth=	$('#list-box').width(); // listbox width
		listboxHeight=	$('#list-box').height(); //
		offset = total =	$('.column').length; // number column after get page
		columnHeight =	$('.column').height(); // column height
		limit =  listboxWidth/214; // get number block to limit. every a block is width 214px
});
$(window).scroll(function() {
   if($(window).scrollTop() + window.innerHeight >= $(document).height()) {
		loadProject();
   }
}); 
*/
function loadProduct(slug, page){
	listboxWidth = $("#list-box").width(); // listbox width
  listboxHeight = $("#list-box").height(); //
  offset = total = $(".column").length; // number column after get page
  columnHeight = $(".column").height(); // column height
  limit = listboxWidth / 214; // get number block to limit. every a block is width 214px
  
	$.ajax({
        url: $(location).attr("origin") + '/product-loading',
        type: 'GET',
		dataType: 'json',
		async: false,  //this turns it into synchronous
        data:{
        		offset:offset,
        		limit:limit*2,
        		slug: slug,
      			page: page,
        	},
         beforeSend: function(){
            $(".loader").show();
        },
        success: function (data) {
            
			$(".loader").hide();
			html = '';
			html +='<div class="list-box" style="width:' + $(".list-box").width() + 'px">';
           	html +='<div style="width: 100%; margin: 0px auto 50px auto; border-bottom: 1px solid #ddd;"></div>';
       		$.each(data.info.product , function(index, val) { 
				html +='<div class="col-md-4 column product" id=' + val.id + '">';
				html +='<div class="box-image">';
				html +='<a title="' + val.name + '" href="' + val.href + '">';
				html +='<img class="image" alt="' + val.name + '" src="' + val.image + '" /></a>';
				html +='</div>';
				html +='<div class="box-description">';
				html +='<div class="wap-price">';
				html +='<div class="price">' + val.price + '</div>';
				html +='<div class="price-discount">' + val.discount + '</div>';
				html +='<div class="price-current">' + val.real_money + 'đ</div>';
				html +='</div>';
				html +='<button class="btn btn-add-to-cart btn-sm btn-block" onClick="addCart(' + val.id + ')" id="' + val.id + '>" data-view-id="pdp_add_to_cart_button">Chọn mua</button>';
				html +='<div class="wap-title">';
				html +='<a class="name" title=' + val.name + '" href="' + val.href + '">' + val.name + '</a>';
				html +='</div>';
				html +='</div>';
				html +='</div>';
        	});
       	html += "</div>";
		offset = data.info.offset;
		total = data.info.total;
		$(".body:last").append(html);
		// scrollTop after add column into list-box
  
		$("html,body").animate(
		  {
			scrollTop: $(window).scrollTop(),
		  },
		  "slow"
		);
		
		
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