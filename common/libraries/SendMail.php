<?php
namespace common\libraries;
use common\models\Product;
use Yii;
class SendMail{
  static  function sendMailOrder($order,$orderDetail){
        $result =  \Yii::$app->mailer->compose(['html' => 'comfirm-order-html'], ['order' => $order,'orderDetail' => $orderDetail])
            ->setFrom([\Yii::$app->params['supportEmail'] => 'E-Books'])
            ->setTo($order->user_email)
            ->setSubject('Xác nhận đặt đơn hàng thành công')
            ->send();

        return $result;

    }
}
?>