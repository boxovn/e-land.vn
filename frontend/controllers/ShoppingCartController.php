<?php
namespace frontend\controllers;
use Yii;
use common\models\Product;
use common\models\Delivery;
use common\models\Payment;
use common\models\Order;
use common\models\OrderDetail;
use common\libraries\Cart;
use common\libraries\SendMail;
use yii\web\Controller;
use yii\filters\AccessControl;
class ShoppingCartController extends AppController {
	
    /**
     * 
     * @return type
     */
/*
	public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['order','cart'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['cart'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['order'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
	}*/
    public function beforeAction($action) {
        parent::beforeAction($action);
        $this->layout = 'layout_product';
        return true;
    }

public function actionGetAddress() {
      $this->layout = false;
      $user = \Yii::$app->user->identity;
      $error= false;
       $messages='';
     /* $user = User::findOne(['id' =>\yii::$app->request->get('id')]);
      if($user){
        $user = new User();
      }*/
      if(Yii::$app->request->isPost){

          if($user->load(Yii::$app->request->post())){
               $user->save();
           } else {
                  // validation failed: $errors is an array containing error messages
                    $errors =  $user->errors;
                    foreach ($user->getErrors () as $attribute => $error)
                    {

                          foreach ($error as $message)

                          {

                            $messages .= $message . '<br/>';

                          }

                    }
                }
              return  \yii\helpers\Json::encode(['errors' => $messages, 'user' => $user]);
      
          }
        
      return $this->render('get_address',['error' => $error,'user' => $user, 'title' => 'Thông tin người nhận hàng']);
  }

 

public function actionSuccess(){

  
}
public function actionUpdate(){
    $user = \Yii::$app->user->identity;
        if($user->load(Yii::$app->request->post()) && $user->save()){
                  Yii::$app->getResponse()->redirect(['shopping-cart/cart']);
                  Yii::$app->end();
        }
       
              // DISPLAY AS MODAL
              return $this->render('get_address', ['user' =>  $user,  'title' => 'Thông tin người nhận hàng']);
    //return $this->asJson(['user' =>  $user,  'title' => 'Thông tin người nhận hàng']);
}
    public function actionIndex() {
          return $this->render('index');
            
    }
     public function actionAddCart() {
       
        $param = \yii::$app->request->get();
        $cart= new Cart();
        $total_price =0;
        $total_amount=0;
        $carts= array();
        if($cart->addCart($param)){
            if (\yii::$app->session->has('cart')) {
                $carts =\yii::$app->session->get('cart');
                foreach($carts as $key => $value){ 
                    $total_price +=   $value['amount'] * ($value['price'] + ($value['price']*($value['discount']/100)));
                    $total_amount +=  $value['amount'];

                }

              }
        }
        $data = [
                  'total_price' => number_format($total_price, 0, '', ',') . 'đ', 
                 // 'carts' => $carts, 
                  'total_amount' => $total_amount,
                ]; 
        return $this->asJson( $data );
         
     }
      /**
     * 
     */
     /**
     * 
     */
    public function actionConfirm() {
   
      if (\yii::$app->session->has('cart')) {
          $cart =\yii::$app->session->get('cart');
          if ($cart) {
              \yii::$app->session->remove('cart');
              return $this->render('confirm');
          }
      }
      Yii::$app->getResponse()->redirect(['business-book/index']);
      Yii::$app->end();
  }
  
    public function actionCart() {
		$session = \yii::$app->session;
		$carts= array();
		if($session->has('cart')){
			$carts =Yii::$app->session->get('cart');
			
		}else{
			Yii::$app->session->setFlash('danger', "Không có sản phẩm trong giỏ hàng");
		}
       
		
         return $this->render('cart',['carts' => $carts]);
      }
      public function actionOrder() {
        $user = \Yii::$app->user->identity;
        $orders = Order::find()->andWhere(['user_id' => isset($user)?$user->id:0])->all();
     // echo '<prE>'; var_dump($orders);
       return $this->render('order',['orders' => $orders]);
     }
    public function actionUpdateCart() {
            $this->layout = 'layout_product';
            $param = \yii::$app->request->get();
            $cart= new Cart();
            $cart->updateCart($param);
            $carts =Yii::$app->session->get('cart');
            return $this->renderPartial('cart',['carts' => $carts]);
    }
    public function actionCheckout(){
      $session = Yii::$app->session;
      if($session->has('cart')){
                      $carts = Yii::$app->session->get('cart');
                      $deliveries = Delivery::find()->andWhere(['status' => 1])->all();
                      $payments = Payment::find()->andWhere(['status' => 1])->all();
                    
                      $order = new Order();
                      $total_price =0;
                      foreach($carts as $key => $value){ 
                          $total_price +=  $value['total_real_price'];
                      }
                      $order->total = $total_price;
                      $order->status= 1;
                      $order->user_id = 0;
                      $user = \Yii::$app->user->identity;
                      if($user){
                          $order->user_id= $user->id;
                          $order->user_name= $user->name;
                          $order->user_email= $user->email;
                          $order->user_phone= $user->phone;
                          $order->user_address= $user->address;
                        
                      }
                    
                        $payment =  Payment::find()->andWhere(['status' => 1,'id' =>  $order->payment_id? $order->payment_id:1])->one();
                        $delivery =  Delivery::find()->andWhere(['status' => 1,'id' =>  $order->delivery_id? $order->delivery_id:1])->one();
                 
                              if($order->load(Yii::$app->request->post()))
                              {
                              
                               
                                $order->payment_price = $payment->price;
                                $order->delivery_price =   $delivery->price;
                               
                                if($order->save()){
                                  $total_price =0;
                                 foreach($carts as $key => $value){
                                    $total_price +=  $value['amount']*($value['price'] + ($value['price']*($value['discount']/100)));
                                      $orderDetail = new OrderDetail();
                                      $orderDetail->order_id = $order->getPrimaryKey();
                                      $orderDetail->product_id = $key; 
                                      $orderDetail->product_price = $value['price'];
                                      $orderDetail->product_amount = $value['amount'];
                                      $orderDetail->product_discount =  $value['discount'];
                                      
                                      $orderDetail->save();
                                  }
                                  
                                        
                                          $sendMail = SendMail::sendMailOrder($order,$order->orderDetails);
                                          Yii::$app->session->setFlash('success', "Đặt mua hàng thành công");
                                          Yii::$app->getResponse()->redirect(['shopping-cart/confirm','order' => $order,'orderDetails' => $order->orderDetails]);
                                          Yii::$app->end();
                                    
                                  
                                }

                              }
                      return $this->render('checkout',[
                                            'carts' => $carts,
                                            'deliveries' =>  $deliveries,
                                            'payments' => $payments,
                                            'delivery' =>  $delivery,
                                            'payment' => $payment,
                                            'order' => $order
                                            ]);
         }
         Yii::$app->session->setFlash('danger', "Không có sản phẩm trong giỏ hàng");
         Yii::$app->getResponse()->redirect(['shopping-cart/cart']);
         Yii::$app->end();
        
        }
    
      
    
}