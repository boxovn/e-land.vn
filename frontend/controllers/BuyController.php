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
use common\models\CommentUser;
use common\models\CommentUserFeedback;
use common\models\CommentUserVote;
use yii\data\Pagination;
use  yii\helpers\Url;
use yii\filters\AccessControl;
use common\models\ArticleType;
use common\models\ArticleCategory;
class BuyController extends AppController
{
	
	public $page = 'home-page';
  	public $title= 'E-land.VN';
  	public $actual_link ='';
	public $totalCount='';
	public $offset=14;
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
		return true;
    }


	public function actionIndex() {
				$slug = Yii::$app->request->get('slug');
				$articleType = ArticleType::find()->andWhere(['slug' => $slug])->one();
				if($articleType){
					$query = $articleType->getArticles();
					$query = $query->andWhere(['status' => 1]);
					$totalCount = $query->count();
					$query->offset($this->offset);
					$query->limit($this->limit);
					$query->orderBy(['created' => SORT_DESC]);
					$models = $query->all();
					$this->view->title = $articleType->title;
				$this->metaTagGoogle([
				 	['name' => 'description','content' => $articleType->description],
					['name' => 'copyright','content' => 'E-land.VN@2018-' . date('Y')],
					['name' => 'author','content' => 'E-land.VN'],
					['name' => 'robots','content' => 'index,follow'],
					['name' => 'keywords','content' => $articleType->keyword]
				]);
				$this->metaHead([
					[ 'property' => 'og:url','content' => Url::to(['article/slug_province-or_slug_category-or_slug_type','slug' => $articleType->slug ],true),],
   				 	[ 'property' => 'og:type','content' => 'website'],
   				 	[ 'property' => 'og:title','content' => 'E-land.VN - ' . $articleType->title],
   				 	[ 'property' => 'og:description','content' =>  $articleType->description],
   				 	[ 'property' => 'og:image','content' => Url::to('@web/images/' . ($articleType->image?$articleType->image:'e-land.jpg'), true ),]
					]);	
				$this->metaHead([
					[ 'property' => 'twitter:url','content' => Url::to(['article/slug_province-or_slug_category-or_slug_type','slug' =>  $articleType->slug ],true)],
   				 	[ 'property' => 'twitter:title','content' => 'E-land.VN - ' .  $articleType->title],
   				 	[ 'property' => 'twitter:description','content' =>  $articleType->description],
   				 	[ 'property' => 'twitter:image','content' => Url::to('@web/images/' . ($articleType->image?$articleType->image:'e-land.jpg'), true )]
					]);	
				$this->view->params['totalCount'] = $totalCount;	
				return $this->render('type', [
							'models' => $models,
							//'pages' => $pages,
							'page' => 'type',
							'articleType' => $articleType,
							'title' => $articleType->title,
							'slug'  => $articleType->slug,
							'totalCount' => $totalCount
				]);
			}
			$province = Province::findOne(['slug' =>$slug]);
			if($province){	
					$this->view->title =  $province->type . ' ' . $province->name;
					$this->metaTagGoogle([
						['name' => 'description','content' => 'E-land.VN - '. $province->type . ' ' . $province->name. ' - Kênh rao bán, cho thuê bất động sản dành cho cty, môi giới, chủ đầu tư, người có nhu cầu mua bán, cho thuê bât động sản.'],
						['name' => 'copyright','content' => 'E-land.VN@2018-' . date('Y')],
						['name' => 'author','content' => 'E-land.VN - '. $province->type . ' ' . $province->name],
						['name' => 'robots','content' => 'index,follow'],
						['name' => 'keywords','content' => 'nha o, chung cu, phong cho thue, '  . $province->type . ' ' . $province->name]
					]);
					$this->metaHead([
						['property' => 'og:url','content' => Url::to(['article/slug_province-or_slug_category-or_slug_type','slug' =>  $province->slug ],true)],
						['property' => 'og:type','content' => 'website',],
						['property' => 'og:title','content' => $province->type . ' ' . $province->name,],
						['property' => 'og:description','content' =>  'E-land.VN - '. $province->type . ' ' . $province->name. ' - Kênh rao bán, cho thuê bất động sản dành cho cty, môi giới, chủ đầu tư, người có nhu cầu mua bán, cho thuê bât động sản.'],
						['property' => 'og:image','content' => Url::to('@web/images/e-land.jpg', true ),]

					]);
					$this->metaHead([
						['property' => 'twitter:url','content' => Url::to(['article/slug_province-or_slug_category-or_slug_type','slug' =>  $province->slug ],true)],
						['property' => 'twitter:title','content' => $province->type . ' ' . $province->name,],
						['property' => 'twitter:description','content' => 'E-land.VN - '. $province->type . ' ' . $province->name. ' - Kênh rao bán, cho thuê bất động sản dành cho cty, môi giới, chủ đầu tư, người có nhu cầu mua bán, cho thuê bât động sản.'],
						['property' => 'twitter:image','content' => Url::to('@web/images/e-land.jpg', true ),]

					]);		
					$query = $province->getArticles();
					$query = $query->andWhere(['status' => 1])->andWhere('province_id!="" AND district_id!=""');
					$totalCount = $query->count();
					$models = $query->offset($this->offset)
							->limit($this->limit)
							->orderBy(['updated' => SORT_DESC])
							->all();
					$this->view->params['totalCount'] = $totalCount;	
					return $this->render('province', [
							'models' => $models,
							'title' =>  $province->type . ' ' . $province->name,
							'page' => 'province',
							'province' => $province,
							'slug'  => $province->slug,
								'totalCount' => $totalCount
							
					]);
				}

				$query = Article::find();
				$query = $query->andWhere(['status' => 1]);
				$models=  $query->offset(0)
				   ->limit(14)
				   ->orderBy(['updated' => SORT_DESC])
				   ->all();
		   			return $this->render('index', [
									'models' => $models,
									
						]);
			
		}
		
		public function actionProvinceDistrictSlug_categoryOr_slug_type(){
				$slug = Yii::$app->request->get('slug'); //category or Type
				$province_slug = Yii::$app->request->get('province');
				$district_slug = Yii::$app->request->get('district');
				$articleCategory = ArticleCategory::findOne(['slug' => $slug]);
			
				$district = District::findOne(['slug' => $district_slug]);
				$province = Province::findOne(['slug' => $province_slug]);
				
				if($articleCategory){
					$query = $articleCategory->getArticleTypes();
					$totalCount =0;
						foreach ($articleCategory->getArticleTypes()->all() as $key => $value) { 
							$totalCount+= $value->getArticles()->andWhere(['status' => 1])->count();
						}
						$models = $query->offset(0)
							->limit(10)
							->orderBy(['sort' => SORT_DESC])
							->all();
						$article_type = [];
						foreach($models  as $key => $value) {
							$article_type[] = $value->title;
						}
					$article_type_string = implode(",",$article_type);
					$this->view->title = $articleCategory->title;
					$this->metaTagGoogle([
						[
						'name' => 'description',
						'content' => $articleCategory->description? trim(preg_replace('/\s+/', ' ', $article_type_string)):''
						],
						['name' => 'copyright','content' => 'E-land.VN@2018-' . date('Y')],
						['name' => 'author','content' => 'E-land.VN',],
						['name' => 'robots','content' => 'index,follow'],
						['name' => 'keywords','content' => $articleCategory->keyword .',' .  $district->type . ' ' .  $district->name . ', ' . $province->type . ' ' .  $province->name]
					]);
						$this->metaHead([
								[
							'property' => 'og:url',
							'content' => Url::to(['article/province-district-slug_category-or_slug_type','province' => $province->slug, 'district' => $district->slug,'slug' =>  $articleCategory->slug],true),
						],
						[
							'property' => 'og:type',
							'content' => 'website',
						],
						[
							'property' => 'og:title',
							'content' => $articleCategory->title,
						],
						[
							'property' => 'og:description',
							'content' => $articleCategory->description . ' ' .  $district->type . ' ' .  $district->name . ', ' . $province->type . ' ' .  $province->name ,
						],
						[
							'property' => 'og:image',
							'content' => Url::to('@web/images/'. ($articleCategory->image?$articleCategory->image:'e-land.jpg') , true ),
						]

						]);
							$this->view->params['totalCount'] = $totalCount;
							
						return $this->render('province_district_category', [
									'models' => $models,
									//'pages' => $pages,
									'page' => 'category',
									'province' => $province,
									'district' => $district,
									'title' => $articleCategory->title,
									'slug'  => $articleCategory->slug,
									'totalCount' => $totalCount
						]);
				}
				
				$articleType = ArticleType::find()->andWhere(['slug' => $slug])->one();
				if($articleType){
						
						$query = $articleType->getArticles();
						$query = $query->andWhere(['status' => 1, 'province_id' => $province->province_id, 'district_id' => $district->district_id]);
						/*if($session->has('province_id') && $session->get('province_id')){
							$query->andWhere([ 'province_id' => $session->get('province_id')]);
						}*/
						//echo '<pre>'; var_dump($articleType); 	echo '<pre/>';
						//	die;
						/*if( $province_id){
							$query->andWhere(['province_id' => $province_id]);
						}
						*/
						
									$totalCount = $query->count();
									$query->offset(0);
									$query->limit(9);
									$query->orderBy(['created' => SORT_DESC]);
									$models = $query->all();
									$this->view->title = $articleType->title;
									$this->metaTagGoogle([
										['name' => 'description','content' => $articleType->title],
										['name' => 'copyright','content' => 'E-land.VN@2018-' . date('Y')],
										['name' => 'author','content' => 'E-land.VN'],
										['name' => 'robots','content' => 'index,follow'],
										['name' => 'keywords','content' => 'nha o, chung cu, phong cho thue']
									]);
									$this->metaHead([
										[ 'property' => 'og:url','content' => Url::to(['article/province-slug_category-or_slug_type-or_slug_district','slug' =>  $articleType->slug ],true),],
										[ 'property' => 'og:type','content' => 'website',],
										[ 'property' => 'og:title','content' => $articleType->title,],
										[ 'property' => 'og:description','content' =>  $articleType->description,],
										[ 'property' => 'og:image','content' => Url::to('@web/images/' . ($articleType->image?$articleType->image:'e-land.jpg'), true ),]
										]);	
								$this->metaHead([
										[ 'property' => 'twitter:url','content' => Url::to(['article/province-slug_category-or_slug_type-or_slug_district','slug' =>  $articleType->slug],true)],
										[ 'property' => 'twitter:title','content' => $articleType->title,],
										[ 'property' => 'twitter:description','content' =>  $articleType->description,],
										[ 'property' => 'twitter:image','content' => Url::to('@web/images/' . ($articleType->image?$articleType->image:'e-land.jpg'), true ),]
										]);	
											$this->view->params['totalCount'] = $totalCount;	
									return $this->render('province_district_type', [
												'models' => $models,
												//'pages' => $pages,
												'page' => 'type',
												'district' => $district,
												'province' => $province,
												'articleType' => $articleType,
												'title' => $articleType->title,
												'slug'  => $articleType->slug,
												'totalCount' => $totalCount
									]);
						}
				
		}
		/*
			Example: https://e-land.vn/khanh-hoa/thanh-pho-nha-trang

		
		*/
		public function actionProvinceSlug_categoryOr_slug_typeOr_slug_district() {

				$province_slug = Yii::$app->request->get('province');
				$slug = Yii::$app->request->get('slug');
				$articleCategory = ArticleCategory::find()->andWhere(['slug' => $slug])->one();
				$province= Province::find()->andWhere(['slug' => $province_slug])->one();
				
				if($articleCategory){
					$query = $articleCategory->getArticleTypes();
					$totalCount =0;
					foreach ($articleCategory->getArticleTypes()->all() as $key => $value) { 
						$totalCount+= $value->getArticles()->andWhere(['status' => 1])->count();
					}
					$models = $query->offset(0)
						->limit(10)
						->orderBy(['sort' => SORT_DESC])
						->all();
					$article_type = [];
					foreach($models  as $key => $value) {
						$article_type[] = $value->title;
					}
					$article_type_string = implode(",",$article_type);
					$this->view->title = $articleCategory->title;
					$this->metaTagGoogle([
						['name' => 'description','content' => $articleCategory->description? trim(preg_replace('/\s+/', ' ', $article_type_string)):''],
						['name' => 'copyright','content' => 'E-land.VN@2018-' . date('Y')],
						['name' => 'author','content' => 'E-land.VN',],
						['name' => 'robots','content' => 'index,follow'],
						['name' => 'keywords','content' =>  $articleCategory->keyword]
					]);
						$this->metaHead([
						['property' => 'og:url','content' => Url::to(['article/province-slug_category-or_slug_type-or_slug_district','province' =>  $province->slug,'slug' =>  $articleCategory->slug],true)],
						['property' => 'og:type','content' => 'website'],
						['property' => 'og:title','content' => $province->type . ' ' . $province->name . ' - ' . $articleCategory->title],
						['property' => 'og:description','content' => $articleCategory->description],
						['property' => 'og:image','content' => Url::to('@web/images/'. ($articleCategory->image?$articleCategory->image:'e-land.jpg') , true )]
					]);
						$this->metaHead([
							[ 'property' => 'twitter:url','content' => Url::to(['article/province-slug_category-or_slug_type-or_slug_district','province' =>  $province->slug,'slug' =>  $articleCategory->slug],true)],
							[ 'property' => 'twitter:title','content' => $province->type . ' ' . $province->name . ' - ' . $articleCategory->title],
							[ 'property' => 'twitter:description','content' =>  $articleCategory->description],
							[ 'property' => 'twitter:image','content' => Url::to('@web/images/e-land.jpg', true )]
						]);	
							$this->view->params['totalCount'] = $totalCount;
							
						return $this->render('province_category', [
									'models' => $models,
									//'pages' => $pages,
									'page' => 'category',
									'province' => $province,
									'title' => $articleCategory->title,
									'slug'  => $articleCategory->slug,
									'totalCount' => $totalCount
						]);
				}
			$articleType = ArticleType::find()->andWhere(['slug' => $slug])->one();
				if($articleType){
					
						$query = $articleType->getArticles();
						$query = $query->andWhere(['status' => 1])->andWhere('province_id!="" AND district_id!=""');
						$totalCount = $query->count();
									$query->offset($this->offset);
									$query->limit($this->limit);
									$query->orderBy(['created' => SORT_DESC]);
									$models = $query->all();
									$this->view->title = $articleType->title;
									$this->metaTagGoogle([
										['name' => 'description','content' => $articleType->title],
										['name' => 'copyright','content' => 'E-land.VN@2018-' . date('Y')],
										['name' => 'author','content' => 'E-land.VN'],
										['name' => 'robots','content' => 'index,follow'],
										['name' => 'keywords','content' => $articleType->keyword.', '  . $province->type . ' ' . $province->name ]
										
									]);
									$this->metaHead([
										[ 'property' => 'og:url','content' => Url::to(['article/province-slug_category-or_slug_type-or_slug_district','province' =>  $province->slug, 'slug' =>  $articleType->slug ],true)],
										[ 'property' => 'og:type','content' => 'website'],
										[ 'property' => 'og:title','content' => $province->type . ' ' . $province->name . ' - ' . $articleType->title],
										[ 'property' => 'og:description','content' =>  $articleType->description,],
										[ 'property' => 'og:image','content' => Url::to('@web/images/' . ($articleType->image?$articleType->image:'e-land.jpg'), true )]
										]);	
								$this->metaHead([
										[ 'property' => 'twitter:url','content' => Url::to(['article/province-slug_category-or_slug_type-or_slug_district','province' =>  $province->slug, 'slug' =>  $articleType->slug ],true)],
										[ 'property' => 'twitter:title','content' => $province->type . ' ' . $province->name . ' - ' . $articleType->title],
										[ 'property' => 'twitter:description','content' =>  $articleType->description],
										[ 'property' => 'twitter:image','content' => Url::to('@web/images/' . ($articleType->image?$articleType->image:'e-land.jpg'), true )]
										]);	
											$this->view->params['totalCount'] = $totalCount;	
									return $this->render('type', [
												'models' => $models,
												//'pages' => $pages,
												'page' => 'type',
												'articleType' => $articleType,
												'title' => $articleType->title,
												'slug'  => $articleType->slug,
												'totalCount' => $totalCount
									]);
						}

			$district = District::findOne(['slug' => $slug]);
			if($district){
				$this->view->title = $district->type . ' ' . $district->name;
				$this->metaTagGoogle([
				 	['name' => 'description','content' => 'E-land.VN - '. $district->type . ' ' . $district->name . ', ' . $province->name .' - Kênh rao bán, cho thuê bất động sản dành cho cty, môi giới, chủ đầu tư, người có nhu cầu mua bán, cho thuê bât động sản'],
					['name' => 'copyright','content' => 'E-land.VN@2018-' . date('Y')],
					['name' => 'author','content' => 'E-land.VN'],
					['name' => 'robots','content' => 'index,follow'],
					['name' => 'keywords','content' => $district->keyword? $district->keyword: 'Mua nhà ,bán nhà, thuê nhà, bán đất, thuê văn phòng, bán căn hộ, '  . $district->type . ' ' . $district->name .  ', giá rẻ'
					]
				]);
									$this->metaHead([
										[ 'property' => 'og:url','content' => Url::to(['article/province-slug_category-or_slug_type-or_slug_district','province' => $province->slug, 'slug' =>  $district->slug ],true),],
										[ 'property' => 'og:type','content' => 'website',],
										[ 'property' => 'og:title','content' => $province->type . ' ' . $province->name .' - '. $district->type . ' ' . $district->name],
										[ 'property' => 'og:description','content' => 'E-land.VN - '. $district->type . ' ' . $district->name . ', ' . $province->name .' - Kênh rao bán, cho thuê bất động sản dành cho cty, môi giới, chủ đầu tư, người có nhu cầu mua bán, cho thuê bât động sản'],
										[ 'property' => 'og:image','content' => Url::to('@web/images/e-land.jpg', true )]
										]);	
								$this->metaHead([
										[ 'property' => 'twitter:url','content' => Url::to(['article/province-slug_category-or_slug_type-or_slug_district','province' => $province->slug, 'slug' =>  $district->slug ],true)],
										[ 'property' => 'twitter:title','content' => $province->type . ' ' . $province->name .' - '. $district->type . ' ' . $district->name],
										[ 'property' => 'twitter:description','content' =>  'E-land.VN - '. $district->type . ' ' . $district->name . ', ' . $province->name .' - Kênh rao bán, cho thuê bất động sản dành cho cty, môi giới, chủ đầu tư, người có nhu cầu mua bán, cho thuê bât động sản'],
										[ 'property' => 'twitter:image','content' => Url::to('@web/images/e-land.jpg', true )]
										]);	
				 
				
				$query = $district->getArticles()->andWhere(['status' => 1])->andWhere('province_id!="" AND district_id!=""');
				$totalCount = $query->count();
				$models = $query->offset($this->offset)
                        ->limit($this->limit)
                        ->orderBy(['updated' => SORT_DESC])
                        ->all();
                        	$this->view->params['totalCount'] = $totalCount;
				 return $this->render('district', [
                           'models' => $models,
						    'title' =>  $district->type . ' ' . $district->name,
						   	'page' => 'district',
							'slug'  => $district->slug,
							'district_slug'  => $district->slug,
							'province_slug'  => $district->province->slug,
							'totalCount' => $totalCount
                           
                ]);
            
			}
		}
		 public function actionDistrict() {
				$district = District::findOne(['slug' => Yii::$app->request->get('district')]);
				$this->view->title = $district->type . ' ' . $district->name;
				$this->metaTagGoogle([
				 	['name' => 'description','content' => 'Mua bán cho thuê bất động sản tại ' . $district->type . ' ' . $district->name],
					['name' => 'copyright','content' => 'E-land.VN@2018-' . date('Y')],
					['name' => 'author','content' => 'E-land.VN'],
					['name' => 'robots','content' => 'index,follow'],
					['name' => 'keywords','content' => 'nha o, chung cu, phong cho thue']
				]);
				
				$query = $district->getArticles()->andWhere(['status' => 1])->andWhere('province_id!="" AND district_id!=""');
				$totalCount = $query->count();
				$models = $query->offset(0)
                        ->limit(20)
                        ->orderBy(['updated' => SORT_DESC])
                        ->all();
                 $this->view->params['totalCount'] = $totalCount;
				 return $this->render('district', [
                           'models' => $models,
						    'title' =>  $district->type . ' ' . $district->name,
						   	'page' => 'district',
							'slug'  => $district->slug,
							'district_slug'  => $district->slug,
							'province_slug'  => $district->province->slug,
							'totalCount' => $totalCount
                           
                ]);
            
	}
	
    public function actionDetail(){
				$slug = Yii::$app->request->get('slug');
				$model= Article::find()->andWhere(['status' => 1])->andWhere(['slug' => $slug])->one();
				if($model){
				$articleImages = $model->images;
				$articleDetail = $model->articleDetail;
				$articleType = $model->articleType;
				$articleCategory = $model->articleType->articleCategory;
				$this->view->title = $model->title;
				$this->metaTagGoogle([
				 	['name' => 'description','content' => !empty($model->description)? trim(preg_replace('/\s\s+/', ' ', strip_tags($model->description))): trim(preg_replace('/\s\s+/', ' ',  strip_tags($model->content)))],
					['name' => 'copyright','content' => 'E-land.VN@2018-' . date('Y')],
					['name' => 'author','content' => $model->user->name],
					['name' => 'robots','content' => 'index,follow'],
					['name' => 'keywords','content' => 'nha o, chung cu, phong cho thue']
				 ]);
				$this->metaHead([
						[ 'property' => 'og:url','content' => Url::to(['article/detail', 'province' => isset($model->province)?$model->province->slug:'', 'district' => isset($model->district)?$model->district->slug:'', 'type' => isset($model->articleType)?$model->articleType->slug:'', 'slug' => $model->slug],true),],
   				 		['property' => 'og:type','content' => 'article',],
		   				['property' => 'og:title','content' => $model->title,],
   				 		['property' => 'og:description','content' => !empty($model->description)? trim(preg_replace('/\s\s+/', ' ', strip_tags($model->description))): trim(preg_replace('/\s\s+/', ' ',  strip_tags($model->content))),
   				 		],
   				 		['property' => 'og:image','content' => Url::to('@web/channels/article/745x510/'. ($model->images?$model->images[0]->image:'e-land.jpg') , true ),]
   				 	]);
				$this->metaHead([
						[ 'property' => 'twitter:url','content' => Url::to(['article/detail', 'province' => isset($model->province)?$model->province->slug:'', 'district' => isset($model->district)?$model->district->slug:'', 'type' => isset($model->articleType)?$model->articleType->slug:'', 'slug' => $model->slug],true),
   				 		],
   				 		['property' => 'twitter:card','content' => 'article',],
		   				['property' => 'twitter:title','content' => $model->title,],
   				 		['property' => 'twitter:description','content' => !empty($model->description)? trim(preg_replace('/\s\s+/', ' ', strip_tags($model->description))): trim(preg_replace('/\s\s+/', ' ',  strip_tags($model->content))),
   				 		],
   				 		['property' => 'twitter:image','content' => Url::to('@web/channels/article/745x510/'. ($model->images?$model->images[0]->image:'e-land.jpg') , true ),
   				 		]
   				 	]);

				return $this->render('detail', [
							'model' => $model,
							'articleImages' => $articleImages,
							'articleDetail' => $articleDetail,
							'articleType' => $articleType,
							'slug' => $slug,
                            'articleCategory' => $articleCategory,
				]);
			}else{throw new \yii\web\NotFoundHttpException("Không tìm thấy trang.");}
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
						$category= ArticleCategory::findOne(['slug' => $slug]);
						if($category){
							$query= Article::find()->andWhere(['status' => 1])->andWhere(['category_id' => $category->id]);
						}
						break;
						}
				case 'type':{
						$type= ArticleType::findOne(['slug' => $slug]);
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
						'user_link' => Yii::$app->params['elandUrl'] . 'kenh/' . $value->user->id,
						'district' => Yii::$app->params['elandUrl']. (isset($value->district)?$value->district->slug:''),
						'province' => Yii::$app->params['elandUrl']. (isset($value->province)?$value->province->slug:''),
						'district_name' => isset($value->district)?($value->district->type  . ' ' . $value->district->name):'',
						'province_name' => isset($value->province)?$value->province->name:'',
						'article_type' => isset($value->articleType)?$value->articleType->title:'',
						'post_date' =>  date('d/m/Y',strtotime($value->post_date)),
						'district_link' => (isset($value->district) && isset($value->province)) ? Url::to(['article/district','district' => $value->district->slug,'province' => $value->province->slug,'district_id' => $value->district->district_id,'province_id' => $value->province->province_id],true):'',
						'province_link' => isset($value->province) ? Url::to(['article/province','province' => $value->province->slug,'province_id' => $value->province->province_id],true):'',
						//'href' =>  Url::to(['article/detail', 'province' => isset($value->province)?$value->province->slug:'', 'district' => isset($value->district)?$value->district->slug:'', 'category' => isset($value->articleType)?$value->articleType->slug:'', 'slug' => $value->slug, 'district_id' => $value->district_id, 'province_id' => $value->province_id],true),
						'href' => Url::to(['article/detail', 'province' => isset($value->province)?$value->province->slug:'', 'district' => isset($value->district)?$value->district->slug:'', 'type' => isset($value->articleType)?$value->articleType->slug:'', 'slug' => $value->slug],true),
					//	'href' =>  Url::to(['article/detail','slug' => $value->slug], true),
						//'user_image' => $value->user->image?(Yii::$app->params['elandUrl'] . 'avatar/user/'.$value->user->image): (Yii::$app->params['elandUrl']. "images/no-image.png"),
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
			
    	//if ($article_id) {
    		
			/*foreach ($comment_users as $key => $value){
    			$commentUser[]=[
    				'comment' => $value->comment,
    				'name' => $value->user->name,
    				'image' => $value->user->image,
    				'id' => $value->id,
    				'like' => (int)$value->like,
                 	'created' =>  date('d/m/Y  H:s',  strtotime($value->created)),
                 	'rating' =>  $value->rating
    			];
    		}
    		if($commentUser==null){
    			$error=1;
    			$message='Đánh giá đã hết';
    		}
    	}else{
    		$error=1;
    		$message='Giáo viên không tồn tại';
    	}
    	}else{
    		$error=1;
    		$message='Xãy ra lỗi';
    	}
    	$data=[
    		'comment_user' => $commentUser,
    		'error'=> $error,
    		'offset' =>  $offset + $limit,
    		'message' => $message,
    		'article_id' => $article_id,
    	];	 */
		
    
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