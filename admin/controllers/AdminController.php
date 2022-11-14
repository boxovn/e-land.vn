<?php

namespace backend\controllers;

use Yii;
use yii\helpers\Json;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use common\models\Admin;
use admin\models\AdminSearch;

class AdminController extends AppController
{
    /**
     * Display admin user list
     *
     * @return string
     */
    public function actionIndex()
    {
    	$username = isset($objectData['username']) && $objectData['username']!==null ? $objectData['username'] : '';
    	$email = isset($objectData['email']) && $objectData['email']!==null ? $objectData['email'] : '';
    	 
    	$searchModel = new AdminSearch();
    	$dataProvider = $searchModel->search(\Yii::$app->request->get());
    	$uriParam = '&Admin[username]='.$username;
    	$uriParam .= '&Admin[email]='.$email;
    	 
    	return $this->render('index', [
    						'dataProvider' => $dataProvider,
    					 	'searchModel' => $searchModel,
    					 	'uriParam' => $uriParam,
    				]);
    }
    
    /**
     * Add user
     *
     * @return string
     */
    public function actionAdd()
    {
    	$model = new Admin();
    	$model->setScenario('creating');
    	if (Yii::$app->request->isPost) {
    		$model->attributes = Yii::$app->request->post('Admin');
    		if ($model->validate()) {
    			$model->setPassword($model->password);
    			$model->save(false);
    			
    			Yii::$app->session->setFlash('success', "Tạo thành công");
    			Yii::$app->getResponse()->redirect(['admin/index']);
    			Yii::$app->end();
    		} 
    	}
    	 
    	return $this->render('add', [
    			'model' => $model,
    	]);
    }
    
    /**
     * Update user
     *
     * @return string
     */
    public function actionEdit($id = 0)
    {
    	$model = Admin::findOne(['id' => $id, 'status' => Admin::STATUS_ACTIVE]);
    	if (!$model) {
    		Yii::$app->session->setFlash('error', "Dữ liệu không tồn tại");
    		Yii::$app->getResponse()->redirect(['admin/index']);
    		Yii::$app->end();
    	}
    	
    	if (Yii::$app->request->isPost) {
    		$model->attributes = Yii::$app->request->post('Admin');
    		if ($model->validate()) {
    			$model->setPassword($model->password);
    			$model->save(false);
    			 
    			Yii::$app->session->setFlash('success', "Cập nhật thành công");
    			Yii::$app->getResponse()->redirect(['admin/index']);
    			Yii::$app->end();
    		}
    	}
    
    	return $this->render('edit', [
    			'model' => $model,
    	]);
    }
    
    /**
     * Delete function
     *
     * @return
     */
    public function actionDelete($id = 0)
    {
    	$this->getView()->title = "Danh sách";
    	$infos = Admin::findOne(['id' => $id, 'status' => Admin::STATUS_ACTIVE]);
    	if (!$infos) {
    		Yii::$app->session->setFlash('error', "Dữ liệu không tồn tại ");
    		Yii::$app->getResponse()->redirect(['admin/index']);
    		Yii::$app->end();
    	}
    	$infos->save(false);
    	Yii::$app->session->setFlash('success', "Dữ liệu đã được xóa khỏi hệ thống ");
    	Yii::$app->getResponse()->redirect(['admin/index']);
    	Yii::$app->end();
    }
    
    /**
     * View user
     *
     * @return
     */
    public function actionView($id = 0)
    {
    	$user = Admin::findOne(['id' => $id, 'status' => Admin::STATUS_ACTIVE]);
    	if (!$user) {
    		Yii::$app->session->setFlash('error', "Dữ liệu không tồn tại ");
    		Yii::$app->getResponse()->redirect(['admin/index']);
    		Yii::$app->end();
    	}
    	
    	return $this->render('view', [
    			'user' => $user
    	]);
    }
    
    /**
     * Update user
     *
     * @return string
     */
    public function actionChange($id = 0)
    {
    	$model = Admin::findOne(['id' => $id, 'status' => Admin::STATUS_ACTIVE]);
    	$model->setScenario('change-password');
    	if (!$model) {
    		Yii::$app->session->setFlash('error', "Dữ liệu không tồn tại ");
    		Yii::$app->getResponse()->redirect(['admin/index']);
    		Yii::$app->end();
    	}
    	 
    	if (Yii::$app->request->isPost) {
    		$model->attributes = Yii::$app->request->post('Admin');
    	       
    
    		if ($model->validate()) {
    			$model->setPassword($model->new_password);
    			$model->save(false);
    
    			Yii::$app->session->setFlash('success', "Cập nhật thành công");
    			Yii::$app->getResponse()->redirect(['admin/index']);
    			Yii::$app->end();
    		}
    	}
    
    	return $this->render('new-password', [
    			'model' => $model,
    	]);
    }
}
