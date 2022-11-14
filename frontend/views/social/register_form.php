<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use common\models\Province;
use  yii\helpers\ArrayHelper;
?>

<!-- content -->   
<div class="content-wrapper">
    <!-- top-content -->
    <div id="top-content">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="h1-title" title="" >ĐĂNG KÝ</h1>
                </div>
                <div class="col-sm-6 text-right  ">
                    <span class="link-top"><a href="<?php echo yii::$app->urlManager->createUrl(['index']) ?>" >HOME </a></span>/<span class="link-top">ĐĂNG KÝ</span>
                </div>
            </div>
            
        </div>
    </div>
    <!-- top-content  --> 
    <!-- part1 -->
    <?php
                $date = array();
                $date[' '] = 'Ngày';
                for ($i = 1; $i <= 31; $i++) {
                    $date[$i] = $i;
                }
                
                $month = array();
                $month[' '] = 'Tháng';
                for ($i = 1; $i <= 12; $i++) {
                    $month[$i] = $i;
                }
                
                $year = array();
                $year[' '] = 'Năm';
                for ($i = date('Y'); $i >= (date('Y') - 100); $i--) {
                    $year[$i] = $i;
                }
    ?>
    <style type="text/css">
                        .field-socialregisterform-date{
                            width: 30%;
                            float: left;
                            margin-right: 5px;
                        }
                         .field-socialregisterform-month{
                            width: 30%;
                            float: left;
                               margin-right: 5px;
                        }
                         .field-socialregisterform-year{
                            width: 35%;
                            float: left;
                        }
                        label[for="socialregisterform-date"]{
                            margin-bottom: 0px;
                        }
                    </style>
    <div class="container">
	<div class="col-lg-3 col-md-3 hidden-sm hidden-xs"></div>
	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <h2 class="h2-tietle"><?php echo  Yii::t('common','title_register');?></h2>
        <?php $form = ActiveForm::begin(['options' => ['class' => 'form-sign-up']]); ?>
            <?php echo $form->field($model, 'name', ['template' => '{label}{input}'])->textInput(array('placeholder' => \Yii::t('common', 'name'))); ?>
            <?php echo $form->field($model, 'email', ['template' => '{label}{input}'])->textInput(array('placeholder' => \Yii::t('common', 'email_address')))->label('Email (<a style="font-size: small; color:#000; font-weight: normal;"> Vui lòng nhập chính xác địa chỉ email để kích hoạt tài khoản học </a>)'); ?>
            <?php echo $form->field($model, 'date',['template' => '{label}{input}'])->dropDownList($date)->label('Ngày sinh'); ?>
            <?php echo $form->field($model, 'month',['template' => '{label}{input}'])->dropDownList($month)->label(''); ?>
            <?php echo $form->field($model, 'year',['template' => '{label}{input}'])->dropDownList($year)->label(''); ?>
            <?php echo $form->field($model, 'skype', ['template' => '{label}{input}'])->textInput(array('placeholder' => \Yii::t('common', 'skype')))->label('Skype <span style="font-size: small; color:#000; font-weight: normal;">Bạn phải có tài khoản Skype mới tham gia lớp học được</span> (<a href="/huong-dan-su-dung-skype" style="font-size: small; color:#000; font-weight: normal;"> Xem hướng dẫn dử dụng Skype </a>)'); ?>
            <?php echo $form->field($model, 'phone', ['template' => '{label}{input}'])->textInput(array('placeholder' => \Yii::t('common', 'phone')))->label('Số điện thoại (<a style="font-size: small; color:#000; font-weight: normal;"> Nhập số điện thoại của bạn để được tư vấn tốt nhất </a>)'); ?>
			<?php echo $form->field($model, 'province_id', ['template' => '{label}{input}'])->dropDownList(ArrayHelper::map(Province::find()->all(), 'province_id', 'name'))->label('Khu vực'); ?>
            <?php echo $form->field($model, 'age_group', ['template' => '{label}{input}'])->dropDownList(array(1 =>'Người lớn',2=>'Trẻ em'))->label('Nhóm tuổi (<a style="font-size: small; color:#000; font-weight: normal;"> Cho E-space biết nhóm tuổi của bạn để có thể phục vụ bạn tốt hơn</a>)'); ?>
            <?php // echo $form->field($model, 'invited_student', ['template' => '{label}{input}'])->textInput(array('placeholder' => 'Nhập mã cộng tác viên'))->label('Mã cộng tác viên (<a style="font-size: small; color:#000; font-weight: normal;">Để trống nếu không có Mã CTV</a>)'); ?>
            <?php echo $form->field($model, 'survey', ['template' => '{label}{input}'])->checkboxList(\common\models\Student::listSurvey())->label('Bạn biết đến cunghoctiengnhat.com từ nguồn nào?'); ?>
            <?php echo $form->errorSummary($model, ['class' => 'alert text-left alert-danger ', 'header' => '']) ?>
        <button type="submit" class="btn btn-default link-nhap">ĐĂNG KÝ!</button>
        <p class="text"></p>
        <?php ActiveForm::end(); ?>
		</div>
		<div class="col-lg-3 col-md-3 hidden-sm hidden-xs">
		</div>
    </div>
    <!-- part1 -->  
    
    
</div>
<!-- content  -->   



