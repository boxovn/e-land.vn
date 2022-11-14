<?php
namespace frontend\controllers;
use Yii;
use common\models\User;
use common\models\Province;
use common\models\District;
use common\models\Ward;
use yii\data\Pagination;
use yii\web\Controller;
use  yii\helpers\Url;
use yii\web\Response;
use yii\helpers\Json;
use  yii\helpers\ArrayHelper;
date_default_timezone_set('Asia/Ho_Chi_Minh');
class HomeApiController extends AppController {

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
   public function actionDistricts() 
    {    
        
        $message= '';
        $error = '';
        $this->layout= false;
        $province_id = Yii::$app->request->get('province_id');
        $districts = ArrayHelper::toArray(District::find()->andWhere(['province_id' =>  $province_id])->orderBy('type desc, name asc')->all(), [
                    'common\models\District' => [
                        'district_id',
                        'name'  => function ($district) {
                                return $district->type . ' ' . $district->name;
                        },
                    ],
        ]);
        $result = ['error' => $error , 'message' => $message, 'districts' => $districts];
        //$this->setHeader(200);
        echo json_encode($result);
        exit();
    }
    public function actionWards() 
    {    
        
        $message= '';
        $error = '';
        $this->layout= false;
        $district_id = Yii::$app->request->get('district_id');
        $wards = ArrayHelper::toArray(Ward::find()->andWhere(['district_id' =>  $district_id])->orderBy('type desc, name asc')->all(), [
                    'common\models\Ward' => [
                        'ward_id',
                        'name'  => function ($ward) {
                                return $ward->type . ' ' . $ward->name;
                        },
                    ],
        ]);
        $result = ['error' => $error , 'message' => $message, 'wards' => $wards];
        //$this->setHeader(200);
        echo json_encode($result);
        exit();
    }
}