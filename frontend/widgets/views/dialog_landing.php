<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use common\libraries\PseudoCrypt;
use frontend\widgets\RegisterViewHouse;
use frontend\widgets\LoginDialog;
?>
<style>
	#landdingPage .modal-header {
    padding: 10px 15px;
    border-bottom: 1px solid #eee;
    margin-bottom: 0px;
}
#landdingPage .modal-header	.modal-title {font-size: 14px;font-weight: 600;}
#landdingPage .article-slider #carousel{background-color: #F6f6f6;}
#landdingPage	.article-slider #carousel {  margin: 0; }
#landdingPage .article-slider #carousel .carousel-inner .item{ justify-content: center;}
#landdingPage .article-slider #thumbcarousel { margin: 5px 0 0; padding: 0 25px; }
#landdingPage .article-slider #thumbcarousel .item { text-align: center; }
#landdingPage .article-slider #thumbcarousel .item .thumb {margin: 0; display: inline-block; vertical-align: middle; cursor: pointer; }
#landdingPage .article-slider #thumbcarousel .item .thumb:hover { border-color: #ddd; }
#landdingPage .form-group {
    margin-right: 0 !important;
    margin-left: 0 !important;
    padding: 0px;
}
#landdingPage .md-nav{
	
	float: left;
    width: calc(100% - 90px);
	}
	
	#landdingPage .md-nav ul {
    padding: 0;
    margin: 0;
}	
#landdingPage .md-nav li {
    list-style: none;
   
    display: inline-block;
    padding: 15px 10px;
}
#landdingPage .md-nav li.active a {
    color: #155aa9;
    border-radius: 4px;
    border: 1px solid #155aa9;
}
#landdingPage .md-nav li a {
    color: #4a4a4a;
    cursor: pointer;
    font-size: 16px;
    font-weight: 400;
    padding: 7px 16px;
    letter-spacing: .1344px;
    text-transform: none;
}
#landdingPage .md-btn {
	float:right;
	padding: 0px;
	width:90px
}
#landdingPage  .md-btn .dropdown{
	float:left;
}
#landdingPage  .md-btn .btn {
	border: 0;
    background-color: transparent;
	
}

#landdingPage  .dropdown-menu ul {
  display: block;
  position: relative;
  list-style-type: none;
}
#landdingPage  .dropdown-menu .title1 {
  margin-bottom: 10px;
  font-size: 16px;
  font-weight: 600;
  text-align: center;
}
#landdingPage  .dropdown-menu li:not([class=title1]):not(:last-child) {
  margin-bottom: 7px;
}
#landdingPage  .dropdown-menu li:not([class=title1]) {
  width: 36px;
  height: 36px;
  margin-left: auto;
  margin-right: auto;
  line-height: 36px;
  border-radius: 100%;
  text-align: center;
  border: 1px solid #ef7733;
  background: #fff;
  -webkit-transition: all ease .4s;
  -o-transition: all ease .4s;
  transition: all ease .4s;
}
#landdingPage .dropdown-menu li:not([class=title1]) .icon {
  font-size: 18px;
}
#landdingPage  .dropdown-menu li:not([class=title1]) .icon:before {
  color: #ef7733;
}
#landdingPage .dropdown-menu li:not([class=title1]) .icon:before {
  color: #ef7733;
}
#landdingPage .dropdown-menu li:not([class=title1]) .svg-inline--fa{
  color: #ef7733;
}
#landdingPage .dropdown-menu li:not([class=title1]) .iconmoon-skype2 {
  position: relative;
  top: 2px;
}
#landdingPage  .dropdown-menu li:not([class=title1]) .iconmoon-mail4 {
  font-size: 15px;
}
#landdingPage .dropdown-menu li:not([class=title1]) .icon-linkedin {
  position: relative;
  top: -2px;
  font-size: 16px;
}
#landdingPage .dropdown-menu li:not([class=title1]) .icon-zalo {
  font-size: 24px;
}
[class*=" icon-"], [class^=icon-] {
  font-family: 'icomoon'!important;
  speak: none;
  font-style: normal;
  font-weight: 400;
  font-variant: normal;
  text-transform: none;
  line-height: inherit;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}
