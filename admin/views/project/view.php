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
$this->title = 'Thông tin dự án';
?>
<style>
#bx-pager {
    text-align: center;
    margin-top: -30px;
}

#bx-pager a img {
    padding: 3px;
    border: solid #ccc 1px;
    width: 50px;
    height: 50px;
}

#bx-pager a.active img {
    border: solid #5280DD 1px;
}

.bx-wrapper,
.bx-viewport {
    min-height: 420px !important;
}
</style>
<link href="<?php echo yii::$app->urlManager->baseUrl?>/theme/plugins/jquery.bxslider/jquery.bxslider.min.css"
    rel="stylesheet">
<script src="<?php echo yii::$app->urlManager->baseUrl?>/theme/plugins/jquery.bxslider/jquery.bxslider.min.js"></script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Thông tin dự án
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-home"></i> Trang chủ</a></li>
            <li class="active">Thông tin dự án</li>
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
                        <h3 class="box-title">Thông tin dự án</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="col-md-4">
                                        <label>Tên</label>
                                    </div>
                                    <div class="col-md-8">
                                        <?php echo $infos->name; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="col-md-4">
                                        <label>Tổng quan</label>
                                    </div>
                                    <div class="col-md-8">
                                        <?php echo $infos->overview; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="col-md-4">
                                        <label>Tiện ích bên trong</label>
                                    </div>
                                    <div class="col-md-8">
                                        <?php 
													foreach ($seviceData as $item) {					            	
												    ?>
                                        <label class="control-label" for="inputSuccess" style="font-weight: 500;">
                                            <i class="fa fa-check"></i> <?php echo $item['name'];?>
                                        </label><br />
                                        <?php 
													}
												    ?>
                                    </div>
                                </div>
                            </div>
                        </div><br />

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="col-md-4">
                                        <label>Mô tả</label>
                                    </div>
                                    <div class="col-md-8">
                                        <?php echo $infos->internal_service; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="col-md-4">
                                        <label>Tiện ích bên ngoài</label>
                                    </div>
                                    <div class="col-md-8">
                                        <?php echo $infos->external_service; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="col-md-4">
                                        <label>Chủ đầu tư</label>
                                    </div>
                                    <div class="col-md-8">
                                        <?php echo $infos->investor; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="col-md-4">
                                        <label>Giá mở bán</label>
                                    </div>
                                    <div class="col-md-8">
                                        <?php echo number_format(!empty($infos->ogirinal_price_from)?$infos->ogirinal_price_from:0).
												    ' - '.number_format(!empty($infos->ogirinal_price_to)?$infos->ogirinal_price_to:0)
									              	.' '.$infos->currency_unit; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="col-md-4">
                                        <label>Giá thị trường</label>
                                    </div>
                                    <div class="col-md-8">
                                        <?php echo number_format(!empty($infos->market_price_from)?$infos->market_price_from:0)
									              	.' - '.number_format(!empty($infos->market_price_to)?$infos->market_price_to:0)
									              	.' '.$infos->currency_unit; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="col-md-4">
                                        <label>Giá thuê</label>
                                    </div>
                                    <div class="col-md-8">
                                        <?php echo number_format(!empty($infos->hire_price_from)?$infos->hire_price_from:0)
									              	.' - '.number_format(!empty($infos->hire_price_to)?$infos->hire_price_to:0)
									              	.' '.$infos->currency_unit; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="col-md-4">
                                        <label>Phân loại chung cư</label>
                                    </div>
                                    <div class="col-md-8">
                                        <?php echo $apartmentCatalog->name; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="col-md-4">
                                        <label>Địa chỉ</label>
                                    </div>
                                    <div class="col-md-8">
                                        <?php echo $infos->address; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="col-md-4">
                                        <label>Tỉnh/Thành phố</label>
                                    </div>
                                    <div class="col-md-8">
                                        <?php echo isset($province->name)?$province->name:''; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="col-md-4">
                                        <label>Quận/Huyện</label>
                                    </div>
                                    <div class="col-md-8">
                                        <?php echo isset($district->name)?$district->name:''; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="col-md-4">
                                        <label>Phường/Xã</label>
                                    </div>
                                    <div class="col-md-8">
                                        <?php echo isset($ward->name)?$ward->name:''; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="col-md-4">
                                        <label>Đường</label>
                                    </div>
                                    <div class="col-md-8">
                                        <?php echo isset($street->name)?$street->name:''; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="col-md-4">
                                        <label>Email</label>
                                    </div>
                                    <div class="col-md-8">
                                        <?php echo $infos->email; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="col-md-4">
                                        <label>Điện thoại</label>
                                    </div>
                                    <div class="col-md-8">
                                        <?php echo $infos->phone; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="col-md-4">
                                        <label>Website</label>
                                    </div>
                                    <div class="col-md-8">
                                        <?php echo $infos->website; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="col-md-4">
                                        <label>Lng</label>
                                    </div>
                                    <div class="col-md-8">
                                        <?php echo $infos->lat; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="col-md-4">
                                        <label>Lat</label>
                                    </div>
                                    <div class="col-md-8">
                                        <?php echo $infos->lng; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="col-md-4">
                                        <label>Hình ảnh</label>
                                    </div>
                                    <div class="col-md-8"></div>
                                </div>
                            </div>
                        </div>

                        <?php if(count($imageData) > 0) { ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <ul class="bxslider">
                                            <?php 
													         $baseUrl =Yii::$app->params['url-building-project-medium-square-image'];
													        foreach ($imageData as $item) {					            	
												        ?>
                                            <li><img src="<?php echo $baseUrl.$item['url']?>" /></li>
                                            <?php 
															}
												       	?>
                                        </ul>
                                        <div id="bx-pager" style="text-align: center;">
                                            <?php 
													       $baseUrl =Yii::$app->params['url-building-project-small-square-image'];
													        $i=0;
												           	foreach ($imageData as $item) {					            	
												        ?>
                                            <a data-slide-index="<?php echo $i?>" href="">
                                                <img src="<?php echo $baseUrl.$item['url']?>" />
                                            </a>
                                            <?php 
																$i++;
												            }
												       	?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>


                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <form id="search-form-data"
                                    action="<?php echo yii::$app->urlManager->baseUrl?>/index.php?r=building-project-info%2Fchecked"
                                    method="post">
                                    <div class="form-group" style="padding-top: 40px;">
                                        <div class="col-md-3">
                                            <label>Trạng thái tin</label>
                                        </div>
                                        <div class="col-md-3">
                                            <select class="form-control" name="status">
                                                <?php  
								              				$dataStatus = BuildingProjectInfo::listingCheckedStatus(); 
								              				foreach ($dataStatus as $key=>$val) {
								              					if ($key == $infos->checked_status)
								              						echo '<option selected="selected" value="'.$key.'">'.$val.'</option>';
								              					else 
								              						echo '<option value="'.$key.'">'.$val.'</option>';
								              				}
								              			?>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="hidden" name="pageBack" value="<?php echo $pageBack; ?>">
                                            <input type="hidden" name="id" value="<?php echo $infos->id; ?>">
                                            <button type="submit" class="btn btn-success">Lưu</button>
                                        </div>
                                    </div>
                                </form>
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
$(document).ready(function() {
    $('.bxslider').bxSlider({
        auto: true,
        //autoControls: true,
        //adaptiveHeight: true,
        //mode: 'fade',
        pagerCustom: '#bx-pager'
    });
});
</script>