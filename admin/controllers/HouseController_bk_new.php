<?php
namespace admin\controllers;
use Yii;
use common\models\Street;
use common\models\ArticleType;
use common\models\House;
use common\models\HouseInfo;
use admin\models\HouseSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use common\models\Province;
use common\models\District;
use common\models\Employee;
use yii\web\UploadedFile;
use common\models\ArticleImage;
use admin\models\MultipleUploadForm;
use yii\helpers\FileHelper;
use yii\imagine\Image;
use admin\models\HouseSurveySearch;
use common\models\HouseSurvey;
use admin\models\HousePartnerSearch;
use admin\models\HousePartnerIndexSearch;
use yii\behaviors\AttributeBehavior;
use yii\db\ActiveRecord;
/**
 * HouseController implements the CRUD actions for House model.
 */
class HouseController extends Controller
{
    /**
     * {@inheritdoc}
     */
    /*public function behaviors()
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
    */
    public function behaviors()
    {

        return [
            [
                'class' => AttributeBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'contract_date', // update 1 attribute 'created' OR multiple attribute ['created','updated']
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'contract_date', // update 1 attribute 'created' OR multiple attribute ['created','updated']
                ],
                'value' => function ($event) {
                    var_dump($this->contract_date);
                    die;
                    return date('Y-m-d', strtotime(str_replace("/","-",$this->contract_date)));
                },
            ],
            [
                'class' => AttributeBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'contract_end_date', // update 1 attribute 'created' OR multiple attribute ['created','updated']
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'contract_end_date', // update 1 attribute 'created' OR multiple attribute ['created','updated']
                ],
                'value' => function ($event) {
                    var_dump($this->contract_end_date);
                    die;
                    return date('Y-m-d', strtotime(str_replace("/","-",$this->contract_end_date)));
                },
            ],
        ];
    }
	public function beforeAction($action) 
{ 
    $this->enableCsrfValidation = false; 
    return parent::beforeAction($action); 
}
 public function actionDistricts() 
    {	 
		
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
        //$employees =  ArrayHelper::map(Employee::find()->all(),'id','name');   
       //  $users =  ArrayHelper::map(User::find()->all(),'id','name');  
        $articleTypes = ArrayHelper::map(ArticleType::find()->all(), 'id', 'title');
        $provinces = ArrayHelper::map(Province::find()->orderBy('type asc, name desc')->all(), 'province_id', function ($province) {
                        return $province->type.' '. $province->name;
                });
        $districts = ArrayHelper::map(District::find()->andWhere(['province_id' => 79])->orderBy('type desc, name asc')->all(), 'district_id', function ($district) {
                            return $district->type.' '.$district->name;
                }); 
       /*   $streets = ArrayHelper::map(Street::find()->orderBy('type desc, name asc')->all(), 'district_id', function ($street) {
                            return $street->type .' '. $street->name;
                }); 
                */
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'districts' =>  $districts,
            'provinces' =>  $provinces,
        
        ]);
       
    }
     /**
     * Lists all House models.
     * @return mixed
     */
    public function actionPartnerIndex()
    {
        $searchModel = new HousePartnerIndexSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
      //  $employees =  ArrayHelper::map(Employee::find()->all(),'id','name');   
        return $this->render('partner_index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
          //  'employees' => $employees,
        ]);
    }
    public function actionSurvey()
    {
        $house = $this->findModel(Yii::$app->request->queryParams['id']);
        $searchModel = new HouseSurveySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('survey', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'house' => $house,
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
			   //$houseInfo->employee_id = Yii::$app->user->identity->id;
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
      public function actionConvert($id)
    {
            $house = $this->findModel($id);
            if(isset($house->article)){
                 $article = $house->article;
            }else{
                 $article = new Article();
                 $article->title =  $house->title;
                 $article->area_text =  $house->area;
                 $article->price_text =  $house->price;
                 $article->title = $house->title;
                 $article->province_id = $house->province_id;
                 $article->district_id = $house->district_id;
                 $article->type_id = $house->type_id;
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
            $districts = ArrayHelper::map(District::find()->andWhere(['province_id' => $houseInfo->province_id])->orderBy('type desc, name asc')->all(), 'district_id', function ($district) {
                            return $district->type.' '.$district->name;
                });
       return $this->render('convert', [
            'house' => $house ,
             'houseInfo' =>  $houseInfo,
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
    {	$model = new House();
		if ($model->load(Yii::$app->request->post())) {
                $model->user_id =  Yii::$app->user->identity->id;
                $model->contract_date = Yii::$app->formatter->asDate(str_replace("/","-",$model->contract_date) , 'php:Y-m-d H:i:s'); // 2014-10-06 15:22:34
                $model->contract_end_date = Yii::$app->formatter->asDate(str_replace("/","-",$model->contract_end_date) , 'php:Y-m-d H:i:s'); // 2014-10-06 15:22:34
			 if($model->save()){
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
                            return $this->redirect(['view', 'id' => $model->getPrimaryKey()]);
			 }
			
        }
	  $provinces = ArrayHelper::map(Province::find()->orderBy('type asc, name desc')->all(), 'province_id', function ($province) {
                        return $province->type.' '. $province->name;
                });
        $districts = ArrayHelper::map(District::find()->andWhere(['province_id' => 79])->orderBy('type desc, name asc')->all(), 'district_id', function ($district) {
                            return $district->type.' '.$district->name;
                });
       
        return $this->render('create', [
            'model' => $model,
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
             $model->contract_date = Yii::$app->formatter->asDate(str_replace("/","-",$model->contract_date) , 'php:Y-m-d H:i:s'); 
              $model->contract_end_date = Yii::$app->formatter->asDate(str_replace("/","-",$model->contract_end_date) , 'php:Y-m-d H:i:s'); 
			 if($model->save()){
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
        	//$employees = ArrayHelper::map(Employee::find()->orderBy('name asc')->all(), 'id', 'name');
			$provinces = ArrayHelper::map(Province::find()->orderBy('type asc, name desc')->all(), 'province_id', function ($province) {
                        return $province->type.' '. $province->name;
                });
        $districts = ArrayHelper::map(District::find()->andWhere(['province_id' => 79])->orderBy('type desc, name asc')->all(), 'district_id', function ($district) {
                            return $district->type.' '.$district->name;
                });
            return $this->render('update', [
				'model' => $model,
				'provinces' => $provinces,
                'districts' => $districts,
                //'employees' => $employees,
				'dropzoneImage' => $dropzoneImage
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
        $model = $this->findModel($id);
        $model->status = House::DELETE_STATUS;
        $model->save();
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
        
        if (($model = House::findOne(['id' => $id, 'user_id' =>  Yii::$app->user->identity->id]))!== null) {
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
