(function () {
'use strict'
// Fetch all the forms we want to apply custom Bootstrap validation styles to
var  search_forms = document.querySelectorAll('#search-form')
    // Loop over them and prevent submission
    Array.prototype.slice.call(search_forms).forEach(function (form) {
        form.addEventListener('submit', function (event) {
            event.preventDefault()
             	var stringUrl ='';
                    var  url = $(this).attr('action');
                    var category_id = $("select[name='search[category_id]'").val();
                    var  text = $("input[name='search[text]'").val();
                    var  price = $("select[name='search[price]'").val();
                    var  direction = $("select[name='search[direction]'").val();
                    var  area = $("select[name='search[area]'").val();
                    var  dataCategorySlug = $('#category_id').find('option:selected').attr('data-category_slug');
                   
					if($.trim(text) == '') {
						return false;
			
               		 }else{
                	
                    	var href = url + (text?'?t=' + text:'') + (dataCategorySlug?'&s=' + dataCategorySlug:'') + (category_id?'&c=' + category_id:'') + (price?'&p=' + category_id:'') + (direction?'&d=' + direction:'')+ (area?'&a=' + area:'');
						
					location.href= href;
					}

			}, false)
})
})()

$('.search').on('keydown',function(e) {
		if (e.which == 13) {
			  if($.trim($(this).val()) == '') {
				return false;
			}
			location.href = "/result?search=" + $(this).val().toLowerCase();
			return false;    //<---- Add this line
		}
			});

$(document).on("keyup", '.search', function() {
			var value = $(this).val().toLowerCase();
				
			 if(value == ''){
					//console.log('trong');
				$('.box-search-result').html('').hide();
				$(this).removeAttr("style");
			}else{
				$(this).css({ 
								'border-bottom-left-radius': '0px',
								'border-bottom-right-radius': '0px',
								'border-color': 'rgba(223,225,229,0)',
								'-webkit-box-shadow': '0 1px 6px 0 rgba(32,33,36,0.28)',
								'-moz-box-shadow': '0 1px 6px 0 rgba(32,33,36,0.28)',
								'box-shadow': '0 1px 6px 0 rgba(32,33,36,0.28)',
							});
				$.ajax({
				url: '/filter',
				data: {search_text: value},
				method: 'GET',
				dataType: 'json',
				}).done(function(data) {
					html='';
					html+='<div style="height: 150px; overflow: auto;">';
					$.each(data.articles , function(index, val) { 
							html+='<li';
							html+=' id="key_' + index + '" class="item"';				
							html+='	>';
							html+='	<div class="box-title">' 
							html+= '<span class="text">' + val.key_text + '</span><span data-id="' + index + '" class="remove"> Xóa</span>';
							html+='</div>';
							html+='</li>';
						
				});
				html+='</div>';
				$('.box-search-result').html(html).show();
			});
			}
		});	
$(document).on('click','.box-search-result li.item .box-title .remove',function(e){ 	
			$.ajax({
				url: '/remove',
				data: {id: $(this).data("id")},
				method: 'GET',
				dataType: 'json',
				}).done(function(data) {
						$('#key_'+ data.id).remove();
			});
});		
$(document).on('click','.box-search-result li.item .box-title .text',function(e){ 
			  if($.trim($(this).text()) == '') {
					return false;
				}
			$('#search').val($(this).text());
			location.href = "/result?search=" + $(this).text().toLowerCase();
				return false;    //<---- Add this line
	
    });	

