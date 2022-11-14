<?php

namespace backend\controllers;


use Yii;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;
use backend\models\CategorySearch;
use common\models\Category;

class CategoryController extends AppController {
    public $title = 'Quản lý danh mục tòa nhà';
    
    public function actionIndex() {
        $this->getView()->title = $this->title;
        
        $categorySearch = new CategorySearch();
        $dataProvider = $categorySearch->search(\Yii::$app->request->get());
        return $this->render('index',['dataProvider'=>$dataProvider,'categorySearch' => $categorySearch]);
    }
	
    
    public function actionAdd($id = 0) {
        $this->getView()->title = $this->title;
        $model = new Category();
        
        if($id) {
           $model = Category::find()->andWhere(['id'=>$id])->one();
            if (!$model) {
                Yii::$app->session->setFlash('error', "Danh mục không tồn tại");
                Yii::$app->getResponse()->redirect(['category/index']);
                Yii::$app->end();
            }
        }        
        if(Yii::$app->request->isPost) {
               $model->attributes = Yii::$app->request->post('Category');
             
                if($model->save()) {
                Yii::$app->session->setFlash('success', "Danh mục không được lưu");
                Yii::$app->getResponse()->redirect(['category/index']);
                Yii::$app->end();
            }
        }
        
        return $this->render('add',['model'=>$model]);
    }
    
     /**
     * 
     */
    public function actionDelete($id = 0) {
        $this->getView()->title = "Quản lý danh mục";
        $model = Category::findOne(['id' => $id]);
        if (!$model) {
            Yii::$app->session->setFlash('error', "Danh mục lớp học mẫu không tồn tại");
            Yii::$app->getResponse()->redirect(['category/index']);
            Yii::$app->end();
        }
        $model->delete(false);
        Yii::$app->session->setFlash('success', "Danh mục đã được xóa");
        Yii::$app->getResponse()->redirect(['category/index']);
        Yii::$app->end();
    }
	 public function actionChecked() {
        if (Yii::$app->request->isPost) {
            $id = Yii::$app->request->post('id');
            $status = Yii::$app->request->post('status');
            $model = Category::find()->andWhere(['id' => $id])->one();
            $model->status = $status;
			if ($model->save(false)) {
                $data = [
                    'id' => $model->id,
					'status' => (int) $model->status,
                    'text' => Category::getStatus()[$model->status],
                    'message' => "Cập nhập thành công"
                ];
                return \yii\helpers\Json::encode($data);
            }
        }
    }
   
}