<?php 
use  yii\helpers\Url;
use common\libraries\PseudoCrypt;
use frontend\widgets\RegisterViewHouse;
use frontend\widgets\LoginDialog;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\bootstrap\BootstrapPluginAsset;
BootstrapPluginAsset::register($this);
?>

<?php $this->registerCSSFile(Yii::$app->request->baseUrl . '/plugins/datetimepicker-master/jquery.datetimepicker.css'); ?>

				<div class="modal-header">
					<div>
							<div class="md-nav"> 
								<div class="modal-title" title="<?php echo $model->title;?>">
										<img class="user-avatar"
										onerror="if (this.src != 'error.jpg') this.src = '<?php echo Url::to('@web/images/no-image200x200.png', true)?>';"
										
										id="notifi_<?php echo $articelUser->id;?>" class="img" 
										src="<?php echo Url::to('@web/channels/avatar/' . $model->user->image, true); ?>" 
										alt="<?php echo $articelUser->name; ?>"/>
						 				<span class="box-title"><?php echo $model->title;?></span>
								</div>
								
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
								<button class="btn"  data-dismiss="modal" aria-label="close" type="button"><i class="far fa-lg fa-times-circle"></i></button>
							</div>
					</div>
					
				</div>
                <div class="modal-body">
				<div class="md-nav-tab"> 
            <ul> 
                        <li class="tab-images active"> 
                          <a class="tablinks" onclick="changeModalContent(event, 'tab-images'); return false;">
                            <i class="far fa-images"></i> Hình ảnh</a>
                        </li> 
                        <li class="tab-map">
                          <a class="tablinks" onclick="changeModalContent(event, 'tab-map'); return false;">
                            <i class="fas fa-map-marked-alt"></i> Bản đồ</a>
                        </li> 
            </ul> 
        </div>

            <div id="tab-images" class="tabcontent">
                    <?php if($articleImages){?>
                              <div class="article-slider">
                                  <div id="carousel" class="carousel slide" data-ride="carousel"  data-bs-ride="carousel">
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
                                            <div data-target="#carousel" data-slide-to="<?php echo $key;?>" class="thumb">
                                            <img src="<?php echo Url::to('@web/channels/article/745x510/' . $value->image, true);?>">
                                            </div>
                                      
                                        <?php }?>
                                      
                                    </div> 
                                    
                                    
                                    </div>
                                    <!-- /carousel-inner --> 
                                    <a class="left carousel-control" href="#carousel" role="button" data-slide="prev"> <i class="fa fa-angle-left" aria-hidden="true"></i> </a> 
                                    <a class="right carousel-control" href="#carousel" role="button" data-slide="next"><i class="fa fa-angle-right" aria-hidden="true"></i> </a> 
                                  </div>
                                  <!-- /thumbcarousel --> 
                                  
                                  </div>
                                </div>
                    <?php }?>
            </div>
            <div id="tab-map" class="tabcontent">
                                            <iframe  src="https://e-land.vn/article/map?lat=10.714645&lng=106.639070&category=article&id=<?php echo $model->id;?>"></iframe>
            </div>
												<div class="dl-group-button">
													
														<?php 
                            	                $user = \Yii::$app->user->identity;
																														if(!$user){ ?>
																															<button type="button" class="btn  btn-md btn-chat showLogin" data-href="<?php echo Url::to(['article/article-login', true]);?>" data-toggle="modal" data-target="#exampleModalLong">
																															<i class="fas fa-comments fa-lg" aria-hidden="true"></i> <small>Nhắn tin</small>
																															</button>
																														<?php }else {?>
																															<button class="btn btn-md  btn-chat" onclick="register_popup(<?php echo ((isset($user)?$user->id:0) + $model->user->id);?>,<?php echo isset($user)?$user->id:0;?>,'<?php echo preg_replace( "/\r|\n/", "", isset($user)?$user->name:'');?>',<?php echo $model->user->id; ?>,'<?php echo preg_replace( "/\r|\n/", "", $model->user->name);?>')">
																															<i class="fas fa-comments fa-lg" aria-hidden="true"></i> <small>Nhắn tin</small>
																															</button>
																														<?php }?>
														        <button class="btn btn-md" id="register-view-house"><i class="far fa-lg fa-eye"></i> Đăng ký xem nhà</button>
													</div>	
						<div class="ladding-content">
						
									
												
												<?php echo $model->content;?>
									
							</div>
						
							<?php if($articleDetail){?>
							<div class="product-contact">
										<table class="table table-bordered">
                    <tbody>
						<tr>
						 
						  <td style="width: 25%">Mặt tiền (m)</td>
							<td style="width: 25%"><?php echo $articleDetail->frontend;?></td>
						  <td style="width: 25%">Đường vào (m)</td>
							<td style="width: 25%"><?php echo $articleDetail->gateway;?></td>
						</tr>
                    <tr>
						<td style="width: 25%">Hướng nhà</td>
						<td style="width: 25%">
							<?php echo $articleDetail->direction;?>
						</td>
						<td style="width: 25%">Số tầng (tầng)</td>
						<td style="width: 25%"><?php echo $articleDetail->floor;?></td>
                    </tr>
                     <tr>
						<td style="width: 25%">Số phòng ngủ (phòng)</td>
						<td style="width: 25%"><?php echo $articleDetail->room;?></td>
						<td style="width: 25%">Số phòng vệ sinh (phòng)</td>
						<td style="width: 25%"><?php echo $articleDetail->toilet;?></td>
                    </tr>
					<tr>
						<td style="width: 25%">Nội thất</td>
						<td style="width: 25%"><?php echo $articleDetail->interior;?></td>
						<td style="width: 25%">Ngoại thất</td>
						<td style="width: 25%"><?php echo $articleDetail->exterior;?></td>
                    </tr>
                  </tbody></table>
							</div>
							<?php }?>
							<div class="product-contact" id="form-register-view-house">
							
              <div class="widget widget-register">
                                                                                <h3 class="widget-title widget-title">Đăng ký xem nhà</h3> 
                                                                                <div class="widget-content">
                                                                            <?php 
                                                                                //$form = ActiveForm::begin(); //Default Active Form begin
                                                                                $form = ActiveForm::begin([
                                                                                    'action' => Url::to(['article/article-booking','id' => $model->id], true),
                                                                                    'method' => 'post',
                                                                                    'id' => 'active-form',
                                                                                    'options' => [
                                                                                        'class' => 'form-horizontal',
                                                                                        'enctype' => 'multipart/form-data'
                                                                                    ],
                                                                                ]);?>


                                                                            <?= $form->field($articleBooking, 'name',['template' => '
                                                                            
                                                                                  <div class="input-group">
                                                                                      <span class="input-group-addon">
                                                                                      <i class="far fa-user"></i>   
                                                                                      </span>
                                                                                      {input}
                                                                                  </div>
                                                                                  {error}{hint}
                                                                              '])->textInput(['placeHolder' => '* Nhập họ tên'])
                                                                                              //  ->hint('Vui lòng nhập Họ và Tên')
                                                                                                ->label(false) ?>
                                                                            
                                                                            <?= $form->field($articleBooking, 'phone',['template' => '
                                                                            
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon">
                                                                                <i class="fas fa-phone"></i>   
                                                                                </span>
                                                                                {input}
                                                                            </div>
                                                                            {error}{hint}
                                                                            '])->textInput(['placeHolder' => '*Nhập số điện thoại'])
                                                                                              // ->hint('Vui lòng nhập số điện thoại hợp lệ')
                                                                                                ->label(false) ?>
                                                                                                
                                                                            <?= $form->field($articleBooking, 'email',['template' => '
                                                                            
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon">
                                                                                <i class="far fa-envelope"></i>
                                                                                </span>
                                                                                {input}
                                                                            </div>
                                                                            {error}{hint}
                                                                            '])->textInput(['placeHolder' => '*Nhập email'])
                                                                                              //  ->hint('Vui lòng nhập địa chỉ email hợp lệ')
                                                                                                ->label(false) ?>  
                                                                            <?= $form->field($articleBooking, 'date',['template' => '
                                                                            
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon">
                                                                                <i class="far fa-calendar"></i>
                                                                                </span>
                                                                                {input}
                                                                            </div>
                                                                            {error}{hint}
                                                                            '])->textInput(['autocomplete'=> "off",'placeHolder' => '*Nhập ngày giờ muốn xem'])
                                                                                              // ->hint('Vui lòng nhập ngày muốn xem')
                                                                                                ->label(false) ?>                                      
                                                                            <?= $form->field($articleBooking, 'content')->textarea(array('placeHolder' => 'Vui lòng nhập thông tin cần hỗ trợ tư vấn','rows'=>2,'cols'=>5))->label(false); ?>
                                                                            <div class="form-group">
                                                                                    
                                                                                        <?= Html::submitButton('<i class="fas fa-lg fa-house-user"></i> Đăng ký', ['class' => 'btn btn-block btn-register']) ?>
                                                                                  
                                                                                </div>
                                                                                <?php
                                                                                /* ADD FORM FIELDS */
                                                                            ActiveForm::end();
                                                                            ?>
                                                                            </div>
                                                         </div>
								               
                                                      
						</div>
						
					</div>
					<div class="modal-footer">
              <button type="button"  data-dismiss="modal" aria-label="close" class="btn btn-default">Đóng</button>
          </div>  
            <?php $this->registerJsFile(Yii::$app->request->baseUrl.'/js/article_detail.js',['depends' => [yii\bootstrap\BootstrapAsset::className()]]); ?>
            <?php $this->registerJsFile(Yii::$app->request->baseUrl.'/plugins/datetimepicker-master/jquery.datetimepicker.full.js',['depends' => [yii\bootstrap\BootstrapAsset::className()]]); ?>
            <?php $this->registerJsFile('https://sp.zalo.me/plugins/sdk.js',['depends' => [yii\bootstrap\BootstrapAsset::className()]]); ?>
<script>
 
  	
  jQuery(document).ready(function () {
      'use strict';
      jQuery.datetimepicker.setLocale('vi');
     /* jQuery('#articlebooking-date').datetimepicker({
			dayOfWeekStart : 1,
   //   inline:true,
			format:'H:i d/m/Y'
		});*/

    jQuery('#articlebooking-date').datetimepicker({
ownerDocument: document,
contentWindow: window,

value: '',
rtl: false,

format: 'd/m/Y H:i',
formatTime: 'H:i',
formatDate: 'd/M/Y',

startDate:  false, // new Date(), '1986/12/08', '-1970/01/05','-1970/01/05',
step: 60,
monthChangeSpinner: true,

closeOnDateSelect: false,
closeOnTimeSelect: true,
closeOnWithoutClick: true,
closeOnInputClick: true,
openOnFocus: true,

timepicker: true,
datepicker: true,
weeks: false,

defaultTime: false, // use formatTime format (ex. '10:00' for formatTime: 'H:i')
defaultDate: false, // use formatDate format (ex new Date() or '1986/12/08' or '-1970/01/05' or '-1970/01/05')

minDate: false,
maxDate: false,
minTime: false,
maxTime: false,
minDateTime: false,
maxDateTime: false,

allowTimes: [],
opened: false,
initTime: true,
inline: false,
theme: '',
touchMovedThreshold: 5,

onSelectDate: function (v) {
  var d =  v.getDate();
  console.log(d);
  
},
onSelectTime: function (v) {
  var t = v.getTime();
  console.log(t);
},
onChangeMonth: function () {
 
},
onGetWeekOfYear: function () {},
onChangeYear: function () {},
onChangeDateTime: function () {},
onShow: function () {},
onClose: function () {},
onGenerate: function () {},

withoutCopyright: true,
inverseButton: false,
hours12: false,
next: 'xdsoft_next',
prev : 'xdsoft_prev',
dayOfWeekStart: 0,
parentID: 'body',
timeHeightInTimePicker: 25,
//timepicker<a href="https://www.jqueryscript.net/tags.php?/Scroll/">Scroll</a>bar: true,
todayButton: true,
prevButton: true,
nextButton: true,
defaultSelect: true,

scrollMonth: true,
scrollTime: true,
scrollInput: true,

lazyInit: false,
mask: false,
validateOnBlur: true,
allowBlank: true,
yearStart: 1950,
yearEnd: 2050,
monthStart: 0,
monthEnd: 11,
style: '',
id: '',
fixed: false,
roundTime: 'round', // ceil, floor
className: '',
weekends: [],
highlightedDates: [],
highlightedPeriods: [],
allowDates : [],
allowDateRe : null,
disabledDates : [],
disabledWeekDays: [],
yearOffset: 0,
beforeShowDay: null,

enterLikeTab: true,
showApplyButton: false
});
  });

  </script>
<?php $user = \Yii::$app->user->identity;
if($user){
$this->registerJsFile('https://chat.batdongsaneland.com/socket.io/socket.io.js', ['depends' => [yii\bootstrap\BootstrapAsset::className()]]);
$this->registerJsFile('https://chat.batdongsaneland.com/user.js', ['depends' => [yii\bootstrap\BootstrapAsset::className()]]);
}
?>


      