<?php
use yii\grid\GridView;
use backend\widgets\Alert;
use yii\widgets\ActiveForm;
use common\models\District;
use common\models\Province;
use common\models\Ward;
use common\models\Street;
use yii\helpers\ArrayHelper;
use common\models\Project;
use yii\helpers\Html;
use  yii\helpers\Url;
$this->title = 'Danh sách dự án';
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
            Danh sách dự án
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-home"></i> Trang chủ</a></li>
            <li class="active">Danh sách dự án</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a
                        href="<?php echo  yii::$app->urlManager->createUrl(['project/index', 'id' => $model->id?$model->id:0, 'menu' => $menu]);?>">Dự
                        án <i class="fa fa-arrow-circle-right" aria-hidden="true"></i> </a>
                </li>
                <li class=""><a
                        href="<?php echo  yii::$app->urlManager->createUrl(['project/project-section', 'id' => $model->id?$model->id:0, 'menu' => $menu]);?>">Chi
                        tiết <i class="fa fa-arrow-circle-right"></i></a>
                </li>
                <li class=""><a
                        href="<?php echo  yii::$app->urlManager->createUrl(['project/investor', 'id' => $model->id?$model->id:0, 'menu' => $menu]);?>">Chủ
                        đầu tư <i class="fa fa-arrow-circle-right"></i></a>
                </li>

                <li> <a
                        href="<?php echo  yii::$app->urlManager->createUrl(['project/contact', 'id' => $model->id?$model->id:0, 'menu' => $menu]);?>">Thông
                        tin liên hệ <i class="fa fa-arrow-circle-right"></i></a>
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
                                   /* 'fieldConfig' => [
                                        'options' => [
                                            'tag' => false,
                                        ],
                                    ],*/
                                    'options' => ['enctype' => 'multipart/form-data']]) ?>

                            <div>

                                <!-- /.box-header -->
                                <div class="box-body">
                                    <div class="col-md-3">
                                        <!-- /.box-body -->
                                        <div>
                                            <label class="control-label" for="project-name">Logo dự án</label>
                                            <label for="project-logo" style="width:200px">
                                                <div class="dropzone" style="position: relative; cursor:pointer">
                                                    <div class="logo-preview" id="<?php echo $model->id;?>">
                                                        <div class="logo-image">
                                                            <img style="border-radius: 20px;width: 120px; height: 120px; border: 1px solid #ddd; position: absolute;top: 50%; left: 50%; transform: translate(-50%,-50%);"
                                                                id="project-logo-img"
                                                                onerror="if (this.src != 'error.jpg') this.src = '<?php echo Yii::$app->params['url-channels']. 'projects/no-image.png';?>"
                                                                src="<?php echo $model->logo? Yii::$app->params['url-channels']. 'projects/logo/' . $model->logo:Yii::$app->params['url-channels']. 'projects/no-image.png'?>"
                                                                alt="Your image" />
                                                            <a data-id="<?php echo $model->id;?>"
                                                                id="<?php echo $model->id;?>" class="logo-remove"
                                                                href="javascript:undefined;" data-dz-remove=""></a>

                                                        </div>
                                                    </div>
                                                </div>
                                            </label>
                                            <?php echo $form->field($model, 'logo')->fileInput(['style' => 'display:none'])->label(false); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <?php echo $form->field($model, 'name')->textInput(['placeHolder' => 'Tên dự án'])->label("Tên"); ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <?php echo $form->field($model, 'category_id')->dropDownList($categories, ['prompt'=>'Chọn'])->label("Phân loại chung cư"); ?>
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
                                                    <?php echo $form->field($model, 'street')->textInput(['placeholder'=>'Số, đường'])->label("Đường"); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <?php echo $form->field($model, 'lat')->textInput(['placeholder'=>'Kinh độ']); ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <?php echo $form->field($model, 'lng')->textInput(['placeholder'=>'Vĩ độ']); ?>
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
                            <div style="text-align: right;">
                                <div class="row">
                                    <div class="col-md-12">
                                        <a class="btn btn-default"
                                            href="<?php echo  yii::$app->urlManager->createUrl(['project/index', 'menu' => $menu]);?>">Dự
                                            án mới</a>
                                        <button type="submit" class="btn btn-primary">Lưu lại</button>
                                    </div>
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
        <div class="row">
            <div class="col-xs-12">
                <?php echo Alert::widget(); ?>
                <div class="box box-danger">
                    <div class="box-header">
                        <h3 class="box-title">Danh sách dự án</h3>
                    </div>

                    <div class="box-body table-responsive">
                        <?php
                    		echo GridView::widget([
		                        'dataProvider' => $dataProvider,
		                        'filterModel' => $searchModel,
		                        'tableOptions' => ['class' => 'table table-bordered hqdat-table'],
                                'summaryOptions' => ['class' => 'dataTables_info'],
                                'rowOptions' => function ($model, $key, $index, $grid) {

	                                	return ['id' => $model['id']];

	                                },
                    			'summary' => 'Dòng <b>{begin} - {end}</b> của <b>{totalCount}</b> <div style="float: right;">Trang <b>{page}/{pageCount}</b></div>',
				                'columns' => [
		                            [
		                                'attribute' => 'id',
		                                'format' => 'text',
		                                'label' => '#',
		                                'contentOptions' => ['style' => 'width: 30px;text-align:center;vertical-align: middle;'],
		                                'headerOptions' => ['style'=>'width: 30px;text-align:center'],
		                            ],
		                            [
		                                'class' => 'yii\grid\DataColumn',
                                        'attribute' => 'name',
                                         'filterInputOptions' => [
                                            'class'       => 'form-control',
                                            'placeholder' => 'Tìm tên dự án...'
                                        ],
		                                'value' => function ($data) {
		                                	$s = strlen($data->name)>200 ? mb_strcut($data->name, 0, 200, 'UTF-8').'...' : $data->name;
		                                	if ($data->updated_status == 1) 
		                                    	return '<b style="color: #d73925;">'.$s.'</b>';
		                                	else
		                                		return $s;
		                                },
		                                'format' => 'html',
		                                'contentOptions' => ['style' => 'width: 25%;vertical-align: middle;']
                                    ],
                                      [
                            'class' => 'yii\grid\DataColumn',
                            'attribute' => 'province_id',
                             'value' => function($data){
                              	  return isset($data->province)? $data->province->type . ' ' . $data->province->name:'';
                              },
                              
                            'contentOptions' => ['class' => 'text-content'],
                            'headerOptions' => ['class' => 'text-header'],
							//'filter' => $districts,
							   'filter' => Html::dropDownList(
									'ProjectSearch[province_id]', 
									( isset(Yii::$app->request->get('ProjectSearch')['province_id']) ? Yii::$app->request->get('ProjectSearch')['province_id'] : '' ),  // set the default value for the dropdown list
									//( isset($_GET['pagesize']) ? $_GET['pagesize'] : 20 ),  // set the default value for the dropdown list
									// set the key and value for the drop down list
									$provinces,
									// add the HTML attritutes for the dropdown list
									// I add pagesize as an id of dropdown list. later on, I will add into the Gridview widget.
									// so when the form is submitted, I can get the $_POST value in InvoiceSearch model.
									array( 
										'id' => 'province_id', 
										'prompt'=>'* Tỉnh/Thành Phố',
										'disabled' =>  false,
										'class'  => 'form-control',
										
										)
									) 
								],	
							
                                    [
                            'class' => 'yii\grid\DataColumn',
                            'attribute' => 'district_id',
                             'value' => function($data){
                              	  return isset($data->district)? $data->district->type . ' ' . $data->district->name:'';
                              },
                            'contentOptions' => ['class' => 'text-content'],
                            'headerOptions' => ['class' => 'text-header'],
							//'filter' => $districts,
							   'filter' => Html::dropDownList(
									'ProjectSearch[district_id]', 
									( isset(Yii::$app->request->get('ProjectSearch')['district_id']) ? Yii::$app->request->get('ProjectSearch')['district_id'] : '' ),  // set the default value for the dropdown list
									//( isset($_GET['pagesize']) ? $_GET['pagesize'] : 20 ),  // set the default value for the dropdown list
									// set the key and value for the drop down list
								      	$districts,
									// add the HTML attritutes for the dropdown list
									// I add pagesize as an id of dropdown list. later on, I will add into the Gridview widget.
									// so when the form is submitted, I can get the $_POST value in InvoiceSearch model.
									array( 
										'id' => 'district_id', 
										'prompt'=>'* Quận/Huyện',
										'disabled' =>  false,
										'class'  => 'form-control',
										
										)
									) 
								],	
							[
                            'class' => 'yii\grid\DataColumn',
                            'attribute' => 'ward_id',
                             'value' => function($data){
                              	  return isset($data->ward)? $data->ward->type . ' ' . $data->ward->name:'';
                              },
                            'contentOptions' => ['class' => 'text-content'],
                            'headerOptions' => ['class' => 'text-header'],
                            'filter' => Html::dropDownList(
									'ProjectSearch[ward_id]', 
									( isset(Yii::$app->request->get('ProjectSearch')['ward_id']) ? Yii::$app->request->get('ProjectSearch')['ward_id'] : '' ),  // set the default value for the dropdown list
									//( isset($_GET['pagesize']) ? $_GET['pagesize'] : 20 ),  // set the default value for the dropdown list
									// set the key and value for the drop down list
									$wards,
									// add the HTML attritutes for the dropdown list
									// I add pagesize as an id of dropdown list. later on, I will add into the Gridview widget.
									// so when the form is submitted, I can get the $_POST value in InvoiceSearch model.
									array( 
										'id' => 'ward_id', 
										'prompt'=>'* Phường',
										'disabled' =>  true,
										'class'  => 'form-control',
										)
									) //$wards,
								],
		                           
                                     [
		                                'class' => 'yii\grid\DataColumn',
		                                'attribute' => 'version',
		                                'format' => 'html',
		                                'value' => function ($data) {
		                                    return $data->version == 1 ? "<span class='text-success'>Version-2.0</span>" :"<span class='text-danger'> Version-1.0</span>";
		                                },
		                                //'headerOptions' => ['id'=>'thCheckedStatus'],
                                        //'contentOptions' => ['style' => 'width: 15%;vertical-align: middle;'],
                                         'contentOptions' => ['class' => 'text-content'],
                                        'headerOptions' => ['class' => 'text-header'],
		                             //   'filter' => Yii::$app->user->identity->is_admin == 1 ? [1 => 'Tin đã duyệt', 0 => 'Tin chưa duyệt', 2 => 'Tin chờ nhập'] : [0 => 'Tin chưa duyệt', 2 => 'Tin chờ nhập']
                                    ],
                                    [
                                        'class' => 'yii\grid\CheckboxColumn',
                                         'checkboxOptions' => 
                                        function($model, $key, $index, $widget) {

                                                return ["value" => $model->id,'checked' => $model->status?true:false,'onclick' => 'addItems(this.value, this.checked)'];

                                            },
                                            
                                        
                                    ],
                                                                    [
		                                'class' => 'yii\grid\DataColumn',
		                                'attribute' => 'status',
		                                'format' => 'raw',
		                                'value' => function ($data) {
		                                    return  Project::getListStatus($data->status,true);
                                        },
                                       
		                                //'headerOptions' => ['id'=>'thCheckedStatus'],
                                        //'contentOptions' => ['style' => 'width: 15%;vertical-align: middle;'],
                                         'contentOptions' => ['class' => 'text-content text-status'],
                                        'headerOptions' => ['class' => 'text-header'],
		                             //   'filter' => Yii::$app->user->identity->is_admin == 1 ? [1 => 'Tin đã duyệt', 0 => 'Tin chưa duyệt', 2 => 'Tin chờ nhập'] : [0 => 'Tin chưa duyệt', 2 => 'Tin chờ nhập']
		                            ],
		                            [
		                                'class' => 'yii\grid\DataColumn',
		                                'attribute' => 'created',
		                                'format' => 'html',
		                                'value' => function ($data) {
		                                    return date('Y-m-d',strtotime($data->created));
		                                },
                                       // 'contentOptions' => ['style' => 'width: 10%;vertical-align: middle;']
                                         'contentOptions' => ['class' => 'text-content'],
                                        'headerOptions' => ['class' => 'text-header'],
		                            ],
									
                                    [	
					'class' => 'yii\grid\ActionColumn',
                    'template' =>'
                        <div style="width:100px;">                 
						<div class="btn-group">
                  			{view}
			                  <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
			                    <span class="caret"></span>
			                    <span class="sr-only">Toggle Dropdown</span>
			                  </button>
			                  <ul class="dropdown-menu" role="menu">
								<li>{update}</li>
			                    <li>{delete}</li>
			                  </ul>
                        </div>
                        </div>
                        ',
                    
					//'contentOptions' => ['style' => 'width: 8.7%'],
					//'filterOptions' => ['style' => 'display: none;'],
                   // 'header' => Html::a('Thêm', ['create','menu' => 'house'], ['class' => 'btn btn-primary btn-sm','style' => "width:100px" ]),
					'buttons'=>[
                        'view'=>function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span> Xem',
                            Yii::$app->params['elandUrl'].'du-an/' . $model->province->slug .'/'. $model->district->slug.'/'. $model->slug, ['target' => '_blank','class' => 'btn btn-primary btn-sm']);
					},
					'update'=>function ($url, $model) {
						return  Html::a('<span class="glyphicon glyphicon-edit"></span> Sửa', ['index', 'id'=> $model->id,'menu' => 'project']);
					},
					'delete'=>function ($url, $model) {
						//$t = 'index.php?r=social/delete&id='. $model->id;
						return  Html::a('<span class="glyphicon glyphicon-trash"></span> Xóa', ['delete', 'id'=> $model->id,'menu' => 'project'], [
						
							'data' => [
								'confirm' => 'Bạn có muốn xóa mục này?',
								'method' => 'post',
							],
							]);
						
					},
					
								  
				],
				],
                            
                                ],
                            ]);
                            ?>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
    <!-- /.content -->

