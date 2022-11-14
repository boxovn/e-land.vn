<?php
namespace api\controllers;
use yii;
use yii\rest\ActiveController;
use common\models\User;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use api\models\LoginForm;
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;
use common\models\ArticleImage;
use yii\helpers\FileHelper;
use yii\imagine\Image;
use api\models\MultipleUploadForm;
use common\models\Article;
use common\models\CustomerUser;
use api\models\UploadAvatar;
use api\models\ApiArticle;
class UserController extends AppController { 
 public  $enableSession = false;
   public $modelClass = User::class;
   public function actions()
{
    $actions = parent::actions();
    // Overriding action
     unset($actions['delete'], $actions['create'],$actions['update']);
    $actions['index']['prepareDataProvider'] = function($action) 
    {
       
        return new \yii\data\ActiveDataProvider([
           'query' => User::find()->andWhere(['id' => $this->users,'active' => User::STATUS_ACTIVE]),

        ]);
    };
	//$actions['update-article']['prepareDataProvider'] =  [$this, 'updateArticleDataProvider'];

    return $actions;
}

/*
public function checkAccess($action, $model = null, $params = [])
{
    // check if the user can access $action and $model
    // throw ForbiddenHttpException if access should be denied
    if ($action === 'update' || $action === 'delete') {
        if ($model->author_id !== \Yii::$app->user->id)
            throw new \yii\web\ForbiddenHttpException(sprintf('You can only %s articles that you\'ve created.', $action));
    }
}*/

public function behaviors()
{
    $behaviors = parent::behaviors();
    unset($behaviors['authenticator']);
   /* $behaviors['contentNegotiator'] =  [
      'class' => \yii\ filters\ ContentNegotiator::className(),
     // 'only' => ['index', 'view','update','login'],
      'formats' => [
        'application/json' => \yii\ web\ Response::FORMAT_JSON,
      ],
    ];
    */
     $behaviors['authenticator'] = [
        'class' => CompositeAuth::className(),
        'except' => ['login'],
        'authMethods' => [
            HttpBasicAuth::className(),
            HttpBearerAuth::className(),
            QueryParamAuth::className(),
        ],
    ];
    /*
    $behaviors['authenticator'] = [
        'class' =>  HttpBearerAuth::className(),
        'except' => ['login','test','create'],
    ];
    */
    $behaviors['verbs'] = [
            'class' => yii\filters\VerbFilter::className(),
            'actions' => [
                'test' => ['GET','POST','OPTIONS'],
                'add' => ['GET','POST','OPTIONS'],
				'upload' => ['POST','OPTIONS'],
				'upload-avatar' => ['POST','OPTIONS'],
                'login'  => ['POST'],
              	'index'  => ['GET'],
                'view'   => ['GET'],
				'create' => ['POST','OPTIONS'],
				'register' => ['POST','OPTIONS'],
            	'update-article' => ['POST','OPTIONS'],
              	 'delete' => ['POST', 'DELETE'],
                //'search' => ['GET']
            ],

        ];

    return $behaviors;
}
public function actionUploadAvatar(){
		$model = new UploadAvatar();
		if (Yii::$app->request->isPost) {
			$model->image = UploadedFile::getInstanceByName('image');
			if ($model->upload()) {
				$user =User::findOne(['id' => Yii::$app->user->identity->id]);
				$user->image =  $model->image->name;
				$user->save(false);
					
               return $user;
            }
        }

        return $model ;
    }
 
