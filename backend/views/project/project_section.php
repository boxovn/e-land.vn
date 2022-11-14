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
use yii\helpers\Html;
use mihaildev\ckeditor\CKEditor;
//use dosamigos\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
$this->title = 'Thêm dự án';
?>
<style>
.nav-tabs-custom>.tab-content {
    background: #ecf0f5;
    padding: 10px 0;
    border-bottom-right-radius: 3px;
    border-bottom-left-radius: 3px;
}
</style>
<style>
.dropzone .logo-preview .section-image-remove {
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
                <li> <a
                        href="<?php echo  yii::$app->urlManager->createUrl(['project/index', 'id' => $model->id,'menu' => 'project']);?>">
                        Dự án <i class="fa fa-arrow-circle-right" aria-hidden="true"></i> </a>
                </li>
                <li class="active"><a
                        href="<?php echo  yii::$app->urlManager->createUrl(['project/project-section', 'id' => $model->id, 'menu' => 'project']);?>">Chi
                        tiết <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                </li>
                <li>
                    <a
                        href="<?php echo  yii::$app->urlManager->createUrl(['project/investor', 'id' => $model->id, 'menu' => 'project']);?>">Chủ
                        đầu tư <i class="fa fa-arrow-circle-right" aria-hidden="true"></i> </a>
                </li>

                <li> <a
                        href="<?php echo  yii::$app->urlManager->createUrl(['project/contact', 'id' => $model->id, 'menu' => 'project']);?>">Thông
                        tin liên hệ <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                </li>

            </ul>
            <div class="tab-content">
                <div class="tab-pane active">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- general form elements -->
                            <!-- form start -->
                            <?php echo Alert::widget() ?>
                            <div class="box box-warning">
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

                            <div class="box box-danger">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Bảng báo giá</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div action="<?php echo Url::to(["project/multiple-upload-file",'id' => $model->id],true);?>"
                                        enctype="multipart/form-data" class="dropzone" id="dropzone-file-upload">
                                        <input type="hidden" id="UploadFileID" name="upload_file_id" value="" />
                                    </div>

                                </div>
                                <!-- /.box -->

                                <!--/form-->
                            </div>
                            <!--form role="form" action="<?php echo yii::$app->urlManager->baseUrl?>/index.php?r=building-project-info%2Fadd" method="POST"-->
                            <div class="wap-forrm">
                                <?php foreach ($models as $index => $value) { ?>
                                <?php $form = ActiveForm::begin(['options' => ['class' => 'form-section','enctype' => 'multipart/form-data']]) ?>

                                <div class="box box-success box-section">
                                    <div class="box-header with-border">

                                        <div class="row">
                                            <div class="col-md-2">
                                                <h3 class="box-title">Phần <?php echo ($index + 1);?>:
                                                    <?php echo $value->name;?>
                                                </h3>
                                            </div>
                                            <div class="col-md-10">
                                                <div style="text-align: right; margin-bottom:10px; padding:10px;">

                                                    <button type="submit"
                                                        name="ProjectSection[<?php echo $index;?>][save]" value="save"
                                                        class="btn btn-sm btn-primary">Lưu
                                                        lại</button>
                                                    <button <?php echo $value->id?'':'disabled';?> type="button"
                                                        id="button-section-remove"
                                                        onClick="buttonSectionRemove('<?php echo Url::to(['project/project-section-delete', 'id' => $value->id, 'project_id' => $model->id]);?>')"
                                                        class="btn btn-danger btn-sm">Xoá</button>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.box-header -->
                                    <div class=" box-body">
                                        <div class="row">
                                            <div class="col-md-2">


                                                <label for="projectsection-<?php echo $index;?>-imagefile"
                                                    style="width:200px">
                                                    <div class="dropzone" style="position: relative; cursor:pointer">
                                                        <div class="logo-preview" id="<?php echo $value->id;?>">
                                                            <div class="logo-image">
                                                                <img style="border-radius: 20px; width: 120px;height: 120px;border: 1px solid #ddd;position: absolute;top: 50%;left: 50%;transform: translate(-50%,-50%);"
                                                                    id="projectsection-<?php echo $value->id;?>-img"
                                                                    src="<?php echo $value->image? Yii::$app->params['url-channels']. 'projects/section/' . $value->image:Yii::$app->params['url-channels']. 'projects/no-image.png'?>"
                                                                    alt="Your image" />
                                                                <a data-id="<?php echo $value->id;?>"
                                                                    id="<?php echo $value->id;?>"
                                                                    class="section-image-remove"
                                                                    href="javascript:undefined;" data-dz-remove=""></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </label>

                                                <?= $form->field($value, "[$index]imageFile")->fileInput(['data-id' => $value->id,'style' => 'display:none'])->label(false); ?>
                                            </div>
                                            <div class="col-md-10">
                                                <?= $form->field($value, "[$index]name")->textInput()->label('Phần') ?>
                                                <?= $form->field($value, "[$index]title")->textInput()->label('Tiêu đề') ?>
                                                <?= $form->field($value, "[$index]sort")->textInput(['autocomplete' => 'off', 'placeholder'=> 'Sắp xếp','type' => 'number'])->label('Sắp xếp') ?>
                                                <?php echo $form->field($value, "[$index]description")->widget(
                                                            \yii\redactor\widgets\Redactor::class,['clientOptions' => [
                                                                   'plugins' => [
                                                                                'alignment',
                                                                                'video',
                                                                                'table',
                                                                                'fontfamily',
                                                                                'clips',
                                                                                'fontcolor',
                                                                                'filemanager',
                                                                                'imagemanager',
                                                                                'fontsize'
                                                                            ],

                                                                ]
                                                    ]);
                                                      /*
                                                     $form->field($value, "[$index]description")->widget(CKEditor::className(),
                                                        [
                                                            'editorOptions' => ElFinder::ckeditorOptions(['elfinder', 'path' => '@frontend/web/uploads'],
                                                            ),
                                                        ]  
                                                        /*[
                                                        'editorOptions' => [
                                                            'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                                                            'inline' => false, //по умолчанию false
                                                         
                                                        'filebrowserBrowseUrl' => yii::$app->urlManager->baseUrl .'/theme/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                                                        'filebrowserImageBrowseUrl' => yii::$app->urlManager->baseUrl .'/theme/plugins/ckfinder/ckfinder.html?type=Images',
                                                            
                                                        'filebrowserUploadUrl' => yii::$app->urlManager->baseUrl .'/theme/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                                                        'filebrowserImageUploadUrl' => yii::$app->urlManager->baseUrl .'/theme/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                                                         //   'filebrowserWindowWidth' => '1000',
                                                          //  'filebrowserWindowHeight' => '700',
                                                          //  'allowedContent' => true,
                                                            'language' => 'vi', 
                                                        ],

                                                    ]
                                                );*/
                                                    ?>
													 <div style="text-align: right; margin-bottom:10px; padding:10px;">

                                                    <button type="submit"
                                                        name="ProjectSection[<?php echo $index;?>][save]" value="save"
                                                        class="btn btn-sm btn-primary">Lưu
                                                        lại</button>
                                                    <button <?php echo $value->id?'':'disabled';?> type="button"
                                                        id="button-section-remove"
                                                        onClick="buttonSectionRemove('<?php echo Url::to(['project/project-section-delete', 'id' => $value->id, 'project_id' => $model->id]);?>')"
                                                        class="btn btn-danger btn-sm">Xoá</button>


                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                </div>
                                <?php ActiveForm::end(); ?>
                                <?php }?>
                            </div>
                            <div style="text-align: right; margin-bottom:10px; padding:0px;">
                                <div class="row">
                                    <div class="col-md-12">
                                        <button id="button-add-section" data-index="<?php echo $index;?>"
                                            class="btn btn-danger btn-block">Thêm
                                            mục</button>
                                    </div>
                                </div>
                            </div>

                            <!--/form-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script>
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#projectsection-' + $(input).data('id') + '-img').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
}
$("input[type='file']").change(function() {
    readURL(this);
});

