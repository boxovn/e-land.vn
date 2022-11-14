<?php
namespace frontend\widgets;
use yii;
use common\models\Article;
use common\models\BuildingProjectInfo;
use yii\db\ActiveQuery;
class NewArticle extends yii\base\Widget{
	    public $slug;
		public $limit=4;
		public $offset=0;
		public $articles;
		public $title="Tin rao mới";
		public $type='block';
		public function init(){
            parent::init();
				$session = Yii::$app->session;
				
			$query = Article::find()->andWhere(['status' => 1]);
			/*if($session->has('province_id') && $session->get('province_id')){
					$query->andWhere([ 'province_id' => $session->get('province_id')]);
			}*/
			
			/*$query->joinWith(['images' => function (ActiveQuery $query) {
				//return $query->andWhere(['{{article_image}}.id' => null]);
				return  $query->andWhere(['not', ['{{article_image}}.id' => null]]);
    		}]);
    		*/
    		
			$query->offset($this->offset);
            $query->limit($this->limit);
            $query->orderBy(['created' => SORT_DESC]);
          
            $this->articles = $query->all();
           
		}
		public function run() {
			//parent::run();
			return $this->render( $this->type . '_article',[
								'articles' =>   $this->articles,
								'title' => $this->title,
								'slug' => '',
			]);
	}
}