<?php

use yii\helpers\Html;
use  yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model common\models\Note */

$this->title =  $model->employee->name;
$this->params['breadcrumbs'][] = ['label' => 'Notes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->employee->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<script>
	window.deleteImageUrl = '<?php echo Url::to(['note/delete-image',true]);?>';
     window.dropzoneImage = JSON.parse('<?php echo json_encode($dropzoneImage);?>');
</script>
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

    <?= $this->render('_form', [
        'model' => $model,
        'employees' => $employees,
		'dropzoneImage' => $dropzoneImage,
    ]) ?>

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
	