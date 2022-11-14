<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
/* @var $this yii\web\View */
/* @var $model common\models\HouseSurvey */

$this->title = 'Thêm thông tin khảo sát';
$this->params['breadcrumbs'][] = ['label' => 'Nguồn nhà', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Danh sách khảo sát', 'url' => ['house/survey']];
$this->params['breadcrumbs'][] = $this->title;
?>
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
    'links' =>isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]);
      ?>
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
                    <small>Đầu chủ <span class="label label-warning"><?php echo isset($house->user)?$house->user->name:'';?></span> <cite title="Source Title"><?php echo date('d/m/Y',strtotime($house->created));?></cite></small>
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

  

    <?= $this->render('_survey_form', [
        'model' => $model,
        'users' => $users,
     
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

