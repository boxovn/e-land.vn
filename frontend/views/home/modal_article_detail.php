<?php
use  yii\helpers\Url;
use common\libraries\PseudoCrypt;
use frontend\widgets\RegisterViewHouse;
use frontend\widgets\LoginDialog;
//use yii\widgets\ActiveForm;
use yii\helpers\Html;
//use yii\bootstrap\BootstrapPluginAsset;
//BootstrapPluginAsset::register($this);
?>
<?php $this->registerCSSFile(Yii::$app->request->baseUrl . '/plugins/datetimepicker-master/jquery.datetimepicker.css'); ?>
<div class="modal-header">
	<div class="row w-100 m-0">
		<div class="col-md-12">
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
					<button class="btn dropdown-toggle" type="button" id="dropdownMenu1" data-bs-toggle="dropdown" aria-expanded="false"><i class="far fa-lg fa-share-square"></i></button>
					
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
				<button class="btn"  data-bs-dismiss="modal" aria-label="close" type="button"><i class="far fa-lg fa-times-circle"></i></button>
				
			</div>
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
			<div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
				<div class="carousel-indicators">
					<?php foreach($articleImages as $key => $value){?>
					<button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="<?php echo $key;?>"  <?php echo ($key==0)?'class="item active" aria-current="true" ':'class="item" ';?> aria-label="Slide 1"></button>
					<?php }?>
				</div>
				<div class="carousel-inner">
					<?php foreach($articleImages as $key => $value){?>
					<div class="carousel-item <?php echo ($key==0)?'active':'';?>"  data-bs-interval="10000">
						<img   class="img d-block w-100" 	onerror="if (this.src != 'error.jpg') this.src = '<?php echo Url::to('@web/images/no-image745x510.png', true)?>';" src="<?php echo Url::to('@web/channels/article/745x510/' . $value->image, true);?>">
						<div class="carousel-caption d-none d-md-block">
							<h5>Hình <?php echo $key +1;?></h5>
							<p>Hình ảnh chính sản phẩm</p>
						</div>
					</div>
					<?php }?>
				</div>
				<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="visually-hidden">Trở lại</span>
				</button>
				<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="visually-hidden">Tiếp theo</span>
				</button>
			</div>
		</div>
		<?php }?>
	</div>
	<div id="tab-map" class="tabcontent ratio ratio-16x9">
		<iframe  src="https://e-land.vn/article/map?lat=10.714645&lng=106.639070&category=article&id=<?php echo $model->id;?>"></iframe>
	</div>
	<div class="dl-group-button mb-3">
		
		<?php
		$user = \Yii::$app->user->identity;
		if(!$user){ ?>
		<button type="button" class="btn  btn-md btn-chat" data-url="<?php echo Url::to(['home/modal-article-login'], true);?>"   data-bs-toggle="modal"   data-bs-target="#modalLogin">
		<i class="fas fa-comments fa-lg" aria-hidden="true"></i> <small>Nhắn tin</small>
		</button>
		<?php }else {?>
		<button class="btn btn-md  btn-chat" onclick="register_popup(<?php echo ((isset($user)?$user->id:0) + $model->user->id);?>,<?php echo isset($user)?$user->id:0;?>,'<?php echo preg_replace( "/\r|\n/", "", isset($user)?$user->name:'');?>',<?php echo $model->user->id; ?>,'<?php echo preg_replace( "/\r|\n/", "", $model->user->name);?>')">
		<i class="fas fa-comments fa-lg" aria-hidden="true"></i> <small>Nhắn tin</small>
		</button>
		<?php }?>
		<button class="btn btn-md" id="register-view-house"><i class="far fa-lg fa-eye"></i> Đăng ký xem nhà</button>
	</div>
	<div class="ladding-content mb-3">
		
		
		
	<?php echo  implode('</p><p>',explode('<br /><br />', nl2br($model->content)))?>
	
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
	<div class="product-contact mb-3" id="form-register-view-house">
		
		<div class="widget widget-register">
			<h3 class="widget-title widget-title">Đăng ký xem nhà</h3>
			<div class="widget-content">
				
				<form
					action = '<?php echo Url::to(['article/article-booking','id' => $model->id], true);?>'
					method = 'post'
					id = 'register-view-form'
					enctype = 'multipart/form-data'
					class="row g-3 needs-validation" novalidate>
					<div style="display:none">
						<input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>">
					</div>
					<div class="col-12 col-xs-12 col-sm-12 col-md-4  col-lg-4  col-xl-4 col-xxl-4">
						<label for="validationName" class="form-label">Nhập họ và tên</label>
						<div class="input-group has-validation">
							<span class="input-group-text" id="inputGroupPrepend"><i class="far fa-user"></i> </span>
							<input type="text" class="form-control"  autocomplete="off" name="ArticleBooking[name]" placeholder="Nhập họ tên" id="validationName" aria-describedby="inputGroupPrepend" required>
							<div class="invalid-feedback">
								Nhập họ và tên
							</div>
						</div>
					</div>
					<div class="col-12 col-xs-12 col-sm-12 col-md-4  col-lg-4  col-xl-4 col-xxl-4">
						<label for="validationPhone" class="form-label">Số điện thoại</label>
						<div class="input-group has-validation">
							<span class="input-group-text" id="inputGroupPrepend"><i class="fas fa-phone"></i> </span>
							<input type="text" class="form-control" autocomplete="off"  name="ArticleBooking[phone]" placeHolder="Số điện thoại" id="validationPhone" aria-describedby="inputGroupPrepend" required>
							<div class="invalid-feedback">
								Nhập số điện thoại
							</div>
						</div>
					</div>
					<div class="col-12 col-xs-12 col-sm-12 col-md-4  col-lg-4  col-xl-4 col-xxl-4">
						<label for="validationEmail" class="form-label">Email</label>
						<div class="input-group has-validation">
							<span class="input-group-text" id="inputGroupPrepend"> <i class="far fa-envelope"></i></span>
							<input  type="email" class="form-control" autocomplete="off" name="ArticleBooking[email]" placeHolder="Nhập email" id="validationEmail" aria-describedby="inputGroupPrepend" required>
							<div class="invalid-feedback">
								Nhập email
							</div>
						</div>
					</div>
					<div class="col-12">
						<label for="validationDate" class="form-label">Ngày xem</label>
						<div class="input-group has-validation">
							<span class="input-group-text" id="inputGroupPrepend"> <i class="far fa-calendar"></i></span>
							<input type="text" class="datetimepicker form-control" autocomplete="off" name="ArticleBooking[date]" placeHolder="Nhập ngày giờ muốn xem" id="validationDate" aria-describedby="inputGroupPrepend" required>
							<div class="invalid-feedback">
								Chọn ngày xem
							</div>
						</div>
					</div>
					<div class="col-12">
						<label for="validationRequest" class="form-label">Yêu cầu </label>
						<div class="input-group has-validation">
							
							<textarea type="text" class="form-control" autocomplete="off" name="ArticleBooking[content]" placeHolder="Nhập thông tin cần hỗ trợ tư vấn đi xem sản phẩm" id="validationRequest" aria-describedby="inputGroupPrepend" required></textarea>
							<div class="invalid-feedback">
								Xin nhập yêu cầu
							</div>
						</div>
					</div>
					<div class="col-12">
						<button class="btn btn-success mb-3" type="submit"><i class="fas fa-lg fa-house-user"></i> Đăng ký</button>
					</div>
				</form>
				
			</div>
		</div>
		
		
	</div>
	
