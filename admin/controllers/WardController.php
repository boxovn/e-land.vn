<?php

namespace backend\controllers;

use Yii;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\UploadedFile;
use common\models\Ward;
use yii\data\ActiveDataProvider;

class WardController extends AppController
{
    /**
     * Get json ward data
     *
     * @return string
     */
    public function actionAjax()
    {	
    	$districtID = Yii::$app->request->post('districtID')!==null ? Yii::$app->request->post('districtID') : 0;
    	$dataWard = Ward::find()
			    	->select(['ward_id', 'name', 'type', 'slug'])
			    	->where(['district_id' => $districtID])
			    	->orderBy(['type' => 'ASC', 'name' => 'ASC'])
    				->asArray()->all();   	
    	return Json::encode($dataWard);
    }
    
    
}
