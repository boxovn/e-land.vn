<?php
namespace backend\controllers;
use Yii;
use common\models\NoteInfo;
use common\models\Article;
use common\models\Province;
use common\models\District;
use common\models\User;
use common\models\ArticleType;
use yii\helpers\FileHelper;
use backend\models\NoteInfoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * NoteInfoController implements the CRUD actions for NoteInfo model.
 */
class NoteInfoController extends AppController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all NoteInfo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NoteInfoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $articleTypes = ArrayHelper::map(ArticleType::find()->all(), 'id', 'title');
        $provinces = ArrayHelper::map(Province::find()->orderBy('type asc, name desc')->all(), 'province_id', function ($province) {
                        return $province->type.' '. $province->name;
                });
        $districts = ArrayHelper::map(District::find()->orderBy('type desc, name asc')->all(), 'district_id', function ($district) {
                            return $district->type.' '.$district->name;
                });
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'provinces' => $provinces,
            'districts' => $districts,
            'types' => $articleTypes,
        ]);
    }

    /**
     * Displays a single NoteInfo model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {

		 $noteInfo = $this->findModel($id);
			if(isset($noteInfo->article)){
				 $article = $noteInfo->article;
				
			}else{
				 $article = new Article();
				 $article->title =  $noteInfo->title;
				 $article->area_text =  $noteInfo->area;
				 $article->price_text =  $noteInfo->price;
				 $article->title = $noteInfo->title;
				 $article->province_id = $noteInfo->province_id;
				 $article->district_id = $noteInfo->district_id;
				 $article->type_id = $noteInfo->type_id;
				 $article->street = $noteInfo->street;
				 $article->content = $noteInfo->content;
				 $article->description = $noteInfo->content;
                 $article->note_info_id = $noteInfo->id;

				
			}
		
		if(Yii::$app->request->isPost) {
               $article->attributes = Yii::$app->request->post('Article');
			 //  $article->employee_id = Yii::$app->user->identity->id;
			  // $article->note_id = $id;
               if($article->save(false)) {
				   $noteInfo->status= 1;
				   $noteInfo->save(false);
				   foreach($noteInfo->images as $value){
					   $value->article_id =  $article->getPrimaryKey();
					   $value->save(false);
				   }
                Yii::$app->session->setFlash('success', "Thông tin tập tin đã được luu ");
                Yii::$app->getResponse()->redirect(['note-info/index']);
                Yii::$app->end();
            }
        }
		$articleTypes = ArrayHelper::map(ArticleType::find()->all(), 'id', 'title');
		$provinces = ArrayHelper::map(Province::find()->orderBy('type asc, name desc')->all(), 'province_id', function ($province) {
						return $province->type.' '. $province->name;
				});
		$districts = ArrayHelper::map(District::find()->andWhere(['province_id' => $article->province_id])->orderBy('type desc, name asc')->all(), 'district_id', function ($district) {
							return $district->type.' '.$district->name;
				});
		$users = ArrayHelper::map(User::find()->andWhere(['id' => ['28113','13935','29016']])->orderBy('name asc')->all(), 'id', 'name');		
       return $this->render('view', [
            'noteInfo' => $noteInfo ,
			 'article' =>  $article,
			 'provinces' => $provinces,
			 'districts' => $districts,
			 'articleTypes' => $articleTypes,
			 'users' => $users
			
        ]);
    }

    /**
     * Creates a new NoteInfo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new NoteInfo();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }
         $articleTypes = ArrayHelper::map(ArticleType::find()->all(), 'id', 'title');
        $provinces = ArrayHelper::map(Province::find()->orderBy('type asc, name desc')->all(), 'province_id', function ($province) {
                        return $province->type.' '. $province->name;
                });
        $districts = ArrayHelper::map(District::find()->andWhere(['province_id' => $model->province_id])->orderBy('type desc, name asc')->all(), 'district_id', function ($district) {
                            return $district->type.' '.$district->name;
                });
        return $this->render('create', [
            'model' => $model,
             'types' => $articleTypes,
            'provinces' =>  $provinces,
            'districts' => $districts, 
        ]);
    }

    /**
     * Updates an existing NoteInfo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }
         $articleTypes = ArrayHelper::map(ArticleType::find()->all(), 'id', 'title');
        $provinces = ArrayHelper::map(Province::find()->orderBy('type asc, name desc')->all(), 'province_id', function ($province) {
                        return $province->type.' '. $province->name;
                });
        $districts = ArrayHelper::map(District::find()->andWhere(['province_id' => $model->province_id])->orderBy('type desc, name asc')->all(), 'district_id', function ($district) {
                            return $district->type.' '.$district->name;
                });
        return $this->render('update', [
            'model' => $model,
            'types' => $articleTypes,
            'provinces' =>  $provinces,
            'districts' => $districts, 
        ]);
    }

    /**
     * Deletes an existing NoteInfo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the NoteInfo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return NoteInfo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = NoteInfo::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
