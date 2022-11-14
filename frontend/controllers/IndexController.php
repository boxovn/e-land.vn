<?php
namespace frontend\controllers;
use Yii;
use common\models\Article;
use common\models\User;
use common\models\District;
use common\models\Province;
use common\models\Street;
use common\models\Partner;
use common\models\SearchKey;
use common\models\ApartmentCategory;
use yii\data\Pagination;
use common\libraries\PseudoCrypt;
use yii\web\Controller;
use  yii\helpers\Url;
use frontend\models\ResetPasswordForm;
date_default_timezone_set('Asia/Ho_Chi_Minh');
class IndexController extends AppController {

    public $page = 'home-page';
    public $title= 'Eland';
    public $detail= 'dt';
    public $head= '';
  
    /**
     * 
     * @return type
     */
	 public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
	 public function beforeAction($action) {
        parent::beforeAction($action);
      //  $this->layout = 'layout_index';
		
        return true;
    }
	/*public function actionChange() {
		$province_id = \Yii::$app->request->post('province');
		
		
		if ($province_id && $province_id !=  \Yii::$app->session->get('province_id')) {
			
				\Yii::$app->session->set('province_id', $province_id);
		}else{
				\Yii::$app->session->set('province_id', '');
		}
	
			Yii::$app->getResponse()->redirect(['article/index']);
		   Yii::$app->end();
    }
    */
	
	public function actionError()
{
    $exception = Yii::$app->errorHandler->exception;
    if ($exception !== null) {
        return $this->render('error', ['exception' => $exception]);
    }
}
	  public function actionResult() {

			$search_text = Yii::$app->request->get('search');
			if(!empty($search_text)){
				$this->view->title = $search_text;
			$query = Article::find()->andFilterWhere(['like', 'title', $search_text]);
            $countQuery = clone $query;
            $pages = new Pagination(['totalCount' => $countQuery->count()]);
			$user = Yii::$app->user->identity;
			$session = Yii::$app->session;
			if (!isset($session['key_word']) || count($session['key_word'])==0) 
			 {
				 $myarr[] = [
					'user_id' => $user? $user->id: 0,
					'key_text' => $search_text,
				];
				$session['key_word'] = $myarr;
			 }else {
				$myarr = $session['key_word'];
				if(!in_array($search_text, array_column($session['key_word'], 'key_text'))) { // search value in the array
						$myarr[] = [
					'user_id' => $user? $user->id: 0,
					'key_text' => $search_text,
				];
				}
				sort($myarr);
				$session['key_word'] = $myarr;
			}
			$searchKey = new SearchKey();
			$searchKey->key_text= $search_text;
			$searchKey->user_id=  $user? $user->id: 0;
			$searchKey->save();
			$models = $query->offset(0)
                    ->limit(20)
                    ->orderBy(['title' => SORT_DESC])
                    ->all();
            $pages = new Pagination(['totalCount' => $countQuery->count()]);
			$totalCount = $countQuery->count();
			$this->view->params['totalCount'] = $totalCount;
             return $this->render('result', [
                        'detail' => $this->detail,
                        'slug' => Yii::$app->request->get('slug'),
                        'models' => $models,
                        'pages' => $pages,
						'totalCount' => $totalCount
            ]);
		}
			
                Yii::$app->getResponse()->redirect(['index/index']);
                Yii::$app->end();
	  }
	  
