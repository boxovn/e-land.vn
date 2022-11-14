 <?php
use yii\widgets\ActiveForm;
use common\models\District;
use common\models\Province;
use yii\helpers\ArrayHelper;
use common\models\ApartmentCategory;
use common\models\Ward;
use backend\widgets\Alert;
use common\models\Street;
use  yii\helpers\Url;
$this->title = 'Cập nhật thông tin dự án';
?>
 <script type="text/javascript">
function currencyFormat(number, moneyCode) {
    var decimalplaces = 0; //2
    var decimalcharacter = ""; //"."
    var thousandseparater = ",";

    number = parseFloat(number);

    var sign = number < 0 ? "-" : "";
    var formatted = new String(number.toFixed(decimalplaces));
    if (decimalcharacter.length && decimalcharacter != ".") {
        formatted = formatted.replace(/\./, decimalcharacter);
    }
    var integer = "";
    var fraction = "";
    var strnumber = new String(formatted);
    var dotpos = decimalcharacter.length ? strnumber.indexOf(decimalcharacter) : -1;
    if (dotpos > -1) {
        if (dotpos) {
            integer = strnumber.substr(0, dotpos);
        }
        fraction = strnumber.substr(dotpos + 1);
    } else {
        integer = strnumber;
    }
    if (integer) {
        integer = String(Math.abs(integer));
    }
    while (fraction.length < decimalplaces) {
        fraction += "0";
    }
    temparray = new Array();
    while (integer.length > 3) {
        temparray.unshift(integer.substr(-3));
        integer = integer.substr(0, integer.length - 3);
    }
    temparray.unshift(integer);
    integer = temparray.join(thousandseparater);

    var code = 'VNĐ';
    if (moneyCode == false) code = "";

    return sign + integer + decimalcharacter + fraction + code;
}
 </script>
 <style>
/* Hide the file input using
opacity */
.box-body .box-profile [type=file] {

    filter: alpha(opacity=0);
    opacity: 0;
}

.box-body .box-profile [type=file] {
    display: none;
}

.box-body .box-profile input,
.box-body .box-profile label {
    border-radius: 100px;
    text-align: left;
    margin: 0;

    width: 100px;
    height: 100px;
    cursor: pointer;
}

.up {
    display: none;
    background-color: rgba(32, 33, 36, 0.6);
    bottom: 0;
    height: 50px;
    width: 200px;
    left: 0;
    position: absolute;
    right: 0;

}

.box-body.box-profile label:hover~.up {


    display: block;
}
 </style>
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <section class="content-header">
         <h1>
             Cập nhật thông tin dự án
             <small></small>
         </h1>
         <ol class="breadcrumb">
             <li><a href="#"><i class="fa fa-home"></i> Trang chủ</a></li>
             <li class="active">Cập nhật thông tin dự án</li>
         </ol>
     </section>


     <!-- Main content -->
     <section class="content">
         <div class="nav-tabs-custom">
             <ul class="nav nav-tabs">
                 <li class="active"><a
                         href="<?php echo  yii::$app->urlManager->createUrl(['project/index', 'id' => $model->id, 'menu' => 'project']);?>"
                         data-toggle="tab" aria-expanded="true">Thông tin dự án <i class="fa fa-arrow-circle-right"
                             aria-hidden="true"></i> </a>
                 </li>
                 <li class=""><a
                         href="<?php echo  yii::$app->urlManager->createUrl(['project/project-section', 'id' => $model->id, 'menu' => $menu]);?>">Phần
                         của trang <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                 </li>
                 <li class=""><a
                         href="<?php echo  yii::$app->urlManager->createUrl(['project/investor', 'id' => $model->id, 'menu' => 'project']);?>">Chủ
                         đầu tư <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                 </li>

                 <li><a
                         href="<?php echo  yii::$app->urlManager->createUrl(['project/contact', 'id' => $model->id, 'menu' => 'project']);?>">Thông
                         tin liên hệ <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                 </li>

             </ul>
             <div class="tab-content">
                 <!-- /.tab-pane -->
                 <div class="tab-pane active" id="project">
                     <!-- The timeline -->
                     <div class="row">
                         <div class="col-md-12">
                             <div class="box box-primary">
                                 <div class="box-header with-border">
                                     <h3 class="box-title">Banner Slider (Hình đại diện)</h3>
                                 </div>
                                 <div class="box-body">
                                     <div class="row">
                                         <div class="col-md-12">
                                             <div class=""><label class="control-label">Hình ảnh</label> (Mỗi lần
                                                 upload
                                                 tối đa 5 hình [.jpg, .jpeg, .png])</div>
                                             <div action="<?php echo Url::to(["project/multiple-upload-banner",'id' => $model->id],true);?>"
                                                 class="dropzone" id="dropzone-banner-upload" multiple>
                                                 <input type="hidden" id="upload_banner_id" name="upload_banner_id"
                                                     value="" />
                                             </div>
                                             <!-- /<div id="preview-template">
                                                <div class="dz-preview dz-file-preview well" id="dz-preview-template">
                                                </div>
                                            </div> -->


                                         </div>
                                     </div>
                                 </div>
                                 <!-- /.box-body -->
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </section>
 </div>
 <?php echo $this->registerJsFile('@web/plugins/dropzone/dropzone.js');?>
 <script type="text/javascript">
window.dropzoneBanners = JSON.parse('<?php echo json_encode($dropzoneBanners);?>');
 </script>
 <?php //echo $this->registerJsFile('@web/plugins/dropzone/dropzone.js');?>
 <?php echo $this->registerJsFile('@web/plugins/dropzone/script_banner.js');?>