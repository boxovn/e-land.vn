<?php
    
use yii\bootstrap\ActiveForm;
use frontend\widgets\Alert;
use yii\helpers\Html;
use common\models\Meta;

?>
   		<!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper">
                    <!-- Content Header (Page header) -->
                    <section class="content-header">
                        <h1>
                           Thêm người ký gửi
                            <small></small>
                        </h1>
                        <ol class="breadcrumb">
                            <li><a href="#"><i class="fa fa-home"></i> Trang chủ</a></li>
                            <li class="active">  Thêm người ký gửi</li>
                        </ol>
                    </section>

                    <!-- Main content -->
                    <section class="content">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- general form elements -->
                                <!-- form start -->
								<div class="box box-warning">
                <div class="box-header with-border">
                  <h3 class="box-title"> Thêm người ký gửi</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                                <?php
                                $form = ActiveForm::begin([
                                            'layout' => 'horizontal',
                                            'fieldConfig' => [
                                                'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
                                                'horizontalCssClasses' => [
                                                    'label' => 'col-sm-2',
                                                    //'offset' => 'col-sm-offset-4',
                                                    'wrapper' => 'col-sm-8 col-md-8',
                                                    'error' => '',
                                                    'hint' => '',
                                                ],
                                            ],
                                ]);
                                ?>
                                <?php echo $form->field($model, 'name')->textInput(); ?>
                               
                                <?php echo $form->field($model, 'phone')->textInput(); ?>
								 <?php echo $form->field($model, 'address')->textInput(); ?>
								  <?php echo $form->field($model, 'price')->textInput(); ?>
								   <?php echo $form->field($model, 'unit')->textInput(); ?>
								    <?php echo $form->field($model, 'area')->textInput(); ?>
									 <?php echo $form->field($model, 'home')->textInput(); ?>
									  <?php echo $form->field($model, 'direction')->textInput(); ?>
									   <?php echo $form->field($model, 'alley')->textInput(); ?>
									  
										<?php echo $form->field($model, 'deposit_date')->widget(\yii\jui\DatePicker::classname(), [
											'language' => 'vi',
											'dateFormat' => 'yyyy-MM-dd',
											'options' => ['class' => 'form-control', 'style' => 'z-index: 9999'],
										]) ?>
										 <?php echo $form->field($model, 'sub_district')->textInput(); ?>
										 <?php echo $form->field($model, 'street')->textInput(); ?>
										  <?php echo $form->field($model, 'owner')->textInput(); ?>
										   <?php echo $form->field($model, 'status')->dropDownList([0 => 'Chưa bán', 1 => 'Đã bán' ]); ?>
										     
											     <?php echo $form->field($model, 'note')->textArea()->label('') ?>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button class="btn btn-primary" type="submit">Lưu lại</button>
                                    </div>
                                </div>

                                <?php ActiveForm::end(); ?>
                            </div>

                        </div>
						    </div>
							    </div>
                    </section>
                    <!-- /.content -->
                </div>
                <!-- /.content-wrapper -->
