<?php
use  yii\helpers\Url;
use yii\helpers\Html;
?>
  <style type="text/css">
   
    .slider {
        width: 80%;
        margin: 80px auto 0 auto;
    }

    .slick-slide {
      margin: 0px 0px;
    }

    .slick-slide img {
      width: 100%;
    }

    .slick-prev:before,
    .slick-next:before {
      color: black;
    }


    .slick-slide {
      transition: all ease-in-out .3s;
	
    }
    
    .slick-active {
    
    }

    .slick-current {
     
    }
	.slick-prev, .slick-next{
		z-index: 1;
		cursor: pointer;
    width: 40px;
    height: 40px;
    border-radius: 24px;
    background-color:#fff;
    box-shadow: 0 4px 4px rgba(0, 0, 0, 0.3), 0 0 4px rgba(0, 0, 0, 0.2);
    fill-opacity: 50%;
    display: flex;
    -ms-flex-direction: column;
    -webkit-flex-direction: column;
    flex-direction: column;
    -ms-flex-align: center;
    -webkit-align-items: center;
    align-items: center;
    -ms-flex-pack: center;
    -webkit-justify-content: center;
    justify-content: center;
	}
	.slick-prev:hover, .slick-next:hover{
			z-index: 1;
	}
    .slick-block{
        display: flex;
        flex-direction: column;
        -webkit-box-align: center;
        align-items: center;
        -webkit-box-pack: center;
        justify-content: center;
        height: 100%;
        color: rgb(255, 255, 255);
        font-size: 13px;
        line-height: 20px;
        background-color: rgb(225, 225, 225);
        padding: 16px;
        border-radius: 4px;
    } 
  </style>
 
<div class="list-box"> 
			<div class="list-head">
				<h2 class="list-title"><?=$title;?></h2>
			</div>
			<section class="regular_category slider" style="display:none">
			<?php  foreach ($articleTypes as $key => $value) { 
				?>
					<div style="float:left;">
					<div style="padding:8px;">
						<a class="slick-block" style="background-color: rgb(<?php echo rand(0,150);?>,<?php echo rand(0,150);?>,<?php echo rand(0,150);?>);" href="<?php echo Url::to(['article/category','category' => $value->slug],true);?>"><?php echo $value->title;?></a>
					</div>
					</div>
		
		<?php } ?>
		 </section>
		  <div class="list-food">
				<div class="view-more">
					<a class="btn btn-sm btn-block" href="http://e-land.vn/"><i class="fa fa-caret-down" aria-hidden="true"></i> Xem thêm</a>
				</div>
			</div>
</div>
<script type="text/javascript">
    
    $( document ).ready(function() {
            $('.regular_category').show();
    if($(window).width()< 1200){
            sidebar_close_category();
    }else{
            sidebar_open_category();
    }
});
$( window ).resize(function() {

            $('.regular_category').show();
    if($(window).width()< 214*5){
            sidebar_close_category();
                
        }else{
            sidebar_open_category();
        }
        
});
function sidebar_open_category() {
    var main1 = $(window).width();
    var column1 =  ~~((main1-240)/214);
        var totalArticle = "<?php echo count($articleTypes);?>";
        // console.log(totalArticle);
        
               $(".regular_category").slick({
                dots: false,
                infinite: true,
                useTransform: false,
                slidesToShow: ~~((main1-240)/214),
                slidesToScroll: 1,
                variableWidth: true
              });
        
        
}
function sidebar_close_category() {
    var main1 = $(window).width();
var column1 =  ~~(main1-240);
        var totalArticle = "<?php echo count($articleTypes);?>";
        // console.log(totalArticle);
    
        $(".regular_category").slick({
            dots: false,
            infinite: true,
            useTransform: false,
            slidesToShow: ~~(main1/214),
            slidesToScroll: 1,
            variableWidth: true
          });
    
    
}
</script> 
   
   
