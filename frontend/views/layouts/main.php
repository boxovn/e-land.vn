<?php
use yii\helpers\Html;
use frontend\assets\HomeAppAsset;
use frontend\widgets\Alert;
use frontend\widgets\HomeHeader;
use frontend\widgets\HomeFooter;
use frontend\widgets\HomeSidebar;
use  yii\helpers\Url;
HomeAppAsset::register($this);


?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html  lang="<?php echo Yii::$app->language;?>" class="h-100">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?php    echo $this->title; ?></title>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" ></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" ></script>
    
    <!-- Bootstrap core CSS -->
    <?php $this->head() ?>
    <script type="text/javascript">
    // Common params using for JS
    var _jsBaseUrl = '<?php echo yii::$app->urlManager->baseUrl?>';
    //  console.log(_jsBaseUrl);
    </script>
  </head>
  <body class="d-flex h-100 text-black bg-white">
  <?php $this->beginBody() ?>
        <div class="d-flex w-100 h-100 mx-auto flex-column">
                                <?php echo HomeHeader::widget()?>
                                <?php echo HomeSidebar::widget()?>
                                <main id="main" class="body">
                                    <?php echo $content ?>
                                </main>
                                     <?php echo HomeFooter::widget();?>
    </div>
    
<?php $this->registerCSSFile(Yii::$app->request->baseUrl . '/css/modal-landing.css'); ?>
<div class="modal face" id="modalLanding"  data-bs-backdrop="static" data-bs-keyboard="false"  aria-hidden="true" aria-labelledby="myModalLabelLanding">
          <div class="modal-dialog  modal-dialog-centered  modal-xl">
                  <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="myModalLabelRegisterError">Chi tiết</h5>
                                <button type="button" class="btn-close"  data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                                <div style="text-align:center">
                                                    <img src=" https://icon-library.com/images/ajax-loading-icon/ajax-loading-icon-16.jpg">
                                                </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="modal-footer justify-content-end">
                                <button type="button" id="#modal-btn-close"  data-bs-dismiss="modal" data-backdrop="false" class="btn btn-light"
                                    data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Đóng</button>
                            </div>
                  </div>
          </div>
</div>
<?php $this->registerCSSFile(Yii::$app->request->baseUrl . '/css/modal-login.css'); ?>
<div class="modal face" id="modalLogin"   aria-hidden="true" aria-labelledby="myModalLabelLogin">
            <div class="modal-dialog  modal-login modal-lg modal-dialog-centered">
                  <div class="modal-content">
                  <div class="modal-header">
                                <h5 class="modal-title" id="myModalLabelRegisterError">Chi tiết</h5>
                                <button type="button" class="btn-close"  data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                                <div style="text-align:center">
                                                    <img src=" https://icon-library.com/images/ajax-loading-icon/ajax-loading-icon-16.jpg">
                                                </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="modal-footer justify-content-end">
                                <button type="button" id="#modal-btn-close"  data-bs-dismiss="modal" data-backdrop="false" class="btn btn-light"
                                    data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Đóng</button>
                            </div>
                  </div>
            </div>
</div>
<?php $this->registerCSSFile(Yii::$app->request->baseUrl . '/css/modal-register.css'); ?>
<div class="modal" id="modalRegister"  aria-hidden="true" aria-labelledby="myModalLabelRegister">
            <div class="modal-dialog   modal-dialog-centered modal-register modal-lg">
                    <div class="modal-content">
                    <div class="modal-header">
                                <h5 class="modal-title" id="myModalLabelRegisterError">Chi tiết</h5>
                                <button type="button" class="btn-close"  data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                                <div style="text-align:center">
                                                    <img src=" https://icon-library.com/images/ajax-loading-icon/ajax-loading-icon-16.jpg">
                                                </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="modal-footer justify-content-end">
                                <button type="button" id="#modal-btn-close"  data-bs-dismiss="modal" data-backdrop="false" class="btn btn-light"
                                    data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Đóng</button>
                            </div>
                    </div>
            </div>
</div>
<?php $this->registerCSSFile(Yii::$app->request->baseUrl . '/css/modal-login-confirm.css'); ?>
<div  class="modal" id="modalLoginSuccess"  aria-hidden="true" aria-labelledby="myModalLabelLoginSucess" >
            <div class="modal-dialog  modal-dialog-centered modal-confirm modal-success">
              <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabelLoginSucess">Đăng nhập thành công!</h5>	
                </div>
                <div class="modal-body">
                                Bây giờ anh/chị có thể đăng tin, bình luận và trao đổi với người đăng tin rao bán bất động sản.
                </div>
                <div class="modal-footer justify-content-end">
                  <button class="btn btn-success btn-block" data-bs-target="#modalLogin" data-bs-toggle="modal" data-bs-dismiss="modal">OK</button>
                </div>
              </div>
            </div>
</div>  
<?php $this->registerCSSFile(Yii::$app->request->baseUrl . '/css/modal-register-error.css'); ?>
<div class="modal" id="modalRegisterError"  aria-hidden="true" aria-labelledby="myModalLabelRegisterError">
            <div class="modal-dialog  modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabelRegisterError">Thông báo</h5>
                        <button type="button" class="btn-close"  data-bs-dismiss="modal" aria-label="Close">
                            </button>
                    </div>
                    <div class="modal-body">
                          Lưu ý*: Quý khách cần cung cấp đầy đủ thông tin để E-land.VN có thể tư vấn tốt nhất cho Quý khách.
                     </div>
                    <div class="modal-footer justify-content-end">
                        <button type="button" id="#modal-btn-close"  data-bs-dismiss="modal" data-backdrop="false" class="btn btn-light"
                             data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Đóng</button>
                    </div>
                </div>
            </div>
