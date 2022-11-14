<?php

use yii\helpers\Html;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model common\models\HouseSurvey */
$this->title = 'Thôn tin khảo sát';
$this->params['breadcrumbs'][] = ['label' => 'House Surveys', 'url' => ['index']];
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
              <h3 class="box-title">Nguồn nhà</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
                <blockquote>
                    <p> <?php 
                                    echo $house->description;
                        ?></p>
                    <small>Đầu chủ <span class="label label-warning"><?php echo $house->user->name;?></span> <cite title="Source Title"><?php echo date('d/m/Y',strtotime($house->created));?></cite></small>
                  </blockquote>
             <div class="box collapsed-box">
            <div class="box-header with-border">
              <h3 class="box-title">Mô tả</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
                <blockquote>
                    
                     <small><?php echo $house->content;?> <cite title="Source Title"><?php echo date('d/m/Y',strtotime($house->created));?></cite></small>
                  </blockquote>
            
            </div><!-- /.box-body -->
            
          </div><!-- /.box -->
            </div><!-- /.box-body -->
            
          </div><!-- /.box -->
				        <div class="box">
				            <div class="box-header with-border">
				                <h3 class="box-title">Thêm</h3>
							</div>
				            <!-- /.box-header -->
				            <div class="box-body table-responsive">

  <script>
    window.deleteImageUrl = '<?php echo Url::to(['note/delete-image',true]);?>';
     window.dropzoneImage = JSON.parse('<?php echo json_encode($dropzoneImage);?>');
     console.log(  window.dropzoneImage );
</script>

    <?= $this->render('_house_survey_form', [
        'model' => $model,
         'house' => $house,
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

