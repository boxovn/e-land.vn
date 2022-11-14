<?php
use yii\widgets\ActiveForm;
use common\models\District;
use common\models\Province;
use yii\helpers\ArrayHelper;
use common\models\ApartmentCategory;
use common\models\Ward;
use backend\widgets\Alert;
use common\models\Street;
use common\models\BuildingProjectInfo;


$this->title = 'Thông tin';
?>
		<!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Thông tin user
                    <small></small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-home"></i> Trang chủ</a></li>
                    <li class="active">Thông tin user</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
				    <div class="col-md-12">
					    <!-- general form elements -->
					    <!-- form start -->
					    <?php echo Alert::widget() ?>
					        <div class="box box-primary">
						        <div class="box-header with-border">
						            <h3 class="box-title">Thông tin user</h3>
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
									              	<?php echo $user->username; ?>
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
									              	<?php echo $user->email; ?>
									            </div>
							                </div>
							            </div>
							        </div> 
							        <hr>
					                <div class="row">
							            <div class="col-md-12">
							              	<div class="form-group">
							                    <div class="col-md-4">
									              	<label>Loại</label>
									            </div>  
									            <div class="col-md-8">  
									              	<?php echo $user->is_admin == 1 ? 'Admin' : 'Người dùng'; ?>
									            </div>
							                </div>
							            </div>
							        </div>
							        <hr>
							        <div class="row">
							            <div class="col-md-12">
							              	<div class="form-group">
							                    <div class="col-md-4">
									              	<label>Ngày tạo</label>
									            </div>  
									            <div class="col-md-8">  
									              	<?php echo $user->created; ?>
									            </div>
							                </div>
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
        
        <script src="<?php echo yii::$app->urlManager->baseUrl?>/theme/common/js/common.js"></script>
        <script type="text/javascript">
        $(document).ready(function(){
        	$('.bxslider').bxSlider({
        		  auto: true,
        		  //autoControls: true,
        		  //adaptiveHeight: true,
        		  //mode: 'fade',
        		  pagerCustom: '#bx-pager'
        		});
        });	
		</script>             