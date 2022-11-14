<?php
use  yii\helpers\Url;
use yii\widgets\LinkPager;
use common\models\BuildingProjectInfo;
use yii\widgets\ActiveForm;
use frontend\widgets\AuthChoiceCustom;
use yii\helpers\Html;
use common\libraries\PseudoCrypt;

?>
<?php echo HeaderUserDetail::widget();?>
	<input type="hidden" id="id" value="<?php echo isset($user)?$user->id:0;?>"/>
	<input type="hidden" id="name" value="<?php echo preg_replace( "/\r|\n/", "", isset($user)?$user->name:'guest');?>"/>
	<div id="main" class="detail">
	<div class="user-detail">
	<div class="header" style="height: 230px; width:100%; float:left; margin-bottom:30px;">
	<img class="banner" style="width:100%" src="/images/channels4_banner.jpg"/>
		<div class="col-md-12 nopadding" style="position: absolute; top: 100px;">
							<div class="box">
								<div class="box-body box-profile">
								<a  title="<?php echo $user->name; ?>" href="<?php echo Yii::$app->params['elandUrl'];?>kenh/<?php echo $user->id; ?>">
										<span class="status status_<?php echo $user->id; ?>" id="status_<?php echo $user->id; ?>"></span>
										<img style="border:3px solid white; width: 100px;height: 100px; border-radius: 100%;float: left;" id="notifi_<?php echo $user->id;?>" class="img" src="<?php echo $user->image?(Yii::$app->params['elandUrl'].'avatar/user/'.$user->image): (Yii::$app->params['elandUrl']. "images/no-image.png"); ?>" alt="<?php echo $user->name; ?>"/>
										<input type="hidden" name="receiver[]" value="<?php echo $user->id; ?>">
								</a>
							<div class="box-right" style=" float: left; margin-top: 18px; padding: 0px 20px; width: calc( 100% - 200px);">
								<div class="col-md-12 nopadding">
								<a style="font-weight: bold; color: #fff; font-size: 24px; line-height: 30px; max-width: 275px;" title="duong tran ha" href="http://www.elanddev.com/kenh/13935">duong tran ha</a>
								<span>(1100 người)Theo dõi</span>
								<br><i class="fa fa-clock-o" aria-hidden="true"></i> <small>12/08/2019</small>
								<div class="star" style="float:left; margin-right: 10px; height:28px;">
								<img src="/images/star-on.png" alt="1">
								<img src="/images/star-on.png" alt="2">
								<img src="/images/star-on.png" alt="3">
								<img src="/images/star-on.png" alt="4">
								<img src="/images/star-off.png" alt="5">
								</div>
								</div>
							<ul class="nav nav-tabs">
								 <li><a  href="<?php echo Yii::$app->getUrlManager()->createUrl(['user/index','id' => $user->id]);?>"><i class="fa fa-address-book-o" aria-hidden="true"></i> Trang chủ</a></li>
								 <li><a  href="<?php echo Yii::$app->getUrlManager()->createUrl(['user/about','id' => $user->id]);?>"><i class="fa fa-file-text-o margin-r-5"></i> Giới thiệu</a></li>
								<li style="float:right"><a class="btn btn-sm btn-danger btn-block" href="<?php echo Yii::$app->getUrlManager()->createUrl(['user/post','id' => $user->id]);?>"><i class="fa fa-address-card" aria-hidden="true"></i> Đăng bài</a></li>
							</ul>
									</div>
							</div>	
							
						</div>
				</div><!-- /.box-body -->
				
              </div>
			  

