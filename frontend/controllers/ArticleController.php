<?php
namespace frontend\controllers;
use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;
use common\models\Image;
use common\models\Ward;
use common\models\Street;
use common\models\Article;
use common\models\District;
use common\models\Province;
use common\models\About;
use common\models\CommentUser;
use common\models\CommentUserFeedback;
use common\models\CommentUserVote;
use yii\data\Pagination;
use  yii\helpers\Url;
use yii\filters\AccessControl;
use common\models\CategoryType;

use common\models\ArticleBooking;
use common\models\ArticleImage;
use common\models\User;
use common\models\Project;
use yii\web\NotFoundHttpException;
class ArticleController extends AppController
{
	//public $enableCsrfValidation = false;	
	public $page = 'home-page';
  	public $title= 'E-land.VN';
  	public $actual_link ='';
	public $totalCount='';
	public $offset=1;
	public $limit =14;
   // public $detail= 'dt';
  //  public $head= '';
		
    /**
     * Displays building project infomations.
     *
     * @return string
     */
    public function beforeAction($action) {
        parent::beforeAction($action);
        $this->actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/";
		$this->enableCsrfValidation = true;
		
		return true;
    }
	
	public function actionMap() {
		$this->layout= false;
		$this->enableCsrfValidation = false;
		$category =	Yii::$app->request->get('category',0);
		$id =	Yii::$app->request->get('id',0);
		$map = array();
		if($category=="project"){
				$project = Project::findOne(['id' => $id]);
				if($project){
					$map =  [
								'title' => $project->name,
								'lat' =>	Yii::$app->request->get('lat',0),
								'lng' =>	Yii::$app->request->get('lng',0)
							];
					
				}
				return $this->render('map', [ 'map' => $map]);
		}
		if($category=="article"){
				$article = Article::findOne(['id' => $id]);
				if($article){
					$map =  [
								'title' => $article->title,
								'lat' =>	Yii::$app->request->get('lat',0),
								'lng' =>	Yii::$app->request->get('lng',0)
							];
					
				}
			}
				if($category=="about"){
					$article = About::findOne(['id' => $id]);
					if($article){
						$map =  [
									'title' =>'Văn phòng làm việc',
									'lat' =>	Yii::$app->request->get('lat',0),
									'lng' =>	Yii::$app->request->get('lng',0)
								];
						
					}	
				}
				return $this->render('map', [ 'map' => $map]);
		
		
                Yii::$app->getResponse()->redirect(['index']);
                Yii::$app->end();
		
	}
	 /**
     * Finds the About model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return About the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('about', 'The requested page does not exist.'));
    }
	/*
	public function actionArticleLogin() {
		$this->layout = "home";
		$loginForm = new \frontend\models\LoginForm();
	
		return $this->renderAjax('article_login', ['loginForm' => $loginForm ] );
    }
*/

		
		protected function findModelProvinceSlug($slug)
		{
			if (($model = Province::findOne(['slug' => $slug])) !== null) {
				return $model;
			}
	
			throw new NotFoundHttpException(Yii::t('about', 'The requested page does not exist.'));
		}
		protected function findModelDistrictSlug($slug)
		{
			if (($model = District::findOne(['slug' => $slug])) !== null) {
				return $model;
			}
	
			throw new NotFoundHttpException(Yii::t('about', 'The requested page does not exist.'));
		}
		protected function findModelCategorySlug($slug)
		{
			if (($model = CategoryType::findOne(['slug' => $slug])) !== null) {
				return $model;
			}
	
			throw new NotFoundHttpException(Yii::t('about', 'The requested page does not exist.'));
		}
/** 
     *  Slug Province
     *  Slug District
     *  Slug Type
    */
    public function actionProvince() {
        
        $this->view->params['head'] = array();
        $province = $this->findModelProvinceSlug(Yii::$app->request->get('province'));
        $this->view->title =$province->name;
     
        $query = $province->getArticles()->andWhere(['articles.status' => 1])->andWhere('province_id!="" AND district_id!=""');
			$query->joinWith(['categoryType' => function ( yii\db\ActiveQuery $query) {
				return $query->joinWith(['category' => function ( yii\db\ActiveQuery $query) {
					return $query->andWhere(['=', 'categories.slug', 'mua-ban']);
				}]);
			}]);
			$session = Yii::$app->session;
			if( $session->has('province_id')){
						$query->andWhere(['province_id' => $session->get('province_id')]);
			}
			$models  = $query->offset(0)
											->limit(14)
											->orderBy(['articles.updated' => SORT_DESC])
											->all();
				$query = District::find();
	$session = Yii::$app->session;
	if( $session->has('province_id')){
				$query->andWhere(['province_id' => $session->get('province_id')]);
	}
	$districts=$query->orderBy('name asc')->all();
            return $this->render('province', [
                    'models' => $models,
                    'districts' => $districts
            ]);
        
}

public function actionDistrict() {
    
						
	$district = $this->findModelDistrictSlug(Yii::$app->request->get('district'));
	$this->metaTagGoogle([
	['name' => 'description','content' => 'E-land.VN - '. $district->type . ' ' . $district->name . ', ' . $district->province->name .' - Kênh rao bán, cho thuê bất động sản dành cho cty, môi giới, chủ đầu tư, người có nhu cầu mua bán, cho thuê bât động sản'],
	['name' => 'copyright','content' => 'E-land.VN@2018-' . date('Y')],
	['name' => 'author','content' => 'E-land.VN'],
	['name' => 'robots','content' => 'index,follow'],
	['name' => 'keywords','content' => $district->keyword? $district->keyword: 'Mua nhà ,bán nhà, thuê nhà, bán đất, thuê văn phòng, bán căn hộ, '  . $district->type . ' ' . $district->name .  ', giá rẻ'
	]
]);
$this->metaHead([
   [ 'property' => 'og:url','content' => Url::to(['article/district', 'province' => $district->province->slug, 'slug' =>  $district->slug ],true),],
   [ 'property' => 'og:type','content' => 'website',],
   [ 'property' => 'og:title','content' => $district->province->type . ' ' . $district->province->name .' - '. $district->type . ' ' . $district->name],
   [ 'property' => 'og:description','content' => 'E-land.VN - '. $district->type . ' ' . $district->name . ', ' . $district->province->name .' - Kênh rao bán, cho thuê bất động sản dành cho cty, môi giới, chủ đầu tư, người có nhu cầu mua bán, cho thuê bât động sản'],
   [ 'property' => 'og:image','content' => Url::to('@web/e-land/img/logo.png', true )]
   ]);	
$this->metaHead([
   [ 'property' => 'twitter:url','content' => Url::to(['article/district', 'province' =>  $district->province->slug, 'slug' =>  $district->slug ],true)],
   [ 'property' => 'twitter:title','content' =>  $district->province->type . ' ' . $district->province->name .' - '. $district->type . ' ' . $district->name],
   [ 'property' => 'twitter:description','content' =>  'E-land.VN - '. $district->type . ' ' . $district->name . ', ' . $district->province->name .' - Kênh rao bán, cho thuê bất động sản dành cho cty, môi giới, chủ đầu tư, người có nhu cầu mua bán, cho thuê bât động sản'],
   [ 'property' => 'twitter:image','content' => Url::to('@web/e-land/img/logo.png', true )]
   ]);	

    $this->view->title = $district->type . ' '. $district->name;
    if($district){
		$query = $district->getArticles()->andWhere(['articles.status' => 1])->andWhere('province_id!="" AND district_id!=""');
			$query->joinWith(['categoryType' => function ( yii\db\ActiveQuery $query) {
				return $query->joinWith(['category' => function ( yii\db\ActiveQuery $query) {
					return $query->andWhere(['=', 'categories.slug', 'mua-ban']);
				}]);
			}]);
			$session = Yii::$app->session;
			if( $session->has('province_id')){
						$query->andWhere(['province_id' => $session->get('province_id')]);
			}
			$models  = $query->offset(0)
											->limit(14)
											->orderBy(['articles.updated' => SORT_DESC])
											->all();
            
	}
	
	$query = District::find();
	$session = Yii::$app->session;
	if( $session->has('province_id')){
				$query->andWhere(['province_id' => $session->get('province_id')]);
	}
	$districts=$query->orderBy('name asc')->all();
    return $this->render('district', [
		'districts' => $districts,
        'models' => $models,
        
]);
}


public function actionCategory() {

   
    $this->view->params['head'] = array();
    $category = $this->findModelCategorySlug(Yii::$app->request->get('category'));
    $this->view->title =$category->title;
    if($category){
       $models = $category->getArticles()
	   ->andWhere(['status' => 1])
            ->offset(0)
            ->limit(4)
            ->orderBy(['updated' => SORT_DESC])
			->all();
			$query = District::find();
	$session = Yii::$app->session;
	if( $session->has('province_id')){
				$query->andWhere(['province_id' => $session->get('province_id')]);
	}
	$districts=$query->orderBy('name asc')->all();
            return $this->render('category', [
				'districts' => $districts,
                    'models' => $models,
                    
            ]);
    }
}

public function actionImageDetail() {
	$id = (int) Yii::$app->request->get('id');
	$articleImage= ArticleImage::find()->andWhere(['id' => $id])->one();
	if (Yii::$app->request->isAjax) {

				
	
			$model = $articleImage->article;
			$articleImages = $articleImage->article->images;
			
			$articleUser = $articleImage->article->user;
			$articleBooking = new ArticleBooking();
			return $this->renderPartial('image_detail', [
							'articleBooking' => $articleBooking,
							'model' => $model,
							'articleImages' => $articleImages,
							'articleUser' => $articleUser,
			]);
	}
}
	 public function actionIndex() {
		//
		$this->view->title = 'Mua bán';
		$this->metaTagGoogle([
				 	['name' => 'description','content' => 'E-land.VN - Kênh rao bán, cho thuê bất động sản dành cho cty, môi giới, chủ đầu tư, người có nhu cầu mua bán, cho thuê bât động sản tại Việt Nam'],
					['name' => 'copyright','content' => 'E-land.VN@2018-' . date('Y')],
					['name' => 'author','content' => 'E-land.VN'],
					['name' => 'robots','content' => 'index,follow'],
					['name' => 'keywords','content' => 'nha o, chung cu, phong cho thue']
				]);
		$this->metaHead([
					['property' => 'og:url','content' => $this->actual_link],
					['property' => 'og:type','content' => 'article'],
   				 	['property' => 'og:title','content' => 'E-land.VN nền tảng bất động sản sản phẩm thật'],
					['property' => 'og:description','content' => 'E-land.VN - Kênh rao bán, cho thuê bất động sản dành cho cty, môi giới, chủ đầu tư, người có nhu cầu mua bán, cho thuê bât động sản tại Việt Nam'],
					['property' => 'og:image','content' => $this->actual_link .'e-land/img/logo.png'],
					['property' => 'og:image:alt','content' => 'E-land.VN nền tảng bất động sản sản phẩm thật']
					
		]);
		$this->metaHead([
					['property' => 'twitter:url','content' =>  $this->actual_link],
   				 	['property' => 'twitter:title','content' => 'E-land.VN nền tảng bất động sản sản phẩm thật'],
   				 	['property' => 'twitter:description','content' => 'E-land.VN - Kênh rao bán, cho thuê bất động sản dành cho cty, môi giới, chủ đầu tư, người có nhu cầu mua bán, cho thuê bât động sản tại Việt Nam'],
   				 	['property' => 'twitter:image','content' => Url::to('@web/e-land/img/logo.png', true )],
					['property' => 'twitter:image:alt','content' => 'E-land.VN nền tảng bất động sản sản phẩm thật']
		]);	
									 
		$query = Article::find()->andWhere(['articles.status' => 1])->andWhere('province_id!="" AND district_id!=""');
		$query->joinWith(['categoryType' => function ( yii\db\ActiveQuery $query) {
			return $query->joinWith(['category' => function ( yii\db\ActiveQuery $query) {
				return $query->andWhere(['=', 'categories.slug', 'mua-ban']);
			}]);
		}]);
		$countQuery = clone $query;
		$totalCount = $countQuery->count();
		$pages = new Pagination(['totalCount' => $totalCount]);
		$models = $query->offset($this->offset)
                    ->limit($this->limit)
                    ->orderBy(['articles.updated' => SORT_DESC])
                    ->all();
		$loginForm = new \frontend\models\LoginForm();
		//$Form = new \frontend\models\LoginForm();
		$query = District::find();
		$session = Yii::$app->session;
			$provinces = array();
		$districts = array();
		if( $session->has('province_id')  &&  $session->get('province_id')!=0){
					$query = District::find();
					$query->andWhere(['province_id' => $session->get('province_id')]);
					$districts = $query->orderBy('name asc')->all();
		}else{
					$query = Province::find();
					$provinces = $query->orderBy('province_id asc, name desc')->all();
		}
		return $this->render('index', [
						'districts' => 	$districts,
						'provinces' => $provinces,
						'loginForm' => $loginForm,
                        'models' => $models,
                        'pages' => $pages,
                        'page' => 'index',
						'totalCount' => $totalCount
            ]);
        
    }
	