  /**
     * Deletes an existing Slider model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
	
		$model = $this->findModel($id);
		$model->active = User::STATUS_DEACTIVE;
		if ($model->save(false)) {
            return  $model;
        }else{
			return 'Xoá không thành công';
		}
	}
    /**
     * Finds the Slider model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Slider the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('User', 'The requested page does not exist.'));
    }
 public function actionTest(){
          return 1;
        }
public function actionImageMultipleUpload()
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
		return $arrResponse;
    	exit();
    }
    
       
    public function actionUpload()
	{
		$form = new \api\models\UploadForm();
		$filename = date('Y_m_d_His').gettimeofday()['usec'];
		if (Yii::$app->request->isPost) {
           $form->file = UploadedFile::getInstanceByName('file');// UploadedFile::getInstances($form, 'files');
         
			if ($form->file && $form->validate()) {
              
							$articleImage = new ArticleImage();
							$image_name = date('YmdHis') . gettimeofday()['usec'] . '.' . $form->file->extension;
							$articleImage->image = $image_name; 
										if ($articleImage->save(false)) {
												$path = Yii::$app->params['PathChannels']  . 'article/images/';
												$path745x510 = Yii::$app->params['PathChannels'] . 'article/745x510/';
												$path210X118 = Yii::$app->params['PathChannels'] . 'article/210x118/';
												$path200X200 = Yii::$app->params['PathChannels']  . 'article/200x200/';
												FileHelper::createDirectory($path, $mode = 0775, $recursive = true);
												FileHelper::createDirectory($path745x510, $mode = 0775, $recursive = true);
												FileHelper::createDirectory($path210X118, $mode = 0775, $recursive = true);
												FileHelper::createDirectory($path200X200, $mode = 0775, $recursive = true);
											if ($form->file->saveAs($path . $image_name, false)) {
													Image::thumbnail($path . $image_name, 745, 510)->save($path745x510 . $image_name, ['quality' => 100]);
													Image::thumbnail($path . $image_name, 210, 118)->save($path210X118 . $image_name, ['quality' => 100]);
													Image::thumbnail($path . $image_name, 200, 200)->save($path200X200 . $image_name, ['quality' => 100]);
                                            }
                                            return ['id'=> $articleImage->id,'image' => $articleImage->image];
											
										}
							}
										
			
		}
		  return ['id'=> 0,'image' => ''];
	}

   
     
    public function actionLogin()
    {
      
     
        $model = new LoginForm();
       if ($model->load(Yii::$app->request->post(), '') && $model->login()) {
          $user =   $model->login();
            return $user;
        } else {
            return $model->getFirstErrors();
        }
    }


  public function actionAdd(){
            $user = Yii::$app->user->identity;
            $article = new Article();
			if(Yii::$app->request->isPost){
				    $article->attributes =  Yii::$app->request->post('Article');
					$article->user_id= $user->id;
					$article->post_date= date('Y-m-d');
					$article->description = $article->content;
					$article->status= Article::STATUS_ACTIVE;
					//$article->content = nl2br($article->content);
					$stringImageId= Yii::$app->request->post('upload_image_id');
					$arrTemp = !empty($stringImageId) ? explode(';', $stringImageId) : array(); 
					$arrTemp = array_unique($arrTemp); 
					if($article->save()){
						    // Image thumbnail
							foreach ($arrTemp as $image_id) {
								if(!empty($image_id)) {
									$articleImage = ArticleImage::findOne(['id' => $image_id]);
									$articleImage->article_id = $article->getPrimaryKey();
									$articleImage->save(false);
								}
							} 
							
                            $message="Cập nhập thành công!";
					} else {
						// Delete image upload on server and in DB
						foreach ($arrTemp as $image_id) {
							if(!empty($image_id)) {
								$articleImage = ArticleImage::findOne(['id' => $image_id]);
								if (!empty($articleImage)) {
										$user = Yii::$app->user->identity;
										$path = Yii::$app->params['PathChannels'] . ($user->code?$user->code:PseudoCrypt::hash($user->id)) . '/photos/articles/';
									$imgUrl =$path .$articleImage->image;
									$this->deleteFilesFolder($imgUrl);
									$articleImage->delete();
								}
							}
                        }
                          $message="Cập nhập không thành công!";
                    }
                    return [ 'message' => $message,'article' => $article];
                }
                return [ 'message' => $message,'article' => $article];
        
    }
     public function actionCreate(){
			$user ='12121';// Yii::$app->user->identity;
           // $article = new Article();
          return ['success' => true];
			if(Yii::$app->request->isPost){
					$article->attributes =  Yii::$app->request->post('Article');
					$article->user_id= $user->id;
					$article->post_date= date('Y-m-d');
					$article->description = $article->content;
					//$article->content = nl2br($article->content);
					$stringImageId= Yii::$app->request->post('upload_image_id');
					$arrTemp = !empty($stringImageId) ? explode(';', $stringImageId) : array(); 
					$arrTemp = array_unique($arrTemp); 
					if($article->save()){
						    // Image thumbnail
							foreach ($arrTemp as $image_id) {
								if(!empty($image_id)) {
									$articleImage = ArticleImage::findOne(['id' => $image_id]);
									$articleImage->article_id = $article->getPrimaryKey();
									$articleImage->save(false);
								}
							} 
							Yii::$app->session->setFlash('success', "Cập nhập thành công");
							Yii::$app->getResponse()->redirect(['user/index','id' => $id]);
							Yii::$app->end();
						
					} else {
						// Delete image upload on server and in DB
						foreach ($arrTemp as $image_id) {
							if(!empty($image_id)) {
								$articleImage = ArticleImage::findOne(['id' => $image_id]);
								if (!empty($articleImage)) {
										$user = Yii::$app->user->identity;
										$path = Yii::$app->params['PathChannels'] . ($user->code?$user->code:PseudoCrypt::hash($user->id)) . '/photos/articles/';
									$imgUrl =$path .$articleImage->image;
									$this->deleteFilesFolder($imgUrl);
									$articleImage->delete();
								}
							}
						}
                    }
                    return true;
				}
		return false;
	}

	 public function actionRegister() {
		 $model = new User();
		 $model->setScenario('creating');
			if (Yii::$app->request->isPost) {
            $model->attributes = Yii::$app->request->post('User');
            $model->updated_at = date('Y-m-d H:i:s');
			$model->status = 1;//User::STATUS_DEACTIVE;
			if ($model->validate()) {
				$model->setPassword($model->password);
                $model->generatePasswordResetToken();
                if($model->save(false)){
					$customerUser = new CustomerUser();
					$customerUser->customer_id = $this->customer_id;
					$customerUser->user_id = $model->getPrimaryKey();
					if(!$customerUser->save()){
							 return $customerUser->getErrors();
					}else{
						return $customerUser;
					}
					
					
				}
               //send mail
             /*   $resetLink = Yii::$app->urlManager->createAbsoluteUrl(['index/success', 'token' => $model->password_reset_token]);
               \Yii::$app->mailer->compose(['html' => 'confirm-html'], ['user' => $model,'resetLink' => $resetLink])
                        ->setFrom([\Yii::$app->params['supportEmail'] => 'E-land '])
                        ->setTo($model->email)
                        ->setSubject('Xác nhận đăng ký tài khoản thành công ')
                        ->send();
                Yii::$app->session->setFlash('success', "Bạn đã đăng ký thành công");
                Yii::$app->getResponse()->redirect(['index/confirm']);
				Yii::$app->end();
				*/
				
