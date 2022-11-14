<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
/* @var $this yii\web\View */
/* @var $model common\models\Note */

$this->title = 'Thêm nguồn nhà';
$this->params['breadcrumbs'][] = ['label' => 'Nguồn nhà', 'url' => ['index']];
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
				                <h3 class="box-title">Thêm</h3>
							</div>
				            <!-- /.box-header -->
				            <div class="box-body table-responsive">
                            <?= $this->render('_form', [
                                'model' => $model,
                                'users' => $users,
                                'dropzoneImage' => 0,
                                 'articleTypes' =>  $articleTypes,
                                    'provinces' =>  $provinces,
                                    'districts'  => $districts 
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

