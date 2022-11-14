<?php
use  yii\helpers\Url;
use yii\helpers\Html;
?>
<div class="list-box"> 
			<div class="list-head">
				<h2 class="list-title"><?=$title;?></h2>
				<!--<div  class="btn-view-more">
					<a class="btn btn-danger btn-sm" href="<?php echo Url::to(['article/category','category' => $slug],true);?>"> Xem thêm</a>
				</div>
			-->
			</div>
			<?php foreach ($articles as $key => $value) { 
					$image = $value->image;
						if( isset($value->province) &&  isset($value->district)){	
					?>
					<div class="column" >
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
					  <?php } ?>
        <?php } ?>
         <div class="list-food">
				<div class="view-more">
					<a class="btn btn-sm btn-block" href="http://e-land.vn/"><i class="fa fa-caret-down" aria-hidden="true"></i> Xem thêm</a>
				</div>
			</div>
    </div>
	