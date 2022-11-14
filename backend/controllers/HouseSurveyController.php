<?php

namespace backend\controllers;

use Yii;
use common\models\HouseSurvey;
use backend\models\HouseSurveySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;
use common\models\Employee;
use common\models\House;
/**
 * HouseSurveyController implements the CRUD actions for HouseSurvey model.
 */
class HouseSurveyController extends Controller
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
     * Lists all HouseSurvey models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new HouseSurveySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
          $houses =  ArrayHelper::map(House::find()->all(),'id','description');   

        $employees =  ArrayHelper::map(Employee::find()->all(),'id','name');   
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'employees' =>  $employees,
            'houses' => $houses
        ]);
    }

    /**
     * Displays a single HouseSurvey model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new HouseSurvey model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
           
             $model = new HouseSurvey();
        

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
       
        $houses =  ArrayHelper::map(House::find()->all(),'id','description');   

        $employees =  ArrayHelper::map(Employee::find()->all(),'id','name');   
        return $this->render('create', [
            'model' => $model,
            'employees' =>  $employees,
            'houses' => $houses
        ]);
    }

    /**
     * Updates an existing HouseSurvey model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing HouseSurvey model.
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
     * Finds the HouseSurvey model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return HouseSurvey the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = HouseSurvey::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
