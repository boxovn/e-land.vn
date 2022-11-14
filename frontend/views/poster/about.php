<?php
use  yii\helpers\Url;
use yii\widgets\LinkPager;
use common\models\BuildingProjectInfo;
use yii\widgets\ActiveForm;
use frontend\widgets\AuthChoiceCustom;
use yii\helpers\Html;
use common\libraries\PseudoCrypt;
use frontend\widgets\HeaderPosterDetail;
?>
<?php echo HeaderPosterDetail::widget();?>
<style>
.list-box .box {
    background-color: #fff;
    border-radius: 8px;
    border: 1px solid #dadce0;
    box-sizing: border-box;
    overflow: hidden;
    width: 100%;
    padding: 30px;
    margin-bottom: 30px;
}

.poster_avatar {
    position: relative;
    margin-left: 15px;
    margin-right: 15px;
    display: inline-block;
    float: left;
}

.img-avatar {
    border: 1px solid #eee;
    width: 60px;
    height: 60px;
    border-radius: 100%;
    float: left;
    padding: 2px;
}
</style>
<div class="body">
    <div id="container">
        <div class="tab-content">
            <div id="list-box" class="list-box">
                <!-- tabs -->

                <div class="row">
                    <div class="col col-md-9">
                        

                       
                            <center>
                            <h3 class="box-title">Thông tin người rao bán</h3>
                            <p>Thôn tin cơ bản như hình ảnh, tên, thông tin liên hệ, mô tả... Giúp khách hàng có thể liên hệ trao đổi với người bán.
                            </p>
                        </center>
                        <div class="panel-body">
                            <div class="box">
                                <h3 class="box-title">Giới thiệu</h3>
                                <div class="col-md-2">
                                    <div class="poster_avatar">
                                        <?php if($poster->image_manager_id){ ?>
                                        <img id="notifi_<?php echo $poster->id;?>" class="img-avatar"
                                            src="<?=\Yii::$app->imagemanager->getImagePath($poster->image_manager_id, 300, 300)?>"
                                            alt="<?=$poster->name?>">
                                        <?php }else{ ?>
                                        <img class="img-avatar" id="notifi_<?php echo $poster->id;?>"
                                            src="<?php echo Url::to('@web/images/no-image100x100.png', true); ?>"
                                            alt="<?php echo $poster->name; ?>" />

                                        <?php }?>
                                        <label for="headAvatar" class="avatar-overlay">
                                            <i class="fa fa-camera" aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <?php echo $poster->about?$poster->about:'Hiện tại người dùng này chưa có mô tả ';?>
                                </div>
                            </div>
                            <div class="box">
                                <h3 class="box-title">Thông tin cơ bản</h3>
                                <div><label>Họ và Tên</label></div>
                                <div>
                                    <?php echo $poster->name;?>
                                </div>
                                <div><label>Ngày sinh</label></div>
                                <div>
                                    <?php echo strtotime($poster->birthday)? date('d/m/Y',strtotime($poster->birthday)):'';?>
                                </div>
                                <div><label>Giới tính</label></div>
                                <div>
                                    <?php echo $poster->sex? 'Nam': 'Nữ';?>
                                </div>
                            </div>
                            <div class="box">
                                <h3 class="box-title">Thông tin liên hệ</h3>

                                <div><label>Điện thoại</label></div>
                                <div><?php echo $poster->phone;?>
                                </div>
                                <div><label>Email</label></div>
                                <div>
                                    <?php echo $poster->email;?>
                                </div>
                                <div><label>Địa chỉ</label></div>
                                <div>
                                    <div class="col-sm-12 address nopadding">
                                        <div class="col-sm-12 nopadding">
                                            <div class="province">
                                                <?php echo isset($poster->province)?$poster->province->name:'';?>
                                            </div>
                                            <div class="district">
                                                <?php echo isset($poster->district)?$poster->district->name:'';?>
                                            </div>
                                            <div class="street">
                                                <?php echo $poster->street?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                     
                    </div>
                </div>
                <!-- /tabs -->
            </div>
        </div>
    </div>
</div>
<?php echo $this->registerJsFile('@web/js/user.js');?>