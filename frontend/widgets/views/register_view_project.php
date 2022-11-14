<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>
<?php  $this->registerCSSFile('@web/css/register-view-house.css',['position' => \yii\web\View::POS_HEAD]);?>
<?php $this->registerJsFile(Yii::$app->request->baseUrl.'/e-land/js/register_view_project.js',['position' => \yii\web\View::POS_END]); ?>
<?php $this->registerCSSFile(Yii::$app->request->baseUrl . '/plugins/datetimepicker-master/jquery.datetimepicker.css',['position' => \yii\web\View::POS_HEAD]); ?>
<?php $this->registerJsFile(Yii::$app->request->baseUrl.'/plugins/datetimepicker-master/jquery.datetimepicker.full.js',['position' => \yii\web\View::POS_END]); ?>
<?php $this->registerJsFile(Yii::$app->request->baseUrl.'/plugins/datetimepicker-master/script.datetimepicker.js',['position' => \yii\web\View::POS_END]); ?>
<div class="widget widget-register">
     <h6 class="widget-title widget-title">Đăng ký dự án</h6> 
     <div class="widget-content">
                                    <form 
                                                                                                                                
                                                                                                                                method = 'post'
                                                                                                                                action ='<?php echo Url::to(['article/article-booking'], true);?>'
                                                                                                                                id = 'register-view-form'
                                                                                                                                enctype = 'multipart/form-data'
                                                                                                                                class="row g-3 needs-validation mt-3" novalidate>
                                                                                                                                <div style="display:none">
                                                                                                                                                <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>">
                                                                                                                                    </div>

                                        <div class="col-md-12">
                                                    <div class="input-group has-validation mb-1">
                                                                <span class="input-group-text" id="inputGroupPrependName"><i class="far fa-user"></i></span>
                                                                <input type="text" id="articlebooking-name" class="form-control" autocomplete="off" name="ArticleBooking[name]" placeholder="* Nhập họ tên"  aria-describedby="inputGroupPrependName validationServerNameFeedback" required>
                                                                    <div id="validationServerNameFeedback" class="invalid-feedback">
                                                                        Tên đang để trống
                                                                    </div>
                                                    </div>
                                        </div>
                                        <div class="col-md-12">
                                                    <div class="input-group has-validation mb-1">
                                                                    <span class="input-group-text" id="inputGroupPrependPhone"><i class="fas fa-phone"></i></span>
                                                                    <input type="text" id="articlebooking-phone" class="form-control" autocomplete="off" name="ArticleBooking[phone]" placeholder="*Nhập số điện thoại" aria-describedby="inputGroupPrependPhone validationServerPhoneFeedback" required>
                                                                        <div id="validationServerPhoneFeedback" class="invalid-feedback">
                                                                            Số điện thoại đang để trống
                                                                        </div>
                                                    </div>
                                        </div>

                                        <div class="col-md-12">
                                                    <div class="input-group has-validation mb-1">
                                                        <span class="input-group-text" id="inputGroupEmail"><i class="far fa-envelope"></i></span>
                                                        <input type="text" id="articlebooking-email" class="form-control"  autocomplete="off" name="ArticleBooking[email]" placeholder="*Nhập email"  aria-describedby="inputGroupEmail validationServerEmailFeedback" required>
                                                            <div id="validationServerEmailFeedback" class="invalid-feedback">
                                                                Email đang để trống
                                                            </div>
                                                    </div>
                                        </div>
                                        <div class="col-md-12">
                                                    <div class="input-group has-validation mb-1">
                                                        <span class="input-group-text" id="inputGroupDate"> <i class="far fa-calendar"></i></span>
                                                        <input type="text" id="articlebooking-date" class="datetimepicker form-control" autocomplete="off" name="ArticleBooking[date]" placeholder="*Nhập ngày giờ muốn xem" aria-describedby="inputGroupDate validationServerDateFeedback" required>
                                                            <div id="validationServerDateFeedback" class="invalid-feedback">
                                                                Ngày đi xem đang để trống
                                                            </div>
                                                    </div>
                                        </div>

                                        <div class="col-md-12">
                                                    <div class="input-group has-validation mb-3">
                                                        <textarea id="articlebooking-content" class="form-control" autocomplete="off" name="ArticleBooking[content]" rows="2" cols="5" placeholder="Vui lòng nhập thông tin cần hỗ trợ tư vấn" aria-describedby="validationServerContentFeedback" required></textarea>
                                                            <div id="validationServerContentFeedback" class="invalid-feedback">
                                                                        Nội dung cần hỗ trợ tư vấn
                                                            </div>
                                            </div>                     
                                            <div class="col-12">
                                            <button class="btn btn-block btn-register" type="submit"><i class="fas fa-lg fa-house-user"></i> Đăng ký</button>
                                        </div>
                                </form>
    </div>
</div>
 