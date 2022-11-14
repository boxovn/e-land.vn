$(document).ready(function(){
	
	//iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal').iCheck({
    	checkboxClass: 'icheckbox_minimal-blue'
    });
    
    //Get district by province code
	$("#buildingprojectinfo-province_id").change(function(event) {
		ajaxGetDistrict(_jsBaseUrl, $(this).val(), "#buildingprojectinfo-district_id");
	});
	$("#buildingprojectinfosearch-province_id").change(function(event) {
		ajaxGetDistrict(_jsBaseUrl, $(this).val(), "#buildingprojectinfosearch-district_id");
		$('#buildingprojectinfosearch-ward_id').html('<option selected="selected" value="">Chọn Phường/Xã</option>');
	});
	
	function ajaxGetDistrict(url, val, element){
		$.ajax({
		    url: url + '/index.php?r=district%2Fajax',
		    type: 'post',
		    data: {
		    	provinceID: val
		    },
			dataType: 'json',
			async: true,
			success: function(data) {
		        var html = '<option selected="selected" value="">Chọn Quận/Huyện</option>';
		        for(var i=0; i<data.length; i++) {
		        	if (i==0)
		        		html += '<option value="' + data[i].district_id + '">' + data[i].type + ' ' + data[i].name + '</option>';
		        	else 
		        		html += '<option value="' + data[i].district_id + '">' + data[i].type + ' ' + data[i].name + '</option>';
		        }
		        $(element).html(html);
		    }
		});
	}
	
	//Get ward by district code
	$("#buildingprojectinfo-district_id").change(function(event) {
		ajaxGetWard(_jsBaseUrl, $(this).val(), '#buildingprojectinfo-ward_id');
	});
	$("#buildingprojectinfosearch-district_id").change(function(event) {
		ajaxGetWard(_jsBaseUrl, $(this).val(), '#buildingprojectinfosearch-ward_id');
	});
	
	function ajaxGetWard(url, val, element){
		$.ajax({
		    url: url + '/index.php?r=ward%2Fajax',
		    type: 'post',
		    data: {
		    	districtID: val
		    },
			dataType: 'json',
			async: true,
			success: function(data) {
		        var html = '<option selected="selected" value="">Chọn Phường/Xã</option>';
		        for(var i=0; i<data.length; i++) {
		        	if (i==0)
		        		html += '<option value="' + data[i].ward_id + '">' + data[i].type + ' ' + data[i].name + '</option>';
		        	else 
		        		html += '<option value="' + data[i].ward_id + '">' + data[i].type + ' ' + data[i].name + '</option>';
		        }
		        $(element).html(html);
		    }
		});
	}
	
	$("#buildingprojectinfo-ward_id").change(function(event) {
		ajaxGetStreet(_jsBaseUrl, $("#buildingprojectinfo-district_id").val());
	});
	
	function ajaxGetStreet(url, val){
		$.ajax({
		    url: url + '/index.php?r=street%2Fajax',
		    type: 'post',
		    data: {
		    	districtID: val
		    },
			dataType: 'json',
			async: true,
			success: function(data) {
		        var html = '<option selected="selected" value="">Chọn đường</option>';
		        for(var i=0; i<data.length; i++) {
		        	if (i==0)
		        		html += '<option value="' + data[i].id + '">' + ' ' + data[i].name + '</option>';
		        	else 
		        		html += '<option value="' + data[i].street_id + '">' + ' ' + data[i].name + '</option>';
		        }
		        $('#buildingprojectinfo-street_id').html(html);
		    }
		});
	}
	
	function mapGetLocation(lat, lng) {
		$('#inputLat').val(lat);
	    $('#inputLng').val(lng);
		var baseUrl = _jsBaseUrl;
		var myOptions = {
	        zoom: 12,
	        fullscreenControl: false,
	        panControl: false,
	        zoomControl: true,
	        zoomControlOptions: {
	            position: google.maps.ControlPosition.LEFT_TOP
	        },
	        mapTypeControlOptions: {
	            position: google.maps.ControlPosition.TOP_LEFT
	        },
	        scaleControl: true,
	        scaleControlOptions: {
	            position: google.maps.ControlPosition.BOTTOM_RIGHT
	        },
	        streetViewControl: false,
	        streetViewControlOptions: {
	            position: google.maps.ControlPosition.RIGHT_TOP
	        },
	        mapTypeId: google.maps.MapTypeId.ROADMAP,
	        mapTypeControl: true
	    };

	    var map = new google.maps.Map(document.getElementById("mapGetLocation"), myOptions);
	    var latLng = new google.maps.LatLng(lat, lng);
	    map.setCenter(latLng);

	    var marker = new google.maps.Marker({
	        position: latLng,
	        map: map,
	        draggable: true,
	        animation: google.maps.Animation.DROP,
	        icon: baseUrl + '/theme/dist/img/pin-home.png'
	    });

		var html = '<div id="iw" style="max-width: 300px;">';
		html += '<b style="color: #F44336;">Bạn kéo thả chấm điểm để chọn vị trí</b>';	
		html += '</div">';	
	    var infoWindow = new google.maps.InfoWindow({
	        content: html
	    });

	    infoWindow.open(map, marker);
	    dragEventListenerHouseEdit(map, marker, infoWindow);
	}

	function dragEventListenerHouseEdit(map, marker, infoWindow) {
	    google.maps.event.addListener(marker, 'dragstart', function(e) {
	        infoWindow.close();
	    });

	    google.maps.event.addListener(marker, 'click', function(e) {
	        infoWindow.open(map, marker);
	    });

	    google.maps.event.addListener(marker, 'dragend', function(e) {
	        var point = marker.getPosition(); 
	        $('#inputLat').val(point.lat());
	        $('#inputLng').val(point.lng());
	        //$('#latLngLocation').change();
	        map.panTo(point);
	    });
	}
	
	
		
});