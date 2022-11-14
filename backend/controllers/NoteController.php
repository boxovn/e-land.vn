<?php

namespace backend\controllers;

use Yii;
use common\models\Note;
use common\models\NoteInfo;

use backend\models\NoteSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use common\models\Province;
use common\models\District;
use common\models\Employee;
use yii\web\UploadedFile;
use common\models\ArticleImage;
use backend\models\MultipleUploadForm;
use yii\helpers\FileHelper;
use yii\imagine\Image;
/**
 * NoteController implements the CRUD actions for Note model.
 */
class NoteController extends Controller
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
     * Lists all Note models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NoteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $employees =  ArrayHelper::map(Employee::find()->all(),'id','name');   
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'employees' => $employees,
        ]);
    }

    /**
     * Displays a single Note model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
		 $note = $this->findModel($id);
			if(isset($note->noteInfo)){
				 $noteInfo = $note->noteInfo;
				
			}else{
				 $noteInfo = new NoteInfo();
			}
		
		if(Yii::$app->request->isPost) {
               $noteInfo->attributes = Yii::$app->request->post('NoteInfo');
			   $noteInfo->employee_id = Yii::$app->user->identity->id;
			   $noteInfo->note_id = $id;
               if($noteInfo->save(false)) {
				   $note->status= 1;
				   $note->save(false);
				   foreach($note->images as $value){
					   $value->note_info_id =  $noteInfo->getPrimaryKey();
					   $value->save(false);
				   }
                Yii::$app->session->setFlash('success', "Thông tin tập tin đã được luu ");
                Yii::$app->getResponse()->redirect(['note/index']);
                Yii::$app->end();
            }
        }
		$provinces = ArrayHelper::map(Province::find()->orderBy('type asc, name desc')->all(), 'province_id', function ($province) {
						return $province->type.' '. $province->name;
				});
			$districts = ArrayHelper::map(District::find()->andWhere(['province_id' => $noteInfo->province_id])->orderBy('type desc, name asc')->all(), 'district_id', function ($district) {
							return $district->type.' '.$district->name;
				});
       return $this->render('view', [
            'note' => $note ,
			 'noteInfo' =>  $noteInfo,
			 'provinces' => $provinces,
			 'districts' => $districts,
			
        ]);
    }

    /**
     * Creates a new Note model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {	$model = new Note();
		if ($model->load(Yii::$app->request->post())) {
			 if($model->save(false)){
					$stringImageId= Yii::$app->request->post('upload_image_id');
					$arrTemp = !empty($stringImageId) ? explode(';', $stringImageId) : array(); 
					$arrTemp = array_unique($arrTemp); 
					// Image thumbnail
							foreach ($arrTemp as $image_id) {
								if(!empty($image_id)) {
									$articleImage = ArticleImage::findOne(['id' => $image_id]);
									$articleImage->note_id = $model->getPrimaryKey();
									$articleImage->save(false);
								}
							} 
			 }
			return $this->redirect(['view', 'id' => $model->id]);
        }
		 $employees = ArrayHelper::map(Employee::find()->orderBy('name asc')->all(), 'id', 'name');
        return $this->render('create', [
            'model' => $model,
              'employees' => $employees
        ]);
    }

    /**
     * Updates an existing Note model.
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
									$articleImage->note_id = $model->getPrimaryKey();
									$articleImage->save(false);
								}
							} 
			 }
            return $this->redirect(['view', 'id' => $model->id]);
        }
		$imageData = ArticleImage::find()->select(['id', 'image'])
        				->where(['note_id' => $id])
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
        	$employees = ArrayHelper::map(Employee::find()->orderBy('name asc')->all(), 'id', 'name');
			return $this->render('update', [
				'model' => $model,
				'employees' => $employees,
				'dropzoneImage' => $dropzoneImage
			]);
    }

    /**
     * Deletes an existing Note model.
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
     * Finds the Note model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Note the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Note::findOne($id)) !== null) {
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
