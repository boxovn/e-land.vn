 <?php
use yii\widgets\ActiveForm;
use common\models\District;
use common\models\Province;
use yii\helpers\ArrayHelper;
use common\models\ApartmentCategory;
use common\models\Ward;
use backend\widgets\Alert;
use common\models\Street;
use yii\helpers\Html;
$this->title = 'Thêm dự án';
?>
 <style>
.dropzone .logo-preview .logo-remove {
    position: absolute;
    top: 5px;
    right: 7px;
    width: 15px;
    height: 15px;
    padding: 0;
    background: url('https://www.e-land.vn/file_icons/remove.png') no-repeat center;
    background-size: 18px;
    border: 0;
    border-radius: 0;
    opacity: 0.8;
    z-index: 100000;
    -webkit-transition: opacity 150ms ease-out 0s;
    -moz-transition: opacity 150ms ease-out 0s;
    -ms-transition: opacity 150ms ease-out 0s;
    transition: opacity 150ms ease-out 0s;
    padding: 10px;
}

.dropzone .logo-preview .logo-image {
    border-radius: 20px;
    overflow: hidden;
    width: 120px;
    height: 120px;
    position: relative;
    display: block;
    z-index: 10;
    border: 1px solid #ddd;
}
 </style>
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <section class="content-header">
         <h1>
             Trang
             <small></small>
         </h1>
         <ol class="breadcrumb">
             <li><a href="#"><i class="fa fa-home"></i> Trang chủ</a></li>
             <li class="active">Tạo trang</li>
         </ol>
     </section>
     <!-- Main content -->
     <section class="content">
         <div class="nav-tabs-custom">
             <ul class="nav nav-tabs">
                 <li
                     <?php echo (Yii::$app->request->url==yii::$app->urlManager->createUrl(['project/index', 'id' => $model->id]))? 'class="active"':'';?>>
                     <a href="<?php echo  yii::$app->urlManager->createUrl(['project/index', 'id' => $model->id]);?>">Dự
                         án <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                 </li>
                 <li class=""><a
                         href="<?php echo  yii::$app->urlManager->createUrl(['project/project-section', 'id' => $model->id,'menu' => 'project']);?>">Chi
                         tiết <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                 </li>
                 <li class="active">
                     <a
                         href="<?php echo  yii::$app->urlManager->createUrl(['project/investor', 'id' => $model->id]);?>">Chủ
                         đầu tư <i class="fa fa-arrow-circle-right" aria-hidden="true"></i> </a>
                 </li>

                 <li
                     <?php echo (Yii::$app->request->url==yii::$app->urlManager->createUrl(['project/contact', 'id' => $model->id, 'menu' => 'project']))? 'class="active"':'';?>>
                     <a href="<?php echo  yii::$app->urlManager->createUrl(['project/contact', 'id' => $model->id]);?>">Thông
                         tin liên hệ <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                 </li>

             </ul>
             <div class="tab-content">

                 <!-- /.tab-pane -->

                 <div class="tab-pane active" id="owner_investment">
                     <?php echo Alert::widget() ?>
                     <?php $form = ActiveForm::begin(); ?>
                     <div class="box box-primary">
                         <div class="box-header with-border">
                             <h3 class="box-title">Thông tin liên hệ</h3>
                         </div>
                         <!-- /.box-header -->
                         <div class="box-body">
                             <div class="col-md-2">
                                 <label class="control-label" for="project-name">Logo chủ đầu tư</label>
                                 <label for="projectinvestor-logo" style="width:200px">
                                     <div class="dropzone" style="position: relative; cursor:pointer">
                                         <div class="logo-preview" id="<?php echo $projectInvestor->id;?>">
                                             <div class="logo-image">
                                                 <img style="
                                                        border-radius: 20px;
                                                        width: 120px;
                                                        height: 120px;
                                                        border: 1px solid #ddd;
                                                        position: absolute;
                                                        top: 50%;
                                                        left: 50%;
                                                        transform: translate(-50%,-50%);
                                                    " id="project-logo-img"
                                                     src="<?php echo $projectInvestor->logo? Yii::$app->params['url-channels']. 'projects/logo_investor/' . $projectInvestor->logo:Yii::$app->params['url-channels']. 'projects/no-image.png'?>"
                                                     alt="Your image" />
                                                 <a data-id="<?php echo $projectInvestor->id;?>"
                                                     id="<?php echo $projectInvestor->id;?>" class="logo-remove"
                                                     href="javascript:undefined;" data-dz-remove=""></a>
                                             </div>
                                         </div>
                                     </div>
                                 </label>
                                 <?php echo $form->field($projectInvestor, 'logo')->fileInput(['style' => 'display:none'])->label(false); ?>
                             </div>
                             <div class="col-md-10">
                                 <div class="row">
                                     <div class="col-md-12">
                                         <div class="form-group">
                                             <?php echo $form->field($projectInvestor, 'name')->textInput(['placeHolder' => 'Tên chủ đầu tư'])->label("Chủ đầu tư"); ?>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="row">
                                     <div class="col-md-6">
                                         <div class="form-group">
                                             <?php echo $form->field($projectInvestor, 'address')->textInput(['placeHolder' => 'Địa chỉ công ty'])->label("Địa chỉ"); ?>
                                         </div>
                                     </div>

                                     <div class="col-md-6">
                                         <div class="form-group">
                                             <?php echo $form->field($projectInvestor, 'email')->textInput(['placeHolder' => 'Email'])->label("Email"); ?>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="row">
                                     <div class="col-md-6">
                                         <div class="form-group">
                                             <?php echo $form->field($projectInvestor, 'phone')->textInput(['placeHolder' => 'Số điện thoại'])->label("Điện thoại"); ?>
                                         </div>
                                     </div>
                                     <div class="col-md-6">
                                         <div class="form-group">
                                             <?php echo $form->field($projectInvestor, 'website')->textInput(['placeHolder' => 'Địa chỉ web chủ đầu tư']); ?>
                                         </div>
                                     </div>
                                 </div>
                             </div>



                         </div>

                     </div>
                     <div class="box box-primary">
                         <div class="box-header with-border">
                             <h3 class="box-title">Chủ đầu tư</h3>
                         </div>
                         <!-- /.box-header -->
                         <div class="box-body">
                             <div class="row">
                                 <div class="form-group">
                                     <?php echo $form->field($projectInvestor, 'description')->widget(\yii\redactor\widgets\Redactor::className(),['clientOptions' => [
                                                       'plugins' => ['clips', 'fontcolor','imagemanager']
                                                    ]
                                                    ])?>
                                 </div>
                             </div>
                         </div>

                         <div style="text-align: right; margin-bottom:10px; padding:10px;">
                             <div class="row">
                                 <div class="col-md-12">
                                     <button type="submit" class="btn btn-danger">Lưu lại</button>
                                 </div>
                             </div>
                         </div>
                         <?php ActiveForm::end(); ?>
                     </div>

                     <!-- /.tab-pane -->
                 </div>
             </div>
     </section>
 </div>
 <script>
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#project-logo-img').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
}

$("#projectinvestor-logo").change(function() {
    readURL(this);
});
$('.logo-remove').click(function() {

    var r = confirm("Có chắc muốn xoá hình ảnh này");
    if (r == true) {
        if ($(this).attr('id')) {
            var id = $(this).attr('id');
            $.ajax({
                url: _jsBaseUrl + "/index.php?r=project/investor-logo-remove",
                type: "post",
                data: {
                    id: id,
                },
                dataType: "json",
                async: true,
                success: function(data) {
                    obj = JSON.parse(data);
                    $('#project-logo-img').attr('src', obj.url);
                    alert(obj.message);
                },
            });
        } else {
            console.log("File không tồn tại");
        }
    }
});
 </script>