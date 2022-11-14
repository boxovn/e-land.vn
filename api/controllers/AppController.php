<?php
namespace api\controllers;
use Yii;
use yii\rest\ActiveController;
use common\models\Customer;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
class AppController extends ActiveController{
    public $users= [];
    public $customer_id= 'Eland';//'e-land.vn';
    public $enableCsrfValidation = false;
    public function init()
{
    parent::init();
    \Yii::$app->user->enableSession = false;
}

public function beforeAction($action)
{
   parent::beforeAction($action);
    try{
        $headers = \Yii::$app->request->headers;
        $customerDoman = $headers->get('Origin');
        $customer= Customer::findOne(['client_id' => $customerDoman]);
        if($customerDoman &&  $customer){
           
            $this->users = yii\helpers\ArrayHelper::getColumn($customer->customerUsers,'user_id');
            $this->customer_id =  $customer->id;
           
        }else{
                  throw new \yii\web\HttpException(403, 'Không có quyền truy cập');
        }
    }catch(\yii\db\Exception $e){
        echo $e->getName(); 
    }
        
	 \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

    return parent::beforeAction($action);
}

public static function allowedDomains() {
       return [
         // '*',      
            // star allows all domains
            'http://www.test.local',
            'http://localhost:4200',
            'http://trieuphatland.com',
            'http://www.trieuphatland.com',
            'http://batdongsaneland.com'
        
       ];
}
 
public function behaviors()
{
    $behaviors = parent::behaviors();

    unset($behaviors['authenticator']);

    $behaviors['corsFilter'] = [
        'class' =>  \yii\filters\Cors::className(),
        'cors' => [
            'Origin' => static::allowedDomains(),
            'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
            'Access-Control-Request-Headers' => ['*'],
            'Access-Control-Allow-Credentials' => true,
        ],
    ];
    
    return $behaviors;
}
/*public function sendResponse($error,$message,$objects,$code = 200){
        $result = ['error' => $error,'message' => $message,'objects' => $objects];
        $this->setHeader($code);
        echo json_encode($result);
        exit();
    }
    */
}