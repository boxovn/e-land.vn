<?php
namespace frontend\widgets;
use yii;
use common\models\ArticleType;
use common\models\BuildingProjectInfo;
class ListArticle extends yii\base\Widget{
     public $slug;
	
		public function run() {
        parent::run();
			//$district_id = Yii::$app->request->get('district_id');
			//$province_id = Yii::$app->request->get('province_id');
			$articleType = ArticleType::find()->andWhere(['slug' => $this->slug])->one();
			$query = $articleType->getArticles();
			/*if($district_id){
				$query->andWhere(['district_id' => $district_id]);
			}
			if($province_id){
				$query->andWhere(['province_id' => $province_id]);
			}
			*/
			$query->offset(0);
            $query->limit(10);
            $query->orderBy(['created' => SORT_DESC]);
            $articles = $query->all();
			if($query->count()> 0)	{
				return $this->render('list_article',[
								'models' =>  $articles,
								'title' => $articleType->title,
								'slug' => $this->slug,		
				]);
			}
			return false;
    }
}