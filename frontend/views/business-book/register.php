<?php

use yii\widgets\ActiveForm;
use frontend\widgets\AuthChoiceCustom;
use yii\jui\DatePicker;
use yii\helpers\ArrayHelper;
use common\models\Province;
?>
<div id="main" style="margin-left: 240px;">
    <div id="container" class="container"> 
        <div id="register">
            <center><h1>Tạo tài khoản</h1></center>
            <?php
            $form = ActiveForm::begin([
                        'options' => ['class' => 'form-register'],
                        'fieldConfig' => [
                            'options' => ['class' => 'form-group row'],
                        ],
            ]);
            ?>
            <?php echo $form->field($model, 'name', ['template' => '{input}{error}'])->textInput(array('placeholder' => 'Nhập tên')); ?>
            <?php echo $form->field($model, 'email', ['template' => '{input}{error}'])->textInput(array('placeholder' => 'Nhập email')); ?>
            <?php echo $form->field($model, 'phone', ['template' => '{input}{error}'])->textInput(array('placeholder' => 'Nhập số điện thoại')); ?>
            <?php echo $form->field($model, 'password', ['template' => '{input}{error}'])->passwordInput(array('placeholder' => 'Nhập mật khẩu')); ?>
            <?php echo $form->field($model, 'password_repeat', ['template' => '{input}{error}'])->passwordInput(array('placeholder' => 'Nhập lại mật khẩu')); ?>

         <!--   <p>Tạo tài khoản bạn đã đồng ý với điều khoản điều kiện của chúng tôi <a href="#" data-toggle="modal" data-target="#myModal" class="condition"><b>Điều khoản và Điều kiện</a></b>.</p>
         -->  
         <button class="form-control" type="submit" class="registerbtn">Đăng ký</button>

            <?php ActiveForm::end(); ?>  
        </div>
    </div>
</div>

  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <p>Some text in the modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

