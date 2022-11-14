$( document ).ready(function() {
	$(".regular_category").show();
	if($(window).width()< 1200){
			sidebar_close();
	}else{
			sidebar_open();
	}
});
$( window ).resize(function() {
	if($(window).width()< 214*5){
			sidebar_close();
				
		}else{
			sidebar_open();
		}
		
});
function sidebar_open() {
	var main = $(window).width();
	var column =  ~~((main-240)/214);
		//console.log(totalCategory);
		//if(totalCategory > column){
			   $(".regular_category").slick({
				dots: false,
				infinite: true,
				useTransform: false,
				slidesToShow: ~~((main-240)/214),
				slidesToScroll: 1,
				variableWidth: true
			  });
		//}
}
function sidebar_close() {
	var main = $(window).width();
var column =  ~~(main-240);
		console.log(totalCategory);
	//if(totalCategory > column){
		$(".regular_category").slick({
			dots: false,
			infinite: true,
			useTransform: false,
			slidesToShow: ~~(main/214),
			slidesToScroll: 1,
			variableWidth: true
		  });
	//}
}