</div>
<div class="modal-footer">
	<button type="button"  data-bs-dismiss="modal" aria-label="close" class="btn btn btn-light">Đóng</button>
</div>

<?php $this->registerJsFile(Yii::$app->request->baseUrl.'/plugins/datetimepicker-master/jquery.datetimepicker.full.js',['depends' => [yii\bootstrap\BootstrapAsset::className()]]); ?>
<?php $this->registerJsFile(Yii::$app->request->baseUrl.'/plugins/datetimepicker-master/script.datetimepicker.js',['depends' => [yii\bootstrap\BootstrapAsset::className()]]); ?>

<?php $this->registerJsFile('https://sp.zalo.me/plugins/sdk.js',['depends' => [yii\bootstrap\BootstrapAsset::className()]]); ?>
<?php $this->registerJsFile(Yii::$app->request->baseUrl.'/e-land/js/modal_login.js',['depends' => [yii\bootstrap\BootstrapAsset::className()]]); ?>
<?php $this->registerJsFile(Yii::$app->request->baseUrl.'/e-land/js/modal_register.js',['depends' => [yii\bootstrap\BootstrapAsset::className()]]); ?>
<?php $this->registerJsFile(Yii::$app->request->baseUrl.'/e-land/js/register_view_house.js',['depends' => [yii\bootstrap\BootstrapAsset::className()]]); ?>

<?php $user = \Yii::$app->user->identity;
if($user){
$this->registerJsFile(Yii::$app->params['url-page-chat'] . 'socket.io/socket.io.js', ['depends' => [yii\bootstrap\BootstrapAsset::className()]]);
$this->registerJsFile(Yii::$app->params['url-page-chat'] . 'user.js', ['depends' => [yii\bootstrap\BootstrapAsset::className()]]);
}
?>