<?php
use  yii\helpers\Url;
use yii\widgets\LinkPager;
use common\models\BuildingProjectInfo;
use yii\widgets\ActiveForm;
use frontend\widgets\AuthChoiceCustom;
use yii\helpers\Html;
use common\libraries\PseudoCrypt;
use frontend\widgets\Footer;
use frontend\widgets\HeaderPosterDetail;
?>
<?php echo $this->registerCssFile('@web/plugins/dropzone/dropzone.css'); ?>
<<?php echo HeaderPosterDetail::widget();?>
<div class="body">
    <div id="container">
        <div class="tab-content">
           
            <div class="list-box form-post">
                <div class="col col-sm-12 col-md-8" style="float:left">
                    <?php $form = ActiveForm::begin(['options' =>['enctype' => 'multipart/form-data','class' => 'form-login']]);?>

                    <div class="panel-body">

                        <div class="box box-solid">
                            <div class="box-header">
                                <h1 class="box-title">Đăng tin rao bán, cho thuê nhà đất</h1>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <div class="item">
                                    <div class="description">
                                        <div class="col-sm-12 col-xs-12 col">
                                            <?php echo $form->field($article, 'title',['options' => ['class' => 'form-group row'],
												'template' => "<div>{input}\n{error}</div>",
											])->textInput(['placeholder' => ' * Tiêu đề tin rao tối đa 100 ký tự', 'style' => 'float:left; ' ])->label(false) ?>
                                            <small class="chars" style="float:right; color: #333"><span
                                                    id="chars_title"></span> Ký tự còn lại</small>
                                            <?php echo $form->field($article, 'content',['options' => ['class' => 'form-group row'],
												'template' => "<div>{input}\n{error}</div>",
												])->textarea(['placeholder' => ' * Nội dung tin rao tối đa 2500 ký tự','rows' => '3', 'cols'=> '100', 'style' => 'float:left;  padding: 10px' ])->label(false) ?>
                                            <small class="chars" style="float:right; color: #333"><span
                                                    id="chars_description"></span> Ký tự còn lại</small>
                                        </div>

                                        <div class="col-sm-12 col">
                                            <div class="col-right-detail nopadding">
                                                <div class="col-sm-12 col-xs-12 price_text nopadding">
                                                    <?php echo $form->field($article, 'price_text',['options' => ['class' => 'form-group row'],
													'template' => "<div>{input}\n{error}</div>",
                                                    ])->textInput(['autocomplete' => 'off', 'placeholder'=> '* Giá bán (Vd: 5.6 tỷ)'])->label(false) ?>
                                                    <small class="chars" style="float:right; color: #333"><span></span>
                                                        Gía bán bao gồm số và chữ (Ví
                                                        dụ: 5.6 tỷ )</small>
                                                </div>
                                                <div class="col-sm-12 area_text  nopadding">
                                                    <?php echo $form->field($article, 'area_text',['options' => ['class' => 'form-group row'],
													'template' => "<div>{input}\n{error}</div>",
                                                    ])->textInput(['autocomplete' => 'off', 'placeholder'=> '* Diện tích (Vd: 100 m2)'])->label(false) ?>
                                                    <small class="chars" style="float:right; color: #333"><span></span>
                                                        Diện tích bao gồm số và chữ (Ví
                                                        dụ: 100 m2 )</small>
                                                </div>
                                                <div class="col-sm-12 col-xs-12 address nopadding">
                                                    <div class="col-sm-12 nopadding">
                                                        <div class="province">
                                                            <?php echo $form->field($article, 'province_id',['options' => ['class' => 'form-group row'],
                                                            'template' => "<div>{input}\n{error}</div>",])
															->dropDownList(
																				$provinces,           // Flat array ('id'=>'label')
																				[
																					'prompt'=>'* Tỉnh/Thành phố',
																																														
																				]    // options
																				)->label(false) ?>
                                                        </div>
                                                        <div class="district">
                                                            <?php echo $form->field($article, 'district_id',['options' => ['class' => 'form-group row'],
																'template' => "<div>{input}\n{error}</div>",
															    ])
																->dropDownList(
																				$districts,           // Flat array ('id'=>'label')
																				[
																						'prompt'=>'* Quận/Huyện',
																							'disabled' => true,
																																														
																						]    // options
																)->label(false) ?>
                                                        </div>
                                                        <div class="street">
                                                            <?php echo $form->field($article, 'street',['template' => '{input}'])
															->textInput(['autocomplete' => 'off', 'placeholder'=> 'Số nhà, Thôn/Xóm, Ấp/Xã, Phường, Đường'])->label(false) ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-xs-12 nopadding">
                                                        <?php echo $form->field($article, 'type_id',['options' => ['class' => 'form-group row'],
															'template' => "<div>{input}\n{error}</div>",
															])->dropDownList($articleTypes,           // Flat array ('id'=>'label')
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
                                                <div class="panel-group" id="accordion" role="tablist"
                                                    aria-multiselectable="true">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading active" role="tab" id="headingZero">
                                                            <h4 class="panel-title">
                                                                <a class="collapsed" role="button"
                                                                    data-toggle="collapse" data-parent="#accordion"
                                                                    href="#collapseZero" aria-expanded="true"
                                                                    aria-controls="collapseTwo">
                                                                    Ảnh chi tiết ( kéo thả hình ảnh vào - Bắt buộc)
                                                                </a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapseZero" class="panel-collapse collapse in"
                                                            role="tabpanel" aria-labelledby="headingZero">
                                                            <div class="panel-body">
                                                                <div action="<?php echo Url::to(["user/multiple-upload"],true);?>"
                                                                    enctype="multipart/form-data" class="dropzone"
                                                                    id="image-upload">
                                                                    <input type="hidden" id="UploadImageID"
                                                                        name="upload_image_id" value="" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading" role="tab" id="headingTwo">
                                                            <h4 class="panel-title">
                                                                <a class="collapsed" role="button"
                                                                    data-toggle="collapse" data-parent="#accordion"
                                                                    href="#collapseTwo" aria-expanded="false"
                                                                    aria-controls="collapseTwo">
                                                                    Tiện ích ngôi nhà (Không bắt buộc)
                                                                </a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapseTwo" class="panel-collapse collapse"
                                                            role="tabpanel" aria-labelledby="headingTwo">
                                                            <div class="panel-body">
                                                                <table class="table table-bordered">
                                                                    <tbody>
                                                                        <tr>

                                                                            <td style="width: 25%">Mặt tiền (m)</td>
                                                                            <td style="width: 25%"><input
                                                                                    class="form-control"
                                                                                    placeholder="Mặt tiền (Ví dụ: 7 m)"
                                                                                    name="ArticleDetail[frontend]"
                                                                                    type="text" value="" /></td>
                                                                            <td style="width: 25%">Đường vào (m)</td>
                                                                            <td style="width: 25%"><input
                                                                                    class="form-control"
                                                                                    placeholder="Đường vào (Ví dụ: 5 m)"
                                                                                    name="ArticleDetail[gateway]"
                                                                                    type="text" value="" /></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="width: 25%">Hướng nhà</td>
                                                                            <td style="width: 25%">
                                                                                <select id="direction"
                                                                                    class="form-control"
                                                                                    name="ArticleDetail[direction]">
                                                                                    <option value="0">Chưa biết</option>
                                                                                    <option value="1">Đông</option>
                                                                                    <option value="2">Tây</option>
                                                                                    <option value="3">Nam</option>
                                                                                    <option value="4">Bắc</option>
                                                                                    <option value="5">Đông-Bắc</option>
                                                                                    <option value="6">Tây-Bắc</option>
                                                                                    <option value="7">Tây-Nam</option>
                                                                                    <option value="8">Đông-Nam</option>
                                                                                </select>
                                                                            </td>
                                                                            <td style="width: 25%">Số tầng (tầng)</td>
                                                                            <td style="width: 25%"><input
                                                                                    class="form-control"
                                                                                    placeholder="Số tầng (Ví dụ: 2 tầng)"
                                                                                    name="ArticleDetail[floor]"
                                                                                    type="text" value="" /></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="width: 25%">Số phòng ngủ (phòng)
                                                                            </td>
                                                                            <td style="width: 25%"><input
                                                                                    class="form-control"
                                                                                    name="ArticleDetail[bedroom]"
                                                                                    placeholder="Số phòng (Ví dụ: 2 phòng)"
                                                                                    type="text" value="" /></td>
                                                                            <td style="width: 25%">Số phòng vệ sinh
                                                                                (phòng)</td>
                                                                            <td style="width: 25%"><input
                                                                                    class="form-control"
                                                                                    placeholder="Số phòng (Ví dụ: 2 phòng)"
                                                                                    name="ArticleDetail[toilet]"
                                                                                    type="text" value="" /></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="width: 25%">Nội thất</td>
                                                                            <td style="width: 25%"><textarea
                                                                                    class="form-control"
                                                                                    placeholder="Nội thất: Mô tả"
                                                                                    name="ArticleDetail[interior]"
                                                                                    type="text" value=""></textarea>
                                                                            </td>
                                                                            <td style="width: 25%">Ngoại thất</td>
                                                                            <td style="width: 25%"><textarea
                                                                                    class="form-control"
                                                                                    placeholder="Ngoại thất: Mô tả"
                                                                                    name="ArticleDetail[exterior]"
                                                                                    type="text" value=""></textarea>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading" role="tab" id="headingThree">
                                                            <h4 class="panel-title">
                                                                <a role="button" data-toggle="collapse"
                                                                    data-parent="#accordion" href="#collapseThree"
                                                                    aria-expanded="false" aria-controls="collapseThree">
                                                                    Thông tin liên hệ
                                                                </a>
                                                            </h4>
                                                        </div>
                                                        <div id="collapseThree" class="panel-collapse collapse"
                                                            role="tabpanel" aria-labelledby="headingThree">
                                                            <div class="panel-body">
                                                                <label class="radio">Cá nhân
                                                                    <input class="form-control" type="radio" value="0"
                                                                        checked="checked"
                                                                        name="ArticleInfo[is_company]">
                                                                    <span class="checkround"></span>
                                                                </label>
                                                                 <label class="radio">Môi giới
                                                                    <input class="form-control" type="radio" value="1"
                                                                        checked="checked"
                                                                        name="ArticleInfo[is_company]">
                                                                    <span class="checkround"></span>
                                                                </label>
                                                                <label class="radio">Công ty
                                                                    <input type="radio" value="2"
                                                                        name="ArticleInfo[is_company]">
                                                                    <span class="checkround"></span>
                                                                </label>
                                                                <table class="table table-bordered">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>Tên</td>
                                                                            <td><input class="form-control"
                                                                                    placeholder="Họ tên"
                                                                                    name="ArticleInfo[name]" type="text"
                                                                                    value="<?php echo $user->name;?>" />
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Điện thoại</td>
                                                                            <td><input class="form-control"
                                                                                    name="ArticleInfo[phone]"
                                                                                    type="text"
                                                                                    placeholder="Số điện thoại"
                                                                                    value="<?php echo $user->phone;?>" />
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Email</td>
                                                                            <td><input class="form-control"
                                                                                    name="ArticleInfo[email]"
                                                                                    type="text"
                                                                                     placeholder="Email"
                                                                                    value="<?php echo $user->email;?>" />
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Địa chỉ</td>
                                                                            <td><input class="form-control"
                                                                                    name="ArticleInfo[address]"
                                                                                    type="text"
                                                                                    placeholder="Địa chỉ"
                                                                                    value="<?php echo $user->address;?>" />
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
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


                            </div>


                        </div>
                    </div>
                    <?php ActiveForm::end(); ?>

                </div>
                <div class="col col-sm-12 col-md-4" style="height: 100vh; float:left; border:1px solid #ddd;">
                    <div class="panel-body">

                        <div class="box box-solid">
                            <div class="box-header">
                                <h2>Nội quy đăng bài</h2>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <ol>
                                    <li>Chỉ được đăng bài liên quan đến rao bán, cho thuê, cần mua, cần bán... liên quan
                                        đến bất động sản.</li>
                                    <li>Tin rao phải đúng, chính xác, không lừa đảo.</li>
                                    <li>Tin rao phải có dấu, đúng chính tả, có hình ảnh đính kèm mô tả sản phẩm.</li>
                                    <li>Mỗi ngày đăng tối thiểu 3 tin rao, không được spam</li>
                                    <li>Những tin rao bán, đăng trên Eland với tứ cách cá nhân, bạn phải chịu hoàn toàn
                                        với tin rao của chính mình.</li>
                                    <li>Những tin rao không tuân thủ pháp luật, quy tắc của Eland, chúng tôi có quyền
                                        xoá không cần thông báo.</li>

                                </ol>


                            </div>
                        </div>

                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <?php echo $this->registerJsFile('@web/plugins/dropzone/dropzone.js');?>
    <script type="text/javascript">
window.dropzoneImages = JSON.parse(' <?php echo json_encode($dropzoneImages);?>');

</script>
    <?php echo $this->registerJsFile('@web/plugins/dropzone/script.js');?>
    <?php echo $this->registerJsFile('@web/js/user.js');?>