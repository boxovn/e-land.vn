<?php
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\ApartmentCategory;
use backend\widgets\Alert;
use common\models\Admin;


$this->title = 'Cập nhật thông tin ';
?>

		<!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Cập nhật thông tin
                    <small></small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-home"></i> Trang chủ</a></li>
                    <li class="active">Cập nhật thông tin</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
				    <div class="col-md-12">
					    <!-- general form elements -->
					    <!-- form start -->
					    <?php echo Alert::widget() ?>
					    <?php $form = ActiveForm::begin(['method' => 'post']) ?>
					        <div class="box box-primary">
						        <div class="box-header with-border">
						            <h3 class="box-title">Thêm user</h3>
						        </div>
						        <!-- /.box-header -->
					            <div class="box-body">
					            	 
					                <div class="row">
							            <div class="col-md-12">
							              	<div class="form-group">
							                    <div class="col-md-4">
									              	<label>Tên đăng nhập</label>
									            </div>  
									            <div class="col-md-8">  
									              	<?php echo $model->username; ?>
									            </div>
							                </div>
							            </div>
							        </div> 
							        <hr>
					                <div class="row">
							            <div class="col-md-12">
							              	<div class="form-group">
							                    <div class="col-md-4">
									              	<label>Email</label>
									            </div>  
									            <div class="col-md-8">  
									              	<?php echo $model->email; ?>
									            </div>
							                </div>
							            </div>
							        </div>
							        <hr>
							        <div class="form-group">
					                    <?php echo $form->field($model, 'new_password')->passwordInput(); ?>	
					                </div>
					                <div class="form-group">
					                    <?php echo $form->field($model, 'repeat_password')->passwordInput(); ?>	
					                </div>
					                
					                
					            </div>
					            <!-- /.box-body -->
						    </div>
						    <!-- /.box -->
						    
						    <div style="padding-bottom: 100px; text-align: center;">
						        <button type="submit" class="btn btn-primary">Lưu thông tin</button>
					        </div>
						<?php ActiveForm::end(); ?>  
					</div>
					
				</div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        
        <script type="text/javascript">
        $(document).ready(function() {

              
        });	
		</script>             