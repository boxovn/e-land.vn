<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['index/reset-password', 'token' => $user->password_reset_token]);

if (strpos($resetLink, '/api/web') !== false) {
    $resetLink = str_replace('/api/web','',$resetLink);
}

?>
<style>
		.head{
			
		}
</style>
<div class="password-reset" style="padding: 40px;text-align: center;">
			<div> 
			<img style="width:150px" src="https://e-land.vn/e-land/img/logo.png" />
		</div>
</div>	
<div>
    <p>Chào <?php echo Html::encode($user->name) ?>,</p>
	<p> Bạn đang yêu cầu thay đổi mật khẩu tài khoản</p>
    <p>Để hệ thống cấp lại mật khẩu. Vui lòng click vào link bên dưới để lấy lại mật khẩu của bạn:</p>

    <p><?php echo  Html::a('Xác nhận yêu cầu cấp lại mật khẩu', $resetLink) ?></p>
	 <p>Mọi thắc mắc xin vui lòng liên hệ hòm mail cskh@batdongsaneland.com để được hỗ trợ và giải đáp.</p>
	 <p>Chúc các bạn có những trải nghiệm thú vị cùng Eland.</p>
	 <p>
		Nếu bạn gặp khó khăn, hãy liên hệ: <br/>
        Hotline  (035-9696-234)<br/>
        Email: support@batdongsaneland.com
    </p>
	<p> Trân trọng!</p>
	
</div>
</div>
