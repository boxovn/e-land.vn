<?php
use yii\helpers\Html;
use frontend\assets\AppAssetProduct;
use frontend\widgets\Alert;
use frontend\widgets\Header;
use frontend\widgets\Footer;
use frontend\widgets\NavBar;
use frontend\widgets\SideBar;
use frontend\widgets\HeaderPage;
use frontend\widgets\HeaderIndex;
use frontend\widgets\HeaderCategory; 
use frontend\widgets\HeaderProvince;
use frontend\widgets\HeaderProvinceDistrict;  
use frontend\widgets\HeaderDetail;
use frontend\widgets\HeaderUser;
use frontend\widgets\HeaderProject;
use frontend\widgets\NavProduct;
use frontend\widgets\HeaderProduct;
use frontend\widgets\HeaderProductDetail;
use frontend\widgets\HomeFooterProduct;
//use \Yii;
AppAssetProduct::register($this);
//AppAssetEnd::register($this);
$user = \Yii::$app->user->identity;
use  yii\helpers\Url;
if($user){
  $this->registerJsFile('https://chat.batdongsaneland.com/socket.io/socket.io.js', ['position' => \yii\web\View::POS_END]);
  $this->registerJsFile('https://chat.batdongsaneland.com/user.js', ['position' => \yii\web\View::POS_END]);
 
}
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?php echo Yii::$app->language;?>">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?php    echo $this->title; ?> </title>
    <!--Font-->
    <?php $this->head() ?>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-87907412-1"></script>
    <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'UA-87907412-1');
    </script>

</head>

<body>
    <div id="progress" class="waiting">
        <dt></dt>
        <dd></dd>
    </div>
    <input type="hidden" id="id" value="<?php echo isset($user)?$user->id:0;?>" />
    <input type="hidden" id="name"
        value="<?php echo preg_replace( "/\r|\n/", "", isset($user)?$user->name:'guest');?>" />
    <?php $this->beginBody() ?>
   
    <div class="wrapper">
     
       <div class="detail">

<nav class="py-2 bg-light border-bottom">
    <div class="container d-flex flex-wrap">
      <ul class="nav me-auto">
        <li class="nav-item"><a href="#" class="nav-link link-dark px-2 active" aria-current="page">Trang ch???</a></li>
        <li class="nav-item"><a href="#" class="nav-link link-dark px-2">V??? ch??ng t??i</a></li>
        <li class="nav-item"><a href="#" class="nav-link link-dark px-2">Li??n h???</a></li>
        
      </ul>
      <ul class="nav">
        

        <li class="nav-item"><button type="button" class="btn btn-primary" data-url="https://e-land.vn/home/modal-article-login" data-bs-toggle="modal" data-bs-target="#modalLogin">????ng nh???p</button></li>
        <li class="nav-item"><a href="#" class="nav-link link-dark px-2">????ng k??</a></li>
           </ul>
    </div>
  </nav>
          <?php echo NavProduct::widget();?>
          
  
            <main class="body">

          
                <?php echo $content ?>

            </main>
            <?php echo HomeFooterProduct::widget();?>
        </div>
    </div>
    <?php $this->endBody() ?>
    <span id="top-link-block" class="hidden-xs">
        <a href="#top" onclick="$('html,body').animate({scrollTop:0},'slow');return false;">
            <img src="<?php echo Yii::$app->getUrlManager()->baseUrl; ?>/images/up.png" />
        </a>
    </span><!-- /top-link-block -->
<?php $this->registerCSSFile(Yii::$app->request->baseUrl . '/css/modal-login.css'); ?>
<div class="modal face" id="modalLogin"   aria-hidden="true" aria-labelledby="myModalLabelLogin">
            <div class="modal-dialog  modal-login modal-lg modal-dialog-centered">
                  <div class="modal-content">
                  <div class="modal-header">
                                <h5 class="modal-title" id="myModalLabelRegisterError">Chi ti???t</h5>
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
                                    data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> ????ng</button>
                            </div>
                  </div>
            </div>
</div>


<?php $this->registerCSSFile(Yii::$app->request->baseUrl . '/css/modal-register.css'); ?>
<div class="modal" id="modalRegister"  aria-hidden="true" aria-labelledby="myModalLabelRegister">
            <div class="modal-dialog   modal-dialog-centered modal-register modal-lg">
                    <div class="modal-content">
                    <div class="modal-header">
                                <h5 class="modal-title" id="myModalLabelRegisterError">Chi ti???t</h5>
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
                                    data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> ????ng</button>
                            </div>
                    </div>
            </div>
</div>
<?php $this->registerCSSFile(Yii::$app->request->baseUrl . '/css/modal-login-confirm.css'); ?>
<div  class="modal" id="modalLoginSuccess"  aria-hidden="true" aria-labelledby="myModalLabelLoginSucess" >
            <div class="modal-dialog  modal-dialog-centered modal-confirm modal-success">
              <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabelLoginSucess">????ng nh???p th??nh c??ng!</h5> 
                </div>
                <div class="modal-body">
                                B??y gi??? anh/ch??? c?? th??? ????ng tin, b??nh lu???n v?? trao ?????i v???i ng?????i ????ng tin rao b??n b???t ?????ng s???n.
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
                            <h5 class="modal-title" id="myModalLabelRegisterError">Th??ng b??o</h5>
                        <button type="button" class="btn-close"  data-bs-dismiss="modal" aria-label="Close">
                            </button>
                    </div>
                    <div class="modal-body">
                          L??u ??*: Qu?? kh??ch c???n cung c???p ?????y ????? th??ng tin ????? E-land.VN c?? th??? t?? v???n t???t nh???t cho Qu?? kh??ch.
                     </div>
                    <div class="modal-footer justify-content-end">
                        <button type="button" id="#modal-btn-close"  data-bs-dismiss="modal" data-backdrop="false" class="btn btn-light"
                             data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> ????ng</button>
                    </div>
                </div>
            </div>
