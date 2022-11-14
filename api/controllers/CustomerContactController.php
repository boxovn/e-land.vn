<?php

namespace api\controllers;
use yii;
use common\models\CustomerContact;
class CustomerContactController extends AppController {
    
   public $modelClass = CustomerContact::class;
   public function actions(){
       $actions = parent::actions();
       // disable the "delete" and "create" actions
       unset($actions['delete'],$actions['create']);
      // customize the data provider preparation with the "prepareDataProvider()" method
        $actions['index']['prepareDataProvider'] =  [$this, 'prepareDataProvider'];
       // $actions['view']['findModel'] =  [$this, 'findModel'];
        return $actions;
}
public function prepareDataProvider()
{
         return new \yii\data\ActiveDataProvider([
            'query' => CustomerContact::find(),
            ]);
}
public function actionCreate(){
     $customerContact = new CustomerContact();
     if (yii::$app->request->isPost) {
         
            $customerContact = new CustomerContact();
            $customerContact->attributes =  yii::$app->request->post();
            $customerContact->customer_id = $this->customer_id;
			$customerContact->save();
        }
        return  $customerContact;
    }
    
 
}