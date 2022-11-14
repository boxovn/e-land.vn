<?php

namespace backend\controllers;


use Yii;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;
use backend\models\BuyerSearch;
use common\models\Buyer;

class BuyerController extends AppController {
    public $title = 'Quản lý Buyer lớp học mẫu';
    
    public function actionIndex() {
        $this->getView()->title = $this->title;
        
        $buyerSearch = new BuyerSearch();
        $dataProvider = $buyerSearch->search(\Yii::$app->request->get());
        return $this->render('index',['dataProvider'=>$dataProvider,'buyerSearch' => $buyerSearch]);
    }
    
    public function actionEdit($id = 0) {
        $this->getView()->title = $this->title;
		$model = Buyer::find()->andWhere(['id'=>$id])->one();
		 if (!$model) {
               $model = new Buyer();
            }
			if(Yii::$app->request->isPost) {
               $model->attributes = Yii::$app->request->post('Buyer');
                $model->created= date('Y-m-d H:i');
                if($model->save()) {
                Yii::$app->session->setFlash('success', "Thông tin tập tin đã được luu ");
                Yii::$app->getResponse()->redirect(['buyer/index']);
                Yii::$app->end();
            }
        }
        
        return $this->render('edit',['model'=>$model]);
    }
    
     /**
     * 
     */
    public function actionDelete($id = 0) {
        $this->getView()->title = "Quản lý học viên";
        $model = Buyer::findOne(['id' => $id]);
        if (!$model) {
            Yii::$app->session->setFlash('error', "Buyer lớp học mẫu không tồn tại");
            Yii::$app->getResponse()->redirect(['buyer/index']);
            Yii::$app->end();
        }
        $model->delete(false);
        Yii::$app->session->setFlash('success', "buyer lớp học mẫu đã được xóa");
        Yii::$app->getResponse()->redirect(['buyer/index']);
        Yii::$app->end();
    }
   
}