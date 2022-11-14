<?php
use yii\widgets\ActiveForm;
use common\models\District;
use common\models\Province;
use yii\helpers\ArrayHelper;
use common\models\Category;
use common\models\Ward;
use backend\widgets\Alert;
use common\models\Street;


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

<script src="<?php echo yii::$app->urlManager->baseUrl?>/theme/plugins/dropzone/dropzone.js"></script>
<link href="<?php echo yii::$app->urlManager->baseUrl?>/theme/plugins/dropzone/dropzone.css" rel="stylesheet">

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

                        <div class="form-group">
                            <?php echo $form->field($model, 'name')->textInput()->label("Tên"); ?>
                        </div>
                        <div class="form-group">
                            <?php echo $form->field($model, 'overview')->textarea()->label("Tổng quan"); ?>
                        </div>
                    </div>
                </div>
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Cập nhập thông tin dự án</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="form-group">
                            <?php echo $form->field($model, 'investor')->textInput()->label("Chủ đầu tư"); ?>
                        </div>
                        <div class="form-group">
                            <?php echo $form->field($model, 'currency_unit')->dropDownList(['VND' => 'VND', 'USD' => 'USD'], ['prompt'=>'Chọn loại tiền tệ̣'])->label("Loại tiền tệ̣"); ?>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="">
                                    <label class="control-label">Giá mở bán</label>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <?php echo $form->field($model, 'ogirinal_price_from')->textInput(['placeholder' => 'Thấp nhất'])->label(false); ?>
                                        </div>
                                    </div>
                                    <!-- /.col-lg-6 -->
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <?php echo $form->field($model, 'ogirinal_price_to')->textInput(['placeholder' => 'Cao nhất'])->label(false); ?>
                                        </div>
                                    </div>
                                    <!-- /.col-lg-6 -->
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="">
                                    <label class="control-label">Giá thị trường</label>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <?php echo $form->field($model, 'market_price_from')->textInput(['placeholder' => 'Thấp nhất'])->label(false); ?>
                                        </div>
                                    </div>
                                    <!-- /.col-lg-6 -->
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <?php echo $form->field($model, 'market_price_to')->textInput(['placeholder' => 'Cao nhất'])->label(false); ?>
                                        </div>
                                    </div>
                                    <!-- /.col-lg-6 -->
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="">
                                    <label class="control-label">Giá thuê</label>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <?php echo $form->field($model, 'hire_price_from')->textInput(['placeholder' => 'Thấp nhất'])->label(false); ?>
                                        </div>
                                    </div>
                                    <!-- /.col-lg-6 -->
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <?php echo $form->field($model, 'hire_price_to')->textInput(['placeholder' => 'Cao nhất'])->label(false); ?>
                                        </div>
                                    </div>
                                    <!-- /.col-lg-6 -->
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php echo $form->field($model, 'apartment_category_id')->dropDownList(ArrayHelper::map(Category::find()->orderBy(['title' => 'ASC'])->asArray()->all(),'id','title'), ['prompt'=>'Chọn'])->label("Phân loại chung cư"); ?>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php echo $form->field($model, 'province_id')->dropDownList(ArrayHelper::map(Province::find()->orderBy(['type' => 'ASC', 'name' => 'ASC'])->asArray()->all(),'province_id','name'), ['prompt'=>'Chọn tỉnh/thành phố'])->label("Tỉnh/thành phố"); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php echo $form->field($model, 'district_id')->dropDownList(ArrayHelper::map(District::find()->orderBy(['type' => 'ASC', 'name' => 'ASC'])->where(['province_id' => isset($provinceID)?$provinceID:0])->asArray()->all(),'district_id','name'), ['prompt'=>'Chọn Quận/Huyện'])->label("Quận/Huyện"); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php echo $form->field($model, 'ward_id')->dropDownList(ArrayHelper::map(Ward::find()->orderBy(['type' => 'ASC', 'name' => 'ASC'])->where(['district_id' => isset($districtID)?$districtID:0])->asArray()->all(),'ward_id','name'), ['prompt'=>'Chọn Phường/ Xã'])->label("Phường/ Xã"); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php echo $form->field($model, 'street_id')->dropDownList(ArrayHelper::map(Street::find()->orderBy(['type' => 'ASC', 'name' => 'ASC'])->where(['district_id' => isset($districtID)?$districtID:0])->asArray()->all(),'street_id','name'), ['prompt'=>'Chọn đường'])->label("Đường"); ?>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php echo $form->field($model, 'address')->textInput()->label("Địa chỉ"); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php echo $form->field($model, 'email')->textInput()->label("Email"); ?>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php echo $form->field($model, 'phone')->textInput()->label("Điện thoại"); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php echo $form->field($model, 'website')->textInput(); ?>
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
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php echo $form->field($model, 'release_date')->textInput()->label("Ngày hoàn thành"); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class=""><label class="control-label">Hình ảnh</label> (Mỗi lần upload tối đa 5
                                    hình [.jpg, .jpeg, .png])</div>
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
                <!-- /.box -->

                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Tiện ích trong dự án</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <?php 
					            		foreach ($serviceCategory as $item) {					            	
					            	?>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>
                                        <input id="internalCode_<?php echo $item['id']?>"
                                            value="<?php echo $item['id']?>" type="checkbox" class="internal-code">
                                        <span style="padding-left: 5px;"><?php echo $item['name']?></span>
                                    </label>
                                </div>
                            </div>
                            <?php 
					            		} 
					            	?>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group" id="divInternalService"
                                    style="<?php if ($model->internal_service_code) echo ''; else echo 'display: none;'; ?>">
                                    <?php echo $form->field($model, 'internal_service')->textarea()->label("Mô tả"); ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="hidden" id="internal_service_code"
                                name="BuildingProjectInfo[internal_service_code]"
                                value="<?php echo $model->internal_service_code; ?>">
                        </div>

                    </div>
                    <!-- /.box-body -->
                </div>

                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Tiện ích bên ngoài dự án</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <?php echo $form->field($model, 'external_service')->textarea()->label(false); ?>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.box-body -->
                </div>

                <div style="padding-bottom: 100px; text-align: center;">
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-2">
                            <button type="button" id="backButton" name="backButton" class="btn btn-warning">Quay
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
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
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
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

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