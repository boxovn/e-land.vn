<?php

namespace backend\controllers;

use Yii;
use common\models\House;
use common\models\HouseInfo;

use backend\models\HouseSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use common\models\Province;
use common\models\District;
use common\models\User;
use yii\web\UploadedFile;
use common\models\ArticleImage;
use backend\models\MultipleUploadForm;
use yii\helpers\FileHelper;
use yii\imagine\Image;
use backend\models\HouseSurveySearch;
use common\models\CategoryType;
use common\models\Street;
use common\models\HouseSurvey;
use common\models\Article;
use common\models\Ward;
/**
 * HouseController implements the CRUD actions for House model.
 */
class HouseController extends Controller
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
	public function beforeAction($action) 
{ 
    $this->enableCsrfValidation = false; 
    return parent::beforeAction($action); 
}
 public function actionDistricts(){	 
		
		$message= '';
        $error = '';
		$this->layout= false;
		$province_id = Yii::$app->request->get('province_id');
		$districts = ArrayHelper::toArray(District::find()->andWhere(['province_id' =>  $province_id])->orderBy('type desc, name asc')->all(), [
					'common\models\District' => [
						'district_id',
						'name'  => function ($district) {
								return $district->type . ' ' . $district->name;
						},
					],
		]);
		$result = ['error' => $error , 'message' => $message, 'districts' => $districts];
		
		return $this->asJson($result);
        exit();
    }
