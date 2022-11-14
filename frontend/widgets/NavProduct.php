<?php
namespace frontend\widgets;
use yii;
use yii\base\Widget;
use yii\helpers\ArrayHelper;
use common\models\Province;
use common\models\Order;
//use frontend\models\Search;
class NavProduct extends Widget {
    public function init() {
        parent::init();
    }
    
    public function run() {
		$session =Yii::$app->session;
		$carts = array();
		$total_price =0;
		$total_amount = 0;
		$user = \Yii::$app->user->identity;
		if($session->has('cart')){
			$carts = $session->get('cart');
			
			foreach($carts as $key => $value){ 
				$total_price +=  $value['total_real_price'];
				$total_amount +=  $value['amount'];
			}
		}
		$totalOrder = Order::find()->andWhere(['user_id' => isset($user)?$user->id:0])->count();

		return $this->render('nav_product',[ 'carts' => $carts, 'total_price' => $total_price, 'totalItem' =>  $total_amount, 'totalOrder' => $totalOrder]);
    }

}