</div>
<script>
function addItems(id, checked) {
    //var pick_id = getUrlVars()["id"];
    // alert(checked);
    // console.log(id, checked);
    $.ajax({
        url: '<?php echo yii::$app->urlManager->createUrl(['project/checked']) ?>',
        type: 'POST',
        dataType: 'json',
        data: {
            id: id,
            status: checked ? 1 : 0
        },
        success: function(data) {
            // console.log(data);
            if (data.status === 1) {
                $('#' + data.id + '> .text-status').removeClass("text-default").addClass("text-primary")
                    .html(data.text);
            } else {
                $('#' + data.id + '> .text-status').removeClass("text-primary").addClass("text-default")
                    .html(data.text);
            }
        }
    });

}
</script>
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

$("#project-logo").change(function() {
    readURL(this);
});
$('.logo-remove').click(function() {

    var r = confirm("Có chắc muốn xoá hình ảnh này");
    if (r == true) {
        if ($(this).attr('id')) {
            var id = $(this).attr('id');
            $.ajax({
                url: _jsBaseUrl + "/index.php?r=project/remove-logo",
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
<!-- /.content-wrapper -->
<script type="text/javascript">
jQuery(document).ready(function() {
    jQuery('.hqdat-table .back-click').click(function(event) {
        event.preventDefault();
        window.location = jQuery(this).attr('href') + '&pageBack=<?php echo $pageBack; ?>';
    });
});
</script>

<script type="text/javascript">
/*tab*/
$(function() {
    var hash = window.location.hash;
    hash && $('ul li a[href="' + hash + '"]').tab('show');
    $('ul li a').click(function(e) {
        $(this).tab('show');
        window.location.hash = this.hash;
    });


});
/*end tab*/
</script>
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
        $('#project-district_id')
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
