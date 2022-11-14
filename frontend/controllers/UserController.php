<?php
namespace frontend\controllers;
use Yii;
use common\models\User;
use yii\web\Controller;
use yii\filters\AccessControl;
use common\models\Article;
use common\models\Province;
use common\models\District;
use common\models\Ward;
use common\models\CategoryType;
use common\models\ArticleImage;
use common\models\ArticleInfo;
use common\models\ArticleOwner;
use common\models\ArticleDetail;
use common\models\Street;
use common\models\Category;
use yii\data\Pagination;
use common\libraries\PseudoCrypt;
use frontend\models\ArticlePost;
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;
use frontend\models\UploadForm;
use frontend\models\UploadArticleImage;
use frontend\models\MultipleUploadForm;
use yii\helpers\FileHelper;
use yii\imagine\Image;
use yii\data\ActiveDataProvider;
use yii\web\Response;
use yii\helpers\Json;
class UserController extends AppController{
	//public $enableCsrfValidation = false;
    public $page ='page-student';
    public $title= 'Trang cá nhân';
	public $detail= 'dt';
    public $head= '';
    /**
     * @inheritdoc
     */
	public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
				'rules' => [
					[
                        'allow' => true,
                        'roles' => ['@'],
                    ],
					
                ],
            ]
        ];
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
			$user = Yii::$app->user->identity;
			if(Yii::$app->request->isPost){
						$user->attributes =  Yii::$app->request->post('User');
						$user->birthday= date('Y-m-d', strtotime(str_replace('/', '-', $user->birthday)));
						$user->save(false);
				}
				$provinces = ArrayHelper::map(Province::find()->orderBy('type asc, name desc')->all(), 'province_id', function ($province) {
						return $province->type.' '. $province->name;
				});
				$districts = ArrayHelper::map(District::find()->andWhere(['province_id' =>  isset($user)?$user->province_id:0])->orderBy('type desc, name asc')->all(), 'district_id', function ($district) {
							return $district->type.' '.$district->name;
				});
			
			return $this->render('about', [
						'provinces' => $provinces,
						'districts' => $districts,
						'user' => $user,
                        
			]);
         
	}
	
	 public function actionPost(){
	
			//$id = Yii::$app->request->get('id',0);
			$user = Yii::$app->user->identity;
			$errorArray = [];
			//$myself= ($user && $id > 0 && $user->id==$id)? true: false;
			$article = new Article();
			//$user_id= PseudoCrypt::unhash($id);	
			$session = Yii::$app->session;
			
			$categories = Category::find()->andWhere(['status' => 1])->andWhere(['<>','slug','du-an'])->all();
			$provinces = Province::find()->orderBy('type asc, name desc')->all();
			
			$districtQuery = District::find();
			if($session->has('province_id')){
					$districtQuery->andWhere(['province_id' => $session->get('province_id')]);
			}else{
					$districtQuery->andWhere(['province_id' => $article->province_id]);
			}
			$province= Province::findOne(['province_id' => $session->get('province_id')]);
			$districts = $districtQuery->orderBy('type desc, name asc')->all();

			$wards = Ward::find()->andWhere(['district_id' => $article->district_id])->orderBy('type desc, name asc')->all();
		/*
			$categoryTypes = CategoryType::find()->joinWith(['category' => function( yii\db\ActiveQuery $query){
				return $query->andWhere(['<>','categories.slug','du-an']);
		}])->all();// District::find()->all();
			$categoryTypePurchases = CategoryType::find()->joinWith(['category' => function( yii\db\ActiveQuery $query){
					return $query->andWhere(['=','categories.slug','mua-ban']);
			}])->all();// District::find()->all();
			$categoryTypeRents = CategoryType::find()->joinWith(['category' => function( yii\db\ActiveQuery $query){
				return $query->andWhere(['=','categories.slug','cho-thue']);
				}])->all();// District::find()->all();
			*/
			if(Yii::$app->request->isPost){
				
					$article->attributes =  Yii::$app->request->post('Article');
					$article->user_id= $user->id;
					$article->post_date= date('Y-m-d');
					$article->price = str_replace(',', '', $article->price);
					$article->price_rent = $article->price_rent?str_replace(',', '', $article->price_rent):0;
					$article->area = str_replace(',', '', $article->area);
					$article->description = strip_tags($article->content);
					$stringImageId=$article->upload_image_id; // Yii::$app->request->post('upload_image_id');
					$arrTemp = !empty($stringImageId) ? explode(';', $stringImageId) : array(); 
					$arrTemp = array_unique($arrTemp); 
					if($article->validate() && $article->save()){
						//
							$articleDetail = new ArticleDetail();
							$articleDetail->attributes=  Yii::$app->request->post('ArticleDetail');
							$articleDetail->article_id = $article->getPrimaryKey();
							if(!$articleDetail->save()){
								//$message= "Cập nhập người sở hữu thất bại";
								foreach($articleDetail->getErrors() as $key => $val) {
									$errorArray[] = [
										'field' => $key,
										'message' => implode(', ', $val) // $val is array (can contain multiple error messages)
									];

									}
							}
							$articleOwner = new ArticleOwner();
							$articleOwnerArray = Yii::$app->request->post('ArticleOwner');
							$articleOwner->name = $articleOwnerArray['name'][$article['is_owner']];
							$articleOwner->phone = $articleOwnerArray['phone'][$article['is_owner']];
							$articleOwner->email = $articleOwnerArray['email'][$article['is_owner']];
							$articleOwner->article_id = $article->getPrimaryKey();
							if(!$articleOwner->save()){
								//$message= "Cập nhập người sở hữu thất bại";
								foreach($articleOwner->getErrors() as $key => $val) {
													$errorArray[] = [
														'field' => $key,
														'message' => implode(', ', $val) // $val is array (can contain multiple error messages)
													];
									}
							}
							// Image thumbnail
							foreach ($arrTemp as $image_id) {
								if(!empty($image_id)) {
									$articleImage = ArticleImage::findOne(['id' => $image_id,'user_id' => 	$user->id]);
									if($articleImage){
												$message= "Lưu hình ảnh của sản phẩm thành công";
												$articleImage->article_id = $article->getPrimaryKey();
												$articleImage->save(false);
									}else{
										$message= "Hình sản phẩm tin rao không tồn tại";
									}
								}
							} 
						
						
					} else {
						// Delete image upload on server and in DB
					/*		foreach ($arrTemp as $image_id) {
											if(!empty($image_id)) {
															$articleImage = ArticleImage::findOne(['id' => $image_id]);
															if (!empty($articleImage)) {
																	$user = Yii::$app->user->identity;
																	$path = Yii::$app->params['PathChannels'] . 'article/images/';
																	$imgUrl =$path .$articleImage->image;
																	$this->deleteFilesFolder($imgUrl);
																	$articleImage->delete();
															}
											}
							}
								*/
							foreach($article->getErrors() as $key => $val) {
												$errorArray[] = [
													'field' => $key,
													'message' => implode(', ', $val) // $val is array (can contain multiple error messages)
												];
	
						}
					
					}
								$data=	[
									
									//	'provinces' => $provinces,
									//	'districts' => $districts,
									//	'streets' =>  $streets,
									//	'user' => $user,
										'dropzoneImages' => 0,
								//		'article' => $article,
								//		'province' => $province,
									//	'categoryTypes' => $categoryTypes,
									//	'categoryTypePurchases' => $categoryTypePurchases,
								//		'categoryTypeRents' => $categoryTypeRents,
										'errors' => $errorArray,
								];
					return $this->asJson($data);

				}
				
		
			return $this->render('post', [
						'categories' => 	$categories,
						'errorArray' =>  $errorArray,
						'provinces' => $provinces,
						'districts' => $districts,
						'wards' =>  $wards,
						'user' => $user,
						'dropzoneImages' => 0,
						'article' => $article,
						'province' => $province,
					//	'categoryTypes' => $categoryTypes,
					//	'categoryTypePurchases' => $categoryTypePurchases,
					//	'categoryTypeRents' => $categoryTypeRents,
			]);
	}
	
	protected function findModel($id)
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('about', 'The requested page does not exist.'));
    }
	public function actionEdit(){
		$user = Yii::$app->user->identity;
		$errorArray = [];
		$article  = $this->findModel(Yii::$app->request->get('article_id'));
	
		$session = Yii::$app->session;
			$categories = Category::find()->andWhere(['status' => 1])->andWhere(['<>','slug','du-an'])->all();
			$provinces = Province::find()->orderBy('type asc, name desc')->all();
			
			$districtQuery = District::find();
			if($session->has('province_id')){
					$districtQuery->andWhere(['province_id' => $session->get('province_id')]);
			}else{
					$districtQuery->andWhere(['province_id' => $article->province_id]);
			}
			$province= Province::findOne(['province_id' => $session->get('province_id')]);
			$districts = $districtQuery->orderBy('type desc, name asc')->all();

			$wards = Ward::find()->andWhere(['district_id' => $article->district_id])->orderBy('type desc, name asc')->all();
			if(Yii::$app->request->isPost){
				
				$article->attributes =  Yii::$app->request->post('Article');
				$article->user_id= $user->id;
				$article->post_date= date('Y-m-d');
				$article->price = str_replace(',', '', $article->price);
				$article->price_rent = $article->price_rent?str_replace(',', '', $article->price_rent):0;
				$article->area = str_replace(',', '', $article->area);
				$article->description = strip_tags($article->content);
				
				$stringImageId=$article->upload_image_id; // Yii::$app->request->post('upload_image_id');
				$arrTemp = !empty($stringImageId) ? explode(';', $stringImageId) : array(); 
				$arrTemp = array_unique($arrTemp); 
				if($article->validate() && $article->save()){
					//
						if(isset($article->articleDetail) && $article->articleDetail){
								$articleDetail = $article->articleDetail;
						}else{
								$articleDetail = new ArticleDetail();
						}

						$articleDetail->attributes=  Yii::$app->request->post('ArticleDetail');
						$articleDetail->article_id = $article->getPrimaryKey();

						if(!$articleDetail->save()){
							//$message= "Cập nhập người sở hữu thất bại";
							foreach($articleDetail->getErrors() as $key => $val) {
								$errorArray[] = [
									'field' => $key,
									'message' => implode(', ', $val) // $val is array (can contain multiple error messages)
								];

								}
						}
						
						
						if(isset($article->articleOwner) && $article->articleOwner){
							$articleOwner = $article->articleOwner;
						}else{
								$articleOwner = new ArticleOwner();
						}
						
						$articleOwnerArray = Yii::$app->request->post('ArticleOwner');
						$articleOwner->name = $articleOwnerArray['name'][$article['is_owner']];
						$articleOwner->phone = $articleOwnerArray['phone'][$article['is_owner']];
						$articleOwner->email = $articleOwnerArray['email'][$article['is_owner']];
						$articleOwner->article_id = $article->getPrimaryKey();
						if(!$articleOwner->save()){
							//$message= "Cập nhập người sở hữu thất bại";
							foreach($articleOwner->getErrors() as $key => $val) {
												$errorArray[] = [
													'field' => $key,
													'message' => implode(', ', $val) // $val is array (can contain multiple error messages)
												];
								}
						}
						// Image thumbnail
						foreach ($arrTemp as $image_id) {
							if(!empty($image_id)) {
								$articleImage = ArticleImage::findOne(['id' => $image_id,'user_id' => 	$user->id]);
								if($articleImage){
											$message= "Lưu hình ảnh của sản phẩm thành công";
											$articleImage->article_id = $article->getPrimaryKey();
											$articleImage->save(false);
								}else{
									$message= "Hình sản phẩm tin rao không tồn tại";
								}
							}
						} 
					
					
				} else {
					// Delete image upload on server and in DB
				
						foreach($article->getErrors() as $key => $val) {
											$errorArray[] = [
												'field' => $key,
												'message' => implode(', ', $val) // $val is array (can contain multiple error messages)
											];

					}
				}
							$data=	[
								
								//	'provinces' => $provinces,
								//	'districts' => $districts,
								//	'streets' =>  $streets,
								//	'user' => $user,
									'dropzoneImages' =>$this->dropzoneImages($article->id),
							//		'article' => $article,
							//		'province' => $province,
								//	'categoryTypes' => $categoryTypes,
								//	'categoryTypePurchases' => $categoryTypePurchases,
							//		'categoryTypeRents' => $categoryTypeRents,
									'errors' => $errorArray,
							];
				return $this->asJson($data);

			}
	

			return $this->render('post', [
				'categories' => 	$categories,
				'errorArray' =>  $errorArray,
				'provinces' => $provinces,
				'districts' => $districts,
				'wards' =>  $wards,
				'user' => $user,
				'dropzoneImages' =>  $this->dropzoneImages($article->id),
				'article' => $article,
				'province' => $province,
			//	'categoryTypes' => $categoryTypes,
			//	'categoryTypePurchases' => $categoryTypePurchases,
			//	'categoryTypeRents' => $categoryTypeRents,
	]);

}

	private function dropzoneImages($id){
		
		$projectImage = ArticleImage::find()
						->where(['article_id' => $id])
						->all();
					
		$dropzoneFile = array();
		if ($projectImage) {
			foreach ($projectImage as  $item) {
				$dropzoneFile[] =[
					'image' => $item->image,
					'file_name' =>  $item->file_name,
					'id' => $item->id,
					'url_file_name' => Yii::$app->params['url-channels'].'article/210x118/'. $item->image,
					'type' => $item->type,
					'size' => $item->size,
				];
			}
		} 
		return  $dropzoneFile;
	}

	 /**
     *
     * @return type
     */
    public function actionContact(){
		 return $this->render('index', ['']);
	}
	 /**
     *
     * @return type
     */
    public function actionBooking(){
			$id = Yii::$app->request->get('id',0);
			$user = Yii::$app->user->identity;
			$myself= ($user && $id > 0 && $user->id==$id)? true: false;
			//$user_id= PseudoCrypt::unhash($id);	
			if($myself){
				if(Yii::$app->request->isPost){
					$user->attributes =  Yii::$app->request->post('User');
					$user-save();
				}
			}else{
				$user = User::findOne(['id' => $id]);
			}
			$provinces = ArrayHelper::map(Province::find()->all(), 'province_id', 'name');// Province::find()->all();
			$districts = ArrayHelper::map(District::find()->all(), 'district_id', 'name');// District::find()->all();
			
		   return $this->render('booking', [
						'provinces' => $provinces,
						'districts' => $districts,
						'user' => $user,
						'myself' => $myself,
			]);
		
	}

	public function actionSettingEmail(){
			$id = Yii::$app->request->get('id',0);
			$user = Yii::$app->user->identity;
			$myself= ($user && $id > 0 && $user->id==$id)? true: false;
			//$user_id= PseudoCrypt::unhash($id);	
			if($myself){
				if(Yii::$app->request->isPost){
					$user->attributes =  Yii::$app->request->post('User');
					$user-save();
				}
			}else{
				$user = User::findOne(['id' => $id]);
			}
			$provinces = Province::find()->select(['province_id','name'])->all();// ArrayHelper::map(Province::find()->all(), 'province_id', 'name');// Province::find()->all();
			$districts = District::find()->select(['district_id','name'])->all(); //ArrayHelper::map(District::find()->all(), 'district_id', 'name');// District::find()->all();
			
		   return $this->render('setting', [
						'provinces' => $provinces,
						'districts' => $districts,
						'user' => $user,
						'myself' => $myself,
			]);
		
	}
    /**
     *
     * @return type
     */
	public function actionIndex(){
		$this->view->title = 'Tin đã đăng';
		$user = Yii::$app->user->identity;
		$query = Article::find()->andWhere(['user_id' => $user->id]);
		$models = $query->offset(0)->limit(40)
				   ->orderBy('created desc')
					->all();
				
		 return $this->render('index', [
				'models' => $models,
		]);
	 
	
}
	/*
    public function actionIndex(){
			$this->view->title = 'Tin đã đăng';
			//$article_id = Yii::$app->request->get('article_id');
			//$id = Yii::$app->request->get('id');
			//$user_id= PseudoCrypt::unhash($id);	
			$article = new Article();
			$user = Yii::$app->user->identity;
			//$poster = User::findOne(['id' => $user->id]);
			if(Yii::$app->request->isPost){
					$article->attributes =  Yii::$app->request->post('Article');
					$user->attributes =  Yii::$app->request->post('User');
					$article->imageFile = UploadedFile::getInstance($article, 'imageFile');
					if(isset($article->imageFile->name)){
						$filename = date('YmdHis').gettimeofday()['usec']. '.' . $article->imageFile->extension;
						$article->image= $filename;
					}
					$article->user_id=  $user->id;
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
				
            $query = Article::find()->andWhere(['user_id' => $user->id]);
			$provinces = ArrayHelper::map(Province::find()->all(), 'province_id', 'name');// Province::find()->all();
			$districts = ArrayHelper::map(District::find()->all(), 'district_id', 'name');// District::find()->all();
			$categoryTypes = ArrayHelper::map(CategoryType::find()->all(), 'id', 'title');// District::find()->all();
			$models = $query->offset(0)->limit(40)
                       ->orderBy('created desc')
						->all();
					
             return $this->render('index', [
						'detail' => $this->detail,
                        'category_slug' => Yii::$app->request->get('slug'),
                        'models' => $models,
						'user' => $user,
					//	'poster' => $poster,
						//'post' => (Yii::$app->user->identity && Yii::$app->user->identity->id==$id)? true: false,
						'article' => $article,
						'provinces' => $provinces,
						'districts' => $districts,
						'categoryTypes' => $categoryTypes,
            ]);
         
        
	}
	*/
	public function actionArticle(){
			$this->view->title = 'Danh sách chỉnh sửa';
			$user = Yii::$app->user->identity;
			$query = Article::find()->andWhere(['user_id' => $user->id]);
			$models = $query->offset(0)->limit(40)
                       ->orderBy('created desc')
						->all();
							$dataProvider = new ActiveDataProvider([
					'query' => $query,
					'pagination' => [
						'pageSize' => 10,
					],
					'sort' => [
						'defaultOrder' => [
							'created' => SORT_DESC,
							'title' => SORT_ASC, 
						]
					],
				]);
			return $this->render('article', [
						'dataProvider' => $dataProvider,
						'detail' => $this->detail,
                        'category_slug' => Yii::$app->request->get('slug'),
                        'models' => $models,
						'user' => $user,
					
			]);
    }
	
	/*
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
										$user_id =Yii::$app->user->identity->id;
										if ($articleImage->save(false)) {
												$path = Yii::$app->params['PathChannels']  . 'article/images/';
												$path745x510 = Yii::$app->params['PathChannels'] . 'article/745x510/';
											//	$path210X118 = Yii::$app->params['PathChannels'] . 'article/210x118/';
											//	$path200X200 = Yii::$app->params['PathChannels']  . 'article/200x200/';
												FileHelper::createDirectory($path, $mode = 0775, $recursive = true);
												FileHelper::createDirectory($path745x510, $mode = 0775, $recursive = true);
											//	FileHelper::createDirectory($path210X118, $mode = 0775, $recursive = true);
											//	FileHelper::createDirectory($path200X200, $mode = 0775, $recursive = true);
											if ($file->saveAs($path . $image_name, false)) {
													Image::thumbnail($path . $image_name, 745, 510)->save($path745x510 . $image_name, ['quality' => 100]);
													//Image::thumbnail($path . $image_name, 210, 118)->save($path210X118 . $image_name, ['quality' => 100]);
												//	Image::thumbnail($path . $image_name, 200, 200)->save($path200X200 . $image_name, ['quality' => 100]);
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
*/
	public function  actionUploadArticleImage(){
				$form = new UploadArticleImage();
				$arrResponse = array();
				$user = Yii::$app->user->identity;
				if (Yii::$app->request->isPost) {
					$form->file = UploadedFile::getInstanceByName('file');
					//$form->files = UploadedFile::getInstances($form, 'files');
					if ($form->file && $form->validate()) {
							$articleImage = new ArticleImage();
							$path = Yii::$app->params['PathChannels']  . 'article/745x510/';
							$pathThumb = Yii::$app->params['PathChannels']  . 'article/210x118/';
							$articleImage->image =  date('YmdHis') . gettimeofday()['usec'] .'.'. $form->file->extension;
							$articleImage->user_id= $user->id;
							$articleImage->size = $form->file->size;
							$articleImage->type = $form->file->type;
							$articleImage->file_name = $form->file->name; /// gettimeofday()['sec'] . '.' . $form->file->extension;
							if ($articleImage->save(false)) {
								if (!is_dir($path)) mkdir($path, 0755);
									if (!is_dir($pathThumb)) mkdir($pathThumb, 0755);
										$form->file->saveAs($path  . $articleImage->image, false);
											if(in_array($form->file->extension, ['jpg', 'png','jpeg'])){
												Image::thumbnail($path  . $articleImage->image, 120, 120)->save($pathThumb . $articleImage->image, ['quality' => 90]);
									}
							}
							
						$arrResponse=[
							'image' => $articleImage->image,
							'file_name' =>  $articleImage->file_name,
							'url_file_name' =>  Yii::$app->params['url-channels'].'article/745x510/' . $articleImage->image,
							'id' => $articleImage->id
						];	
						
				}
			
		}
	Yii::$app->response->format = Response::FORMAT_JSON;
		return Json::encode($arrResponse);
}
	 /**
     * Delete function
     *
     * @return 
     */
    public function actionArticleDelete($id = 0) 
    {
    	$this->getView()->title = "Danh sách dự án";
		$user = Yii::$app->user->identity;
    	$model = Article::findOne(['id' => $id]);
    	if (!$model) {
    		Yii::$app->session->setFlash('error', "Dữ liệu không tồn tại");
    		Yii::$app->getResponse()->redirect(['user/index','id' => $user->id]);
    		Yii::$app->end();
    	}
		
    	if($model->delete()){
			Yii::$app->session->setFlash('error', "Xóa thành công");
			Yii::$app->getResponse()->redirect(['user/index','id' => $user->id]);
			Yii::$app->end();
		}
    }
	
