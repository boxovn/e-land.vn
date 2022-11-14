<?php
namespace frontend\controllers;
use Yii;
use common\models\User;
use yii\web\Controller;
use yii\filters\AccessControl;
use common\models\Article;
use common\models\Province;
use common\models\District;
use common\models\CategoryType;
use common\models\ArticleImage;
use common\models\ArticleInfo;
use common\models\ArticleDetail;
use yii\data\Pagination;
use common\libraries\PseudoCrypt;
use frontend\models\ArticlePost;
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;
use frontend\models\UploadForm;
use frontend\models\MultipleUploadForm;
use yii\helpers\FileHelper;
use yii\imagine\Image;
use yii\data\ActiveDataProvider;
use yii\web\Response;
class PosterController extends AppController{
	public $enableCsrfValidation = false;
    public $page ='page-student';
    public $title= 'Trang cá nhân';
	public $detail= 'dt';
    public $head= '';
    /**
     * @inheritdoc
     */
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
	 /**
     *
     * @return type
     */
    public function actionAbout(){
			$id = Yii::$app->request->get('id',0);
			$poster = User::findOne(['id' => $id]);
		
				$provinces = ArrayHelper::map(Province::find()->orderBy('type asc, name desc')->all(), 'province_id', function ($province) {
						return $province->type.' '. $province->name;
				});
				$districts = ArrayHelper::map(District::find()->andWhere(['province_id' =>  $poster->province_id])->orderBy('type desc, name asc')->all(), 'district_id', function ($district) {
							return $district->type.' '.$district->name;
				});
			
			
			return $this->render('about', [
						'provinces' => $provinces,
						'districts' => $districts,
						'poster' => $poster,
						
			]);
         
	}
	
    /**
     *
     * @return type
     */
    public function actionIndex(){
			$this->view->title = 'Tin đã đăng';
			$article_id = Yii::$app->request->get('article_id');
			$id = Yii::$app->request->get('id');
			//$user_id= PseudoCrypt::unhash($id);	
			$article = new Article();
			$user = Yii::$app->user->identity;
			$poster = User::findOne(['id' => $id]);
			if(Yii::$app->request->isPost){
					$article->attributes =  Yii::$app->request->post('Article');
					$user->attributes =  Yii::$app->request->post('User');
					$article->imageFile = UploadedFile::getInstance($article, 'imageFile');
					if(isset($article->imageFile->name)){
						$filename = date('YmdHis').gettimeofday()['usec']. '.' . $article->imageFile->extension;
						$article->image= $filename;
					}
					$article->user_id= $id;
					$article->post_date= date('Y-m-d');
					$stringImageId= Yii::$app->request->post('upload_image_id');
				
					$arrTemp = !empty($stringImageId) ? explode(';', $stringImageId) : array(); 
					$arrTemp = array_unique($arrTemp); 
					if($article->save() && $article->upload()){
							//
							$articleDetail = new ArticleDetail();
							$articleDetail->attributes=  Yii::$app->request->post('ArticleDetail');
							$articleDetail->article_id = $article->getPrimaryKey();
							$articleDetail->save();
							//
							$articleDetail = new ArticleInfo();
							$articleDetail->attributes=  Yii::$app->request->post('ArticleInfo');
							$articleDetail->article_id = $article->getPrimaryKey();
							$articleDetail->save();
							// Image thumbnail
							foreach ($arrTemp as $id) {
								if(!empty($id)) {
									$articleImage = ArticleImage::findOne(['id' => $id]);
									$articleImage->article_id = $article->getPrimaryKey();
									$articleImage->save(false);
								}
							} 
						
							Yii::$app->session->setFlash('success', "Cập nhập thành công");
							Yii::$app->getResponse()->redirect(['user/index','id' => $id]);
							Yii::$app->end();
						
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
				
            $query = Article::find()->andWhere(['user_id' => $id]);
			$provinces = ArrayHelper::map(Province::find()->all(), 'province_id', 'name');// Province::find()->all();
			$districts = ArrayHelper::map(District::find()->all(), 'district_id', 'name');// District::find()->all();
			$CategoryTypes = ArrayHelper::map(CategoryType::find()->all(), 'id', 'title');// District::find()->all();
			$models = $query->offset(0)->limit(14)
                       ->orderBy('created desc')
						->all();
					
             return $this->render('index', [
						'detail' => $this->detail,
                        'category_slug' => Yii::$app->request->get('slug'),
                        'models' => $models,
						'user' => $user,
						'poster' => $poster,
						'post' => (Yii::$app->user->identity && Yii::$app->user->identity->id==$id)? true: false,
						'article' => $article,
						'provinces' => $provinces,
						'districts' => $districts,
						'CategoryTypes' => $CategoryTypes,
            ]);
         
        
	}

	
	
    
}