</div>
<div class="modal" id="modalRegisterSuccess"  aria-hidden="true" aria-labelledby="myModalLabelRegisterSuccess">
            <div class="modal-dialog  modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabelRegisterSuccess">Thông báo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                            Quý khách đăng ký xem nhà thành công! Bộ phân tư vấn E-land.VN sẽ liên hệ xác nhận và dẫn quý khách đi xem nhà.
                           
                    </div>
                    <div class="modal-footer justify-content-end">
                        <button type="button" id="#modal-btn-close"  data-bs-dismiss="modal" data-backdrop="false" class="btn btn-light close"
                             data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> Đóng</button>
                    </div>
                </div>
            </div>
</div>

<div class="modal" id="modalContact"  aria-hidden="true" aria-labelledby="myModalLabelContact">
            <div class="modal-dialog  modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <div class="block-logo">
						  <img class="img-logo" src="https://e-land.vn/e-land/img/logo.png">
						 </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                                    <div class="row">
                                                    <div class="col-4">
                                                                <img class="img" src="/e-land/img/service (8).png"/> 
                                                    </div>
                                                    <div class="col-8">
                                                        <p>Tổng đài CSKH:</p>
                                                        <h1 style="color: #009245"> 035-9696-234</h1>
                                                        <div> Email: <a href="mailto:hotro@e-land.vn">hotro@e-land.vn</a></div>
                                                                <div >
                                                                               Mạng xã hội:
                                                                                            <a class="link-light" target="_blank" href="https://www.facebook.com/groups/290731795304714/chats/4087612011366007">
                                                                                                <img src="/e-land/img/social (1).png"/>
                                                                                            </a>
                                                                                            <a class="link-light" title="Nhóm: E-land.VN" target="_blank" href="https://zalo.me/g/retrxr426">
                                                                                                 <img src="/e-land/img/social (2).png"/>
                                                                                            </a>
                                                                                            <a class="link-light" title="Nhóm: E-land.VN" target="_blank" href="https://www.youtube.com/channel/UC2XqWdi0LxXmJyyQJ5cAO9g">
                                                                                                 <img src="/e-land/img/social (4).png"/>
                                                                                            </a>
                                                                                 </div>
                                                                </div>
                                                        </div>
                                   <div class="row">
                                            
                                        <div class="col-12">
                                        <p class="text-center">Phòng 4.01, Tòa nhà The Prince Residence, 17-19 Nguyễn Văn Trỗi, Phường 11, Quận Phú Nhuận<br>
                                            </p>
                                        </div>
                                   </div>
                    </div>
                    
                </div>
            </div>
</div>

<div class="modal" id="modalRegisterEmail"   data-bs-backdrop="static" data-bs-keyboard="false"  aria-hidden="true"  aria-labelledby="myModalLabelRegisterEmail">
            <div class="modal-dialog  modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <div class="block-logo">
						  <img class="img-logo" src="https://e-land.vn/e-land/img/logo.png">
						 </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <div class="row">
                                    <div class="col-md-12">
                                                <div style="text-align:center">
                                                    <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
																		  <span class="visually-hidden">Loading...</span>
																		</div>
                                                </div>
                                    </div>
                                    
                                </div>
                    </div>
                    
                </div>
            </div>
</div>
<?php //echo frontend\widgets\LoginDialog::widget(); ?>
    <?php $this->endBody() ?>
    
    <?php
    $user = \Yii::$app->user->identity;
    if($user){
    $this->registerJsFile(Yii::$app->params['url-page-chat'] . 'socket.io/socket.io.js', ['position' => \yii\web\View::POS_END]);
    $this->registerJsFile(Yii::$app->params['url-page-chat'] . 'user.js', ['position' => \yii\web\View::POS_END]);
    }
    ?>
<script type="text/javascript">
var modalLogin = new bootstrap.Modal(document.getElementById('modalLogin'), {
         keyboard: false
      })
	  var modalRegisterEmail = new bootstrap.Modal(document.getElementById('modalRegisterEmail'), {
         keyboard: false
      })
        var modalRegisterSuccess = new bootstrap.Modal(document.getElementById('modalRegisterSuccess'), {
         keyboard: false
      })
      var modalRegisterError = new bootstrap.Modal(document.getElementById('modalRegisterError'), {
         keyboard: false
      })
      
       
      $(".center").slick({
				variableWidth: true,
                 dots: false,
                 touchMove: false,
                  slidesToShow: 15,
                  slidesToScroll: 1
                });
               
</script>
 <script type="text/javascript">
        $('#dismiss, .overlay').on('click', function () {
                $('#sidebar').removeClass('active');
                $('.overlay').removeClass('active');
            });

        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
               //  $('.overlay').addClass('active');
              //  $('.collapse.in').toggleClass('in');
              //  $('a[aria-expanded=true]').attr('aria-expanded', 'false');
            });
             $('#sidebarMapCollapse').on('click', function () {
                $('#search').toggleClass('active');
                console.log(1212);
              //   $('.overlayMap').addClass('active');
               // $('.collapse.in').toggleClass('in');
                //$('a[aria-expanded=true]').attr('aria-expanded', 'false');
            });
        });
        
    </script>
    
    
  </body>
</html>
<?php $this->endPage(); ?>
