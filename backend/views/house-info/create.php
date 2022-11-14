<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\NoteInfo */

$this->title = 'Thêm sản phẩm';
$this->params['breadcrumbs'][] = ['label' => 'Note Infos', 'url' => ['index']];
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
   

    <?= $this->render('_form', [
        'model' => $model,
         'types' => $types,
            'provinces' =>  $provinces,
            'districts' => $districts, 
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

