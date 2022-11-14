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
                        href="<?php echo  yii::$app->urlManager->createUrl(['project/edit', 'id' => $model->id]);?>"
                        data-toggle="tab" aria-expanded="true">Thông tin dự án <i class="fa fa-arrow-circle-right"
                            aria-hidden="true"></i> </a>
                </li>
                <li class=""><a
                        href="<?php echo  yii::$app->urlManager->createUrl(['project/project-section', 'id' => $model->id, 'menu' => $menu]);?>">Phần
                        của trang <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                </li>
                <li class=""><a
                        href="<?php echo  yii::$app->urlManager->createUrl(['project/investor', 'id' => $model->id]);?>">Chủ
                        đầu tư <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                </li>

                <li
                    <?php echo (Yii::$app->request->url==yii::$app->urlManager->createUrl(['project/contact', 'id' => $model->id]))? 'class="active"':'';?>>
                    <a href="<?php echo  yii::$app->urlManager->createUrl(['project/contact', 'id' => $model->id]);?>">Thông
                        tin liên hệ <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
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
                            <?php $form = ActiveForm::begin([
                                    'fieldConfig' => [
                                        'options' => [
                                            'tag' => false,
                                        ],
                                    ],
                                    'options' => ['enctype' => 'multipart/form-data']]) ?>
                            <!--form role="form" action="<?php echo yii::$app->urlManager->baseUrl?>/index.php?r=building-project-info%2Fadd" method="POST"-->
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Cập nhập thông tin dự án</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div class="col-md-2">
                                        <!-- /.box-body -->
                                        <div action="<?php echo Url::to(["project/upload-logo",'id' => $model->id],true);?>"
                                            class="dropzone" id="dropzone-logo-upload">
                                            <input type="hidden" id="upload_logo_id" name="upload_logo_id" value="" />
                                        </div>

                                    </div>
                                    <div class="col-md-10">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <?php echo $form->field($model, 'name')->textInput()->label("Tên"); ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <?php echo $form->field($model, 'apartment_category_id')->dropDownList($categories, ['prompt'=>'Chọn'])->label("Phân loại chung cư"); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <?php echo $form->field($model, 'province_id')->dropDownList($provinces, ['prompt'=>'* Tỉnh/Thành phố'])->label("Tỉnh/thành phố"); ?>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <?php echo $form->field($model, 'district_id')->dropDownList($districts, [
                                                            'prompt'=>'* Quận/Huyện',
                                                            'disabled' => ($model->province_id>0)?false:true
                                                            ])->label("Quận/Huyện"); ?>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <?php echo $form->field($model, 'ward_id')->dropDownList($wards, [
                                                        'prompt'=>'* Phường/ Xã',  
                                                        'disabled' => ($model->district_id>0)?false:true
                                                        ])->label("Phường/ Xã"); ?>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <?php echo $form->field($model, 'street')->textInput(['placeholder'=>'Chọn đường'])->label("Đường"); ?>
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
                                            <button type="button" class="btn btn-danger"
                                                data-dismiss="modal">Không</button>
                                            <button type="button" id="exitButton" class="btn btn-success">Đồng
                                                ý</button>
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
<script type="text/javascript">
window.dropzoneBanners = JSON.parse('<?php echo json_encode($dropzoneBanners);?>');
window.dropzoneFiles = JSON.parse('<?php echo json_encode($dropzoneFiles);?>');
window.dropzoneLogo = JSON.parse('<?php echo json_encode($dropzoneLogo);?>');
//console.log(window.dropzoneFile);
</script>
<?php //echo $this->registerJsFile('@web/plugins/dropzone/dropzone.js');?>
<?php echo $this->registerJsFile('@web/plugins/dropzone/script_banner.js');?>
<?php echo $this->registerJsFile('@web/plugins/dropzone/script_price_list.js');?>
<?php echo $this->registerJsFile('@web/plugins/dropzone/script_logo.js');?>
<script type="text/javascript">
$('select[name="Project[province_id]"]').on('change', function() {
    var provinceId = $(this).val();
    console.log(provinceId);
    if (provinceId > 0) {
        $.ajax({
            type: 'get',
            url: '<?php echo Url::to(["house/districts"]);?>',
            data: {
                province_id: provinceId
            },
            dataType: 'json',
            success: function(data) {
                $('#project-district_id').find('option')
                    .remove()
                    .end();
                $('#project-district_id')
                    .append($("<option></option>")
                        .attr("value", '')
                        .text('* Quận/Huyện'));
                $.each(data.districts, function(i, item) {
                    $('#project-district_id')
                        .append($("<option></option>")
                            .attr("value", item.district_id)
                            .text(item.name));
                });
                $('select[name="Project[district_id]"]').attr('disabled', false);
            }
        });
    } else {
        $('#project-district_id').find('option')
            .remove()
            .end();
        $('#proẹct-district_id')
            .append($("<option></option>")
                .attr("value", '')
                .text('* Quận/Huyện'));
        $('select[name="Project[district_id]"]').attr('disabled', true);
    }
});
</script>

<script type="text/javascript">
$('select[name="Project[district_id]"]').on('change', function() {
    var districtId = $(this).val();
    if (districtId > 0) {
        $.ajax({
            type: 'get',
            url: '<?php echo Url::to(["house/wards"]);?>',
            data: {
                district_id: districtId
            },
            dataType: 'json',
            success: function(data) {
                $('#project-ward_id').find('option')
                    .remove()
                    .end();
                $('#project-ward_id')
                    .append($("<option></option>")
                        .attr("value", '')
                        .text('* Phường/Xã'));
                $.each(data.wards, function(i, item) {
                    $('#project-ward_id')
                        .append($("<option></option>")
                            .attr("value", item.ward_id)
                            .text(item.name));
                });
                $('select[name="Project[ward_id]"]').attr('disabled', false);
            }
        });
    } else {
        $('#project-ward_id').find('option')
            .remove()
            .end();
        $('#project-ward_id')
            .append($("<option></option>")
                .attr("value", '')
                .text('* Phường/Xã'));
        $('select[name="Project[ward_id]"]').attr('disabled', true);
    }
});
</script>