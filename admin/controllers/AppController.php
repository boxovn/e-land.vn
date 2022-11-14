<?php

namespace admin\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;

class AppController extends Controller{
    
    public $enableCsrfValidation = false;
	
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
    
    /**
     * 
     */
    public function beforeAction($action) {
        parent::beforeAction($action);
        $this->layout = 'main';
        return true;
    }
    
    
}