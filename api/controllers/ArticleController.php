<?php
namespace api\controllers;
use yii;
use api\models\ApiArticle;
use common\models\Article;
use yii\rest\ActiveController;
use api\models\ArticleSearch;
class ArticleController extends AppController {
   public $modelClass = ApiArticle::class;
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];
    public function actions()
{
    $actions = parent::actions();
    // Overriding action
    $actions['index']['prepareDataProvider'] = function($action) 
    {
       
        return new \yii\data\ActiveDataProvider([
           'query' => ApiArticle::find()->andWhere(['user_id' => $this->users]),
           'sort'=> ['defaultOrder' => ['created' => SORT_DESC]],

        ]);
    };

    return $actions;
}

   public function actionDetail($slug){
       
       return Article::findOne(['slug' => $slug]);
   }
public function actionSearch(){
        $searchModel = new ArticleSearch();
          
        return  $searchModel->search(Yii::$app->request->get(),$this->users);
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