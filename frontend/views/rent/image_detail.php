<?php 
use  yii\helpers\Url;
use yii\helpers\Html;
use common\libraries\PseudoCrypt;
use frontend\widgets\RegisterViewHouse;
use frontend\widgets\LoginDialog;
use yii\widgets\ActiveForm;
use yii\bootstrap\BootstrapPluginAsset;
BootstrapPluginAsset::register($this);
?>
  <div class="modal-header">
					<div class="md-nav"> 
          <ul> 
                        <li class="tab-images active"> 
                          <a class="tablinks"onclick="changeModalContent(event, 'tab-images'); return false;">
                            <i class="far fa-images"></i> Hình ảnh</a>
                        </li> 
                        <li class="tab-map">
                          <a class="tablinks" onclick="changeModalContent(event, 'tab-map'); return false;">
                            <i class="fas fa-map-marked-alt"></i> Bản đồ</a>
                        </li> 
            </ul> 
					</div>
					<div class="md-btn"> 
								<div class="dropdown">
										<button class="btn dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown"><i class="far fa-lg fa-share-square"></i></button>
									
										<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                        <li  class="title1" role="presentation"><a role="menuitem" tabindex="-1" href="#">Chia sẻ</a></li>
                        
                        <li role="presentation"><a  role="menuitem" tabindex="-1" href="https://www.facebook.com/sharer.php?u=<?php echo Url::to(['article/detail', 'province' => isset($model->province)?$model->province->slug:'', 'district' => isset($model->district)?$model->district->slug:'', 'type' => isset($model->articleType)?$model->articleType->slug:'', 'slug' => $model->slug,'id' => $model->id],true);?>&amp;_ga=2.262799108.90586406.1618995599-1423784879.1617296165&amp;_gac=1.218485355.1619173958.Cj0KCQjw4ImEBhDFARIsAGOTMj9f1bqZ01lhTbLIUWSb_me2OwSR6MemqwQA4Fp34MF2Cguj9oZtTHUaAkR1EALw_wcB" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=220,width=600');return false;" target="_blank"> <i class="fab fa-facebook"></i> </a></li>
                        <li role="presentation"><a  role="menuitem" tabindex="-1" href="mailto:?body=<?php echo Url::to(['article/detail', 'province' => isset($model->province)?$model->province->slug:'', 'district' => isset($model->district)?$model->district->slug:'', 'type' => isset($model->articleType)?$model->articleType->slug:'', 'slug' => $model->slug,'id' => $model->id],true);?>" target="_blank"> <i class="fas fa-envelope"></i> </a></li>
                        <li role="presentation"><a  role="menuitem" tabindex="-1" href="https://www.linkedin.com/shareArticle?url=<?php echo Url::to(['article/detail', 'province' => isset($model->province)?$model->province->slug:'', 'district' => isset($model->district)?$model->district->slug:'', 'type' => isset($model->articleType)?$model->articleType->slug:'', 'slug' => $model->slug,'id' => $model->id],true);?>" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="fab fa-linkedin"></i> </a></li>
                        <li role="presentation">
                          <div class="zalo-share-button" data-href="<?php echo Url::to(['article/detail', 'province' => isset($model->province)?$model->province->slug:'', 'district' => isset($model->district)?$model->district->slug:'', 'type' => isset($model->articleType)?$model->articleType->slug:'', 'slug' => $model->slug,'id' => $model->id],true);?>" data-oaid="579745863508352884" data-layout="2" data-color="white" data-customize=false>
                        </div>
                        </li>
									  </ul>
                </div>
								<button class="btn" type="button" data-dismiss="modal"><i class="far fa-lg fa-times-circle"></i></button>
							</div>
			      </div>
                <div class="modal-body">
                    <div id="tab-images" class="tabcontent">
                          
                  
                                            <div class="product-slider">
                                                <div id="carousel" class="carousel slide" data-ride="carousel">
                                                    <div class="carousel-inner">
                                        
                                                      <?php foreach($articleImages as $key => $value){?>
                                                        <div class="item <?php echo ($key==0)? 'active':'';?>"> <img src="<?php echo Url::to('@web/channels/article/745x510/' . $value->image, true);?>"> </div>
                                                      <?php }?>
                                        
                                      
                                                </div>
                                                </div>
                                                <div class="clearfix">
                                                    <div id="thumbcarousel" class="carousel slide" data-interval="false">
                                                    <div class="carousel-inner">
                                                      <div class="item active">
                                                        <?php foreach($articleImages as $key => $value){?>
                                                          <div data-target="#carousel" data-slide-to="<?php echo $key;?>" class="thumb"><img src="<?php echo Url::to('@web/channels/article/745x510/' . $value->image, true);?>"></div>
                                                        
                                                        <?php }?>
                                                      
                                                      </div> 
                                                    
                                                    
                                                    </div>
                                                    <!-- /carousel-inner --> 
                                                    <a class="left carousel-control" href="#thumbcarousel" role="button" data-slide="prev"> <i class="fa fa-angle-left" aria-hidden="true"></i> </a> <a class="right carousel-control" href="#thumbcarousel" role="button" data-slide="next"><i class="fa fa-angle-right" aria-hidden="true"></i> </a> </div>
                                                  <!-- /thumbcarousel --> 
                                                  
                                                  </div>
                                                </div>
                                          </div>
                   </div>
                   <div id="tab-map" class="tabcontent">
                      <iframe  src="https://e-land.vn/article/map?lat=10.714645&lng=106.639070&category=article&id=<?php echo $model->id;?>"></iframe>
                  </div>
        		    
						</div>
							
					  <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
      </div>
	  
<?php echo LoginDialog::widget(); ?>


	  