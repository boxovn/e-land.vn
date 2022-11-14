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
                        href="<?php echo  yii::$app->urlManager->createUrl(['project/edit', 'id' => $model->id]);?>"
                        data-toggle="tab" aria-expanded="true">Thông tin dự án</a>
                </li>
                <li class=""><a
                        href="<?php echo  yii::$app->urlManager->createUrl(['project/investor', 'id' => $model->id]);?>">Chủ
                        đầu tư</a>
                </li>
                <li class=""><a
                        href="<?php echo  yii::$app->urlManager->createUrl(['project/create-page', 'id' => $model->id]);?>">Phần
                        của trang</a>
                </li>
                <li
                    <?php echo (Yii::$app->request->url==yii::$app->urlManager->createUrl(['project/contact', 'id' => $model->id]))? 'class="active"':'';?>>
                    <a href="<?php echo  yii::$app->urlManager->createUrl(['project/contact', 'id' => $model->id]);?>">Thông
                        tin liên hệ</a>
                </li>

            </ul>
            <div class="tab-content">

                <!-- /.tab-pane -->
                <div class="tab-pane active" id="project">
                    <!-- The timeline -->
                    <div class="row">
                        <div class="col-md-12">
                            <!-- general form elements -->
                            <!-- form start -->
                            <?php echo Alert::widget() ?>
                            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
                            <!--form role="form" action="<?php echo yii::$app->urlManager->baseUrl?>/index.php?r=building-project-info%2Fadd" method="POST"-->
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Cập nhập thông tin dự án</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div class="col-md-3">
                                        <!-- Profile Image -->

                                        <div class="box-body box-profile">
                                            <img class="profile-user-img img-responsive img-circle"
                                                onerror="if (this.src != 'error.jpg') this.src ='<?php echo Yii::$app->params['url-page'];?>images/no-image200x200.png';"
                                                width="128px" style="border:1px solid #ddd"
                                                src="<?php echo Yii::$app->params['url-page'] . 'channels/avatar/' . $user->image;?>"
                                                alt="User profile picture">

                                            <h3 class="profile-username text-center"><?php echo $user->name;?></h3>

                                            <p class="text-muted text-center">Logo dự án</p>
                                        </div>
                                        <!-- /.box-body -->


                                    </div>
                                    <div class="col-md-9">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <?php echo $form->field($model, 'name')->textInput()->label("Tên"); ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <?php echo $form->field($model, 'apartment_category_id')->dropDownList(ArrayHelper::map(ApartmentCategory::find()->orderBy(['name' => 'ASC'])->asArray()->all(),'id','name'), ['prompt'=>'Chọn'])->label("Phân loại chung cư"); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <?php echo $form->field($model, 'province_id')->dropDownList($provinces, ['prompt'=>'Chọn tỉnh/thành phố'])->label("Tỉnh/thành phố"); ?>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <?php echo $form->field($model, 'district_id')->dropDownList($districts, ['prompt'=>'Chọn Quận/Huyện'])->label("Quận/Huyện"); ?>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <?php echo $form->field($model, 'ward_id')->dropDownList($wards, ['prompt'=>'Chọn Phường/ Xã'])->label("Phường/ Xã"); ?>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <?php echo $form->field($model, 'street_id')->dropDownList($streets, ['prompt'=>'Chọn đường'])->label("Đường"); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <?php echo $form->field($model, 'lat')->textInput(); ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <?php echo $form->field($model, 'lng')->textInput(); ?>
                                                </div>
                                            </div>
                                            <div class="text-input">
                                                <!--div id="mapGetLocation" style="min-width: 200px; height: 250px;"></div-->
                                                <input type="hidden" name="lat1" id="inputLat" />
                                                <input type="hidden" name="lng1" id="inputLng" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Banner Slider (Hình đại diện)</h3>
                                </div>
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class=""><label class="control-label">Hình ảnh</label> (Mỗi lần upload
                                                tối
                                                đa 5 hình [.jpg, .jpeg, .png])</div>
                                            <div action="<?php echo yii::$app->urlManager->baseUrl?>/index.php?r=building-project-info%2Fupload"
                                                class="dropzone" id="myAwesomeDropzone" multiple>
                                            </div>
                                            <!--div id="preview-template">
							            		<div class="dz-preview dz-file-preview well" id="dz-preview-template"></div>
							            	</div-->
                                            <input type="hidden" id="UploadImageID" name="upload_image_id" value="" />
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Tiện ích</h3>
                                </div>
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class=""><label class="control-label">Hình ảnh</label> (Mỗi lần upload
                                                tối
                                                đa 5 hình [.jpg, .jpeg, .png])</div>
                                            <div action="<?php echo yii::$app->urlManager->baseUrl?>/index.php?r=building-project-info%2Fupload"
                                                class="dropzone" id="myAwesomeDropzone" multiple>
                                            </div>
                                            <!--div id="preview-template">
							            		<div class="dz-preview dz-file-preview well" id="dz-preview-template"></div>
							            	</div-->
                                            <input type="hidden" id="UploadImageID" name="upload_image_id" value="" />
                                        </div>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Bảng giá</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div action="<?php echo Url::to(["project/multiple-upload-file"],true);?>"
                                        enctype="multipart/form-data" class="dropzone" id="file-upload">
                                        <input type="hidden" id="UploadImageID" name="upload_image_id" value="" />
                                    </div>

                                </div>
                            </div>
                            <!-- /.box -->
                            <div style="padding-bottom: 100px; text-align: center;">
                                <div class="row">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-2">
                                        <button type="button" id="backButton" name="backButton"
                                            class="btn btn-warning">Quay
                                            lại</button>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-primary">Lưu thông tin</button>
                                    </div>
                                    <div class="col-md-4"></div>
                                </div>
                            </div>
                            <?php ActiveForm::end(); ?>
                            <!--/form-->
                        </div>

                        <div id="confirmExit" class="modal fade" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">Thông báo</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p>Bạn muốn thoát khỏi trang này?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Không</button>
                                        <button type="button" id="exitButton" class="btn btn-success">Đồng ý</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
            <!-- /.tab-content -->
        </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php //echo $this->registerJsFile('@web/plugins/dropzone/dropzone.js');?>