public function actionWards() 
    {    
                
                $message= '';
        $error = '';
                $this->layout= false;
                $district_id = Yii::$app->request->get('district_id');
                $wards = ArrayHelper::toArray(Ward::find()->andWhere(['district_id' =>  $district_id])->orderBy('type desc, name asc')->all(), [
                                        'common\models\Ward' => [
                                                'ward_id',
                                                'name'  => function ($ward) {
                                                                return $ward->type . ' ' . $ward->name;
                                                },
                                        ],
                ]);
                $result = ['error' => $error , 'message' => $message, 'wards' => $wards];
                //$this->setHeader(200);
                echo json_encode($result);
        exit();
    }

    /**
     * Lists all House models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new HouseSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $users =  ArrayHelper::map(User::find()->all(),'id','name');  
        $articleTypes = ArrayHelper::map(CategoryType::find()->all(), 'id', 'title');
        $provinces = ArrayHelper::map(Province::find()->orderBy('type asc, name desc')->all(), 'province_id', function ($province) {
                        return $province->type.' '. $province->name;
                });
        $districts = ArrayHelper::map(District::find()->andWhere(['province_id' => 79])->orderBy('type desc, name asc')->all(), 'district_id', function ($district) {
                            return $district->type.' '.$district->name;
                }); 
          $streets = ArrayHelper::map(Street::find()->orderBy('type desc, name asc')->all(), 'district_id', function ($street) {
                            return $street->type .' '. $street->name;
                }); 
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'users' => $users,
            'districts' =>  $districts,
            'provinces' =>  $provinces,
            'streets' => $streets
        ]);
    }
      /**
     * Displays a single HouseSurvey model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionSurveyView($id)
    {

        return $this->render('survey_view', [

            'model' => $this->findHouseSurvey($id),
        ]);
    }
       /**
     * Finds the HouseSurvey model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return HouseSurvey the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findHouseSurvey($id)
    {
        if (($model = HouseSurvey::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Trang không tồn tại.');
    }
    public function actionSurvey()
    {
        $searchModel = new HouseSurveySearch();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $users =  ArrayHelper::map(User::find()->all(),'id','name');   
        $house = House::findOne([Yii::$app->request->queryParams['id']]); 
        return $this->render('survey', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'users' => $users,
            'house' => $house
        ]);
    }

    /**
     * Creates a new HouseSurvey model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionSurveyCreate()
    {
          

        $model = new HouseSurvey();
           
        if ($model->load(Yii::$app->request->post())) {
             $model->house_id = Yii::$app->request->get('house_id');
             $model->save();
            return $this->redirect(['survey-view', 'id' => $model->id]);
        }
       
         $house = House::findOne(['id' => Yii::$app->request->get('house_id')]);

        $users =  ArrayHelper::map(user::find()->all(),'id','name');   
        return $this->render('survey_create', [
            'model' => $model,
            'users' =>  $users,
          'house' => $house
        ]);
    }


    /**
     * Displays a single house model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
		 $house = $this->findModel($id);
			if(isset($house->houseInfo)){
				 $houseInfo = $house->houseInfo;
				
			}else{
				 $houseInfo = new HouseInfo();
			}
		
		if(Yii::$app->request->isPost) {
               $houseInfo->attributes = Yii::$app->request->post('HouseInfo');
			   $houseInfo->user_id = Yii::$app->user->identity->id;
			   $houseInfo->house_id = $id;
               if($houseInfo->save(false)) {
				   $house->status= 1;
				   $house->save(false);
				   foreach($house->images as $value){
					   $value->house_info_id =  $houseInfo->getPrimaryKey();
					   $value->save(false);
				   }
                Yii::$app->session->setFlash('success', "Thông tin tập tin đã được luu ");
                Yii::$app->getResponse()->redirect(['house/index']);
                Yii::$app->end();
            }
        }
		$provinces = ArrayHelper::map(Province::find()->orderBy('type asc, name desc')->all(), 'province_id', function ($province) {
						return $province->type.' '. $province->name;
				});
			$districts = ArrayHelper::map(District::find()->andWhere(['province_id' => $houseInfo->province_id])->orderBy('type desc, name asc')->all(), 'district_id', function ($district) {
							return $district->type.' '.$district->name;
				});
       return $this->render('view', [
            'house' => $house ,
			 'houseInfo' =>  $houseInfo,
			 'provinces' => $provinces,
			 'districts' => $districts,
			
        ]);
    }
     /**
     * Displays a single house model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionConvert($id)
    {
            $house = $this->findModel($id);
            if(isset($house->article)){
                 $article = $house->article;
            }else{
                 $article = new Article();
                 $article->province_id = $house->province_id;
                 $article->district_id = $house->district_id;
                 $article->category_type_id = $house->category_type_id;
                 $article->street = $house->street;
                 $article->content = $house->content;
                 $article->description = $house->description;
                 $article->house_id = $house->id;
            }

             if(Yii::$app->request->isPost) {
               $article->attributes = Yii::$app->request->post('Article');
             //  $article->employee_id = Yii::$app->user->identity->id;
              // $article->house_id = $id;
               if($article->save(false)) {
                   $house->status = 1;
                   $house->save(false);
                   foreach($houseInfo->images as $value){
                       $value->article_id =  $article->getPrimaryKey();
                       $value->save(false);
                   }
                Yii::$app->session->setFlash('success', "Thông tin tập tin đã được luu ");
                Yii::$app->getResponse()->redirect(['house/index']);
                Yii::$app->end();
            }
        }
        $provinces = ArrayHelper::map(Province::find()->orderBy('type asc, name desc')->all(), 'province_id', function ($province) {
                        return $province->type.' '. $province->name;
                });
            $districts = ArrayHelper::map(District::find()->andWhere(['province_id' => $house->province_id])->orderBy('type desc, name asc')->all(), 'district_id', function ($district) {
                            return $district->type.' '.$district->name;
                });
             $articleTypes = ArrayHelper::map(CategoryType::find()->andWhere(['id' => $house->category_type_id])->orderBy('title asc')->all(), 'id', function ($district) {
                            return $district->title;
                });
              $users = ArrayHelper::map(User::find()->orderBy('name asc')->all(), 'id','name');
       return $this->render('convert', [
            'house' => $house ,
            'provinces' => $provinces,
             'districts' => $districts,
             'article' =>  $article,
             'articleTypes' => $articleTypes,
             'users' => $users
            
        ]);
    }

    /**
     * Creates a new house model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {	
        $model = new House();
		if ($model->load(Yii::$app->request->post())) {
			 if($model->save(false)){
					$stringImageId= Yii::$app->request->post('upload_image_id');
					$arrTemp = !empty($stringImageId) ? explode(';', $stringImageId) : array(); 
					$arrTemp = array_unique($arrTemp); 
					// Image thumbnail
							foreach ($arrTemp as $image_id) {
								if(!empty($image_id)) {
									$articleImage = ArticleImage::findOne(['id' => $image_id]);
									$articleImage->house_id = $model->getPrimaryKey();
									$articleImage->save(false);
								}
							} 
			 }
			return $this->redirect(['view', 'id' => $model->id]);
        }

		$users = ArrayHelper::map(User::find()->orderBy('name asc')->andWhere(['is_employee' => 1])->all(), 'id', 'name');
        $articleTypes = ArrayHelper::map(CategoryType::find()->all(), 'id', 'title');
        $provinces = ArrayHelper::map(Province::find()->orderBy('type asc, name desc')->all(), 'province_id', function ($province) {
                        return $province->type.' '. $province->name;
                });
        $districts = ArrayHelper::map(District::find()->orderBy('type desc, name asc')->all(), 'district_id', function ($district) {
                            return $district->type.' '.$district->name;
                });
       //  $model->contract_date=Yii::$app->formatter->asDate($model->contract_date, "dd-mm-yyyy");
         // $model->contract_end_date=Yii::$app->formatter->asDate($model->contract_end_date, "dd-mm-yyyy");
        return $this->render('create', [
            'model' => $model,
              'users' => $users,
              'articleTypes' =>  $articleTypes,
              'provinces' =>  $provinces,
               'districts'  => $districts 

        ]);
    }

    /**
     * Updates an existing house model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
			 if($model->save(false)){
					$stringImageId= Yii::$app->request->post('upload_image_id');
					$arrTemp = !empty($stringImageId) ? explode(';', $stringImageId) : array(); 
					$arrTemp = array_unique($arrTemp); 
					// Image thumbnail
							foreach ($arrTemp as $image_id) {
								if(!empty($image_id)) {
									$articleImage = ArticleImage::findOne(['id' => $image_id]);
									$articleImage->house_id = $model->getPrimaryKey();
									$articleImage->save(false);
								}
							} 
			 }
            return $this->redirect(['view', 'id' => $model->id]);
        }
		$imageData = ArticleImage::find()->select(['id', 'image'])
        				->where(['house_id' => $id])
        				->asArray()
        				->all();
					
			$dropzoneImage = array();
			if (!empty($imageData)) {
				foreach ($imageData as $item) {
					$dropzoneImage[] =  [ 
										'name' => $item['image'],
										'id' => $item['id'],
										'url' => Yii::$app->params['url-page'].'/channels/article/210x118/'. $item['image'],
										'type' => 'image/*'
									];
				}
			}
        	$users = ArrayHelper::map(User::find()->orderBy('name asc')->andWhere(['is_employee' => 1])->all(), 'id', 'name');
             $articleTypes = ArrayHelper::map(CategoryType::find()->all(), 'id', 'title');
        $provinces = ArrayHelper::map(Province::find()->orderBy('type asc, name desc')->all(), 'province_id', function ($province) {
                        return $province->type.' '. $province->name;
                });
        $districts = ArrayHelper::map(District::find()->andWhere(['province_id' => 79])->orderBy('type desc, name asc')->all(), 'district_id', function ($district) {
                            return $district->type.' '.$district->name;
                });
        
			return $this->render('update', [
				'model' => $model,
				'users' => $users,
				'dropzoneImage' => $dropzoneImage,
                'articleTypes' =>  $articleTypes,
                
              'provinces' =>  $provinces,
               'districts'  => $districts 
			]);
    }

    /**
     * Deletes an existing house model.
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
     * Finds the house model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return house the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = House::findOne($id)) !== null) {
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
			$form->files = UploadedFile::getInstances($form, 'files');
			if ($form->files && $form->validate()) {
				$arrResponse['url'] = array();
				$arrResponse['id'] = array();
							foreach ($form->files as $file) {
									$articleImage = new ArticleImage();
										
										$image_name = date('YmdHis') . gettimeofday()['usec'] . '.' . $file->extension;
										$articleImage->image = $image_name; 
										//$user_id =Yii::$app->user->identity->id;
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
	
	/**
	 * Action delete image on server
	 *
	 * @return string
	 */
	public function actionDeleteImage() {
        $arrResponse = array();
        if (Yii::$app->request->isPost) {
            $id = Yii::$app->request->post('id');
            $image = ArticleImage::findOne(['id' => $id]);
            if ($image){
                $path = Yii::$app->params['PathChannels'] . $image->image;
                $this->deleteFilesFolder($path);
                $image->delete();
            }
        }
        echo json_encode($arrResponse);
        exit();
    }
	 
    /**
     * Function delete files and folders
     *
     * @param
     * @return void
     */
    private function deleteFilesFolder($dir) {
    	if (is_dir($dir)) {
    		$objects = scandir($dir);
    		foreach ($objects as $object) {
    			if ($object != "." && $object != "..") {
    				if (filetype($dir."/".$object) == "dir")
    					$this->delete_files($dir."/".$object);
    				else unlink($dir."/".$object);
    			}
    		}
    		reset($objects);
    		rmdir($dir);
    	} else {
    		if (file_exists($dir)) unlink($dir);
    		if ($this->isDirEmpty(dirname($dir))) {
    			rmdir(dirname($dir));
    		}
    	}
    }
    
    /**
     * Function check directory empty
     *
     * @param
     * @return boolean
     */
    private function isDirEmpty($dir) 
    {
  		if (!is_readable($dir)) return null; 
  		$handle = opendir($dir);
  		while (false !== ($entry = readdir($handle))) {
    		if ($entry != "." && $entry != "..") {
      			return false;
    		}
  		}
  		return true;
	}


}
