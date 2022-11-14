<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model common\models\Partner */
$this->title = 'Khởi tạo đối tác';
$this->params['breadcrumbs'][] = ['label' => 'Partners', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?=$this->title;?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-home"></i> Trang chủ</a></li>
            <li class="active"> <?=$this->title;?></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Thêm</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive">
							<?php
        foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
            echo '<div style="text-align:center;"  class="alert alert-' . $key . '">' . $message . '</div>';
        }
        ?>
                        <div class="partner-form">
                            <?php
                                $form = ActiveForm::begin();
                                ?>
                            <?php echo $form->field($model, 'email')->textInput(array('placeholder' => 'Nhập email')); ?>
                            <?= Html::submitButton('Thêm', ['class' => 'btn btn-success']) ?>
							
                            <?php ActiveForm::end(); ?>
                        </div>

                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->