function buttonSectionRemove(url) {
    var r = confirm("Có chắc muốn xoá mục bài viết này?");
    if (r == true) {
        window.location.href = url;
    }
};

$('.section-image-remove').click(function() {

    var r = confirm("Có chắc muốn xoá hình ảnh này mục này?");
    if (r == true) {
        if ($(this).attr('id')) {
            var id = $(this).attr('id');
            $.ajax({
                url: _jsBaseUrl + "/index.php?r=project/section-image-remove",
                type: "post",
                data: {
                    id: id,
                },
                dataType: "json",
                async: true,
                success: function(data) {
                    obj = JSON.parse(data);

                    $('#projectsection-' + id + '-img').attr('src', obj.url);
                    alert(obj.message);
                },
            });
        } else {
            console.log("File không tồn tại");
        }
    }



});
</script>

<script type="text/javascript">
window.dropzoneBanners = JSON.parse(' <?php echo json_encode($dropzoneBanners);?>');
window.dropzoneFiles = JSON.parse('<?php echo json_encode($dropzoneFiles);?>');
//console.log(window.dropzoneFile); 
</script>
<?php echo $this->registerJsFile('@web/plugins/dropzone/dropzone.js');?>
<?php echo $this->registerJsFile('@web/plugins/dropzone/script_banner.js');?>
<?php echo $this->registerJsFile('@web/plugins/dropzone/script_price_list.js');?>

<?php //echo $this->registerJsFile('@web/app/project.component.js',['type' =>'text/jsx']);?>
<script>
$(document).on('click', '#button-add-section', function() {
    //var myClone = $('.form-section:last').clone().appendTo(".wap-forrm");
    //myClone.attr("id", "w" + ($('.form-section').length));
    //  myClone.attr("id", "w" + ($('.form-section').length));

    // $('.wap-forrm').append(clone);

    //   $('.form-section').last().html(clone);
    $.ajax({
        url: "<?php echo  yii::$app->urlManager->createUrl(['project/add-section']);?>",
        type: "get",
        dataType: "html",
        data: {

            id: "<?php echo $model->id;?>",
            index: $('.form-section').length,
        },
        success: function(result) {
            $('.wap-forrm').append(result);
        }
    });

});
</script>