 <?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
$this->title = 'Thêm dự án';
?>
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
     <!-- Content Header (Page header) -->
     <section class="content-header">
         <h1>
             Trang
             <small></small>
         </h1>
         <ol class="breadcrumb">
             <li><a href="#"><i class="fa fa-home"></i> Trang chủ</a></li>
             <li class="active">Tạo trang</li>
         </ol>
     </section>
     <!-- Main content -->
     <section class="content">
         <div class="nav-tabs-custom">
             <ul class="nav nav-tabs">
                 <li><a href="<?php echo  yii::$app->urlManager->createUrl(['project/index', 'id' => $model->id]);?>">
                         Dự án <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                 </li>
                 <li
                     <?php echo (Yii::$app->request->url==yii::$app->urlManager->createUrl(['project/project-section', 'id' => $model->id]))? 'class="active"':'';?>>
                     <a
                         href="<?php echo  yii::$app->urlManager->createUrl(['project/project-section', 'id' => $model->id]);?>">Chi
                         tiết <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                 </li>
                 <li
                     <?php echo (Yii::$app->request->url==yii::$app->urlManager->createUrl(['project/investor', 'id' => $model->id]))? 'class="active"':'';?>>
                     <a
                         href="<?php echo  yii::$app->urlManager->createUrl(['project/investor', 'id' => $model->id]);?>">Chủ
                         đầu tư <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                 </li>

                 <li class="active">
                     <a href="<?php echo  yii::$app->urlManager->createUrl(['project/contact', 'id' => $model->id]);?>">Thông
                         tin liên hệ <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                 </li>

             </ul>
             <div class="tab-content">

                 <!-- /.tab-pane -->

                 <div class="tab-pane active" id="owner_investment">


                     <div class="box box-primary">
                         <div class="box-header with-border">
                             <h3 class="box-title">Thông tin liên hệ</h3>
                         </div>
                         <!-- /.box-header -->
                         <div class="box-body">
                             <div class="row">
                                 <?php $form = ActiveForm::begin(); ?>

                                 <?= $form->field($projectContact, 'email')->textInput(['placeHolder' => 'Email','maxlength' => true]) ?>

                                 <?= $form->field($projectContact, 'phone')->textInput(['placeHolder' => 'Số điện thoại','maxlength' => true]) ?>

                                 <?= $form->field($projectContact, 'address')->textInput(['placeHolder' => 'Địa chỉ','maxlength' => true]) ?>

                                 <?= $form->field($projectContact, 'zalo')->textInput(['placeHolder' => 'Zalo cá nhân','maxlength' => true]) ?>

                                 <?= $form->field($projectContact, 'facebook')->textInput(['placeHolder' => 'Facbook cá nhân','maxlength' => true]) ?>

                                 <?= $form->field($projectContact, 'webiste')->textInput(['placeHolder' => 'Website','maxlength' => true]) ?>

                                 <?= $form->field($projectContact, 'description')->widget(\yii\redactor\widgets\Redactor::className())?>
                                 <div class="form-group">
                                     <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                                 </div>

                                 <?php ActiveForm::end(); ?>
                             </div>
                         </div>
                     </div>
                 </div>

                 <!-- /.tab-pane -->
             </div>
         </div>
     </section>
 </div>