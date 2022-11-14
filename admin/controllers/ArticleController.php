<?php

namespace admin\controllers;

use Yii;
use common\models\Article;
use admin\models\ArticleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use common\models\Province;
use common\models\District;
use common\models\CategoryType;
use yii\web\UploadedFile;
use frontend\models\UploadForm;
use frontend\models\MultipleUploadForm;
use yii\helpers\FileHelper;
use common\models\ArticleImage;
use yii\helpers\Json;
/**
 * ArticleController implements the CRUD actions for Article model.
 */
class ArticleController extends Controller
{
    /**
     * {@inheritdoc}
     */
   /*public function beforeAction($action) 
{ 
    $this->enableCsrfValidation = false; 
    return parent::beforeAction($action); 
}*/

    /**
     * Lists all Article models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ArticleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Article model.
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
     * Creates a new Article model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Article();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        $provinces = ArrayHelper::map(Province::find()->orderBy('type asc, name desc')->all(), 'province_id', function ($province) {
                        return $province->type.' '. $province->name;
                });
            $districts = ArrayHelper::map(District::find()->andWhere(['province_id' => $model->province_id])->orderBy('type desc, name asc')->all(), 'district_id', function ($district) {
                            return $district->type.' '.$district->name;
                });
            $articleTypes = ArrayHelper::map(CategoryType::find()->all(), 'id', 'title');// District::find()->all();
            $user=  Yii::$app->user->identity;
        return $this->render('create', [
            'model' => $model,
            'provinces'  =>  $provinces,
            'districts'  =>  $districts,
            'articleTypes' => $articleTypes,
            'user' => $user, 
        ]);
    }

    /**
     * Updates an existing Article model.
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
        $provinces = ArrayHelper::map(Province::find()->orderBy('type asc, name desc')->all(), 'province_id', function ($province) {
						return $province->type.' '. $province->name;
				});
			$districts = ArrayHelper::map(District::find()->andWhere(['province_id' => $model->province_id])->orderBy('type desc, name asc')->all(), 'district_id', function ($district) {
							return $district->type.' '.$district->name;
				});
			$articleTypes = ArrayHelper::map(CategoryType::find()->all(), 'id', 'title');// District::find()->all();
		$user=	Yii::$app->user->identity;
        return $this->render('update', [
            'model' => $model,
            'provinces'  =>  $provinces,
            'districts'  =>  $districts,
            'articleTypes' => $articleTypes,
            'user' => $user, 

        ]);
    }

    /**
     * Deletes an existing Article model.
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
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Article the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionMultipleUpload()
	{
		$form = new MultipleUploadForm();
		$filename = date('Y_m_d_His').gettimeofday()['usec'];
		$arrResponse = array();
		if (Yii::$app->request->isPost) {
            echo 123;
            die;
			$form->files = UploadedFile::getInstances($form, 'files');
			if ($form->files && $form->validate()) {
				$arrResponse['url'] = array();
				$arrResponse['id'] = array();
							foreach ($form->files as $file) {
									$articleImage = new ArticleImage();
										
										$image_name = date('YmdHis') . gettimeofday()['usec'] . '.' . $file->extension;
										$articleImage->image = $image_name; 
										$user_id =Yii::$app->user->identity->id;
										if ($articleImage->save(false)) {
												$path = Yii::$app->params['PathChannels']  . 'article/images/';
												$path745x510 = Yii::$app->params['PathChannels'] . 'article/745x510/';
												$path210X118 = Yii::$app->params['PathChannels'] . 'article/210x118/';
												$path200X200 = Yii::$app->params['PathChannels']  . 'article/200x200/';
												FileHelper::createDirectory($path, $mode = 0775, $recursive = true);
												FileHelper::createDirectory($path745x510, $mode = 0775, $recursive = true);
												FileHelper::createDirectory($path210X118, $mode = 0775, $recursive = true);
												FileHelper::createDirectory($path200X200, $mode = 0775, $recursive = true);
											if ($file->saveAs($path . $image_name, false)) {
													Image::thumbnail($path . $image_name, 745, 510)->save($path745x510 . $image_name, ['quality' => 100]);
													Image::thumbnail($path . $image_name, 210, 118)->save($path210X118 . $image_name, ['quality' => 100]);
													Image::thumbnail($path . $image_name, 200, 200)->save($path200X200 . $image_name, ['quality' => 100]);
											}
											$arrResponse['url'][] = $articleImage->image;
											$arrResponse['id'][] = $articleImage->id;
										}
							}
										$arrResponse['sID'] = implode(';', $arrResponse['id']);
										$arrResponse['total'] = count($form->files);
			}
		}
		echo json_encode($arrResponse);
    	exit();
	}


}