/**
     *
     * @return type
     */
	
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }
	
		
public function actionSaveUserImage() {
		//return 
		$return = ['save' => false];
		//set response header
		Yii::$app->getResponse()->format = Response::FORMAT_JSON;
	//get post
		$ImageManager_id = Yii::$app->request->post("ImageManager_id");
		$file_name = Yii::$app->request->post("file_name");
		//get details
		$model = $this->findModelUser();
		$model->image_manager_id = $ImageManager_id;
		$model->image = $file_name;

		//delete record
		if ($model->save(false)) {
			$return['save'] = true;
		}
		return $return;
}
	protected function findModelUser() {
		if (($model = User::findOne(['id' => Yii::$app->user->identity->id])) !== null) {
		   	return $model;
		} else {
            throw new NotFoundHttpException(Yii::t('imagemanager', 'The requested image does not exist.'. $id));
		}
	}
	
	public function actionRemoveImage() {
		$arrResponse = array();
		if (Yii::$app->request->isPost) {
					$id = Yii::$app->request->post('id');
					$articleImage = ArticleImage::findOne(['id' => $id]);
					if ($articleImage) {
						if($articleImage->delete()){
							$path = Yii::$app->params['PathChannels']. 'article/745x510/' . $articleImage->image; // Yii::getAlias('@common').'/images/building-project/';
							$pathThumb = Yii::$app->params['PathChannels']. 'article/210x118/' . $articleImage->image; // Yii::getAlias('@common').'/images/building-project/';
							if (file_exists($path)) unlink($path);
							if (file_exists($pathThumb)) unlink($pathThumb);
								$arrResponse=[
									'message' => 'Xóa thành công',
									'status' => 1,
									'image' => $articleImage->image,
									'file_name' =>  $articleImage->file_name,
									'url_file_name' =>  Yii::$app->params['url-channels'].'article/745x510/' . $articleImage->file_name,
									'id' => $articleImage->id,
								];	
								return Json::encode($arrResponse);
						}
				}
		}

	
		$arrResponse=[
			'message'  => 'Dữ liệu không tồn tại',
			'status' => 0,
		];	
	
		return Json::encode($arrResponse);
}




    
}