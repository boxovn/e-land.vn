<?php
use yii\bootstrap\ActiveForm;
use frontend\widgets\Alert;
use yii\helpers\Html;
use common\models\Category;
?>
<div class="content-wrapper">
                    <!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Thêm user
    <small></small>
                        </h1>
                        <ol class="breadcrumb">
                            <li><a href="#"><i class="fa fa-home"></i> Trang chủ</a></li>
                            <li class="active">Thêm user</li>
                        </ol>
                    </section>

                    <!-- Main content -->
                    <section class="content">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- general form elements -->
                                <!-- form start -->
                                <?php
                                $form = ActiveForm::begin([
                                            'layout' => 'horizontal',
                                            'fieldConfig' => [
                                                'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
                                                'horizontalCssClasses' => [
                                                    'label' => 'col-sm-2',
                                                    'wrapper' => 'col-sm-8 col-md-8',
                                                    'error' => '',
                                                    'hint' => '',
                                                ],
                                            ],
                                ]);
                                ?>
                                <?php echo $form->field($model, 'name')->textInput(); ?>
                                <?php echo $form->field($model, 'slug')->textInput(); ?>
                                <?php echo $form->field($model, 'sort')->textInput(); ?>
								<?php echo $form->field($model, 'status') ->dropDownList([1 => 'Hiển thị', 0 => 'Ẩn']);?>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button class="btn btn-primary" type="submit">Save</button>
                                    </div>
                                </div>

                                <?php ActiveForm::end(); ?>
                            </div>

                        </div>
                    </section>
                    <!-- /.content -->
                </div>
                <!-- /.content-wrapper -->