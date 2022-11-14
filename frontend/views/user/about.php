<?php
use  yii\helpers\Url;
use yii\widgets\LinkPager;
use common\models\BuildingProjectInfo;
use yii\widgets\ActiveForm;
use frontend\widgets\AuthChoiceCustom;
use yii\helpers\Html;
use common\libraries\PseudoCrypt;
use frontend\widgets\HeaderUserDetail;
?>
<?php echo HeaderUserDetail::widget();?>
<style>
.list-box .box {
background-color: #fff;
border-radius: 8px;
border: 1px solid #dadce0;
box-sizing: border-box;
overflow: hidden;
width: 100%;
padding: 30px;
margin-bottom: 30px;
}
.poster_avatar {
position: relative;
margin-left: 15px;
margin-right: 15px;
display: inline-block;
float: left;
}
.img-avatar {
border: 1px solid #eee;
width: 60px;
height: 60px;
border-radius: 100%;
float: left;
padding: 2px;
}
</style>
<div class="body">
    <div id="container">
        <div class="tab-content">
            <div id="list-box" class="list-box">
                <!-- tabs -->
                <div class="row">
                    <div class="col col-md-9">
                        <center>
                        <h3 class="box-title">Thông tin cá nhân</h3>
                        <p>Thôn tin cơ bản như hình ảnh, tên, thông tin liên hệ, mô tả thôn tin nghề nghiệp, triết
                            lý kinh doanh của bạn. Giúp tăng uy tín, niềm tin của bạn đối với khách hàng.
                        </p>
                        </center>
                        <div class="panel-body">
                            <div class="box">
                                <?php
                                $form = ActiveForm::begin([
                                
                                'options' =>[
                                'enctype' => 'multipart/form-data',
                                'class' => 'form-login',
                                ],]);
                                ?>
                                <h4 class="box-title">Giới thiệu</h4>
                                <div><label>Avatar</label></div>
                                <div class="col-md-3">
                                    <?php echo $form->field($user, 'image_manager_id')->widget(\noam148\imagemanager\components\ImageManagerInputWidget::className(), [
                                    'aspectRatio' => (16/9), //set the aspect ratio
                                    'cropViewMode' => 1, //crop mode, option info: https://github.com/fengyuanchen/cropper/#viewmode
                                    'showPreview' => true, //false to hide the preview
                                    'showDeletePickedImageConfirm' => false, //on true show warning before detach image
                                    ])->label(false);?>
                                    <span style="font-size: 12px">( Click để thay đổi hình)</span>
                            
                            </div>
                            <div class="col-md-9">
                                <?php echo $form->field($user, 'about',['template' => '{input}'])->textArea(['autocomplete' => 'off', 'rows' => '6', 'cols'=>'100%', 'placeholder'=> 'Giới thiệu'])->label(false) ?>
                            </div>
                            <div style="float:right; padding: 10px;">
                                <?= Html::submitButton('Cập nhập', ['name' => 'submit-', 'class' => 'btn btn-sm btn-danger']) ?>
                            </div>
                            <?php ActiveForm::end(); ?>
                        </div>
                        <div class="box">
                            <?php
                            $form = ActiveForm::begin([
                            'options' =>[
                            'enctype' => 'multipart/form-data',
                            'class' => 'form-login',
                            ],]);
                            ?>
                            <h4 class="box-title">Thông tin cơ bản</h4>
                            <div><label>Họ và Tên</label></div>
                            <div>
                                <?php echo $form->field($user, 'name',['template' => '{input}{error}'])->textInput(['autocomplete' => 'off', 'placeholder'=> 'Tên'])->label(false) ?>
                            </div>
                            <div><label>Ngày sinh</label></div>
                            <div>
                                <?php echo $form->field($user, 'birthday',['template' => '{input}'])->widget(yii\jui\DatePicker::classname(), [
                                'options' => ['class' => 'form-control'],
                                'language' => 'vi',
                                'dateFormat' => 'dd/MM/yyyy',
                                ]
                                )->label(false) ?>
                            </div>
                            <div><label>Giới tính</label></div>
                            <div>
                                <?php
                                
                                echo $form->field($user, 'sex',['template' => '{input}'])->radioList([ 0 =>'Nữ', 1 => 'Nam'])->label(false) ?>
                            </div>
                            <div style="float:right; padding: 10px;">
                                <?= Html::submitButton('Cập nhập', ['name' => 'submit', 'class' => 'btn btn-sm btn-danger']) ?>
                            </div>
                            <?php ActiveForm::end(); ?>
                        </div>
                        <div class="box">
                            <?php
                            $form = ActiveForm::begin([
                            'options' =>[
                            'enctype' => 'multipart/form-data',
                            'class' => 'form-login',
                            ],]);
                            ?>
                            <h4 class="box-title">Thông tin liên hệ</h4>
                            <div><label>Điện thoại</label></div>
                            <div>
                                <?php echo $form->field($user, 'phone',['template' => '{input}{error}'])->textInput(['autocomplete' => 'off', 'placeholder'=> 'Số điện thoại'])->label(false) ?>
                            </div>
                            <div><label>Email</label></div>
                            <div>
                                <?php echo $form->field($user, 'email',['template' => '{input}'])->textInput(['autocomplete' => 'off', 'placeholder'=> 'Địa chỉ Email'])->label(false) ?>
                            </div>
                            <div><label>Địa chỉ</label></div>
                            <div>
                                <div class="col-sm-12 address nopadding">
                                    <div class="col-sm-12 nopadding">
                                        <div class="province">
                                            <?php echo $form->field($user, 'province_id',['template' => '{input}'])
                                            ->dropDownList(
                                            $provinces,           // Flat array ('id'=>'label')
                                            [
                                            'prompt'=>'* Tỉnh/Thành phố',
                                            
                                            ]    // options
                                            )->label(false) ?>
                                        </div>
                                        <div class="district">
                                            <?php echo $form->field($user, 'district_id',['template' => '{input}'])
                                            ->dropDownList(
                                            $districts,           // Flat array ('id'=>'label')
                                            [
                                            'prompt'=>'* Quận/Huyện',
                                            
                                            ]    // options
                                            )->label(false) ?>
                                        </div>
                                        <div class="street">
                                            <?php echo $form->field($user, 'street',['template' => '{input}'])
                                            ->textInput(['autocomplete' => 'off', 'placeholder'=> 'Số nhà, Thôn/Xóm, Ấp/Xã, Phường, Đường'])->label(false) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="float:right; padding: 10px">
                                <?= Html::submitButton('Cập nhập', ['name' => 'submit', 'class' => 'btn btn-sm btn-danger']) ?>
                            </div>
                            <?php ActiveForm::end(); ?>
                        </div>
                        </div><!-- /.box-body -->
                        
                    </div>
                </div>
                <!-- /tabs -->
            </div>
        </div>
    </div>
</div>
<?php echo $this->registerJsFile('@web/js/user.js');?>