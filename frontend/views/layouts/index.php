<?php
//use Yii;
use yii\bootstrap\ActiveForm;
use common\models\ClassStudent;
use common\models\Exchange;
use common\models\Student;
use yii\helpers\Html;
use yii\web\Session;
use Firebase\JWT\JWT;
use common\libraries\CheckDevice;
use common\libraries\EncodeUrl;
	$session = Yii::$app->session;
	$detect = new CheckDevice;
?>
<?php  if($student->type_test==1 && $student->placementtest<1 && $student->student_id ==19108  /*$student->created >= '2019-02-19'*/  ){ ?>


<div id='thongbao' style="border: 1px solid #ddd; position: fixed; left:0px; bottom: 0px; z-index: 999; display: block; padding-right: 10px; background:#f9f9f9; ">
  
            <a class="btn btn-default" data-dismiss="modal" class="close" onclick="$('#thongbao').hide()"  style="position: absolute; right:0px; top: 0px; z-index: 999; display: block; margin-right: 10px; margin: 1px">Đóng</a>
            <a href="<?php echo yii::$app->urlManager->createUrl(['test-page/library']); ?>">
            <img style="width:350px; height:323px; " src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/images/kiem-tra-dau-vao.gif">
        </a>        
</div>
<?php }?>
<?php if(Yii::$app->controller->page=='page-student' && $student->new_version && !$detect->isMobile()){
             echo   frontend\widgets\BoxChatList::widget(); 
        }
       ?>
<?php if($session->has('popup') && $session['popup']['view']==0 && $session['popup']['content']){ ?>
<div class="modal fade" id="myModalMessage" role="dialog">
    <div class="modal-dialog" >
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <center><h4 class="modal-title" style="color: red;">THÔNG BÁO GÓI HỌC SẮP HẾT HẠN</h4></center>
            </div>
            <div class="modal-body" style="overflow: auto; height:80%">
				<?php foreach ($session['popup']['content'] as $key => $value){?>
								<div style="font-size:13px;">
                                    <span style="font-weight: bold">Gói học:</span>  <?php echo $value['special'] ? 'Giáo viên châu Âu' : 'Giáo viên châu Á' ?> <br/>
                                    <span style="font-weight: bold">Số tiết học:</span>  <?php echo $value['quantity'] ?> tiết<br/>
                                    <span style="font-weight: bold">Thời gian 1 tiết học:</span> <?php echo $value['each_time']; ?> phút/tiết học<br/>
                                    <span style="font-weight: bold">Thời gian kích hoạt:</span> <?php echo date('d-m-Y', strtotime($value['updated'])) ?><br/>
                                    <span style="font-weight: bold; color: red;">Thời gian hết hạn: <?php echo date('d-m-Y', strtotime($value['expiration'])) ?> (<?php echo $value['expiration_date'] ?> ngày, còn lại <?php echo floor((strtotime($value['expiration']) - strtotime(date('Y-m-d')))/86400) ?> ngày) </span> <br/>
                                    <span style="font-weight: bold">Số buổi chưa học:</span> <?php echo $value['total_quantity'] ? ($value['total_quantity'] . ' buổi') : '<span style="color:red">Đã hết</span>'; ?>
                                </div>
								<?php if($key!= count($session['popup']['content'])-1){ ?>
								 <hr/>
								<?php }?>
                               
				<?php }?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
				<button type="submit" class="btn gray-btn btn-common upercase" onclick="add_request()">Đóng và không nhắc lại </button>
				
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
 function add_request(){
	 
	$.ajax({
      type: "POST",
      url: "<?php echo yii::$app->urlManager->createUrl(['student/check-session']) ?>",
      data: {'view': 0},
      success: function(result){
		  // console.log(result);
		$('#myModalMessage').modal('hide');
      }
   });

   return false;
			
			  
}
$(document).ready(function(){
        
             $('#myModalMessage').modal('show').on('loaded.bs.modal', function() {
            $(this).find('.modal-dialog').css({
        'margin-top': function () {
            return (($(window).outerHeight() / 2) - ($(this).outerHeight() / 2));
        }
    });
});
    });
    </script>
<?php }  ?>
<?php if($session->has('popup') && isset($session['popup']['fees']) && $session['popup']['fees']==0){ ?>
<!--<div class="modal fade" id="myModalFees" role="dialog">
    <div class="modal-dialog" >
        <!-- Modal content
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <center><h4 class="modal-title" style="color: red;">THÔNG BÁO</h4></center>
            </div>
            <div class="modal-body" style="overflow: auto; height:80%; color:#2e6da4">
				<p>Nhằm nâng cao chất lượng giáo viên Native, E-SPACE thông báo điều chỉnh mức học phí niêm yết mới dành cho giáo viên bản ngữ (Anh, Mỹ, Úc). Mức học phí mới sẽ áp dụng cho học viên đăng ký mới kể từ ngày 1/10/2017. Đối với học viên cũ trước ngày 1/10/2017 E-SPACE vẫn áp dụng mức học phí cũ đến hết năm 2017.<br/>
				</p>
				<p> Mọi thắc mắc Học viên có thể liên hệ:<br/><b>Khu vực HCM: </b>0977-722-590 (ms Nguyen). <b><br/> Khu vực HN: </b> 097-884-3885(Ms.Loan)</p>
				<p>
					Trân trọng.
				</p>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
				<button type="submit" class="btn gray-btn btn-common upercase" onclick="add_request_fees()">Đóng và không nhắc lại </button>
				
            </div>
        </div>
    </div>
</div>-->
<script type="text/javascript">
function add_request_fees(){
	 $.ajax({
      type: "POST",
      url: "<?php echo yii::$app->urlManager->createUrl(['student/check-session-fees']) ?>",
      data: {'fees': 1},
      success: function(result){
		  console.log(result);
		$('#myModalFees').modal('hide');
      }
   });

   return false;
			
			  
}
 $(document).ready(function(){
        
             $('#myModalFees').modal('show').on('loaded.bs.modal', function() {
            $(this).find('.modal-dialog').css({
        'margin-top': function () {
            return (($(window).outerHeight() / 2) - ($(this).outerHeight() / 2));
        }
    });
});
    });
</script>
<?php }  ?>
<script>
    $(document).ready(function () {
         $("button[rel='open_ajax']:not(#colorbox div[rel='open_ajax'])").on('click', function() {
            $.colorbox({iframe: true, fixed:true ,width: "50%", height: "55%",
                href: $(this).attr('href'),
                onClosed: function() {
                    location.reload(true);
                }
            });
            return false;
        });
        
        $('.btn-show').click(function () {

            if ($('.profile-content').css('display') == 'none') {
                $('.btn-show').html('Ẩn thông tin cá nhân');
                $('.profile-content').show('slow');
            } else {
                $('.btn-show').html('Hiện  thông tin cá nhân');
                $('.profile-content').hide('slow');
            }
        });

    });
</script>

<style type="text/css">
	.lwc-chat-button{
		z-index:1;
	}
	.skype-button + .tooltip > .tooltip-inner {
		background-color: #00AFF0;
	} 
    .SkypeButton_Call{
                                                    margin:0;
                                                 
                                                }
                                                .SkypeButton_Call img {
                                                    margin:0 !important;
                                                    vertical-align:middle !important;
                                                }
                                                 .SkypeButton_Call p{
                                                    margin:0 !important;
                                                }
