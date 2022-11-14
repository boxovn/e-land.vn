<?php

namespace api\controllers;
use yii;

use common\models\Info;
class InfoController extends AppController {
    
   public $modelClass = Info::class;
    public function actions()
{
    $actions = parent::actions();
    // Overriding action
    $actions['index']['prepareDataProvider'] = function($action) 
    {
       
        return new \yii\data\ActiveDataProvider([
           'query' => Info::find()->andWhere(['user_id' => $this->users]),

        ]);
    };

    return $actions;
}
 
/*
   public static function allowedDomains() {
       return [
          // '*',                        // star allows all domains
           'http://localhost:4200',
       ];
}
public function behaviors() {
       return array_merge(parent::behaviors(), [
       		 [
      'class' => \yii\ filters\ ContentNegotiator::className(),
      'only' => ['index', 'view'],
      'formats' => [
        'application/json' => \yii\ web\ Response::FORMAT_JSON,
      ],
    ],
           // For cross-domain AJAX request
           'corsFilter'  => [
               'class' => \yii\filters\Cors::className(),
               'cors'  => [
                   // restrict access to domains:
                   'Origin'                           => static::allowedDomains(),
                   'Access-Control-Request-Method'    => ['POST','GET', 'HEAD'],
                   'Access-Control-Allow-Credentials' => true,
                   'Access-Control-Max-Age'           => 3600,                 // Cache (seconds)
               ],
           ],

       ]);
}
*/
	

}