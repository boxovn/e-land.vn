<?php

namespace api\controllers;
use yii;
use common\models\CustomerInfo;
use api\models\UploadLogo;
use yii\web\UploadedFile;
class CustomerInfoController extends AppController {
    public $modelClass = CustomerInfo::class;
   public function actions(){
       $actions = parent::actions();
       // disable the "delete" and "create" actions
       unset($actions['delete'], $actions['create']);
      // customize the data provider preparation with the "prepareDataProvider()" method
        $actions['index']['prepareDataProvider'] =  [$this, 'prepareDataProvider'];
       // $actions['view']['findModel'] =  [$this, 'findModel'];
        return $actions;
}
public function prepareDataProvider()
{
          return new \yii\data\ActiveDataProvider([
            'query' => CustomerInfo::find()->andWhere(['customer_id' =>  $this->customer_id]),

            ]);
}
 public function actionUploadLogo(){
        $model = new UploadLogo();
        if (Yii::$app->request->isPost) {
        $model->logo = UploadedFile::getInstanceByName('logo');
         //   $model->logo = UploadedFile::getInstance($model,'logo');
            if ($model->upload()) {
                
                $customer=  CustomerInfo::findOne(['customer_id' =>  $this->customer_id]);
                $customer->logo =  $model->logo->name;
                $customer->save(false);
                // file is uploaded successfully
                return $customer;
            }
        }

        return $model ;
    }
}

	