<div class="body">

	<div id="container" class="container">
	<div class="tab-content" >
		<?php if($myself){?>
		 <div id="1" class="tab-pane fade in active">
				<div class="panel-body">
					<div class="box box-solid">
						<div class="box-header with-border">
						   <h3 class="box-title">Giới thiệu</h3>
						</div><!-- /.box-header -->
						<div class="box-body">
						   <table class="table table-bordered">
								<tbody>
									<tr>
										<td>Họ và Tên</td>
										<td><input name="User[name]" type="text" value="<?php echo $user->name;?>"/></td>
									</tr>
									<tr>
										<td>Ngày sinh</td>
										<td><input name="User[birthday]" type="text" value="<?php echo $user->birthday;?>"/></td>
									</tr>
									<tr>
										<td>Giới tính</td>
										<td><input name="User[sex]" type="text" value="<?php echo $user->sex;?>"/></td>
									</tr>
									</tbody>
							</table>		
						</div><!-- /.box-body -->
					  </div>
					  
					  <div class="box box-solid">
						<div class="box-header with-border">
						  
						  <h3 class="box-title">Giới thiệu về bạn	</h3>
						</div><!-- /.box-header -->
						<div class="box-body">
						  <textarea class="form-control" rows="4" cols="100%">
						   </textArea>	
						</div><!-- /.box-body -->
					  </div>
					  
					  <div class="box box-solid">
						<div class="box-header with-border">
						  
						  <h3 class="box-title">Thông tin liên hệ</h3>
						</div><!-- /.box-header -->
						<div class="box-body">
						  
									
										<?php
							$form = ActiveForm::begin([
								
									'options' =>[
													'enctype' => 'multipart/form-data',
													'class' => 'form-login',
												],
													 
							]);
							?>
											<div  class="col-sm-12 price_text nopadding">
												<?php echo $form->field($user, 'phone',['template' => '{input}'])->textInput(['autocomplete' => 'off', 'placeholder'=> 'Số điện thoại'])->label(false) ?>
											</div>
											<div  class="col-sm-12 price_text nopadding">
												<?php echo $form->field($user, 'email',['template' => '{input}'])->textInput(['autocomplete' => 'off', 'placeholder'=> 'Địa chỉ Email'])->label(false) ?>
											</div>
											<div  class="col-sm-12 price_text nopadding">
												<?php echo $form->field($user, 'eland',['template' => '{input}'])->textInput(['autocomplete' => 'off', 'placeholder'=> 'Địa chỉ E-land'])->label(false) ?>
											</div>
											<div  class="col-sm-12 price_text nopadding">
												<?php echo $form->field($user, 'skype',['template' => '{input}'])->textInput(['autocomplete' => 'off', 'placeholder'=> 'Id skype'])->label(false) ?>
											</div>
											<div  class="col-sm-12 price_text nopadding">
												<?php echo $form->field($user, 'zalo',['template' => '{input}'])->textInput(['autocomplete' => 'off', 'placeholder'=> 'Địa chỉ Zalo'])->label(false) ?>
											</div>
											<div  class="col-sm-12 price_text nopadding">
												<?php echo $form->field($user, 'facebook',['template' => '{input}'])->textInput(['autocomplete' => 'off', 'placeholder'=> 'Địa chỉ Facebook'])->label(false) ?>
											</div>
											<div class="col-sm-12 address nopadding">
													<div class="col-sm-12 nopadding">	
															<div class="province">
																<?php echo $form->field($user, 'province_id',['template' => '{input}'])
																->dropDownList(
																	$provinces,           // Flat array ('id'=>'label')
																	[
																		'prompt'=>'* Tỉnh/Thành phố',
																		
																	]    // options
																)->label(false) ?>
															</div>
															<div class="district">
																<?php echo $form->field($user, 'district_id',['template' => '{input}'])
															->dropDownList(
																$districts,           // Flat array ('id'=>'label')
																[
																	'prompt'=>'* Quận/Huyện',
																	
																]    // options
															)->label(false) ?>	
															</div>		
															<div class="street">
													<?php echo $form->field($user, 'street',['template' => '{input}'])
														->textInput(['autocomplete' => 'off', 'placeholder'=> 'Số nhà, Thôn/Xóm, Ấp/Xã, Phường, Đường'])->label(false) ?>
													</div>	
													</div>
											</div>
										
										 <?php ActiveForm::end(); ?>
									
						</div><!-- /.box-body -->
					  </div>
					  
					
			  </div>
		</div>
		<?php }?>
  </div>
</div>
</div>
</div>
</div>

