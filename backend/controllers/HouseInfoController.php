<?php
namespace backend\controllers;
use Yii;
use common\models\HouseInfo;
use common\models\Article;
use common\models\Province;
use common\models\District;
use common\models\User;
use common\models\CategoryType;
use yii\helpers\FileHelper;
use backend\models\HouseInfoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * HouseInfoController implements the CRUD actions for HouseInfo model.
 */
class HouseInfoController extends AppController
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
     * Lists all HouseInfo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new HouseInfoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $articleTypes = ArrayHelper::map(CategoryType::find()->all(), 'id', 'title');
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
     * Displays a single houseInfo model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {

		 $houseInfo = $this->findModel($id);
			if(isset($houseInfo->article)){
				 $article = $houseInfo->article;
				
			}else{
				 $article = new Article();
				 $article->title =  $houseInfo->title;
				 $article->area_text =  $houseInfo->area;
				 $article->price_text =  $houseInfo->price;
				 $article->title = $houseInfo->title;
				 $article->province_id = $houseInfo->province_id;
				 $article->district_id = $houseInfo->district_id;
				 $article->category_type_id = $houseInfo->category_type_id;
				 $article->street = $houseInfo->street;
				 $article->content = $houseInfo->content;
				 $article->description = $houseInfo->content;
                 $article->house_info_id = $houseInfo->id;

				
			}
		
		if(Yii::$app->request->isPost) {
               $article->attributes = Yii::$app->request->post('Article');
			 //  $article->employee_id = Yii::$app->user->identity->id;
			  // $article->house_id = $id;
               if($article->save(false)) {
				   $houseInfo->status= 1;
				   $houseInfo->save(false);
				   foreach($houseInfo->images as $value){
					   $value->article_id =  $article->getPrimaryKey();
					   $value->save(false);
				   }
                Yii::$app->session->setFlash('success', "Thông tin tập tin đã được luu ");
                Yii::$app->getResponse()->redirect(['house-info/index']);
                Yii::$app->end();
            }
        }
		$articleTypes = ArrayHelper::map(CategoryType::find()->all(), 'id', 'title');
		$provinces = ArrayHelper::map(Province::find()->orderBy('type asc, name desc')->all(), 'province_id', function ($province) {
						return $province->type.' '. $province->name;
				});
		$districts = ArrayHelper::map(District::find()->andWhere(['province_id' => $article->province_id])->orderBy('type desc, name asc')->all(), 'district_id', function ($district) {
							return $district->type.' '.$district->name;
				});
		$users = ArrayHelper::map(User::find()->andWhere(['id' => ['28113','13935','29016']])->orderBy('name asc')->all(), 'id', 'name');		
       return $this->render('view', [
            'houseInfo' => $houseInfo ,
			 'article' =>  $article,
			 'provinces' => $provinces,
			 'districts' => $districts,
			 'articleTypes' => $articleTypes,
			 'users' => $users
			
        ]);
    }

    /**
     * Creates a new HouseInfo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new HouseInfo();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }
         $articleTypes = ArrayHelper::map(CategoryType::find()->all(), 'id', 'title');
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
     * Updates an existing houseInfo model.
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
         $articleTypes = ArrayHelper::map(CategoryType::find()->all(), 'id', 'title');
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
     * Deletes an existing HouseInfo model.
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
     * Finds the HouseInfo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return HouseInfo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = HouseInfo::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
