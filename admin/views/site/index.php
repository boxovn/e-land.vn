<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Breadcrumbs;
use yii\widgets\ActiveForm;
$this->title = 'Welcome';
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= Html::encode($this->title) ?>
        </h1>
        <?php 
					// $this is the view object currently being used
					echo Breadcrumbs::widget([
						'itemTemplate' => "<li><i>{link}</i></li>\n", // template for all links
						'links' => [
							[
								'label' => $this->title,
								'url' => ['house/index'],
							],
						],
					]);
                ?>
    </section>
    <section class="content">

        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle"
                            onerror="if (this.src != 'error.jpg') this.src ='<?php echo Yii::$app->params['url-page'];?>images/no-image200x200.png';"
                            width="128px" style="border:1px solid #ddd"
                            src="<?php echo Yii::$app->params['url-page'] . 'channels/avatar/' . $user->image;?>"
                            alt="User profile picture">

                        <h3 class="profile-username text-center"><?php echo $user->name;?></h3>

                        <p class="text-muted text-center">Software Engineer</p>

                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>Đối tác</b> <a class="pull-right"><?php echo count($user->partners);?> Người</a>
                            </li>
                            <li class="list-group-item">
                                <b>Kho nguồn nhà</b> <a class="pull-right"><?php echo count($user->houses);?> Căn</a>
                            </li>
                            <li class="list-group-item">
                                <b>Tin rao dự án</b> <a class="pull-right"><?php echo count($user->projects);?> Tin</a>
                            </li>
                            <li class="list-group-item">
                                <b>Tin rao (Mua bán, cho thuê)</b> <a
                                    class="pull-right"><?php echo count($user->articles);?> Tin</a>
                            </li>
                        </ul>
                        <a id="user-settings" href="#settings" class='btn btn-primary btn-block' data-toggle="tab"
                            aria-expanded="false"><b>Cài đặt thông tin cá nhân</b></a>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

                <!-- About Me Box -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Thông tin cá nhân</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <strong><i class="fa fa-envelope-o margin-r-5"></i> Email</strong>
                        <p class="text-muted">
                            <?php echo $user->email;?>
                        </p>
                        <hr>
                        <strong><i class="fa fa-map-marker margin-r-5"></i> Địa chỉ</strong>
                        <p class="text-muted"> <?php echo $user->address?$user->address:' Địa  chỉ của bạn';?></p>
                        <strong><i class="fa fa-phone margin-r-5"></i> Điện thoại</strong>
                        <p class="text-muted"> <?php echo $user->phone;?></p>
                        <hr>
                        <strong><i class="fa fa-pencil margin-r-5"></i> Khu vực bán (Khu vực đánh)</strong>
                        <p>
                            <span class="label label-danger">Quận 12</span>
                            <span class="label label-success">Quận 1</span>
                            <span class="label label-info">Quận tân phú</span>
                        </p>
                        <hr>
                        <strong><i class="fa fa-file-text-o margin-r-5"></i> Mô tả</strong>

                        <p><?php echo $user->about;?></p>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">

                        <li class="active"><a href="#settings" data-toggle="tab" aria-expanded="false">Thông tin cá
                                nhân</a>
                        </li>

                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="settings">
                            <?php $form = ActiveForm::begin(); ?>
                            <?= $form->field($user, 'name')->textInput(['maxlength' => true]) ?>
                            <?= $form->field($user, 'phone')->textInput(['maxlength' => true]) ?>
                            <?= $form->field($user, 'email')->textInput(['maxlength' => true]) ?>
                            <?= $form->field($user, 'address')->textInput(['maxlength' => true]) ?>
                            <?= $form->field($user, 'birthday')->textInput() ?>
                            <?= $form->field($user, 'sex')->dropDownList([0 => 'Nữ', 1 => 'Nam'],           // Flat array ('id'=>'label')
                                                [
                                                    'prompt'=>'* Giới tính',
                                                    
                                                ] ) ?>

                            <?php echo $form->field($user, 'province_id')
                                            ->dropDownList(
                                                $provinces,           // Flat array ('id'=>'label')
                                                [
                                                    'prompt'=>'* Tỉnh/Thành phố',
                                                    
                                                ]    // options
                                            )?>

                            <?php echo $form->field($user, 'district_id')
                                            ->dropDownList(
                                                $districts,           // Flat array ('id'=>'label')
                                                [
                                                    'prompt'=>'* Quận/Huyện',
                                                    'disabled' => ($user->district_id>0)?false:true,
                                                    
                                                ]    // options
                                            )?>

                            <?= $form->field($user, 'street')->textInput(['maxlength' => true]) ?>

                            <?= $form->field($user, 'about')->textarea(['rows' => 6]) ?>

                            <div class="form-group">
                                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                            </div>

                            <?php ActiveForm::end(); ?>
                        </div>

                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>

            <!-- /.col -->
        </div>
        <!-- /.row -->

    </section>
</div>
<!-- /.box -->

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script type="text/javascript">
/*tab*/
$(function() {
    var hash = window.location.hash;
    hash && $('ul li a[href="' + hash + '"]').tab('show');
    $('ul li a').click(function(e) {
        $(this).tab('show');
        window.location.hash = this.hash;
    });
    $('#user-settings').click(function(e) {
        $('ul li a[href="#settings"]').tab('show');
        window.location.hash = this.hash;
    });

});
/*end tab*/
</script>