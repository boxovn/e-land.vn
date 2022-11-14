<?php

namespace api\controllers;

use Yii;
use common\models\BlogPost;
use api\models\BlogPostSearch;
use yii\rest\ActiveController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BlogPostController implements the CRUD actions for BlogPost model.
 */
class BlogPostController extends AppController
{
    public $modelClass = BlogPost::class;
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
           'query' => BlogPost::find()->andWhere(['user_id' => $this->users]),

        ]);
    };

    return $actions;
}
}