    public function actionDetail(){

				$dialog= false;
				
				$slug = Yii::$app->request->get('slug');
				$model= Article::find()->andWhere(['status' => 1])->andWhere(['slug' => $slug])->one();
				if (Yii::$app->request->isAjax) {

				
				
						$articleBooking = new ArticleBooking();
					return $this->renderAjax('article_detail', [
								'articleBooking'  => $articleBooking,
								'model' => $model,
								'articleImages' => $model->images,
								'articleDetail' =>  $model->articleDetail,
								'articelUser' =>  $model->user
					]);
				}else{
				if($model){
				$articleImages = $model->images;
				$articleDetail = $model->articleDetail;
				$CategoryType = $model->categoryType;
				$Category = $model->categoryType->category;
				$this->view->title = $model->title;
				$this->metaTagGoogle([
				 	['name' => 'description','content' => !empty($model->description)? trim(preg_replace('/\s\s+/', ' ', strip_tags($model->description))): trim(preg_replace('/\s\s+/', ' ',  strip_tags($model->content)))],
					['name' => 'copyright','content' => 'E-land.VN@2018-' . date('Y')],
					['name' => 'author','content' => $model->user->name],
					['name' => 'robots','content' => 'index,follow'],
					['name' => 'keywords','content' => 'nha o, chung cu, phong cho thue']
				 ]);
				$this->metaHead([
						[ 'property' => 'og:url','content' => Url::to(['article/detail', 'province' => isset($model->province)?$model->province->slug:'', 'district' => isset($model->district)?$model->district->slug:'','slug' => $model->slug],true),],
   				 		['property' => 'og:type','content' => 'article',],
		   				['property' => 'og:title','content' => $model->title,],
   				 		['property' => 'og:description','content' => !empty($model->description)? trim(preg_replace('/\s\s+/', ' ', strip_tags($model->description))): trim(preg_replace('/\s\s+/', ' ',  strip_tags($model->content))),
   				 		],
   				 		['property' => 'og:image','content' => Url::to($model->images?'@web/channels/article/745x510/'. $model->images[0]->image:'@web/e-land/img/logo.png' , true ),]
   				 	]);
				$this->metaHead([
						[ 'property' => 'twitter:url','content' => Url::to(['article/detail', 'province' => isset($model->province)?$model->province->slug:'', 'district' => isset($model->district)?$model->district->slug:'', 'type' => isset($model->CategoryType)?$model->CategoryType->slug:'', 'slug' => $model->slug],true),
   				 		],
   				 		['property' => 'twitter:card','content' => 'article',],
		   				['property' => 'twitter:title','content' => $model->title,],
   				 		['property' => 'twitter:description','content' => !empty($model->description)? trim(preg_replace('/\s\s+/', ' ', strip_tags($model->description))): trim(preg_replace('/\s\s+/', ' ',  strip_tags($model->content))),
   				 		],
   				 		['property' => 'twitter:image','content' => Url::to($model->images?'@web/channels/article/745x510/'. $model->images[0]->image:'@web/e-land/img/logo.png' , true ),]
   				 		
   				 	]);
							 
			 	$results = array(); 
			 	foreach($articleImages as $key => $value){
    				$results[$key] = Url::to('@web/channels/article/745x510/' . $value->image, true);
                   
 				}
				// use frontend\models\LoginForm;
				
				return $this->render('detail', [
							'dialog' => $dialog,
							'results' =>  json_encode($results),
							'model' => $model,
							'articleImages' => $articleImages,
							'articleDetail' => $articleDetail,
							'CategoryType' => $CategoryType,
							'slug' => $slug,
							'Category' => $Category,
				]);
			}else{throw new \yii\web\NotFoundHttpException("Không tìm thấy trang.");}
		}
	}
	public function actionArticleBooking(){
		$this->layout = false;
		$errors= false;
		$messages = "";
		$articleBooking = new ArticleBooking();
		$articleBooking->attributes=  \Yii::$app->request->post('ArticleBooking');
		$articleBooking->date = Yii::$app->formatter->asDateTime(\DateTime::createFromFormat('d/m/Y H:i', $articleBooking->date), 'php:Y-m-d H:i'); // 30-Mar-2017
		$articleBooking->article_id = (int) Yii::$app->request->get('id');
		if ($articleBooking->validate()) {
			$articleBooking->save();
			// all inputs are valid
		} else {
			// validation failed: $errors is an array containing error messages
				$errors =  $articleBooking->errors;
				foreach ($articleBooking->getErrors () as $attribute => $error)
				{

							foreach ($error as $message)

							{

								$messages .= $message . '<br/>';

							}

				}
		}
		return	\yii\helpers\Json::encode(['errors' => $messages, 'articleBooking' => $articleBooking]);
	}
		
