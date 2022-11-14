<?php
use yii\widgets\ActiveForm;
use common\models\District;
use common\models\Province;
use yii\helpers\ArrayHelper;
use common\models\ApartmentCategory;
use common\models\Ward;
use backend\widgets\Alert;
use common\models\Street;
$this->title = 'Thêm dự án';
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
            Thêm dự án
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-home"></i> Trang chủ</a></li>
            <li class="active">Thêm dự án</li>
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
                        <h3 class="box-title">Phần 1</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">

                        </div>
                    </div>
                </div>
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Thêm dự án</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        <div class="form-group">
                            <?php echo $form->field($model, 'name')->textInput()->label("Tên"); ?>
                        </div>
                        <div class="form-group">
                            <?php echo $form->field($model, 'overview')->textarea()->label("Tổng quan"); ?>
                        </div>
                        <div class="form-group">
                            <?php echo $form->field($model, 'investor')->textInput()->label("Chủ đầu tư"); ?>
                        </div>
                        <div class="form-group">
                            <?php echo $form->field($model, 'currency_unit')->dropDownList(['VND' => 'VND', 'USD' => 'USD'], ['prompt'=>'Chọn loại tiền tệ'])->label("Loại tiền tệ"); ?>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="">
                                    <label class="control-label">Giá mở bán</label>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <?php echo $form->field($model, 'ogirinal_price_from')->textInput(['placeholder' => 'Thấp nhất'])->label(false); ?>
                                        </div>
                                    </div>
                                    <!-- /.col-lg-6 -->
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <?php echo $form->field($model, 'ogirinal_price_to')->textInput(['placeholder' => 'Cao nhất'])->label(false); ?>
                                        </div>
                                    </div>
                                    <!-- /.col-lg-6 -->
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="">
                                    <label class="control-label">Giá thị trường</label>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <?php echo $form->field($model, 'market_price_from')->textInput(['placeholder' => 'Thấp nhất'])->label(false); ?>
                                        </div>
                                    </div>
                                    <!-- /.col-lg-6 -->
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <?php echo $form->field($model, 'market_price_to')->textInput(['placeholder' => 'Cao nhất'])->label(false); ?>
                                        </div>
                                    </div>
                                    <!-- /.col-lg-6 -->
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="">
                                    <label class="control-label">Giá thuê</label>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <?php echo $form->field($model, 'hire_price_from')->textInput(['placeholder' => 'Thấp nhất'])->label(false); ?>
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
                                    <?php echo $form->field($model, 'apartment_category_id')->dropDownList(ArrayHelper::map(ApartmentCategory::find()->orderBy(['name' => 'ASC'])->asArray()->all(),'id','name'), ['prompt'=>'Chọn'])->label("Phân loại chung cư"); ?>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php echo $form->field($model, 'province_id')->dropDownList(ArrayHelper::map(Province::find()->orderBy(['type' => 'ASC', 'name' => 'ASC'])->asArray()->all(),'province_id','name'), ['prompt'=>'Chọn Tỉnh/Thành phố'])->label("Tỉnh/Thành phố"); ?>
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
                                    <?php echo $form->field($model, 'ward_id')->dropDownList(ArrayHelper::map(Ward::find()->orderBy(['type' => 'ASC', 'name' => 'ASC'])->where(['district_id' => isset($districtID)?$districtID:0])->asArray()->all(),'ward_id','name'), ['prompt'=>'Chọn Phường/Xã'])->label("Phường/Xã"); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php echo $form->field($model, 'street_id')->dropDownList(ArrayHelper::map(Street::find()->orderBy(['type' => 'ASC', 'name' => 'ASC'])->where(['district_id' => isset($districtID)?$districtID:0])->asArray()->all(),'street_id','name'), ['prompt'=>'Chọn đường'])->label("Đường"); ?>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php echo $form->field($model, 'address')->textInput()->label("Địa chỉ"); ?>
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
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php echo $form->field($model, 'release_date')->textInput()->label("Ngày hoàn thành"); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class=""><label class="control-label">Hình ảnh</label> (Mổi lần upload tối đa
                                    5 hình, loại hình [.jpg, .jpeg, .png])</div>
                                <div action="<?php echo yii::$app->urlManager->baseUrl?>/index.php?r=building-project-info%2Fupload"
                                    class="dropzone" id="myAwesomeDropzone" multiple>
                                </div>
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
                                <div class="form-group" id="divInternalService" style="display: none;">
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
                    <button type="submit" class="btn btn-primary">Lưu thông tin</button>
                </div>
                <?php ActiveForm::end(); ?>
                <!--/form-->
            </div>


        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script src="<?php echo yii::$app->urlManager->baseUrl?>/theme/common/js/common.js"></script>
<script src="<?php echo yii::$app->urlManager->baseUrl?>/theme/plugins/ckeditor/ckeditor.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    // Init dropzone 
    Dropzone.options.myAwesomeDropzone = {
        paramName: "MultipleUploadForm[files]",
        maxFilesize: 1, // MB
        uploadMultiple: true,
        maxFiles: 5,
        acceptedFiles: ".png,.jpg,.jpeg",
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
        success: function(event, response) {
            var objData = JSON.parse(response);
            var value = document.getElementById("UploadImageID").value;
            value = value != '' ? value + ';' : '';
            document.getElementById("UploadImageID").value = value + objData.sID;
        }
    };

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

    // Date picker
    //$('#buildingprojectinfo-release_date').datepicker({
    //  	autoclose: true,
    //  	format: 'yyyy-mm-dd'
    //s});   

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
</script>