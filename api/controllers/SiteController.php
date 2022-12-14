<?php
namespace api\controllers;

use Yii;
use yii\web\Controller;


/**
 * Site controller
 */
class SiteController extends Controller
{
    public $enableCsrfValidation = false;
    
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
     * @return type
     */
   
public function actionError()
{
    $exception = Yii::$app->errorHandler->exception;
    if ($exception !== null) {
        
        return $this->render('error', ['exception' => $exception]);
    }
}
    
}