				 return $model;
			}else{
				  return $model->getErrors();
			}
			 return false;
		}
		
    }
  

	  public function actionUpdateArticle(){
		$user = Yii::$app->user->identity;
		if($user){
				$article_id = Yii::$app->request->get('id');
				$article = Article::findOne(['user_id' => $user->id, 'id' => $article_id]);
				if(!$article){
					 throw new \yii\web\HttpException(403, 'Bài viết không tồn tại');
				}
				if(Yii::$app->request->isPost){
					$postArticle=Yii::$app->request->post('Article');
					$article->attributes =  $postArticle;
					$article->user_id= $user->id;
					$stringImageId= Yii::$app->request->post('upload_image_id');//$postArticle['upload_image_id'];
					$arrTemp = !empty($stringImageId) ? explode(',', $stringImageId) : array(); 
					$arrTemp = array_unique($arrTemp); 
					if($article->save()){
							// Image thumbnail
							foreach ($arrTemp as $id) {
								if(!empty($id)) {
									$articleImage = ArticleImage::findOne(['id' => $id,'article_id' => 0]);
									if($articleImage){
										$articleImage->article_id = $article->getPrimaryKey();
										$articleImage->save(false);
									}
								}
							}
							
					} else {
						// Delete image upload on server and in DB
						foreach ($arrTemp as $id) {
							if(!empty($id)) {
								$articleImage = ArticleImage::findOne(['id' => $id]);
								if (!empty($articleImage)) {
										$user = Yii::$app->user->identity;
										$path = Yii::$app->params['PathChannels'] . ($user->code?$user->code:PseudoCrypt::hash($user->id)) . '/photos/articles/';
									$imgUrl =$path .$articleImage->image;
									$this->deleteFilesFolder($imgUrl);
									$articleImage->delete();
								}
							}
						}
					}
				
				}
			 	return  $article;
			 }else{
				    throw new \yii\web\HttpException(403, 'Không có quyền truy cập');
			 }
         
        
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