</div>
<div class="modal" id="modalRegisterSuccess"  aria-hidden="true" aria-labelledby="myModalLabelRegisterSuccess">
            <div class="modal-dialog  modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabelRegisterSuccess">Th??ng b??o</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                            Qu?? kh??ch ????ng k?? xem nh?? th??nh c??ng! B??? ph??n t?? v???n E-land.VN s??? li??n h??? x??c nh???n v?? d???n qu?? kh??ch ??i xem nh??.
                           
                    </div>
                    <div class="modal-footer justify-content-end">
                        <button type="button" id="#modal-btn-close"  data-bs-dismiss="modal" data-backdrop="false" class="btn btn-light close"
                             data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> ????ng</button>
                    </div>
                </div>
            </div>
</div>

<?php $this->registerCSSFile(Yii::$app->request->baseUrl . '/css/modal-register-error.css'); ?>
<div class="modal" id="modalError"  aria-hidden="true" aria-labelledby="modalLabelError">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabelRegisterError">Th??ng b??o</h5>
                        <button type="button" class="btn-close"  data-bs-dismiss="modal" aria-label="Close">
                            </button>
                    </div>
                    <div class="modal-body">
                         <div id="modalContent"> 
                            <div style="text-align:center"> 
                                <img src=" https://icon-library.com/images/ajax-loading-icon/ajax-loading-icon-16.jpg">
                            </div>
                        </div>
                     </div>
                    <div class="modal-footer justify-content-end">
                        <button type="button" id="#modal-btn-close"  data-bs-dismiss="modal" data-backdrop="false" class="btn btn-light"
                             data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> ????ng</button>
                    </div>
                </div>
            </div>
</div>
<div class="modal" id="modalSuccess"  aria-hidden="true" aria-labelledby="modalLabelSuccess">
            <div class="modal-dialog  modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="modalLabelSuccess">Th??ng b??o</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                            <div id="modalContent"> <div style="text-align:center"> <img src=" https://icon-library.com/images/ajax-loading-icon/ajax-loading-icon-16.jpg"></div></div>
                           
                    </div>
                    <div class="modal-footer justify-content-end">
                        <button type="button" id="#modal-btn-close"  data-bs-dismiss="modal" data-backdrop="false" class="btn btn-light close"
                             data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> ????ng</button>
                    </div>
                </div>
            </div>
</div>

<div class="modal" id="modalReceiver" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-md" role="document">
        <div class="modal-content">
                    <div id="modalContent"> <div style="text-align:center"> <img src=" https://icon-library.com/images/ajax-loading-icon/ajax-loading-icon-16.jpg"></div></div>
        </div>
    </div>
</div>
    

<div class="modal fade" id="modalComfirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Mu???n xo?? s???n ph???m n??y kh???i gi??? h??ng?</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                   
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <img style="width:120px; height:120px" src="" id="imgPreview" alt="" />
                    </div>
                    <div class="col-md-8">
                        <div style="margin-bottom:10px"> T??n s???n ph???m: <span id='txtName'></span></div>
                        <div style="margin-bottom:10px"> S??? l????ng: <span id="txtNumber"></span></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                 <button type="button" id="#modal-btn-close"  data-bs-dismiss="modal" data-backdrop="false" class="btn btn-light close"
                             data-bs-dismiss="modal"><i class="fas fa-times-circle"></i> ????ng</button>

                <button type="button" id="#modal-btn-no" data-dismiss="modal" data-backdrop="false" class="btn btn-danger btn-delete">
                    <i class="fa fa-trash" aria-hidden="true"></i> Xo??</button>
            </div>
        </div>
    </div>
    <!-- End Modal -->


     <script type="text/javascript">

        var modalReceiver = new bootstrap.Modal(document.getElementById('modalReceiver'), {
          keyboard: false
        })
     var modalLogin = new bootstrap.Modal(document.getElementById('modalLogin'), {
         keyboard: false
      })
        var modalSuccess = new bootstrap.Modal(document.getElementById('modalSuccess'), {
         keyboard: false
      })
      var modalError = new bootstrap.Modal(document.getElementById('modalError'), {
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
      $(".slider-district").slick({
                  dots: false,
                 touchMove: false,
                  slidesToShow: 8,
                  slidesToScroll: 1
                });
               
</script>
<script>
 function addCart(id) {
        img = $('#' + id + ' img').attr('src');
        txtProduct = $('#' + id + ' .name').text();
        txtPrice = $('#' + id + ' .price').text();
        txtNumber = $('#number').val();
        if (typeof txtNumber == "undefined" || txtNumber <= 1) {
            txtNumber = 1;
        }
        $(".box-shopping-cart").hide( "fast");
        $.ajax({
            method: "GET",
            url: $(location).attr("origin") + '/shopping-cart/add-cart',
            data: {
                id: id,
                amount: txtNumber
            },
            success: function(result) {
                html ='';
                html+= '<li class="clearfix">';
                html+= 'Th??m  v??o gi??? h??ng th??nh c??ng!';
                html+= '</li>';
                $('.shopping-cart-items').html(html);
                $('.main-color-text').text(result.total_price);
                $('#cart .badge,.shopping-cart-header .badge').text(result.total_amount);
                $(".box-shopping-cart").show( "fast");
                //setTimeout(function(){ $(".box-shopping-cart").fadeToggle( "fast"); }, 1000);
             
            }
        });
    }


    
</script>
 
</body>

</html>
<?php $this->endPage(); ?>