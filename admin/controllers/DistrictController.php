<?php

namespace backend\controllers;

use Yii;
use yii\helpers\Json;
use yii\web\Controller;
use common\models\District;
use yii\data\ActiveDataProvider;

class DistrictController extends AppController
{
    /**
     * Get json district data
     *
     * @return string
     */
    public function actionAjax()
    {	
    	$provinceID = Yii::$app->request->post('provinceID')!==null ? Yii::$app->request->post('provinceID') : 0;
    	$dataDistrict = District::find()
			    	->select(['district_id', 'name', 'type', 'slug'])
			    	->where(['province_id' => $provinceID])
			    	->orderBy(['type' => 'ASC', 'name' => 'ASC'])
    				->asArray()->all();   	
    	return Json::encode($dataDistrict);
    }

    
    
    
}
