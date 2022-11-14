<?php
namespace common\libraries;
use common\models\Product;
use Yii;
class Cart{
    function addCart($param){
            $id = $param['id'];
            $amount = $param['amount']? $param['amount']:1;
          
            $dataProduct =  Product::find()->where('id=:id',['id' => $id])->one();
            if( $dataProduct){
                $session = Yii::$app->session;
                if(!$session->has('cart')){
                    $cart[$id] =[
                        'id' =>  $dataProduct->id,
                        'name' =>  $dataProduct->name,
                        'image' =>   $dataProduct->image,
                        'price' =>  $dataProduct->price,
                        'author' =>  $dataProduct->author,
                        'slug'  =>   $dataProduct->slug,
                        'discount'  =>  $dataProduct->discount,
                        'real_price' => $dataProduct->price * ($dataProduct->discount/100),
                        'total_real_price' => ($dataProduct->price * ($dataProduct->discount/100)) * $amount,
                        'amount' =>  $amount,
                        ];
                }else{
                 $cart= $session->get('cart');
                if(array_key_exists($id,$cart)){
                    $cart[$id] =[
                        'id' =>  $dataProduct->id,
                        'name' =>  $dataProduct->name,
                        'image' =>   $dataProduct->image,
                        'price' =>  $dataProduct->price,
                        'author' =>  $dataProduct->author,
                        'slug'  =>   $dataProduct->slug,
                        'discount'  =>   $dataProduct->discount,
                        'real_price' => $dataProduct->price * ($dataProduct->discount/100),
                        'total_real_price' => ($dataProduct->price * ($dataProduct->discount/100)) * ($cart[$id]['amount']+$amount),
                        'amount' => $cart[$id]['amount']+ $amount,
                ];
               }else{
                   $cart[$id] =[
                       'id' =>  $dataProduct->id,
                        'name' =>  $dataProduct->name,
                        'image' =>   $dataProduct->image,
                        'author' =>  $dataProduct->author,
                        'slug'  =>   $dataProduct->slug,
                        'price' =>  $dataProduct->price,
                        'discount'  =>  $dataProduct->discount,
                        'real_price' => $dataProduct->price * ($dataProduct->discount/100),
                        'total_real_price' => ($dataProduct->price * ($dataProduct->discount/100)) * $amount,
                        'amount' =>  $amount,
                          
                    ];
               }
           }
          $session->set('cart',$cart);
          return true;
        }else{
            return false;
        }
            
    }


    function updateCart($param){
            $id = $param['id'];
            $amount = $param['amount']? $param['amount']:0;
           
            $session = Yii::$app->session;

            if($session->has('cart')){
                    $cart= $session->get('cart');
                        if(array_key_exists($id,$cart)){
                        if($amount){
                                    $cart[$id] =[
                                        'id' =>  $cart[$id]['id'],
                                        'name' =>  $cart[$id]['name'], 
                                        'image' =>  $cart[$id]['image'], 
                                        'author' =>  $cart[$id]['author'],
                                        'slug'  =>   $cart[$id]['slug'],
                                        'price' => $cart[$id]['price'],
                                        'discount'  =>   $cart[$id]['discount'],
                                        'real_price' => $cart[$id]['price'] * ($cart[$id]['discount']/100),
                                        'total_real_price' => ($cart[$id]['price'] * ($cart[$id]['discount']/100)) * $amount,
                                        'amount' => $amount,
                                ];
                            }else{
                                
                                unset($cart[$id]);
                            }
                        }
                    $session->set('cart',$cart);
            }
    }
    
}
?>