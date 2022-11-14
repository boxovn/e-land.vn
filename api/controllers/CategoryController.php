<?php
namespace api\controllers;
use yii;
use common\models\Category;
class CategoryController extends AppController {
    
   public $modelClass = Category::class;
   public function actions(){
       $actions = parent::actions();
       // disable the "delete" and "create" actions
       unset($actions['delete'], $actions['create']);
      // customize the data provider preparation with the "prepareDataProvider()" method
        $actions['index']['prepareDataProvider'] =  [$this, 'prepareDataProvider'];
       // $actions['view']['findModel'] =  [$this, 'findModel'];
        return $actions;
}
public function prepareDataProvider()
{
         return new \yii\data\ActiveDataProvider([
            'query' => Category::find(),

            ]);
}
}