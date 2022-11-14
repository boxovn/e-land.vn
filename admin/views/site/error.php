<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
		<div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Thông báo
                    <small></small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-home"></i> Trang chủ</a></li>
                    <li class="active">Thông báo</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
				    <div class="col-md-12">
				    	<div class="site-error">

						    <h3><?= Html::encode($this->title) ?></h3>
						
						    <div class="alert alert-danger">
						        <?= nl2br(Html::encode('Đã xảy ra lỗi trong hệ thống ! Vui lòng liên hệ với Admin.')) ?>
						    </div>
						</div>
				    </div>
				</div>
			</section>	
		</div>