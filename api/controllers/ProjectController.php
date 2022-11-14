<?php
namespace api\controllers;
use yii;
use api\models\ProjectSearch;
use common\models\Project;

use yii\rest\ActiveController;

class ProjectController extends ActiveController {
   public $modelClass = Project::class;
  
   public function actionSearch(){
    $searchModel = new ProjectSearch();
  
    return  $searchModel->search(Yii::$app->request->get());
    }
}