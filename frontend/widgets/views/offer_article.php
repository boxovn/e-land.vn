<?php
use  yii\helpers\Url;
use yii\helpers\Html;
?>
 
  <style type="text/css">
  
    .slider {
        width: 100%;
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
  </style>
<div class="list-box"> 
			<div class="list-head">
				<h2 class="list-title"><?=$title;?></h2>
				<!--<div  class="btn-view-more">
					<a class="btn btn-danger btn-sm" href="<?php echo Url::to(['article/category','category' => $slug],true);?>"> Xem thêm</a>
				</div>
			-->
			</div>
			<section class="regular slider">
			<?php foreach ($articles as $key => $value) { 
					$image = $value->image;
					
					?>
					<div>
					<div class="column">
						<a class="box-image" href="<?php echo Url::to(['article/detail', 'province' => isset($value->province)?$value->province->slug:'', 'district' => isset($value->district)?$value->district->slug:'', 'category' => isset($value->articleType)?$value->articleType->slug:'', 'slug' => $value->slug],true);?>">
								<img onerror="if (this.src != 'error.jpg') this.src = '<?php echo Url::to('@web/images/no-image210x118.png', true)?>';" width="210px" height="118px" class="image" alt="<?php echo $value->title; ?>"  src="<?php echo Url::to('@web/channels/article/210x118/' . $image, true)?>"/>
								<div class="box-label">
									<div style="width: calc(100% - 35px); float:left;">
										<span>Giá: <?php echo $value->price_text; ?></span>
										<span>Diện tích : <?php echo $value->area_text; ?></span>
										<p class="address"><?php echo $value->address; ?></p>
									</div>
								</div>
							
								<div class="box-time">
									<i class="fa fa-clock-o" aria-hidden="true"></i>  <span><?php echo date('d/m/Y', strtotime($value->post_date)); ?></span>
								</div>
						</a>
						<div class="box-description">
							<h3><a title="<?php echo $value->title; ?>"  class="title" href="<?php echo Url::to(['article/detail', 'province' => isset($value->province)?$value->province->slug:'', 'district' => isset($value->district)?$value->district->slug:'', 'category' => isset($value->articleType)?$value->articleType->slug:'', 'slug' => $value->slug],true);?>"><?php echo $value->title; ?></a></h3>
							<div  class="province" >
								<?php if(isset($value->district) && isset($value->province)){?>
								<a title="<?php echo isset($value->district)?($value->district->type . ' ' . $value->district->name):'';?>" href="<?php echo Url::to(['article/district','district' => $value->district->slug,'province' => $value->province->slug],true);?>">
									<?php echo isset($value->district)?($value->district->type . ' '. $value->district->name):'';?>
								</a>
								<a title="<?php echo isset($value->province)?$value->province->name:'';?>" href="<?php echo Url::to(['article/category','category' => $value->province->slug],true);?>">
								, <?php echo isset($value->province)?$value->province->name:'';?>
								</a>
								<?php }?>
							</div>
						</div>
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
<script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
<script type="text/javascript">
	var totalArticle = "<?php echo count($articles);?>";
</script>
<?php echo $this->registerCssFile('@web/plugins/slick/slick-theme.css', [
    'depends' => [frontend\assets\AppAsset::className()],
]); ?>  
<?php echo $this->registerCssFile('@web/plugins/slick/slick.css', [
    'depends' => [frontend\assets\AppAsset::className()],
]); ?>   
   
     
<?php  echo $this->registerJsFile('@web/plugins/slick/slick.js', ['position' => \yii\web\View::POS_END]);?>   
<?php  echo $this->registerJsFile('@web/js/offer_article.js', ['position' => \yii\web\View::POS_END]);?>     
 
