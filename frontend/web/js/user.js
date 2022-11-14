/*tab*/
$(function(){
	 var hash = window.location.hash;
  hash && $('ul.nav a[href="' + hash + '"]').tab('show');

  $('.nav-tabs a').click(function (e) {
    $(this).tab('show');
    var scrollmem = $('body').scrollTop() || $('html').scrollTop();
    window.location.hash = this.hash;
    $('html,body').scrollTop(scrollmem);
  });
});
/*end tab*/
$( document ).ready(function() {
		var maxcharsDescription= 2500;
		$('#chars_description').text(maxcharsDescription);
		$('textarea[name="Article[description]"]').keyup(function () {
			var tlength = $(this).val().length;
			$(this).val($(this).val().substring(0, maxcharsDescription));
			var tlength = $(this).val().length;
			remain = maxcharsDescription - parseInt(tlength);
			$('#chars_description').text(remain);
		});
		var maxcharsTitle = 100;
		$('#chars_title').text(maxcharsTitle);
		$('textarea[name="Article[title]"]').keyup(function () {
			var tlength = $(this).val().length;
			$(this).val($(this).val().substring(0, maxcharsTitle));
			var tlength = $(this).val().length;
			remain = maxcharsTitle - parseInt(tlength);
			$('#chars_title').text(remain);
		});
	$('.panel-collapse').on('show.bs.collapse', function () {
		$(this).siblings('.panel-heading').addClass('active');
  });
	$('.panel-collapse').on('hide.bs.collapse', function () {
		$(this).siblings('.panel-heading').removeClass('active');
	 });
  
});

$('select[name="Article[province_id]"]').on('change', function() {
    var provinceId = $(this).val();
	console.log(provinceId);
	if(provinceId > 0){
    $.ajax({
        type: 'get',
        url: $(location).attr("origin") + '/user/districts',
        data: {province_id : provinceId },
		dataType: 'json',
        success: function (data) {
			$('#article-district_id').find('option')
					.remove()
					.end();
			$('#article-district_id')
					.append($("<option></option>")
                    .attr("value",'')
                    .text('* Quận/Huyện')); 		
			$.each(data.districts, function (i, item) {
					$('#article-district_id')
					.append($("<option></option>")
                    .attr("value",item.district_id)
                    .text(item.name)); 
			});
			$('select[name="Article[district_id]"]').attr('disabled',false);
        }
    });
	}else{
			$('#article-district_id').find('option')
					.remove()
					.end();
			$('#article-district_id')
					.append($("<option></option>")
                    .attr("value",'')
                    .text('* Quận/Huyện')); 
		$('select[name="Article[district_id]"]').attr('disabled',true);
	}
});
$('select[name="User[province_id]"]').on('change', function() {
    var provinceId = $(this).val();
	
	if(provinceId > 0){
    $.ajax({
        type: 'get',
        url: $(location).attr("origin") + '/user/districts',
        data: {province_id : provinceId },
		dataType: 'json',
        success: function (data) {
			$('#user-district_id').find('option')
					.remove()
					.end();
			$('#user-district_id')
					.append($("<option></option>")
                    .attr("value",'')
                    .text('* Quận/Huyện')); 		
			$.each(data.districts, function (i, item) {
					$('#user-district_id')
					.append($("<option></option>")
                    .attr("value",item.district_id)
                    .text(item.name)); 
			});
				$('select[name="User[district_id]"]').attr('disabled',false);	
        }
    });
	}else{
			$('#user-district_id').find('option')
					.remove()
					.end();
			$('#user-district_id')
					.append($("<option></option>")
                    .attr("value",'')
                    .text('* Quận/Huyện')); 
		$('select[name="User[district_id]"]').attr('disabled',true);
	}
});
    function readURL(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				reader.onload = function (e) {
					$('#boxImage .image').attr('src', e.target.result);
				}
				reader.readAsDataURL(input.files[0]);
			}
		}
		$("#fileImage").change(function(){
				readURL(this);
				//$("#formAvatar").submit();
		});
	   
		
$('select[name="Article[district_id]"]').on('change', function() {
	var districtId = $(this).val();

    if (districtId > 0) {
        $.ajax({
            type: 'get',
            url: $(location).attr("origin") + '/user/wards',
            data: {
                district_id: districtId
            },
            dataType: 'json',
            success: function(data) {
                $('#article-ward_id').find('option')
                    .remove()
                    .end();
                $('#article-ward_id')
                    .append($("<option></option>")
                        .attr("value", '')
                        .text('* Phường/Xã'));
                $.each(data.wards, function(i, item) {
                    $('#article-ward_id')
                        .append($("<option></option>")
                            .attr("value", item.ward_id)
                            .text(item.name));
                });
                $('select[name="Article[ward_id]"]').attr('disabled', false);
            }
        });
    } else {
        $('#article-ward_id').find('option')
            .remove()
            .end();
        $('#article-ward_id')
            .append($("<option></option>")
                .attr("value", '')
                .text('* Phường/Xã'));
        $('select[name="Article[ward_id]"]').attr('disabled', true);
    }
});