</style>
<style type="text/css">
    .cancel-tooltip + .tooltip > .tooltip-inner {background-color: #d9534f;} 
    .cancel-tooltip + .tooltip > .tooltip-arrow {border-bottom-color: #d9534f;}
</style>
<style type="text/css">
    .rate-tooltip + .tooltip > .tooltip-inner {background-color: #5bc0de;} 
    .rate-tooltip + .tooltip > .tooltip-arrow {border-bottom-color: #5bc0de;}
</style>
<style type="text/css">
    .join-tooltip + .tooltip > .tooltip-inner {background-color: #337ab7;} 
    .join-tooltip + .tooltip > .tooltip-arrow {border-bottom-color: #337ab7;}
</style>
<style type="text/css">
    .view-tooltip + .tooltip > .tooltip-inner {background-color: #4cae4c;} 
    .view-tooltip + .tooltip > .tooltip-arrow {border-bottom-color: #4cae4c;}
</style>
<style type="text/css">
    .booking-tooltip + .tooltip > .tooltip-inner {background-color: blue;} 
    .booking-tooltip + .tooltip > .tooltip-arrow {border-bottom-color: blue;}
</style>
<!-- content -->   
<div class="content-wrapper">
    <!-- top-content -->
    <div id="top-content">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="h1-title" title="" >CÁ NHÂN</h1>
                </div>
                <div class="col-sm-6 text-right  ">
                    <span class="link-top"><a href="<?php echo yii::$app->urlManager->createUrl(['index']) ?>" >HOME </a></span>/<span class="link-top">CÁ NHÂN</span>
                </div>
            </div>
        </div>
    </div>
    <!-- top-content  --> 
    <!-- part1 -->
    <div class="container">
        <?php if ($total <= 2 && $total >= 1): ?>
            <div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                Thông báo: Gói học của bạn sắp kết thúc, để quá trình cải thiện tiếng Anh của bạn không bị gián đoạn, vui lòng chọn thêm gói học mới! Trân trọng!</div>
        <?php endif; ?>
        <?php
        foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
            echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
        }
        ?>
        <div class="row">
            <div class="col-md-8">
               
				<div class="row">
					<div class="col-md-6" style="padding: 10px">
					<button type="button" class="w3-button w3-block w3-green btn-history" style="font-weight:bold; height: 50px; width: 100%; margin:auto;  text-align: left;  text-transform: uppercase;"><i class="fa fa-history fa-2x"  style="margin-right:10px;" aria-hidden="true"></i> Lịch sử giao dịch <small class="view-tooltip" data-original-title="Hệ thống cho phép bạn chuyển đổi gói học phù hợp với nhu cầu của học viên."  title="Hệ thống cho phép bạn chuyển đổi gói học phù hợp với nhu cầu của học viên." style="color:red; font-size: 9px; background:#fff; padding: 4px 0px;">(Chuyển đổi gói học)</small></button>
					   
					</div>  
					<div class="col-md-6" style="padding: 10px"><a target="_blank" href="<?php echo $lessonlink;?>" class="w3-button w3-block w3-green" style="font-weight:bold; height: 50px; line-height:50px; width: 100%; margin:auto; text-decoration: none; text-align: left; text-transform: uppercase;"><i  style="margin-right:10px;" class="fa fa-file-text  fa-2x" aria-hidden="true"></i> Thư viện bài học</a></div>  
				</div>	
				<div class="row">
					<div class="col-md-6" style="padding: 10px"><button type="button" class="w3-button w3-block w3-green btn-request" style="font-weight:bold; height: 50px; width: 100%; margin:auto; text-align: left;  text-transform: uppercase;"><i  style="margin-right:10px;" class="fa fa-commenting-o  fa-2x" aria-hidden="true"></i> Yêu cầu kiểm tra</button></div>     
					<div class="col-md-6" style="padding: 10px"><a target="_blank" href="<?php echo $videoTestLink;?>" class="w3-button w3-block  w3-text-white" style="background-color:#f7931e; font-weight:bold; height: 50px; line-height:50px; width: 100%; margin:auto; text-decoration: none;   text-align: left; text-transform: uppercase;"><i style="margin-right:10px;" class="fa fa-camera fa-2x" aria-hidden="true"></i>Kiểm tra thiết bị</a></div>  
            	</div>
				<?php if(isset($student->type_test)){?>
				<div class="row">
					<div class="col-md-12" style="padding: 10px;"><a style="font-weight: bold; width: 100%; margin: auto; text-transform: uppercase;"  class="w3-button w3-block w3-green" href="<?php echo yii::$app->urlManager->createUrl(['test-page/library']) ?>"><i class="fa fa-list-alt fa-2x" style="margin-right:10px;" aria-hidden="true"></i> <?php echo ($student->type_test==1)? 'Kiểm tra đầu vào':(($student->type_test==2)? 'Kiểm tra giữa kỳ':'Kiểm tra cuối kỳ');?> </a></div> 
            	</div>
				<?php }?>
				<div class="row">
					<div class="col-md-12" style="padding: 10px"><button type="button" class="w3-button w3-block w3-green btn-show" style="font-weight:bold;  text-transform: uppercase;"> <span class="glyphicon glyphicon-address-book"></span><i  style="margin-right:10px;" class="fa fa-user-secret  fa-2x" aria-hidden="true"></i> Hiển thị thông tin cá nhân</button></div> 
            	</div>
			
			<div class="con-canhan profile-content" style="display: none;">
                    <h3 class="h3-title student-h3-title">THÔNG TIN CỦA BẠN</h3>
                    <p style="color:red; font-size:12px; font-style: italic;">(<span style="font-weight:bold">*</span>) Thông tin bắt buộc phải có</p>
                    <?php $form = ActiveForm::begin(); ?>
                    <input type="hidden" name="change" value="info" />
                    <table class="table-khung">
                        <tr>
                            <td class="td-canhan"><?php echo Yii::t('account', 'name') ?>:<span style="color:red">*</span></td>
                            <td>
                                <?php echo $form->field($profile, 'name', ['template' => '{input}'])->textInput(); ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="td-canhan"><?php echo Yii::t('account', 'email') ?>:<span style="color:red">*</span></td>
                            <td>
                                <?php echo $form->field($profile, 'email', ['template' => '{input}'])->textInput(); ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="td-canhan"><?php echo Yii::t('account', 'phone') ?>:<span style="color:red">*</span></td>
                            <td>
                                <?php echo $form->field($profile, 'phone', ['template' => '{input}'])->textInput(); ?>
                            </td>
                        </tr>

                        <tr>
                            <td class="td-canhan"><?php echo Yii::t('account', 'address') ?>:  </td>
                            <td>
                                <?php echo $form->field($profile, 'address', ['template' => '{input}'])->textInput(); ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="td-canhan">Skype:<span style="color:red">*</span></td>
                            <td>
                                <?php echo $form->field($profile, 'skype', ['template' => '{input}'])->textInput(); ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="td-canhan">  </td>
                            <td>
                                <button type="submit"  class="btn btn-default btn-lg" ><?php echo Yii::t('account', 'submit') ?></button>
                                <button class='btn btn-default btn-lg' rel='open_ajax' href="<?php echo yii::$app->urlManager->createUrl(['student/changepassword']) ?>">Đổi mật khẩu</button>
                            </td>
                            
                        </tr>
                    </table>
                    <?php ActiveForm::end(); ?>

                </div>

                <h3 class="h3-title student-h3-title">LỊCH HỌC SẮP TỚI <br> <font style="font-weight:bold; color:red;font-size: 12px;"> * (Vui lòng kiểm tra chính xác ngày học, giờ học trước khi tham gia lớp)</font>
                                <!-- <small id="app-window" style="font-weight:bold;">*(Tham gia buổi học dễ dàng hơn với <a style="color:#337ab7" href="https://call.e-space.vn/upload/files/espace_student/Espace_Student.zip">E-space app - Tải về tại đây <i class="fa fa-lg fa-download"></i></a>)</small> </h3> --> 
				<div id="browser_message"></div>
                <div class="table_reponsive1">
                    <table class="table">
                        <thead class="thead">
                            <tr class="title-tr-green">
                                <td style="width: 5%"><?php echo Yii::t('account', 'stt') ?></td>
                                <td style="width:25%"><?php echo Yii::t('account', 'date_start') ?></td>
                                <td style="width:20%"><?php echo Yii::t('account', 'time') ?> </td>
                                <td style="width:25%"><?php echo Yii::t('account', 'teacher') ?></td>
                                <td style="width:25%"></td>
                            </tr>
                        </thead>
                        <tbody class="tbody">
                                    <tr>
                                        <td colspan="6" style="padding:0px">
                                            <div id="next-class" style="width: 100%;overflow: auto; max-height: 250px;">
                                                <table class="table">
                                                    <?php foreach ($classesNotLearned as $key => $class): ?>
														<tr <?php echo ($key==0)? 'style="background:#ff645973"':'';?> class="<?php echo ($key % 2 == 0) ? 'title-tr-xd' : 'title-tr-xt' ?>">
                                                            <td style="width: 5%">
                                                                <?php echo $key + 1 ?>
                                                            </td>
                                                            <td style="width:25%">
                                                                <?php echo date('d/m/Y', strtotime($class->class->start_date)); ?>
                                                            </td>
                                                            <td style="width:20%">
                                                                <?php echo date('H:i', strtotime($class->class->start_date)); ?> 
                                                            </td>
                                                            <td style="width:25%">
                                                                <?php echo isset($class->class->teacher)? $class->class->teacher->name: ''; ?>
															</td>
                                                           <td style="width:25%">
														   <?php if($student->new_version) { ?>
														   			<?php 
																		
																		$username =str_replace(array(" ","Desktop","@teacher"), array("-","",""), EncodeUrl::stripVN($student->student_id));
																		$username= preg_replace('/[^A-Za-z0-9\-]/', '-', $username);
																		$room = $class->class->teacher_id . '_' . $student->student_id. '_' . $class->key_group;  // id của  lớp học
																		$wb_room = $class->class->teacher_id . '_' . $student->student_id;
                                                                                                                                                
																		//$isEU = (isset($class->class->teacher->serverName) && $class->class->teacher->serverName->url=='https://eu.e-space.vn')? 1:0;
																		$isServer = array("https://eu.e-space.vn", "https://ca.e-space.vn", "https://sa.e-space.vn");
																		if (isset($class->class->teacher->serverName) && in_array($class->class->teacher->serverName->url, $isServer)) {
																				$isEU = 1;
																		}else{
																				$isEU = 0;
																		}
																		//$special = isset($class->class->teacher)?$class->class->teacher->special: 0;
																		$key = EncodeUrl::encrypt(json_encode(array('username' => $username, 'isEU' => $isEU,'room' => $room,'random' => rand(0,1000))), 'paxcreation');
																		
																	?>
                                                                                                                                        <a data-toggle="tooltip" onClick="openWhiteBoard('<?php echo $wb_room;?>')" data-placement="bottom" title="Open EBoard" class="join-tooltip btn btn-primary btn-xs" style="font-weight: bold;">
															  			EB
																	</a>
                                                               
																	<?php if((strtotime($class->class->start_date)-1800)<=(\Custom\Common::getCurrentTime()) && (strtotime($class->class->start_date)+1500)>=(\Custom\Common::getCurrentTime())){?>
																	<a data-toggle="tooltip" onClick="openCall('<?php echo $key;?>')" data-placement="bottom" title="Click vào đây để tham gia học với giáo viên <?php echo isset($class->class->teacher)?$class->class->teacher->name: '';?>" class="join-tooltip btn btn-primary btn-xs" style="font-weight: bold;">
															  			Tham gia
																	</a>	
																	<?php }else {?>
																	<a target="_blank" onClick="openCall('<?php  echo $key;?>')" class="btn btn-default btn-xs" style="font-weight: bold;">
															  			Tham gia
																	</a>	
															<?php } ?>
															<?php } else {?>
																<?php echo isset($class->class->teacher)? $class->class->teacher->skype: ''; ?>
                                                                
																<?php }?>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                        </tbody>
                    </table>
                </div>
				
                 <h3 class="h3-title student-h3-title">LỊCH SỬ HỌC CỦA BẠN</h3>
                 <?php 
                    if($student->link){
                          if (@file_get_contents($student->link)){
                    ?>
                    <div> Link video học kiểm tra đầu vào (buổi học đầu tiên) <a target="_blank" data-toggle="tooltip" data-placement="bottom" title="Click vào đây để xem lại bài học buổi học kiểm tra đầu vào" style="font-size:75%; margin-top:0px;" class="btn btn-success btn-xs view-tooltip" href="<?php echo $student->link;?>"><i class="fa fa-camera" aria-hidden="true"></i> Xem</a></div>
                
                    <?php }?> 
                 <?php }?> 
                <ul class="nav nav-tabs nav-tabs-student">
                    <li class="active"><a data-toggle="tab" href="#home">Đã học</a></li>
                    <li><a data-toggle="tab" href="#menu1">Đã hủy</a></li>
                </ul>
                <div class="tab-content">
                    <div id="home" class="tab-pane fade in active">
                        <div>
                            <table class="table">
                                <thead class="thead">
                                    <tr class="title-tr-green">
                                        <td style="width: 5%"><?php echo Yii::t('account', 'stt') ?></td>
                                        <td style="width:15%"><?php echo Yii::t('account', 'date_start') ?></td>
                                        <td style="width:15%"><?php echo Yii::t('account', 'time') ?> </td>
                                        <td style="width:25%" class="teacher_name"><?php echo Yii::t('account', 'teacher') ?></td>
                                        <td style="width:15%"><?php echo Yii::t('account', 'status') ?></td>
                                        <td style="width:25%"></td>
                                    </tr>
                                </thead>
                                <tbody class="tbody">
                                    <tr>
                                        <td colspan="6" style="padding:0px">
                                            <div id="history_success" style="width: 100%;overflow: auto; max-height: 300px;">
                                                <table class="table">
                                                    <?php $i=0; foreach ($classesSuccess as $key => $class): ?>
													
                                                        <tr class="<?php echo ($key % 2 == 0) ? 'title-tr-xd' : 'title-tr-xt' ?>">
                                                            <td style="width: 5%">
                                                                <?php echo $key + 1 ?>
                                                            </td>
                                                            <td style="width:15%">
                                                                <?php echo date('d/m/Y', strtotime($class->class->start_date)); ?>
                                                            </td>
                                                            <td style="width:15%"> 
                                                                <?php echo date('H:i', strtotime($class->class->start_date)); ?> 
                                                            </td>
                                                            <td style="width:25%" class="teacher_name">
                                                                <i style="color:red" class="fa fa-chevron-circle-right" aria-hidden="true"></i>&nbsp;<a style="color:blue;" class="booking-tooltip" href="<?php echo Yii::$app->urlManager->createUrl(["booking-teacher/index", 'name' => isset($class->class->teacher) ? $class->class->teacher->name : '', 'token' => JWT::encode(['teacher_id' => isset($class->class->teacher) ? $class->class->teacher->teacher_id : 0, 'date' => \Custom\Common::getCurrentTime()], 'booking')]) ?>"  data-toggle="tooltip" data-placement="bottom"  title="Click vào đây để xem lịch giáo viên <?php echo isset($class->class->teacher)? $class->class->teacher->name: ''; ?>"> <?php echo isset($class->class->teacher)? $class->class->teacher->name :''; ?></a>
                                                            </td>
                                                            <td style="width:15%">
                                                                <?php if ($class->status == ClassStudent::STATUS_DEACTIVE): ?> 
                                                                    <?php if (\Custom\Common::getCurrentTime() > strtotime($class->class->start_date . '+ 25 minutes')): ?>
                                                                        <span class='label label-success'><?php echo ClassStudent::getTextStatus(ClassStudent::STATUS_ACTIVE); ?></span>
                                                                    <?php else: ?>
                                                                        <span class='label label-default'><?php echo ClassStudent::getTextStatus(ClassStudent::STATUS_DEACTIVE); ?></span>
                                                                    <?php endif; ?>

                                                                <?php endif; ?>

                                                                <?php if ($class->status == ClassStudent::STATUS_ACTIVE): ?>    
                                                                    <span class='label label-success'><?php echo ClassStudent::getTextStatus(ClassStudent::STATUS_ACTIVE); ?></span>
                                                                <?php endif; ?>

                                                                <?php if ($class->status == ClassStudent::STATUS_CANCEL): ?>   
                                                                    <span class='label label-danger'><?php echo ClassStudent::getTextStatus(ClassStudent::STATUS_CANCEL); ?></span>
                                                                <?php endif; ?>
                                                                <?php if ($class->status == ClassStudent::STATUS_RESTORE): ?>   
                                                                    <span class='label label-warning'><?php echo ClassStudent::getTextStatus(ClassStudent::STATUS_RESTORE); ?></span>
                                                                <?php endif; ?>
                                                                <?php if ($class->status == ClassStudent::STATUS_NOLEAN): ?>   
                                                                    <span class='label label-info'><?php echo ClassStudent::getTextStatus(ClassStudent::STATUS_NOLEAN); ?></span>
                                                                <?php endif; ?>
																<?php if ($class->status == ClassStudent::STATUS_TEACHER_ERROR): ?>   
                                                                    <span class='label label-primary'><?php echo ClassStudent::getTextStatus(ClassStudent::STATUS_TEACHER_ERROR); ?></span>
                                                                <?php endif; ?>
                                                                <?php if ($class->status == ClassStudent::STATUS_NOTEACH): ?>   
                                                                    <span class='label label-primary'><?php echo ClassStudent::getTextStatus(ClassStudent::STATUS_NOTEACH); ?></span>
                                                                <?php endif; ?>

                                                            </td>
                                                            <td style="width:25%">
                                                                <?php if ($class->status == ClassStudent::STATUS_DEACTIVE): ?>
                                                                    <!--Admin -->
                                                                    <?php if (Yii::$app->session->has('admin')): ?>
                                                                        <button  style="font-size:75%;" data-id="<?php echo $class->id; ?>" data-name="<?php echo isset($class->class->teacher)? $class->class->teacher->name:''; ?>" data-hour="<?php echo date('H:i', strtotime($class->class->start_date)); ?>" data-date="<?php echo date('d/m/Y', strtotime($class->class->start_date)); ?>" data-toggle="tooltip" data-placement="bottom" title="Click vào đây để hủy buổi học với giáo viên <?php echo $class->class->teacher->name; ?>" class="btn btn-xs btn-danger cancel cancel-tooltip"><span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span> <?php echo Yii::t('account', 'cancel') ?></button>
                                                                    <?php else: ?>
                                                                        <?php if ((\Custom\Common::getCurrentTime() + 7200) < strtotime($class->class->start_date)){ ?>
                                                                            <button  style="font-size:75%;" data-id="<?php echo $class->id; ?>" data-name="<?php echo $class->class->teacher->name; ?>" data-hour="<?php echo date('H:i', strtotime($class->class->start_date)); ?>" data-date="<?php echo date('d/m/Y', strtotime($class->class->start_date)); ?>" data-toggle="tooltip" data-placement="bottom" title="Click vào đây để hủy buổi học với giáo viên <?php echo $class->class->teacher->name; ?>" class="btn btn-xs btn-danger cancel cancel-tooltip"><span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span> <?php echo Yii::t('account', 'cancel') ?></button>
                                                                        <?php }else { ?> 
																					<?php if($student->new_version) { ?>
														   			<?php 
																		$username =str_replace(array(" ","Desktop","@teacher"), array("-","",""), EncodeUrl::stripVN($student->student_id));
																		$username= preg_replace('/[^A-Za-z0-9\-]/', '-', $username);
																		$room = $class->class->teacher_id . '_' . $student->student_id. '_' . $class->key_group;  // id của  lớp học
																		$key = EncodeUrl::encrypt(json_encode(array('username' => $username,'room' => $room)), 'paxcreation');
																	?>
																	<?php if((strtotime($class->class->start_date)-1800)<=(\Custom\Common::getCurrentTime()) && (strtotime($class->class->start_date)+1500)>=(\Custom\Common::getCurrentTime())){?>
																	<a data-toggle="tooltip" onClick="openCall('<?php echo $key;?>')" data-placement="bottom" title="Click vào đây để tham gia học với giáo viên <?php echo isset($class->class->teacher)?$class->class->teacher->name: '';?>" class="join-tooltip btn btn-primary btn-xs" style="font-weight: bold;">
															  			Tham gia
																	</a>	
																	<?php }?>
																	
																<?php } ?>
																				
																		<?php }?>	
																		<?php endif ?>
																		
                                                                    <?php if (\Custom\Common::getCurrentTime() > strtotime($class->class->start_date . '+ 25 minutes')): ?>
                                                                       
                                                                        <?php if (date('W', strtotime($class->class->start_date)) == date('W', \Custom\Common::getCurrentTime()) && date('Y', strtotime($class->class->start_date)) == date('Y', \Custom\Common::getCurrentTime())): ?>
                                                                           
																		   <?php if ($class->rating_status == \common\models\Student::rated): ?>
                                                                                <button  style="font-size:75%" class="btn btn-info btn-xs"  disabled="disabled"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Đã đánh giá</a>
                                                                                <?php else: ?>
                                                                                    <button data-id="<?php echo $class->id; ?>" data-teacher_id="<?php echo $class->class->teacher->teacher_id; ?>" style="font-size:75%" data-toggle="tooltip"  data-placement="bottom" title="Click vào đây để gửi nhận xét/ cảm nhận/ đánh giá/... sau buổi học với với giáo viên <?php echo $class->class->teacher->name; ?>"  class="btn btn-info btn-xs rating rate-tooltip btn-rating<?php echo $class->id; ?>"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Đánh giá</button>
                                                                                <?php endif; ?>
																				
                                                                            <?php endif; ?>
                                                                        <?php endif; ?>
																		
																				 <?php if (\Custom\Common::getCurrentTime() > strtotime($class->class->start_date . '+ 25 minutes') && $student->new_version && $i < 10) {  $i++; $wb_room = $class->class->teacher_id . '_' . $student->student_id; ?>
																						<?php if(Student::checkURLExist(  $student->student_id, $class->class->teacher_id, $class->key_group)){?>
										    <a data-toggle="tooltip" onClick="openWhiteBoard('<?php echo $wb_room;?>')" data-placement="bottom" title="Open EBoard" class="join-tooltip btn btn-primary btn-xs" style="font-weight: bold;">EB</a>													
                                                                                    <button data-toggle="tooltip" data-placement="bottom" title="Click vào đây để xem lại bài học đã học với giáo viên <?php echo $class->class->teacher->name; ?>" style="font-size:75%; margin-top:0px;" class="btn btn-success btn-xs view-tooltip" onclick=" myFunction(<?php echo $class->class->teacher->teacher_id; ?>,'<?php echo $class->class->teacher->name; ?>','<?php echo $class->key_group; ?>')"><i class="fa fa-camera" aria-hidden="true"></i> Xem</button>
                                                                                                                                                                                        
																						<?php }elseif(Student::checkURLExist1( $student->student_id, $class->class->teacher_id, $class->key_group)){?>	
                                                                                     <a data-toggle="tooltip" onClick="openWhiteBoard('<?php echo $wb_room;?>')" data-placement="bottom" title="Open EBoard" class="join-tooltip btn btn-primary btn-xs" style="font-weight: bold;">EB</a>
																							<button data-toggle="tooltip" data-placement="bottom" title="Click vào đây để xem lại bài học đã học với giáo viên <?php echo $class->class->teacher->name; ?>" style="font-size:75%; margin-top:0px;" class="btn btn-success btn-xs view-tooltip" onclick=" myFunction1(<?php echo $class->class->teacher->teacher_id; ?>,'<?php echo $class->class->teacher->name; ?>','<?php echo $class->key_group; ?>')"><i class="fa fa-camera" aria-hidden="true"></i> Xem</button>
                                                                                                                                                                                        
																						<?php }else{?>
																							<button onclick="alert('Chưa có Video')"  style="font-size:75%; margin-top:0px;" class="btn btn-default btn-xs view-tooltip" data-toggle="tooltip" data-placement="bottom" title="Click vào đây để xem lại bài học đã học với giáo viên <?php echo $class->class->teacher->name; ?>"><i class="fa fa-camera" aria-hidden="true"></i> Xem</button>
																						<?php } ?>
                                                                        <?php } ?>		
                                                                    <?php endif; ?>
													
                                                                    <?php if ($class->status == ClassStudent::STATUS_ACTIVE): ?>    
                                                                        <a class="btn btn-success btn-xs" disabled="disabled"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Đã học</a>
                                                                    <?php endif; ?>


                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>

                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div id="menu1" class="tab-pane fade">
                        <div>
                            <table class="table" id="history">
                                <thead class="thead">
                                    <tr class="title-tr-green">
                                        <td style="width: 5%"><?php echo Yii::t('account', 'stt') ?></td>
                                        <td style="width:15%"><?php echo Yii::t('account', 'date_start') ?></td>
                                        <td style="width:15%"><?php echo Yii::t('account', 'time') ?> </td>
                                        <td style="width:25%" class="teacher_name"><?php echo Yii::t('account', 'teacher') ?></td>
                                        <td style="width:15%"><?php echo Yii::t('account', 'status') ?></td>
                                        <td style="width:25%"></td>
                                    </tr>
                                </thead>
                                <tbody class="tbody">
                                  
                                    <tr>
                                        <td colspan="6" style="padding:0px">
                                            <div id="history_cancel" style="width: 100%;overflow: auto; max-height: 300px;">
                                                <table class="table">
                                                    <?php foreach ($classesCancel as $key => $class): ?>
                                                        <tr class="<?php echo ($key % 2 == 0) ? 'title-tr-xd' : 'title-tr-xt' ?>">
                                                            <td style="width: 5%">
                                                                <?php echo $key + 1 ?>
                                                            </td>
                                                            <td style="width:15%">
                                                                <?php echo date('d/m/Y', strtotime($class->class->start_date)); ?>
                                                            </td>
                                                            <td style="width:15%"> 
                                                                <?php echo date('H:i', strtotime($class->class->start_date)); ?> 
                                                            </td>
                                                            <td style="width:25%" class="teacher_name">
                                                                <i style="color:red" class="fa fa-chevron-circle-right" aria-hidden="true"></i>&nbsp;<a style="color:blue;" class="booking-tooltip" href="<?php echo Yii::$app->urlManager->createUrl(["booking-teacher/index", 'name' => isset($class->class->teacher) ? $class->class->teacher->name : '', 'token' => JWT::encode(['teacher_id' => isset($class->class->teacher) ? $class->class->teacher->teacher_id : 0, 'date' => \Custom\Common::getCurrentTime()], 'booking')]) ?>"  data-toggle="tooltip" data-placement="bottom"  title="Click vào đây để xem lịch giáo viên <?php echo $class->class->teacher->name; ?>"> <?php echo $class->class->teacher->name; ?></a>
                                                            </td>
                                                            <td style="width:15%">
                                                                <?php if ($class->status == ClassStudent::STATUS_DEACTIVE): ?> 
                                                                    <?php if (\Custom\Common::getCurrentTime() > strtotime($class->class->start_date . '+ 25 minutes')): ?>
                                                                        <span class='label label-success'><?php echo ClassStudent::getTextStatus(ClassStudent::STATUS_ACTIVE); ?></span>
                                                                    <?php else: ?>
                                                                        <span class='label label-default'><?php echo ClassStudent::getTextStatus(ClassStudent::STATUS_DEACTIVE); ?></span>
                                                                    <?php endif; ?>

                                                                <?php endif; ?>

                                                                <?php if ($class->status == ClassStudent::STATUS_ACTIVE): ?>    
                                                                    <span class='label label-success'><?php echo ClassStudent::getTextStatus(ClassStudent::STATUS_ACTIVE); ?></span>
                                                                <?php endif; ?>

                                                                <?php if ($class->status == ClassStudent::STATUS_CANCEL): ?>   
                                                                    <span class='label label-danger'><?php echo ClassStudent::getTextStatus(ClassStudent::STATUS_CANCEL); ?></span>
                                                                <?php endif; ?>
                                                                <?php if ($class->status == ClassStudent::STATUS_RESTORE): ?>   
                                                                    <span class='label label-warning'><?php echo ClassStudent::getTextStatus(ClassStudent::STATUS_RESTORE); ?></span>
                                                                <?php endif; ?>
                                                                <?php if ($class->status == ClassStudent::STATUS_NOLEAN): ?>   
                                                                    <span class='label label-info'><?php echo ClassStudent::getTextStatus(ClassStudent::STATUS_NOLEAN); ?></span>
                                                                <?php endif; ?>
                                                                <?php if ($class->status == ClassStudent::STATUS_NOTEACH): ?>   
                                                                    <span class='label label-primary'><?php echo ClassStudent::getTextStatus(ClassStudent::STATUS_NOTEACH); ?></span>
                                                                <?php endif; ?>

                                                            </td>
                                                            <td style="width:25%">
                                                                <?php if ($class->status == ClassStudent::STATUS_DEACTIVE): ?>
                                                                    <!--Admin -->
                                                                    <?php if (Yii::$app->session->has('admin')): ?>
                                                                        <button  style="font-size:75%;" data-id="<?php echo $class->id; ?>" data-name="<?php echo $class->class->teacher->name; ?>" data-hour="<?php echo date('H:i', strtotime($class->class->start_date)); ?>" data-date="<?php echo date('d/m/Y', strtotime($class->class->start_date)); ?>" data-toggle="tooltip" data-placement="bottom" title="Click vào đây để hủy buổi học với giáo viên <?php echo $class->class->teacher->name; ?>" class="btn btn-xs btn-danger cancel cancel-tooltip"><span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span> <?php echo Yii::t('account', 'cancel') ?></button>
                                                                    <?php else: ?>
                                                                        <?php if ((\Custom\Common::getCurrentTime() + 7200) < strtotime($class->class->start_date)): ?>
                                                                            <button  style="font-size:75%;" data-id="<?php echo $class->id; ?>" data-name="<?php echo $class->class->teacher->name; ?>" data-hour="<?php echo date('H:i', strtotime($class->class->start_date)); ?>" data-date="<?php echo date('d/m/Y', strtotime($class->class->start_date)); ?>" data-toggle="tooltip" data-placement="bottom" title="Click vào đây để hủy buổi học với giáo viên <?php echo $class->class->teacher->name; ?>" class="btn btn-xs btn-danger cancel cancel-tooltip"><span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span> <?php echo Yii::t('account', 'cancel') ?></button>
                                                                        <?php endif; ?>
                                                                    <?php endif; ?>
                                                                    <?php if (\Custom\Common::getCurrentTime() > strtotime($class->class->start_date . '+ 25 minutes')): ?>
                                                                        <?php if ($student->new_version) { ?>
                                                                            <button data-toggle="tooltip" data-placement="bottom" title="Click vào đây để xem lại bài học đã học với giáo viên <?php echo $class->class->teacher->name; ?>" style="font-size:75%; margin-top:0px;" class="btn btn-success btn-xs view-tooltip" onclick=" myFunction(<?php echo $class->class->teacher->teacher_id; ?>,'<?php echo $class->class->teacher->name; ?>','<?php echo $class->key_group; ?>')"><i class="fa fa-camera" aria-hidden="true"></i> Xem</button>
                                                                        <?php } ?>
                                                                        <?php if (date('W', strtotime($class->class->start_date)) == date('W', \Custom\Common::getCurrentTime()) && date('Y', strtotime($class->class->start_date)) == date('Y', \Custom\Common::getCurrentTime())): ?>
                                                                            <?php if ($class->rating_status == \common\models\Student::rated): ?>
                                                                                <button  style="font-size:75%" class="btn btn-info btn-xs"  disabled="disabled"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Đã đánh giá</a>
                                                                                <?php else: ?>
                                                                                    <button data-id="<?php echo $class->id; ?>" data-teacher_id="<?php echo $class->class->teacher->teacher_id; ?>" style="font-size:75%" data-toggle="tooltip"  data-placement="bottom" title="Click vào đây để gửi nhận xét/ cảm nhận/ đánh giá/... sau buổi học với với giáo viên <?php echo $class->class->teacher->name; ?>"  class="btn btn-info btn-xs rating rate-tooltip btn-rating<?php echo $class->id; ?>"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Đánh giá</button>
                                                                                <?php endif; ?>
                                                                            <?php endif; ?>
                                                                        <?php endif; ?>

                                                                    <?php endif; ?>

                                                                    <?php if ($class->status == ClassStudent::STATUS_ACTIVE): ?>    
                                                                        <a class="btn btn-success btn-xs" disabled="disabled"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Đã học</a>
                                                                    <?php endif; ?>


                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>

                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <h3 class="h3-title student-h3-title">ĐÁNH GIÁ BUỔI HỌC</h3>
                <div>
                    <p>Những đánh giá của giáo viên dành cho học viên sau buổi học</p>
                    <table class="table" id="comment-teacher">
                        <thead class="thead">
                            <tr class="title-tr-green">
                                <th style="width:5%; text-align: center;">STT</th>
                                <th style="width:20%; text-align: center;">Giáo viên</th>
                                <th style="width:30%; text-align: center;">Bài học</th>
                                <th style="width:15%; text-align: center;" class="date">Ngày</th>
								<th style="width:15%; text-align: center;" class="page">Trang</th>
                                <th style="width:20%; text-align: center;">Action</th>
                            </tr>
                        </thead>
                        </tbody>
                                <tr>
                                    <td colspan="6" style="padding:0px">
                                           <div id="comment-class" style="width: 100%;overflow: auto; max-height: 300px;">
                                               <table class="table">
                                            <?php if (count($comments)): ?>
                                                <?php foreach ($comments as $key => $comment): ?>
                                                    <tr class="<?php echo ($key % 2 == 0) ? 'title-tr-xd' : 'title-tr-xt' ?>">
                                                        <td style='width:5%; text-align: center;'>
                                                            <?php echo $key + 1; ?>
                                                        </td>
                                                        <td style='width:20%; text-align: center;'>
                                                            <?php echo isset($comment->teacher)?$comment->teacher->name:''?>
                                                        </td>
                                                        <td style='width:30%; text-align: center;'>
                                                            <a href="javascript:void(0)" data-toggle="tooltip" data-placement="bottom" title="<?php echo $comment->lesson; ?>"><?php echo substr($comment->lesson, 0, 30); ?></a> 
                                                        </td>
                                                        <td style='width:15%; text-align: center;' class="date">
                                                            <?php echo date('d/m/Y', strtotime($comment->created)) ?>
                                                        </td>
														<td style='width:15%; text-align: center;' class="page">
                                                            <?php echo $comment->page;?>
                                                        </td>
														
                                                        <td style='width:20%; text-align: center;'>
                                                           
                                                            <button style="font-size:75%; margin-top:0px;" class="btn btn-xs btn-info btn-view-comment" data-id="<?php echo $comment->comment_id;?>">Xem</button>
                                                            </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                                    </table>
                                        </div>
                                    </td>
                                </tr>
                        </tbody>
                    </table>
                </div>
              
      
                
                <h3 class="h3-title student-h3-title">Tài liệu học</h3>

                <div>

                    <table class="table">
                        <thead class="thead">
                            <tr class="title-tr-green">
                                <td style="width:5%; text-align: center;">STT</td>
                                <td style="width:50%; text-align: center;">Tiêu đề</td>
                                <td style="width:45%; text-align: center;">Tải tài liệu</td>
                            </tr>
                        </thead>
                       <tbody>
                            <tr>
                                <td colspan="8" style="padding:0px">
                                   <div id="history-exchange" style="width: 100%;overflow: auto; max-height: 200px;">
                                       <table class="table">
                                           <?php if ($documents): ?>
                                               <?php foreach ($documents as $key => $document):
                                                   ?>
                                                   <?php if ($document->document): ?>
                                                       <tr class="<?php echo ($key % 2 == 0) ? 'title-tr-xd' : 'title-tr-xt' ?>">
                                                             <td style="width:5%; text-align: center;">
                                                               <?php echo $key + 1; ?>
                                                           </td>
                                                           <td style="width:50%; text-align: center;">
                                                               <?php echo $document->document->title ?>
                                                           </td>
                                                            <td style="width:45%; word-break: break-word; text-align: center;">
                                                               <?php if (!$document->document->link): ?>
                                                                   <a title="<?php echo $document->document->description; ?>" target="_blank" href="<?php echo Yii::$app->urlManager->getBaseUrl() . 'files/document/' . $document->document->file; ?>">
                                                                       <?php echo $document->document->file; ?>
                                                                   </a>
                                                               <?php else: ?>
                                                                   <a title="<?php echo $document->document->description; ?>"  target="_blank" href="<?php echo $document->document->link; ?>">
                                                                       <?php echo $document->document->link; ?>
                                                                   </a>
                                                               <?php endif; ?>
                                                           </td>
                                                       </tr>
                                                   <?php endif; ?>
                                               <?php endforeach; ?>
                                           <?php endif; ?>
                                       </table>
                                   </div>
                                </td>
                        </tbody> 
                    </table>

                </div>
                <h3 class="h3-title student-h3-title">NHỮNG HỌC VIÊN BẠN ĐÃ MỜI</h3>

                <div>

                    <table class="table">
                        <thead class="thead">
                            <tr class="title-tr-green">
                                <th style="width:5%; text-align: center">STT</th>
                                <th style="width:40%; text-align: center">Tên học viên</th>
                                <th style="width:35%; text-align: center">Email</th>
                                <th style="width:20%; text-align: center">Ngày tạo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="8" style="padding:0px">
                                   <div id="history-exchange" style="width: 100%;overflow: auto; max-height: 200px;">
                                       <table class="table">
                                            <?php if (count($invited)): ?>
                                <?php foreach ($invited as $key => $comment): ?>
                                    <tr class="<?php echo ($key % 2 == 0) ? 'title-tr-xd' : 'title-tr-xt' ?>">
                                        <th style="width:5%; text-align: center">
                                            <?php echo $key + 1; ?>
                                        </td>
                                        <th style="width:40%; text-align: center">
                                            <?php echo $comment->name ?>
                                        </td>
                                        <th style="width:35%; text-align: center">
                                            <?php echo $comment->email ?>
                                        </td>
                                        <th style="width:20%; text-align: center">
                                            <?php echo date('d/m/Y', strtotime($comment->created)) ?>
                                        </td>

                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                                       </table>
                                   </div>
                                </td>
                           
                        </tbody>
                    </table>

                </div>
                <h3 class="h3-title student-h3-title">GIỚI THIỆU VỚI MỌI NGƯỜI ĐỂ NHẬN ƯU ĐÃI</h3>
                <div class="link-gt">
                    <div class="row">
                        <div class="col-sm-3">Link giới thiệu</div>
                        <div class="col-sm-9">
                            
                            <div class="row">
                                 <div class="col-sm-6">
                                     <input style="margin: 0px; padding:0px; width: 100%; height: 64px;" type="text" value="<?php echo Yii::$app->urlManager->createAbsoluteUrl(['index/register', 'code' => $student->code]) ?>" placeholder="<?php echo Yii::$app->urlManager->createAbsoluteUrl(['index/register', 'code' => $student->code]) ?>" >
                                 </div>
                                <div class="col-sm-6" style="padding:0px">
                                <a style="margin: 0px; padding: 0px; color:#337ab7" target="_blank" title="Share on Facebook" href="http://www.facebook.com/sharer/sharer.php?u=<?php echo Yii::$app->urlManager->createAbsoluteUrl(['index/register', 'code' => $student->code]) ?>"><i style="color:#337ab7; margin-right:2px;" class="fa  fa-4x fa-facebook-square" aria-hidden="true"></i></a>
                                <a style="margin: 0px; padding: 0px;" target="_blank" title="Share on Google" href="https://plus.google.com/share?url=<?php echo Yii::$app->urlManager->createAbsoluteUrl(['index/register', 'code' => $student->code]) ?>"><i style=" color:#15a90c; margin-right:2px;" class="fa  fa-4x fa-google-plus-square" aria-hidden="true"></i></a>
                                <a style="margin: 0px; padding: 0px;" target="_blank" title="Share on Twiter" href="https://twitter.com/home?status=<?php echo Yii::$app->urlManager->createAbsoluteUrl(['index/register', 'code' => $student->code]) ?>"><i style=" color:#00b6ea; margin-right:2px;" class="fa fa-4x fa-twitter" aria-hidden="true"></i></a>
                                <a style="margin: 0px; padding: 0px;" target="_blank" title="Share email" href="<?php echo Yii::$app->urlManager->createAbsoluteUrl(['invite/index', 'code' => $student->code]) ?>"><i style=" color:#ff6459; margin-right:2px;" class="fa fa-4x fa-envelope" aria-hidden="true"></i></a>
                                 </div>
                                </div>
                        </div>
                    </div>

                    <div class=" row boder-top-gt">
                        <div class="col-sm-5">Tổng số điểm bạn kiếm được</div>
                      <div class="col-sm-7">
                            0
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="con-sidebar-kh">
             
                    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'id' => 'formAvatar']]); ?>
                            
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="row">
                                <div class="col-xs-4" style="padding-right: 0px;">
                                    <img  id="myImg" style="height:100px; width: 100px"  src="<?php echo Yii::$app->getUrlManager()->getBaseUrl() ?>/avatar/student/<?php echo $student->image ? $student->image : 'no-image.png'; ?>">
                                    <input type="hidden" name="change" value="avatar" />
                                    
                                </div>
                                <div class="col-xs-8">
                                        <div class="thongtin">
												<img style="width:100px; height:100px" src="<?php echo $icon;?>"/>
											
											</div>
											
									    
                            </div>
                            <div class="row" style="margin:0px;">
                                <div class="col-xs-12">
                                    <label for="fileAvatar"  style="float:left; margin-top: 2px; width:100px;height: 20px; line-height: 15px; padding:0px; font-size: 11px; font-weight: bold"  class="btn btn-primary">Chọn hình</label>
                                    <style>
                                        .help-block{
                                            font-size:11px;
                                            font-weight: 100;
                                            
                                        }
                                        .field-fileAvatar{float:left; margin-bottom: 0px; margin-left: 5px; height: 20px; line-height: 20px;}
                                    </style>
                                    <?= $form->field($model, 'imageFile')->fileInput(['id' => 'fileAvatar', 'style' => 'display:none;'])->label(false) ?>

                                    <input class="btn btn-primary"  style="width:100px;height: 20px; line-height: 15px; padding:0px; font-size: 11px; font-weight: bold; clear: left; float:left; margin-top:2px;" type="submit" name="button" value="Cập nhập"/>

                                </div>
								
                                    </div>
                            </div>
                        </div>
                    </div>
                     <?php ActiveForm::end(); ?>
                    <div class="row " style="margin-top:10px;">
                        <div class="col-xs-4">
                            <div class="glyphicon glyphicon-qrcode  point1"></div>
                        </div>
                        <div class="col-xs-8">
						<p style="margin-left:10%; margin-bottom:0px;text-align: center; float:left; line-height:64px; border:none;">
                                                <span style="color:#10a706; font-size:44px; font-weight: 800">  <?php echo $totalPoint; ?> </span> Point 
                                            </p>
                                            <?php if($discountCode){?>
                                            <div class="point11" style="clear:left;">
                                            <p><b>Mã giảm giá: </b> <strong style="color:#10a706; font-size:24px; font-weight: 800"><?php echo $discountCode->code ?></strong></p>
                                            <p style="font-size:small;">( Nhập mã giảm giá này khi thanh toán gói học. Mã giảm giá tương ứng với mức mà bạn đạt được. Mã chỉ áp dụng cho chủ tài khoản đang sở hữu)</p>
                                            <p style="color:red; text-align:left; font-weight: bold; margin-top:5px;"><a style="color:red;"  target="_blank"  href="https://e-space.vn/tich-diem/">*Thông tin tích lũy điểm</a></p>
                                            </div>
                                            <?php }?>
                                   
                        </div>
						
                    </div>
                </div>
				<div class="con-sidebar-kh">
                    <h3 class="h3-title2"><?php echo Yii::t('account', 'number_of_class') ?></h3>
					 <?php if (count($availablesNew)): ?>
                        <div class="p-pading50">
                            <?php foreach ($availablesNew as $key => $available): ?> 
                                <div style="font-size:13px;">
								
                                    <span style="font-weight: bold">Gói học:</span>  <?php echo $available['special'] ? 'Giáo viên châu Âu' : 'Giáo viên châu Á' ?> <br/>
                                    <span style="font-weight: bold">Số tiết học:</span>  <?php echo $available['quantity'] ?> tiết<br/>
                                    <span style="font-weight: bold">Thời gian 1 tiết học:</span> <?php echo $available['each_time']; ?> phút/tiết học<br/>
                                    <span style="font-weight: bold">Thời gian kích hoạt:</span> <?php echo date('d-m-Y', strtotime($available['updated'])) ?><br/>
                                    <span style="font-weight: bold">Thời gian hết hạn:</span>  <?php echo date('d-m-Y', strtotime($available['expiration'])) ?> (<?php echo $available['expiration_date'] ?> Ngày)<br/>
                                    <span style="font-weight: bold">Số buổi chưa học:</span> <?php
													$totalBook=0;
														if($available['total'] && $available['each_time']==25 ){
															$totalBook = $available['total'];
														}elseif($available['total'] && $available['each_time']==50){
															$totalBook = $available['total']/2; 
														}
													$total	= $totalBook + $available['total_quantity'];
												echo (($available['total_quantity']+ $available['total']) > 0) ? ($total . ' buổi (' . $available['total_quantity'] . ' buổi chưa đặt lịch , '. $totalBook . ' buổi đã đặt lịch )')  : '<span style="color:red">Đã hết</span>'; 
												?>
                                </div>
                                <hr/>
                            <?php endforeach; ?>
                        </div> 
                    <?php else: ?>
						<p class="p-pading50">
                            Bạn chưa chọn gói học, hãy chọn gói học để tham gia 
                            học cùng E-space
                        </p>
                        <p class="boder-top-ct">
                            <a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl(['payment/index']) ?>" class="link-hoc">
                                CHỌN GÓI HỌC
                            </a>
                        </p>
                    <?php endif; ?>
                </div>
                <?php if ($gifts): ?>
                    <div class="con-sidebar-kh">
                        <h3 class="h3-title2"><i style="color:red" class="fa fa-gift fa-3x "></i> QUÀ LIXI</h3>
                        <div class="p-pading50">
                            <p>Xin chúc mừng bạn đã nhận được món quà đầu năm từ trò chơi hái lộc của E-space.vn.</p><br/>
                            <?php foreach ($gifts as $gift): ?>
                                <p><span style="font-weight:bold; margin-right: 10px;">Món quà: </span><span style="font-weight:bold; color:#10a706"><?php echo $gift->gift->name; ?> </span></p>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="con-sidebar-kh">
                    <h3 class="h3-title2"> TRỢ GIÚP HỌC TẬP</h3>
                    <div class="help-block">
                        <a class="help" href="<?php echo yii::$app->urlManager->createUrl(['guide/index']) ?>"><?php echo Yii::t('header', 'text_guide') ?></a>
                        <a  class="help" href="<?php echo yii::$app->urlManager->createUrl(['guide/skype']) ?>"><?php echo Yii::t('header', 'text_skype') ?></a>
                        <a class="help" href="<?php echo yii::$app->urlManager->createUrl(['payment/index']) ?>"><?php echo Yii::t('header', 'text_payment') ?></a>
                        <a class="help" href="<?php echo yii::$app->urlManager->createUrl(['post/question']) ?>">Q & A</a>
                    </div>
                </div>
                
                <div class="con-sidebar-kh">
                    <h3 class="h3-title2">LƯU Ý</h3>
                    <div class="well_dash_rules">
                        <ul>
                            <li>
                                Người học sẽ có một buổi học test đầu vào miễn phí ngay sau khi đăng ký thành viên với E-Space Vietnam, vui lòng tiến hành chọn giáo viên (chỉ áp dụng cho giáo viên Châu Á: Philippines, India, Thailand, Vietnam,..) và giờ học theo hướng dẫn. </li>
                           <?php if($student->new_version){?>
								<li>Xin vui lòng online trước 5 phút và kiếm tra hệ thống Flatform trước khi buổi học bắt đầu. <br>
								</li>
						   <?php }else {?>
								<li>&nbsp;Giáo viên sẽ gửi "Yêu cầu kết bạn" qua Skype trước khi buổi học bắt đầu. <br>
								</li>
						   <?php }?>
						      <li>
								Thời gian đặt lịch học tối thiểu là trước 1 tiếng (60 phút) trước khi buổi học diễn ra.
							  </li>
                            <li>
                                Người học có thể hủy buổi học hai tiếng đồng hồ trước khi&nbsp; buổi học chính thức bắt đầu, nếu hủy muộn hơn sẽ không được hoàn lại buổi học.<br>
                            </li>
                            <li>
                                Người học có thể đặt trước lịch học tối đa 3 buổi học bất kỳ - đối với gói học 25 phút, và 3 buổi - đối với gói học 50 phút.
                            </li>
                            <li>
                                Người học không thể đặt trước thêm buổi học nếu như trong lịch học còn 3 buổi chưa học- đối với gói học 25 phút, và 3 buổi - đối với gói học 50 phút.   
                            </li>
                            <li>Về hạn sử dụng của các gói học:<br/>
								-Gói học 10 tiết: hạn sử dụng tối đa là 60 ngày</br>
                                -Gói học 20 tiết: hạn sử dụng tối đa là 120 ngày</br>
                                -Gói học 30 tiết: hạn sử dụng tối đa là 180 ngày.</br>
                            </li>


                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div id="myModalRating" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
    </div>
</div>
</div>
<div id="myModalViewComment" class="modal fade" role="dialog">
  <div class="modal-dialog" >
    <!-- Modal content-->
    <div class="modal-content">
    </div>
</div>
</div>
<div id="myModalNotification" class="modal fade" role="dialog">
  <div class="modal-dialog" >
    <!-- Modal content-->
    <div class="modal-content">
    </div>
</div>
</div>
<div id="myModalChangePass" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
    </div>
</div>
</div>
<div id="myModalHistory" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content" style="overflow:auto">
    </div>
</div>
</div>
<div id="myModalCropImage" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
     
    </div>
</div>
</div>


<div id="myModalConvert" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
    </div>
</div>
</div>

<div id="myModalMessage" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
    </div>
</div>
</div>
<div id="myModalRequest" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
    </div>
</div>
</div>
<style type="text/css">
    #loader {
  position: absolute;
  left: 50%;
  top: 50%;
  z-index: 1;
  width: 100px;
  height: 10px;
  margin: -75px 0 0 -75px;
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #337ab7;
  border-bottom: 16px solid #337ab7;
  width: 100px;
  height: 100px;
  -webkit-animation: spin 3s linear infinite;
  animation: spin 3s linear infinite;
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

/* Add animation to "page content" */
.animate-bottom {
  position: relative;
  -webkit-animation-name: animatebottom;
  -webkit-animation-duration: 1s;
  animation-name: animatebottom;
  animation-duration: 1s
}

@-webkit-keyframes animatebottom {
  from { bottom:-100px; opacity:0 } 
  to { bottom:0px; opacity:1 }
}

@keyframes animatebottom { 
  from{ bottom:-100px; opacity:0 } 
  to{ bottom:0; opacity:1 }
}

</style>
<div id="myModalLoading" class="modal fade" role="dialog">
  <div class="modal-dialog" style='width:100%; height:100%'>
    <!-- Modal content-->
      <div id="loader"></div>
</div>
</div>

<script>
  $(document).ready(function () {
                var coc_coc = navigator.userAgent.indexOf("coc_coc_browser");
                var wow = navigator.userAgent.indexOf("WOW64");
                
                if(coc_coc > -1){
                     $('#browser_message').html('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Thông báo * <br/> <small>Từ ngày 15/8 E-space Platform sẽ không hỗ trợ trên trình duyệt cốc cốc. Xin vui lòng chuyển qua trình duyệt Chrome hoặc Firefox để không bị ảnh hưởng khi học qua hệ thống E-space!</small><br/> Tải <a target="_blank" style="color:#2e6da4" href="https://www.google.com/chrome/">Google Chrome <i class="fa fa-download" aria-hidden="true"></i> </a></div>');
                } else if(wow > -1){
                    $('#browser_message').html('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Thông báo * <br/> <small>Bạn đang sử dụng trình duyệt phiên bản 32bit trên Windows 64bit. Vui lòng cập nhật Chrome 64bit để đảm bảo chất lượng tốt nhất khi học qua hệ thống E-space!</small><br/> Tải <a target="_blank" style="color:#2e6da4" href="https://www.google.com/chrome/">Google Chrome <i class="fa fa-download" aria-hidden="true"></i> </a></div>');
                } else {   
                    var browser=get_browser();
                    if(browser.name=="Chrome" && browser.version < 80){
                            $('#browser_message').html('<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Thông báo * <br/> <small>Trình duyệt bạn đang sử dụng là: ' + browser.name +' hoặc Cốc Cốc phiên bản ( ' + browser.version + ' ) đã cũ. Xin vui lòng cập nhập lên phiên bản mới nhất để không bị ảnh hưởng khi học qua hệ thống E-space!</small><br/> Tải <a target="_blank" style="color:#2e6da4" href="https://www.google.com/chrome/">Google Chrome <i class="fa fa-download" aria-hidden="true"></i> </a></div>');
                    }
                }
  });
function get_browser() {
    var ua=navigator.userAgent,tem,M=ua.match(/(opera|chrome|safari|firefox|msie|trident(?=\/))\/?\s*(\d+)/i) || []; 
    if(/trident/i.test(M[1])){
        tem=/\brv[ :]+(\d+)/g.exec(ua) || []; 
        return {name:'IE',version:(tem[1]||'')};
        }   
    if(M[1]==='Chrome'){
        tem=ua.match(/\bOPR|Edge\/(\d+)/)
        if(tem!=null)   {return {name:'Opera', version:tem[1]};}
        }   
    M=M[2]? [M[1], M[2]]: [navigator.appName, navigator.appVersion, '-?'];
    if((tem=ua.match(/version\/(\d+)/i))!=null) {M.splice(1,1,tem[1]);}
    return {
      name: M[0],
      version: M[1]
    };
 }
 

 
var myWindow;
	function openCall(key='') {
		
var h =screen.height;
var w = screen.width;

    	var url = "https://call.e-space.vn:8443/#/auto/" + key;
		
	
     myWindow = window.open(url, "myWindow", 'scrollbars=yes,width='+w+',height=' + h + ',top=0,left=0,fullscreen=yes');
        myWindow.document.title = 'Lớp học';
		myWindow.moveTo(0,0);
    // Puts focus on the newWindow
    if (window.focus) {
        myWindow.focus();
    }
	
	}
</script>
<script>
   
   
    
    $(document).ready(function () {

    $(document.body).on('submit', '#crop_form', function (e) {

        var frm = $(this); //just sent text

        $.ajax({
            type: frm.attr('method'),
            url: frm.attr('action'),
            dataType: 'json',
            data: frm.serialize(),
            success: function (data) {

                if (data) {

                   //do something
                }
            },
        });
        return false;
    });


});
</script>
<script>

var myWindow;
function myFunction(teacher_id,teacher_name,key_group) {
    
var h = screen.height/1.5;
var w = screen.width/1.5;
      var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : screen.left;
    var dualScreenTop = window.screenTop != undefined ? window.screenTop : screen.top;

    var width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
    var height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

    var left = ((width / 2) - (w / 2)) + dualScreenLeft;
    var top = ((height / 2) - (h / 2)) + dualScreenTop;
    
     myWindow = window.open('<?php echo yii::$app->urlManager->createUrl(['student/show-video']) ?>?teacher_id=' + teacher_id + '&teacher_name=' + teacher_name + '&key_group=' + key_group, "myWindow", 'scrollbars=yes,width='+w+',height=' + h + ',top=' + top + ',left=' + left);
        myWindow.document.title = 'Thư viện phim';
    // Puts focus on the newWindow
    if (window.focus) {
        myWindow.focus();
    }
    
}
  
</script>
<script>

var myWindow;
function myFunction1(teacher_id,teacher_name,key_group) {
    
var h = screen.height/1.5;
var w = screen.width/1.5;
      var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : screen.left;
    var dualScreenTop = window.screenTop != undefined ? window.screenTop : screen.top;

    var width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
    var height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

    var left = ((width / 2) - (w / 2)) + dualScreenLeft;
    var top = ((height / 2) - (h / 2)) + dualScreenTop;
    
     myWindow = window.open('<?php echo yii::$app->urlManager->createUrl(['student/show-video1']) ?>?teacher_id=' + teacher_id + '&teacher_name=' + teacher_name + '&key_group=' + key_group, "myWindow", 'scrollbars=yes,width='+w+',height=' + h + ',top=' + top + ',left=' + left);
        myWindow.document.title = 'Thư viện phim';
    // Puts focus on the newWindow
    if (window.focus) {
        myWindow.focus();
    }
    
}
  
</script>
<script>
      $(function () {

        $(":file").change(function () {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = imageIsLoaded;
                reader.readAsDataURL(this.files[0]);
            }
        });
    });
    function imageIsLoaded(e) {
        $('#myImg').attr('src', e.target.result);
    }
    
    </script>
<script type="text/javascript">
$(document).on('click','.btn-request', function () {
	
       $('#myModalRequest').find('.modal-content').empty();
        $.ajax({
            url: '<?php echo yii::$app->urlManager->createUrl(['student/request']) ?>',
            type: 'get',
            dataType: 'html',
			timeout: 3000, //Set your timeout value in milliseconds or 0 for unlimited
           success: function (data) {
                $('#myModalRequest').find('.modal-content').html(data);
            },
			 error: function(jqXHR, textStatus, errorThrown) {
        if(textStatus==="timeout") {  
            alert("Hết thời gian tải trang, xin hãy click lại lần nữa"); //Handle the timeout
        } else {
            alert("Mạng kết nối yếu, xin hãy thử lại"); //Handle other error type
				}
			}
        }).done(function (data) {
            $('#myModalRequest').modal('show');
			
        });

    });
       $(document).on('click', '.btn-save-request', function() {
                   if (!$.trim($("#id_content").val())) {
                              alert('Điền nội dung yêu cầu kiềm tra');
                          return;
                    }
                        var form = $('#form_request_test');
                       $('#myModalLoading').modal('show');
                   $.ajax({
                        url: '<?php echo Yii::$app->urlManager->createUrl(["student/save-request"]) ?>',
                        type: 'POST',
                        dataType: 'json',
                        data: form.serialize(),
                       // 	timeout: 3000, //Set your timeout value in milliseconds or 0 for unlimited
                      success: function (data) {
                                    html='';
                                    html+= '<div>';
                                    html+= '<div class="alert alert-success">';
                                    html+= data.message;
                                    html+= '</div>';
                                     html+= '<div style="padding: 20px;">';
                                    html+= '<p>Nội dung đã gửi:</p>';
                                    html+= '<p>Tên: ' + data.objects.name + '</p>';
                                    html+= '<p>Email: ' + data.objects.email + '</p>';
                                    html+= '<p>Điện thoại: ' + data.objects.phone + '</p>';
                                    html+= '<p>Nội dung: ' + data.objects.content + '</p>';
                                    html+= '</div>';
                                      html+= '</div>';
                                    $('#request_test').html(html);
                                    $('#myModalLoading').modal('hide');
						
                        },
                       
			
						
                        }).done(function (data) {
                            $('#myModalLoading').modal('hide');
                        }); 
 
                });
                
   $(document).on('click','.btn-crop-image', function () {
	
       $('#myModalCropImage').find('.modal-content').empty();
        $.ajax({
            url: '<?php echo yii::$app->urlManager->createUrl(['student/crop-image']) ?>',
            type: 'get',
            dataType: 'html',
			timeout: 3000, //Set your timeout value in milliseconds or 0 for unlimited
           success: function (data) {
                $('#myModalCropImage').find('.modal-content').html(data);
            },
			 error: function(jqXHR, textStatus, errorThrown) {
        if(textStatus==="timeout") {  
            alert("Hết thời gian tải trang, xin hãy click lại lần nữa"); //Handle the timeout
        } else {
            alert("Mạng kết nối yếu, xin hãy thử lại"); //Handle other error type
				}
			}
        }).done(function (data) {
            $('#myModalCropImage').modal('show');
			
        });

    });
    
   $(document).on('click','.btn-history', function () {
	
       $('#myModalHistory').find('.modal-content').empty();
        $.ajax({
            url: '<?php echo yii::$app->urlManager->createUrl(['student/history']) ?>',
            type: 'get',
            dataType: 'html',
			timeout: 3000, //Set your timeout value in milliseconds or 0 for unlimited
           success: function (data) {
                $('#myModalHistory').find('.modal-content').html(data);
            },
			 error: function(jqXHR, textStatus, errorThrown) {
        if(textStatus==="timeout") {  
            alert("Hết thời gian tải trang, xin hãy click lại lần nữa"); //Handle the timeout
        } else {
            alert("Mạng kết nối yếu, xin hãy thử lại"); //Handle other error type
				}
			}
        }).done(function (data) {
            $('#myModalHistory').modal('show');
			
        });

    });
    
    $(document).on('click', '.btn-calculate', function() {
            name = $(this).data('name');
            exchange_id =  $('input[name="exchange_id"]').val();
            $.ajax({
                        url: '<?php echo Yii::$app->urlManager->createUrl(["student/calculation"]) ?>',
                        type: 'get',
                        dataType: 'json',
                        data: {name:name, exchange_id: exchange_id},
						timeout: 3000, //Set your timeout value in milliseconds or 0 for unlimited
                        success: function (data) {
                            if(data.error){
                                alert(data.message);
                            }else{
                                if(data.objects.a_total_quantity===0){
                                     $('.a_total_quantity').html('<span style="color:red">'+ data.objects.a_total_quantity +'</span>');
                               
                            }else{
                                $('.a_total_quantity').html(data.objects.a_total_quantity);
                            }
                                $('#number').html(data.objects.number);
                                $('.b_total_quantity').html(data.objects.b_total_quantity);
                              
                            }
                           
                        },
						 error: function(jqXHR, textStatus, errorThrown) {
        if(textStatus==="timeout") {  
            alert("Hết thời gian tải trang, xin hãy click lại lần nữa"); //Handle the timeout
        } else {
           alert("Mạng kết nối yếu, xin hãy thử lại"); //Handle other error type
				}
			}
                        }).done(function (data) {
                          
                          
                        }); 
              
            
    });
     $(document).on('click', '.btn-save-convert', function() {
			 $('#myModalLoading').modal('show');
                $.ajax({
                        url: '<?php echo Yii::$app->urlManager->createUrl(["student/save-convert"]) ?>',
                        type: 'post',
                        dataType: 'json',
							timeout: 3000, //Set your timeout value in milliseconds or 0 for unlimited
                      success: function (data) {
                            if(data.error){
								   $('#myModalLoading').modal('hide');
                                alert(data.message);
                            }else{
                          html=  '<table class="table" >';
                                $.each(data.objects, function(i, v) {
                                    if (i % 2 == 0) {
                                        html += '<tr class="title-tr-xd">';
                                    } else {
                                        html += '<tr class="title-tr-xt">';
                                    }
                                    html += '<td style="width:10%; text-align: center;">' + i + '</td>';
                                    html += '<td style="width:10%; text-align: center;">' + v.package_name + '</td>';
                                    html += '<td style="width:10%; text-align: center;">' + v.special + '</td>';
                                    html += '<td style="width:10%; text-align: center;">' + v.quantity + '</td>';
                                    html += '<td style="width:10%; text-align: center;">' + v.total_quantity + '</td>';
                                    html += '<td style="width:10%; text-align: center; ">' + v.package_price + ' vnđ ' + '</td>';

                                    html += '<td style="width:10%; text-align: center; ">' + v.each_time + ' phút ' + '</td>';
                                    html += '    <td style="width:10%; text-align: center; ">' + v.status + '</td>';
                                    html += '     <td style="width:10%; text-align: center; ">' + v.expiration + '</td>';
                                    html += '    <td style="width:10%; text-align: center; ">';
									  if(v.show_status){
                                        html += '<button data-student_id="'+v.student_id+'"  data-exchange_id="'+ v.exchange_id +'" type="button" class="btn btn-xs btn-warning btn-convert"  data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Chuyển đổi gói học "' + v.text_special + '" sang "'+ v.text_special_inversion + '">Chuyển đổi</button>';
                                    }
                                    html += '    </td>';
                                  
                                    html += '</tr>';
                                });
                                html+=  '</table>';
                            }
                          $('#history-exchange-convert').html(html);
						   $('#myModalLoading').modal('hide');
                           // $('#myModalRating').find('.modal-content').html(data);
                        },
							 error: function(jqXHR, textStatus, errorThrown) {
							    $('#myModalLoading').modal('hide');
        if(textStatus==="timeout") {  
            alert("Hết thời gian tải trang, xin hãy click lại lần nữa"); //Handle the timeout
        } else {
          alert("Mạng kết nối yếu, xin hãy thử lại"); //Handle other error type
				}
			}
			
						
                        }).done(function (data) {
                            $('#myModalConvert').modal('hide');
                        }); 
              
 
                });
    $(document).on('click','.btn-convert', function () {
        var exchange_id = $(this).data('exchange_id');
         var student_id = $(this).data('student_id');
        $('#myModalConvert').find('.modal-content').empty();
        $.ajax({
            url: '<?php echo yii::$app->urlManager->createUrl(['student/convert']) ?>',
            type: 'get',
            dataType: 'html',
				timeout: 3000, //Set your timeout value in milliseconds or 0 for unlimited
            data: {exchange_id: exchange_id, student_id: student_id },
            success: function (data) {
                $('#myModalConvert').find('.modal-content').html(data);
            },
			 error: function(jqXHR, textStatus, errorThrown) {
        if(textStatus==="timeout") {  
            alert("Hết thời gian tải trang, xin hãy click lại lần nữa"); //Handle the timeout
        } else {
            alert("Mạng kết nối yếu, xin hãy thử lại"); //Handle other error type
				}
			}
        }).done(function (data) {
            $('#myModalConvert').modal('show');
        });

    });
	function strip_tags(str) {
					str = str.toString();
					return str.replace(/<\/?[^>]+>/gi, '');
				}
    $(document).on('click', '#send-rating', function() {
        
                   
					comment = strip_tags( $('textarea[name=comment]').val());
                    teacher_id = $('input[name=teacher_id]').val();
                    rating = $('input[name=rating]').val();
                    if(rating==0){
                          alert('Bạn cần chấm điểm sao cho giáo viên!');
                          return;
                    }
                    if(!comment || 0 === comment.length){
                          alert('Xin hãy điền nội dung cần đánh giá');
                          return;
                    }
                    if(!teacher_id){
                          alert('Không tồn tại giáo viên!');
                          return;
                    }
                     var form = $('#form-rating');
                   $.ajax({
                        url: '<?php echo Yii::$app->urlManager->createUrl(["student/save-rating"]) ?>',
                        type: 'post',
                        dataType: 'json',
                        data: form.serialize(),
                        success: function (data) {
                            if(data.error){
                                alert(data.message);
                            }else{
                                $('.btn-rating' + data.id).hide();
                                 alert(data.message);
                            }
                           // $('#myModalRating').find('.modal-content').html(data);
                        }
                        }).done(function (data) {
                            $('#myModalRating').modal('hide');
                        }); 
              
 
                });
    $(document).on('click','.rating', function () {
        var id = $(this).data('id');
        var teacher_id = $(this).data('teacher_id');
      //  console.log(class_id,teacher_id);
        $('#myModalRating').find('.modal-content').empty();
        $.ajax({
            url: '<?php echo Yii::$app->urlManager->createUrl(["student/rating"]) ?>',
            type: 'get',
            dataType: 'html',
            data: {teacher_id: teacher_id, id: id},
            success: function (data) {
                $('#myModalRating').find('.modal-content').html(data);
            }
        }).done(function (data) {
            $('#myModalRating').modal('show');
        });

    });
    
    $(document).on('click','.btn-notification', function () {
        var id = $(this).data('id');
        $('#myModalNotification').find('.modal-content').empty();
        $.ajax({
            url: '<?php echo yii::$app->urlManager->createUrl(['student/message']) ?>',
            type: 'get',
            dataType: 'html',
            data: {id: id},
            success: function (data) {
                $('#myModalNotification').find('.modal-content').html(data);
            }
        }).done(function (data) {
            $('#myModalNotification').modal('show');
        });

    });
    $(document).on('click','.btn-notification-close', function () {
        var id = $(this).data('id');
        $('#myModalNotification').find('.modal-content').empty();
        $.ajax({
            url: '<?php echo yii::$app->urlManager->createUrl(['student/message']) ?>?id=' + id,
            type: 'post',
            dataType: 'json',
            data: {id: id},
           success: function (data) {
                               if(data.error){
                                   alert(data.message);
                               }else{
                                html='<table class="table">';
                                       $.each(data.objects, function(i, v){
                                           if(i%2===0){
                                                html += '<tr class="title-tr-xd">';
                                           }else{
                                               html+= '<tr class="title-tr-xt">';
                                           }
                                           html+= '<td style="width:5%; text-align: center;">' + (i+1) + '</td>';
                                           html+='<td style="width:30%; text-align: center;">';
                                           html+='<a data-id="' + v.notification_id + '" class="btn-notification">' + v.title + '</a>';
                                            html+='</td>';
                                            html+='<td style="width:15%; text-align: center;">' + v.sender + '</td>';
                                            html+='<td style="width:20%; text-align: center;">' + v.created + '</td>';
                                            html+='<td style="width:15%; text-align: center;">' + v.status_text +'</td>';
                                            html+='<td style="width:15%; text-align: center;">';
                                                    if (v.status){
                                                        html+='<button data-id="' + v.notification_id + '"  class="btn btn-xs btn-danger btn-delete" style="margin-right:2px;"> Xóa </button>';
                                                        html+='<button  data-id="' + v.notification_id + '" class="btn-notification btn btn-xs btn-info"> Xem </button>';
                                                    }else{
                                                        html+='<button data-id="' + v.notification_id + '"  class="btn-notification btn btn-xs btn-info"> Xem </button>';
                                                    }
                                            html+='  </td>';
                                            html+='  </tr>';

                                      });
                                  html+='  </table>';
                                
                                 $('#notification-class').html(html);
                               }
                              
                            }
        }).done(function (data) {
            $('#myModalNotification').modal('hide');
        });

    });
    
    $(document).on('click','.btn-delete', function () {
       var id = $(this).data('id');
      bootbox.confirm({
                message: "<p style='text-align:center'>Bạn muốn xóa thông báo này?</p>",
                size: "small",    
                buttons: {
                        confirm: {
                            label: 'Có',
                            className: 'btn-primary'
                        },
                        cancel: {
                            label: 'Không',
                            className: 'btn-default'
                        }
                },
                callback: function (result) {
                     if(result){
                         $.ajax({
                            url: '<?php echo yii::$app->urlManager->createUrl(['student/delete']) ?>',
                            type: 'get',
                            dataType: 'json',
                            data: {id: id},
                            success: function (data) {
                               if(data.error){
                                   alert(data.message);
                               }else{
                                html='<table class="table">';
                                       $.each(data.objects, function(i, v){
                                           if(i%2===0){
                                                html += '<tr class="title-tr-xd">';
                                           }else{
                                               html+= '<tr class="title-tr-xt">';
                                           }
                                           html+= '<td style="width:5%; text-align: center;">' + (i+1) + '</td>';
                                           html+='<td style="width:30%; text-align: center;">';
                                           html+='<span class="notification">' + v.title + '</span>';
                                            html+='</td>';
                                            html+='<td style="width:15%; text-align: center;">' + v.sender + '</td>';
                                            html+='<td style="width:20%; text-align: center;">' + v.created + '</td>';
                                            html+='<td style="width:15%; text-align: center;">' + v.status_text +'</td>';
                                            html+='<td style="width:15%; text-align: center;">';
                                                    if (v.status){
                                                        html+='<button data-id="' + v.notification_id + '" class="btn btn-xs btn-danger btn-delete"> Xóa </button>&nbsp;';
                                                        html+='<button data-id="' + v.notification_id + '" class="btn-notification btn btn-xs btn-info"> Xem </button>';
                                                       
                                                    }else{
                                                        html+='<button data-id="' + v.notification_id + '"  class="btn-notification btn btn-xs btn-info"> Xem </button>  ';
                                                    }
                                            html+='  </td>';
                                            html+='  </tr>';

                                      });
                                  html+='  </table>';
                                
                                 $('#notification-class').html(html);
                               }
                              
                            }
                        }).done(function (data) {

                        });
                }else{
                    console.log(result);
                }
                }
            });
    });
   
    $(document).on('click','.btn-view-comment', function () {
        var id = $(this).data('id');
        $('#myModalViewComment').find('.modal-content').empty();
        $.ajax({
            url: '<?php echo yii::$app->urlManager->createUrl(['student/comment']) ?>',
            type: 'get',
            dataType: 'html',
            data: {id: id},
            success: function (data) {
                $('#myModalViewComment').find('.modal-content').html(data);
            }
        }).done(function (data) {
            $('#myModalViewComment').modal('show');
        });

    });
    $(document).on('click','.cancel',function(){
        var id = $(this).data('id');
        var name = $(this).data('name');
        var date = $(this).data('date');
        var hour = $(this).data('hour');
        $("body").on("shown.bs.modal", ".modal", function() {
            $(this).find('div.modal-dialog').css({
                'top': '50%',
                'margin-top': function () {
                        return -($(this).height() / 2);
                }
            });
            
        });
        bootbox.confirm({
                message: "<p style='text-align:center'>Bạn muốn hủy lịch học vào lúc <span style='color:red; font-weight:400;'>" + hour + "</span> ngày <span style='color:red; font-weight:400;'>"+ date +"</span> với cô <span style='color:#286090; font-weight:600;'>" + name + "</span> ?</p>",
                size: "small",    
                buttons: {
                        confirm: {
                            label: 'Có',
                            className: 'btn-primary'
                        },
                        cancel: {
                            label: 'Không',
                            className: 'btn-default'
                        }
                },
                callback: function (result) {
                          if(result){
                              $('#myModalLoading').modal('show');
                            $.post("<?php echo yii::$app->urlManager->createUrl(['student/cancel']) ?>",
                                    {id: id},
                                    function (data, status) {
                                          data=  $.parseJSON(data);
                                       if(data.error==1){
                                            alert(data.message);
											   $('#myModalLoading').modal('hide');
                                       }else{ 
                                            html='';
                                           html += '<table class="table">';
												$.each(data.objects.history_success, function (i, v) {
													if(i%2==0){
                                                        html+='<tr class="title-tr-xd">';
                                                    }else{
                                                        html+='<tr class="title-tr-xt">';
                                                    }
                                                        html+='<td style="width: 5%">' + (i+1) + '</td>';
                                                        html+='<td style="width:15%">' + v.date + '</td>';
                                                        html+='<td style="width:15%">' + v.hour + '</td>';
                                                        html+='<td style="width:25%"><i style="color:red" class="fa fa-chevron-circle-right" aria-hidden="true"></i>&nbsp;<a style="color:blue;" class="booking-tooltip" href="'+ v.href +'"  data-toggle="tooltip" data-placement="bottom"  title="Click vào đây để vào đặt lịch học với giáo viên ' + v.teacher_name + '">' + v.teacher_name + '</a></td>';
                                                        html+='<td style="width:15%">';
                                                    if(v.status == <?php echo ClassStudent::STATUS_DEACTIVE ?>){
                                                        if(v.text_status){
                                                            html+= '<span class="label label-success"><?php echo ClassStudent::getTextStatus(ClassStudent::STATUS_ACTIVE); ?></span>';
                                                        }else{
                                                            html+= '<span class="label label-default"><?php echo ClassStudent::getTextStatus(ClassStudent::STATUS_DEACTIVE); ?></span>';
                                                        }
                                                    }
                                                    if (v.status == <?php echo ClassStudent::STATUS_ACTIVE ?>){    
                                                            html+= '<span class="label label-success"><?php echo ClassStudent::getTextStatus(ClassStudent::STATUS_ACTIVE); ?></span>';
                                                    }
                                                    if (v.status == <?php echo ClassStudent::STATUS_CANCEL ?>){   
                                                        html+='<span class="label label-danger"><?php echo ClassStudent::getTextStatus(ClassStudent::STATUS_CANCEL); ?></span>';
                                                    }
                                                    if (v.status == <?php echo ClassStudent::STATUS_RESTORE ?>){   
                                                       html+='<span class="label label-warning"><?php echo ClassStudent::getTextStatus(ClassStudent::STATUS_RESTORE); ?></span>';
                                                   }
                                                    if (v.status == <?php echo ClassStudent::STATUS_NOLEAN; ?>){
                                                         html+='<span class="label label-info"><?php echo ClassStudent::getTextStatus(ClassStudent::STATUS_NOLEAN); ?></span>';
                                                     }
                                                     if (v.status ==  <?php echo ClassStudent::STATUS_NOTEACH; ?>){   
                                                            html+='<span class="label label-primary"><?php echo ClassStudent::getTextStatus(ClassStudent::STATUS_NOTEACH); ?></span>';
                                                    }
                                                    html+='</td>';
                                                    html+='<td style="width:25%">';
                                                   if(v.status == <?php echo ClassStudent::STATUS_DEACTIVE ?>){
                                                                if (v.admin){
                                                                       html += '<button  style="font-size:75%;" data-id="'+ v.id +'" data-name="'+ v.teacher_name +'" data-hour="'+ v.hour +'" data-date="'+ v.date +'" data-toggle="tooltip" data-placement="bottom" title="Click vào đây để hủy buổi học với giáo viên" class="btn btn-xs btn-danger cancel cancel-tooltip"><span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span> <?php echo Yii::t('account', 'cancel') ?></button>';
                                                                  
                                                                }else{
                                                                    if (v.button_status){
                                                                        html += '<button  style="font-size:75%;" data-id="'+ v.id +'" data-name="'+ v.teacher_name +'" data-hour="'+ v.hour +'" data-date="'+ v.date +'" data-toggle="tooltip" data-placement="bottom" title="Click vào đây để hủy buổi học với giáo viên" class="btn btn-xs btn-danger cancel cancel-tooltip"><span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span> <?php echo Yii::t('account', 'cancel') ?></button>';
                                                                    }
                                                               }
																if (v.text_status){
																	if (v.new_version) { 
                                                                        html += '<button data-toggle="tooltip" data-placement="bottom" title="Click vào đây để xem lại bài học đã học với giáo viên '+ v.teacher_name +'" style="font-size:75%; margin-top:0px; margin-right: 3px;" class="btn btn-success btn-xs view-tooltip" onclick="myFunction(' + v.teacher_id + ',\'' + v.teacher_name + '\','+ v.key_group + ')"><i class="fa fa-camera" aria-hidden="true"></i> Xem</button>';
																	}
                                                                    if (v.rate){
                                                                        if (v.rating_status == <?php echo \common\models\Student::rated; ?>){
                                                                                html += '<button   style="font-size:75%" class="btn btn-info btn-xs"  disabled="disabled"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Đã đánh giá</button>';
                                                                        }else{
                                                                             html += '<button data-id="' + v.class_id + '" data-teacher_id="' + v.teacher_id + '" style="font-size:75%" data-toggle="tooltip"  data-placement="bottom" title="Click vào đây để gửi nhận xét/ cảm nhận/ đánh giá/... sau buổi học với với giáo viên '+v.teacher_name+'"  class="btn btn-info btn-xs rating rate-tooltip"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Đánh giá</button>';
                                                                               
                                                                        }
                                                                    }
                                                                }
                                                             
                                                            html+='</td>';
                                                            html+='</tr>';
                                               }
                                                });
											
                                            $('#history_success').html(html);
											
											html='';
                                            html+='<table class="table">';
											$.each(data.objects.history_cancel, function (i, v) {
												
                                                 if(i%2==0){
                                                        html+='<tr class="title-tr-xd">';
                                                    }else{
                                                        html+='<tr class="title-tr-xt">';
                                                    }
                                                        html+='<td style="width:5%">' + (i+1) + '</td>';
                                                        html+='<td style="width:15%">' + v.date + '</td>';
                                                        html+='<td style="width:15%">' + v.hour + '</td>';
                                                        html+='<td style="width:25%"><i style="color:red" class="fa fa-chevron-circle-right" aria-hidden="true"></i>&nbsp;<a style="color:blue;" class="booking-tooltip" href="'+ v.href +'"  data-toggle="tooltip" data-placement="bottom"  title="Click vào đây để vào đặt lịch học với giáo viên ' + v.teacher_name + '">' + v.teacher_name + '</a></td>';
                                                        html+='<td style="width:15%">';
														if (v.status == <?php echo ClassStudent::STATUS_CANCEL ?>){   
															html+='<span class="label label-danger">'+ v.cancel_text +'</span>';
														}
                                                  
                                                    html+='</td>';
                                                    html+='<td style="width:25%">';
													html+='</td>';
                                                    html+='</tr>';
													
                                                });
												 
                                            html+='</table>';
											$('#history_cancel').html(html);
											
                                            html='';
                                            html+='<table class="table">';
                                             $.each(data.objects.next_class, function (i, v) {
                                                 
                                                  if(i%2==0){
                                                        html+='<tr class="title-tr-xd">';
                                                    }else{
                                                        html+='<tr class="title-tr-xt">';
                                                    }
                                                        html+='<td style="width: 5%">' + (i+1) + '</td>';
                                                        html+='<td style="width:15%">' + v.date + '</td>';
                                                        html+='<td style="width:15%">' + v.hour + '</td>';
                                                        html+='<td style="width:25%">' + v.teacher_name + '</td>';
                                                        html+='<td style="width:15%">';
                                                    if(v.status == <?php echo ClassStudent::STATUS_DEACTIVE ?>){
                                                        if(v.text_status){
                                                            html+= '<span class="label label-success"><?php echo ClassStudent::getTextStatus(ClassStudent::STATUS_ACTIVE); ?></span>';
                                                        }else{
                                                            html+= '<span class="label label-default"><?php echo ClassStudent::getTextStatus(ClassStudent::STATUS_DEACTIVE); ?></span>';
                                                        }
                                                    }
                                                    if (v.status == <?php echo ClassStudent::STATUS_ACTIVE ?>){    
                                                            html+= '<span class="label label-success"><?php echo ClassStudent::getTextStatus(ClassStudent::STATUS_ACTIVE); ?></span>';
                                                    }
                                                    if (v.status == <?php echo ClassStudent::STATUS_CANCEL ?>){   
                                                        html+='<span class="label label-danger"><?php echo ClassStudent::getTextStatus(ClassStudent::STATUS_CANCEL); ?></span>';
                                                    }
                                                    if (v.status == <?php echo ClassStudent::STATUS_RESTORE ?>){   
                                                       html+='<span class="label label-warning"><?php echo ClassStudent::getTextStatus(ClassStudent::STATUS_RESTORE); ?></span>';
                                                   }
                                                    if (v.status == <?php echo ClassStudent::STATUS_NOLEAN; ?>){
                                                         html+='<span class="label label-info"><?php echo ClassStudent::getTextStatus(ClassStudent::STATUS_NOLEAN); ?></span>';
                                                     }
                                                     if (v.status ==  <?php echo ClassStudent::STATUS_NOTEACH; ?>){   
                                                            html+='<span class="label label-primary"><?php echo ClassStudent::getTextStatus(ClassStudent::STATUS_NOTEACH); ?></span>';
                                                    }
                                                    html+='</td>';
                                                    html+='<td style="width:25%">';
													if (v.new_version==true){
														if(v.join==true){
																		html+='<a data-toggle="tooltip" onClick="openCall('+ v.key + ')" data-placement="bottom" title="Click vào đây để tham gia học với giáo viên '+ v.teacher_name +'" class="join-tooltip btn btn-primary btn-xs" style="font-weight: bold;">';
																		html+='Tham gia';
																		html+='</a>';
														}else{
																		html+='<a target="_blank" onClick="openCall('+ v.key + ')" class="btn btn-default btn-xs" style="font-weight: bold;">';
																		html+='	Tham gia';
																		html+='</a>	';
																	}
													}else{
														 html+=' <span class="skype-button rounded textonly" data-text="' + v.teacher_name + '" data-contact-id="' + v.skype + '"></span>';
													}
                                                    html+='</td>';
                                                    html+='</tr>';
                                               
                                                });
                                                  html+='</table>';
                                                  $('#next-class').html(html);
                                                  $('[data-toggle="tooltip"]').tooltip();
												  $('#myModalLoading').modal('hide');
                                       
                                           //
                                       }
                                         ///
                                     }
                                );
						 
                    }else{
                        console.log('This was logged in the callback: ' + result);
                    }
                }
     });
});
  
  
  
</script>
<script>
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>  

<script>
    var OSName = "Unknown";
    var show=0;
if (window.navigator.userAgent.indexOf("Windows NT 10.0")!= -1) 
{
    OSName="Windows 10";
     show=1;
     
}
if (window.navigator.userAgent.indexOf("Windows NT 6.3") != -1) {
    OSName="Windows 8";
    show=1;
    }

if (window.navigator.userAgent.indexOf("Windows NT 6.2") != -1) {
    OSName="Windows 8";
    show=1;
    }
if (window.navigator.userAgent.indexOf("Windows NT 6.1") != -1){
    OSName="Windows 7";
    show=1;
    }
if (window.navigator.userAgent.indexOf("Windows NT 6.0") != -1){
    OSName="Windows Vista";
    show=1;
    }
if (window.navigator.userAgent.indexOf("Windows NT 5.1") != -1){
    OSName="Windows XP";
    show=1;
    }
if (window.navigator.userAgent.indexOf("Windows NT 5.0") != -1){
    OSName="Windows 2000";
    show=1;
    }
if (window.navigator.userAgent.indexOf("Mac")            != -1) {
    OSName="Mac/iOS";
    }
if (window.navigator.userAgent.indexOf("X11")            != -1){
    OSName="UNIX";
    }
if (window.navigator.userAgent.indexOf("Linux")          != -1){
    OSName="Linux";
}
if(show!=1){
    document.getElementById('app-window').style.visibility = "hidden";
}

function openWhiteBoard(wbroom) {
		 var url ="https://video.e-space.vn/whiteboard/whiteboard_student.html?room=" + wbroom;
		 var size = '"width=' + window.innerWidth + 'px, ' + 'height=' + window.innerHeight + 'px"';
		 var win=	window.open(url, "", size);
		 win.focus();
}
</script>






