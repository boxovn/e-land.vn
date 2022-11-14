<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['index/success', 'token' => $user->password_reset_token]);
?>
<div class="password-reset" style="padding: 40px;">
    <div  style="-webkit-box-shadow: 0 0px 13px rgba(0,0,0,0.06); box-shadow: 0 0px 13px rgba(0,0,0,0.06);
             -webkit-box-flex: 0;
            
             float: left;
             width:100%;">
        <div style="width:30%; float:left"> 
            <img style="height:150px" src="https://batdongsaneland.com/images/e-land.jpg" />
        </div>
        <div style="width:70%; float:left">
                <h3>Thông báo từ kênh rao bán bất động sản Eland</h3>
        </div> 
</div>  
<div style="float:left: widht: 100%">
    <p>Xin chào, <?php echo Html::encode($user->name) ?>!</p>

    <p>Cảm ơn bạn đã đăng ký làm thành viên tại Eland</p>
	<p>Để kích hoạt tài khoản, bạn vui lòng kích vào đường dẫn dưới đây</p>
    <p><?php echo Html::a(Html::encode($resetLink), $resetLink) ?></p>
   
    <p>
        <a href="<?php echo Yii::$app->getUrlManager()->createUrl('index')?>">Bat động sản Eland</a> là kênh rao bán, cho thuê, trao đổi các sản phẩm về bất động sản tốt nhất hiện nay. Eland luôn cố gắn tạo ra môt sản phẩm để kết nối giữa khách hàng với nhà mô giới, nhà đầu, người có nhu cầu mua bán, cho thuê bất động sản một cách hiệu quả.
		Mang đến một công cụ hỗ trợ tương tác, trao đổi tối đa và dễ dàng nhất.
		<br/>
		Nếu bạn gặp khó khăn, hãy liên hệ: <br/>
        Hotline  (035-9696-234)<br/>
        Email: support@batdongsaneland.com
    </p>
    <p>Trân trọng!</p>
</div>
</div>
