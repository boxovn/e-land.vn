<?php

use yii\helpers\Html;
use  yii\helpers\Url;
use yii\widgets\Breadcrumbs;
/* @var $this yii\web\View */
/* @var $model common\models\Note */

$this->title = 'Sửa';
$this->params['breadcrumbs'][] = ['label' => 'Nguồn nhà của tôi', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->user->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
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
        <?php 

                        // $this is the view object currently being used
echo Breadcrumbs::widget([
    'itemTemplate' => "<li><i>{link}</i></li>\n", // template for all links
    'links' =>  isset($this->params['breadcrumbs'])?$this->params['breadcrumbs']:''
]);
                ?>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title"> <?=$this->title;?></h3>
                        <div class="no-margin pull-right">
                            <?= Html::a('Danh sách', ['index'], ['class' => 'btn btn-primary btn-sm']) ?>

                            <?= Html::a('Xóa', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger btn-sm',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive">

                        <?= $this->render('_form', [
                                'model' => $model,
                                'provinces' => $provinces,
                                'districts' => $districts,
                                'wards'  => $wards, 
                                'houseSegments' => $houseSegments,
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