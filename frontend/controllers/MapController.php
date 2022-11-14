<?php
namespace frontend\controllers;
use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use  yii\helpers\Url;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use common\models\Article;
use common\models\Project;
use common\models\Province;
use yii\helpers\ArrayHelper;
use common\models\SearchKey;
class MapController extends AppController
{
	public $page = 'home-page';
  	public $title= 'E-land.VN';
  	public $actual_link ='';
	public $totalCount='';
	public $offset=1;
	public $limit =14;
    /**
     * Displays building project infomations.
     *
     * @return string
     */
    public function beforeAction($action) {
        parent::beforeAction($action);
        $this->actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/";
		$this->enableCsrfValidation = true;
	//	$this->layout="home";
		return true;
    }
	
	public function actionSearch() {
					//	$this->layout= false;
					//	$this->enableCsrfValidation = false;
						$map =  [
									'title' =>'Tìm kiếm',
									'lat' =>	Yii::$app->request->get('lat',10.714645),
									'lng' =>	Yii::$app->request->get('lng',106.639070),
									'search_text' => Yii::$app->request->get('t'), //text
									'search_slug' => Yii::$app->request->get('s'), //slug
									'search_category' => Yii::$app->request->get('c'), //category
									'search_price' => Yii::$app->request->get('p'), //price
									'search_direction' => Yii::$app->request->get('d'), //direction
									'search_area' => Yii::$app->request->get('a'), //area
								];
								
						$search_slug = $map['search_slug'];
						$session = Yii::$app->session;
						$province = Province::findOne(['province_id' => $session->get('province_id')]);
								
						if(!empty($map['search_text'])){
								$this->view->title = $map['search_text'];

								$query = Article::find();
								$query->andFilterWhere(['like', 'articles.title',  $map['search_text']]);
								if($search_slug){
										$query->joinWith(['categoryType' => function ( yii\db\ActiveQuery $query) use ($search_slug) {
											return $query->joinWith(['category' => function ( yii\db\ActiveQuery $query) use ($search_slug) {
												return $query->andWhere(['=', 'categories.slug',$search_slug]);
											}]);
										}]);
								}
								if( $session->has('province_id')  &&  $session->get('province_id')!=0){
										$query->andWhere(['province_id' => $session->get('province_id')]);
								}
			
								$countQuery = clone $query;
								$pages = new Pagination(['totalCount' => $countQuery->count()]);
								
								
							$articles = $query->offset(0)
									->limit(200)
									->orderBy(['title' => SORT_DESC])
									->all();
							$pages = new Pagination(['totalCount' => $countQuery->count()]);
							$totalCount = $countQuery->count();
							$this->view->params['totalCount'] = $totalCount;

							$projects = Project::find()->orderBy('created desc')->limit(30)->all();	
							$modelProjects = ArrayHelper::toArray($projects, [
									    'common\models\Project' => [
									        'id',
									        'name',
									        'lat',
									        'lng',
									    ],
									]);
							$modelArticles = ArrayHelper::toArray($articles, [
									    'common\models\Article' => [
									        'id',
									        'title',
									        'lat',
									        'lng',
									    ],
									]);
									
										

								
							
						}else{

							$query = Article::find();	
							/*if( $session->has('province_id')  &&  $session->get('province_id')!=0){
										$query->andWhere(['province_id' => $session->get('province_id')]);
							}*/
							
							/*$query->joinWith(['categoryType' => function ( yii\db\ActiveQuery $query) use ($search_slug) {
									return $query->joinWith(['category' => function ( yii\db\ActiveQuery $query) use ($search_slug) {
										return $query->andWhere(['=', 'categories.slug',$search_slug]);
									}]);
								}]);*/
							$countQuery = clone $query;
							$pages = new Pagination(['totalCount' => $countQuery->count()]);
							$articles = $query->offset(0)
										->limit(200)
										->orderBy('created desc')->all();

							$projects = Project::find()->orderBy('created desc')->limit(30)->all();	
							$totalCount = $countQuery->count();
							$modelProjects = ArrayHelper::toArray($projects, [
									    'common\models\Project' => [
									        'id',
									        'name',
									        'lat',
									        'lng',
									    ],
									]);
							$modelArticles = ArrayHelper::toArray($articles, [
									    'common\models\Article' => [
									        'id',
									        'title',
									        'lat',
									        'lng',
									    ],
									]);
									
										

							}	

			return $this->render('search', [ 
							'province' => $province,
							'map' => $map, 
							'articles' => $articles,
							'projects' => $projects,
							'modelArticles' => json_encode($modelArticles),
							'modelProjects' => json_encode($modelProjects),
							'pages' => $pages,
							'totalCount' => $totalCount
						]);		
		
	}

	private function keyWord($search_text){
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
								if(!in_array($search_text, array_column($session['key_word'], 'key_text'))) {
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
		
}