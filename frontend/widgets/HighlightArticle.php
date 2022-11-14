<?php
namespace frontend\widgets;
use yii;
use common\models\Article;
use common\models\BuildingProjectInfo;
class HighlightArticle extends yii\base\Widget{
	    public $slug;
		public $limit=10;
		public $offset=0;
		public $articles;
		public $title="Đia điểm nổi bật";
		public $type='block';
		public function init(){
            parent::init();
				$session = Yii::$app->session;
			$query = Article::find()->andWhere(['status' => 1]);
			if($session->has('province_id') && $session->get('province_id')){
					$query->andWhere([ 'province_id' => $session->get('province_id')]);
			}
			$query->offset($this->offset);
            $query->limit($this->limit);
            $query->orderBy(['created' => SORT_DESC]);
            $articles = $query->all();
            $this->articles = $query->all();
		}
		public function run() {
			//parent::run();
			return $this->render($this->type  . '_article',[
								'articles' =>   $this->articles,
								'title' => $this->title,
								'slug' => '',
			]);
	}
}