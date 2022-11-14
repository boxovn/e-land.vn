<?php
namespace frontend\widgets;
use yii;
use common\models\Article;
class OfferArticle extends yii\base\Widget{
	  public $slug;
		public $limit=3;
		public $offset=0;
		public $articles;
		public $title="Tin rao được đề xuất";
		public $type='block';
		public function init(){
            parent::init();
			$session = Yii::$app->session;
			$query = Article::find()->andWhere(['status' => 1])->andWhere('province_id!="" AND district_id!=""');
			if($session->has('province_id') && $session->get('province_id')){
					$query->andWhere([ 'province_id' => $session->get('province_id')]);
			}
			
			$query->offset($this->offset);
            $query->limit($this->limit);
            $query->orderBy(['created' => SORT_DESC]);
           
			
            $this->articles = $query->all();
		}
		public function run() {
			return $this->render($this->type . '_article',[
								'articles' =>   $this->articles,
								'title' => $this->title,
								'slug' => '',
			]);
	}
}