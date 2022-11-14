<?php
use  yii\helpers\Url;
use yii\helpers\Html;
?>
<?php if($articles){?>
  <style type="text/css">
   
    .slider {
        width: 100%;
        margin: 0px auto 0 auto;
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
        
        border-radius: 4px;
    } 
  </style>
 
<div > 
            <div class="list-head">
                <h2 class="list-title"><?=$title;?></h2>
               
            </div>
            <div><center>
                <a style=" background-color: #c00; color:#fff; border-radius: 2px; padding:5px 10px" href="<?php echo Url::to(['article/slug_province-or_slug_category-or_slug_type','slug' => $province],true);?>"><i class="fa fa-caret-down" aria-hidden="true"></i>Tẩt cả</a>
            </center></div>
            <section class="regular_province slider" style="display:none">
            <?php  foreach ($articles as $key => $value) { 
                ?>
                    <div style="float:left;">
                    <div style="padding:8px;">
                        <a class="slick-block" style="color: #fff; background-color: #fafafa;border: 1px solid #ddd;" title="<?php echo $value->title;?>" href="<?php echo Url::to(['article/detail', 'province' => isset($value->province)?$value->province->slug:'', 'district' => isset($value->district)?$value->district->slug:'', 'type' => isset($value->articleType)?$value->articleType->slug:'', 'slug' => $value->slug],true);?>">
                            <span style="position: absolute; top: 50px; background: rgba(0, 0, 0, 0.5); padding: 5px; border-radius: 5px;">
                                <?php echo $value->price_text;?>
                                - <?php echo $value->area_text;?>
                                - <?php echo $value->district->name;?>
                            </span>

                            <img onerror="if (this.src != 'error.jpg') this.src = '<?php echo Url::to('@web/images/no-image210x118.png', true)?>';" alt="<?php echo $value->title;?>" style="width:210px; height:118px;" src="<?php echo Url::to('@web/channels/article/210x118/' . $value->image, true);?>"/>
                        </a>
                    </div>
                    </div>
        
        <?php } ?>
         </section>
          
</div>
<script type="text/javascript">
    
    $( document ).ready(function() {
            $('.regular_province').show();
    if($(window).width()< 1200){
            sidebar_close_province();
    }else{
            sidebar_open_province();
    }
});
$( window ).resize(function() {

            $('.regular_province').show();
    if($(window).width()< 214*5){
            sidebar_close_province();
                
        }else{
            sidebar_open_province();
        }
        
});
function sidebar_open_province() {
    var main1 = $(window).width();
    var column1 =  ~~((main1-240)/214);
        var totalProvince = "<?php echo count($articles);?>";
         console.log(totalProvince);
        
               $(".regular_province").slick({
                dots: false,
                infinite: true,
                useTransform: false,
                slidesToShow: ~~((main1-240)/214),
                slidesToScroll: 1,
                variableWidth: true
              });
        
        
}
function sidebar_close_province() {
    var main1 = $(window).width();
var column1 =  ~~(main1-240);
        var totalProvince= "<?php echo count($articles);?>";
         console.log(totalProvince);
    
        $(".regular_province").slick({
            dots: false,
            infinite: true,
            useTransform: false,
            slidesToShow: ~~(main1/214),
            slidesToScroll: 1,
            variableWidth: true
          });
    
    
}
</script> 
<?php }?>
   
   
