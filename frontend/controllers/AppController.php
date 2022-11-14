<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\Meta;
use yii\filters\AccessControl;
date_default_timezone_set('Asia/Ho_Chi_Minh');

class AppController extends Controller{
    /**
     * 
     */
    
	/**
 * List of allowed domains.
 * Note: Restriction works only for AJAX (using CORS, is not secure).
 *
 * @return array List of domains, that can access to this API
 */
public static function allowedDomains()
{
    return [
        // '*',                        // star allows all domains
        'https://e-land.vn',
        'https://trieuphatland.com'
       
    ];
}

/**
 * @inheritdoc
 */
public function behaviors()
{
    return array_merge(parent::behaviors(), [

        // For cross-domain AJAX request
        'corsFilter'  => [
            'class' => \yii\filters\Cors::className(),
            'cors'  => [
                // restrict access to domains:
                'Origin'                           => static::allowedDomains(),
                'Access-Control-Request-Method'    =>  ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
                 'Access-Control-Request-Headers' => ['*'],
                'Access-Control-Allow-Credentials' => true,
                'Access-Control-Max-Age'           => 3600,                 // Cache (seconds)
            ],
        ],

    ]);
}

    public function beforeAction($action) {
        parent::beforeAction($action);
        $this->layout = 'main';
		$user = Yii::$app->user->identity;
		 $this->view->registerCsrfMetaTags();
        $this->view->title = 'E-land.VN | Rao bán cho thuê bất động sản';
        $this->view->registerLinkTag(['rel' => 'shortcut icon', 'type' => 'image/x-icon', 'href' => '/logo.ico']);
		$session = Yii::$app->session;
        if($session->has('province_id')){
           $session->set('province_id', $session->get('province_id'));
        }else{
            $session->set('province_id',79); 
        }
       
        return  parent::beforeAction($action);
    }
    public function setProvince($province_id){
               
                $session = Yii::$app->session;
                  $session->set('province_id', (int)$province_id );
                return $session->get('province_id');

    }
    
     public function getMetaPage($page) {
        $meta = Meta::find()->andWhere(['page' => $page])->one();
        return $meta? $meta:'';
        }
     protected function metaTagGoogle($meta=array()){
    	
    		foreach($meta as $val){
    			$this->view->registerMetaTag([
       				 'name' => isset($val['name'])? $val['name']:'',
       				 'content' => isset($val['content'])?$val['content']:'',
   				 ]);
    		}
    			
    		
    }
	protected function metaHead($meta=array()){
    		foreach($meta as $val){
    			$this->view->registerMetaTag(
				 [
       				 'property' => $val['property'],
       				 'content' => $val['content']
   				 ]);
    		}
    }
    
}