		public function actionAutoLoading() {
				$offset = (int)Yii::$app->request->get('offset');
				$limit =  (int)Yii::$app->request->get('limit');
			$url =   Yii::$app->request->get('url');
			$page =  Yii::$app->request->get('page');
			$slug =  Yii::$app->request->get('slug');
			$message= '';
			$error = '';
			$building= array();
			
			switch ($page) {
				case 'category':{
						$category= Category::findOne(['slug' => $slug]);
						if($category){
							$query= Article::find()->andWhere(['status' => 1])->andWhere(['category_id' => $category->id]);
						}
						break;
						}
				case 'type':{
						$type= CategoryType::findOne(['slug' => $slug]);
						if($type){
							$query= Article::find()->andWhere(['status' => 1])->andWhere(['type_id' => $type->id]);
						}
						break;
						}
				case 'province':{
						$province = Province::findOne(['slug' => $slug]);
						if($province){
							$query= Article::find()->andWhere(['status' => 1])->andWhere(['province_id' => $province->province_id]);
						}
						break;
						}
				case 'district':{
						$district= District::findOne(['slug' => $slug]);
						if($district){
							$query= Article::find()->andWhere(['status' => 1])->andWhere(['district_id' => $district->district_id]);
							}
						break;
						}
				default:
						$query= Article::find()->andWhere(['status' => 1]);
					}
			
			
			$query->offset($offset)->limit($limit);
			$query->orderBy(['post_date' => SORT_DESC]);
			$models = $query->all();
			$user = \Yii::$app->user->identity;
		  foreach ($models as $key => $value) {
			  if(@getimagesize(Url::to('@web/channels/article/210x118/' . $value->image, true))){
				   $urlImage =	Url::to('@web/channels/article/210x118/' . $value->image, true);
			   }else{
				   $urlImage = Url::to('@web/images/no-image210x118.png', true);
			   }
			    if(@getimagesize(Url::to('@web/channels/avatar/' .  $value->user->image, true))){
				   $urlImageUser =	Url::to('@web/channels/avatar/' .   $value->user->image, true);
			   }else{
				   $urlImageUser = Url::to('@web/images/no-image200x200.png', true);
			   }
              $building []=[
						'image' =>  $urlImage,
						'price_text' => $value->price_text,
						'area_text'  => $value->area_text,
						'title' => $value->title,
						'address' => $value->address,
						'poster_id' =>  $value->user->id,
						'poster_name' => preg_replace( "/\r|\n/", "", $value->user->name),
						'poster_phone' => $value->user->phone,
						'date_post' => date('d/m/Y', strtotime($value->created)),
						'room' =>   isset($user)? ($user->id + $value->user->id): 0,
						'user_id' =>   isset($user)? $user->id:0,
						'user_name' => preg_replace( "/\r|\n/", "", isset($user)?$user->name:''),
						'user_image' =>  $urlImageUser,
						'user_link' =>  Yii::$app->params['elandUrl'] . 'kenh/' . $value->user->id,
						'district' =>  Yii::$app->params['elandUrl']. (isset($value->district)?$value->district->slug:''),
						'province' =>  Yii::$app->params['elandUrl']. (isset($value->province)?$value->province->slug:''),
						'district_name' => isset($value->district)?($value->district->type  . ' ' . $value->district->name):'',
						'province_name' => isset($value->province)?$value->province->name:'',
						'article_type' => isset($value->CategoryType)?$value->CategoryType->title:'',
						'post_date' =>  date('d/m/Y',strtotime($value->post_date)),
						'district_link' => (isset($value->district) && isset($value->province)) ? Url::to(['/article/province-slug_category-or_slug_type-or_slug_district','district' => $value->district->slug,'province' => $value->province->slug,'district_id' => $value->district->district_id,'province_id' => $value->province->province_id],true):'',
						'province_link' => isset($value->province) ? Url::to(['/article/slug_province-or_slug_category-or_slug_type','province' => $value->province->slug,'province_id' => $value->province->province_id],true):'',
						//'href' =>  Url::to(['article/detail', 'province' => isset($value->province)?$value->province->slug:'', 'district' => isset($value->district)?$value->district->slug:'', 'category' => isset($value->CategoryType)?$value->CategoryType->slug:'', 'slug' => $value->slug, 'district_id' => $value->district_id, 'province_id' => $value->province_id],true),
						'href' => Url::to(['article/detail', 'province' => isset($value->province)?$value->province->slug:'', 'district' => isset($value->district)?$value->district->slug:'', 'type' => isset($value->CategoryType)?$value->CategoryType->slug:'', 'slug' => $value->slug],true),
					//	'href' =>  Url::to(['article/detail','slug' => $value->slug], true),
						//'user_image' => $value->user->image?( Yii::$app->params['elandUrl'] . 'avatar/user/'.$value->user->image): ( Yii::$app->params['elandUrl']. "images/no-image.png"),
						'description' => $value->description,
              ];
          }
	
        $info = [
            
            'building' => $building,
            'offset' => $offset + $limit,
            'limit' => $limit,
			'total' => (int) $query->count(),
        ];
	
        $result = ['error' => $error , 'message' => $message, 'info' => $info];
		
    //    $this->setHeader(200);
        echo json_encode($result);
        exit();
    }


	
	 public function actionViewMore() {
    	$data=array();
    	$error=0;
    	$message=null;
    	$commentUser=null;
    	$offset=0;
		$this->layout=false;
		$limit = 5;
    	if (Yii::$app->request->isGet) {
    		$article_id= Yii::$app->request->get('id');
    		
    		$offset = Yii::$app->request->get('offset');
    	$comment_users = CommentUser::find()
    		->joinWith('user')
    		->andWhere(['article_id' => $article_id])
    		->orderBy('created desc')
    		->limit($limit)
    		->offset($offset)
    		->all();
			return $this->render('show_more', [ 'comment_users' => $comment_users]);
			
    
		
    
	 }

}
   
