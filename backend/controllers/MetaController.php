<?php

namespace backend\controllers;


use Yii;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;
use backend\models\MetaSearch;
use common\models\Meta;

class MetaController extends AppController {
    public $title = 'Quản lý meta lớp học mẫu';
    
    public function actionIndex() {
        $this->getView()->title = $this->title;
        
        $metaSearch = new MetaSearch();
        $dataProvider = $metaSearch->search(\Yii::$app->request->get());
        return $this->render('index',['dataProvider'=>$dataProvider,'metaSearch' => $metaSearch]);
    }
    
    public function actionAdd($id = 0) {
        $this->getView()->title = $this->title;
        $model = new Meta();
        
        if($id) {
           $model = Meta::find()->andWhere(['meta_id'=>$id])->one();
            if (!$model) {
                Yii::$app->session->setFlash('error', "Tập tin không tồn tại ");
                Yii::$app->getResponse()->redirect(['meta/index']);
                Yii::$app->end();
            }
        }        
        if(Yii::$app->request->isPost) {
               $model->attributes = Yii::$app->request->post('Meta');
                $model->created= date('Y-m-d H:i');
                if($model->save()) {
                Yii::$app->session->setFlash('success', "Thông tin tập tin đã được luu ");
                Yii::$app->getResponse()->redirect(['meta/index']);
                Yii::$app->end();
            }
        }
        
        return $this->render('add',['model'=>$model]);
    }
    
     /**
     * 
     */
    public function actionDelete($id = 0) {
        $this->getView()->title = "Quản lý học viên";
        $model = Meta::findOne(['meta_id' => $id]);
        if (!$model) {
            Yii::$app->session->setFlash('error', "Meta lớp học mẫu không tồn tại");
            Yii::$app->getResponse()->redirect(['meta/index']);
            Yii::$app->end();
        }
        $model->delete(false);
        Yii::$app->session->setFlash('success', "Meta lớp học mẫu đã được xóa");
        Yii::$app->getResponse()->redirect(['meta/index']);
        Yii::$app->end();
    }
   
}