<?php //echo $this->registerJsFile('@web/plugins/dropzone/script.js');?>
<script src="<?php echo yii::$app->urlManager->baseUrl?>/theme/common/js/common.js"></script>
<script src="<?php echo yii::$app->urlManager->baseUrl?>/theme/plugins/ckeditor/ckeditor.js"></script>
<!--script src="//maps.google.com/maps/api/js?key=AIzaSyBjxScIQs65JjTuovzmaxmcWM_xCLuz7mE&sensor=true"></script-->
<style>
.dz-image img {
    width: 120px;
    height: 120px;
}
</style>

<script type="text/javascript">
$(document).ready(function() {

    var dropzoneImage = JSON.parse('<?php echo json_encode($dropzoneImage);?>');

    // Init dropzone and autoload image into dropzone
    var options = {
        paramName: "MultipleUploadForm[files]",
        maxFilesize: 1, // MB
        uploadMultiple: true,
        addRemoveLinks: true,
        maxFiles: 5,
        acceptedFiles: ".png,.jpg,.jpeg",
        thumbnailWidth: 120,
        thumbnailHeight: 120,
        dictDefaultMessage: "Click hoặc kéo thả hình vào đây",
        dictCancelUpload: "Dừng",
        dictCancelUploadConfirmation: "Bạn có muốn hủy việc tải lên này?",
        dictFallbackMessage: "Trình duyệt của bạn không hỗ trợ kéo thả file.",
        dictFileTooBig: "File quá lớn ({{filesize}}MiB). Kích thước giơi hạn: {{maxFilesize}}MiB.",
        dictInvalidFileType: "Không thể upload loại file này.",
        dictMaxFilesExceeded: "Không thể upload thêm.",
        dictRemoveFile: "Xóa file",
        dictRemoveFileConfirmation: null,
        dictResponseError: "Error {{statusCode}}.",
    };

    var myDropzone = new Dropzone("#myAwesomeDropzone", options);
    for (var i = 0; i < dropzoneImage.length; i++) {
        var file = dropzoneImage[i];
        myDropzone.options.addedfile.call(myDropzone, file);
        myDropzone.options.thumbnail.call(myDropzone, file, file.url);
        myDropzone.emit('complete', file);
    }
    myDropzone.on("success", function(event, response) {
        var objData = JSON.parse(response);
        var currentID = document.getElementById("UploadImageID").value;
        currentID = currentID != '' ? currentID + ';' : currentID;
        document.getElementById("UploadImageID").value = currentID + objData.sID;
    });
    myDropzone.on("removedfile", function(file) {
        $.ajax({
            url: '<?php echo yii::$app->urlManager->baseUrl?>/index.php?r=building-project-info%2Fdelimage',
            type: 'post',
            data: {
                id: file.id
            },
            dataType: 'json',
            async: true,
            success: function(data) {}
        });
    });
    // */

    // CKEditor init 
    CKEDITOR.replace('buildingprojectinfo-overview', {
        language: 'vi',
        filebrowserImageBrowseUrl: '<?php echo yii::$app->urlManager->baseUrl?>/theme/plugins/ckfinder/ckfinder.html?type=Images',
        filebrowserUploadUrl: '<?php echo yii::$app->urlManager->baseUrl?>/theme/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'
    });
    CKEDITOR.replace('buildingprojectinfo-external_service', {
        language: 'vi',
        filebrowserImageBrowseUrl: '<?php echo yii::$app->urlManager->baseUrl?>/theme/plugins/ckfinder/ckfinder.html?type=Images',
        filebrowserUploadUrl: '<?php echo yii::$app->urlManager->baseUrl?>/theme/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'
    });

    CKEDITOR.replace('buildingprojectinfo-internal_service', {
        language: 'vi',
        filebrowserImageBrowseUrl: '<?php echo yii::$app->urlManager->baseUrl?>/theme/plugins/ckfinder/ckfinder.html?type=Images',
        filebrowserUploadUrl: '<?php echo yii::$app->urlManager->baseUrl?>/theme/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'
    });

    var codeData = $('#internal_service_code').val();
    if (codeData != '') {
        var array = codeData.split(';');
        for (var i = 0; i < array.length; i++) {
            $("#internalCode_" + array[i]).prop("checked", true);
        }
    }

    $(".internal-code").change(function() {
        var s = '';
        var flag = false;
        $('input:checkbox[class=internal-code]').each(function() {
            if ($(this).is(':checked')) {
                s += $(this).val() + ';';
                $('#divInternalService').show();
                flag = true;
            }
        });
        if (flag == false) $('#divInternalService').hide();
        $('#internal_service_code').val(s);
    });

    // Load default location map	
    //mapGetLocation(10.801250, 106.697012); // HCM location 

    // Date picker
    //$('#buildingprojectinfo-release_date').datepicker({
    //  	autoclose: true,
    //  	format: 'yyyy-mm-dd'
    //}); 

    $("#buildingprojectinfo-ogirinal_price_from").keyup(function() {
        var val = $(this).val();
        if (val == "") val = 0;
        else val = val.replace(/,/gi, "");
        $(this).val(currencyFormat(val, false));
    });
    $("#buildingprojectinfo-ogirinal_price_to").keyup(function() {
        var val = $(this).val();
        if (val == "") val = 0;
        else val = val.replace(/,/gi, "");
        $(this).val(currencyFormat(val, false));
    });
    $("#buildingprojectinfo-market_price_from").keyup(function() {
        var val = $(this).val();
        if (val == "") val = 0;
        else val = val.replace(/,/gi, "");
        $(this).val(currencyFormat(val, false));
    });
    $("#buildingprojectinfo-market_price_to").keyup(function() {
        var val = $(this).val();
        if (val == "") val = 0;
        else val = val.replace(/,/gi, "");
        $(this).val(currencyFormat(val, false));
    });
    $("#buildingprojectinfo-hire_price_from").keyup(function() {
        var val = $(this).val();
        if (val == "") val = 0;
        else val = val.replace(/,/gi, "");
        $(this).val(currencyFormat(val, false));
    });
    $("#buildingprojectinfo-hire_price_to").keyup(function() {
        var val = $(this).val();
        if (val == "") val = 0;
        else val = val.replace(/,/gi, "");
        $(this).val(currencyFormat(val, false));
    });


});

$("section.sidebar ul.sidebar-menu li a").click(function(e) {
    event.preventDefault();
    var url = $(this).attr('href');
    confirmAction(url);
});
$('#backButton').click(function() {
    confirmAction('<?php echo yii::$app->urlManager->baseUrl?>/index.php?r=building-project-info%2Findex');
});

function confirmAction(url) {
    $('#confirmExit').modal('show');
    $('#confirmExit').on('click', '#exitButton', function(e) {
        window.location = url + '&page=<?php echo $pageBack; ?>'
    });
}
</script>