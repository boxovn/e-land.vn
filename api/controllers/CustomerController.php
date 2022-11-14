<?php
namespace api\controllers;
use Yii;
use yii\rest\ActiveController;
use common\models\Customer;
use api\models\CustomerSearch;
class CustomerController extends ActiveController{
    public $modelClass = Customer::class;
  
    public $enableCsrfValidation = false;
    public function init()
{
    parent::init();
    \Yii::$app->user->enableSession = false;
}
 
/*
 public function actionSearch(){
     
     $filter = new \yii\data\ActiveDataFilter([
    'searchModel' => '\api\models\CustomerSearch'
]);

$filterCondition = null;

// You may load filters from any source. For example,
// if you prefer JSON in request body,
// use Yii::$app->request->getBodyParams() below:
if ($filter->load(\Yii::$app->request->get())) { 
    $filterCondition = $filter->build();
    if ($filterCondition === false) {
        // Serializer would get errors out of it
        return $filter;
    }
}

$query = Customer::find();
if ($filterCondition !== null) {
    $query->andWhere($filterCondition);
}

return new \yii\data\ActiveDataProvider([
    'query' => $query,
]);
 }
 */
 public function actions() 
  { 
      //  var_dump(Yii::$app->request->headers);
       // die;
		$actions = parent::actions();
		$actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
		return $actions;
  }

	public function prepareDataProvider() 
	{
		$searchModel = new CustomerSearch();    
		return $searchModel->search(\Yii::$app->request->queryParams);
	}
	public function formName()
    {
        return '';
    }
public function beforeAction($action)
{
    \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    return parent::beforeAction($action);
}

}