#landdingPage  .dropdown-menu{
	right: -120%;
}
#landdingPage  .dropdown-menu > li > a{
	display: unset; 
     padding:0;
}
.icon-facebook:before {
  content: "\e918";
}
.iconmoon-mail4:before {
  content: "\e977";
  color: #fff;
}
.iconmoon-skype2:before {
  content: "\e97d";
  color: #fff;
}
.icon-linkedin:before {
  content: "\e924";
}
.icon-zalo:before {
  content: "\e966";
}
.dl-group-button {
	text-align: center;
    margin: 20px 0px;
    float:left;
    width:100%;
}
.dl-group-button .btn{
	color: #cc0000;
    border: 1px solid #cc0000;
    background: #ffff;
	
}
#landdingPage .md-nav-tab{
	padding: 10px;

    z-index: 1000;
    position: relative;
	}
	#landdingPage .md-nav-tab ul {
    padding: 0;
    margin: 0;
}
.landdingPage .md-nav-tab li {
    list-style: none;
    float: left;
    display: inline-block;
    padding: 15px 10px;
}
#landdingPage .md-nav-tab li.active a {
    color: #155aa9;
    border-radius: 4px;
    border: 1px solid #155aa9;
}
#landdingPage .md-nav-tab li {
    list-style: none;
   
    display: inline-block;
    padding: 0px 5px;
}
#landdingPage .md-nav-tab li a {
    
    cursor: pointer;
    font-size: 16px;
    font-weight: 400;
    padding: 7px 16px;
    letter-spacing: .1344px;
    text-transform: none;
    color: #c00;
    border-radius: 4px;
    border: 1px solid #c00;
    width: 120px;
    float: left;
    background-color: #fff;
}
#landdingPage .box-title{
	max-height: 40px;
    overflow: hidden;
    line-height: 40px;
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
    font-weight: 500;
    width: calc(100% - 50px);
    float: left;
}
.user-avatar{
	width: 40px;
    height: 40px;
    border-radius: 100%;
    float: left;
    margin-right: 10px;
}
#landdingPage iframe{
  border: 0px;
  width:100%;
  height: 535px;
  float:left;
}
#landdingPage #tab-images{
  display:block;
}
#landdingPage #tab-map{
  display:none;
}
</style>	
<?php //$this->registerCSSFile('@web/css/article-dialog-landing.css');?>
<div class="modal" id="landdingPage"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
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
															
																<?php  $user = \Yii::$app->user->identity;
																																if(!$user){ ?>
																																	<button type="button" class="btn  btn-md btn-chat btn-chat-login" data-toggle="modal" data-target="#exampleModalLong">
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
												</tbody>
												</table>
									</div>
									<?php }?>
									<div class="product-contact" id="form-register-view-house">
										<?php echo RegisterViewHouse::widget(['article_id' => isset($model->article)?$model->article->id:'']); ?>
										
									</div>
								</div>
							<div class="modal-footer">
					<button type="button"  data-dismiss="modal" aria-label="close" class="btn btn-default">Đóng</button>
				</div>
	 
    		</div>
		</div>
</div>

<script>
       
        function changeModalContent(evt, cityName) {
          var i, tabcontent, tablinks;
          tabcontent = document.getElementsByClassName("tabcontent");
          for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
          }
          tablinks = document.getElementsByClassName("tablinks");
          for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
          }
          document.getElementById(cityName).style.display = "block";
          evt.currentTarget.className += " active";
        }
       
</script>
<script>
    // Show the first tab and hide the rest
        $(document).ready(function (){
            $("#register-view-house").click(function (){
                $('#landdingPage').animate({
                    scrollTop: $("#form-register-view-house").offset().top
                }, 2000);
            });
        });
</script>
<script>
 $(document).ready(function(){
var $form = $('#active-form');
$form.on('beforeValidate', function (e) {
    var name =$('#active-form').find('input[name="ArticleBooking[name]"]').val();
    var email =$('#active-form').find('input[name="ArticleBooking[email]"]').val();
    var phone =$('#active-form').find('input[name="ArticleBooking[phone]"]').val();
    var date =$('#active-form').find('input[name="ArticleBooking[date]"]').val();
    var content =$('#active-form').find('textarea[name="ArticleBooking[content]"]').val();
   
    if(name.length > 0 && email.length > 0 && phone.length > 0 && date.length > 0 && content.length > 0){
          //  console.log('hide');
    }else{
      //  console.log('show');
        $("#modal-register-error").modal('show');//you've got empty values
    }
});
$form.on('beforeSubmit', function(e) {
    e.preventDefault();
    var data = $form.serialize();
  //  console.log(data);
    $.ajax({
        url:  '<?php echo Url::to(['article/article-booking', true]);?>',
        type: 'POST',
        data: data,
        success: function (data) {
            console.log(data);
            //$form.yiiActiveForm('resetForm');
            $form[0].reset();
            $("#modal-register-success").modal('show');//you've got empty values
            // Implement successful
        },
        error: function(jqXHR, errMsg) {
            alert(jqXHR);
            alert(errMsg);
        }
     });
     return false; // prevent default submit
});
});
</script>