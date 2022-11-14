<?php
namespace frontend\controllers;
use Yii;
use common\models\User;
use yii\data\Pagination;
use common\libraries\PseudoCrypt;
use yii\web\Controller;
use  yii\helpers\Url;
use frontend\models\ResetPasswordForm;
use frontend\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use yii\web\Response;
use yii\helpers\Json;
date_default_timezone_set('Asia/Ho_Chi_Minh');
class IndexApiController extends AppController {

    /**
     * 
     * @return type
     */
	 public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
	 public function beforeAction($action) {
        parent::beforeAction($action);
       $this->layout = false;
		
        return true;
    }
    public function actionLogin() {
        $model = new LoginForm();
        $arrResponse = array(); 
        if ($model->load(\Yii::$app->request->post())) {
                   if($model->login()){
                        $arrResponse= [
                            'error' => false , 
                            'message' => 'Đăng nhập thành công',
                        ];
                   }else{
                    $arrResponse= [
                        'error' => true , 
                        'message' => '*Tài khoản hoặc mật khẩu không chính xác',
                    ];
                   }
		 
       }
           
      
      return Json::encode($arrResponse);
    }
}