    public function actionLike() {
		
        if (Yii::$app->request->isGet) {
            $id = Yii::$app->request->get('id');
			$user_id = Yii::$app->user->getId() ? Yii::$app->user->getId() : 0;
            $comment = CommentUser::findOne(['id' => $id]);
            $vote = $comment->getCommentUserVotes()->andWhere(['user_id' => $user_id])->one();  // CommentUserVote::findOne(['comment_user_id' => $id, 'user_id' => $user_id]);
			$list=[];
			$text =  '';
			if ($vote) {
                $comment->like -= 1;
                $vote->delete();
                $voted= false ;
            } else {
                $comment->like += 1;
                $vote = new CommentUserVote();
                $vote->comment_user_id = $id;
                $vote->user_id = $user_id;
                $vote->save(false);
                $voted=true;
            }
            if($comment->save(false)){
					if($comment->getCommentUserVotes()->count() >0) {
							if($comment->getCommentUserVotes()->andWhere(['user_id' => $user_id])->count()==1 && $comment->getCommentUserVotes()->count() == 1){
								$text =  ' bạn';
							}elseif($comment->getCommentUserVotes()->andWhere(['user_id' => $user_id])->count()==1 && $comment->getCommentUserVotes()->count() == 2){
								$text = ' bạn và người khác';
							}elseif($comment->getCommentUserVotes()->andWhere(['user_id' => $user_id])->count()==1 && $comment->getCommentUserVotes()->count() >= 2){
								$text =  ' bạn và '. ($comment->getCommentUserVotes()->count()-1) . ' người';
							}else{
								$text =  ' người';
							}
								foreach($comment->commentUserVotes as $key => $vs){
										$list[] =[
													'id' => $vs->user->id,
													'name' => $vs->user->name
												];
									}
							}
				$data= [ 
							'like' =>  $comment->like,
							'id' =>  $comment->id,
							'list'  => $list,
							'text' => $text,
							'voted' => $voted
					];
				return \yii\helpers\Json::encode($data);
			}
        }
    }