	   public function actionSearch() {

							$search_text = Yii::$app->request->get('t');
						
							if(!empty($search_text)){
								$this->view->title = $search_text;
								$query = Article::find()->andFilterWhere(['like', 'title',  $search_text]);
								$countQuery = clone $query;
								$pages = new Pagination(['totalCount' => $countQuery->count()]);
								$user = Yii::$app->user->identity;
								$session = Yii::$app->session;
							if (!isset($session['key_word']) || count($session['key_word'])==0) 
							 {
								 $myarr[] = [
									'user_id' => $user? $user->id: 0,
									'key_text' => $search_text,
								];
								$session['key_word'] = $myarr;
							 }else {
								$myarr = $session['key_word'];
								if(!in_array($search_text, array_column($session['key_word'], 'key_text'))) { // search value in the array
										$myarr[] = [
									'user_id' => $user? $user->id: 0,
									'key_text' =>  $search_text,
								];
								}
								sort($myarr);
								$session['key_word'] = $myarr;
							}
							$searchKey = new SearchKey();
							$searchKey->key_text=  $search_text;
							$searchKey->user_id=  $user? $user->id: 0;
							$searchKey->save();
							$models = $query->offset(0)
									->limit(20)
									->orderBy(['title' => SORT_DESC])
									->all();
							$pages = new Pagination(['totalCount' => $countQuery->count()]);
							$totalCount = $countQuery->count();
							$this->view->params['totalCount'] = $totalCount;
							 return $this->render('result', [
										'detail' => $this->detail,
										'slug' => Yii::$app->request->get('slug'),
										'models' => $models,
										'pages' => $pages,
										'text' =>  $search_text,
										'totalCount' => $totalCount
							]);
						}
			
                Yii::$app->getResponse()->redirect(['/']);
                Yii::$app->end();
	  }
	  public function actionFilter() {
			$error=0;
			$message='';
			$search_text = Yii::$app->request->get('search_text');
			$session = Yii::$app->session;
			//$session->remove('key_word');
			$articles =  $session['key_word'];
			$result = ['error' => $error , 'message' => $message, 'articles' =>  $articles];
		echo json_encode($result);
        exit();
	}
	public function actionRemove() {
			$error=0;
			$message='';
			$id = Yii::$app->request->get('id');
			$session = Yii::$app->session;
			$myarr = $session['key_word'];
			//$session->remove('key_word');
			array_splice($myarr, $id, 1); //remove
			$session['key_word'] = $myarr;
			
			$result = ['error' => $error , 'message' => $message, 'id' =>  $id];
		echo json_encode($result);
        exit();
	}
    public function actionIndex() {
       
		$this->view->title = 'custom-title';
		$this->view->params['head'] = array();
			//$session = Yii::$app->session;
            $query = Article::find();
            $countQuery = clone $query;
            $pages = new Pagination(['totalCount' => $countQuery->count()]);
            $totalCount = $countQuery->count();
            $models = $query->offset(0)->limit(40)->orderBy(['post_date' => SORT_DESC])->all();
            return $this->render('index', [
                'detail' => $this->detail,
                'category_slug' => Yii::$app->request->get('slug'),
                'models' => $models,
                'pages' => $pages,
                'totalCount' => $totalCount
            ]);
		if (Yii::$app->request->get('slug')) {
				$district = District::findOne(['slug' => Yii::$app->request->get('slug')]);
				if($district){
					$query = Article::find()->andWhere(['=', 'district_id', $district->district_id]);
					$countQuery = clone $query;
					$pages = new Pagination(['totalCount' => $countQuery->count()]);
					$totalCount = $countQuery->count();
					$models = $query->offset(0)->limit(40)->orderBy(['post_date' => SORT_DESC])->all();
					return $this->render('index', [
                        'detail' => $this->detail,
                        'category_slug' => Yii::$app->request->get('slug'),
                        'models' => $models,
                        'pages' => $pages,
						'totalCount' => $totalCount
					]);
			}
			$province = Province::findOne(['slug' => Yii::$app->request->get('slug')]);
				if($province){
					$query = Article::find()->andWhere(['=', 'province_id', $province->province_id]);
					$countQuery = clone $query;
					$totalCount = $countQuery->count();
					$pages = new Pagination(['totalCount' => $totalCount]);
					$models = $query->offset(0)->limit(20)->orderBy(['post_date' => SORT_DESC])->all();
					return $this->render('index', [
                        'detail' => $this->detail,
                        'category_slug' => Yii::$app->request->get('slug'),
                        'models' => $models,
                        'pages' => $pages,
						'totalCount' => $totalCount
					]);
			}
				
			$pieces= explode('-', $string);
            $project_id = array_pop($pieces);
            $first = substr($project_id,0,2);
            $last =  substr($project_id,2, strlen($project_id)-2);
			if(is_numeric($last) && $first=="dt"){
                $this->layout = "main_detail";
                $query = Article::find()->andWhere(['id' => $last, 'status' => 0]);
				$model = $query->one();
				$queryListRight = Article::find()->andWhere([ 'status' => 0]);
                $countQuery = clone $queryListRight;
				$totalCount = $countQuery->count();
                $pages = new Pagination(['totalCount' => $totalCount, 'pageSize' => 8]);

                $listRight = $queryListRight->offset($pages->offset)
                ->limit(6)
                ->all();
                $this->view->params['head'] = $model;
                return $this->render('detail', [
                       'detail' => $this->detail,
                        'model' => $model,
                        'images' => isset($model->images)? $model->images: array(),
                        'listRight' => $listRight,
						'totalCount' => $totalCount
                ]);
            }else{
				$query = Article::find()->andWhere(['slug' => Yii::$app->request->get('slug'), 'status' => 0]);
				if ($query->count() >= 1) {
					$category = $query->one();
					$query = Article::find()->andWhere(['status' => 0, 'province_id' => 79, 'apartment_category_id' => $category->id]);
					$countQuery = clone $query;
					$totalCount = $countQuery->count();
					$pages = new Pagination(['totalCount' => $totalCount]);
					$models = $query->offset($pages->offset)
							->limit(12)
							->orderBy(['post_date' => SORT_DESC])
							->all();
					$category_name=  $category->name;
					return $this->render('index', [
								'detail' => $this->detail,
								'category_slug' => Yii::$app->request->get('slug'),
								'category' => $category,
								'category_name' => $category_name,
								'models' => $models,
								'pages' => $pages,
								'totalCount' => $totalCount
					]);
            }
           
            $query = District::find()->andWhere(['slug' => Yii::$app->request->get('slug')]);

            if ($query->count() >= 1) {

                $district = $query->one();
                $query = Article::find()->andWhere([  'status' => 0,'province_id'=> 79,'district_id' => $district->district_id]);
                $countQuery = clone $query;
				$totalCount = $countQuery->count();
                $pages = new Pagination(['totalCount' => $totalCount]);
                $models = $query->offset($pages->offset)
                        ->limit(20)
                        ->orderBy(['post_date' => SORT_DESC])
                        ->all();
                return $this->render('index', [
                            'detail' => $this->detail,
                            'category_slug' => Yii::$app->request->get('slug'),
                            'district' => $district,
                            'models' => $models,
                            'pages' => $pages,
							'totalCount' => $totalCount
                ]);
            }
            }
        }else{
              $query = Article::find()->andWhere([ 'status' => 0]);
            $countQuery = clone $query;
			$totalCount = $countQuery->count();
			
            $pages = new Pagination(['totalCount' => $totalCount]);
            $models = $query->offset(0)
                    ->limit(20)
                    ->orderBy(['post_date' => SORT_DESC])
                    ->all();
             
             return $this->render('index', [
                        'detail' => $this->detail,
                        'category_slug' => Yii::$app->request->get('slug'),
                        'models' => $models,
                        'pages' => $pages,
						'totalCount' => $totalCount
            ]);
        }
        }
		 public function actionSale() {
		
		$this->view->title = 'custom-title';
		$this->view->params['head'] = array();
		
		if (Yii::$app->request->get('slug')) {
				$district = District::findOne(['slug' => Yii::$app->request->get('slug')]);
				if($district){
					$query = Article::find()->andWhere(['=', 'district_id', $district->district_id]);
					$countQuery = clone $query;
					$pages = new Pagination(['totalCount' => $countQuery->count()]);
					$models = $query->offset(0)->limit(20)->orderBy(['post_date' => SORT_DESC])->all();
					return $this->render('index', [
                        'detail' => $this->detail,
                        'category_slug' => Yii::$app->request->get('slug'),
                        'models' => $models,
                        'pages' => $pages,
					]);
			}
			$province = Province::findOne(['slug' => Yii::$app->request->get('slug')]);
				if($province){
					$query = Article::find()->andWhere(['=', 'province_id', $province->province_id]);
					$countQuery = clone $query;
					$pages = new Pagination(['totalCount' => $countQuery->count()]);
					$models = $query->offset(0)->limit(20)->orderBy(['post_date' => SORT_DESC])->all();
					return $this->render('index', [
                        'detail' => $this->detail,
                        'category_slug' => Yii::$app->request->get('slug'),
                        'models' => $models,
                        'pages' => $pages,
					]);
			}
				
			$pieces= explode('-', $string);
            $project_id = array_pop($pieces);
            $first = substr($project_id,0,2);
            $last =  substr($project_id,2, strlen($project_id)-2);
			if(is_numeric($last) && $first=="dt"){
                $this->layout = "main_detail";
                $query = Article::find()->andWhere(['id' => $last, 'status' => 0]);
				$model = $query->one();
				$queryListRight = Article::find()->andWhere([ 'status' => 0]);
                $countQuery = clone $queryListRight;
                $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 8]);

                $listRight = $queryListRight->offset($pages->offset)
                ->limit(6)
                ->all();
                $this->view->params['head'] = $model;
                return $this->render('detail', [
                       'detail' => $this->detail,
                        'model' => $model,
                        'images' => isset($model->images)? $model->images: array(),
                        'listRight' => $listRight,
                ]);
            }else{
				$query = Article::find()->andWhere(['slug' => Yii::$app->request->get('slug'), 'status' => 0]);
				if ($query->count() >= 1) {
					$category = $query->one();
					$query = Article::find()->andWhere(['status' => 0, 'province_id' => 79, 'apartment_category_id' => $category->id]);
					$countQuery = clone $query;
					$pages = new Pagination(['totalCount' => $countQuery->count()]);
					$models = $query->offset($pages->offset)
							->limit(20)
							->orderBy(['post_date' => SORT_DESC])
							->all();
					$category_name=  $category->name;
					return $this->render('index', [
								'detail' => $this->detail,
								'category_slug' => Yii::$app->request->get('slug'),
								'category' => $category,
								'category_name' => $category_name,
								'models' => $models,
								'pages' => $pages,
					]);
            }
           
            $query = District::find()->andWhere(['slug' => Yii::$app->request->get('slug')]);

            if ($query->count() >= 1) {

                $district = $query->one();
                $query = Article::find()->andWhere([  'status' => 0,'province_id'=> 79,'district_id' => $district->district_id]);
                $countQuery = clone $query;
                $pages = new Pagination(['totalCount' => $countQuery->count()]);
                $models = $query->offset($pages->offset)
                        ->limit(20)
                        ->orderBy(['post_date' => SORT_DESC])
                        ->all();
                return $this->render('index', [
                            'detail' => $this->detail,
                            'category_slug' => Yii::$app->request->get('slug'),
                            'district' => $district,
                            'models' => $models,
                            'pages' => $pages,
                ]);
            }
            }
        }else{
            $query = Article::find()->andWhere([ 'status' => 0]);
            $countQuery = clone $query;
            $pages = new Pagination(['totalCount' => $countQuery->count()]);
            $models = $query->offset(0)
                    ->limit(20)
                       ->orderBy(['post_date' => SORT_DESC])
                    ->all();
             
             return $this->render('index', [
                        'detail' => $this->detail,
                        'category_slug' => Yii::$app->request->get('slug'),
                        'models' => $models,
                        'pages' => $pages,
            ]);
        }
        }
		 public function actionRent() {
		
		$this->view->title = 'custom-title';
		$this->view->params['head'] = array();
		
		if (Yii::$app->request->get('slug')) {
				$district = District::findOne(['slug' => Yii::$app->request->get('slug')]);
				if($district){
					$query = Article::find()->andWhere(['=', 'district_id', $district->district_id]);
					$countQuery = clone $query;
					$pages = new Pagination(['totalCount' => $countQuery->count()]);
					$models = $query->offset(0)->limit(20)->orderBy(['post_date' => SORT_DESC])->all();
					return $this->render('index', [
                        'detail' => $this->detail,
                        'category_slug' => Yii::$app->request->get('slug'),
                        'models' => $models,
                        'pages' => $pages,
					]);
			}
			$province = Province::findOne(['slug' => Yii::$app->request->get('slug')]);
				if($province){
					$query = Article::find()->andWhere(['=', 'province_id', $province->province_id]);
					$countQuery = clone $query;
					$pages = new Pagination(['totalCount' => $countQuery->count()]);
					$models = $query->offset(0)->limit(20)->orderBy(['post_date' => SORT_DESC])->all();
					return $this->render('index', [
                        'detail' => $this->detail,
                        'category_slug' => Yii::$app->request->get('slug'),
                        'models' => $models,
                        'pages' => $pages,
					]);
			}
				
			$pieces= explode('-', $string);
            $project_id = array_pop($pieces);
            $first = substr($project_id,0,2);
            $last =  substr($project_id,2, strlen($project_id)-2);
			if(is_numeric($last) && $first=="dt"){
                $this->layout = "main_detail";
                $query = Article::find()->andWhere(['id' => $last, 'status' => 0]);
				$model = $query->one();
				$queryListRight = Article::find()->andWhere([ 'status' => 0]);
                $countQuery = clone $queryListRight;
                $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 8]);

                $listRight = $queryListRight->offset($pages->offset)
                ->limit(6)
                ->all();
                $this->view->params['head'] = $model;
                return $this->render('detail', [
                       'detail' => $this->detail,
                        'model' => $model,
                        'images' => isset($model->images)? $model->images: array(),
                        'listRight' => $listRight,
                ]);
            }else{
				$query = Article::find()->andWhere(['slug' => Yii::$app->request->get('slug'), 'status' => 0]);
				if ($query->count() >= 1) {
					$category = $query->one();
					$query = Article::find()->andWhere(['status' => 0, 'province_id' => 79, 'apartment_category_id' => $category->id]);
					$countQuery = clone $query;
					$pages = new Pagination(['totalCount' => $countQuery->count()]);
					$models = $query->offset($pages->offset)
							->limit(20)
							->orderBy(['post_date' => SORT_DESC])
							->all();
					$category_name=  $category->name;
					return $this->render('index', [
								'detail' => $this->detail,
								'category_slug' => Yii::$app->request->get('slug'),
								'category' => $category,
								'category_name' => $category_name,
								'models' => $models,
								'pages' => $pages,
					]);
            }
           
            $query = District::find()->andWhere(['slug' => Yii::$app->request->get('slug')]);

            if ($query->count() >= 1) {

                $district = $query->one();
                $query = Article::find()->andWhere([  'status' => 0,'province_id'=> 79,'district_id' => $district->district_id]);
                $countQuery = clone $query;
                $pages = new Pagination(['totalCount' => $countQuery->count()]);
                $models = $query->offset($pages->offset)
                        ->limit(20)
                        ->orderBy(['post_date' => SORT_DESC])
                        ->all();
                return $this->render('index', [
                            'detail' => $this->detail,
                            'category_slug' => Yii::$app->request->get('slug'),
                            'district' => $district,
                            'models' => $models,
                            'pages' => $pages,
                ]);
            }
            }
        }else{
            $query = Article::find()->andWhere([ 'status' => 0]);
            $countQuery = clone $query;
            $pages = new Pagination(['totalCount' => $countQuery->count()]);
            $models = $query->offset(0)
                    ->limit(20)
                    ->orderBy(['post_date' => SORT_DESC])
                    ->all();
             
             return $this->render('index', [
                        'detail' => $this->detail,
                        'category_slug' => Yii::$app->request->get('slug'),
                        'models' => $models,
                        'pages' => $pages,
            ]);
        }
        }
		 public function actionBuy() {
		
		$this->view->title = 'custom-title';
		$this->view->params['head'] = array();
		
		if (Yii::$app->request->get('slug')) {
				$district = District::findOne(['slug' => Yii::$app->request->get('slug')]);
				if($district){
					$query = Article::find()->andWhere(['=', 'district_id', $district->district_id]);
					$countQuery = clone $query;
					$pages = new Pagination(['totalCount' => $countQuery->count()]);
					$models = $query->offset(0)->limit(20)->orderBy(['post_date' => SORT_DESC])->all();
					return $this->render('index', [
                        'detail' => $this->detail,
                        'category_slug' => Yii::$app->request->get('slug'),
                        'models' => $models,
                        'pages' => $pages,
					]);
			}
			$province = Province::findOne(['slug' => Yii::$app->request->get('slug')]);
				if($province){
					$query = Article::find()->andWhere(['=', 'province_id', $province->province_id]);
					$countQuery = clone $query;
					$pages = new Pagination(['totalCount' => $countQuery->count()]);
					$models = $query->offset(0)->limit(20)->orderBy(['post_date' => SORT_DESC])->all();
					return $this->render('index', [
                        'detail' => $this->detail,
                        'category_slug' => Yii::$app->request->get('slug'),
                        'models' => $models,
                        'pages' => $pages,
					]);
			}
				
			$pieces= explode('-', $string);
            $project_id = array_pop($pieces);
            $first = substr($project_id,0,2);
            $last =  substr($project_id,2, strlen($project_id)-2);
			if(is_numeric($last) && $first=="dt"){
                $this->layout = "main_detail";
                $query = Article::find()->andWhere(['id' => $last, 'status' => 0]);
				$model = $query->one();
				$queryListRight = Article::find()->andWhere([ 'status' => 0]);
                $countQuery = clone $queryListRight;
                $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 8]);

                $listRight = $queryListRight->offset($pages->offset)
                ->limit(6)
                ->all();
                $this->view->params['head'] = $model;
                return $this->render('detail', [
                       'detail' => $this->detail,
                        'model' => $model,
                        'images' => isset($model->images)? $model->images: array(),
                        'listRight' => $listRight,
                ]);
            }else{
				$query = Article::find()->andWhere(['slug' => Yii::$app->request->get('slug'), 'status' => 0]);
				if ($query->count() >= 1) {
					$category = $query->one();
					$query = Article::find()->andWhere(['status' => 0, 'province_id' => 79, 'apartment_category_id' => $category->id]);
					$countQuery = clone $query;
					$pages = new Pagination(['totalCount' => $countQuery->count()]);
					$models = $query->offset($pages->offset)
							->limit(20)
							->orderBy(['post_date' => SORT_DESC])
							->all();
					$category_name=  $category->name;
					return $this->render('index', [
								'detail' => $this->detail,
								'category_slug' => Yii::$app->request->get('slug'),
								'category' => $category,
								'category_name' => $category_name,
								'models' => $models,
								'pages' => $pages,
					]);
            }
           
            $query = District::find()->andWhere(['slug' => Yii::$app->request->get('slug')]);

            if ($query->count() >= 1) {

                $district = $query->one();
                $query = Article::find()->andWhere([  'status' => 0,'province_id'=> 79,'district_id' => $district->district_id]);
                $countQuery = clone $query;
                $pages = new Pagination(['totalCount' => $countQuery->count()]);
                $models = $query->offset($pages->offset)
                        ->limit(20)
                        ->orderBy(['post_date' => SORT_DESC])
                        ->all();
                return $this->render('index', [
                            'detail' => $this->detail,
                            'category_slug' => Yii::$app->request->get('slug'),
                            'district' => $district,
                            'models' => $models,
                            'pages' => $pages,
                ]);
            }
            }
        }else{
              $query = Article::find()->andWhere([ 'status' => 0]);
            $countQuery = clone $query;
            $pages = new Pagination(['totalCount' => $countQuery->count()]);
            $models = $query->offset(0)
                    ->limit(20)
                       ->orderBy(['post_date' => SORT_DESC])
                    ->all();
             
             return $this->render('index', [
                        'detail' => $this->detail,
                        'category_slug' => Yii::$app->request->get('slug'),
                        'models' => $models,
                        'pages' => $pages,
            ]);
        }
        }
		 public function actionArticleDetail() {
				$this->layout= false;
				$id = (int)Yii::$app->request->get('id');
				$model= Article::find()->andWhere(['id' => $id])->one();
				$articleImages = $model->images;
				$articleDetail = $model->articleDetail;
				$articelUser = $model->user;
				$user = \Yii::$app->user->identity;
				return $this->render('article_detail', [
							'model' => $model,
							'articleImages' => $articleImages,
							'articleDetail' => $articleDetail,
							'articelUser' => $articelUser
				]);
	
		}
		 public function actionDistrict() {
		
				$this->view->title = 'Dự án';
				$this->view->params['head'] = array();
				$query = Article::find()->andWhere(['district_id' => Yii::$app->request->get('district_id'),'province_id' => Yii::$app->request->get('province_id')]);
				$models = $query->offset(0)
                        ->limit(20)
                        ->orderBy(['updated' => SORT_DESC])
                        ->all();
						
                return $this->render('index', [
                           'models' => $models,
                           
                ]);
            
	}
	public function actionProvince() {
		
				$this->view->title = 'Dự án';
				$this->view->params['head'] = array();
				$query = Article::find()->andWhere(['province_id' => Yii::$app->request->get('province_id')]);
				$models = $query->offset(0)
                        ->limit(20)
                        ->orderBy(['updated' => SORT_DESC])
                        ->all();
						
                return $this->render('index', [
                           'models' => $models,
                           
                ]);
            
	}
        public function actionAutoLoading() {
			$offset = (int)Yii::$app->request->get('offset');
			$limit =  (int)Yii::$app->request->get('limit');
			$message= '';
			$error = '';
			$building= array();
			$query= Article::find()->andWhere([  'status' => 0]);
			$query->offset($offset)->limit($limit);
			$query->orderBy(['post_date' => SORT_DESC]);
			$models = $query->all();
			$user = \Yii::$app->user->identity;
		  foreach ($models as $key => $value) {
			  if(@getimagesize(Url::to('@web/channels/'. $value->user_id .'/article/210x118/' . $value->image, true))){
				   $urlImage =	Url::to('@web/channels/'. $value->user_id .'/article/210x118/' . $value->image, true);
			   }else{
				   $urlImage = Url::to('@web/images/no-image210x118.png', true);
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
						'room' =>   isset($user)? ($user->id + $value->user->id): 0,
						'user_id' =>   isset($user)? $user->id:0,
						'user_name' => preg_replace( "/\r|\n/", "", isset($user)?$user->name:''),
						'district' => Yii::$app->params['elandUrl']. (isset($value->district)?$value->district->slug:''),
						'province' => Yii::$app->params['elandUrl']. (isset($value->province)?$value->province->slug:''),
						'district_name' => isset($value->district)?($value->district->type  . ' ' . $value->district->name):'',
						'province_name' => isset($value->province)?$value->province->name:'',
						'article_type' => isset($value->articleType)?$value->articleType->title:'',
						'post_date' =>  date('d/m/Y',strtotime($value->post_date)),
						'district_link' => (isset($value->district) && isset($value->province)) ? Url::to(['index/district','district' => $value->district->slug,'province' => $value->province->slug,'district_id' => $value->district->district_id,'province_id' => $value->province->province_id],true):'',
						'province_link' => isset($value->province) ? Url::to(['index/province','province' => $value->province->slug,'province_id' => $value->province->province_id],true):'',
						'href' =>  Url::to(['article/index','slug' => $value->slug], true),
						//'user_image' => $value->user->image?(Yii::$app->params['elandUrl'] . 'avatar/user/'.$value->user->image): (Yii::$app->params['elandUrl']. "images/no-image.png"),
						'description' => $value->description,
              ];
          }
	
        $info = [
            'detail' => $this->detail,
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

    /**
     * 
     * @return type
     */
    public function actionApartment() {
        if (Yii::$app->request->get('slug')) {

            $query = District::find()->andWhere(['slug' => Yii::$app->request->get('slug')]);

            if ($query->count() >= 1) {

                $district = $query->one();
                $query = Article::find()->andWhere(['province_id'=> 79,'district_id' => $district->district_id]);
                $countQuery = clone $query;
                $pages = new Pagination(['totalCount' => $countQuery->count()]);
                $models = $query->offset($pages->offset)
                        ->limit(20)
                           ->orderBy(['post_date' => SORT_DESC])
                        ->all();
                return $this->render('index', [
                            'district' => $district,
                            'models' => $models,
                            'pages' => $pages,
                ]);
            } else {
                $query = Article::find()->andWhere(['province_id'=> 79,'slug' => Yii::$app->request->get('slug')]);
                $model = $query->one();

                $queryListRight = Article::find();
                $countQuery = clone $queryListRight;
                $pages = new Pagination(['totalCount' => $countQuery->count()]);
                $listRight = $queryListRight->offset($pages->offset)
                        ->limit(20)
                           ->orderBy(['post_date' => SORT_DESC])
                        ->all();
                return $this->render('detail', [
                            'model' => $model,
                            'images' => $model->images,
                            'listRight' => $listRight,
                ]);
            }
        } else {
            $query = Article::find();
            $countQuery = clone $query;
            $pages = new Pagination(['totalCount' => $countQuery->count()]);
            $models = $query->offset($pages->offset)
                    ->limit(20)
                       ->orderBy(['post_date' => SORT_DESC])
                    ->all();
            return $this->render('index', [
                        'models' => $models,
                       
                        'pages' => $pages,
            ]);
        }
    }
     public function actionHome() {
        if (Yii::$app->request->get('slug')) {

            $query = District::find()->andWhere(['slug' => Yii::$app->request->get('slug')]);

            if ($query->count() >= 1) {

                $district = $query->one();
                $query = Article::find()->andWhere(['district_id' => $district->district_id]);
                $countQuery = clone $query;
                $pages = new Pagination(['totalCount' => $countQuery->count()]);
                $models = $query->offset($pages->offset)
                        ->limit(20)
                        ->all();
                return $this->render('index', [
                            'district' => $district,
                            'models' => $models,
                            'pages' => $pages,
                ]);
            } else {
                $query = Article::find()->andWhere(['slug' => Yii::$app->request->get('slug')]);
                $model = $query->one();

                $queryListRight = Article::find();
                $countQuery = clone $queryListRight;
                $pages = new Pagination(['totalCount' => $countQuery->count()]);
                $listRight = $queryListRight->offset($pages->offset)
                        ->limit(20)
                        ->all();
                return $this->render('detail', [
                            'model' => $model,
                            'images' => $model->images,
                            'listRight' => $listRight,
                ]);
            }
        } else {
            $query = Article::find();
            $countQuery = clone $query;
            $pages = new Pagination(['totalCount' => $countQuery->count()]);
            $models = $query->offset($pages->offset)
                    ->limit(20)
                    ->all();
            return $this->render('index', [
                        'models' => $models,
                       
                        'pages' => $pages,
            ]);
        }
    }
     public function actionLand() {
        if (Yii::$app->request->get('slug')) {

            $query = District::find()->andWhere(['slug' => Yii::$app->request->get('slug')]);

            if ($query->count() >= 1) {

                $district = $query->one();
                $query = Article::find()->andWhere(['district_id' => $district->district_id]);
                $countQuery = clone $query;
                $pages = new Pagination(['totalCount' => $countQuery->count()]);
                $models = $query->offset($pages->offset)
                        ->limit(20)
                        ->all();
                return $this->render('index', [
                            'district' => $district,
                            'models' => $models,
                            'pages' => $pages,
                ]);
            } else {
                $query = Article::find()->andWhere(['slug' => Yii::$app->request->get('slug')]);
                $model = $query->one();

                $queryListRight = Article::find();
                $countQuery = clone $queryListRight;
                $pages = new Pagination(['totalCount' => $countQuery->count()]);
                $listRight = $queryListRight->offset($pages->offset)
                        ->limit(20)
                        ->all();
                return $this->render('detail', [
                            'model' => $model,
                            'images' => $model->images,
                            'listRight' => $listRight,
                ]);
            }
        } else {
            $query = Article::find();
            $countQuery = clone $query;
            $pages = new Pagination(['totalCount' => $countQuery->count()]);
            $models = $query->offset($pages->offset)
                    ->limit(20)
                    ->all();
            return $this->render('index', [
                        'models' => $models,
                       
                        'pages' => $pages,
            ]);
        }
    }
     public function actionOffice() {
        if (Yii::$app->request->get('slug')) {

            $query = District::find()->andWhere(['slug' => Yii::$app->request->get('slug')]);

            if ($query->count() >= 1) {

                $district = $query->one();
                $query = Article::find()->andWhere(['district_id' => $district->district_id]);
                $countQuery = clone $query;
                $pages = new Pagination(['totalCount' => $countQuery->count()]);
                $models = $query->offset($pages->offset)
                        ->limit(20)
                        ->all();
                return $this->render('index', [
                            'district' => $district,
                            'models' => $models,
                            'pages' => $pages,
                ]);
            } else {
                $query = Article::find()->andWhere(['slug' => Yii::$app->request->get('slug')]);
                $model = $query->one();

                $queryListRight = Article::find();
                $countQuery = clone $queryListRight;
                $pages = new Pagination(['totalCount' => $countQuery->count()]);
                $listRight = $queryListRight->offset($pages->offset)
                        ->limit(20)
                        ->all();
                return $this->render('detail', [
                            'model' => $model,
                            'images' => $model->images,
                            'listRight' => $listRight,
                ]);
            }
        } else {
            $query = Article::find();
            $countQuery = clone $query;
            $pages = new Pagination(['totalCount' => $countQuery->count()]);
            $models = $query->offset($pages->offset)
                    ->limit(20)
                    ->all();
            return $this->render('index', [
                        'models' => $models,
                       
                        'pages' => $pages,
            ]);
        }
    }

    /**
     * 
     */
    public function actionLogin() {
        $this->page = "page-register";
        $model = new \frontend\models\LoginForm();
        $reset = new \frontend\models\PasswordResetRequestForm();
        if (Yii::$app->request->isPost) {
            if (\Yii::$app->request->post('LoginForm')) {
                $model->attributes = \Yii::$app->request->post('LoginForm');
				
                if ($model->validate()) {
                    $model->login();
					$user = $model->getUser();
                    Yii::$app->getResponse()->redirect(array('user/index','id' => $user->id));
                }
				Yii::$app->session->setFlash("danger", "Bạn quên mật khẩu <a href='#forget'>Click vào đây</a>");
             }
            if (\Yii::$app->request->post('PasswordResetRequestForm')) {
                $reset->attributes = \Yii::$app->request->post('PasswordResetRequestForm');
                if ($reset->validate()) {
                    $reset->sendEmail();
                    Yii::$app->session->setFlash('success', "Chúng tôi đã gửi một E-mail tới hộp thư của bạn");
                }
            }
        }
        return $this->render('login', array('model' => $model, 'reset' => $reset));
    }

 function getUserIP()
{
    // Get real visitor IP behind CloudFlare network
    if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
              $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
              $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
    }
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }elseif(filter_var($forward, FILTER_VALIDATE_IP)){
        $ip = $forward;
    }else
    {
        $ip = $remote;
    }

    return $ip;
}

    public function actionRegister() {
        $this->page = "page-register";
        $model = new User();
        $model->setScenario('creating');

        if (Yii::$app->request->isPost) {
            $model->attributes = Yii::$app->request->post('User');
            $user_ip = $this->getUserIP();
            $model->ip =  $user_ip? $user_ip :'';
            $model->updated_at = date('Y-m-d H:i:s');
           // $model->status = User::STATUS_DEACTIVE;
            if ($model->validate()) {
                $model->setPassword($model->password);
                $model->generatePasswordResetToken();
                $model->save(false);
                  \yii::$app->session->set('id', $model->id);
                //send mail
                $resetLink = Yii::$app->urlManager->createAbsoluteUrl(['index/success', 'token' => $model->password_reset_token]);
                yii::$app->session->set('id', $model->id);
                \Yii::$app->mailer->compose(['html' => 'confirm-html'], ['user' => $model,'resetLink' => $resetLink])
                        ->setFrom([\Yii::$app->params['supportEmail'] => 'E-land '])
                        ->setTo($model->email)
                        ->setSubject('Xác nhận đăng ký tài khoản thành công ')
                        ->send();
                Yii::$app->session->setFlash('success', "Bạn đã đăng ký thành công");
                Yii::$app->getResponse()->redirect(['index/confirm']);
                Yii::$app->end();
            }
        }
        return $this->render('register', array('model' => $model));
    }

    /**
     * 
     */
    public function actionConfirm() {
        $this->page = "page-sign-up-confirm";
        if (\yii::$app->session->has('id')) {
            $user = User::findOne(\yii::$app->session->get('id'));
            if ($user) {
                \yii::$app->session->remove('id');
                return $this->render('confirm', ['user' => $user]);
            }
        }
        Yii::$app->getResponse()->redirect(['index/index']);
        Yii::$app->end();
    }
	

	public function actionPartnerConfirm(){
		 $token = \Yii::$app->request->get('token');
		$this->view->title = 'Xác nhận trờ thành đối tác';
		$user= array();
		if(Yii::$app->user->isGuest){
			Yii::$app->session->setFlash('warning', "Bạn cần đăng nhập trước khi xác nhận");
		}else{
			
			$user = Yii::$app->user->identity;
			$partner = Partner::findOne(['comfirm_token' => $token, 'status' => 0, 'partner_id' => 0]);
			if($partner){
				$partner->status = 1;
				$partner->comfirm_token= '';
				$partner->partner_id= $user->id;
				if($partner->save()){
					Yii::$app->session->setFlash('success', "Xác nhận thành công");
				}else{
					Yii::$app->session->setFlash('success', "Xác nhận thất bại");
				}
			}else{
				Yii::$app->session->setFlash('danger', "Xác nhận không tồn tại");
			}
		}
		return $this->render('partner_confirm', [
					'user' => $user,
		]);
	}
    
     /**
     * 
     */
    public function actionSuccess() {
        $this->page = 'page-sign-up-success';
        $success = false;
        $token = \Yii::$app->request->get('token');
        $user = User::findUserConfirm($token);
        if ($user) {
            $user->status = User::STATUS_ACTIVE;
            $user->save(false);
            $success = true;
        }
        return $this->render('success', ['success' => $success]);
    }
	
    public function actionForgetPassword(){
         $reset = new \frontend\models\PasswordResetRequestForm();

         if (\Yii::$app->request->post('PasswordResetRequestForm')) {
                $reset->attributes = \Yii::$app->request->post('PasswordResetRequestForm');
                if ($reset->validate()) {
                	$reset->sendEmail();
                	$reset->email='';
                    Yii::$app->session->setFlash('success', "Eland đã gửi một Email tới hộp thư của bạn!");
                }
            }
            return $this->render('forget-password',['reset' => $reset]);
    }
	
	 public function actionResetPassword($token = "") {
        //$this->layout = "clear";
        $model = new ResetPasswordForm();
        $message = "";
		
        if (!$model->checkToken($token)) {
            $message = "Request is invalid.Token is missing or incorrect!";
        } else {
				
           
                if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
                	Yii::$app->getSession()->setFlash('success', 'bạn đã thay đổi mật khẩu thành công');
                    Yii::$app->getResponse()->redirect(['index/login']);
                    Yii::$app->end();
                }
            
        }

        return $this->render('reset', ['model' => $model, 'message' => $message]);
    }


}
