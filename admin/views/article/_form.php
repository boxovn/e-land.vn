<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model common\models\model */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="model-form">


    <div class="list-box form-post">
        <?php
                    $form = ActiveForm::begin(['options' =>[
											'enctype' => 'multipart/form-data',
											'class' => 'form-login',
										],]);
					?>
        <div>
            <div class="panel-body">
                <div class="box box-solid">
                    <div class="box-body">
                        <div class="item">
                            <div class="description">
                                <div class="col-sm-12 col-xs-12 col">
                                    <?php echo $form->field($model, 'title',['options' => ['class' => 'form-group row'],
                        'template' => "<div>{input}\n{error}</div>",
                    ])->textInput(['placeholder' => ' * Tiêu đề tin rao tối đa 100 ký tự', 'style' => 'float:left; ' ])->label(false) ?>
                                    <small class="chars" style="float:right; color: #333"><span id="chars_title"></span>
                                        Ký tự còn lại</small>
                                    <?php echo $form->field($model, 'content',['options' => ['class' => 'form-group row'],
                        'template' => "<div>{input}\n{error}</div>",
                    ])->textarea(['placeholder' => ' * Nội dung tin rao tối đa 2500 ký tự','rows' => '3', 'cols'=> '100', 'style' => 'float:left;  padding: 10px' ])->label(false) ?>
                                    <small class="chars" style="float:right; color: #333"><span
                                            id="chars_description"></span> Ký tự còn lại</small>
                                </div>

                                <div class="col-sm-12 col">

                                    <?php echo $form->field($model, 'price_text',['options' => ['class' => 'form-group row'],
                        'template' => "<div>{input}\n{error}</div>",
                    ])->textInput(['autocomplete' => 'off', 'placeholder'=> '* Giá bán'])->label(false) ?>

                                    <?php echo $form->field($model, 'area_text',['options' => ['class' => 'form-group row'],
                        'template' => "<div>{input}\n{error}</div>",
                    ])->textInput(['autocomplete' => 'off', 'placeholder'=> '* Diện tích'])->label(false) ?>

                                    <?php echo $form->field($model, 'province_id',['options' => ['class' => 'form-group row'],
                                                    'template' => "<div>{input}\n{error}</div>",
                                                    ])
											->dropDownList(
												$provinces,           // Flat array ('id'=>'label')
												[
													'prompt'=>'* Tỉnh/Thành phố',
													
												]    // options
											)->label(false) ?>

                                    <?php echo $form->field($model, 'district_id',['options' => ['class' => 'form-group row'],
                        							'template' => "<div>{input}\n{error}</div>",
                    							])
											->dropDownList(
												$districts,           // Flat array ('id'=>'label')
												[
													'prompt'=>'* Quận/Huyện',
													'disabled' => true,
													
												]    // options
											)->label(false) ?>

                                    <?php echo $form->field($model, 'street',['options' => ['class' => 'form-group row'],'template' => '{input}'])
												->textInput(['autocomplete' => 'off', 'placeholder'=> 'Số nhà, Thôn/Xóm, Ấp/Xã, Phường, Đường'])->label(false) ?>
												<?php echo $form->field($model, 'category_type_id',['options' => ['class' => 'form-group row'],
                        							'template' => "<div>{input}\n{error}</div>",
                    							])
													->dropDownList(
														$articleTypes,           // Flat array ('id'=>'label')
														[
															'prompt'=>'* Tin rao ?',
															
														]    // options
													)->label(false) ?>

                                </div>
                                <div class="col-sm-12 nopadding">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-xs-12">
                        <div class="center-block">
                            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                <div class="panel panel-default">
                                    <div class="panel-heading active" role="tab" id="headingZero">
                                        <h4 class="panel-title">
                                            <a class="collapsed" role="button" data-toggle="collapse"
                                                data-parent="#accordion" href="#collapseZero" aria-expanded="true"
                                                aria-controls="collapseTwo">
                                                Ảnh chi tiết ( kéo thả hình ảnh vào - Bắt buộc)
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseZero" class="panel-collapse collapse in" role="tabpanel"
                                        aria-labelledby="headingZero">
                                        <div class="panel-body">
                                            <div action="<?php echo Url::to(["article/multiple-upload"],true);?>"
                                                enctype="multipart/form-data" class="dropzone" id="image-upload">
                                                <input type="hidden" id="UploadImageID" name="upload_image_id"
                                                    value="" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-xs-12 col-button">
                        <?= Html::submitButton('Đăng', ['name' => 'submit', 'class' => 'btn btn-sm btn-danger btn-block']) ?>
                    </div>

                </div>

            </div>

            <?php ActiveForm::end(); ?>
        </div>


    </div>
    <?php echo $this->registerJsFile('@web/plugins/dropzone/dropzone.js');?>
    <?php echo $this->registerJsFile('@web/plugins/dropzone/script.js');?>
    <?php //echo $this->registerJsFile('@web/js/user.js');?>