    public function actionRating() {
			$this->layout=false;
			if (\Yii::$app->user->isGuest) {
				$data['error']['login'] = true;
				$data['error']['message'] ='Bạn cần đăng nhập để đánh gía';
				return \yii\helpers\Json::encode($data);
			} 
			if (Yii::$app->request->isGet) {
				$student= null;
				$data=array();
				$objects=array();
				$rating =(int)Yii::$app->request->get('rating');
				$comment =Yii::$app->request->get('comment');
				$article_id =(int)Yii::$app->request->get('article_id');
				$user_id = Yii::$app->user->getId() ? Yii::$app->user->getId() : 0;
				$comment_user = new CommentUser();
				$comment_user->user_id = $user_id;
				$comment_user->article_id = $article_id;
				$comment_user->rating = $rating;
				$comment_user->comment = $comment;
				$comment_user->created = date('Y-m-d H:i:s');
			
			if ($comment_user->save(false)) {
				$comment_users = CommentUser::find()->andWhere(['user_id' => $user_id])->orderBy('created desc')->all();
            	$total_rating=0;
            	$percent=0;
            	$total=0;
                foreach($comment_users as $value){
                   	$total_rating+=(int) $value->rating;

                       }
                       $total=count($comment_users);
                       if((($total_rating/(5*$total))*100)==100){
                       	$percent=sprintf('%.0f',(($total_rating/(5*$total))*100)).'%';
                       }else{
                       	$percent=sprintf('%.2f',(($total_rating/(5*$total))*100)).'%';
                       }
              
                  $objects=[
					'comment' => [
                 					'comment' => $comment,
                 					'id' =>$comment_user->id,
                 					'like' => (int)$comment_user->like,
                 					'created' =>  date('d/m/Y  H:s',  strtotime($comment_user->created)),
                 					'rating' =>  $comment_user->rating
        							],
        			'user'	=> [
										'user_id' => $user_id,
										'name' => isset($comment_user->user)?$comment_user->user->name:'',
										'image' => (isset($comment_user->user)  && $comment_user->user->image!='no-image.png')? Url::to("@web/channels/avatar/" . $comment_user->user->image):Url::to("@web/images/no-image100x100.png"),
									],	
        						
        			'percent' => $percent,
        			'total' => count($comment_users )
                  ];
                
           
                 return $this->render('rate', [
                          'comment_user' => $comment_user,
                           
               ]);
              }
        }
	
      //   Yii::$app->getResponse()->redirect(['article/index', $teacher_id]);
        Yii::$app->end();
      }
	  
	  
	  
	  
	  public function actionCommentFeedback() {
			$this->layout=false;
			if (\Yii::$app->user->isGuest) {
				$data['error']['login'] = true;
				$data['error']['message'] ='Bạn cần đăng nhập để đánh gía';
				return \yii\helpers\Json::encode($data);
			} 
		if (Yii::$app->request->isGet) {
				$student= null;
				$data=array();
				$objects=array();
				$message =Yii::$app->request->get('message');
				$comment_id =(int)Yii::$app->request->get('comment_id');
				$user_id = Yii::$app->user->getId() ? Yii::$app->user->getId() : 0;
				$comment_user = new CommentUserFeedback();
				$comment_user->user_id = $user_id;
				$comment_user->comment_user_id = $comment_id;
				$comment_user->comment = $message;
				if ($comment_user->save(false)) {
					return $this->render('comment_feedback', [
                          'model' => $comment_user,
                           
					]);
				}
        }
		
      }

    
}