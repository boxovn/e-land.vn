<?php 
use common\models\Post;
use yii\data\Pagination;
use yii\widgets\LinkPager;
?>
<!-- content -->   
    <div class="content-wrapper">
 <!-- top-content -->
       <div id="top-content">
            <div class="container">
            	<div class="row">
                	<div class="col-sm-6">
                    	<h1 class="h1-title" title="tin tức" >TIN TỨC</h1>
                    </div>
                    <div class="col-sm-6 text-right">
                    	<span class="link-top"><a href="<?php echo Yii::$app->getUrlManager()->createUrl(['index']) ?>" >TRANG CHỦ </a></span>/<span class="link-top">TIN TỨC</span>
                    </div>
                </div>
            	
            </div>
       </div>
 <!-- top-content  -->   
 
   <!-- part2 -->
  		<div class="container">
        	<div class="row">
                    <?php foreach ($posts as $key=> $post):?>
                   <?php if($key%3==0):?>
                    <div class="col-md-12 col-sm-12"></div>
                    <?php                        endif;?>
            	<div class="col-sm-4 col-md-4">
                	<div class="contai-new">
                            <img alt="<?php echo $post->title;?>" style="height: 199px" class="img-responsive1 pding20-bt" src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/img/<?php echo $post->image;?>">
                        <div class="row">
                        	<div class="col-xs-3">
                            	<div class="day-c text-center">
                                	 <?php echo date('d', strtotime($post->created)) ?><br>
                                    <span> <?php echo date('M', strtotime($post->created)) ?></span>
                                    <p>
                                    	0 <span class="glyphicon glyphicon-comment"></span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-xs-9">
                                    
                                <h3 class="h3-title12"><a title="<?php echo $post->title;?>" href="<?php echo Yii::$app->getUrlManager()->createUrl(['post/detail','id'=>$post->post_id,'title'=>  strtolower(str_replace(' ','-',trim(stripVN($post->title))))]) ?>">
				
                                  <?php echo $post->title;?>
                           
				</a> </h3>
                                    <p class="h-con">
                                     <?php if(strlen($post->description)>=220):?>
                                <?php echo substr($post->description,0,220).'...';?><a href="<?php echo Yii::$app->getUrlManager()->createUrl(['post/detail','id'=>$post->post_id,'title'=>  strtolower(str_replace(' ','-',trim(stripVN($post->title))))]) ?>">Xem thêm</a>
                            <?php else:?>
                                  <?php echo $post->description. '...';?><a href="<?php echo Yii::$app->getUrlManager()->createUrl(['post/detail','id'=>$post->post_id,'title'=> strtolower(str_replace(' ','-',trim(stripVN($post->title))))]) ?>">Xem thêm</a>
                            <?php endif;?>
                             
                                    </p>
                                    <p class="color-v"></p>
                                </div>
                        </div>
                    </div>
                </div>
               <?php endforeach;?>
            </div>
            
            <div class="nut-next text-center">
                
               
            	<div class="row">
                <div class="paging text-center">
                
                    <?php
                        echo LinkPager::widget([
                                'pagination'=>$pages,
                                'prevPageLabel' => '<i class="glyphicon glyphicon-chevron-left"></i>',   // Set the label for the "previous" page button
                                'nextPageLabel' => '<i class="glyphicon glyphicon-chevron-right"></i>',   // Set the label for the "next" page button
                            ]);
                    ?>
                    
                </div>
            </div>    
            </div>
        </div>
   <!-- part2 -->
   
    </div>
	<?php 
function stripVN($str) {
    $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
    $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
    $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
    $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
    $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
    $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
    $str = preg_replace("/(đ)/", 'd', $str);

    $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
    $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
    $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
    $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
    $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
    $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
    $str = preg_replace("/(Đ)/", 'D', $str);
	$str = preg_replace("/(,)/", '', $str);
	$str = preg_replace("/(\")/", '', $str);
	$str = preg_replace("/( – )/", '-', $str);
    return $str;
}
?>