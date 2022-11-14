<?php

namespace backend\controllers;

use Yii;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\UploadedFile;
use common\models\Street;
use yii\data\ActiveDataProvider;

class StreetController extends AppController
{
    /**
     * Get json street data
     *
     * @return string
     */
    public function actionAjax()
    {	
    	$districtID = Yii::$app->request->post('districtID')!==null ? Yii::$app->request->post('districtID') : 0;
    	$dataStreet = Street::find()
			    	->select(['street_id', 'name', 'type', 'slug'])
			    	->where(['district_id' => $districtID])
			    	->orderBy('name ASC')
    				->asArray()->all();   	
    	return Json::encode($dataStreet);
    }
    
    
    
    
}
